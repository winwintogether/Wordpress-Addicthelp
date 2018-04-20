<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html   <?php language_attributes(); ?>>
  <!-- Target Browser Specific Style With JS -->
  <script>
    document.documentElement.setAttribute("data-browser", navigator.userAgent);
  </script>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <div class="wrap container" role="document">
        <?php if(is_front_page() || is_page_template('page-top25.php')) { ?>
        <main class="ah-main">
        <?php } else { ?>
         <main class="ah-article-main__container">
        <?php } ?>
          <?php include Wrapper\template_path(); ?>
          <?php if (Setup\display_sidebar()) : ?>
              <?php include Wrapper\sidebar_path(); ?>
             <?php endif; ?>
        </main>
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
     </body>
</html>
