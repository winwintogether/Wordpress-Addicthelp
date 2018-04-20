<?php

if (!defined('ABSPATH')) exit;


// register styles and scripts
function elfsight_yottie_lib() {
	global $elfsight_yottie_add_scripts;

	wp_register_script('yottie', plugins_url('assets/yottie/dist/jquery.yottie.bundled.js', ELFSIGHT_YOTTIE_FILE), array(), ELFSIGHT_YOTTIE_VERSION);

	if ($elfsight_yottie_add_scripts) {
		wp_print_scripts('yottie');
	}
}
add_action('wp_footer', 'elfsight_yottie_lib');

?>