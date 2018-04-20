<?php use Roots\Sage\Titles; ?>

<?php
$current_cat = get_the_category();
$cat_name    = $current_cat[0]->slug;

$back_url = '';

if ( has_post_thumbnail( $page_id ) ) {
	$back_url = get_the_post_thumbnail_url( $page_id );
} else {
	switch ( $cat_name ) {
		case 'rehab':
			$back_url = get_bloginfo( 'stylesheet_directory' ) . "/dist/images/rehab-default.jpg";
			break;
		default;
			$back_url = get_bloginfo( 'stylesheet_directory' ) . "/dist/images/top_25_default.png";
			break;
	}
}
?>

<header class="ah-section ah-article-main" style="background-image: url(<?= $back_url ?>)">
</header>
<div class="breadcrumbs">
    <div class="inner">

		<?php
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			?>
            <p id="breadcrumbs">
                <a href="<?= site_url() ?>" rel="v:url" property="v:title">Home</a>
                » <?php the_title();?>
            </p>
			<?php
		}
		?>
    </div>
</div>