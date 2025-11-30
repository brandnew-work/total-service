<?php
get_header();

$next_post = get_next_post();
$prev_post = get_previous_post();
$next_post_url = !empty($next_post) ? get_permalink($next_post->ID) : false;
$prev_post_url = !empty($prev_post) ? get_permalink($prev_post->ID) : false;

$title = get_the_title();
$date_format = get_option('date_format');
$time = get_the_date($date_format);
$datetime = get_the_date('Y-m-d');
$eyecatch_url = get_the_post_thumbnail_url(null, 'large') ?: get_the_post_thumbnail_url(null, 'full');

$is_column = $post->post_type === 'column';
$is_news = $post->post_type === 'news';
$is_case = $post->post_type === 'case';

$post_type_term = get_post_term($post->post_type);
$terms = get_terms_with_parents_for_post($post->ID, $post_type_term);
?>

<main>
  <article class="pt-middle bg-white">
    <section class="post__inner inner --narrow">
      <header class="post__header">
        <div class="post__meta">
          <?php if ($is_column): ?>
            <time class="post__date" date-time="<?= $datetime; ?>"><?= $time; ?></time>
          <?php endif; ?>
          <?php if ($terms): ?>
            <div class="post__categories">
              <?php foreach ($terms as $term): ?>
                <span class="label --accent"><?= $term->name; ?></span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
        <h1 class="post__title"><?= $title; ?></h1>
      </header>
      <?php if ($eyecatch_url): ?>
        <div class="post__thumbnail">
          <img src="<?= $eyecatch_url; ?>" alt="<?= $title; ?>" class="post__thumbnail-img">
        </div>
      <?php endif; ?>
      <div class="post__content post-content">
        <?php the_content(); ?>
      </div>
    </section>


    <?php if ($is_column): ?>
      <?php
      $column_args = [
        'post_type'      => 'column',
        'posts_per_page' => 4,
        'post__not_in'   => [$post->ID],
      ];
      $column = new WP_Query($column_args);
      ?>
      <div class="py-x-high">
        <?php get_template_part('components/common-cta', '', ['class' => 'py-middle bg-white has-border']) ?>

        <?php if ($column->have_posts()): ?>
          <section class="mt-x-high">
            <div class="inner --narrow">
              <h2 class="title-h2 --center" en="Related"><span class="title-h2__text">最近のコラム</span></h2>
              <div class="post-list mt-middle">
                <?php while ($column->have_posts()) {
                  $column->the_post();
                  get_template_part('components/post-item', '');
                }
                wp_reset_postdata(); ?>
              </div>
              <a href="<?= home_url('/column/') ?>" class="btn-block --center">コラム一覧</a>
            </div>
          </section>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if ($is_case): ?>
      <div class="py-x-high">
        <?php get_template_part('components/invite-tob', '', ['has_link' => false]); ?>
        <?php get_template_part('components/common-cta', '', ['class' => 'mt-high pb-middle']) ?>
        <div class="single-case-list mt-x-high">
          <div class="inner">
            <h2 class="title-h2" en="Others"><span class="title-h2__text">その他の施工事例</span></h2>
            <div class="splide single-case-list__carousel js-feature-case-carousel mt-middle">
              <div class="splide__track">
                <ul class="splide__list">
                  <li class="splide__slide"><?php get_template_part('components/case-item', ''); ?></li>
                  <li class="splide__slide"><?php get_template_part('components/case-item', ''); ?></li>
                  <li class="splide__slide"><?php get_template_part('components/case-item', ''); ?></li>
                  <li class="splide__slide"><?php get_template_part('components/case-item', ''); ?></li>
                  <li class="splide__slide"><?php get_template_part('components/case-item', ''); ?></li>
                  <li class="splide__slide"><?php get_template_part('components/case-item', ''); ?></li>
                  <li class="splide__slide"><?php get_template_part('components/case-item', ''); ?></li>
                </ul>
              </div>
            </div>
            <a href="#" class="btn-block --right">店舗施工事例一覧</a>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($is_news): ?>
      <div class="pt-high pb-x-high">
        <div class="inner --narrow">
          <div class="btn-list">
            <?php if ($prev_post_url): ?>
              <a href="<?= $prev_post_url; ?>" class="btn-block --prev mt-0">前の記事へ</a>
            <?php endif; ?>
            <?php if ($next_post_url): ?>
              <a href="<?= $next_post_url; ?>" class="btn-block mt-0">次の記事へ</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>


  </article>
</main>

<?php get_footer(); ?>