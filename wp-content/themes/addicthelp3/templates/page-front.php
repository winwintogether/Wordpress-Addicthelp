<?php
/**
 * Template Name: Front
 */
$page_id = get_the_ID(); ?>

<?php if (has_post_thumbnail($page_id)) :
?>
<section class="ah-homepage-featured">
    <div class="featured-image" style="background: url(<?=get_the_post_thumbnail_url($page_id);?>) no-repeat center top"></div>
</section>
<?php endif; ?>

<section class="ah-section ah-homepage-help">
    <div class="grid-container text-center">
        <h1 class="ah-section__title ah-homepage-help__title ah-title-decorated ah-title-decorated--black"><?php the_field( 'help_section_title' ) ?></h1>
        <div class="ah-homepage-help__text"><?php the_field( 'help_section_text' ) ?></div>
        <div class="items">
		    <?php if ( have_rows( 'helps' ) ) : ?>
			    <?php while ( have_rows( 'helps' ) ) : the_row() ?>
                    <div class="item">
					    <?php $linked_post = get_sub_field( 'linked_post' );
					    
					    $image = get_sub_field( 'image' );

					    $image_url  = $image['url'];
					    $image_size = 'help';
					    $thumb      = $image['sizes'][ $image_size ];
					    ?>
                        <img class="item__image" src="<?= $thumb ?>" alt="<?php the_sub_field( 'title' ); ?>"/>

                        <h5 class="item__title"><?php the_sub_field( 'title' ); ?></h5>
                        <a class="ah-readmore" href="<?= $linked_post ?>">Read more</a>
                    </div>
				    <?php wp_reset_postdata() ?>
			    <?php endwhile; ?>
		    <?php endif; ?>
        </div>
    </div>
</section>

