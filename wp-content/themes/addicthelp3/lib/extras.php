<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class( $classes ) {
	// Add page slug if it doesn't exist
	if ( is_single() || is_page() && ! is_front_page() ) {
		if ( ! in_array( basename( get_permalink() ), $classes ) ) {
			$classes[] = basename( get_permalink() );
		}
	}

	// Add class if sidebar is active
	if ( Setup\display_sidebar() ) {
		$classes[] = 'sidebar-primary';
	}

	return $classes;
}

add_filter( 'body_class', __NAMESPACE__ . '\\body_class' );

/**
 * Function adds "Read more" button to all excerpts
 *
 * @param $output
 *
 * @return string
 */
function ah_excerpt_read_more_link( $output ) {
	global $post;
	$result = str_replace( '[&hellip;]', '&hellip;', $output );

	return $result . ' <a href="' . get_permalink( $post->ID ) . '" class="ah-readmore ah-readmore--bordered" title="Read More">Read More</a>';
}

add_filter( 'the_excerpt', __NAMESPACE__ . '\\ah_excerpt_read_more_link' );

/**
 * Create widget area for advertisement on the main page
 * Name: Advertisement
 * Id for usage: advert_widget_area
 */
function ah_widgets_init() {
	register_sidebar( [
		'name'          => 'Advertisement',
		'id'            => 'advert_widget_area',
		'before_widget' => '<section class="ah-section ah-section--divided ah-directory-advert">
                <div class="ah-directory-advert__container">
                    <div class="ah-directory-advert__block">',
		'after_widget'  => '</div>
             </div>
             </section>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	] );
}

add_action( 'widgets_init', __NAMESPACE__ . '\\ah_widgets_init' );

/**
 * Create widget area for recovery page sidebar
 * Name: Recovery Sidebar
 * Id for usage: recovery_sidebar_widget_area
 */
function ah_recovery_sidebar_widgets_init() {
	register_sidebar( [
		'name'          => 'Recovery Sidebar',
		'id'            => 'recovery_sidebar_widget_area',
		'before_widget' => '<div class="ah-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="ah-widget__title">',
		'after_title'   => '</h2>',
	] );
}

add_action( 'widgets_init', __NAMESPACE__ . '\\ah_recovery_sidebar_widgets_init' );

function load_template_part( $template_name, $part_name = null ) {
	ob_start();
	get_template_part( $template_name, $part_name );
	$var = ob_get_contents();
	ob_end_clean();

	return $var;
}

class Custom_Menu_Walker extends \Walker_Nav_Menu {
	private $show_parent_title = false;
	private $previousTitle = '';

	function start_lvl( &$output, $depth = 0, $args = [] ) {
		$indent                  = str_repeat( "\t", $depth );
		$this->show_parent_title = true;
		$output                  .= "\n$indent<ul class=\"menu vertical nested \" data-scroll-top=\"false\"> $indent\n";
	}

	public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes   = empty( $item->classes ) ? [] : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		if ( $this->show_parent_title ) {
			$output .= '<div class="menu-list-container--parent-title">' . $this->previousTitle . '</div>';
		}
		$this->show_parent_title = false;
		$output                  .= $indent . '<li' . $id . $class_names . '>';

		$atts           = [];
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value      = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output              .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		$this->previousTitle = $title;
	}

	function end_lvl( &$output, $depth = 0, $args = [] ) {
		if ( 0 == $depth ) {
			$output .= load_template_part( 'partials/menu-social' );;
		}

		$indent = str_repeat( "\t", $depth );
		$output .= "{$indent}</ul>\n";
	}
}

/*
* Function adds a new post type
*/
function rehab_center_post_type() {
	$labels = [
		'name'               => 'Rehab center',
		'singular_name'      => 'Rehab center',
		'menu_name'          => 'Rehab centers',
		'parent_item_colon'  => 'Parent rehab center',
		'all_items'          => 'All rehab centers',
		'view_item'          => 'View rehab center',
		'add_new_item'       => 'Add new rehab center',
		'add_new'            => 'Add New',
		'edit_item'          => 'Edit rehab center',
		'update_item'        => 'Update rehab center',
		'search_items'       => 'Search rehab center',
		'not_found'          => 'Not Found',
		'not_found_in_trash' => 'Not found in Trash',
	];

	$args = [
		'label'               => 'Rehab center',
		'description'         => 'Rehab centers',
		'labels'              => $labels,
		'supports'            => [
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'comments',
			'revisions',
			'custom-fields',
			'page-attributes',
			'post-formats'
		],
		'taxonomies'          => [ 'genres', 'categories' ],
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	];

	register_post_type( 'rehab_center', $args );
}

add_action( 'init', __NAMESPACE__ . '\\rehab_center_post_type', 0 );


/**
 * Adds custom script
 *
 */
function my_custom_js() {
	$centers = get_field( 'centers', false );
	if ( strpos( get_page_template(), 'page-top25.php' ) >= 0 ) {
		$js = 'function getFeatures(){
        var features = [';

		if ( ! empty( $centers ) ):
			foreach ( $centers as $center ) {
				// vars
				$lat = $center['lat'];
				$lng = $center['lng'];
				$js  .= "{
                            position: new google.maps.LatLng($lat, $lng),
                            type: 'info'
                        },";
			}
		endif;
		$js .= "];
        return features;
        }
        ";
		echo '<script type="text/javascript">' . $js . '</script>';
	}
}

