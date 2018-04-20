<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function ytpp_settings() { ?>
	<div class="wrap">
		<h2><?php _e('YouTube Playlist Player Settings', 'youtube-playlist-player'); ?></h2>

        <?php $tab = isset($_GET['tab']) ? $_GET['tab'] : 'dashboard'; ?>
        <h2 class="nav-tab-wrapper">
            <a href="<?php echo admin_url('admin.php?page=ytpp&amp;tab=dashboard'); ?>" class="nav-tab <?php echo $tab == 'dashboard' ? 'nav-tab-active' : ''; ?>"><?php _e('Dashboard', 'youtube-playlist-player'); ?></a>
            <a href="<?php echo admin_url('admin.php?page=ytpp&amp;tab=settings'); ?>" class="nav-tab <?php echo $tab == 'settings' ? 'nav-tab-active' : ''; ?>"><?php _e('General Settings', 'youtube-playlist-player'); ?></a>
            <a href="<?php echo admin_url('admin.php?page=ytpp&amp;tab=api'); ?>" class="nav-tab <?php echo $tab == 'api' ? 'nav-tab-active' : ''; ?>"><?php _e('YouTube API', 'youtube-playlist-player'); ?></a>
            <a href="<?php echo admin_url('admin.php?page=ytpp&amp;tab=help'); ?>" class="nav-tab <?php echo $tab == 'help' ? 'nav-tab-active' : ''; ?>"><?php _e('Help/Usage', 'youtube-playlist-player'); ?></a>
        </h2>

        <?php if ((string) $tab === 'dashboard') { ?>
            <div id="poststuff">
                <h3><?php _e('About YouTube Playlist Player', 'youtube-playlist-player'); ?></h3>
                <p>Display a YouTube player (with an optional playlist) on any post or page using a simple shortcode. The plugin supports a static YouTube player (no video title) and a dynamic one (video title) using the YouTube Data API v3.</p>

                <p>Embedded players must have a viewport that is at least 200px by 200px. If the player displays controls, it must be large enough to fully display the controls without shrinking the viewport below the minimum size. We recommend 16:9 players be at least 480 pixels wide and 270 pixels tall.</p>
                <p>By embedding YouTube videos on your site, you are agreeing to <a href="https://developers.google.com/youtube/terms/api-services-terms-of-service" rel="external">YouTube API Terms of Service</a>.</p>

                <hr>
                <p><img src="<?php echo plugins_url('img/developed-with-youtube.png', dirname(__FILE__)); ?>" alt="Developed with YouTube" class="ytpp-developed"></p>

                <hr>
                <p>For support, feature requests and bug reporting, please visit the <a href="https://getbutterfly.com/" rel="external">official website</a>. If you enjoy this plugin, don't forget to rate it. Also, try our other WordPress plugins at <a href="https://getbutterfly.com/wordpress-plugins/" rel="external" target="_blank">getButterfly.com</a>.</p>
                <p>&copy;<?php echo date('Y'); ?> <a href="https://getbutterfly.com/" rel="external"><strong>getButterfly</strong>.com</a> &middot; <small>Code wrangling since 2005</small></p>
            </div>
            <?php
        } else if ((string) $tab === 'settings') {
            if (isset($_POST['info_update1']) && current_user_can('manage_options')) {
                if (isset($_POST['ytpp_rel'])) {
                    update_option('ytpp_rel', (int) sanitize_text_field($_POST['ytpp_rel']));
                } else {
                    update_option('ytpp_rel', 0);
                }
                if (isset($_POST['ytpp_info'])) {
                    update_option('ytpp_info', (int) sanitize_text_field($_POST['ytpp_info']));
                } else {
                    update_option('ytpp_info', 0);
                }
                if (isset($_POST['ytpp_controls'])) {
                    update_option('ytpp_controls', (int) sanitize_text_field($_POST['ytpp_controls']));
                } else {
                    update_option('ytpp_controls', 0);
                }
                if (isset($_POST['ytpp_privacy'])) {
                    update_option('ytpp_privacy', (int) sanitize_text_field($_POST['ytpp_privacy']));
                } else {
                    update_option('ytpp_privacy', 0);
                }

                echo '<div class="updated notice is-dismissible"><p>Settings updated!</p></div>';
            }
            ?>
            <form method="post" action="">
                <h3><?php _e('Player Settings', 'youtube-playlist-player'); ?></h3>

                <p>
                    <input type="checkbox" name="ytpp_rel" id="ytpp_rel" value="1" <?php if (get_option('ytpp_rel') == 1) echo 'checked'; ?>> <label for="ytpp_rel">Show suggested videos when the video finishes</label>
                </p>
                <p>
                    <input type="checkbox" name="ytpp_info" id="ytpp_info" value="1" <?php if (get_option('ytpp_info') == 1) echo 'checked'; ?>> <label for="ytpp_info">Show video title and player actions</label>
                </p>
                <p>
                    <input type="checkbox" name="ytpp_controls" id="ytpp_controls" value="1" <?php if (get_option('ytpp_controls') == 1) echo 'checked'; ?>> <label for="ytpp_controls">Show player controls</label>
                </p>
                <p>
                    <input type="checkbox" name="ytpp_privacy" id="ytpp_privacy" value="1" <?php if (get_option('ytpp_privacy') == 1) echo 'checked'; ?>> <label for="ytpp_privacy">Enable privacy-enhanced mode</label>
                    <br><small>When you turn on privacy-enhanced mode, YouTube won't store information about visitors on your website unless they play the video.</small>
                </p>

                <p><input type="submit" name="info_update1" class="button button-primary" value="<?php _e('Save Changes', 'youtube-playlist-player'); ?>"></p>
            </form>
            <?php
        } else if ((string) $tab === 'api') {
            if (isset($_POST['info_update1']) && current_user_can('manage_options')) {
                update_option('ytppYouTubeApi', (string) sanitize_text_field($_POST['ytppYouTubeApi']));

                echo '<div class="updated notice is-dismissible"><p>Settings updated!</p></div>';
            }
            ?>
            <form method="post" action="">
                <h3><?php _e('YouTube API Settings', 'youtube-playlist-player'); ?></h3>

                <p>
                    <input type="text" name="ytppYouTubeApi" id="ytppYouTubeApi" value="<?php echo get_option('ytppYouTubeApi'); ?>" class="regular-text" placeholder="YouTube API"> <label for="ytppYouTubeApi">YouTube API</label>
                    <br><small>See the <a href="https://developers.google.com/youtube/v3/docs/" rel="external">YouTube API documentation here</a>.</small>
                </p>

                <p><input type="submit" name="info_update1" class="button button-primary" value="<?php _e('Save Changes', 'youtube-playlist-player'); ?>"></p>
            </form>
            <?php
        } else if ((string) $tab === 'help') { ?>
            <div id="poststuff">
                <h3><?php _e('Help &amp; Usage Details', 'youtube-playlist-player'); ?></h3>
                <h4>Use one of the shortcodes below to add the YouTube player</h4>
                <p>Static YouTube player: <code class="codor">[yt_playlist mainid="xcJtL7QggTI" vdid="xcJtL7QggTI,AheYbU8J5Tc,X0zGS4-UKgg,74SZXCQb44s,2M0XCH9q3YI"]</code></p>
                <p>Dynamic YouTube player (YouTube Data API v3): <code class="codor">[yt_playlist_v3 mainid="xcJtL7QggTI" vdid="xcJtL7QggTI,AheYbU8J5Tc,X0zGS4-UKgg,74SZXCQb44s,2M0XCH9q3YI"]</code></p>
                <p>or use the shortcode in one of your theme templates using the code below:</p>
                <p><code class="codor">&lt;?php echo do_shortcode('[yt_playlist mainid="xcJtL7QggTI" vdid="xcJtL7QggTI,AheYbU8J5Tc,X0zGS4-UKgg,74SZXCQb44s,2M0XCH9q3YI"]'); ?&gt;</code></p>
                <p><code class="codor">&lt;?php echo do_shortcode('[yt_playlist_v3 mainid="xcJtL7QggTI" vdid="xcJtL7QggTI,AheYbU8J5Tc,X0zGS4-UKgg,74SZXCQb44s,2M0XCH9q3YI"]'); ?&gt;</code></p>

                <p><b>Note:</b> Shortcodes can be added to posts, pages, custom post types or widgets.</p>

                <hr>
                <p><code class="codor">mainid</code> is the main video ID and <code class="codor">vdid</code> is the list of playlist videos (also include the main video ID).</p>
                <p>Style the <code class="codor">.main_box</code> element to change the videos (and playlist) container.</p>
            </div>
            <?php
        }
        ?>
	</div>
<?php
}
