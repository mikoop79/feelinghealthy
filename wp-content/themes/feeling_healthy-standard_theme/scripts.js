// JS Scripts for feelinghealthy.com.au by Kandan - NK 130518

/* DOCUMENT READY */

$(document).ready(function() {

    resizeWrapper();
    calloutColumn();
    generalFormatting();
    setModalWindow();

    $('#gform_wrapper_4').children('br:eq(0)').remove();
    /* RUNNING WINDOW.LOAD HERE MAKES SURE THESE FUNCTIONS ARE RAN AFTER EVERYTHING HAS LOADED */
    $(window).load(function() {

    });

});

/* DOCUMENT RESIZE */

$(window).resize(function() {
    resizeWrapper();
    setModalWindow();
});

/* END DOCUMENT READY */

/* FUNCTIONS & PLUGINS */

/* WRAPPER HEIGHT RESIZE */

function resizeWrapper() {

    var footerWindowHeight = $(window).height();
    var footerFrameHeight = $("#frame").height();
    if (footerFrameHeight < (footerWindowHeight - 141)) {
        $("#footer").addClass("sticky-footer");
    } else if (footerFrameHeight < footerWindowHeight + 141) {
        $("#footer").removeClass("sticky-footer");
    }
}

/* MODAL WINDOW */

function setModalWindow() {

    var windowHeight = $(window).height();
    var windowWidth = $(window).width();

    var documentHeight = $(document).height();

    var modalHeight = $('#newsletter-modal').height();
    var modalWidth = $('#newsletter-modal').width();

    var placeModalX = (windowWidth / 2) - (modalWidth / 2);
    var placeModalY = (windowHeight / 2) - (modalHeight / 2);

    $('#newsletter-modal').css({
        'top': placeModalY
    });
    $('#newsletter-modal').css({
        'left': placeModalX
    });

    $('#newsletter-modal-veil').css({
        'height': documentHeight
    });
    $('#newsletter-modal-veil').css({
        'width': windowWidth
    });

}

function showModalWindow() {

    /* CHECKS FOR COOKIE AND WHETHER TO DISPLAY MODAL AUTOMATICALLY */

    var isItTime = $.cookie("modalTimeout");

    if (isItTime == "active") {
        clearInterval(window.showForm);
        console.log("already set cookie");
        return false;
    } else {

        /* RESETS COOKIES FOR MODAL TIMEOUT */

        var date = new Date();
        var minutes = 10;
        date.setTime(date.getTime() + (minutes * 60 * 1000));
        $.cookie("modalTimeout", "active", {
            expires: date
        });

        $('body').css({
            'overflow': 'hidden'
        });
        openModal();
    }
}

var hideModal; // this is the setInterval outside the scope
var time_to_close_window = 3000; // milliseconds

var openModal = function() {
    /* OPENS SUBSCRIBE FORM */

    $('body').css({
        'overflow': 'hidden'
    });
    $('#newsletter-modal-veil').fadeIn(function() {
        $('#newsletter-modal').fadeIn();
    });

    /* CHECKS TO SEE IF FORM HAS BEEN SUBMITTED */
    hideModal = setInterval(function() {
        if ($('#mce-success-response').is(":visible")) {
            setTimeout(hideModalWindow, 3000);
            clearInterval(hideModal);
        }
        console.log("sending");
    }, 1000);

}

    function hideModalWindow() {
        $('body').css({
            'overflow': 'visible'
        });
        $('#newsletter-modal').fadeOut(function() {
            $('#newsletter-modal-veil').fadeOut();
        });
    }

    /* SET STYLE ON 4th & 3rd COLUMNS */

    function calloutColumn() {
        $('.one-fourth:eq(3)').addClass('callout');
        $('.one-third:eq(2)').addClass('callout');
    }

    /* GENERAL FORMATTING */

    function generalFormatting() {
        $('.testimonial-new-line:first').css({
            'margin-top': '0'
        });
        $('.testimonial-new-line:first').css({
            'padding-top': '0'
        });
        $('.testimonial-new-line:first').css({
            'border-top': '0'
        });
        $('.testimonial-new-line > .testimonial-wrapper:first-child').addClass('first');
        $('#call-to-actions a').hover(function() {
            $(this).animate({
                'opacity': '0.6'
            }, 'fast');
        }, function() {
            $(this).animate({
                'opacity': '1'
            }, 'fast');
        });
    }

    /* DROP DOWN NAVIGATION MENU - NK 130516 */

