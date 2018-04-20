<?php //get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates', 'header'); ?>

<div class="alert alert-warning">
  <?php _e('Oops, sorry, this page no longer is active.Try using search
(spyglass in the upper right corner) to locate your page\'s replacement.', 'sage'); ?>
</div>

<div class="search-form-404">
	<?php get_search_form(); ?>
</div>

