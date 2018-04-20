<?php
/* 
=== Category to Pages WUD ===
Contributors: wistudat.be
Plugin Name: Category to Pages WUD
Donate Reason: Enough for a cup of coffee?
Donate link: https://www.paypal.me/WudPluginsCom
Description: Add Easily Page Categories and Page Tags.
Author: Danny WUD
Author URI: https://wud-plugins.com
Plugin URI: https://wud-plugins.com
Tags: category pages, categories page, category page, categories pages, category to page, page category, hatom, related post, page excerpts
Requires at least: 3.6
Tested up to: 4.9
Stable tag: 2.3.8
Version: 2.3.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: category-to-pages-wud
Domain Path: /languages
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//
$ctp_version='2.3.8';
// Store the latest version.
if (get_option('pcwud_wud_version')!=$ctp_version) {cattopage_wud_update();}
//==============================================================================//
global $template;
// Action after activation (button activate)
	add_action( 'activated_plugin', 'cattopage_wud_activation' );
	
// Actions inside this page
		add_action( 'plugins_loaded', 'cattopage_wud_require' );
		add_action('wp_head', 'show_wud_cattopage_template');
		add_action('admin_menu', 'cattopage_wud_create_menu');
		add_filter( 'plugin_action_links', 'cattopage_wud_action_links', 10, 5 );
		add_action('admin_enqueue_scripts', 'cattopage_wud_styling');
		add_action('init', 'cattopage_wud_site_page');
		add_action('plugins_loaded', 'cattopage_wud_languages');
		
// Actions from other pages (loaded by: cattopage_wud_require)	
		add_filter( 'widget_text', 'cattopage_wud_widget_text', 1, 1);	
		add_filter("the_content", "cattopage_wud_change_to_excerpt");
		add_action( 'init', 'cattopage_wud_add_excerpts_to_pages' );
		add_shortcode('wudrelated', 'cattopage_wud_short_code_page_list');
		add_shortcode('wudcatlist', 'cattopage_wud_short_code_cat_list');
		add_shortcode('wudtaglist', 'cattopage_wud_short_code_tag_list');
		add_shortcode('wudcatdrop', 'cattopage_wud_short_code_cat_drop');
		add_shortcode('wudtagdrop', 'cattopage_wud_short_code_tag_drop');
		
// Actions with conditions
//-> Change the hardcoded URL only if no unique cat/tag is actiated.		
	if(get_option('cattopage_wud_unique')==0 && (get_option('cattopage_wud_cat') == "page" || get_option('cattopage_wud_tag') == "page" )){
		add_filter( 'page_link', 'cattopage_wud_custom_urls', 'edit_files', 2 );	
	}		
//-> Use the same categories and tags for pages, as it is for post.		
	if(get_option('cattopage_wud_unique')==0 && (get_option('cattopage_wud_cat') == "page" || get_option('cattopage_wud_tag') == "page" ) ){
		$action = add_action('init', 'cattopage_wud_reg_cat_tag');
		if ($action != 1){			
			$action = add_action('plugins_loaded','cattopage_wud_reg_cat_tag');
		}
		if ( ! is_admin()) {
			add_action( 'pre_get_posts', 'cattopage_wud_cat_tag_archives', 10, 1 );
		}
	}	
	
//-> Use unique categories and tags for pages.	
	 if(get_option('cattopage_wud_unique')==1 && (get_option('cattopage_wud_cat') == "page" || get_option('cattopage_wud_tag') == "page" )){
		add_action( 'init', 'wud_custom_cats', 0 );
		add_action( 'init', 'wud_custom_tags', 0 );	
	 }
	 
//-> Show Category and ord tag link on pages
	if ( ! is_admin() && get_option('cattopage_wud_title')=='page' && (get_option('cattopage_wud_cat') == "page" || get_option('cattopage_wud_tag') == "page" )) {
		//the category/tag in the page
		if (get_option('cattopage_wud_index_pos')==1){
			add_filter ('the_content', 'cattopage_wud_titles_in_page');
		}
		//the category/tag below the page title
		else{
			add_filter( 'the_title', 'cattopage_wud_titles', 10, 2);
		}		
	}

//-> Add HATOM data	 
	if (get_option('cattopage_wud_hatom')==1){
		add_filter('the_content', 'cattopage_wud_hatom_data');
	}
	 
//-> Extra pages	
if(!function_exists('cattopage_wud_require')){ 
	function cattopage_wud_require() {
	//Load the admin page
		require_once( plugin_dir_path( __FILE__ ) . '/pages/c2p-wud-admin.php' );
	//Load the shortcodes
		require_once( plugin_dir_path( __FILE__ ) . '/pages/c2p-wud-shortcode.php' );
	//Load the register terms
		require_once( plugin_dir_path( __FILE__ ) . '/pages/c2p-wud-reg-terms.php' );
	//Load the widgets
		require_once( plugin_dir_path( __FILE__ ) . '/pages/c2p-wud-widgets.php' );
	//Load the options
		require_once( plugin_dir_path( __FILE__ ) . '/pages/c2p-wud-options.php' );
	}
}	 
//-> Debug used template file	
if(!function_exists('show_wud_cattopage_template')){ 
	function show_wud_cattopage_template() {
		global $template;
		$temp = basename($template);
		//echo $temp;
	}
}

//-> Category to pages wud languages
function cattopage_wud_languages() {
	load_plugin_textdomain( 'category-to-pages-wud', false, dirname(plugin_basename( __FILE__ ) ) . '/languages' );
}

//-> Lay-out and js functions	 
function cattopage_wud_site_page(){
	wp_enqueue_script('jquery');
	wp_register_script('cattopage_wud_script', plugins_url( 'js/cat-to-page.js', __FILE__ ), array('jquery'), null, true );
	wp_enqueue_script('cattopage_wud_script');	
	wp_enqueue_style( 'cattopage_wud_site_style' );
	wp_enqueue_style( 'cattopage_wud_site_style', plugins_url('css/category-to-pages-wud.css', __FILE__ ), false, null );
}

//-> CSS for admin
function cattopage_wud_styling($hook) {
	if   ( $hook == "toplevel_page_category-to-pages-wud" ) {
		wp_enqueue_style( 'cattopage_wud_admin_style' );
		wp_enqueue_style( 'cattopage_wud_admin_style', plugins_url('css/admin.css', __FILE__ ), false, null );
     }
}

//-> Settings page menu item	
function cattopage_wud_create_menu() {
	add_menu_page( 'Page Category WUD', 'Cat to Page WUD', 'manage_options', 'category-to-pages-wud', 'cattopage_wud_settings_page', plugins_url('images/wud_icon.png', __FILE__ ) );
}

//-> category-to-pages-wud options page (menu options by plugins)
function cattopage_wud_action_links( $actions, $pcwud_set ){
		static $plugin;
		if (!isset($plugin))
			$plugin = plugin_basename(__FILE__);
		if ($plugin == $pcwud_set) {
				$settings_page = array('settings' => '<a href="'.admin_url("admin.php").'?page=category-to-pages-wud">' . __('Settings', 'General') . '</a>');
				$support_link = array('support' => '<a href="https://wordpress.org/support/plugin/category-to-pages-wud" target="_blank">Support</a>');				
					$actions = array_merge($support_link, $actions);
					$actions = array_merge($settings_page, $actions);
			}			
			return $actions;
}

//-> Update variables if new version
function cattopage_wud_update(){
		global $ctp_version;
			//Update version number
				update_option('pcwud_wud_version', $ctp_version);
			//Update new fields		
			if (get_option('cattopage_wud_cat')=='') {update_option('cattopage_wud_cat', '');}			
			if (get_option('cattopage_wud_tag')=='') {update_option('cattopage_wud_tag', '');}
			if (get_option('cattopage_wud_custom_post0')=='') {update_option('cattopage_wud_custom_post0', '');}
			if (get_option('cattopage_wud_custom_post1')=='') {update_option('cattopage_wud_custom_post1', '');}
			if (get_option('cattopage_wud_custom_post2')=='') {update_option('cattopage_wud_custom_post2', '');}
			if (get_option('cattopage_wud_unique')=='') {update_option('cattopage_wud_unique', 0);}
			if (get_option('cattopage_wud_title')=='') {update_option('cattopage_wud_title', 'none');}
			if (get_option('cattopage_wud_title_size')=='') {update_option('cattopage_wud_title_size', 16);}
			if (get_option('cattopage_wud_title_h1')=='') {update_option('cattopage_wud_title_h1', 'p');}
			if (get_option('cattopage_wud_quantity')=='') {update_option('cattopage_wud_quantity', 5);}
			if (get_option('cattopage_wud_title_font')=='') {update_option('cattopage_wud_title_font', 'inherit');}
			if (get_option('cattopage_wud_index_pos')=='') {update_option('cattopage_wud_index_pos', 0);}
			if (get_option('cattopage_wud_widget_option1')=='') {update_option('cattopage_wud_widget_option1', 0);}
			if (get_option('cattopage_wud_widget_option2')=='') {update_option('cattopage_wud_widget_option2', 0);}
			if (get_option('cattopage_wud_widget_parent')=='') {update_option('cattopage_wud_widget_parent', 0);}
			if (get_option('cattopage_wud_exp_yes')=='') {update_option('cattopage_wud_exp_yes', 1);}
			if (get_option('cattopage_wud_hatom')=='') {update_option('cattopage_wud_hatom', 0);}
			if (get_option('cattopage_wud_hardcoded')=='') {update_option('cattopage_wud_hardcoded', 0);}
			if (get_option('cattopage_wud_exp_lenght')=='') {update_option('cattopage_wud_exp_lenght', 25);}	
			if (get_option('cattopage_wud_widget_title1')=='') {update_option('cattopage_wud_widget_title1', '');}
			if (get_option('cattopage_wud_widget_title2')=='') {update_option('cattopage_wud_widget_title2', '');}	
			if (get_option('cattopage_wud_widget_title3')=='') {update_option('cattopage_wud_widget_title3', '');}
}

//-> Update required variables only by activation from the plugin! (button activate)
function cattopage_wud_activation( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
			
			update_option('cattopage_wud_cat', 'page');
			update_option('cattopage_wud_tag', 'page');
			update_option('cattopage_wud_custom_post0', '');
			update_option('cattopage_wud_custom_post1', '');
			update_option('cattopage_wud_custom_post2', '');
			update_option('cattopage_wud_unique', 0);
			update_option('cattopage_wud_title', 'none');
			update_option('cattopage_wud_title_size', 16);
			update_option('cattopage_wud_title_h1', 'p');
			update_option('cattopage_wud_quantity', 5);
			update_option('cattopage_wud_title_font', 'inherit');
			update_option('cattopage_wud_index_pos', 0);
			update_option('cattopage_wud_widget_option1', 0);
			update_option('cattopage_wud_widget_option2', 0);
			update_option('cattopage_wud_widget_parent', 0);
			update_option('cattopage_wud_exp_yes', 1);
			update_option('cattopage_wud_hatom', 0);
			update_option('cattopage_wud_hardcoded', 0);
			update_option('cattopage_wud_exp_lenght', 25);
			update_option('cattopage_wud_widget_title1', 'Page Categories');
			update_option('cattopage_wud_widget_title2', 'Page Tags');
			update_option('cattopage_wud_widget_title3', 'Related Post');
			
			exit( wp_redirect( admin_url("admin.php").'?page=category-to-pages-wud&act=1' ) );
    }
}

?>
