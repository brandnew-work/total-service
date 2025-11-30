<?php
$h_tag = is_front_page() ? 'h1' : 'div';
?>

<header class="header">
  <div class="header__inner">
    <<?= $h_tag ?>>
      <a href="<?= home_url('') ?>" class="header-title">
        <img src="<?= get_theme_file_uri('/assets/logo.svg') ?>" alt="ロゴマーク" class="header-title__mark">
        <span class="header-title__label">滋賀県の店舗の新規開業・改装、自宅リフォーム</span>
        <span class="header-title__text">株式会社トータルサービス</span>
      </a>
    </<?= $h_tag ?>>
    <button class="header-nav__btn js-header-nav" aria-label="ナビを開く">
      <div class="header-nav__btn-burger">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </button>
    <div class="header-nav__wrap">
      <?php wp_nav_menu([
        'menu'            => 'header-nav',
        'container'       => 'nav',
        'container_class' => 'header-nav',
        'menu_class'      => 'header-nav__list',
      ]); ?>
      <div class="header__cta-wrap">
        <a href="<?= home_url('/contact/') ?>" class="header__cta --email">メール相談</a>
        <a href="#" target="_blank" rel="noopener noreferrer" class="header__cta --line">LINE相談</a>
      </div>
    </div>
  </div>
</header>