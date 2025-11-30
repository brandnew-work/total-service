<?php
$parent_slug = $args['parent_slug'] ?: 'toc';
$taxonomy = $args['taxonomy'] ?: 'case_category';
$parent = get_term_by('slug', $parent_slug, $taxonomy);
if ($parent && !is_wp_error($parent)) {
  $children = get_terms([
    'taxonomy'   => $taxonomy,
    'parent'     => $parent->term_id,
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
  ]);
}
?>

<?php if ($children && !is_wp_error($children)): ?>
  <div class="category-cards">
    <?php foreach ($children as $child): ?>
      <?php
      $bg = get_field('bg', $child);
      ?>
      <a href="<?= get_term_link($child); ?>" class="category-card">
        <figure class="category-card__figure">
          <?php if ($bg): ?>
            <img src="<?= $bg; ?>" alt="<?= $child->name; ?>" class="category-card__img">
          <?php endif; ?>
        </figure>
        <p class="category-card__title"><?= $child->name; ?></p>
      </a>
    <?php endforeach; ?>
  </div>
<?php endif; ?>