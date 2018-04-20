<?php
/* 
=== Category to Pages WUD Options ===
=> Excerpt for page
=> Cat/Tag in title
=> Cat/Tag in post

*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//


//Allow using shortcodes in a widget
function cattopage_wud_widget_text( $widget_text ){
	$pattern = get_shortcode_regex();
	if ( preg_match_all( '/'. $pattern .'/s', $widget_text, $matches )&& array_key_exists( 2, $matches ) ){
         add_filter( 'widget_text', 'shortcode_unautop');
		 add_filter( 'widget_text', 'do_shortcode');	
	}
    return $widget_text;
}

// Inject HATOM data
if(!function_exists('cattopage_wud_hatom_data')){
	function cattopage_wud_hatom_data($content) {
	   $t = get_the_modified_time('F jS, Y');
	   $author = get_the_author();
	   $title = get_the_title();
		if (is_home() || is_singular() || is_archive() || is_single() || is_page()) {
			$content .= '<div class="hatom-extra" id="wud-plugins" style="display:none;visibility:hidden;"><span class="entry-title">'.$title.'</span> was last modified: <span class="updated"> '.$t.'</span> by <span class="author vcard"><span class="fn">'.$author.'</span></span></div>';
		}
		return $content;
	}
}

//If 'Use excerpts for pages:' is activated
function cattopage_wud_add_excerpts_to_pages() {
	if(get_option('cattopage_wud_exp_yes')==1){
		add_post_type_support( 'page', 'excerpt' );
	}
}

//If 'Use excerpts for pages:' and if is archive page and if is pages
function cattopage_wud_change_to_excerpt($content) {
	global $post, $excerpt;
	if ( is_archive() && get_option('cattopage_wud_exp_yes')==1 && $post->post_type =="page" ) {
		//Unique page excerpt
		if( $post->post_excerpt && post_type_supports( 'page', 'excerpt' )) {
			$ctp_excerpt = $post->post_excerpt;
			$pattern = '~http(s)?://[^\s]*~i';
			$content = preg_replace($pattern, '', $ctp_excerpt);			
		}
		//Make excerpt from content
		else{
			$ctp_excerpt = strip_shortcodes ( wp_trim_words ( $content, get_option('cattopage_wud_exp_lenght') ) );
			$pattern = '~http(s)?://[^\s]*~i';
			$content = preg_replace($pattern, '', $ctp_excerpt);		
		}
	}
	return $content;
}

//Show Category and ord tag title on pages IN TITLE
if(!function_exists('cattopage_wud_titles')){
	function cattopage_wud_titles( $title , $id = null ) {
		
		if(is_singular('page')) {
			global $post;
		
		$cats_title = NULL;
		$tags_title = NULL;		
		//Font Size
		$sizect = get_option('cattopage_wud_title_size');
		if(empty($sizect)){$sizect="12";}
		//Line Size
		$sizel=$sizect+1;
		//Font Family
		$fontct = get_option('cattopage_wud_title_font');
		if(empty($fontct)){$fontct="inherit";}

		//p or h1 to h3
		$pp = get_option('cattopage_wud_title_h1');
		if($pp == 'p'){ 
			$ppstyle = "style= 'font-family:".$fontct."; font-size: ".$sizect."px; line-height: ".$sizel."px; margin: 0px; margin-top: 4px;'"; 
			$iconsize = "style='font-size: ".$sizect."px;'";
		}
		else{
			$ppstyle = "";
			$iconsize = "";			
		}
		
		if(!empty($post)){	
		//If UNIQUE Categories and Tags
			if(get_option('cattopage_wud_unique')=="1"){
					if(get_option('cattopage_wud_cat')=="page"){
						$cats_title = 	get_the_term_list( $post->ID, 'categories', '', ', ' );
					}
					if(get_option('cattopage_wud_tag')=="page"){
						$tags_title = 	get_the_term_list( $post->ID, 'tags', '', ', ' );
					}
			}
		//If WordPress Categories and Tags
			else{	
					if(get_option('cattopage_wud_cat')=="page"){
						$cats_title = 	get_the_term_list( $post->ID, 'category', '', ', ' );
					}
					if(get_option('cattopage_wud_tag')=="page"){
						$tags_title = 	get_the_term_list( $post->ID, 'post_tag', '', ', ' );
					}					
			}
		}	
		//If nothing is in the loop ... return
		if(!in_the_loop()){return $title;}

		//If Oké, display the Title('s)
		 if(get_option('cattopage_wud_title')=='page'){
				if(!empty($cats_title)){
					$cats_title = "<".$pp." class='ctp-wud-title' ".$ppstyle."><span class='wudicon wudicon-category' ".$iconsize."> </span>".$cats_title."</".$pp.">";
				}
				if(!empty($tags_title)){
					$tags_title = "<".$pp." class='ctp-wud-title' ".$ppstyle."><span class='wudicon wudicon-tag' ".$iconsize."> </span>".$tags_title."</".$pp.">";
				}
			//Build the new Title ...
			$title .= $cats_title.$tags_title;
		} 
		}	
		return $title;
	}
}

//Show Category and ord tag title on pages ON TOP OF THE POST
if(!function_exists('cattopage_wud_titles_in_page')){
	function cattopage_wud_titles_in_page($content) {	
	   if(is_singular('page')) {	   
			global $post;
		
		$cats_title = NULL;
		$tags_title = NULL;	
		//Font Size
		$sizect = get_option('cattopage_wud_title_size');
		if(empty($sizect)){$sizect="12";}
		//Line Size
		$sizel=$sizect+1;
		//Font Family
		$fontct = get_option('cattopage_wud_title_font');
		if(empty($fontct)){$fontct="inherit";}

		//p or h1 to h3
		$pp = get_option('cattopage_wud_title_h1');
		if($pp == 'p'){ 
			$ppstyle = "style= 'font-family:".$fontct."; font-size: ".$sizect."px; line-height: ".$sizel."px; margin: 0px; margin-top: 4px;'"; 
			$iconsize = "style='font-size: ".$sizect."px;'";
		}
		else{
			$ppstyle = "";
			$iconsize = "";			
		}
		
		if(!empty($post)){	
		//If UNIQUE Categories and Tags
			if(get_option('cattopage_wud_unique')=="1"){
					if(get_option('cattopage_wud_cat')=="page"){
						$cats_title = 	get_the_term_list( $post->ID, 'categories', '', ', ' );
					}
					if(get_option('cattopage_wud_tag')=="page"){
						$tags_title = 	get_the_term_list( $post->ID, 'tags', '', ', ' );
					}
			}
		//If WordPress Categories and Tags
			else{	
					if(get_option('cattopage_wud_cat')=="page"){
						$cats_title = 	get_the_term_list( $post->ID, 'category', '', ', ' );
					}
					if(get_option('cattopage_wud_tag')=="page"){
						$tags_title = 	get_the_term_list( $post->ID, 'post_tag', '', ', ' );
					}					
			}
		}	

		//If Oké, display the Title('s)
		 if(get_option('cattopage_wud_title')=='page' ){ 
				if(!empty($cats_title)){
					$cats_title = "<".$pp." class='ctp-wud-title' ".$ppstyle."><span class='wudicon wudicon-category' ".$iconsize."> </span>".$cats_title."</".$pp.">";
				}
				if(!empty($tags_title)){
					$tags_title = "<".$pp." class='ctp-wud-title' ".$ppstyle."><span class='wudicon wudicon-tag' ".$iconsize."> </span>".$tags_title."</".$pp.">";
				}
			//Build the new Title ...
			$catstags = '<div style="margin-bottom:20px;">'.$cats_title.$tags_title.'</div>';
		}
		  $content = $catstags.$content;
	   }
	   return $content;
	}
}
?>