<section class="ah-section ah-section--triangle ah-homepage-rehab text-center">
    <h2 class="ah-section__title ah-homepage-rehab__title"><?php the_field('rehab_section_title') ?></h2>
    <div class="grid-container">
        <p class="ah-homepage-rehab__name"><?php the_field('rehab_section_name') ?></p>
        <h3 class="ah-section__title ah-homepage-rehab__subtitle"><?php the_field('rehab_section_subtitle') ?></h3>
        <div class="ah-homepage-rehab__text"><?php the_field('rehab_section_text') ?></div>
        <div class="ah-select-state">
            <div class="ah-select-state__label">
                <label for="state">Select your State</label>
            </div>
            <div class="ah-select-state__dropdown">
               <form id="formContainer"><select class="states-mobile" name="menu1" onchange="window.location.href=this.value">
                <option selected="selected">-Select a state-</option>
                <option value="/rehabs/alabama-drug-alcohol-rehab-centers">Alabama</option>
                <option value="/rehabs/alaska-drug-alcohol-rehab-centers">Alaska</option>
                <option value="/rehabs/arizona-drug-alcohol-rehab-centers">Arizona</option>
                <option value="/rehabs/arkansas-drug-alcohol-rehab-centers">Arkansas</option>
                <option value="/rehabs/california-drug-alcohol-rehab-centers">California</option>
                <option value="/rehabs/colorado-drug-alcohol-rehab-centers">Colorado</option>
                <option value="/rehabs/connecticut-drug-alcohol-rehab-centers">Connecticut</option>
                <option value="/rehabs/delaware-drug-alcohol-rehab-centers">Delaware</option>
                <option value="/rehabs/florida-drug-alcohol-rehab-centers">Florida</option>
                <option value="/rehabs/georgia-drug-alcohol-rehab-centers">Georgia</option>
                <option value="/rehabs/hawaii-drug-alcohol-rehab-centers">Hawaii</option>
                <option value="/rehabs/idaho-drug-alcohol-rehab-centers">Idaho</option>
                <option value="/rehabs/illinois-drug-alcohol-rehab-centers">Illinois</option>
                <option value="/rehabs/indiana-drug-alcohol-rehab-centers">Indiana</option>
                <option value="/rehabs/iowa-drug-alcohol-rehab-centers">Iowa</option>
                <option value="/rehabs/kansas-drug-alcohol-rehab-centers">Kansas</option>
                <option value="/rehabs/kentucky-drug-alcohol-rehab-centers">Kentucky</option>
                <option value="/rehabs/louisiana-drug-alcohol-rehab-centers">Louisiana</option>
                <option value="/rehabs/maine-drug-alcohol-rehab-centers">Maine</option>
                <option value="/rehabs/maryland-drug-alcohol-rehab-centers">Maryland</option>
                <option value="/rehabs/massachusetts-drug-alcohol-rehab-centers/">Massachusetts</option>
                <option value="/rehabs/michigan-drug-alcohol-rehab-centers">Michigan</option>
                <option value="/rehabs/minnesota-drug-alcohol-rehab-centers">Minnesota</option>
                <option value="/rehabs/mississippi-drug-alcohol-rehab-centers">Mississippi</option>
                <option value="/rehabs/missouri-drug-alcohol-rehab-centers">Missouri</option>
                <option value="/states/montana-drug-alcohol-rehab-centers">Montana</option>
                <option value="/states/nebraska-drug-alcohol-rehab-centers">Nebraska</option>
                <option value="/states/nevada-drug-alcohol-rehab-centers">Nevada</option>
                <option value="/rehabs/new-hampshire-drug-alcohol-rehab-centers">New Hampshire</option>
                <option value="/states/new-jersey-drug-alcohol-rehab-centers">New Jersey</option>
                <option value="/states/new-mexico-drug-alcohol-rehab-centers">New Mexico</option>
                <option value="/states/new-york-drug-alcohol-rehab-centers">New York</option>
                <option value="/states/north-carolina-drug-alcohol-rehab-centers">North Carolina</option>
                <option value="/states/north-dakota-drug-alcohol-rehab-centers">North Dakota</option>
                <option value="/states/ohio-drug-alcohol-rehab-centers">Ohio</option>
                <option value="/states/oklahoma-drug-alcohol-rehab-centers">Oklahoma</option>
                <option value="/states/oregon-drug-alcohol-rehab-centers">Oregon</option>
                <option value="/states/pennsylvania-drug-alcohol-rehab-centers">Pennsylvania</option>
                <option value="/states/rhode-island-drug-alcohol-rehab-centers">Rhode Island</option>
                <option value="/states/south-carolina-drug-alcohol-rehab-centers">South Carolina</option>
                <option value="/states/south-dakota-drug-alcohol-rehab-centers">South Dakota</option>
                <option value="/states/tennessee-drug-alcohol-rehab-centers">Tennessee</option>
                <option value="/states/texas-drug-alcohol-rehab-centers">Texas</option>
                <option value="/states/utah-drug-alcohol-rehab-centers">Utah</option>
                <option value="/states/vermont-drug-alcohol-rehab-centers">Vermont</option>
                <option value="/states/virginia-drug-alcohol-rehab-centers">Virginia</option>
                <option value="/states/washington-drug-alcohol-rehab-centers">Washington</option>
                <option value="/states/west-virginia-drug-alcohol-rehab-centers">West Virginia</option>
                <option value="/rehabs/wisconsin-drug-alcohol-rehab-centers">Wisconsin</option>
                <option value="/states/wyoming-drug-alcohol-rehab-centers">Wyoming</option>
                </select></form>
            </div>
        </div>
    </div>
</section>

