<?php
get_header();

$services = [
  [
    'title' => 'ゼロから新規店舗の<br>設計・立ち上げ',
    'description' => '内装・エクステリアはもちろん、看板、設計など、開業に必要な全ての「コト」をトータルでお手伝い。理想の店舗づくりを全力サポートいたします！',
    'img' => get_theme_file_uri('/assets/service/illust-1.svg')
  ],
  [
    'title' => 'ワンストップで<br>大幅なコスト削減',
    'description' => '代理店を通さず、直請けなので、代理店の中抜きをカット！新規出店や新規開業の費用を抑えたい事業主様のことを考えて丁寧に提案させていただきます。',
    'img' => get_theme_file_uri('/assets/service/illust-2.svg')
  ],
  [
    'title' => '一級建築士在籍<br>納得のクオリティ',
    'description' => '少人数精鋭の強みを活かし、お客様一人ひとりに密着した、きめ細かなサポートを提供。開業準備をスムーズに進め、二人三脚で理想の店舗を作りましょう！',
    'img' => get_theme_file_uri('/assets/service/illust-3.svg')
  ],
];
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

    <section class="home-case">
      <div class="inner --wide home-case__inner">
        <div class="home-case__header">
          <h2 class="title-h2" en="Case"><span class="title-h2__text">店舗施工事例</span></h2>
          <a href="#" class="btn-block">店舗施工事例一覧</a>
          <a href="#" class="case-item">
            <figure class="case-item__figure">
              <img src="<?= get_theme_file_uri('/assets/sample.jpg') ?>" alt="" class="case-item__img">
            </figure>
            <div class="case-item__contents">
              <p class="case-item__title" after="様">炭火焼き 串の一</p>
              <div class="case-item__meta">
                <dl class="case-item__meta-item">
                  <dt class="case-item__meta-label">費用</dt>
                  <dd class="case-item__meta-text">1,000万円</dd>
                </dl>
                <dl class="case-item__meta-item">
                  <dt class="case-item__meta-label">工期</dt>
                  <dd class="case-item__meta-text">約6ヶ月</dd>
                </dl>
              </div>
            </div>
            <span class="label --fill --accent">新規店舗出店</span>
          </a>
        </div>
      </div>
    </section>

    <?php get_template_part('components/invite-tob', '', ['class' => 'mt-x-high']); ?>

    <?php get_template_part('components/common-cta', '', ['class' => 'mt-x-high']); ?>


  </article>
</main>

<?php get_footer(); ?>