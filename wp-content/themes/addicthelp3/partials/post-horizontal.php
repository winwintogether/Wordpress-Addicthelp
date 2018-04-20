<div class="ah-directory-top__item">
    <div class="ah-directory-top__item_image">
        <div class="ah-directory-top__image">
            <?php the_post_thumbnail('help',
                ['class' => 'attachment-help size-help wp-post-image']);
            ?>
        </div>
    </div>
    <div class="ah-directory-top__item_description text-left">
        <h4 class="ah-directory-top__title"><?php the_title(); ?></h4>
        <div class="ah-directory-top__excerpt">
            <p><?php the_excerpt(); ?></p>
        </div>
    </div>
</div>