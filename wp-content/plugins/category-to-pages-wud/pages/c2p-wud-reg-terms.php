<?php
/* 
=== Category to Pages WUD Register the Terms===
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//

	
//-> Register the category and tag to post and pages ONLY if cattopage_wud_unique = 0
if(!function_exists('cattopage_wud_reg_cat_tag')){
	function cattopage_wud_reg_cat_tag(){ 
		$activated = 0;
		$cattopage_wud_tag = get_option('cattopage_wud_tag');
		$cattopage_wud_cat = get_option('cattopage_wud_cat');
		if( !empty($cattopage_wud_tag) ){
			register_taxonomy_for_object_type('post_tag', $cattopage_wud_tag);
			$activated = 1;
		}
		if( !empty($cattopage_wud_cat) ){	
			register_taxonomy_for_object_type('category', $cattopage_wud_cat);
			$activated = 1;
		}
		return $activated;
	}
}

//-> Use the post and page as post_type  ONLY if cattopage_wud_unique = 0
if(!function_exists('cattopage_wud_cat_tag_archives')){
	function cattopage_wud_cat_tag_archives( $query ) {
		$cattopage_wud_tag = get_option('cattopage_wud_tag');
		$cattopage_wud_cat = get_option('cattopage_wud_cat');		
			$my_cat_array = array('post',$cattopage_wud_cat);
			$my_tag_array = array('post',$cattopage_wud_tag);
		
	// Category post_type to post and page 
	 if ( ($query->get( 'category_name' ) || $query->get( 'cat' )) && !empty($my_cat_array) ){
		$query->set( 'post_type', $my_cat_array );
	 }

	// Tag post_type to post and page
	 if ( $query->get( 'tag' ) && !empty($my_tag_array) ){
		$query->set( 'post_type', $my_tag_array );
	 }
	}
}
	
//-> Get page URL by category or categories when permalink is set to /%category%/%postname%/
if(!function_exists('cattopage_wud_custom_urls')){
	function cattopage_wud_custom_urls( $url, $post ){
			$permalink = get_option('permalink_structure');
			//If no permalink structure or its admin panel, return the original URL
			if($permalink !== "/%category%/%postname%/"){
				return $url;
			}		
			$my_cat= NULL;
			$wud_post = get_post( $post );
			$post_type = $wud_post->post_type;
			$replace = $wud_post->post_name;
			//Only pages
			if($post_type=="page"){
				//Original WP category
				if(get_option('cattopage_wud_unique')=="0"){
					$terms = wp_get_post_terms( $wud_post->ID, 'category');
						if($terms){
						//If sub from categories, search parent
						if($terms[0]->parent !== 0){				
							$my_cat_nr= $terms[0]->parent.'/';
							$my_cat_id=get_term_by('id', $my_cat_nr, 'category');						
							$my_cat=$my_cat_id->slug.'/';
						}
						else{
							$my_cat= $terms[0]->slug.'/';
						}
					}			
				}	   
			}
			//If the URL haves already a category
			if (strpos($url, $my_cat) !== false) {
				return $url;
			} 
			if(get_option('cattopage_wud_hardcoded')=="1"){		
				$url = str_replace($wud_post->post_name, $my_cat.$replace, $url );
			}
			else{
				$url= site_url().'/'.$my_cat.$wud_post->post_name.'/';
			}
			return $url;
	}
}

//-> Register the unique category and tag to pages ONLY if cattopage_wud_unique = 1
// UNIQUE CATEGORIES
if(!function_exists('wud_custom_cats')){
	function wud_custom_cats() {
	 if(get_option('cattopage_wud_cat')=="page"){	 
	  $labels = array(
		'name' => _x( 'Page Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Page Categories' ),
		'all_items' => __( 'All Page Categories' ),
		'parent_item' => __( 'Parent Page Category' ),
		'parent_item_colon' => __( 'Parent Page Category:' ),
		'edit_item' => __( 'Edit Page Category' ), 
		'update_item' => __( 'Update Page Category' ),
		'add_new_item' => __( 'Add New Page Category' ),
		'new_item_name' => __( 'New Page Category Name' ),
		'menu_name' => __( 'Page Categories' ),
	  ); 	

	  $args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'public' => true,
		'show_admin_column' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'categories', 'with_front' => false)
	  );
	  register_taxonomy('categories',array('page'),$args);
	  
	 }
	}
}

// UNIQUE TAGS
if(!function_exists('wud_custom_tags')){
	function wud_custom_tags() {
	 if(get_option('cattopage_wud_tag')=="page"){ 
	  $labels = array(
		'name' => _x( 'Page Tags', 'taxonomy general name' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Page Tags' ),
		'popular_items' => __( 'Popular Page Tags' ),
		'all_items' => __( 'All Page Tags' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Page Tag' ), 
		'update_item' => __( 'Update Page Tag' ),
		'add_new_item' => __( 'Add New Page Tag' ),
		'new_item_name' => __( 'New Page Tag Name' ),
		'separate_items_with_commas' => __( 'Separate Page Tags with commas' ),
		'add_or_remove_items' => __( 'Add or remove Page Tags' ),
		'choose_from_most_used' => __( 'Choose from the most used Page Tags' ),
		'menu_name' => __( 'Page Tags' ),
	  ); 

	  $args = array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'tags', 'with_front' => false ),
	  );
	  register_taxonomy('tags',array('page'), $args);
	 }
	}
}

?>
