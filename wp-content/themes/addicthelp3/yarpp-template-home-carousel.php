<?php
/*
YARPP Template: Random
Description: This template gives you a random other post in case there are no related posts
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>
<?php

$pagename = get_query_var('pagename');
$cat_id = get_queried_object_id();

$additional_args = [];
if ($pagename == 'recovery') {
    $additional_args = [
        'cat' => $cat_id
    ];
}
$main_args = [
    'post_type'      => array( 'post', 'page'),
    'posts_per_page' => 8,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'category_name' => 'featured',
    'post__not_in'  => array(PRIMARY_FEATURED_ID)
	];

$args      = array_merge($main_args, $additional_args);

$query = new WP_Query($args) ?>
<?php if ($query->have_posts()): ?>

    <div class="ah-recent-slider__wrapper">
        <div id="recent_slider" class="ah-recent-slider">
            <?php while ($query->have_posts()) :
                $query->the_post(); ?>
                
                <a class="ah-recent-slide" href="<?php the_permalink() ?>" rel="bookmark"
                   title="<?php the_title_attribute(); ?>">
                    <?php if ( has_post_thumbnail() ) { ?>
                    <?php the_post_thumbnail('slider'); ?>
                    <?php  } else { ?>
                    <img src="<?php echo get_bloginfo( 'stylesheet_directory' ) ?>/dist/images/slider-default.jpg" />
                    <?php } ?>

                    <h5 class="ah-recent-slide__title"><?php the_title(); ?></h5>
                </a>

            <?php endwhile; ?>
        </div>
        <a class="ah-recent-slider__arrow ah-recent-slider__arrow--prev" href="#"></a>
        <a class="ah-recent-slider__arrow ah-recent-slider__arrow--next" href="#"></a>
    </div>
<?php else:
    query_posts("orderby=rand&order=asc&limit=1");
    the_post(); ?>
    <p>No related posts were found, so here's a consolation prize: <a href="<?php the_permalink() ?>"
                                                                      rel="bookmark"><?php the_title(); ?></a>.</p>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
