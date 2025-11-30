<?php
$title = $args['title'] ?? '';
$description = $args['description'] ?? '';
$has_cta = $args['has_cta'] ?? false;
?>

<div class="flow-item">
  <div class="flow-item__contents">
    <h3 class="flow-item__title"><?= $title ?></h3>
    <?php if ($description): ?>
      <p class="flow-item__description">
        <?= $description ?>
      </p>
    <?php endif; ?>
    <?php if ($has_cta): ?>
      <div class="flow-item__btns">
        <a href="#" class="btn-block --email">メールで相談</a>
        <a href="#" class="btn-block --line">LINEで相談</a>
      </div>
    <?php endif; ?>
  </div>
</div>