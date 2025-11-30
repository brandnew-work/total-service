<?php
$title = $args['title'] ?? '';
$description = $args['description'] ?? '';
$img = $args['img'] ?? '';
$sub = $args['sub'] ?? [];
$class = $args['class'] ?? '';
$has_num = $args['has_num'] ?? true;
?>

<div class="feature-section <?= $class; ?>">
  <?php if ($has_num): ?>
    <span class="feature-section__num"></span>
  <?php endif; ?>
  <h2 class="feature-section__title"><?= $title; ?></h2>
  <?php if ($img): ?>
    <figure class="feature-section__figure">
      <img src="<?= $img; ?>" alt="" class="feature-section__img">
    </figure>
  <?php endif; ?>
  <div class="feature-section__contents">
    <p class="feature-section__description"><?= $description; ?></p>
    <?php if (!empty($sub)): ?>
      <h3 class="feature-section__sub-title"><?= $sub['title']; ?></h3>
      <p class="feature-section__sub-description"><?= $sub['description']; ?></p>
    <?php endif; ?>
  </div>
</div>