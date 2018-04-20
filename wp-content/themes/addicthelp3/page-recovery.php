<?php
$page_id = get_the_ID(); ?>
<div class="wrap container" role="document">
    <main class="ah-main">
        <section class="ah-section ah-recovery-main"
            <?= has_post_thumbnail($page_id)
                ? "style='background-image: url(" . get_the_post_thumbnail_url($page_id) . ")'"
                : '' ?>
        >
            <div class="ah-recovery-main__container">
                <h1 class="ah-section__title ah-recovery-main__title">Recovery</h1>
            </div>
        </section>

        <?php get_template_part('partials/subscribe') ?>

        <section class="ah-section ah-recovery-recent">
            <div class="ah-recovery-recent__container">
                <?php get_template_part('yarpp-template', 'recent-category-post'); ?>
            </div>
            <?php get_template_part('yarpp-template', 'recent-carousel'); ?>
        </section>

        <section class="ah-section ah-recovery-related">
            <div class="ah-recovery-related__decoration"></div>
            <div class="ah-recovery-related__container">
                <h2 class="ah-section__title ah-recovery-related__title">Related Posts</h2>
                <?php related_posts() ?>
                <?= get_template_part('templates/sidebar') ?>
            </div>
        </section>
        <?php if (is_active_sidebar('advert_widget_area')) {
            dynamic_sidebar('advert_widget_area');
        } ?>
    </main>
</div>
