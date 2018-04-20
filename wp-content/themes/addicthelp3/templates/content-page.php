    <article <?php post_class('ah-article-main__entry-content with-sidebar'); ?>>
    			<?php get_template_part('templates/entry-meta'); ?>
    			<h1 class="main-title"><?php the_title(); ?></h1>
                <?php the_content(); ?>
                <?php related_posts(); ?>
                <?php comments_template('/templates/comments.php'); ?>
    </article>