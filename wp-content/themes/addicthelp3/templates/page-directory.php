<?php
/**
 * Template Name: Directory
 */
$page_id = get_the_ID(); ?>
<div class="wrap container" role="document">
    <main class="ah-main">
        <section class="ah-section ah-directory-main"
            <?= has_post_thumbnail($page_id)
                ? "style='background-image: url(" . get_the_post_thumbnail_url($page_id) . ")'"
                : '' ?>
        >
            <div class="ah-directory-main__container">
                <h1 class="ah-section__title ah-directory-main__title"><?php the_title() ?></h1>
            </div>
        </section>

        <?= get_template_part('partials/subscribe') ?>

        <section class="ah-section ah-directory-roadmap">
            <div class="grid-container">
                <h1 class="ah-section__title ah-directory-roadmap__title ah-title-decorated text-center">
                    <?php the_field('help_section_title', false, false) ?>
                </h1>
                <div class="ah-directory-roadmap__text">
                    <p class="ah-text-first-decorated">
                        <?php the_field('help_section_text', false, false) ?>
                    </p>
                </div>
            </div>
        </section>

        <section class="ah-section ah-section--triangle ah-directory-search text-center">
            <div class="ah-section__subtitle ah-directory-search__subtitle">
                <?php the_field('rehab_section_title', false, false) ?>
            </div>
            <div class="ah-directory-search__container">
                <h2 class="ah-section__title ah-directory-search__title">
                    <?php the_field('rehab_section_name', false, false) ?>
                </h2>
                <div class="ah-directory-search__text">
                    <?php the_field('rehab_section_text') ?>
                </div>
                <?= get_template_part('partials/states') ?>
            </div>
        </section>

        <section class="ah-section ah-directory-top">
            <div class="ah-directory-top__items">
                <?php $news_args = [
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'category_name' => 'rehab',
                    'orderby' => 'date',
                    'order' => 'DESC'
                ];
                $query = new WP_Query($news_args);
                if ($query->have_posts()):?>
                    <?php while ($query->have_posts()): $query->the_post(); ?>
                        <?= get_template_part('partials/post', 'horizontal') ?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </section>


        <section class="ah-section ah-directory-news">
            <div class="ah-directory-news__container">
                <h1 class="ah-section__title ah-directory-news__title">News</h1>
                <?php $news_args = [
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'category_name' => 'news',
                    'orderby' => 'date',
                    'order' => 'DESC'
                ];
                $query = new WP_Query($news_args);
                if ($query->have_posts()):?>
                    <div class="ah-directory-news__items">
                        <?php while ($query->have_posts()): $query->the_post(); ?>
                            <?= get_template_part('partials/post', 'vertical') ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </section>
        <?php if (is_active_sidebar('advert_widget_area')) {
            dynamic_sidebar('advert_widget_area');
        } ?>
    </main>
</div>
