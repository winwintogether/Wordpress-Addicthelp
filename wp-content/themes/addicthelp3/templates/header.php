<header>
    <div class="title-bar" data-responsive-toggle="top-menu" data-hide-for="xxxlarge">
        <?php get_template_part('partials/menu-social'); ?>
        
        <div class="ah-menu-container">
            <div class="inner">
            <div class="ah-menu-container__item_start align-middle">
                    <div class="ah-menu-container__menu-icon-container">
                        <button class="menu-icon" type="button" data-toggle="offCanvas" aria-controls="offCanvas"></button>
                    </div>

                </div>
            <div class="ah-menu-container__item">
                    <div class="home ah-menu-container__logo-container text-center">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <img src="<?php echo bloginfo('template_directory') . '/dist/images/logo.png' ?>" alt="">
                        </a>
                    </div>
                </div>
            <div class="ah-menu-container__item_end align-middle links-container">
                   
                    <div class="ah-menu-container__social-button-container">
                        <a href="<?php the_field('facebook_link', 'option'); ?>" class="ah-menu-container__social-button-item link-facebook"></a>
                    </div>
                    <div class="ah-menu-container__social-button-container">
                        <a href="<?php the_field('twitter_link', 'option'); ?>" class="ah-menu-container__social-button-item link-twitter"></a>
                    </div>
                    <div class="ah-menu-container__social-button-container">
                        <a href="<?php the_field('google_plus_link', 'option'); ?>" class="ah-menu-container__social-button-item link-youtube"></a>
                    </div>
                 
                     <div class="ah-menu-container__social-button-container">
                        <a href="<?php the_field('pinterest_link', 'option'); ?>" class="ah-menu-container__social-button-item link-rss"></a>
                    </div>
                       <div class="ah-menu-container__social-button-container">
                        <a data-toggle="search-drop" href="#" class="ah-menu-container__social-button-item link-search"></a>
                    </div>
                    <div class="dropdown-pane top" id="search-drop" data-dropdown>
                        <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                        <div class="input-group search-drop">
                          
                          <input value="" name="s" id="s" class="input-group-field" type="search">
                          <div class="input-group-button">
                            <input type="submit" class="button secondary" value="Search">
                          </div>
                        
                        </div>
                        </form>
                        </div>
                </div>
        </div>
        </div>
    </div>
    <div class="off-canvas position-left menu-list-container" id="offCanvas" data-off-canvas>
        <div data-drilldown data-scroll-top="true">
            <div class="close-btn-container">
                <button class="close-button" aria-label="Close menu" type="button" data-close>
                    <span aria-hidden="true"><img src="<?php echo bloginfo('template_directory') . '/dist/images/switch_off.png' ?>" alt=""></span>
                </button>
            </div>
            <div class="menu-header">
                Begin Your Journey
            </div>
            <?php if (has_nav_menu('primary_navigation')) : ?>
                <?php wp_nav_menu([
                    'theme_location' => 'primary_navigation',
                    'container'      => false,
                    'menu_class'     => 'menu vertical drilldown',
                    'walker'         => new Roots\Sage\Extras\Custom_Menu_Walker()]); ?>
            <?php endif; ?>
        </div>
</header>


<?php if(is_single()) { ?>

<header class="ah-section ah-article-main"
             <?= has_post_thumbnail($page_id)
                ? "style='background-image: url(" . get_the_post_thumbnail_url($page_id) . ")'"
                : "style='background-image: url(" . get_bloginfo( 'stylesheet_directory' ) . "/dist/images/top_25_default.png)'" ?>
        >
            <div class="ah-article-main__header-container">
                <h1 class="ah-section__title ah-article-main__title"><?php the_title() ?></h1>
                <?php get_template_part('templates/single-entry-meta'); ?>
            </div>
</header>

<?php } elseif (is_front_page()) { ?>

<?php } elseif (is_home()) { ?>

<?php } elseif (is_page_template('page-top25.php')) { ?>

<section class="ah-section ah-top25-main"
            <?= has_post_thumbnail($page_id)
                ? "style='background-image: url(" . get_the_post_thumbnail_url($page_id) . ")'"
                : "style='background-image: url(" . get_bloginfo( 'stylesheet_directory' ) . "/dist/images/top_25_default.png)'" ?>
        >
            <div class="ah-top25-main__container">
                <div class="rectangle"></div>
                <h1>
                    <?php the_title() ?>
                </h1>
            </div>
</section>

<?php } elseif (is_page()) { ?>

<?php get_template_part('templates/page', 'header'); ?>

<?php } elseif (is_archive()) { ?>

 <section class="ah-section ah-recovery-main" style="background:url(
 <?php if( the_field('category_featured_image') ) { ?>
    <?php the_field('category_featured_image'); ?>
 <?php } else { ?>
    <?php echo get_bloginfo( 'stylesheet_directory' ) ?>/dist/images/archive_bg.png
 <?php  } ?>
 ) no-repeat center;background-size:cover;">
            <div class="ah-recovery-main__container">
                <h1 class="ah-section__title ah-recovery-main__title"><?php single_cat_title(); ?></h1>
            </div>
</section>

<?php get_template_part('partials/subscribe') ?>

<section class="ah-section less_space ah-recovery-recent">
    <div class="ah-recovery-recent__container">
        <?php get_template_part('yarpp-template', 'recent-category-post'); ?>
    </div>
            <?php get_template_part('yarpp-template', 'recent-carousel'); ?>
</section>

<?php
}else{
	get_template_part('templates/page', 'header');
}
?>

