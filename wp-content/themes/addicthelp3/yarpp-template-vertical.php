<?php
/*
YARPP Template: Vertical
Author: mitcho (Michael Yoshitaka Erlewine)
Description: A vertical post YARPP template.
*/
?>
<div class="ah-related-posts">
    <div class="ah-related-posts__title">
        <h3>Related Posts</h3>
    </div>
    <?php if (have_posts()): ?>
        <div class="ah-related-posts__items">
            <?php while (have_posts()) : the_post(); ?>
                <?= get_template_part('partials/post', 'vertical') ?>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No related posts.</p>
    <?php endif; ?>
</div>

