<?php
/* 
=== Category to Pages WUD Administration===
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//
	
if(!function_exists('cattopage_wud_settings_page')){
// Admin settings page	
function cattopage_wud_settings_page(){
		echo '<div class="ctp-wud-admin-table">';
		echo "<form name='cattopage_wud_form' method='post' action=".admin_url('admin.php')."?page=category-to-pages-wud>";
		echo'<strong >'.__("Adds easily Categories and Tags to Pages!", "category-to-pages-wud").' (Version : '.get_option('pcwud_wud_version').')</strong>';
		echo '<a id="ctp-rate-it" href="https://wordpress.org/support/plugin/category-to-pages-wud" target="_blank" title="'.__("100% FREE PREMIUM SUPPORT", "category-to-pages-wud").'" >'.__("Any question? Click here: FREE SUPPORT", "category-to-pages-wud").'</a>';
	//Activation	
		if(isset($_GET['act'])){
			echo '<div class="activated"><p><strong>'.__("IMPORTANT: Plugin activation sets all settings to the default values.", "category-to-pages-wud").'</strong></p></div>';
		}	
		else{
			echo '<p></p>';
		}
	// Save the values to WP_OPTIONS
	if ( isset($_POST['ctp_opt_hidden']) && $_POST['ctp_opt_hidden'] == 'Y' && isset( $_POST['cattopage-wud-save'] ) && wp_verify_nonce($_POST['cattopage-wud-save'], 'cattopage-wud-check')) {
		
		// Check and save
		if ( isset($_POST['cattopage_wud_cat']) && $_POST['cattopage_wud_cat']=='1') {$cattopage_wud_cat = 'page';} else{$cattopage_wud_cat ='';}
		update_option('cattopage_wud_cat', filter_var($cattopage_wud_cat, FILTER_SANITIZE_STRING));

		if ( isset($_POST['cattopage_wud_unique']) && $_POST['cattopage_wud_unique']=='1') {$cattopage_wud_unique = '1';} else{$cattopage_wud_unique ='0';}
		update_option('cattopage_wud_unique', filter_var($cattopage_wud_unique, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_tag']) && $_POST['cattopage_wud_tag']=='1') {$cattopage_wud_tag = 'page';} else{$cattopage_wud_tag ='';}
		update_option('cattopage_wud_tag', filter_var($cattopage_wud_tag, FILTER_SANITIZE_STRING));

		
		if ( isset($_POST['cattopage_wud_title']) && $_POST['cattopage_wud_title']=='1') {$cattopage_wud_title = 'page';} else{$cattopage_wud_title ='none';}
		update_option('cattopage_wud_title', filter_var($cattopage_wud_title, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_title_size']) && $_POST['cattopage_wud_title_size']=='') {$cattopage_wud_title_size ='16';} else{$cattopage_wud_title_size=$_POST['cattopage_wud_title_size'];}
		update_option('cattopage_wud_title_size', filter_var($cattopage_wud_title_size, FILTER_SANITIZE_STRING));

		
		if ( isset($_POST['cattopage_wud_title_h1']) && $_POST['cattopage_wud_title_h1']=='') {$cattopage_wud_title_h1 ='16';} else{$cattopage_wud_title_h1=$_POST['cattopage_wud_title_h1'];}
		update_option('cattopage_wud_title_h1', filter_var($cattopage_wud_title_h1, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_quantity']) && $_POST['cattopage_wud_quantity']=='') {$cattopage_wud_quantity ='5';} else{$cattopage_wud_quantity=$_POST['cattopage_wud_quantity'];}
		update_option('cattopage_wud_quantity', filter_var($cattopage_wud_quantity, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_title_font']) && $_POST['cattopage_wud_title_font']=='') {$cattopage_wud_title_font ='inherit';} else{$cattopage_wud_title_font=$_POST['cattopage_wud_title_font'];}
		update_option('cattopage_wud_title_font', filter_var($cattopage_wud_title_font, FILTER_SANITIZE_STRING));		

		if ( isset($_POST['cattopage_wud_index_pos']) && $_POST['cattopage_wud_index_pos']=='') {$cattopage_wud_index_pos ='0';} else{$cattopage_wud_index_pos=$_POST['cattopage_wud_index_pos'];}
		update_option('cattopage_wud_index_pos', filter_var($cattopage_wud_index_pos, FILTER_SANITIZE_STRING));

		if ( isset($_POST['cattopage_wud_widget_option1']) && $_POST['cattopage_wud_widget_option1']=='1') {$cattopage_wud_widget_option1 = '1';} else{$cattopage_wud_widget_option1 ='0';}
		update_option('cattopage_wud_widget_option1', filter_var($cattopage_wud_widget_option1, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_widget_option2']) && $_POST['cattopage_wud_widget_option2']=='1') {$cattopage_wud_widget_option2 = '1';} else{$cattopage_wud_widget_option2 ='0';}
		update_option('cattopage_wud_widget_option2', filter_var($cattopage_wud_widget_option2, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_widget_parent']) && $_POST['cattopage_wud_widget_parent']=='1') {$cattopage_wud_widget_parent = '1';} else{$cattopage_wud_widget_parent ='0';}
		update_option('cattopage_wud_widget_parent', filter_var($cattopage_wud_widget_parent, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_exp_yes']) && $_POST['cattopage_wud_exp_yes']=='1') {$cattopage_wud_exp_yes = '1';} else{$cattopage_wud_exp_yes ='0';}
		update_option('cattopage_wud_exp_yes', filter_var($cattopage_wud_exp_yes, FILTER_SANITIZE_STRING));		

		if ( isset($_POST['cattopage_wud_hardcoded']) && $_POST['cattopage_wud_hardcoded']=='1') {$cattopage_wud_hardcoded = '1';} else{$cattopage_wud_hardcoded ='0';}
		update_option('cattopage_wud_hardcoded', filter_var($cattopage_wud_hardcoded, FILTER_SANITIZE_STRING));	

		if ( isset($_POST['cattopage_wud_hatom']) && $_POST['cattopage_wud_hatom']=='1') {$cattopage_wud_hatom = '1';} else{$cattopage_wud_hatom ='0';}
		update_option('cattopage_wud_hatom', filter_var($cattopage_wud_hatom, FILTER_SANITIZE_STRING));	
		
		if ( isset($_POST['cattopage_wud_exp_lenght']) ) {$cattopage_wud_exp_lenght =$_POST['cattopage_wud_exp_lenght'];}
		update_option('cattopage_wud_exp_lenght', filter_var($cattopage_wud_exp_lenght, FILTER_SANITIZE_STRING));

		if ( isset($_POST['cattopage_wud_widget_title1']) ) {$cattopage_wud_widget_title1 =$_POST['cattopage_wud_widget_title1'];}
		update_option('cattopage_wud_widget_title1', filter_var($_POST['cattopage_wud_widget_title1'], FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_widget_title2']) ) {$cattopage_wud_widget_title2 =$_POST['cattopage_wud_widget_title2'];}
		update_option('cattopage_wud_widget_title2', filter_var($_POST['cattopage_wud_widget_title2'], FILTER_SANITIZE_STRING));	
		
		if ( isset($_POST['cattopage_wud_widget_title3']) ) {$cattopage_wud_widget_title3 =$_POST['cattopage_wud_widget_title3'];}
		update_option('cattopage_wud_widget_title3', filter_var($_POST['cattopage_wud_widget_title3'], FILTER_SANITIZE_STRING));	
		
		if ( isset($_POST['cattopage_wud_custom_post0']) ) {$cattopage_wud_custom_post0 =$_POST['cattopage_wud_custom_post0'];}
		update_option('cattopage_wud_custom_post0', filter_var($_POST['cattopage_wud_custom_post0'], FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_custom_post1']) ) {$cattopage_wud_custom_post1 =$_POST['cattopage_wud_custom_post1'];}
		update_option('cattopage_wud_custom_post1', filter_var($_POST['cattopage_wud_custom_post1'], FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_custom_post2']) ) {$cattopage_wud_custom_post2 =$_POST['cattopage_wud_custom_post2'];}
		update_option('cattopage_wud_custom_post2', filter_var($_POST['cattopage_wud_custom_post2'], FILTER_SANITIZE_STRING));

	
	//load options		
		// Saved message
		if( empty($error) ){
		echo '<div class="updated"><p><strong>'.__("Busy to save the settings ... one moment please.", "category-to-pages-wud").'</strong></p></div>';
		wud_custom_cats();
		wud_custom_tags();
		flush_rewrite_rules();
		echo '<meta http-equiv="refresh" content="1">';
		}
		
		// If some error occured
		else{
			echo "<div class='error'><p><strong>";
			foreach ( $error as $key=>$val ) {
				_e($val, 'ctp-wud'); 
				echo "<br/>";
			}
				echo "</strong></p></div>";
		}
	} 
	
	// READ the used vaiables
	else {
		$cattopage_wud_cat = get_option('cattopage_wud_cat');
		$cattopage_wud_unique = get_option('cattopage_wud_unique');
		$cattopage_wud_tag = get_option('cattopage_wud_tag');
		$cattopage_wud_title = get_option('cattopage_wud_title');
		$cattopage_wud_title_h1 = get_option('cattopage_wud_title_h1');
		$cattopage_wud_title_size = get_option('cattopage_wud_title_size');
		if(!get_option('cattopage_wud_title_size')){$cattopage_wud_title_size="16";}
		$cattopage_wud_quantity = get_option('cattopage_wud_quantity');
		if(!get_option('cattopage_wud_quantity')){$cattopage_wud_quantity="5";}		
		$cattopage_wud_title_font = get_option('cattopage_wud_title_font');
		$cattopage_wud_index_pos = get_option('cattopage_wud_index_pos');
		$cattopage_wud_widget_option1 = get_option('cattopage_wud_widget_option1');
		$cattopage_wud_widget_option2 = get_option('cattopage_wud_widget_option2');
		$cattopage_wud_widget_parent = get_option('cattopage_wud_widget_parent');
		$cattopage_wud_exp_yes = get_option('cattopage_wud_exp_yes');
		$cattopage_wud_exp_lenght = get_option('cattopage_wud_exp_lenght');
		$cattopage_wud_hatom = get_option('cattopage_wud_hatom');		
		$cattopage_wud_hardcoded = get_option('cattopage_wud_hardcoded');
		$cattopage_wud_widget_title1 = get_option('cattopage_wud_widget_title1');
		$cattopage_wud_widget_title2 = get_option('cattopage_wud_widget_title2');
		$cattopage_wud_widget_title3 = get_option('cattopage_wud_widget_title3');	
		$cattopage_wud_custom_post0 = get_option('cattopage_wud_custom_post0');
		$cattopage_wud_custom_post1 = get_option('cattopage_wud_custom_post1');
		$cattopage_wud_custom_post2 = get_option('cattopage_wud_custom_post2');
	}
	
		wp_nonce_field('cattopage-wud-check','cattopage-wud-save'); 
		echo "<input type='hidden' name='ctp_opt_hidden' value='Y'>";
	
	echo "<div class='ctp-wud-wrap-d'>";
		echo '<font  size="5" color="red">'.__("Shortcodes to use in a post/page or widtget!", "category-to-pages-wud").'</font><br><br>';
		echo '<b>[wudcatlist]</b> = '.__("Displays categories as list", "category-to-pages-wud").'. - <b>[wudtaglist]</b> = '.__("Displays tags as list", "category-to-pages-wud").'.<br>';
		echo '<b>[wudcatdrop]</b> = '.__("Displays categories as drop down", "category-to-pages-wud").'. - <b>[wudtagdrop]</b> = '.__("Displays tags as drop down", "category-to-pages-wud").'.<br><br>';
		echo '<b>[wudrelated]</b> = '.__("Displays all related post and/or pages", "category-to-pages-wud").'.<br>';
		echo '<b>[wudrelated max="5"]</b> = '.__("Displays maximum 5 related post and/or pages", "category-to-pages-wud").'.<br>';
		echo '<b>[wudrelated type="page"]</b> = '.__("Displays all related pages", "category-to-pages-wud").' - <b>'.__("[wudrelated type=\"post\"]", "category-to-pages-wud").'</b> = '.__("Displays all related posts", "category-to-pages-wud").'.<br>';
		echo ''.__("Please notice that all the settings on this page are related to the Wordpress pages and not to Wordpress posts!", "category-to-pages-wud");
	echo "</div>";

	
	// ADMIN Left	$cattopage_wud_widget_option1	
	echo "<div class='ctp-wud-wrap-a'>";
		echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("Categories", "category-to-pages-wud").' '.__("are available for posts and pages", "category-to-pages-wud").'.<br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("Categories", "category-to-pages-wud").' '.__("are only available for posts (WordPress standard).", "category-to-pages-wud").'</div></div>';				
		echo '<label>'.__("Add Categories to pages", "category-to-pages-wud").' </label><input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_cat" type="checkbox" value="1" '. checked( $cattopage_wud_cat, "page", false ) .'/><label for="cmn-toggle-1" class="ctp-wud-right"></label>'; 
	echo '</div>';
		
	// ADMIN Right	$cattopage_wud_widget_option2	
	echo "<div class='ctp-wud-wrap-2'>";
		echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("Tags", "category-to-pages-wud").' '.__("are available for posts and pages", "category-to-pages-wud").'.<br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("Tags", "category-to-pages-wud").' '.__("are only available for posts (WordPress standard).", "category-to-pages-wud").'</div></div>';
		echo '<label>'.__("Add Tags to pages", "category-to-pages-wud").' </label><input id="cmn-toggle-2" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_tag" type="checkbox" value="1" '. checked( $cattopage_wud_tag, "page", false ) .'/><label for="cmn-toggle-2" class="ctp-wud-right"></label>';
	echo '</div>';
		
	echo "<div class='ctp-wud-wrap-b'>";
		echo '<label><b>'.__("Show the Category/Tag Title on the Page.", "category-to-pages-wud").'</b></label><br><br>';
		echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("Show the categories and tags, just BELOW the Page Title or on TOP of your Page Content", "category-to-pages-wud").'.<br><br>'.__("Depending the Theme you are using, you can choose here where to place the Categories and Tags.", "category-to-pages-wud", "category-to-pages-wud").'</div></div>';				
		echo '<label></label><input id="cmn-toggle-3" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_title" type="checkbox" value="1" '. checked( $cattopage_wud_title, "page", false ) .'/><label for="cmn-toggle-3" class="ctp-wud-right"></label>';
		echo '<label>'.__("Activate", "category-to-pages-wud").' :</label><br><br>';
		
		echo '<select class="ctp-select" name="cattopage_wud_index_pos" style="float:right;">';
		echo     '<option value="0"'; if ( $cattopage_wud_index_pos == "0" ){echo 'selected="selected"';} echo '>Below the Title</option>';
		echo     '<option value="1"'; if ( $cattopage_wud_index_pos == "1" ){echo 'selected="selected"';} echo '>Above the Content</option>';
		echo '</select><br><br>';


		
		echo '<br><select class="ctp-select" name="cattopage_wud_title_h1" style="float:right;">';
		echo     '<option value="p"'; if ( $cattopage_wud_title_h1 == "p" ){echo 'selected="selected"';} echo '>Use Font Size</option>';
		echo     '<option value="h1"'; if ( $cattopage_wud_title_h1 == "h1" ){echo 'selected="selected"';} echo '>H1</option>';
		echo     '<option value="h2"'; if ( $cattopage_wud_title_h1 == "h2" ){echo 'selected="selected"';} echo '>H2</option>';
		echo     '<option value="h3"'; if ( $cattopage_wud_title_h1 == "h3" ){echo 'selected="selected"';} echo '>H3</option>';
		echo '</select>';		
		
		echo '<br><label>'.__("Font size (if not H1,H2 or H3)", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_title_size" type="number"  min="12" max="34" value="'.$cattopage_wud_title_size.'"/><br><br>';
		echo '<br><br><label>'.__("Font Family", "category-to-pages-wud").'</label> ';
		echo '<select class="ctp-select" name="cattopage_wud_title_font" style="float:right;">';
		echo     '<option value="inherit"'; if ( $cattopage_wud_title_font == "inherit" ){echo 'selected="selected"';} echo '>Inherit</option>';
		echo     '<option value="initial"'; if ( $cattopage_wud_title_font == "initial" ){echo 'selected="selected"';} echo '>Initial</option>';
		echo     '<option value="Arial"'; if ( $cattopage_wud_title_font == "Arial" ){echo 'selected="selected"';} echo '>Arial</option>';
		echo     '<option value="Times New Roman"'; if ( $cattopage_wud_title_font == "Times New Roman" ){echo 'selected="selected"';} echo '>Times New Roman</option>';
		echo     '<option value="Georgia"'; if ( $cattopage_wud_title_font == "Georgia" ){echo 'selected="selected"';} echo '>Georgia</option>';
		echo     '<option value="Serif"'; if ( $cattopage_wud_title_font == "Serif" ){echo 'selected="selected"';} echo '>Serif</option>';
		echo     '<option value="Helvetica"'; if ( $cattopage_wud_title_font == "Helvetica" ){echo 'selected="selected"';} echo '>Helvetica</option>';
		echo     '<option value="Lucida Sans Unicode"'; if ( $cattopage_wud_title_font == "Lucida Sans Unicode" ){echo 'selected="selected"';} echo '>Lucida Sans Unicode</option>';
		echo     '<option value="Tahoma"'; if ( $cattopage_wud_title_font == "Tahoma" ){echo 'selected="selected"';} echo '>Tahoma</option>';
		echo     '<option value="Verdana"'; if ( $cattopage_wud_title_font == "Verdana" ){echo 'selected="selected"';} echo '>Verdana</option>';
		echo     '<option value="Courier New"'; if ( $cattopage_wud_title_font == "Courier New" ){echo 'selected="selected"';} echo '>Courier New</option>';
		echo     '<option value="Lucida Console"'; if ( $cattopage_wud_title_font == "Lucida Console" ){echo 'selected="selected"';} echo '>Lucida Console</option>';
		echo '</select>';		
	echo "<br><br></div>";
		
	echo "<div class='ctp-wud-wrap-3'>";
		echo '<label><b><u>'.__("Unique", "category-to-pages-wud").'</u> '.__("page categories/tags", "category-to-pages-wud").' </b></label><br><br>';
		echo '<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("Categories and tags are unique for pages", "category-to-pages-wud").'.<br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("Page categories and tags are the same as they are for posts.", "category-to-pages-wud").'</div></div>';		
		echo '<label>'.__("Activate", "category-to-pages-wud").' </label><input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round cattopage_wud_unique" name="cattopage_wud_unique" type="checkbox" value="1" '. checked( $cattopage_wud_unique, "1", false ) .'/><label for="cmn-toggle-4" class="ctp-wud-right"></label><br>';
		echo '<br><label>'.__("If you disable this feature, the", "category-to-pages-wud").' <b>'.__("unique", "category-to-pages-wud").'</b> '.__("categories / tags are no longer usable / visible!", "category-to-pages-wud").'</label>';	
	echo '<br></div>';

		
	echo "<div class='ctp-wud-wrap-4'>";
		echo '<label><b><u>'.__("Widget", "category-to-pages-wud").'</u> '.__("Category to Pages", "category-to-pages-wud").' </b></label><br><br>';
		echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("A list from maximum 5 page descriptions with URL's are displayed per Category and/or Tag", "category-to-pages-wud").'.<br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("No pages descriptions with URL's are displayed.", "category-to-pages-wud").'</div></div>';		
		echo '<label>'.__("Show Category and Tag pages", "category-to-pages-wud").'  </label><input id="cmn-toggle-5" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_widget_option1" type="checkbox" value="1" '. checked( $cattopage_wud_widget_option1, "1", false ) .'/><label for="cmn-toggle-5" class="ctp-wud-right"></label>';
		echo '<br><br>';
		echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("A button will appear to show the pages descriptions with URL's.", "category-to-pages-wud").'<br></div></div>';
		echo '<label>'.__("Show a button to display the pages", "category-to-pages-wud").'  </label><input id="cmn-toggle-6" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_widget_option2" type="checkbox" value="1" '. checked( $cattopage_wud_widget_option2, "1", false ) .'/><label for="cmn-toggle-6" class="ctp-wud-right"></label>';
		echo '<br><br>';

		
		echo '<label>'.__("Quantity pages to display (max.: 50)", "category-to-pages-wud").'  </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_quantity" type="number"  min="5" max="50" value="'.$cattopage_wud_quantity.'"/><br><br>';
		echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("It shows the parent categories pages only", "category-to-pages-wud").'.<br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("It shows the parent and child (sub) categories pages together.", "category-to-pages-wud").'<br></div></div>';
		echo '<label>'.__("Show only Parent Categories", "category-to-pages-wud").' </label><input id="cmn-toggle-7" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_widget_parent" type="checkbox" value="1" '. checked( $cattopage_wud_widget_parent, "1", false ) .'/><label for="cmn-toggle-7" class="ctp-wud-right"></label>';
		echo '<br><br>';
		echo '<label>'.__("Page Category Description", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_widget_title1" type="text" value="'.$cattopage_wud_widget_title1.'"/><br><br>';
		echo '<label>'.__("Page Tag Description", "category-to-pages-wud").'  </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_widget_title2" type="text" value="'.$cattopage_wud_widget_title2.'"/><br><br>';	
		echo '<label>'.__("Related Post Description", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_widget_title3" type="text" value="'.$cattopage_wud_widget_title3.'"/>';				
	echo "<br><br></div>";


	echo "<div class='ctp-wud-wrap-c'>";
		echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("Unique excerpts are available for pages and posts", "category-to-pages-wud").'.<br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("Excerpts are only available for posts (WordPress standard).", "category-to-pages-wud").'</div></div>';
		echo '<label>'.__("Use excerpts for pages", "category-to-pages-wud").' </label><input id="cmn-toggle-8" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_exp_yes" type="checkbox" value="1" '. checked( $cattopage_wud_exp_yes, "1", false ) .'/><label for="cmn-toggle-8" class="ctp-wud-right"></label>';
		echo '<br><br>';
		echo '<label>'.__("Excerpt length in words (max.: 150)", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_exp_lenght" type="number"  min="5" max="150" value="'.$cattopage_wud_exp_lenght.'"/>';
	echo "<br><br></div>";
	
	if ($cattopage_wud_unique !=1){
		echo "<div class='ctp-wud-wrap-e'>";
			echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("When Categories/Tags are not unique and WordPress permalink  is set to: /%category%/%postname%/", "category-to-pages-wud").' <br><br>'.__("If activated", "category-to-pages-wud").':<br>'.__("You can edit the page URL (WordPress standard)", "category-to-pages-wud").'.<br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("A page URL name contains the hardcoded category and is not Editable.", "category-to-pages-wud").'</div></div>';
			echo '<label><b>'.__("Disable 'Page category/tag' in the URL", "category-to-pages-wud").' </b></label><input id="cmn-toggle-9" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_hardcoded" type="checkbox" value="1" '. checked( $cattopage_wud_hardcoded, "1", false ) .'/><label for="cmn-toggle-9" class="ctp-wud-right"></label>';
		echo "<br></div>";
	}
	
	echo "<div class='ctp-wud-wrap-f'>";
		echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("Hatom: Fixes errors in Google Webmaster Tools", "category-to-pages-wud").' <br><br>'.__("If activated","category-to-pages-wud").':<br>'.__("It wil display (in hidden format) Hatom data to Google", "category-to-pages-wud").'.<br>'.__("Hatom data = post/page title, date last updated and author vcard", "category-to-pages-wud").'.</br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("Category to Page WUD does not force the hidden Hatom data.", "category-to-pages-wud").'</div></div>';
		echo '<label><b>'.__("Enable Page & Post Hatom data for Google", "category-to-pages-wud").' </b></label><input id="cmn-toggle-10" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_hatom" type="checkbox" value="1" '. checked( $cattopage_wud_hatom, "1", false ) .'/><label for="cmn-toggle-10" class="ctp-wud-right"></label>';
		echo '<br><br><a href="https://productforums.google.com/forum/#!topic/webmasters/UpxVsTjQexk;context-place=topicsearchin/webmasters/category$3Astructured-data%7Csort:relevance%7Cspell:false" target="_blank">'.__("Read more @ Google", "category-to-pages-wud").'</a>';
	echo "<br></div>";


	echo "<div class='ctp-wud-wrap-c'>";
		echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("Custom post type will be available in our shortcut or widget results", "category-to-pages-wud").'.<br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("Custom Post types are not included in our shortcode or widget results (WordPress standard).", "category-to-pages-wud").'</div></div>';
		echo '<label><strong>'.__("Custom Post type", "category-to-pages-wud").'</strong></label><br><br>';
		echo '<label>'.__("Custom Post type 1", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_custom_post0" type="text" value="'.$cattopage_wud_custom_post0.'"/>';
		echo '<br><br>';
		echo '<label>'.__("Custom Post type 2", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_custom_post1" type="text" value="'.$cattopage_wud_custom_post1.'"/>';
		echo '<br><br>';
		echo '<label>'.__("Custom Post type 3", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_custom_post2" type="text" value="'.$cattopage_wud_custom_post2.'"/>';
		echo '<br><br><a href="https://wordpress.org/plugins/search/Custom+Content+Types+and+Fields/" target="_blank">'.__("Read more @ WordPress", "category-to-pages-wud").'</a>';		
	echo "<br><br></div>";
	
		echo '<div class="clear"></div><br><br><br>';
	// ADMIN Submit		
		echo '<input type="submit" name="Submit" class="button-primary" id="ctp-wud-adm-subm" value="'.__("Save Changes", "category-to-pages-wud").'" />';
		echo "</form>";
		echo '<a href="https://wud-plugins.com" class="button-primary" id="ctp-adm-wud" target="_blank">'.__("Visit our website", "category-to-pages-wud").'</a>  <a href="https://wordpress.org/support/plugin/category-to-pages-wud" class="button-primary" id="ctp-adm-wud" target="_blank">'.__("Get FREE Support", "category-to-pages-wud").'</a>';
		echo ' <a href="https://wud-plugins.com/contact-us/" class="button-primary" id="ctp-adm-wud-or" target="_blank">'.__("Contact", "category-to-pages-wud").'</a><br>';
		echo '</div>';	
	
} // END cattopage_wud_settings_page
} // END check function



?>
