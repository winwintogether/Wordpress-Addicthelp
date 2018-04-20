<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */

/**
 * Ajax Posts
 */

function category_more_post_ajax() {
	$ppp            = ( isset( $_POST["ppp"] ) ) ? $_POST["ppp"] : 9;
	$cat_id         = ( isset( $_POST['cat'] ) ) ? $_POST['cat'] : 0;
	$page           = ( isset( $_POST['pageNumber'] ) ) ? $_POST['pageNumber'] : 0;

	header( "Content-Type: text/html" );
	$args = [
		'post_type'      => array( 'post', 'page'),
		'posts_per_page' => $ppp,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'paged'            => $page,
		'cat' => $cat_id
	];

	$loop = new WP_Query( $args );
	$out  = '';
	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();

        $out .='<div class="ah-related-posts__item">
                <h2 class="ah-related-posts__item_title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>
                <hr>
                <div class="ah-related-posts__item_image">';

        if ( has_post_thumbnail() ) {
                 $out .=  '<a href="'. get_the_permalink().'">'.get_the_post_thumbnail("help-related").'</a>';
        } else {
                $out .= '<a href="'.get_the_permalink().'"><img src="'.get_bloginfo( "stylesheet_directory").'/dist/images/default_thumb.jpg"/></a>';
        }

        $out .= '</div>';
//                    <p>'.wp_trim_words( get_the_excerpt(), 20,"..." ).'</p>
        $out .= '     <a class="ah-readmore" href="'.get_the_permalink().'">Read More</a>
                </div>';

    endwhile;
	endif;
	wp_reset_postdata();
	echo $out;
	die();
}

add_action( 'wp_ajax_nopriv_category_more_post_ajax', 'category_more_post_ajax' );
add_action( 'wp_ajax_category_more_post_ajax', 'category_more_post_ajax' );

$sage_includes = [
    'lib/assets.php',    // Scripts and stylesheets
    'lib/extras.php',    // Custom functions
    'lib/setup.php',     // Theme setup
    'lib/titles.php',    // Page titles
    'lib/wrapper.php',   // Theme wrapper class
    'lib/customizer.php', // Theme customizer
];

function custom_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

foreach ($sage_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);
function format_comment($comment, $args, $depth) {
    
       $GLOBALS['comment'] = $comment; ?>
       
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
                
            <div class="comment-intro">
                <em>commented on</em> 
                <a class="comment-permalink" href="<?php echo htmlspecialchars ( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s'), get_comment_date(), get_comment_time()) ?></a>
                <em>by</em> 
                <?php printf(__('%s'), get_comment_author_link()) ?>
            </div>
            
            <?php if ($comment->comment_approved == '0') : ?>
                <em><php _e('Your comment is awaiting moderation.') ?></em><br />
            <?php endif; ?>
            
            <?php comment_text(); ?>
            
            <div class="reply">
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
        
<?php }

?>