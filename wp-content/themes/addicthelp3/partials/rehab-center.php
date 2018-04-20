<div class="item">
    <div class="image">

        <img src="
        <?= has_post_thumbnail() ? get_the_post_thumbnail_url() : bloginfo('template_directory'). '/dist/images/placeholder.png'?>"
             class="attachment-help size-help wp-post-image">
    </div>
    <div class="block">
        <?php if( get_field('video_id') ): ?>
        <a href="https://www.youtube.com/embed/<?php the_field('video_id', false, false) ?>?autoplay=1 " class="btn-play"></a>
        <?php endif; ?>
        <h2><?php the_title() ?></h2>
        <h4><?php the_field('sub_title', false, false) ?></h4>
        <p>
            <?php the_field('excerpt', false, false) ?>
        </p>
        <a href="<?= get_post_permalink()?>" class="ah-readmore">Read more</a>

        <div class="block-bottom">
            <div class="btn-container">
<!--                <a href="#" class="btn-share">Share</a>-->
                <div  class="share-btn need-share-button-default"   data-share-position="topCenter" data-share-share-button-class="custom-button">
                    <div class="custom-button">share <img src="<?php echo bloginfo('template_directory') . '/dist/images/btn-share-icon.png' ?>" alt=""></div>
                </div>
            </div>
            <div class="btn-container">
                <a href="<?php the_field('website_url', false, false) ?>" class="btn-site">Website</a>
            </div>
        </div>
    </div>
</div>

