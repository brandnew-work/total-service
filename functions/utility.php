<?php



/*------------------------------------------------------
  CSS / js の読み込み
------------------------------------------------------*/

if (!is_admin()) {
  define("TEMPLATE_DIRE", get_template_directory_uri());
  define("TEMPLATE_PATH", get_template_directory());
  function wp_css($css_name, $file_path)
  {
    if (file_exists(TEMPLATE_PATH . $file_path)) {
      wp_enqueue_style($css_name, TEMPLATE_DIRE . $file_path, array(), date('YmdGis', filemtime(TEMPLATE_PATH . $file_path)));
    }
  }
  function wp_script($script_name, $file_path, $bool = true)
  {
    if (file_exists(TEMPLATE_PATH . $file_path)) {
      wp_enqueue_script($script_name, TEMPLATE_DIRE . $file_path, array('jquery'), date('YmdGis', filemtime(TEMPLATE_PATH . $file_path)), $bool);
    }
  }
  function add_scripts($post)
  {
    wp_css('add_style', '/style.css');
    if (function_exists('get_field')) {
      // ページ固有style
      if (get_field('css_file_name')) {
        foreach (explode(',', get_field('css_file_name')) as $css) {
          $style_name = explode('.', $css);
          wp_css("page_style_{$style_name['0']}", "/css/{$css}");
        }
      } else if (is_front_page() && file_exists(TEMPLATE_PATH . '/css/top.css')) {
        wp_css('page_style_top', '/css/top.css');
      } else if (is_single() || is_archive() || is_home()) {
        wp_css('post_style_post', '/css/post.css');
      } else if (!is_front_page()) {
        if (file_exists(TEMPLATE_PATH . '/css/sub.css')) {
          wp_css('page_style_sub', '/css/sub.css');
        } else if (file_exists(TEMPLATE_PATH . '/css/common.css')) {
          wp_css('page_style_common', '/css/common.css');
        }
      }
    } else {
      wp_css('page_style_common', '/css/common.css');
    }
    wp_script('bundle_js', '/js/bundle.js', true);
  }
  add_action('wp_enqueue_scripts', 'add_scripts');

  //scriptにasyncを追加
  function add_async_to_enqueue_script($url)
  {
    if (FALSE === strpos($url, '.js')) return $url;
    if (strpos($url, 'jquery.min')) return $url;
    return "$url' async charset='UTF-8";
  }
  add_filter('clean_url', 'add_async_to_enqueue_script', 11, 1);
}


/*------------------------------------------------------
  headerの不要タグ削除
------------------------------------------------------*/
add_action('init', function () {
  // RSS（必要ならコメントアウトを外す）
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);

  // 編集系リンク（RSD / WLW）
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');

  // REST API の link タグとヘッダ
  remove_action('wp_head', 'rest_output_link_wp_head');
  remove_action('template_redirect', 'rest_output_link_header', 11);

  // oEmbed（使わないなら丸ごと停止）
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  remove_action('wp_head', 'wp_oembed_add_host_js');
  remove_action('rest_api_init', 'wp_oembed_register_route');
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
  add_filter('embed_oembed_discover', '__return_false');

  // 短縮URL
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  remove_action('template_redirect', 'wp_shortlink_header', 11, 0);

  // 前後記事の rel（クローラ最適化のため不要なら削除）
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

  // generator（WordPress バージョン）
  remove_action('wp_head', 'wp_generator');

  // canonical（SEOプラグインを使用しているためコアを停止）
  remove_action('wp_head', 'rel_canonical');
});

// 絵文字機能を完全停止
add_action('init', function () {
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  add_filter('emoji_svg_url', '__return_false');
});


/*------------------------------------------------------
  外観 -> メニューを使用できるようにする
------------------------------------------------------*/

register_nav_menus();


/*------------------------------------------------------
  アイキャッチ画像を使用できるようにする
------------------------------------------------------*/

add_theme_support('post-thumbnails');


/*------------------------------------------------------
  width height を削除する
------------------------------------------------------*/

