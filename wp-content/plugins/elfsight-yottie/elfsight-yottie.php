<?php
/*
Plugin Name: Yottie
Description: YouTube Channel Plugin for WordPress. Select desired videos and YouTube channels to display them on your website. Manage 100+ parameters to customize the plugin as you wish.
Plugin URI: https://elfsight.com/youtube-channel-plugin-yottie/wordpress/
Version: 1.3.0
Author: Elfsight
Author URI: https://elfsight.com/
*/

if (!defined('ABSPATH')) exit;


define('ELFSIGHT_YOTTIE_SLUG', 'elfsight-yottie');
define('ELFSIGHT_YOTTIE_VERSION', '1.3.0');
define('ELFSIGHT_YOTTIE_FILE', __FILE__);
define('ELFSIGHT_YOTTIE_PATH', plugin_dir_path(__FILE__));
define('ELFSIGHT_YOTTIE_URL', plugin_dir_url( __FILE__ ));
define('ELFSIGHT_YOTTIE_PLUGIN_SLUG', plugin_basename( __FILE__ ));
define('ELFSIGHT_YOTTIE_TEXTDOMAIN', 'yottie');
define('ELFSIGHT_YOTTIE_UPDATE_URL', 'https://a.elfsight.com/updates/');


require_once(ELFSIGHT_YOTTIE_PATH . '/includes/yottie-defaults.php');
require_once(ELFSIGHT_YOTTIE_PATH . '/includes/noerror.php');
require_once(ELFSIGHT_YOTTIE_PATH . '/includes/yottie-update.php');
require_once(ELFSIGHT_YOTTIE_PATH . '/includes/yottie-admin.php');
require_once(ELFSIGHT_YOTTIE_PATH . '/includes/yottie-shortcode.php');
require_once(ELFSIGHT_YOTTIE_PATH . '/includes/yottie-vc.php');
require_once(ELFSIGHT_YOTTIE_PATH . '/includes/yottie-lib.php');
require_once(ELFSIGHT_YOTTIE_PATH . '/includes/yottie-activation.php');
