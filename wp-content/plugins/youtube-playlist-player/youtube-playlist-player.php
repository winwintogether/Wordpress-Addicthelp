<?php
/*
Plugin Name: YouTube Playlist Player
Plugin URI: https://getbutterfly.com/wordpress-plugins/
Description: Display a YouTube player (with an optional playlist) on any post or page using a simple shortcode.
Version: 4.3.3
Author: Ciprian Popescu
Author URI: https://getbutterfly.com/
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: youtube-playlist-player

YouTube Playlist Player
Copyright (C) 2013-2018 Ciprian Popescu (getbutterfly@gmail.com)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

include 'includes/functions.php';
include 'includes/settings.php';

/*
 * Register/enqueue plugin scripts and styles (backend)
 */
function ytppPssAdmin() {
    wp_enqueue_style('gbad-ytpp', plugins_url('css/gbad.css', __FILE__));
}

/*
 * Register/enqueue plugin scripts and styles (frontend)
 */
function ytppPss() {
    wp_register_style('ytpp', plugins_url('css/style.css', __FILE__));
    wp_register_script('ytpp', plugins_url('js/ytpp-main.js', __FILE__), array(), '', true);
    wp_register_script('ytppv3', plugins_url('js/ytppv3-main.js', __FILE__), array('jquery'), '', true);
}

/*
 * Install plugin
 */
register_activation_hook(__FILE__, 'ytppInstall');

/*
 * Initialise plugin
 */
add_action('admin_menu', 'ytPlaylist');
add_action('admin_enqueue_scripts', 'ytppPssAdmin');
add_action('wp_enqueue_scripts', 'ytppPss');

/*
 * Add plugin shortcodes
 */
add_shortcode('yt_playlist', 'playerShow');
add_shortcode('yt_playlist_v3', 'ytppPlayerShowV3');
