<?php

add_action('init', 'create_post_type');
function create_post_type()
{
  register_post_type('news', [
    'labels' => [
      'name' => 'お知らせ',
      'singular_name' => 'news',
    ],
    'public' => true,
    'hierarchical' => false,
    'has_archive' => 'news',
    'menu_position' => 6,
    'show_in_rest' => true,
    'supports' => [
      'title',
      'editor',
      'revisions',
      'thumbnail',
    ],
  ]);
}

/*------------------------------------------------------
  カスタム投稿、タクソノミーの登録とURLの正規化
------------------------------------------------------*/

/**
 * 最小設定: CPT名/スラッグ + TAX名/スラッグ だけで
 * /{base}/                              (CPTアーカイブ)
 * /{base}/{term-path}/                  (タクソアーカイブ: 親/子/孫…任意階層)
 * /{base}/{term-path}/page/{i}          (タクソアーカイブのページング)
 * /{base}/{term-path}/{postname}/       (シングル)
 * を実現する。{base} は CPT スラッグ。
 */
function register_cpt_tax_min(string $cpt_name, string $cpt_slug, string $tax_name, string $tax_slug)
{
  // 1) CPT 登録
  register_post_type($cpt_slug, [
    'labels' => [
      'name'          => $cpt_name,
      'singular_name' => $cpt_name,
    ],
    'public'       => true,
    'hierarchical' => false,
    'has_archive'  => $cpt_slug,                  // /{base}/
    'rewrite'      => ['slug' => $cpt_slug, 'with_front' => false],
    'show_in_rest' => true,
    'supports'     => ['title', 'editor', 'revisions', 'thumbnail'],
  ]);

  // 2) TAX 登録（コアの自動リライトルールは使わない）
  register_taxonomy($tax_slug, [$cpt_slug], [
    'labels' => [
      'name'          => $tax_name,
      'singular_name' => $tax_name,
      'menu_name'     => $tax_name,
    ],
    'hierarchical'      => true,
    'show_admin_column' => true,
    'show_ui'           => true,
    'query_var'         => true,   // 例: column_category=parent/child
    'show_in_rest'      => true,
    'rewrite'           => false,  // ← 自前で追加
  ]);

  // 3) タームURLを /{base}/{term-path}/ に統一（パンくず/内部リンク整合）
  add_filter('term_link', function ($url, $term, $taxonomy) use ($tax_slug, $cpt_slug) {
    if ($taxonomy !== $tax_slug || !($term instanceof WP_Term)) return $url;
    $anc   = array_reverse(get_ancestors($term->term_id, $tax_slug, 'taxonomy'));
    $parts = [];
    foreach ($anc as $aid) {
      $t = get_term($aid, $tax_slug);
      if ($t && !is_wp_error($t)) $parts[] = $t->slug;
    }
    $parts[] = $term->slug;
    return home_url(user_trailingslashit($cpt_slug . '/' . implode('/', $parts)));
  }, 10, 3);

  // 4) request: 末尾が投稿スラッグなら単一に振替（CPTPの構造と連携）
  add_filter('request', function ($q) use ($cpt_slug, $tax_slug) {
    if (is_admin() || empty($q[$tax_slug])) return $q;
    $path = trim($q[$tax_slug], '/');
    if ($path === '') return $q;

    $bits = explode('/', $path);
    $last = end($bits);
    $post = get_page_by_path($last, OBJECT, $cpt_slug);
    if ($post && !is_wp_error($post)) {
      // タクソ指定は外して単一投稿クエリへ
      unset($q[$tax_slug], $q['taxonomy'], $q['term'], $q['paged']);
      $q['post_type'] = $cpt_slug;
      $q['name']      = $last;
    }
    return $q;
  });

  // 5) リライトルール（タクソ page → タクソ本体 の順で先頭に差し込む）
  add_action('generate_rewrite_rules', function ($wp_rewrite) use ($cpt_slug, $tax_slug) {
    $base_q = preg_quote($cpt_slug, '/');
    $page   = $wp_rewrite->pagination_base ?: 'page';
    $page_q = preg_quote($page, '/');

    $new = [
      // /{base}/page/{i} PTアーカイブのページング
      '^' . $base_q . '/' . $page_q . '/([0-9]{1,})/?$'
      => 'index.php?post_type=' . $cpt_slug . '&paged=' . $wp_rewrite->preg_index(1),

      // /{base}/{term-path}/page/{i}
      '^' . $base_q . '/(.+)/' . $page_q . '/([0-9]{1,})/?$'
      => 'index.php?post_type=' . $cpt_slug . '&' . $tax_slug . '=' . $wp_rewrite->preg_index(1) . '&paged=' . $wp_rewrite->preg_index(2),

      // /{base}/{term-path}/  （任意深さ）
      '^' . $base_q . '/(.+)/?$'
      => 'index.php?post_type=' . $cpt_slug . '&' . $tax_slug . '=' . $wp_rewrite->preg_index(1),
    ];
    $wp_rewrite->rules = $new + $wp_rewrite->rules;
  }, 20);
}

/* ===== 使い方（例） ===== */
add_action('init', function () {
  register_cpt_tax_min('コラム',   'column', 'コラムカテゴリー', 'column_category');
  register_cpt_tax_min('施工事例', 'case',   '事例カテゴリ',     'case_category');
}, 0);
