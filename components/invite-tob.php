<?php
$class = $args['class'] ?? '';
$has_link = $args['has_link'] ?? true;
?>

<section class="invite-tob <?= $class ?>">
  <div class="invite-tob__inner inner --wide">
    <div class="invite-tob__contents">
      <div class="invite-tob__contents-inner">
        <div class="invite-tob__title text-xlarge">店舗づくりの準備に<br>不安や負担を<wbr>感じていませんか？</div>
        <p class="invite-tob__description mt-middle mb-0">
          私たちは少人数精鋭のプロ集団として、
          <span class="--emphasis">内装・外装デザイン、看板製作、店舗設計など、開業に必要なすべての工程をスムーズにサポート</span>いたします。<br>
          少人数体制だからこそ実現できる、柔軟で迅速な対応により、お客様一人ひとりのご要望に細やかにお応えします。<br>
          開業準備の不安を共に解消し、理想の店舗づくりを全力でお手伝いし、夢を確実に形にしてまいります。
        </p>
        <?php if ($has_link): ?>
          <a href="#" class="btn-block">事業内容</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>