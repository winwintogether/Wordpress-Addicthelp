<?php if(is_page_template('page-top25.php')) { ?>
 <section class="ah-section ah-top25-map">
            <div id="map">
                <iframe src="<?php the_field('google_map_url',$page_id)?>"></iframe>
            </div>
 </section>
<?php } else {

} ?>
<footer class="ah-footer">
    <div class="grid-container">
        <div class="home ah-footer-container__logo-container with-divider text-center">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <img src="<?php echo bloginfo('template_directory') . '/dist/images/logo.png' ?>" alt="">
            </a>
        </div>
        <div class="ah-footer-container__social-button-wrapper">
            <div class="ah-footer-container__social-button-container">
                <a href="#" class="ah-footer-container__social-button-item link-facebook"></a>
            </div>
            <div class="ah-footer-container__social-button-container">
                <a href="#" class="ah-footer-container__social-button-item link-twitter"></a>
            </div>
            <div class="ah-footer-container__social-button-container">
                <a href="#" class="ah-footer-container__social-button-item link-linkedin"></a>
            </div>
            <div class="ah-footer-container__social-button-container">
                <a href="#" class="ah-footer-container__social-button-item link-youtube"></a>
            </div>

            <div  class="share-btn need-share-button-default"   data-share-position="topRight" data-share-share-button-class="custom-button">
                <div class="custom-button">share <img src="<?php echo bloginfo('template_directory') . '/dist/images/btn-share-icon.png' ?>" alt=""></div>
            </div>
        </div>

        <div class="ah-footer-container__grid-container">
            <div class="ah-footer-container__item">
                <div class="ah-footer-container__item--contacts">
                    <img class="scroll-top-arrow" src="<?php echo bloginfo('template_directory') . '/dist/images/arrow-top.jpg' ?>" alt="">
                    <a href="mailto:info@addicthelp.com"><?php the_field('support_email', 'option'); ?></a>
                    <div class="divider"></div>
                    <a class="phone" href="tel:<?php the_field('phone_number', 'option'); ?>"><?php the_field('phone_number', 'option'); ?></a>
                </div>
            </div>
            <div class="ah-footer-container__item">
                <div class="ah-footer-container__item--menu">
                    <span>&copy;AddictHelp <?= date('Y') ?></span>
                    <span class="ah-footer-container__item--menu--divider">//</span>
                    <a href="#">Legal</a>
                    <span class="ah-footer-container__item--menu--divider">//</span>
                    <a href="#">Privacy</a>
                    <span class="ah-footer-container__item--menu--divider">//</span>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>

        <div class="ah-footer-container__divider">
            <img src="<?php echo bloginfo('template_directory') . '/dist/images/dot-divider.png' ?>">
            </div>
    </div>
     <?= get_template_part('partials/subscribe') ?>

</footer>