<section class="ah-section ah-homepage-top">
    <div class="grid-container">
            <?php if ( have_rows( 'top_rehab_pages' ) ) : ?>
                <div class="ah-homepage-top__posts">
                <?php while ( have_rows( 'top_rehab_pages' ) ) : the_row() ?>
                    <div class="post">
                        <?php $linked_post = get_sub_field( 'linked_post' );
                        $post              = $linked_post[0];
                        setup_postdata( $post );

                        $image = get_sub_field( 'image' );

                        $image_url  = $image['url'];
                        $image_size = 'help';
                        $thumb      = $image['sizes'][ $image_size ];
                        ?>
                        <div class="ah-homepage-top__image">
                        <img class="item__image" src="<?= $thumb ?>" alt="<?php the_sub_field( 'title' ); ?>"/>
                        </div>
                        <div class="ah-homepage-top__right">
                         <h4 class="ah-homepage-top__title"><?php the_sub_field( 'title' ); ?></h4>
                        <div class="ah-homepage-top__excerpt"><p><?php the_sub_field( 'description' ); ?></p> </div>
                        <a class="ah-readmore" href="<?php the_permalink(); ?>">Read more</a>
                        </div>
                    </div>
                    <?php wp_reset_postdata() ?>
                <?php endwhile; ?>
                </div>
            <?php endif; ?>

</div>
</section>

<section class="ah-section ah-section--triangle ah-homepage-recent">

    <div class="ah-homepage-recent__container">
    <?php get_template_part('yarpp-template', 'home'); ?>
    </div>
    <?php get_template_part('yarpp-template', 'home-carousel'); ?>
</section>

<section class="ah-section ah-section--divided ah-homepage-news">
    <div class="grid-container">
        <h2 class="ah-section__title ah-homepage-news__title">News</h2>
        <?php $news_args = [
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'category_name'  => 'news',
            'orderby'        => 'date',
            'order'          => 'DESC'
        ];
        $query           = new WP_Query($news_args);
        if ($query->have_posts()):?>
            <div class="ah-homepage-news__posts">
                <?php while ($query->have_posts()): $query->the_post(); ?>
                    <div class="ah-homepage-news__post">
                        <h4 class="ah-news__title"><?php the_title(); ?></h4>
                        <hr class="ah-news__underline"/>
                        <div class="ah-news__image-wrapper"><?php the_post_thumbnail('help'); ?></div>
                        <div class="ah-news__excerpt"><?php the_excerpt(); ?></div>
<!--                        <a class="ah-readmore" href="--><?php //the_permalink(); ?><!--">Read more</a>-->
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>

<section class="ah-section ah-homepage-add-rec">
    <div class="grid-container">
        <h2 class="ah-section__title ah-homepage-news__title">Addiction & Recovery</h2>
        <?php $add_rec_args = [
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'category_name'  => 'addiction, recovery',
            'orderby'        => 'date',
            'order'          => 'DESC'
        ];
        $query              = new WP_Query($add_rec_args);
        if ($query->have_posts()):?>
            <div class="ah-homepage-add-rec__posts align-stretch">
                <?php while ($query->have_posts()): $query->the_post(); ?>
                    <div class="ah-homepage-add-rec__post">
                        <a class="ah-add-rec__image-wrapper" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('help'); ?></a>
                        <div><?php the_excerpt(); ?></div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>

<section class="ah-section ah-section--triangle ah-homepage-contact">
    <div class="grid-container text-center">
        <div class="grid-x grid-margin-x align-center">
            <h2 class="ah-section__title ah-homepage-contact__title"><?php the_field('contact_section_title', $page_id) ?></h2>
            <div class="ah-homepage-contact__text"><?php the_field('contact_section_text',$page_id) ?></div>
            <div class="cell">
                <a class="ah-homepage-contact__link " href="<?php the_field('chat_link') ?>"><?php the_field('chat_link_text',$page_id) ?></a>
                <a class="ah-homepage-contact__link " href="<?php the_field('email_link') ?>"><?php the_field('email_link_text',$page_id) ?></a>
                <a class="ah-homepage-contact__link " href="<?php the_field('call_link') ?>"><?php the_field('call_link_text',$page_id) ?></a>
            </div>
        </div>
    </div>
</section>
