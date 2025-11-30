<?php
/*
　 Components: pagination (要WP PageNavi)

  /wp-admin/plugin-install.php?s=WP%2520PageNavi&tab=search&type=term
　
　 Usage:
　 get_template_part('components/pagination', '', [
　   'query'         => $the_query,  // サブループ時必須: queryを渡す
　   'prev_text'     => '',
　   'next_text'     => '',
　 ]);
*/
if (!function_exists('wp_pagenavi')) return;

$q = (isset($args['query']) && $args['query'] instanceof WP_Query)
  ? $args['query']
  : $GLOBALS['wp_query'];

$paged = max(1, (int) get_query_var('paged'));
$max   = max(1, (int) $q->max_num_pages);

$prev_url = $paged > 1    ? get_pagenum_link($paged - 1) : '';
$next_url = $paged < $max ? get_pagenum_link($paged + 1) : '';

$prev_text     = $args['prev_text']     ?? '';
$next_text     = $args['next_text']     ?? '';

$pagenavi_args = [
  'wrapper_tag'   => 'div',
  'wrapper_class' => 'pagination__pages',
];

if ($q !== $GLOBALS['wp_query']) $pagenavi_args['query'] = $q;
?>

<div class="pagination mt-high">
  <?php if ($prev_url): ?>
    <a class="pagination__prev" href="<?= $prev_url; ?>" rel="prev"><?= $prev_text; ?></a>
  <?php else: ?>
    <span class="pagination__prev --disabled" aria-hidden="true"><?= $prev_text; ?></span>
  <?php endif; ?>

  <?php wp_pagenavi($pagenavi_args); ?>

  <?php if ($next_url): ?>
    <a class="pagination__next" href="<?= $next_url; ?>" rel="next"><?= $next_text; ?></a>
  <?php else: ?>
    <span class="pagination__next --disabled" aria-hidden="true"><?= $next_text; ?></span>
  <?php endif; ?>
</div>