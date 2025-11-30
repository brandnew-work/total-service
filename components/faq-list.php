<?php
$count = $args['count'] ?: 0;
$category = $args['category'] ?: 'common';
$faqs = get_faqs($count, $category);
?>

<?php if (!empty($faqs)): ?>
  <div class="faq-list">
    <?php foreach ($faqs as $row): ?>
      <dl class="faq-item">
        <dt class="faq-item__title js-faq"><span class="faq-item__title-text"><?= $row['q'] ?></span></dt>
        <dd class="faq-item__description"><?= $row['a'] ?></dd>
      </dl>
    <?php endforeach; ?>
  </div>
<?php endif; ?>