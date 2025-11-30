<?php
get_header();

$faqs = get_faqs();
?>

<main>
  <article>

    <section class="py-x-high">
      <div class="inner">
        <div class="faq-labels">
          <?php foreach ($faqs as $id => $item): ?>
            <a href="#<?= $id; ?>" class="faq-label btn-block --bottom"><?= $item['label']; ?></a>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="inner --narrow">
        <?php foreach ($faqs as $id => $item): ?>
          <div id="<?= $id; ?>" class="faq-row">
            <h2 class="faq-row__title"><?= $item['label']; ?></h2>
            <?php get_template_part('components/faq-list', '', ['category' => $id]); ?>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

  </article>
</main>

<?php get_footer(); ?>