$(document).ready(function() {
    $('#primary_nav .menu ul li').hover(
        function() {
            $(this).children('.children').fadeIn();
        },
        function() {
            $(this).children('.children').fadeOut();
        }
    );
});

/* HOVER ANIMATION FOR SOCIAL MEDIA BUTTONS */

var navDuration = 150; //time in miliseconds

$(document).ready(function() {
    $('#social-media-icons a').hover(function() {
        $(this).animate({
            marginTop: "-5px"
        }, navDuration);
    }, function() {
        $(this).animate({
            marginTop: "0px"
        }, navDuration);
    });
});


/* EASY SLIDER FOR POST SLIDER */

(function($) {

    $.fn.easySlider = function(options) {

        // default configuration properties
        var defaults = {
            prevId: 'prevBtn',
            prevText: '',
            nextId: 'nextBtn',
            nextText: '',
            controlsShow: true,
            controlsBefore: '',
            controlsAfter: '',
            controlsFade: true,
            firstId: 'firstBtn',
            firstText: 'First',
            firstShow: true,
            lastId: 'lastBtn',
            lastText: 'Last',
            lastShow: true,
            vertical: false,
            speed: 1200,
            auto: true,
            pause: 8000,
            continuous: true,
            numeric: false,
            numericId: 'controls'
        };


        var options = $.extend(defaults, options);

        this.each(function() {
            var obj = $(this);
            var s = $("li", obj).length;
            var w = $("li", obj).width();
            var h = $("li", obj).height();
            var clickable = true;
            obj.width(w);
            obj.height(h);
            obj.css("overflow", "hidden");
            var ts = s - 1;
            var t = 0;
            $("ul", obj).css('width', s * w);

            if (options.continuous) {
                $("ul", obj).prepend($("ul li:last-child", obj).clone().css("margin-left", "-" + w + "px"));
                $("ul", obj).append($("ul li:nth-child(2)", obj).clone());
                $("ul", obj).css('width', (s + 1) * w);
            };

            if (!options.vertical) $("li", obj).css('float', 'left');

            if (options.controlsShow) {
                var html = options.controlsBefore;
                if (options.numeric) {
                    html += '<ol id="' + options.numericId + '"></ol>';
                } else {
                    if (options.firstShow) html += '<span id="' + options.firstId + '"><a href=\"javascript:void(0);\">' + options.firstText + '</a></span>';
                    html += ' <span id="' + options.prevId + '"><a href=\"javascript:void(0);\">' + options.prevText + '</a></span>';
                    html += ' <span id="' + options.nextId + '"><a href=\"javascript:void(0);\">' + options.nextText + '</a></span>';
                    if (options.lastShow) html += ' <span id="' + options.lastId + '"><a href=\"javascript:void(0);\">' + options.lastText + '</a></span>';
                };

                html += options.controlsAfter;
                $(obj).after(html);
            };

            if (options.numeric) {
                for (var i = 0; i < s; i++) {
                    $(document.createElement("li"))
                        .attr('id', options.numericId + (i + 1))
                        .html('<a rel=' + i + ' href=\"javascript:void(0);\">' + (i + 1) + '</a>')
                        .appendTo($("#" + options.numericId))
                        .click(function() {
                            animate($("a", $(this)).attr('rel'), true);
                        });
                };
            } else {
                $("a", "#" + options.nextId).click(function() {
                    animate("next", true);
                });
                $("a", "#" + options.prevId).click(function() {
                    animate("prev", true);
                });
                $("a", "#" + options.firstId).click(function() {
                    animate("first", true);
                });
                $("a", "#" + options.lastId).click(function() {
                    animate("last", true);
                });
            };

            function setCurrent(i) {
                i = parseInt(i) + 1;
                $("li", "#" + options.numericId).removeClass("current");
                $("li#" + options.numericId + i).addClass("current");
            };

            function adjust() {
                if (t > ts) t = 0;
                if (t < 0) t = ts;
                if (!options.vertical) {
                    $("ul", obj).css("margin-left", (t * w * -1));
                } else {
                    $("ul", obj).css("margin-left", (t * h * -1));
                }
                clickable = true;
                if (options.numeric) setCurrent(t);
            };

            function animate(dir, clicked) {
                if (clickable) {
                    clickable = false;
                    var ot = t;
                    switch (dir) {
                        case "next":
                            t = (ot >= ts) ? (options.continuous ? t + 1 : ts) : t + 1;
                            break;
                        case "prev":
                            t = (t <= 0) ? (options.continuous ? t - 1 : 0) : t - 1;
                            break;
                        case "first":
                            t = 0;
                            break;
                        case "last":
                            t = ts;
                            break;
                        default:
                            t = dir;
                            break;
                    };
                    var diff = Math.abs(ot - t);
                    var speed = diff * options.speed;
                    if (!options.vertical) {
                        p = (t * w * -1);
                        $("ul", obj).animate({
                            marginLeft: p
                        }, {
                            queue: false,
                            duration: speed,
                            complete: adjust
                        });
                    } else {
                        p = (t * h * -1);
                        $("ul", obj).animate({
                            marginTop: p
                        }, {
                            queue: false,
                            duration: speed,
                            complete: adjust
                        });
                    };

                    if (!options.continuous && options.controlsFade) {
                        if (t == ts) {
                            $("a", "#" + options.nextId).hide();
                            $("a", "#" + options.lastId).hide();
                        } else {
                            $("a", "#" + options.nextId).show();
                            $("a", "#" + options.lastId).show();
                        };
                        if (t == 0) {
                            $("a", "#" + options.prevId).hide();
                            $("a", "#" + options.firstId).hide();
                        } else {
                            $("a", "#" + options.prevId).show();
                            $("a", "#" + options.firstId).show();
                        };
                    };

                    if (clicked) clearTimeout(timeout);
                    if (options.auto && dir == "next" && !clicked) {;
                        timeout = setTimeout(function() {
                            animate("next", false);
                        }, diff * options.speed + options.pause);
                    };

                };

            };
            // init
            var timeout;
            if (options.auto) {;
                timeout = setTimeout(function() {
                    animate("next", false);
                }, options.pause);
            };

            if (options.numeric) setCurrent(0);

            if (!options.continuous && options.controlsFade) {
                $("a", "#" + options.prevId).hide();
                $("a", "#" + options.firstId).hide();
            };

        });

    };

})(jQuery);