add_filter('post_thumbnail_html', 'custom_attribute');
function custom_attribute($html)
{
  $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
  return $html;
}


/*------------------------------------------------------
  固定ページのスラッグをクラス名に追加
------------------------------------------------------*/

function my_body_class($classes)
{
  if (is_page()) {
    $page = get_post();
    $classes[] = 'page-' . $page->post_name;
  }
  return $classes;
}
add_filter('body_class', 'my_body_class');


/*------------------------------------------------------
  特定ページのコンテンツを取得（主にフォームにつけるprivacypolicy用）
------------------------------------------------------*/

function get_content_shortcode($atts)
{
  extract(shortcode_atts(array(
    'slug' => '',
  ), $atts));
  $page_data = get_page_by_path($slug);
  $page      = get_post($page_data);
  $html      =
    <<<EOF
  <div class='content-shortcode-output-{$slug}'>
    <div class='content-shortcode-output-{$slug}__inner'>
      {$page->post_content}
    </div>
  </div>
EOF;
  return $html;
}
add_shortcode('content_shortcode', 'get_content_shortcode');
// wpcf7_add_shortcode('content_shortcode', 'get_content_shortcode'); // CF7につける場合は必要 / MWFは必要なし


/*------------------------------------------------------
  block libraryの初期css消去
------------------------------------------------------*/

function mytheme_enqueue()
{
  wp_dequeue_style('wp-block-library');
}
// add_action( 'wp_enqueue_scripts', 'mytheme_enqueue' );


/*------------------------------------------------------
  uploadsフォルダのURL取得
------------------------------------------------------*/

function uploads_url($image_name = '')
{
  $upload_dir = wp_upload_dir();
  return "{$upload_dir['baseurl']}/{$image_name}";
} // pictureを毎回書くのがめんどうなので


/*------------------------------------------------------
  ファイル名からretina対応のsrcset取得（retinaサイズの画像登録は別で必要）
------------------------------------------------------*/

// オーバーサイズの自動リサイズ停止
add_filter('big_image_size_threshold', '__return_false');

// retina呼び出し
function srcset($file_name, $size_pc = 'large', $size_sp = 'medium', $alt = '', $img_class = '', $unique_sp = '')
{
  $upload_dir = wp_upload_dir();
  $alt_insert = $alt ? " alt='{$alt}'" : '';
  $class_insert = $img_class ? " class='{$img_class}'" : '';
  $file_url   = strpos($file_name, '//') ? $file_name : "{$upload_dir['baseurl']}/{$file_name}";
  $media_id = attachment_url_to_postid($file_url);
  if ($media_id === 0) return ''; // file not found

  $pc_1x = wp_get_attachment_image_src($media_id, $size_pc);
  $pc_2x = wp_get_attachment_image_src($media_id, "{$size_pc}_retina");

  // pc
  $pc = [
    '1x' => $pc_1x[0],
    '2x' => $pc_2x[0],
    'width' => $pc_2x[1],
    'height' => $pc_2x[2],
  ];

  // sp
  if ($unique_sp !== '') {
    $file_url   = strpos($file_name, '//') ? $unique_sp : "{$upload_dir['baseurl']}/{$unique_sp}";
    $media_id = attachment_url_to_postid($file_url);
  }
  $sp_1x = wp_get_attachment_image_src($media_id, $size_sp);
  $sp_2x = wp_get_attachment_image_src($media_id, "{$size_sp}_retina");
  $sp = [
    '1x' => $sp_1x[0],
    '2x' => $sp_2x[0],
  ];

  // html
  $html  = '<picture>';
  $html .=  "<source media='(min-width: 768px)' srcset='{$pc['1x']} 1x, {$pc['2x']} 2x'>";
  $html .=  "<source media='(max-width: 320px)' srcset='{$sp['1x']} 1x, {$sp['2x']} 2x'>";
  $html .= "<img loading='lazy' src='{$sp['1x']}'{$class_insert}{$alt_insert} width='{$pc['width']}' height='{$pc['height']}'>";
  $html .= '</picture>';
  echo $html;
}
