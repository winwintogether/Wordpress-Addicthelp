var ytTimeoutId;

function ytplayer_render_playlist(what, howmany) {
    var ytplayer_playlist = [],
        ytplayer_playitem = 0,
        varr = what.toString();
    var varr1 = varr.split(",");

    for (x = 0; x < howmany; x++) {
        ytplayer_playlist.push(varr1[x]);
    }

    for (var i = 0; i < ytplayer_playlist.length; i++) {
        var img = document.createElement("img"),
            a = document.createElement("a");

        img.src = "https://img.youtube.com/vi/" + ytplayer_playlist[i] + "/default.jpg";
        a.href = "https://www.youtube.com/embed/" + ytplayer_playlist[i] + "?rel=0&hd=1&version=3&iv_load_policy=3&showinfo=0&autoplay=1";
        a.rel = ytplayer_playlist[i];
        a.target = "ytpl-frame";

        a.onclick = (function(j) {
            return function() {
                ytplayer_playitem = j;
                ytplayer_playlazy(0); // 1000

                var els = document.querySelectorAll("#ytplayer_div2 a");
                for (var n = 0; n < els.length; n++) {
                    els[n].classList.remove('active');
                }

                this.classList.add("active");
            };
        })(i);
        a.appendChild(img);
        if (howmany > 1) {
            document.getElementById("ytplayer_div2").appendChild(a);
        }
    }
}

function ytplayer_playlazy(delay) {
    if (typeof ytplayer_playlazy.timeoutid != "undefined") {
        window.clearTimeout(ytplayer_playlazy.timeoutid);
    }
    ytplayer_playlazy.timeoutid = window.setTimeout(function() {
        var o = document.getElementById("ytplayer_object");
        if (o) {
            o.loadVideoById(ytplayer_playlist[ytplayer_playitem]);
        }
    }, delay);
}

window.onload = function() {
    ytTimeoutId = setInterval(function() {
        if (document.getElementById('yt-container')) {
            var playListContainer = document.getElementById('ytpp-playlist-container'),
                playList = playListContainer.dataset.playlist,
                ytpp_novd = playList.split(',').length;

            ytplayer_render_playlist(playList, ytpp_novd);

            window.clearInterval(ytTimeoutId);
        }
    }, 1000);

    setTimeout(function() {
        window.clearInterval(ytTimeoutId);
    }, 15000);



    /*
     * Fluid video container
     *
     * @url https://github.com/toddmotto/fluidvids
     */
    (function (window, document, undefined) {
        /*
         * Grab all iframes on the page or return
         */
        var iframes = document.getElementsByTagName('iframe');

        /*
         * Loop through the iframes array
         */
        for (var i = 0; i < iframes.length; i++) {
            var iframe = iframes[i],
                /*
                 * RegExp, extend this if you need more players
                 */
                players = /www.youtube.com|player.vimeo.com/;

            /*
             * If the RegExp pattern exists within the current iframe
             */
            if (iframe.src.search(players) > 0) {
                /*
                 * Calculate the video ratio based on the iframe's w/h dimensions
                 */
                var videoRatio = (iframe.height / iframe.width) * 100;

                /*
                 * Replace the iframe's dimensions and position
                 * the iframe absolute, this is the trick to emulate
                 * the video ratio
                 */
                iframe.style.position = 'absolute';
                iframe.style.top = '0';
                iframe.style.left = '0';
                iframe.width = '100%';
                iframe.height = '100%';
      
                /*
                 * Wrap the iframe in a new <div> which uses a
                 * dynamically fetched padding-top property based
                 * on the video's w/h dimensions
                 */
                var wrap = document.createElement('div');
                wrap.className = 'fluid-vids';
                wrap.style.width = '100%';
                wrap.style.position = 'relative';
                wrap.style.paddingTop = videoRatio + '%';

                /*
                 * Add the iframe inside our newly created <div>
                 */
                var iframeParent = iframe.parentNode;
                iframeParent.insertBefore(wrap, iframe);
                wrap.appendChild(iframe);
            }
        }
    })(window, document);
}
