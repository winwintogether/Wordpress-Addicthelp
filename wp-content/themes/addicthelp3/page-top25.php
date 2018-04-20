<?php
/**
 * Template Name: Top 25
 */
$page_id = get_the_ID(); ?>

<div class="wrap container" role="document">
        <section class="ah-section ah-top25-article">
            <h1 class="ah-section__title center">
                <?php the_field('main_sub_title', false, false) ?>
            </h1>
            <?php the_content() ?>
        </section>
        
        <section class="ah-section ah-top25-list">
            <div class="items">
                <?php $news_args = [
                    'post_type'      => 'rehab_center',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                ];
                $query = new WP_Query($news_args);
                if ($query->have_posts()):?>
                    <?php while ($query->have_posts()): $query->the_post(); ?>
                        <?= get_template_part('partials/rehab-center') ?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </section>

        <section class="ah-section ah-top25-article">
            <h1 class="ah-section__title">
                <?php the_field('help_section_title', false, false) ?>
            </h1>
            <p class="ah-text-first-decorated">
                <?php the_field('help_section_text') ?>
            </p>
        </section>


</div>
<div id="modal"> <!-- data-iziModal-fullscreen="true"  data-iziModal-title="Welcome"  data-iziModal-subtitle="Subtitle"  data-iziModal-icon="icon-home" -->
    <!-- Modal content -->
</div>
