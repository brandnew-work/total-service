    <?php get_template_part('components/common-cta', '', ['class' => 'py-middle bg-white has-border']) ?>

    <footer class="footer">
      <div class="inner">
        <a href="<?= home_url() ?>" class="footer__logo">
          <span class="footer__logo-label">滋賀県の店舗の新規開業・改装、自宅リフォーム</span>
          <span class="footer__logo-text">株式会社トータルサービス</span>
        </a>
        <div class="footer-nav-wrap">
          <?php
          wp_nav_menu(
            [
              'menu'            => 'footer-nav-left',
              'container'       => 'nav',
              'container_class' => 'footer-nav',
              'menu_class'      => 'footer-nav__list',
            ]
          );
          wp_nav_menu(
            [
              'menu'            => 'footer-nav-center',
              'container'       => 'nav',
              'container_class' => 'footer-nav',
              'menu_class'      => 'footer-nav__list',
            ]
          );
          wp_nav_menu(
            [
              'menu'            => 'footer-nav-right',
              'container'       => 'nav',
              'container_class' => 'footer-nav',
              'menu_class'      => 'footer-nav__list',
            ]
          );
          ?>
        </div>
        <div class="footer__copy">
          <small class="footer__copy-text">2025 © 株式会社トータルサービス</small>
        </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
    </body>

    </html>