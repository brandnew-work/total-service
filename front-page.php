<?php
get_header();

$services = [
  [
    'title' => 'ゼロから新規店舗の<br>設計・立ち上げ',
    'description' => '内装・エクステリアはもちろん、看板、設計など、開業に必要な全ての「コト」をトータルでお手伝い。理想の店舗づくりを全力サポートいたします！',
    'img' => get_theme_file_uri('/assets/feature/illust-1.svg')
  ],
  [
    'title' => 'ワンストップで<br>大幅なコスト削減',
    'description' => '代理店を通さず、直請けなので、代理店の中抜きをカット！新規出店や新規開業の費用を抑えたい事業主様のことを考えて丁寧に提案させていただきます。',
    'img' => get_theme_file_uri('/assets/feature/illust-2.svg')
  ],
  [
    'title' => '一級建築士在籍<br>納得のクオリティ',
    'description' => '少人数精鋭の強みを活かし、お客様一人ひとりに密着した、きめ細かなサポートを提供。開業準備をスムーズに進め、二人三脚で理想の店舗を作りましょう！',
    'img' => get_theme_file_uri('/assets/feature/illust-3.svg')
  ],
];

$img_list = [
  get_theme_file_uri('/assets/top/img-list-1.jpg'),
  get_theme_file_uri('/assets/top/img-list-2.jpg'),
  get_theme_file_uri('/assets/top/img-list-3.jpg'),
  get_theme_file_uri('/assets/top/img-list-4.jpg'),
];

$flows = [
  [
    'title' => 'お問い合わせ・お見積り',
    'description' => '
      まずは、LINE・メールフォームからご相談くださいませ。<br>
      具体的なプランやお店のイメージがまだ決まっていない場合や、希望する物件が業種に適しているかどうかといったご相談にも対応しております。ぜひお気軽にお問い合わせください。
    ',
    'has_cta' => true,
  ],
  [
    'title' => '打ち合わせ・現場調査',
    'description' => '
      物件が確定している場合は、現地調査に赴き、状態確認や採寸を行います。<br>
      お客様の求める業種に適しているかを確認し、重視したいポイントをしっかりヒアリングいたします。<br>
      物件によっては、ご希望の業種に適さない場合は、適切なアドバイスを行います。
    ',
  ],
  [
    'title' => 'ご提案・概算お見積り',
    'description' => '
      図面を用いておおよそのレイアウトの確認を行い、詳細にお客様のご要望を伺いながらご提案いたします。<br>
      また、こちらの内容を基に概算のお見積もりを作成します。
    ',
  ],
  [
    'title' => '打ち合わせ・最終お見積もり',
    'description' => '
      平面図や内観・外観のイメージパースを作成し、デザインを具体化していきます。これらを基にお打ち合わせを行い、ご要望に合わせて最終的なお見積もりを提出します。<br>
      透明性の高いお見積もりをご提供し、ご納得いただける内容を目指しています。
    ',
  ],
  [
    'title' => 'ご契約',
    'description' => '
      設計・工事の請負契約締結となります。
    ',
  ],
  [
    'title' => '工事着手',
    'description' => '
      デザイナー、設計担当者、現場監督、お客様が揃って最終の打ち合わせを行い、工事を開始します。近隣の方々へのご挨拶も丁寧に対応し、円滑な施工を進めてまいります。<br>
      追加でのご要望がある場合は、随時お見積りを行い、お客様とコミュニケーションを行いながら進めてまいります。
    ',
  ],
  [
    'title' => '完工・引き渡し',
    'description' => '
      自社で細部にわたり仕上がりを徹底的にチェックいたします。<br>
      また、消防署、保健所、警察への各種申請もサポートいたします。<br>
      お客様には完成後の状態をご確認いただき、必要に応じて手直しを行ったうえで、正式なお引き渡しとなります。
    ',
  ],
];

$tob_cases = get_tob_cases();

$columns_args = [
  'post_type'      => 'column',
  'posts_per_page' => 2,
];
$columns = new WP_Query($columns_args);
?>

<main>
  <article>
    <section class="mt-high">
      <div class="inner --wide">
        <h2 class="feature-title --dir-column">
          <span class="--small">日本全国</span>
          <span class="feature-title__row">
            <span class="--emphasis">店舗</span>
            <span class="--emphasis">リフォーム</span>
            <span class="--emphasis">施設の新規開業</span>
            <span>は</span>
          </span>
          <span>トータルサービスへ</span>
        </h2>
        <div class="service-cards mt-middle">
          <?php foreach ($services as $service) get_template_part('components/service-card', '', $service); ?>
        </div>
      </div>
    </section>

    <?php if ($tob_cases->have_posts()): ?>
      <section class="home-case">
        <div class="home-case__inner inner">
          <h2 class="home-case__title title-h2" en="Case"><span class="title-h2__text">事業施工事例</span></h2>
          <div class="splide home-case__carousel js-home-carousel">
            <div class="splide__track">
              <ul class="splide__list">
                <?php while ($tob_cases->have_posts()) : $tob_cases->the_post(); ?>
                  <li class="splide__slide"><?php get_template_part('components/case-item', ''); ?></li>
                <?php endwhile;
                wp_reset_postdata(); ?>
              </ul>
            </div>
          </div>
          <a href="<?= home_url('/case/tob/') ?>" class="home-case__btn btn-block">事業施工事例一覧</a>
        </div>
      </section>
    <?php endif; ?>

    <?php get_template_part('components/invite-tob', '', ['class' => 'mt-x-high']); ?>

    <?php get_template_part('components/common-cta', '', ['class' => 'mt-x-high pb-middle']); ?>

    <section class="mt-high">
      <div class="inner">
        <h2 class="title-h2" en="Category"><span class="title-h2__text">ご自宅施工カテゴリー</span></h2>
        <?php get_template_part('components/category-cards', ''); ?>
      </div>
    </section>

    <section class="home-faq mt-x-high">
      <div class="home-faq__inner inner">
        <h2 class="home-faq__title title-h2" en="FAQ"><span class="title-h2__text">よくある質問</span></h2>
        <?php get_template_part('components/faq-list', ''); ?>
        <a href="#" class="home-faq__btn btn-block">よくある質問一覧</a>
      </div>
    </section>

    <div class="img-list mt-x-high">
      <?php foreach ($img_list as $img): ?>
        <figure class="img-list__figure">
          <img src="<?= $img ?>" alt="内装写真" class="img-list__img">
        </figure>
      <?php endforeach; ?>
    </div>

    <?php if ($columns->have_posts()): ?>
      <section class="my-x-high">
        <div class="inner">
          <h2 class="title-h2 --center" en="Column"><span class="title-h2__text">コラム</span></h2>
          <div class="post-list --col-2 mt-middle">
            <?php while ($columns->have_posts()) : $columns->the_post(); ?>
              <?php get_template_part('components/post-item', ''); ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
          </div>
          <a href="<?= home_url('/column/') ?>" class="btn-block --center">コラム一覧</a>
        </div>
      </section>
    <?php endif; ?>

  </article>
</main>

<?php get_footer(); ?>