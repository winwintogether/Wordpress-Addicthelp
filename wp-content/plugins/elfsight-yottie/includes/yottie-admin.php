<?php

if (!defined('ABSPATH')) exit;

function elfsight_yottie_add_action_links($links) {
    $links[] = '<a href="' . esc_url(admin_url('admin.php?page=yottie')) . '">Settings</a>';
    $links[] = '<a href="http://codecanyon.net/user/elfsight/portfolio?ref=Elfsight" target="_blank">More plugins by Elfsight</a>';
    return $links;
}
add_filter('plugin_action_links_' . ELFSIGHT_YOTTIE_PLUGIN_SLUG, 'elfsight_yottie_add_action_links');


function elfsight_yottie_admin_init() {
    wp_register_style('yottie-admin', plugins_url('assets/yottie-admin.css', ELFSIGHT_YOTTIE_FILE));
    wp_register_script('yottie', plugins_url('assets/yottie/dist/jquery.yottie.bundled.js', ELFSIGHT_YOTTIE_FILE), array('jquery'), ELFSIGHT_YOTTIE_VERSION);
    wp_register_script('yottie-admin', plugins_url('assets/yottie-admin.js', ELFSIGHT_YOTTIE_FILE), array('jquery', 'yottie'));
}

function elfsight_yottie_admin_scripts() {
    wp_enqueue_style('yottie-admin');
    wp_enqueue_script('yottie');
    wp_enqueue_script('yottie-admin');
}

function elfsight_yottie_create_menu() {
    $page_hook = add_menu_page(__('Yottie', ELFSIGHT_YOTTIE_TEXTDOMAIN) , __('Yottie', ELFSIGHT_YOTTIE_TEXTDOMAIN), 'manage_options', ELFSIGHT_YOTTIE_SLUG, 'elfsight_yottie_settings_page', plugins_url('assets/img/yottie-wp-icon.png', ELFSIGHT_YOTTIE_FILE));
    add_action('admin_init', 'elfsight_yottie_admin_init');
    add_action('admin_print_styles-' . $page_hook, 'elfsight_yottie_admin_scripts');
}
add_action('admin_menu', 'elfsight_yottie_create_menu');


function elfsight_yottie_underscore_to_cc($l) {
    return strtoupper(substr($l[0], 1));
}


function elfsight_yottie_update_activation_data() {
    if (!wp_verify_nonce($_REQUEST['nonce'], 'elfsight_yottie_update_activation_data_nonce')) {
        exit;
    }

    update_option('elfsight_yottie_purchase_code', !empty($_REQUEST['purchase_code']) ? $_REQUEST['purchase_code'] : '');
    update_option('elfsight_yottie_activated', !empty($_REQUEST['activated']) ? $_REQUEST['activated'] : '');
}
add_action('wp_ajax_elfsight_yottie_update_activation_data', 'elfsight_yottie_update_activation_data');


function elfsight_yottie_get_new_version() {
    $latest_version = get_option('elfsight_yottie_latest_version', '');
    $last_check_datetime = get_option('elfsight_yottie_last_check_datetime', '');

    $result = array();

    if (!empty($last_check_datetime)) {
        $result['message'] = sprintf(__('Last checked on %1$s at %2$s', ELFSIGHT_YOTTIE_TEXTDOMAIN), date_i18n(get_option('date_format'), $last_check_datetime), date_i18n(get_option('time_format'), $last_check_datetime));
    }

    if (!empty($latest_version) && version_compare(ELFSIGHT_YOTTIE_VERSION, $latest_version, '<')) {
        $result['version'] = $latest_version;
    }

    die(json_encode($result));
}
add_action('wp_ajax_elfsight_yottie_get_new_version', 'elfsight_yottie_get_new_version');


