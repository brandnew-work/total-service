<?php
get_header();

$table = [
  '会社名' => '株式会社トータルサービス',
  '代表' => '栗原　英敏',
  '本社' => '〒520-0242 滋賀県大津市本堅田5丁目23－18-102',
  '事務所' => '〒520-3022 滋賀県栗東市上鈎58-3',
  '電話番号' => '077-554-4430',
  '営業時間' => '★',
  '定休日' => '日曜日',
  '事業内容' => '住宅リフォーム全般／店舗工事全般／造成工事／電気工事／設備工事／<br>空調・ダクト工事／内装・外装工事',
  '許可番号' => '★',
  '取扱い資格' => '★',
  '加盟団体' => '★',
];
?>

<main>
  <article>

    <section class="py-x-high bg-white">
      <div class="inner">
        <div class="company-greeting">
          <h2 class="company-greeting__title">事業も自宅も<wbr>トータルサポート</h2>
          <figure class="company-greeting__figure">
            <img src="<?= get_theme_file_uri('/assets/sample.jpg') ?>" alt="株式会社トータルサービス 代表 栗原　英敏" class="company-greeting__img">
            <figcaption class="company-greeting__figcaption">代表<br>栗原　英敏</figcaption>
          </figure>
          <p class="company-greeting__description">
            当社は、法人向け（toB）および個人向け（toC）の両方に対応した工務店として、店舗やオフィスの新築・改装工事から住まいのリフォームや増改築まで、幅広いニーズにお応えしています。<br>
            豊富な経験と確かな技術で、プロジェクトの大小にかかわらず丁寧な対応を心がけ、施工前のご相談から施工後のフォローまで一貫してサポートを提供。<br>
            最新技術を取り入れたガス設備やオール電化、耐震補強にも対応し、エクステリア工事や小さな修繕も迅速に行います。<br>
            お客様の理想を実現し、信頼いただける施工を行うことを誇りとしています。<br>
            ぜひお気軽にご相談ください。
          </p>
        </div>
      </div>
    </section>

    <section class="py-x-high">
      <div class="inner --narrow">
        <h2 class="title-h2 --center" en="Overview"><span class="title-h2__text">会社概要</span></h2>
        <table class="table mt-middle">
          <?php foreach ($table as $th => $td): ?>
            <tr>
              <th><?= $th; ?></th>
              <td><?= $td; ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </section>

  </article>
</main>

<?php get_footer(); ?>