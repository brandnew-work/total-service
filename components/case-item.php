<?php
$title = get_the_title();
$display_title = preg_replace("/^(.*)様$/", "$1", $title);
$link = get_the_permalink();
$eyecatch_url = get_the_post_thumbnail_url(null, 'large') ?: (get_the_post_thumbnail_url(null, 'full') ?: get_theme_file_uri('/assets/blank.svg'));
$price = get_field('price');
$period = get_field('period');

$primary_term = get_primary_term_object($post->ID, 'case_category');
?>

<a href="<?= $link ?>" class="case-item">
  <figure class="case-item__figure">
    <img src="<?= $eyecatch_url; ?>" alt="<?= $title; ?>" class="case-item__img">
  </figure>
  <div class="case-item__contents">
    <p class="case-item__title" after="様"><?= $display_title; ?></p>
    <div class="case-item__meta">
      <?php if ($price): ?>
        <dl class="case-item__meta-item">
          <dt class="case-item__meta-label">費用</dt>
          <dd class="case-item__meta-text"><?= $price; ?></dd>
        </dl>
      <?php endif; ?>
      <?php if ($period): ?>
        <dl class="case-item__meta-item">
          <dt class="case-item__meta-label">工期</dt>
          <dd class="case-item__meta-text"><?= $period; ?></dd>
        </dl>
      <?php endif; ?>
    </div>
  </div>
  <?php if ($primary_term): ?>
    <span class="label --fill --accent"><?= $primary_term->name; ?></span>
  <?php endif; ?>
</a>