<?php
/*
  カスタム投稿タイプの一覧表示件数を制御
  */
// add_action('pre_get_posts', function ($q) {
//   if (is_admin() || !$q->is_main_query()) return;

//   $per_page = 9;
//   $tax = 'hoge';
//   $post_type = 'fuga';

//   if ($q->is_tax($tax)) {
//     $q->set('post_type', $post_type);
//     $q->set('posts_per_page', $per_page);
//     return;
//   }

//   if ($q->is_post_type_archive($post_type)) {
//     $q->set('posts_per_page', $per_page);
//     return;
//   }
// });

// エディター画面専用のCSSを読み込む
add_action('enqueue_block_editor_assets', function () {
  wp_enqueue_style(
    'block-editor-style',
    get_template_directory_uri() . '/css/block-style.css',
    [],
    filemtime(get_template_directory() . '/css/block-style.css')
  );
});

function custom_block_categories($categories, $post)
{
  return array_merge(
    [
      [
        'slug'  => 'custom',
        'title' => '追加ブロック',
      ],
    ],
    $categories
  );
}
add_filter('block_categories_all', 'custom_block_categories', 10, 2);

function custom_gutenberg_blocks()
{
  $src    = get_template_directory_uri() . '/js/blocks.js';
  $mtime  = filemtime(get_template_directory() . '/js/blocks.js');

  // 依存は wp-scripts が吐くもの + 明示追加 (wp-api-fetch, wp-core-data)
  wp_register_script(
    'custom-block-js',
    $src,
    [
      'wp-blocks',
      'wp-element',
      'wp-block-editor',
      'wp-components',
      'wp-i18n',
      'wp-api-fetch',
      'wp-core-data',
    ],
    $mtime,
    true // in_footer = true
  );

  // エディタ用
  $blocks = [
    'custom/bubble-section',
  ];
  foreach ($blocks as $name) {
    register_block_type($name, ['editor_script' => 'custom-block-js']);
  }
}
add_action('init', 'custom_gutenberg_blocks');


/**
 * ACF の全フィールドをショートコードとして登録する
 */
add_action('wp', 'register_dynamic_acf_shortcodes');

function register_dynamic_acf_shortcodes()
{
  // ACF 関数がない、あるいは投稿オブジェクトが空なら抜ける
  if (! function_exists('get_field_objects') || ! is_singular()) return;

  global $post;
  $post_id = $post->ID;
  if (! $post_id) return;

  // その投稿に登録されているすべてのフィールド情報を取得
  $fields = get_field_objects($post_id);
  if (empty($fields)) return;

  foreach ($fields as $field) {
    $name = $field['name'];

    // 既に同名ショートコードがあれば飛ばす
    if (shortcode_exists($name)) continue;

    add_shortcode($name, function ($atts) use ($name) {
      // 値を取り直す
      $value = get_field($name, get_queried_object_id());
      if (empty($value)) return '';

      // それ以外は文字列として返す
      return esc_html($value);
    });
  }
}


/**
 * case_category tobに属する施工事例の取得
 */
function get_tob_cases($count = 5)
{
  $tob = get_term_by('slug', 'tob', 'case_category');
  $tob_cases_args = [
    'post_type'      => 'case',
    'posts_per_page' => $count,
    'tax_query'      => [
      [
        'taxonomy'         => 'case_category',
        'field'            => 'term_id',
        'terms'            => [$tob->term_id],
        'include_children' => true,
      ],
    ],
  ];
  $tob_cases = new WP_Query($tob_cases_args);
  return $tob_cases;
}



/**
 * canonicalの固定
 */

// Yoast の canonical を外す
add_filter('wpseo_frontend_presenters', function ($presenters) {
  if (!is_singular()) return $presenters;
  return array_filter($presenters, function ($p) {
    return !($p instanceof \Yoast\WP\SEO\Presenters\Canonical_Presenter);
  });
}, PHP_INT_MAX);

// 自前で canonical を出力
add_action('wp_head', function () {
  if (!is_singular()) return;
  $id  = get_queried_object_id();
  $url = get_permalink($id);
  $page = (int) get_query_var('page');
  if ($page > 1) {
    $url = trailingslashit($url) . user_trailingslashit($page, 'single_paged');
  }
  echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n";
}, 1); // 先頭で出す


/**
 * 自動的に投稿スラッグを翻訳する
 */
function custom_auto_post_slug($slug, $post_ID, $post_status, $post_type)
{
  // スラッグ内にエンコードされた文字が含まれているかチェック
  if (preg_match('/(%[0-9a-f]{2})+/', $slug)) {
    // 投稿タイプをURIエンコードし、投稿IDを追加して新しいスラッグを設定
    $new_slug = utf8_uri_encode($post_type) . '-' . $post_ID;
    return $new_slug; // 新しいスラッグを返す
  }
  return $slug; // スラッグが変更されない場合は元のスラッグを返す
}
add_filter('wp_unique_post_slug', 'custom_auto_post_slug', 10, 4);


/**
 * パンくずのカスタム
 */

function override_yoast_breadcrumb($links)
{
  $post = get_queried_object();

  // parent関連
  $parent_slug = '';
  if (isset($post->post_parent)) {
    $parent = get_post($post->post_parent);
    $parent_slug = $parent->post_name;
  }

  // パンくず表示に関する処理
  // if (is_singular()) {
  //   $last = count($links) - 1;
  //   $links[$last]['text'] .= ' 様';
  // }

  return $links;
}
// add_filter('wpseo_breadcrumb_links', 'override_yoast_breadcrumb');


