<?php
$title = $args['title'] ?? '';
$description = $args['description'] ?? '';
$img = $args['img'] ?? '';
$alt = $title ? wp_strip_all_tags($title, false) : '';
?>

<div class="service-card">
  <img src="<?= $img ?>" alt="<?= $alt ?>" class="service-card__img" height="125">
  <div class="service-card__title"><?= $title ?></div>
  <div class="service-card__description">
    <?= $description ?>
  </div>
</div>