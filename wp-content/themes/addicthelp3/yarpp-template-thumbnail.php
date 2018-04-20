<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>

<?php if (have_posts()): ?>
    <div class="ah-related__grid">
        <?php while (have_posts()) : the_post(); ?>
            <div class="ah-related align-stretch">
                <h4 class="ah-related__title"><?php the_title(); ?></h4>
                <div class="ah-related__image-wrapper"><?php the_post_thumbnail('help'); ?></div>
                <div class="ah-related__excerpt">
                    <?php echo excerpt(10); ?>

                </div>
                <!--                        <a class="ah-readmore" href="--><?php //the_permalink(); ?><!--">Read more</a>-->
            </div>
        <?php endwhile; ?>
    </div>
    <button class="ah-readmore ah-readmore--bordered ah-related__more">More</button>
<?php else: ?>
    <p>No related photos.</p>
<?php endif; ?>
