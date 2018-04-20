<?php
 /*
 * === Category to Pages WUD ===
 * Contributors: wistudatbe
 * Author: Danny WUD
 */
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) { 
exit(); 
} 
// Clean up the options table delete data starts with 'cattopage_wud'
global $wpdb;
	$wpdb->query( "DELETE FROM {$wpdb->options} WHERE LEFT(option_name, 14) = 'cattopage_wud_'" );
	$wpdb->query( "DELETE FROM {$wpdb->options} WHERE LEFT(option_name, 10) = 'pcwud_wud_'" );
?>
