<?php
$show_analytics = !is_user_logged_in();
$show_page_title = !is_front_page();
$page_title = get_the_title();
$page_slug = $post->post_name;
$parent_slug = $post->post_parent ? get_post_field('post_name', $post->post_parent) : ''; // 親slug取得時に使用
$tag = 'h1';

if (is_post_type_archive('case') || is_singular('case') || is_tax('case_category')) {
  $page_title = '施工事例';
  $page_slug = 'Case';
  $tag = 'p';
} else if (is_post_type_archive('news') || is_singular('news') || is_tax('news_category')) {
  $page_title = 'お知らせ';
  $page_slug = 'News';
  $tag = 'p';
} else if (is_post_type_archive('column') || is_singular('column') || is_tax('column_category')) {
  $page_title = 'コラム';
  $page_slug = 'Column';
  $tag = 'p';
} else if (is_404()) {
  $page_title = 'ページが見つかりません';
  $page_slug = '404';
}

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <?php if ($show_analytics): ?>
  <?php endif; ?>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class('body') ?>>
  <?php if ($show_analytics): ?>
  <?php endif; ?>

  <?php get_template_part('components/header') ?>

  <?php if ($show_page_title): ?>
    <div class="page-title bg-white">
      <div class="page-title__inner pt-high">
        <<?= $tag ?> class="page-title__h1 title-h2 --center" en="<?= $page_slug ?>">
          <span class="page-title__h1-text title-h2__text"><?= $page_title ?></span>
        </<?= $tag ?>>
      </div>
      <div class="page-title__line"></div>
    </div>
    <?php if (function_exists('yoast_breadcrumb')) yoast_breadcrumb('<div id="breadcrumbs" class="breadcrumbs bg-white"><div class="breadcrumbs__inner inner pt-high pb-low">', '</div></div>'); ?>
  <?php endif; ?>