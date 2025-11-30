<?php
$title = $args['title'] ?? '';
$description = $args['description'] ?? '';
$has_cta = $args['has_cta'] ?? false;
?>

<article class="staff-item">
  <figure class="staff-item__figure">
    <img src="<?= get_theme_file_uri('/assets/sample.jpg') ?>" alt="栗原" class="staff-item__img">
  </figure>
  <div class="staff-item__contents">
    <div class="staff-item__meta">
      <span class="staff-item__job">代表</span>
      <h4 class="staff-item__name">栗原</h4>
    </div>
    <p class="staff-item__text">
      建築・不動産業界を革新し、「すべての人が幸せになれるように」を目指して迅速・正直な企業を築き…
    </p>
  </div>
</article>