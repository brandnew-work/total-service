<?php
$title = get_the_title();
$excerpt = get_the_excerpt();
$link = get_the_permalink();
$date_format = get_option('date_format');
$time = get_the_date($date_format);
$datetime = get_the_date('Y-m-d');
$eyecatch_url = get_the_post_thumbnail_url(null, 'large') ?: (get_the_post_thumbnail_url(null, 'full') ?: get_theme_file_uri('/assets/blank.svg'));

$post_type = $post->post_type;
$post_type_term = get_post_term($post_type);
$primary_term = get_primary_term_object($post->ID, $post_type_term);
$has_excerpt = $args['has_excerpt'] ?? true;
$class = $args['class'] ?? false;
?>

<a href="<?= $link; ?>" class="post-item <?= $class; ?>">
  <?php if ($post_type === 'column' && $eyecatch_url): ?>
    <figure class="post-item__figure">
      <img src="<?= $eyecatch_url; ?>" alt="<?= $title; ?>" class="post-item__img">
    </figure>
  <?php endif; ?>
  <div class="post-item__contents">
    <header class="post-item__meta">
      <time class="post-item__date" datetime="<?= $datetime; ?>"><?= $time; ?></time>
      <?php if ($primary_term): ?>
        <div class="post-item__categories">
          <span class="label --accent"><?= $primary_term->name; ?></span>
        </div>
      <?php endif; ?>
    </header>
    <h2 class="post-item__title"><?= $title; ?></h2>
    <?php if ($has_excerpt): ?>
      <p class="post-item__excerpt"><?= $excerpt ?></p>
    <?php endif; ?>
  </div>
</a>