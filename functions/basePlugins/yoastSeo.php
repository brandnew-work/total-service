<?php

/**
 * archiveの2ページ目以降をnoindex
 */

function custom_robots($link)
{
  if (is_paged()) {
    return "noindex,follow";
  } else {
    return $link;
  }
}
add_filter('wpseo_robots', 'custom_robots');


/**
 * primary termの取得
 */

function get_primary_term_object($post_id, $taxonomy = 'case_category')
{
  $taxonomy = sanitize_key($taxonomy);
  $post_id  = (int) $post_id;

  // 1) Yoastのプライマリ
  if (function_exists('yoast_get_primary_term_id')) {
    $term_id = yoast_get_primary_term_id($taxonomy, $post_id);
    if ($term_id) {
      $t = get_term($term_id, $taxonomy);
      if ($t && !is_wp_error($t) && has_term($t->term_id, $taxonomy, $post_id)) {
        return $t; // WP_Term
      }
    }
  }

  // 2) term_order 昇順の先頭
  $terms = wp_get_object_terms($post_id, $taxonomy, [
    'orderby' => 'term_order',
    'order'   => 'ASC',
    'number'  => 1,
  ]);
  if (!is_wp_error($terms) && !empty($terms)) return $terms[0];

  return false;
}


/**
 * チェックの付いていない親termも含めたterm一覧の取得
 */
// 投稿に付いている case_category の「親を含む」ターム一覧を返す
// 戻り値: WP_Term[]（親→子の順、重複なし）/ 空配列
function get_terms_with_parents_for_post($post_id, $taxonomy = 'case_category')
{
  $base_terms = wp_get_object_terms($post_id, $taxonomy, [
    'orderby' => 'term_order',
    'order'   => 'ASC',
  ]);
  if (is_wp_error($base_terms) || empty($base_terms)) return [];

  $out  = [];
  $seen = [];

  foreach ($base_terms as $t) {
    // 祖先ID（親→祖父…ではなく「直親→…→最上位」順で返るので反転）
    $anc_ids = array_reverse(get_ancestors($t->term_id, $taxonomy, 'taxonomy'));
    // 親→…→子 という順に並べる
    $chain_ids = array_merge($anc_ids, [$t->term_id]);

    foreach ($chain_ids as $id) {
      if (isset($seen[$id])) continue;
      $term = get_term($id, $taxonomy);
      if ($term && !is_wp_error($term)) {
        $out[] = $term;
        $seen[$id] = true;
      }
    }
  }
  return $out;
}
