<?php
get_header();

$cards = [
  ['text' => '物件探し'],
  ['text' => '設計'],
  ['text' => '内装・エクステリア'],
  ['text' => 'リフォーム'],
  ['text' => 'インテリアコーディネート', 'class' => '--small'],
  ['text' => 'サイン・看板'],
  ['text' => '各種機器の調達'],
  ['text' => 'メンテナンス'],
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
?>

<main>
  <article>
    <section class="py-middle">
      <div class="inner --wide">
        <h2 class="feature-title">
          <span class="--small">日本全国</span>
          <span class="feature-title__row">
            <span class="--emphasis">店舗</span>
            <span class="--emphasis">改装</span>
            <span class="--emphasis">施設の新規開業</span>
            <span>は</span>
          </span>
          <span>トータルサービスへ</span>
        </h2>
      </div>
    </section>

    <section class="py-high bg-white">
      <div class="inner">
        <?php get_template_part('components/feature-section', '', [
          'title' => 'ゼロから新規店舗の<br>設計・立ち上げ',
          'description' => '
            内装・エクステリアはもちろん、看板製作や設計など、開業に必要な全ての「コト」をトータルでお手伝いいたします。<br>
            店舗設計においては、少人数精鋭のプロ集団として、一人ひとりのご要望に寄り添い、柔軟で迅速な対応を実現。複雑な開業準備の負担を軽減し、お客様の夢を確実に形に変えるパートナーとして、お任せいただけるよう尽力いたします。<br>
            計画段階から施工完了まで、全てを一貫してお手伝いし、安心の開業を実現します！
          ',
          'img' => get_theme_file_uri('/assets/feature/illust-1.svg'),
        ]) ?>
        <div class="mt-high">
          <h3 class="text-large fw-bold color-theme">トータルサービスでできること</h3>
          <ul class="text-cards mt-30">
            <?php foreach ($cards as $card): ?>
              <li class="text-card <?= $card['class'] ?? ''; ?>"><?= $card['text']; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </section>

    <section class="py-high">
      <div class="inner">
        <?php get_template_part('components/feature-section', '', [
          'title' => 'ワンストップで<br>大幅なコスト削減',
          'description' => '
            代理店を通さず、直請けで全てを行うため、中間マージンを徹底的にカットし、大幅なコスト削減を実現します。
            新規出店や新規開業にかかる費用をできるだけ抑えたいとお考えの事業主様のために、費用対効果の高いプランを丁寧に提案。<br>
            内装・外装、看板製作、店舗設計など、開業に必要なすべての工程をトータルサポート！<br>
            少人数精鋭のプロ集団ならではの密着した対応と柔軟なアプローチで、コストを抑えながらも質の高い店舗づくりを実現します。
          ',
          'img' => get_theme_file_uri('/assets/feature/illust-2.svg'),
          'class' => '--revert'
        ]) ?>
        <?php if ($tob_cases->have_posts()): ?>
          <div class="mt-high">
            <h3 class="text-large fw-bold color-theme mt-30">事業施工事例</h3>
            <div class="splide feature-case js-feature-case-carousel mt-30">
              <div class="splide__track">
                <ul class="splide__list">
                  <?php while ($tob_cases->have_posts()) : $tob_cases->the_post(); ?>
                    <li class="splide__slide"><?php get_template_part('components/case-item', ''); ?></li>
                  <?php endwhile;
                  wp_reset_postdata(); ?>
                </ul>
              </div>
            </div>
            <a href="<?= home_url('/case/tob/') ?>" class="btn-block --right mt-30">事業施工事例一覧</a>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <section class="py-high bg-white">
      <div class="inner">
        <?php get_template_part('components/feature-section', '', [
          'title' => '一級建築士在籍<br>納得のクオリティ',
          'description' => '
            少人数精鋭の強みを最大限に活かし、お客様一人ひとりに密着したきめ細かなサポートを提供いたします。
            少人数体制だからこそ実現できる柔軟性と迅速な対応で、事業主様の声に耳を傾け、最適なプランを提案します。<br>
            開業準備の複雑なプロセスも、共に乗り越える二人三脚の姿勢で進めていきます。
            お客様と信頼を築きながら、理想の店舗を形にし、安心して開業の日を迎えられるよう全力を尽くします。
            プロフェッショナルな視点と実践力で、お客様の夢を確実にサポートいたします！
          ',
          'img' => get_theme_file_uri('/assets/feature/illust-3.svg'),
        ]) ?>
        <div class="mt-high">
          <h3 class="text-large fw-bold color-theme mt-30">私たちが担当いたします</h3>
          <div class="splide feature-staff js-feature-staff-carousel mt-30">
            <div class="splide__track">
              <ul class="splide__list">
                <li class="splide__slide"><?php get_template_part('components/staff-item', ''); ?></li>
                <li class="splide__slide"><?php get_template_part('components/staff-item', ''); ?></li>
                <li class="splide__slide"><?php get_template_part('components/staff-item', ''); ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php get_template_part('components/invite-tob', '', ['class' => 'mt-x-high', 'has_link' => false]); ?>

    <section class="mt-x-high">
      <div class="inner --narrow">
        <h2 class="title-h2 --center" en="Flow"><span class="title-h2__text">お引渡しまでの流れ</span></h2>
        <div class="flow mt-middle">
          <?php foreach ($flows as $flow) get_template_part('components/flow-item', '', $flow); ?>
        </div>
      </div>
    </section>

    <section class="section-faq my-x-high">
      <div class="section-faq__inner inner">
        <h2 class="section-faq__title title-h2" en="FAQ"><span class="title-h2__text">よくある質問</span></h2>
        <?php get_template_part('components/faq-list', '', [
          'category' => 'tob',
          'count' => 3
        ]); ?>
        <a href="<?= home_url('/faq/') ?>" class="section-faq__btn btn-block">よくある質問一覧</a>
      </div>
    </section>

  </article>
</main>

<?php get_footer(); ?>