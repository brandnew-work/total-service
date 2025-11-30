<?php
get_header();

$is_column = $post_type === 'column';
$is_news = $post_type === 'news';
$is_case = $post_type === 'case';

$title = '全て';
if (is_tax()) {
  $title = single_term_title('', false);
}

$post_type_title = post_type_archive_title('', false);

$template_args = [];
$prefix = match ($post_type) {
  'case' => [
    'class' => 'case',
    'template' => 'case',
  ],
  'column' => [
    'class' => 'column',
    'template' => 'post',
  ],
  default => [
    'class' => 'news',
    'template' => 'post',
  ],
};
if ($is_news) {
  $template_args = [
    'class' => '--inline',
    'has_excerpt' => false
  ];
}

$flags = get_case_category_flags(null, true);
$is_tob = $flags['is_tob'];
$is_toc = $flags['is_toc'];
?>

<main>
  <article>
    <section class="bg-white pt-middle pb-x-high">
      <div class="inner<?= !$is_case ? ' --narrow' : ''; ?>">
        <?php if (!$is_news): ?>
          <h1 class="text-large color-theme fw-bold"><?= $title; ?></h1>
        <?php endif; ?>
        <?php if (have_posts()): ?>
          <div class="<?= $prefix['class']; ?>-list<?= !$is_news ? ' mt-high' : ''; ?>">
            <?php while (have_posts()) : the_post(); ?>
              <?php get_template_part("components/{$prefix['template']}-item", '', $template_args); ?>
            <?php endwhile; ?>
          </div>
          <?php get_template_part('components/pagination', ''); ?>
        <?php else: ?>
          <p class="mt-middle">
            現在<?= $post_type_title; ?>はありません
          </p>
        <?php endif; ?>
      </div>
    </section>
    <?php if ($is_case && $is_tob): ?>
      <?php get_template_part('components/invite-tob', '', ['has_link' => false, 'class' => 'pb-x-high pb-md-0 bg-white']); ?>
    <?php endif; ?>
    <?php if ($is_case && $is_toc): ?>
      <section class="py-x-high">
        <div class="inner">
          <h2 class="title-h2" en="Category"><span class="title-h2__text">ご自宅施工カテゴリー</span></h2>
          <?php get_template_part('components/category-cards', ''); ?>
        </div>
      </section>
    <?php endif; ?>
  </article>
</main>

<?php get_footer(); ?>