/**
 * case singleのURLを常に正規URLに301リダイレクト
 */

add_action('template_redirect', function () {
  if (!is_singular() || is_preview()) return;

  $target   = user_trailingslashit(get_permalink(get_queried_object_id()));
  $current  = user_trailingslashit(home_url(add_query_arg([], $GLOBALS['wp']->request)));

  // クエリパラメータは維持（必要なければ外す）
  if (untrailingslashit($current) !== untrailingslashit($target)) {
    wp_redirect($target, 301);
    exit;
  }
});


/**
 * post_typeと紐づくtermの取得
 */

function get_post_term($post_type)
{
  $post_type_term = match ($post_type) {
    'column' => 'column_category',
    'news'   => 'news_category',
    'case'   => 'case_category',
    default  => 'case_category',
  };
  return $post_type_term;
}


/**
 * 祖先（と必要なら自身）に指定スラッグが含まれるかを判定
 *
 * @param int|WP_Term $term         タームIDまたはWP_Term
 * @param string      $needle_slug   探すスラッグ（例: 'tob'）
 * @param string      $taxonomy      タクソノミー（既定: 'case_category'）
 * @param bool        $include_self  自身のタームも判定に含めるか（true=含める）
 *                                   ※「先祖のみ」に限定したい場合は false に
 * @return bool
 */
function case_cat_lineage_has_slug($term, string $needle_slug, string $taxonomy = 'case_category', bool $include_self = true): bool
{
  if (is_numeric($term)) {
    $term = get_term((int)$term, $taxonomy);
  }
  if (!($term instanceof WP_Term) || is_wp_error($term) || $term->taxonomy !== $taxonomy) {
    return false;
  }

  // 祖先ID（親→祖父→…の順）を取得
  $anc_ids = array_reverse(get_ancestors($term->term_id, $taxonomy, 'taxonomy'));

  // 自身も判定対象に含めたい場合
  if ($include_self) {
    $anc_ids[] = $term->term_id;
  }

  foreach ($anc_ids as $id) {
    $t = get_term($id, $taxonomy);
    if ($t && !is_wp_error($t) && $t->slug === $needle_slug) {
      return true;
    }
  }
  return false;
}

/**
 * 現在のコンテキストから $is_tob / $is_toc を返す
 * - タームアーカイブ: 表示中タームの系統で判定
 * - シングル case: 紐づくターム（複数可）の系統のいずれかに 'tob' / 'toc' があれば true
 *
 * @param int|null $post_id  シングルで明示したい場合に指定。省略時は現在クエリから推測。
 * @param bool     $include_self 自身も判定対象に含めるか（先祖のみなら false）
 * @return array{is_tob: bool, is_toc: bool}
 */
function get_case_category_flags(?int $post_id = null, bool $include_self = true): array
{
  $taxonomy = 'case_category';
  $flags = ['is_tob' => false, 'is_toc' => false];

  // タームアーカイブなら、表示中タームで判定
  if (is_tax($taxonomy)) {
    $term = get_queried_object();
    if ($term instanceof WP_Term) {
      $flags['is_tob'] = case_cat_lineage_has_slug($term, 'tob', $taxonomy, $include_self);
      $flags['is_toc'] = case_cat_lineage_has_slug($term, 'toc', $taxonomy, $include_self);
    }
    return $flags;
  }

  // シングル case（投稿に付与されたターム群をチェック）
  if (is_singular('case') || $post_id) {
    if (!$post_id) $post_id = get_queried_object_id();
    $terms = get_the_terms($post_id, $taxonomy);
    if ($terms && !is_wp_error($terms)) {
      foreach ($terms as $t) {
        $flags['is_tob'] = $flags['is_tob'] || case_cat_lineage_has_slug($t, 'tob', $taxonomy, $include_self);
        $flags['is_toc'] = $flags['is_toc'] || case_cat_lineage_has_slug($t, 'toc', $taxonomy, $include_self);
        if ($flags['is_tob'] && $flags['is_toc']) break; // 両方trueなら打ち切り
      }
    }
  }
  return $flags;
}


/**
 * よくある質問の取得
 */

function get_faqs($count = 0, string $category = '')
{
  $faqs = [
    'common' => [
      'label' => '共通の<wbr>ご質問',
      'faq' => [
        [
          'q' => '共通の質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
        [
          'q' => '共通の質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
        [
          'q' => '共通の質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
        [
          'q' => '共通の質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
        [
          'q' => '共通の質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
      ]
    ],
    'tob' => [
      'label' => '事業主<wbr>の方へ',
      'faq' => [
        [
          'q' => '事業主質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
        [
          'q' => '事業主質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
        [
          'q' => '事業主質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
        [
          'q' => '事業主質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
        [
          'q' => '事業主質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
      ]
    ],
    'toc' => [
      'label' => '個人宅<wbr>の方へ',
      'faq' => [
        [
          'q' => '個人宅質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
        [
          'q' => '個人宅質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
        [
          'q' => '個人宅質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
        [
          'q' => '個人宅質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
        [
          'q' => '個人宅質問タイトル入ります',
          'a' => '回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります回答テキスト入ります',
        ],
      ]
    ],
  ];

  $selected_faqs = $category ? $faqs[$category]['faq'] : $faqs;

  if ($count !== 0 && $category) {
    $selected_faqs = array_slice($selected_faqs, 0, $count);
  }

  return $selected_faqs;
}
