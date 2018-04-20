<?php
/* 
=== Category to Pages WUD shortcodes===
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//

//Shortcode to show related posts and/or pages.
if(!function_exists('cattopage_wud_short_code_page_list')){
	function cattopage_wud_short_code_page_list($atts) {
		global $post;
		$max_posts = -1;
		$result = NULL;
		
		$standard_post = array('page','post');
		$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
		$post_typ = array_merge($standard_post, $custom_post_type);
				
		if (get_option('cattopage_wud_unique')==1){
			$taxo = "categories";
			$categories = get_the_terms( $post->ID, 'categories' );
			if(empty($categories)){	
				return;	
			}
			$category_id = $categories[0]->term_id;			
		}
		else{
			$taxo = "category";
			$categories = get_the_category();
			if(empty($categories)){	
				return;	
			}
			$category_id = $categories[0]->cat_ID;			
		}
		
		if(isset($atts["max"]) && $atts["max"]!='' ){			
			if(is_numeric($atts["max"]) && $atts["max"] > 0 && $atts["max"] < 50 && $atts["max"] == round($atts["max"], 0)){
				$max_posts = trim(filter_var($atts["max"], FILTER_SANITIZE_STRING));
			}
		}
		
		if(isset($atts["type"]) && $atts["type"]!='' ){
			if($atts["type"] == 'page'){
				$post_typ = array('page');
			}
			elseif($atts["type"] == 'post'){
				$post_typ = array('post');
			}
		}
		
		$related_args = array(
			'post_type' => $post_typ,
			'posts_per_page' => $max_posts,
			'post__not_in' => array($post->ID),
			'tax_query'		   => array(array('taxonomy'  => $taxo, 'field'  => 'term_id', 'terms' => $category_id,)),
		);
		$related = new WP_Query( $related_args );

		if( $related->have_posts() ) :
			$result .= "<div><h3>".get_option('cattopage_wud_widget_title3')."</h3>";
		while( $related->have_posts() ): $related->the_post(); 
			$result .= "<li><a href='" . esc_url( get_permalink() ) . "'>".get_the_title()."</a></li>";
		endwhile;
			$result .= "</div>";
		endif;		
		wp_reset_postdata();
		
			return $result;
	}
}
	
//Shortcode to show categories anywhere LIST
if(!function_exists('cattopage_wud_short_code_cat_list')){
	function cattopage_wud_short_code_cat_list($atts) {
		$ctp_show = "categories";
		if(get_option('cattopage_wud_unique')=="0"){
			$ctp_show = "category";
		}
		$ctp_title = get_option('cattopage_wud_widget_title1');
		$result = NULL;
		
		$standard_post = array('page','post');
		$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
		$post_typ = array_merge($standard_post, $custom_post_type);
		
		$categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC',
			'post_type' => $post_typ,
			'taxonomy' => $ctp_show
		) );
		$result .= "<strong>".$ctp_title."</strong><br>";
		if(!empty($categories)){
			foreach( $categories as $category ) {
				$result.= '<a href="'.get_option("home").'/categories/'.$category->slug.'" alt='.$category->name.'>'.$category->name.'</a>('. $category->count.')<br>';
			} 
		}
		return $result."<br><br>";
	}
}
//Shortcode to show categories anywhere DROP
if(!function_exists('cattopage_wud_short_code_cat_drop')){
	function cattopage_wud_short_code_cat_drop($atts) {
		$ctp_show = "categories";
		if(get_option('cattopage_wud_unique')=="0"){
			$ctp_show = "category";
		}	
		$ctp_title = get_option('cattopage_wud_widget_title1');
		$result = NULL;

		$standard_post = array('page','post');
		$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
		$post_typ = array_merge($standard_post, $custom_post_type);
		
		$result .= "<strong>".$ctp_title."</strong><br>";	
		$result .= '<select name="event-dropdown" onchange=\'document.location.href=this.options[this.selectedIndex].value;\'>'; 
			$categories = get_categories( array(
				'orderby' => 'name',
				'order'   => 'ASC',
				'post_type' => $post_typ,
				'taxonomy' => $ctp_show
			) ); 
			if(!empty($categories)){
				foreach ($categories as $category) {
					$result .= '<option value="'.get_option('home').'/categories/'.$category->slug.'">';
					$result .= $category->cat_name;
					$result .= ' ('.$category->category_count.')';
					$result .= '</option>';
				}
			}
		$result .= '</select>';
		return $result."<br><br>";
	}
}

//Shortcode to show tags anywhere LIST
if(!function_exists('cattopage_wud_short_code_tag_list')){
	function cattopage_wud_short_code_tag_list($atts) {
		$ctp_show = "tags";
		if(get_option('cattopage_wud_unique')=="0"){
			$ctp_show = "post_tag";
		}	
		$ctp_title = get_option('cattopage_wud_widget_title2');
		$result = NULL;

		$standard_post = array('page','post');
		$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
		$post_typ = array_merge($standard_post, $custom_post_type);
		
		$categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC',
			'post_type' => $post_typ,
			'taxonomy' => $ctp_show
		) );
		$result .= "<strong>".$ctp_title."</strong>";
		if(!empty($categories)){
			foreach( $categories as $category ) {
				$category_link = sprintf( 
					'<a href="%1$s" alt="%2$s">%3$s</a>',
					esc_url( get_category_link( $category->term_id ) ),
					esc_attr( sprintf( '%s', $category->name ) ),
					esc_html( $category->name )
				);		 
				$result .= '<br>' . sprintf( '%s', $category_link ) . ' ('. $category->count.') ';
			}
		}	 
		return $result."<br><br>";
	}
}

//Shortcode to show tags anywhere DROP
if(!function_exists('cattopage_wud_short_code_tag_drop')){
	function cattopage_wud_short_code_tag_drop($atts) {
		$ctp_show = "tags";
		if(get_option('cattopage_wud_unique')=="0"){
			$ctp_show = "post_tag";
		}	
		$ctp_title = get_option('cattopage_wud_widget_title2');
		$result = NULL;

		$standard_post = array('page','post');
		$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
		$post_typ = array_merge($standard_post, $custom_post_type);
		
		$result .= "<strong>".$ctp_title."</strong><br>";	
		$result .= '<select name="event-dropdown" onchange=\'document.location.href=this.options[this.selectedIndex].value;\'>'; 
			$categories = get_categories( array(
				'orderby' => 'name',
				'order'   => 'ASC',
				'post_type' => $post_typ,
				'taxonomy' => $ctp_show
			) ); 
			if(!empty($categories)){
				foreach ($categories as $category) {
					$result .= '<option value="'.get_option('home').'/tags/'.$category->slug.'">';
					$result .= $category->cat_name;
					$result .= ' ('.$category->category_count.')';
					$result .= '</option>';
				}
			}

		$result .= '</select>';
		return $result."<br><br>";	
	}
}

?>
