<?php
/*
Plugin Name: WP Categories Widget
Plugin URI: http://www.mrwebsolution.in/
Description: It's a very simple plugin to display category list in sidebar widget. You can define category list for your own custom taxonomy.
Author: MR Web Solution
Author URI: http://raghunathgurjar.wordpress.com
Version: 1.2
*/

/*  Copyright 2016-17  wp-categories-widget  (email : raghunath.0087@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**************************************************************
                START CLASSS WpCategoriesWidget 
**************************************************************/
class WpCategoriesWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'wp_categories_widget', // Base ID
			__( 'WP Categories list', 'mrwebsolution' ), // Name
			array( 'description' => esc_html__( 'The Taxonomy Category Widget', 'mrwebsolution' ), ) // Args
		);
		if(!is_admin())
		add_action('wcw_style',array($this,'wcw_style_func'));
		add_filter( "plugin_action_links_".plugin_basename( __FILE__ ), array(&$this,'wcw_add_settings_link') );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		$va_category_HTML ='<div class="ve-cat-widget-div">';
		if ( ! empty( $instance['wcw_title'] ) && !$instance['wcw_hide_title']) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['wcw_title'] ) . $args['after_title'];
		}
		// add css 		
		do_action('wcw_style','wcw_style_func');
		/** return category list */
		if($instance['wcw_taxonomy_type']){
			$va_category_HTML .='<ul class="ve-cat-widget-listing">';
				$args_val = array( 'hide_empty=0' );
				$terms = get_terms( $instance['wcw_taxonomy_type'], $args_val );
				if ( $terms ) {	
				$excludeCat= $instance['wcw_exclude_categories'] ? $instance['wcw_exclude_categories'] : '';
					foreach ( $terms as $term ) {
						
						$term_link = get_term_link( $term );
						if($excludeCat!='' && in_array($term->term_id,$excludeCat))
						{
							continue;
							}
						
						if ( is_wp_error( $term_link ) ) {
						continue;
						}
						
					$carrentActiveClass='';	
					
					if($term->taxonomy=='category' && is_category())
					{
					  $thisCat = get_category(get_query_var('cat'),false);
					  if($thisCat->term_id == $term->term_id)
						$carrentActiveClass='class="active-cat"';
				    }
					 
					if(is_tax())
					{
					    $currentTermType = get_query_var( 'taxonomy' );
					    $termId= get_queried_object()->term_id;
						 if(is_tax($currentTermType) && $termId==$term->term_id)
						  $carrentActiveClass='class="active-cat"';
					}
						
						$va_category_HTML .='<li '.$carrentActiveClass.'><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
						if (empty( $instance['wcw_hide_count'] )) {
						$va_category_HTML .='<span class="post-count">'.$term->count.'</span>';
						}
						$va_category_HTML .='</li>';
					}
				}
			$va_category_HTML .='</ul>';
			echo $va_category_HTML;
			}	
		$va_category_HTML .='</div>';
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$wcw_title 					= ! empty( $instance['wcw_title'] ) ? $instance['wcw_title'] : esc_html__( 'WP Categories', 'virtualemployee' );
		$wcw_hide_title 			= ! empty( $instance['wcw_hide_title'] ) ? $instance['wcw_hide_title'] : esc_html__( '', 'virtualemployee' );
		$wcw_taxonomy_type 			= ! empty( $instance['wcw_taxonomy_type'] ) ? $instance['wcw_taxonomy_type'] : esc_html__( '', 'virtualemployee' );
		$wcw_exclude_categories 	= ! empty( $instance['wcw_exclude_categories'] ) ? $instance['wcw_exclude_categories'] : esc_html__( '', 'virtualemployee' );
		$wcw_hide_count 			= ! empty( $instance['wcw_hide_count'] ) ? $instance['wcw_hide_count'] : esc_html__( '', 'virtualemployee' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'wcw_title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wcw_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wcw_title' ) ); ?>" type="text" value="<?php echo esc_attr( $wcw_title ); ?>">
		</p>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wcw_hide_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wcw_hide_title' ) ); ?>" type="checkbox" value="1" <?php checked( $wcw_hide_title, 1 ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id( 'wcw_hide_title' ) ); ?>"><?php _e( esc_attr( 'Hide Title' ) ); ?> </label> 
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'wcw_taxonomy_type' ) ); ?>"><?php _e( esc_attr( 'Taxonomy Type:' ) ); ?></label> 
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wcw_taxonomy_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wcw_taxonomy_type' ) ); ?>">
					<?php 
					$args = array(
					  'public'   => true,
					  '_builtin' => false
					  
					); 
					$output = 'names'; // or objects
					$operator = 'and'; // 'and' or 'or'
					$taxonomies = get_taxonomies( $args, $output, $operator ); 
					array_push($taxonomies,'category');
					if ( $taxonomies ) {
					foreach ( $taxonomies as $taxonomy ) {

						echo '<option value="'.$taxonomy.'" '.selected($taxonomy,$wcw_taxonomy_type).'>'.$taxonomy.'</option>';
					}
					}

				?>    
		</select>
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'wcw_exclude_categories' ) ); ?>"><?php _e( esc_attr( 'Exclude Category:' ) ); ?></label> 
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wcw_exclude_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wcw_exclude_categories' ) ); ?>[]" multiple>
					<?php 			
					if($wcw_taxonomy_type){
					$args = array( 'hide_empty=0' );
					$terms = get_terms( $wcw_taxonomy_type, $args );
			        echo '<option value="" '.selected(true, in_array('',$wcw_exclude_categories), false).'>None</option>';
					if ( $terms ) {
					foreach ( $terms as $term ) {
						echo '<option value="'.$term->term_id.'" '.selected(true, in_array($term->term_id,$wcw_exclude_categories), false).'>'.$term->name.'</option>';
					}
				    	
					}
				}

				?>    
		</select>
		</p>
		<p>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wcw_hide_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wcw_hide_count' ) ); ?>" type="checkbox" value="1" <?php checked( $wcw_hide_count, 1 ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id( 'wcw_hide_count' ) ); ?>"><?php _e( esc_attr( 'Hide Count' ) ); ?> </label> 
		</p>
		<p><a href="mailto:raghunath.0087@gmail.com">Contact to Author</a></p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['wcw_title'] 					= ( ! empty( $new_instance['wcw_title'] ) ) ? strip_tags( $new_instance['wcw_title'] ) : '';
		$instance['wcw_hide_title'] 			= ( ! empty( $new_instance['wcw_hide_title'] ) ) ? strip_tags( $new_instance['wcw_hide_title'] ) : '';
		$instance['wcw_taxonomy_type'] 			= ( ! empty( $new_instance['wcw_taxonomy_type'] ) ) ? strip_tags( $new_instance['wcw_taxonomy_type'] ) : '';
		$instance['wcw_exclude_categories'] 	= ( ! empty( $new_instance['wcw_exclude_categories'] ) ) ? $new_instance['wcw_exclude_categories'] : '';
		$instance['wcw_hide_count'] 			= ( ! empty( $new_instance['wcw_hide_count'] ) ) ? strip_tags( $new_instance['wcw_hide_count'] ) : '';
		return $instance;
	}
	/** plugin CSS **/
	function wcw_style_func_css()
	{
		$style='<style type="text/css">/* start wp categories widget CSS */.widget_wp_categories_widget{background:#fff; position:relative;}.wp_categories_widget h2{color:#4a5f6d;font-size:24px;font-weight:400;margin:0 0 25px;line-height:24px;text-transform:uppercase}.ve-cat-widget-div ul.ve-cat-widget-listing li{font-size:16px;line-height:1;padding:20px 30px 0px 0;margin:0px;border-bottom:1px dashed #f0f0f0;position:relative;list-style-type:none}.ve-cat-widget-div ul.ve-cat-widget-listing li:last-child{border:none;}.ve-cat-widget-div ul.ve-cat-widget-listing li a{display:inline-block;color:#007acc;transition:all .5s ease;-webkit-transition:all .5s ease;-ms-transition:all .5s ease;-moz-transition:all .5s ease}.ve-cat-widget-div ul.ve-cat-widget-listing li a:hover,.ve-cat-widget-div ul.ve-cat-widget-listing li.active-cat a,.ve-cat-widget-div ul.ve-cat-widget-listing li.active-cat span.post-count{color:#ee546c}.ve-cat-widget-div ul.ve-cat-widget-listing li span.post-count{position:absolute;height:34px;min-width:35px;text-align:center;background:#fff;right:0;color:#605f5f;padding:8px 5px;line-height:20px;border-radius:5px;box-shadow:inset 2px 1px 3px rgba(0, 122, 204,.2);top:-2px}/* End category widget CSS*/</style>';
	echo $style;
	}
	function wcw_style_func()
	{
		add_action('wp_footer',array($this,'wcw_style_func_css'));
	}
	/** updtate plugins links using hooks**/
	// Add settings link to plugin list page in admin
	function wcw_add_settings_link( $links ) {
		$settings_link = '<a href="widgets.php">' . __( 'Settings Widget', 'mrwebsolution' ) . '</a> | <a href="mailto:raghunath.0087@gmail.com">' . __( 'Contact to Author', 'mrwebsolution' ) . '</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}
}// class WpCategoriesWidget

// register WpCategoriesWidget widget
function register_wp_categories_widget() {
    register_widget( 'WpCategoriesWidget' );
}
add_action( 'widgets_init', 'register_wp_categories_widget'); 
/**************************************************************
                END CLASSS WpCategoriesWidget 
**************************************************************/
