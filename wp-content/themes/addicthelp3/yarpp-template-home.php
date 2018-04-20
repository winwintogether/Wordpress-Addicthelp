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
    'posts_per_page' => 1,
    'offset'         => '1',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'category_name' => 'featured'
];
$args      = array_merge($main_args, $additional_args);
 $query = new WP_Query($args);
?>

<?php if ($query->have_posts()): ?>
    <div class="ah-recent-big">

        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <?php  define("PRIMARY_FEATURED_ID",get_the_ID() ); ?>
            <div class="ah-recent-big__image"><?php the_post_thumbnail('related-big'); ?></div>
            <div class="ah-recent-big__text">
                <h4 class="ah-recent-big__title"><?php the_title(); ?></h4>
                <div class="ah-recent-big__excerpt"><?php the_excerpt(); ?></div>
            </div>

        <?php endwhile; ?>

    </div>
<?php else:
    query_posts("orderby=rand&order=asc&limit=1");
    the_post(); ?>
    <p>No related posts were found, so here's a consolation prize: <a href="<?php the_permalink() ?>"
                                                                      rel="bookmark"><?php the_title(); ?></a>.</p>
<?php endif; ?>
<?php wp_reset_postdata(); ?>


