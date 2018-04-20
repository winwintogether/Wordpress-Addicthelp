<?php
/*
 * Add default plugin options
 */
function ytppInstall() {
    add_option('ytpp_rel', 0);
    add_option('ytpp_info', 0);
    add_option('ytpp_controls', 1);
    add_option('ytpp_privacy', 0);

    add_option('ytppYouTubeApi', '');
}

/*
 * Add plugin options page
 */
function ytPlaylist() {
    add_options_page(__('YouTube Playlist Player', 'youtube-playlist-player'), __('YouTube Playlist Player', 'youtube-playlist-player'), 'manage_options', 'ytpp', 'ytpp_settings');
}

/*
 * Show static player/playlist
 *
 * @return string
 */
function playerShow($atts) {
    wp_enqueue_script('ytpp');
    wp_enqueue_style('ytpp');

    extract(shortcode_atts(array(
        'mainid' => '',
        'vdid' => ''
    ), $atts));

    $ytpp_height = (int) get_option('ytpp_height');
    $mainId = trim($mainid);
    $vdId = trim($vdid);

    $ytppRel = (int) get_option('ytpp_rel');
    $ytppInfo = (int) get_option('ytpp_info');
    $ytppControls = (int) get_option('ytpp_controls');
    $ytppPrivacy = (int) get_option('ytpp_privacy');
    $ytppYouTubeUri = 'https://www.youtube.com';
    if ($ytppPrivacy === 1) {
        $ytppYouTubeUri = 'https://www.youtube-nocookie.com';
    }

    return '<div id="yt-container" class="main_box">
        <a name="ytplayer" class="f"><iframe name="ytpl-frame" id="ytpl-frame" type="text/html" rel="' . $mainId . '" src="' . $ytppYouTubeUri . '/embed/' . $mainId . '?rel=' . $ytppRel . '&hd=1&version=3&iv_load_policy=3&showinfo=' . $ytppInfo . '&controls=' . $ytppControls . '&origin=' . home_url() . '" width="560" height="315"></iframe></a>
        <div id="ytpp-playlist-container" class="ytpp-playlist-container" data-playlist="' . $vdId . '"><div id="ytplayer_div2"></div></div>
    </div>';
}

/*
 * Show dynamic player/playlist
 *
 * Uses YouTube Data API v3.
 *
 * @return string
 */
function ytppPlayerShowV3($atts) {
    wp_enqueue_script('ytppv3');
    wp_enqueue_style('ytpp');

    extract(shortcode_atts(array(
        'mainid' => '',
        'vdid' => ''
    ), $atts));

    $ytppYouTubeApi = (string) get_option('ytppYouTubeApi');
    $apiKey = trim($ytppYouTubeApi);
    $mainId = trim($mainid);
    $vdId = trim($vdid);

    $ytppRel = (int) get_option('ytpp_rel');
    $ytppInfo = (int) get_option('ytpp_info');
    $ytppControls = (int) get_option('ytpp_controls');
    $ytppPrivacy = (int) get_option('ytpp_privacy');
    $ytppYouTubeUri = 'https://www.youtube.com';
    if ($ytppPrivacy === 1) {
        $ytppYouTubeUri = 'https://www.youtube-nocookie.com';
    }

    return '<div class="yt-api-container" data-mainid="' . $mainId . '" data-vdid="' . $vdId . '" data-apikey="' . $apiKey . '">
        <iframe id="vid_frame" src="' . $ytppYouTubeUri . '/embed/' . $mainId . '?rel=' . $ytppRel . '&showinfo=' . $ytppInfo . '&autohide=1&controls=' . $ytppControls . '" width="560" height="315"></iframe>

        <div class="yt-api-video-list"></div>
    </div>';
}