function elfsight_yottie_settings_page() {
    global $elfsight_yottie_defaults, $elfsight_yottie_color_schemes;

    $purchase_code = get_option('elfsight_yottie_purchase_code', '');
    $activated = get_option('elfsight_yottie_activated', '') == 'true';

    $latest_version = get_option('elfsight_yottie_latest_version', '');
    $last_check_datetime = get_option('elfsight_yottie_last_check_datetime', '');

    $activation_css_classes = '';
    if ($activated) {
        $activation_css_classes .= 'yottie-admin-activated ';
    }
    else if (!empty($purchase_code)) {
        $activation_css_classes .= 'yottie-admin-activation-invalid ';
    }
    if (!empty($latest_version) && version_compare(ELFSIGHT_YOTTIE_VERSION, $latest_version, '<')) {
        $activation_css_classes .= 'yottie-admin-activation-has-new-version ';
    }

    // defaults to json
    $yottie_json = array();
    foreach ($elfsight_yottie_defaults as $name => $val) {
        if ($name == 'header_info' || $name == 'video_info' || $name == 'popup_info') {
            $val = explode(', ', $val);
        }

        $yottie_json[preg_replace_callback('/(_.)/', 'elfsight_yottie_underscore_to_cc', $name)] = $val;
    }

    // color schemes to json
    $yottie_color_schemes_json = array();
    foreach ($elfsight_yottie_color_schemes as $scheme_name => $scheme_colors) {
        $yottie_color_schemes_json[$scheme_name] = array();
        foreach ($scheme_colors as $name => $value) {
            $yottie_color_schemes_json[$scheme_name][preg_replace_callback('/(_.)/', 'elfsight_yottie_underscore_to_cc', $name)] = $value;
        }
    }

    ?><div class="yottie-admin wrap">
        <h2 class="yottie-admin-wp-messages-hack"></h2>
        <div class="yottie-admin-header">
            <div class="yottie-admin-header-support">
                <h4><?php _e('Support', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></h4>

                <div class="yottie-admin-header-support-email">
                    <span class="yottie-admin-icon-email yottie-admin-icon"></span>
                    <a class="yottie-admin-header-support-email-label" href="mailto:info@elfsight.com">info@elfsight.com</a>
                </div>

                <div class="yottie-admin-header-support-comments">
                    <span class="yottie-admin-icon-comments yottie-admin-icon"></span>
                    <a class="yottie-admin-header-support-comments-label" href="http://codecanyon.net/item/youtube-channel-wordpress-plugin-yottie/14115701/comments?ref=Elfsight" target="_blank">Comments on Codecanyon</a>
                </div>

                <div class="yottie-admin-header-support-skype">
                    <span class="yottie-admin-icon-skype yottie-admin-icon"></span>
                    <a class="yottie-admin-header-support-skype-label" href="skype:support.elfsight">support.elfsight</a>
                </div>

                <div class="yottie-admin-header-support-label">24/7</div>
            </div>

            <a class="yottie-admin-header-logo" href="<?php echo admin_url('admin.php?page=yottie'); ?>" title="<?php _e('Yottie - WordPress YouTube Channel Plugin', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?>">
                <img src="<?php echo plugins_url('assets/img/logo.png', ELFSIGHT_YOTTIE_FILE); ?>" width="230" height="85" alt="<?php _e('Yottie - WordPress YouTube Channel Plugin', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?>">
            </a>

            <div class="yottie-admin-header-version"><?php _e('version ' . ELFSIGHT_YOTTIE_VERSION, ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></div>

            <div class="yottie-admin-header-title"><?php _e('WordPress YouTube Channel Plugin', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></div>
        </div>

        <div class="yottie-admin-demo yottie-admin-block">
            <div class="yottie-admin-block-icon"><span class="yottie-admin-icon-settings yottie-admin-icon"></span></div>

            <div class="yottie-admin-block-inner">
                <div class="yottie-admin-demo-header">
                    <h2><?php _e('Installation', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></h2>
                    <span class="yottie-admin-demo-header-hint"><?php _e('Adjust the plugin as you wish, get the shortcode and paste it into any page or post.', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></span>
                </div>

                <?php include(ELFSIGHT_YOTTIE_PATH . '/includes/yottie-demo.php'); ?>

                <script>
                    function getYottieDefaults() {
                        return <?php echo json_encode($yottie_json); ?>;
                    }

                    function getYottieColorSchemes() {
                        return <?php echo json_encode($yottie_color_schemes_json); ?>;
                    }
                </script>
            </div>
        </div>

        <div class="<?php echo $activation_css_classes; ?>yottie-admin-activation yottie-admin-block">
            <div class="yottie-admin-block-icon">
                <span class="yottie-admin-icon-satellite yottie-admin-icon"></span>
                <span class="yottie-admin-icon-satellite-gif yottie-admin-icon"></span>
            </div>

            <div class="yottie-admin-block-inner">
                <h2><?php _e('Activate Yottie', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></h2>

                <div class="yottie-admin-activation-advantages">
                    <h3><?php _e('Advantages of Activation', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></h3>
                    <p><?php _e('Quick Support - when your plugin is activated we can reply on your requests faster.', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></p>
                    <p><?php _e('Live Updates - easy and fast way to update Yottie.', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></p>
                </div>

                <form class="yottie-admin-activation-form"  data-nonce="<?php echo wp_create_nonce('elfsight_yottie_update_activation_data_nonce'); ?>" data-activation-url="<?php echo ELFSIGHT_YOTTIE_UPDATE_URL; ?>" data-activation-slug="<?php echo ELFSIGHT_YOTTIE_SLUG; ?>" data-activation-version="<?php echo ELFSIGHT_YOTTIE_VERSION; ?>">
                    <input class="yottie-admin-activation-form-activated-input" type="hidden" name="activated" value="<?php echo $activated; ?>">

                    <div class="yottie-admin-activation-form-field">
                        <label>
                            <?php _e('Please enter your CodeCanyon Yottie Purchase Code', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?>
                            <input class="yottie-admin-activation-form-purchase-code-input" type="text" placeholder="<?php _e('Purchase code', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?>" name="purchase_code" value="<?php echo $purchase_code; ?>" class="regular-text" spellcheck="false" autocomplete="off">
                        </label>
                    </div>

                    <div class="yottie-admin-activation-form-message-success yottie-admin-activation-form-message"><?php _e('Yottie is successfuly activated', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></div>
                    <div class="yottie-admin-activation-form-message-error yottie-admin-activation-form-message"><?php _e('Your purchase code is not valid', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></div>
                    <div class="yottie-admin-activation-form-message-fail yottie-admin-activation-form-message"><?php _e('Error occurred while checking your purchase code. Please, contact our support team via <a href="mailto:info@elfsight.com">info@elfsight.com</a>. We apologize for inconveniences.', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></div>

                    <div class="yottie-admin-activation-form-field">
                        <button class="yottie-admin-activation-form-activate" type="submit"><?php _e('Activate', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></button>
                    </div>
                </form>

                <div class="yottie-admin-activation-version">
                    <div class="yottie-admin-activation-version-current">
                        <span class="yottie-admin-activation-version-current-label"><?php _e('Current version', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></span>
                        <span class="yottie-admin-activation-version-current-value"><?php echo ELFSIGHT_YOTTIE_VERSION; ?></span>
                    </div>

                    <div class="yottie-admin-activation-version-message-new yottie-admin-activation-version-message">
                        <span class="yottie-admin-icon-info-orange yottie-admin-icon"></span>
                        <span class="yottie-admin-activation-version-message-text"><?php _e('New version is available', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></span>
                    </div>

                    <div class="yottie-admin-activation-version-message-latest yottie-admin-activation-version-message">
                        <span class="yottie-admin-icon-info-green yottie-admin-icon"></span>
                        <span class="yottie-admin-activation-version-message-text"><?php _e('You have the latest version', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></span>
                    </div>

                    <a class="yottie-admin-activation-version-update-button" href="<?php echo is_multisite() ? network_admin_url('update-core.php') : admin_url('update-core.php'); ?>"><?php _e('Update to', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?> <span class="yottie-admin-activation-version-update-button-version"><?php echo $latest_version; ?></span></a>

                    <div class="yottie-admin-activation-version-check-date">
                        <?php if (!empty($last_check_datetime)) { ?>
                            <?php printf(__('Last checked on %1$s at %2$s', ELFSIGHT_YOTTIE_TEXTDOMAIN), date_i18n(get_option('date_format'), $last_check_datetime), date_i18n(get_option('time_format'), $last_check_datetime)); ?>
                        <?php } ?>
                    </div>

                    <div class="yottie-admin-activation-version-message-activate yottie-admin-activation-version-message">
                        <span class="yottie-admin-icon-info-red yottie-admin-icon"></span>
                        <span class="yottie-admin-activation-version-message-text"><?php _e('Activate Yottie for easy and fast updates', ELFSIGHT_YOTTIE_TEXTDOMAIN); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
