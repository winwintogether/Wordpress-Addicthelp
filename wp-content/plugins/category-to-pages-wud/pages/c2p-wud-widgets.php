<?php
/* 
=== Category to Pages WUD Widgets ===
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//

//Show Categories and ord tags as widget 
wp_register_sidebar_widget(
    'cattopage_wud_widget',
    'Category to Page WUD',
    'cattopage_wud_widget_display',
    array(
        'description' => 'Summarize page categories and/or tags'
    )
);

wp_register_widget_control(
	'cattopage_wud_widget',
	'cattopage_wud_widget',
	'cattopage_wud_widget_control'
);

//Categories and ord tags Widget settings
if(!function_exists('cattopage_wud_widget_control')){
	function cattopage_wud_widget_control($args=array(), $params=array()) {
		
		if (isset($_POST['submitted'])) {
				update_option('cattopage_wud_widget_title', filter_var($_POST['cattopage_wud_widget_title'], FILTER_SANITIZE_STRING));
			
			if($_POST['cattopage_wud_widget_cats']==""){$_POST['cattopage_wud_widget_cats']="0";}
				update_option('cattopage_wud_widget_cats', filter_var($_POST['cattopage_wud_widget_cats'], FILTER_SANITIZE_STRING));
				
			if($_POST['cattopage_wud_widget_tags']==""){$_POST['cattopage_wud_widget_tags']="0";}
				update_option('cattopage_wud_widget_tags', filter_var($_POST['cattopage_wud_widget_tags'], FILTER_SANITIZE_STRING));
				
				update_option('cattopage_wud_widget_font1', filter_var($_POST['cattopage_wud_widget_font1'], FILTER_SANITIZE_STRING));
				update_option('cattopage_wud_widget_title1', filter_var($_POST['cattopage_wud_widget_title1'], FILTER_SANITIZE_STRING));
				update_option('cattopage_wud_widget_font2', filter_var($_POST['cattopage_wud_widget_font2'], FILTER_SANITIZE_STRING));
				update_option('cattopage_wud_widget_title2', filter_var($_POST['cattopage_wud_widget_title2'], FILTER_SANITIZE_STRING));
		}

		//load options
		$cattopage_wud_widget_title = get_option('cattopage_wud_widget_title');
		$cattopage_wud_widget_cats = get_option('cattopage_wud_widget_cats');
		$cattopage_wud_widget_tags = get_option('cattopage_wud_widget_tags');
		$cattopage_wud_widget_font1 = get_option('cattopage_wud_widget_font1');
		$cattopage_wud_widget_title1 = get_option('cattopage_wud_widget_title1');
		$cattopage_wud_widget_font2 = get_option('cattopage_wud_widget_font2');
		$cattopage_wud_widget_title2 = get_option('cattopage_wud_widget_title2');
		?>
		
		<br><br>
		<b><?php echo __("Widget Title", "category-to-pages-wud"); ?>: </b>
		<input style="float:right; width:60%;" type="text" class="widefat" name="cattopage_wud_widget_title" value="<?php echo stripslashes($cattopage_wud_widget_title); ?>" />
		<br><br>	
		<hr><br>
		
		<b><?php echo __("Show Page Categories", "category-to-pages-wud"); ?>: </b>
		<input style="float:right;" type="checkbox" name="cattopage_wud_widget_cats" value="1" <?php echo ($cattopage_wud_widget_cats==1 ? 'checked' : '');?> /> 
		<br><br>
		<?php echo __("Page Category Title", "category-to-pages-wud"); ?>: 
		<input style="float:right; width:60%;" type="text" class="widefat" name="cattopage_wud_widget_title1" value="<?php echo stripslashes($cattopage_wud_widget_title1); ?>" />
		<br><br>	
		<?php echo __("CCS Font Title", "category-to-pages-wud"); ?>: 	
			<select name="cattopage_wud_widget_font1" style="float:right;">
			<option value="normal" <?php if ( $cattopage_wud_widget_font1 == "normal" ){echo 'selected="selected"';} echo '>normal'; ?></option>
			<option value="strong" <?php if ( $cattopage_wud_widget_font1 == "strong" ){echo 'selected="selected"';} echo '>strong'; ?></option>
			<option value="h1" <?php if ( $cattopage_wud_widget_font1 == "h1" ){echo 'selected="selected"';} echo '>h1'; ?></option>
			<option value="h2" <?php if ( $cattopage_wud_widget_font1 == "h2" ){echo 'selected="selected"';} echo '>h2'; ?></option>
			<option value="h3" <?php if ( $cattopage_wud_widget_font1 == "h3" ){echo 'selected="selected"';} echo '>h3'; ?></option>
			</select> 
		<br><br>	
		<hr><br>
		
		<b><?php echo __("Show Page Tags", "category-to-pages-wud"); ?>: </b>
		<input style="float:right;" type="checkbox" name="cattopage_wud_widget_tags" value="1" <?php echo ($cattopage_wud_widget_tags==1 ? 'checked' : '');?> /> 
		<br><br>
		<?php echo __("Page Tagg Title", "category-to-pages-wud"); ?>: 
		<input style="float:right; width:60%;" type="text" class="widefat" name="cattopage_wud_widget_title2" value="<?php echo stripslashes($cattopage_wud_widget_title2); ?>" />
		<br><br>	
		<?php echo __("CCS Font Title", "category-to-pages-wud"); ?>: 
			<select name="cattopage_wud_widget_font2" style="float:right;">
			<option value="normal" <?php if ( $cattopage_wud_widget_font2 == "normal" ){echo 'selected="selected"';} echo '>normal'; ?></option>
			<option value="strong" <?php if ( $cattopage_wud_widget_font2 == "strong" ){echo 'selected="selected"';} echo '>strong'; ?></option>
			<option value="h1" <?php if ( $cattopage_wud_widget_font2 == "h1" ){echo 'selected="selected"';} echo '>h1'; ?></option>
			<option value="h2" <?php if ( $cattopage_wud_widget_font2 == "h2" ){echo 'selected="selected"';} echo '>h2'; ?></option>
			<option value="h3" <?php if ( $cattopage_wud_widget_font2 == "h3" ){echo 'selected="selected"';} echo '>h3'; ?></option>
			</select> 
		<br><br>
		
		<input type="hidden" name="submitted" value="1" />
		<?php
	}
}

//Categories and ord tags Widget display [DO NOT USE if(!function_exists ...)]
	function cattopage_wud_widget_display($args=array(), $params=array()) {
		//load options
		$cattopage_wud_widget_title = get_option('cattopage_wud_widget_title');
		$cattopage_wud_widget_cats = get_option('cattopage_wud_widget_cats');
		$cattopage_wud_widget_tags = get_option('cattopage_wud_widget_tags');
		
		//widget output
		echo stripslashes($args['before_widget']);

		echo stripslashes($args['before_title']);
		echo stripslashes($cattopage_wud_widget_title);
		echo stripslashes($args['after_title']);
		
		echo '<div class="textwidget">';
		
		if($cattopage_wud_widget_cats=="1"){
			if(get_option('cattopage_wud_unique')=="0"){
				echo cattopage_wud_widget_urls("category");
			}
			else{
				echo cattopage_wud_widget_urls("categories");
			}		
		}
		
		if($cattopage_wud_widget_tags=="1"){		
			if(get_option('cattopage_wud_unique')=="0"){
				echo cattopage_wud_widget_urls("post_tag");
			}
			else{
				echo cattopage_wud_widget_urls("tags");
			}
		}
		
		echo '</div>';//close div.textwidget
	  echo stripslashes($args['after_widget']);
	}

//Categories and ord tags Widget content
if(!function_exists('cattopage_wud_widget_urls')){
	function cattopage_wud_widget_urls($cat_tag){
		global $post;
		$cattopage_wud_widget_font1 = get_option('cattopage_wud_widget_font1');
		$cattopage_wud_widget_title1 = get_option('cattopage_wud_widget_title1');
		$cattopage_wud_widget_font2 = get_option('cattopage_wud_widget_font2');
		$cattopage_wud_widget_title2 = get_option('cattopage_wud_widget_title2');
		$cattopage_wud_widget_option1 = get_option('cattopage_wud_widget_option1');
		$cattopage_wud_widget_option2 = get_option('cattopage_wud_widget_option2');
		$cattopage_wud_widget_parent = get_option('cattopage_wud_widget_parent');
		$cattopage_wud_quantity = get_option('cattopage_wud_quantity');
		if(!get_option('cattopage_wud_quantity')){$cattopage_wud_quantity="5";}		
		
		$args = get_terms($cat_tag, array('parent' => 0, 'orderby' => 'slug', 'hide_empty' => true));	
		
	if ( ! empty( $args ) && ! is_wp_error( $args ) ) {
		$count = count( $args );
		$i = 0;
		$term_list = '<div class="wud_cat_tag_css">';
			if(!empty($cat_tag) && ($cat_tag=="categories" || $cat_tag=="category")){
				$term_list .= '<'.$cattopage_wud_widget_font1.'><br><span class="wudicon wudicon-category"></span> '.$cattopage_wud_widget_title1.'</'.$cattopage_wud_widget_font1.'>';
				if($cattopage_wud_widget_font1=="normal" || $cattopage_wud_widget_font1=="strong"){$term_list .= '<br>';}
			}
			if(!empty($cat_tag) && ($cat_tag=="tags" || $cat_tag=="post_tag")){
				$term_list .= '<'.$cattopage_wud_widget_font2.'><br><span class="wudicon wudicon-tag"></span> '.$cattopage_wud_widget_title2.'</'.$cattopage_wud_widget_font2.'>';
				if($cattopage_wud_widget_font2=="normal" || $cattopage_wud_widget_font2=="strong"){$term_list .= '<br>';}
			}
			
		if($cat_tag=="categories" || $cat_tag=="category" || $cat_tag=="tags" || $cat_tag=="post_tag") {
			
			foreach ($args as $pterm) {
				$xterms = get_terms($cat_tag, array('parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false));	
		//-> CAT OR TAG
				$cattopage_wud_cnt= substr(round(microtime(true) * 1000),10,3);
			
				if($cattopage_wud_widget_option2=="1"){
					$term_list .= '<button ClickResult="'.$cattopage_wud_cnt.'" class="cattopage_wud_split" id="cattopage_wud_split"><span>+</span></button> ';
				}
				
				//If current page haves this category or tag
				$return = is_object_in_term( $post->ID, $cat_tag, $pterm->slug );
					if(!empty($return)){$term_list .='<b>';} 
				$term_list .= '<a href="' . esc_url( get_term_link( $pterm ) ) . '">' . $pterm->name . '</a><br>';
					if(!empty($return)){$term_list .='</b>';}
					
				//Show pages URL
				if($cattopage_wud_widget_option1=="1"){	
					if($cattopage_wud_widget_option2=="1"){
						$term_list .= '<div class="cattopage_wud_items" id="cattopage_wud_split_'.$cattopage_wud_cnt.'">';
					}
					
					$standard_post = array('page','post');
					$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
					$post_typ = array_merge($standard_post, $custom_post_type);
		
					$argspost = array( 'posts_per_page' => $cattopage_wud_quantity, 'post_status'	=> 'publish', 'post_type' => $post_typ, 'offset'=> 0, 'tax_query' => array(array('taxonomy' => $cat_tag, 'field' => 'slug', 'terms' => array($pterm->slug))),);
					$myposts = get_posts( $argspost );
					foreach ( $myposts as $postwud ){ 
					
					//Check or this is the PARENT category (no child/sub)
					$terms = get_the_terms($postwud->ID, $cat_tag);
					$term_parent=0;
					if($terms){
					   foreach ($terms as $term) {
						 if (($term->parent) == 0) {$term_parent=0;}
						   else{
							   //If parameter parent is not 1, show also childs (subs)
							   if($cattopage_wud_widget_parent =="1"){
								   $term_parent=1;
								}
							 }  
						}
					}
									
					//If is a Tag or the Category is Parent
					if($term_parent==0){$term_list .= '&nbsp;&nbsp;&nbsp;&nbsp;&#8627;&nbsp;<a href="'.esc_url(get_permalink($postwud->ID)).'">'.$postwud->post_title.'</a><br>';}			
					}
					if($cattopage_wud_widget_option2=="1"){
						$term_list .= '</div>';
					}
				}		
				foreach ($xterms as $term) {
		//-> SUB CAT OR SUB TAG
					$cattopage_wud_cnt= substr(round(microtime(true) * 1000),10,3);

					if($cattopage_wud_widget_option2=="1"){
						$term_list .= '<button ClickResult="'.$cattopage_wud_cnt.'" class="cattopage_wud_split" id="cattopage_wud_split"><span>+</span></button> ';
					}
					
					//If current page haves this category or tag
					$return = is_object_in_term( $post->ID, $cat_tag, $term->slug );
						if(!empty($return)){$term_list .='<b>';} 
					$term_list .= '&#9492; &nbsp;<a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a><br>'; 
						if(!empty($return)){$term_list .='</b>';}

					$standard_post = array('page','post');
					$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
					$post_typ = array_merge($standard_post, $custom_post_type);
					
					//Show pages URL
					if($cattopage_wud_widget_option1=="1"){	
						if($cattopage_wud_widget_option2=="1"){
							$term_list .= '<div class="cattopage_wud_items" id="cattopage_wud_split_'.$cattopage_wud_cnt.'">';
						}
						$argspost = array( 'posts_per_page' => $cattopage_wud_quantity, 'post_status'	=> 'publish', 'post_type' => $post_typ, 'offset'=> 0, 'tax_query' => array(array('taxonomy' => $cat_tag, 'field' => 'slug', 'terms' => array($term->slug))),);
						$myposts = get_posts( $argspost );
						foreach ( $myposts as $postwud ){ 
						$term_list .= '&nbsp;&nbsp;&nbsp;&nbsp;&#8627;&nbsp;<a href="'.esc_url(get_permalink($postwud->ID)).'">'.$postwud->post_title.'</a><br>';
						}
						if($cattopage_wud_widget_option2=="1"){
							$term_list .= '</div>';
						}
					}				
				}
			}
			$term_list .= '</div>';
			return $term_list;
		}
		else{
			$term_list .= '</div>';
			return $term_list;
		}
	}
	}
}
?>
