/* global jQuery */

var ytApiKey = jQuery('.yt-api-container').data('apikey'),
    videoId = jQuery('.yt-api-container').data('vdid');

// https://developers.google.com/youtube/v3/docs/videos/list
jQuery.get("https://www.googleapis.com/youtube/v3/videos?part=snippet&fields=items(id,snippet)&id=" + videoId + "&key=" + ytApiKey, function(data) {
    var videoId = jQuery('.yt-api-container').data('vdid');
    var videoArray = videoId.split(',');

    jQuery.each(videoArray, function(index, value) {
        var videoElement = '<div class="yt-api-video-item yt-' + data.items[index].id + '" data-id="' + data.items[index].id + '"><div class="yt-api-video-thumb"><img src="' + data.items[index].snippet.thumbnails.high.url + '" alt="' + data.items[index].snippet.title + '"></div><div class="yt-api-video-description">' + data.items[index].snippet.title + '</div></div>';

        jQuery('.yt-api-video-list').append(videoElement);
    });
});

jQuery(document).on('click', '.yt-api-video-item', function() {
    var ytUri = 'https://www.youtube.com',
        thisId = jQuery(this).data('id');

    document.getElementById('vid_frame').src = ytUri + '/embed/' + thisId + '?autoplay=1&rel=0&showinfo=1&autohide=1';
});
