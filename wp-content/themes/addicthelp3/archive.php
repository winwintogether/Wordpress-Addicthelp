<section class="ah-section even_less_space ah-recovery-related">
    <div class="ah-recovery-related__decoration"></div>
    <div class="ah-recovery-related__container">
        <h2 class="ah-section__title ah-recovery-related__title">Articles</h2>
    </div>
</section>
<section class="ah-section">
<?php if (category_description()) {
    echo category_description();
} ?>
</section>

<?php
$cat_id = get_queried_object_id();
$args = [
	'post_type'      => array( 'post', 'page'),
	'posts_per_page' => 9,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'cat' => $cat_id
];
$query = new WP_Query($args)

?>

<div class="ah-article-main__container">
    <div class="ah-article-main__entry-content with-sidebar">

        <div  class="ah-related-posts">
			<?php if ( $query->have_posts() ): ?>
                <div id="archive_posts_content" class="ah-related-posts__items">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<?= get_template_part( 'partials/post', 'vertical' ) ?>
					<?php endwhile; ?>
                </div>
			<?php else: ?>
                <p>No related posts.</p>
			<?php endif; ?>
        </div>
        <div class="load-more">
            <a href="#" id="btn_category_load_more" cat-id="<?=$cat_id?>">
                <span class="ajax-loading">
                    <div class="circleG_1 circleG"></div>
                    <div class="circleG_2 circleG"></div>
                    <div class="circleG_3 circleG"></div>
                </span>
                Load More
            </a>
        </div>
    </div>
        <?= get_template_part( 'templates/sidebar' ) ?>
</div>
<?php if ( is_active_sidebar( 'advert_widget_area' ) ) {
	dynamic_sidebar( 'advert_widget_area' );
} ?>