<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
 <?php get_search_form(); ?>
<?php endif; ?>
<div class="ah-article-main__container">
    <div class="ah-article-main__entry-content with-sidebar">
    	<div class="ah-related-posts">
    		<div class="ah-related-posts__items">
			<?php while (have_posts()) : the_post(); ?>
  				<?= get_template_part( 'partials/post', 'vertical' ) ?>
			<?php endwhile; ?>
		</div>
		</div>
	</div>
	<?= get_template_part( 'templates/sidebar' ) ?>
</div>

