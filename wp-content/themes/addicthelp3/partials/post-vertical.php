<div class="ah-related-posts__item">
    <h2 class="ah-related-posts__item_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <hr>
    <div class="ah-related-posts__item_image">
    	<?php if ( has_post_thumbnail() ) { ?>
    	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('help-related'); ?></a>
	<?php  } else { ?>
    <a href="<?php the_permalink(); ?>"><img src="<?php echo get_bloginfo( 'stylesheet_directory' ) ?>/dist/images/default_thumb.jpg" /></a>
	<?php } ?>
     </div>
<!--     <p>--><?php //echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?><!--</p>-->
     <a class="ah-readmore" href="<?php the_permalink(); ?>">Read More</a>
</div>