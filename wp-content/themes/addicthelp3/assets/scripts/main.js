/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {
    // Use this variable to set up the common and page specific functions. If you
    // rename this variable, you will also need to rename the namespace below.
    var Sage = {
        // All pages
        'common': {
            init: function() {
                // JavaScript to be fired on all pages
                $('iframe[src*="youtube.com"]').each(function() {
                    $("iframe").wrap("<div class='responsive-embed widescreen'></div>");
                });

                $('iframe[src*="https://www.google.com/maps/"]').each(function() {
                    $(this).wrap("<div class='responsive-embed'></div>");
                    $(this).parent().addClass('focus');
                    $(this).addClass('scrolloff');
                    $(this).click(function() {
                        $(this).removeClass('scrolloff');
                    });
                });

                $('.dropdown-cities > .find-button').on('click', function() {
                $(this).next().slideToggle( "400" );
                $( "ul.cities" ).toggleClass("accordion-active");
                });


                $(".ah-related-posts__item_title").dotdotdot({
                    height: 40,
                });

                $(document).foundation(); // Foundation JavaScript

                $('#recent_slider').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    dots: false,
                    arrows: true,
                    centerMode: true,
                    infinite: true,
                    prevArrow: $('.ah-recent-slider__arrow--prev'),
                    nextArrow: $('.ah-recent-slider__arrow--next'),
                    responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    }, {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }]
                });

                if ($('.is-drilldown-submenu').length > 0) {
                     $('.is-drilldown-submenu').each(function() {
                         
                         var position = $(this).offset();
                         $(this).css('top','-'+position.top+'px');

                     });
                }

                if ($('.share-btn').length>0) {
                   $('.share-btn').each(function() {
                     var share = new needShareDropdown($(this)[0]);
                   });
                }
            },
            finalize: function() {
                // JavaScript to be fired on all pages, after page specific JS is fired
                $(".js-drilldown-back a").text('<');


                $("div.drilldown").on("open.zf.drilldown", function(ev, $el) {
                    $("ul.submenu").each(function(index) {
                        if ($el.index() !== index && $(this).hasClass('is-active')) {
                            $(this)
                                .attr('aria-hidden', 'true')
                                .removeClass('is-active')
                                .addClass('invisible')
                                .closest(".menu-item-has-children")
                                .attr('aria-expanded', false);
                        }
                        $("div.is-drilldown").animate({
                            minHeight: $el.find(".submenu").outerHeight()
                        }, 100);
                    });
                });

                $(".ah-footer .scroll-top-arrow").on('click', function() {
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                    return false;
                });
            }
        },
        // Home page
        'home': {
            init: function() {
                // JavaScript to be fired on the home page

            },
            finalize: function() {
                // JavaScript to be fired on the home page, after the init JS
            }
        },
        // About us page, note the change from about-us to about_us.
        'about_us': {
            init: function() {
                // JavaScript to be fired on the about us page
            }
        },
        'page_template_page_top25': {
            init: function() {


                $(document).on('click', '.btn-play', function(event) {
                    event.preventDefault();
                    $('#modal').iziModal('open', event);
                });

                $("#modal").iziModal({
                    iframe: true,
                });



                // var lat = $("#map").attr("data-lat");
                // var lng = $("#map").attr("data-lng");
                //
                // window.initTop25Map = function () {
                //     var map = new google.maps.Map(document.getElementById('map'), {
                //         zoom: 16,
                //         center: new google.maps.LatLng(lat, lng),
                //         mapTypeId: 'roadmap'
                //     });
                //
                //     var iconBase = '/wp-content/themes/addict-help/dist/images/';
                //     var icons = {
                //         info: {
                //             icon: iconBase + 'map_marker.png'
                //         }
                //     };
                //     var features = getFeatures();
                //     // Create markers.
                //     features.forEach(function (feature) {
                //         var marker = new google.maps.Marker({
                //             position: feature.position,
                //             icon: icons[feature.type].icon,
                //             map: map
                //         });
                //     });
                // };
            },
            finalize: function() {

                // JavaScript to be fired on the home page, after the init JS
            }
        },

        'archive': {
            init: function() {
                // JavaScript to be fired on the category page
                var ppp = 9;
                var pageNumber = 1;
                var catID=$("#btn_category_load_more").attr("cat-id");

                function load_category_posts() {
                    pageNumber++;
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: ajax_posts.ajaxurl,
                        data: {
                            pageNumber: pageNumber,
                            ppp: ppp,
                            cat:catID,
                            action: 'category_more_post_ajax'
                        },
                        success: function (data) {
                            if(data.length){
                                $("#archive_posts_content").append(data);

                                $(".ah-related-posts__item_title").dotdotdot({
                                    height: 40,
                                });
                            } else{
                                $("#btn_category_load_more").addClass("disabled");
                            }
                            $("#btn_category_load_more").find(".ajax-loading").css("display", "none");
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log("Ajax Request Error");
                        }
                    });
                    return false;
                }


                if($("#btn_category_load_more").length>0){
                    $("#btn_category_load_more").unbind("click").bind("click", function (event) { // When btn is pressed.
                        event.preventDefault();
                        if(!$(this).hasClass("disabled")){
                            $(this).find(".ajax-loading").css("display", "inline-block");
                            load_category_posts();
                        }
                    });
                }
            }
        }
    };

    // The routing fires all common scripts, followed by the page specific scripts.
    // Add additional events for more control over timing e.g. a finalize event
    var UTIL = {
        fire: function(func, funcname, args) {
            var fire;
            var namespace = Sage;
            funcname = (funcname === undefined) ? 'init' : funcname;
            fire = func !== '';
            fire = fire && namespace[func];
            fire = fire && typeof namespace[func][funcname] === 'function';

            if (fire) {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function() {
            // Fire common init JS
            UTIL.fire('common');

            // Fire page-specific init JS, and then finalize JS
            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
                UTIL.fire(classnm);
                UTIL.fire(classnm, 'finalize');
            });

            // Fire common finalize JS
            UTIL.fire('common', 'finalize');
        }
    };

    // Load Events
    $(document).ready(UTIL.loadEvents);


})(jQuery); // Fully reference jQuery after this point.