// SET COOKIE 

(function(factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals.
        factory(jQuery);
    }
}(function($) {

    var pluses = /\+/g;

    function raw(s) {
        return s;
    }

    function decoded(s) {
        return decodeURIComponent(s.replace(pluses, ' '));
    }

    function converted(s) {
        if (s.indexOf('"') === 0) {
            // This is a quoted cookie as according to RFC2068, unescape
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }
        try {
            return config.json ? JSON.parse(s) : s;
        } catch (er) {}
    }

    var config = $.cookie = function(key, value, options) {

        // write
        if (value !== undefined) {
            options = $.extend({}, config.defaults, options);

            if (typeof options.expires === 'number') {
                var days = options.expires,
                    t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = config.json ? JSON.stringify(value) : String(value);

            return (document.cookie = [
                config.raw ? key : encodeURIComponent(key),
                '=',
                config.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path ? '; path=' + options.path : '',
                options.domain ? '; domain=' + options.domain : '',
                options.secure ? '; secure' : ''
            ].join(''));
        }

        // read
        var decode = config.raw ? raw : decoded;
        var cookies = document.cookie.split('; ');
        var result = key ? undefined : {};
        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            var name = decode(parts.shift());
            var cookie = decode(parts.join('='));

            if (key && key === name) {
                result = converted(cookie);
                break;
            }

            if (!key) {
                result[name] = converted(cookie);
            }
        }

        return result;
    };

    config.defaults = {};

    $.removeCookie = function(key, options) {
        if ($.cookie(key) !== undefined) {
            $.cookie(key, '', $.extend(options, {
                expires: -1
            }));
            return true;
        }
        return false;
    };

}));