add_action( 'wp_head', __NAMESPACE__ . '\\my_custom_js' );

/**
 * Adds Google Map to page with template top25
 */
function build_js_rehab_center() {
	if ( strpos( get_page_template(), 'page-top25.php' ) !== false ) {
		wp_enqueue_script( 'rehab_center_map',
			'https://maps.googleapis.com/maps/api/js?key=AIzaSyDvnHma16VRLp2TU6vwwT51KUNRF_Dqj6k&callback=initTop25Map',
			'main', false, true );
	}
}

// add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\build_js_rehab_center', 20, 1);

/**
 * Filters just the rehab_center_map
 */
add_filter( 'script_loader_tag', __NAMESPACE__ . '\\regal_tag', 10, 3 );
function regal_tag( $tag, $handle, $src ) {
	if ( $handle !== 'rehab_center_map' ) {
		return $tag;
	}

	return "<script src='$src' async defer></script>";
}

function categories_postcount_filter( $variable ) {
	$variable = str_replace( '</a> (', '</a>', $variable );
	$variable = str_replace( ')', '', $variable );

	return $variable;
}

add_filter( 'wp_list_categories', __NAMESPACE__ . '\\categories_postcount_filter' );

/**
 * Functionality creates new widget
 */
function wpb_load_widget() {
	register_widget( __NAMESPACE__ . '\\News_posts_widget' );
}

add_action( 'widgets_init', __NAMESPACE__ . '\\wpb_load_widget' );


class News_posts_widget extends \WP_Widget {

	public $news_slug_array = array(
		"addiction-news"    => "addiction_news_title",
		"alcohol-news"      => "alcohol_news_title",
		"marijuana-news"    => "marijuana_news_title",
		"prescription-news" => "prescription_news_title",
		"psychology-news"   => "psychology_news_title",
		"college-news"      => "college_news_title"
	);

	public $news_title_array = array(
		"addiction_news_title"    => "Addiction News",
		"alcohol_news_title"      => "Alcohol News",
		"marijuana_news_title"    => "Marijuana News",
		"prescription_news_title" => "Prescription News",
		"psychology_news_title"   => "Psychology News",
		"college_news_title"      => "College News"
	);

	function __construct() {
		parent::__construct(
			'news_posts_widget',
			"Custom news posts widget",
			[ 'description' => 'Custom widget for news posts', ]
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo "<div class=\"ah-widget-news__title\"><h3>" . $title . "</h3></div>";
		}

		echo "<div class='accordion' data-accordion data-allow-all-closed=\"true\">";

		foreach ( $this->news_slug_array as $news_slug => $news_title ) {
			echo "<div class='accordion-item' data-accordion-item>";
			echo '<a href="#">';
			if ( ! empty( $news_title ) ) {
				echo "<div class=\"ah-widget-news__sub-title \" ><h4>" . $instance[$news_title] . "</h4><div class='ah-widget-news__arrow'><div class='ah-widget-news__arrow-item'>></div></div></div>";
			}
			echo '</a>';
			$news_args = [
				'post_type'      => 'post',
				'posts_per_page' => 3,
				'category_name'  => $news_slug,
				'orderby'        => 'date',
				'order'          => 'DESC'
			];
			$query      = new \WP_Query( $news_args );
			if ( $query->have_posts() ):
				echo "<div class=\"ah-widget-news__posts accordion-content\" data-tab-content>";
				while ( $query->have_posts() ): $query->the_post();
					$post = get_post();
					echo "<div class=\"ah-widget-news__post\">";
					echo "<div class=\"ah-widget-news__image-wrapper\"><img src='" . get_the_post_thumbnail_url() . "'></div>";
					echo "<div class=\"ah-widget-news__content\">";
					echo "<a href='" . get_permalink() . "'>";
					echo "<h4 class=\"ah-widget-news__post-title\">" . get_the_title() . "</h4>";
					echo "</a>";
					echo "<div class=\"ah-widget-news__excerpt\">" . ( ! empty( $post->post_excerpt ) ? $post->post_excerpt : '' ) . "</div>";
					echo "</div>";
					echo "</div>";
				endwhile;
				echo "</div>";
			endif;
			echo "</div>";
			wp_reset_postdata();
		}

		echo "</div>";
		echo $args['after_widget'];
	}

	public function form( $instance ) {

		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = 'New title';
		}
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"/>
        </p>

		<?php
		foreach ( $this->news_title_array as $news_title => $news_default_value ) {
			if ( isset( $instance[ $news_title ] ) ) {
				$subTitle = $instance[ $news_title ];
			} else {
				$subTitle = $news_default_value;
			}
			?>

            <p>
                <label for="<?php echo $this->get_field_id( $news_title ); ?>"><?php _e( $news_default_value . ' Title:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( $news_title ); ?>"
                       name="<?php echo $this->get_field_name( $news_title ); ?>" type="text"
                       value="<?php echo esc_attr( $subTitle ); ?>"/>
            </p>

		<?php }
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = [];
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->news_title_array as $news_title => $news_default_value ) {
			$instance[ $news_title ] = ( ! empty( $new_instance[ $news_title ] ) ) ? strip_tags( $new_instance[ $news_title ] ) : '';
		}

		return $instance;
	}
}

