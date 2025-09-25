/*! Zenon v1.4.0 - Drupal 7 Premium Theme 
* http://www.themebiotic.com/zenon
* Themebiotic; This work is licensed under a Themeforest license agreements
* Regular License & Extended License http://themeforest.net/licenses
* Copyright (c) 2016
* Modified Date 2016-02-03 */
!function(document, window, $) {
    Drupal.behaviors.PortfolioTouch = {
        attach: function(context, settings) {
            try {
                Modernizr.touch && ($(".node-portfolio.node-teaser figure").on("click", function(e) {
                    $(this).toggleClass("cs-hover"), $(".node-portfolio.node-teaser figure figcaption a").removeClass("active"), 
                    $("a", $(this)).addClass("active");
                }), $(".node-portfolio.node-teaser figure figcaption a").on("click", function(e) {
                    return $(this).hasClass("active") ? !0 : void e.preventDefault();
                }));
            } catch (err) {}
        }
    };
}(document, window, jQuery), function($) {
    $.easing.elasout = function(x, t, b, c, d) {
        var s = 1.70158, p = 0, a = c;
        if (0 == t) return b;
        if (1 == (t /= d)) return b + c;
        if (p || (p = .3 * d), a < Math.abs(c)) {
            a = c;
            var s = p / 4;
        } else var s = p / (2 * Math.PI) * Math.asin(c / a);
        return a * Math.pow(2, -10 * t) * Math.sin((t * d - s) * (2 * Math.PI) / p) + c + b;
    }, Drupal.getUrlParameter = function(sParam) {
        for (var sPageURL = window.location.search.substring(1), sURLVariables = sPageURL.split("&"), i = 0; i < sURLVariables.length; i++) {
            var sParameterName = sURLVariables[i].split("=");
            if (sParameterName[0] == sParam) return sParameterName[1];
        }
    }, Drupal.behaviors.Zenon = {
        attach: function(context, settings) {
            new WOW().init(), Drupal.ZenonMasonryPortfolio(), Drupal.ZenonPortfolio(), Drupal.ZenonSmoothScroll(), 
            Drupal.ZenonMasonryBlog(), Drupal.ZenonTeamBox();
        }
    }, $(document).ready(function() {}), $(window).load(function() {
        try {
            Grid.init();
        } catch (err) {}
    });
}(jQuery), function($) {
    Drupal.BootstrapCustom = function() {
        $(".alert").bind("closed", function() {
            return this.remove();
        }), $(".alert").bind("close", function() {
            return $(this).animate({
                opacity: 0,
                marginTop: 0,
                marginBottom: 0,
                height: "toggle"
            }, "slow", function() {
                return $(this).trigger("closed");
            });
        });
    };
}(jQuery), function($) {
    var $special, resizeTimeout, $event = $.event;
    $special = $event.special.debouncedresize = {
        setup: function() {
            $(this).on("resize", $special.handler);
        },
        teardown: function() {
            $(this).off("resize", $special.handler);
        },
        handler: function(event, execAsap) {
            var context = this, args = arguments, dispatch = function() {
                event.type = "debouncedresize", $event.dispatch.apply(context, args);
            };
            resizeTimeout && clearTimeout(resizeTimeout), execAsap ? dispatch() : resizeTimeout = setTimeout(dispatch, $special.threshold);
        },
        threshold: 250
    };
    var BLANK = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
    $.fn.imagesLoaded = function(callback) {
        function doneLoading() {
            var $proper = $(proper), $broken = $(broken);
            deferred && (broken.length ? deferred.reject($images, $proper, $broken) : deferred.resolve($images)), 
            $.isFunction(callback) && callback.call($this, $images, $proper, $broken);
        }
        function imgLoaded(img, isBroken) {
            img.src !== BLANK && -1 === $.inArray(img, loaded) && (loaded.push(img), isBroken ? broken.push(img) : proper.push(img), 
            $.data(img, "imagesLoaded", {
                isBroken: isBroken,
                src: img.src
            }), hasNotify && deferred.notifyWith($(img), [ isBroken, $images, $(proper), $(broken) ]), 
            $images.length === loaded.length && (setTimeout(doneLoading), $images.unbind(".imagesLoaded")));
        }
        var $this = this, deferred = $.isFunction($.Deferred) ? $.Deferred() : 0, hasNotify = $.isFunction(deferred.notify), $images = $this.find("img").add($this.filter("img")), loaded = [], proper = [], broken = [];
        return $.isPlainObject(callback) && $.each(callback, function(key, value) {
            "callback" === key ? callback = value : deferred && deferred[key](value);
        }), $images.length ? $images.bind("load.imagesLoaded error.imagesLoaded", function(event) {
            imgLoaded(event.target, "error" === event.type);
        }).each(function(i, el) {
            var src = el.src, cached = $.data(el, "imagesLoaded");
            return cached && cached.src === src ? void imgLoaded(el, cached.isBroken) : el.complete && void 0 !== el.naturalWidth ? void imgLoaded(el, 0 === el.naturalWidth || 0 === el.naturalHeight) : void ((el.readyState || el.complete) && (el.src = BLANK, 
            el.src = src));
        }) : doneLoading(), deferred ? deferred.promise($this) : $this;
    };
}(jQuery);

var Grid = function($) {
    function init(config) {
        $grid = $($selector), $items = $(".og-item", $grid), settings = $.extend(!0, {}, settings, config), 
        $grid.imagesLoaded(function() {
            saveItemInfo(!0), getWinSize(), initEvents();
        });
    }
    function addItems($newitems) {
        $items = $items.add($newitems), $newitems.each(function() {
            var $item = $(this);
            $item.data({
                offsetTop: $item.offset().top,
                height: $item.height()
            });
        }), initItemsEvents($newitems);
    }
    function saveItemInfo(saveheight) {
        $items.each(function(index) {
            var $item = $(this);
            $item.data("offsetTop", $item.offset().top), $item.data("elindex", index), saveheight && $item.data("height", $item.height());
        });
    }
    function initEvents() {
        initItemsEvents($items), $window.on("debouncedresize", function() {
            scrollExtra = 0, previewPos = -1, saveItemInfo(), getWinSize();
            var preview = $.data(this, "preview");
            "undefined" != typeof preview && hidePreview();
        });
    }
    function initItemsEvents($items) {
        $items.on("click", "span.og-close", function() {
            return hidePreview(), !1;
        }).children(".og-content").on("click", function(e) {
            var $item = $(this).parent();
            return current === $item.data("elindex") ? hidePreview() : showPreview($item), !1;
        });
    }
    function getWinSize() {
        winsize = {
            width: $window.width(),
            height: $window.height()
        };
    }
    function showPreview($item) {
        var preview = $.data(this, "preview"), position = $item.data("offsetTop");
        if (scrollExtra = 0, "undefined" != typeof preview) {
            if (previewPos === position) return preview.update($item), !1;
            position > previewPos && (scrollExtra = preview.height), hidePreview();
        }
        previewPos = position, preview = $.data(this, "preview", new Preview($item)), preview.open();
    }
    function hidePreview() {
        current = -1;
        var preview = $.data(this, "preview");
        preview.close(), $.removeData(this, "preview");
    }
    function Preview($item) {
        this.$item = $item, this.expandedIdx = this.$item.data("elindex"), this.create(), 
        this.update();
    }
    var winsize, $selector = "#og-grid", current = -1, previewPos = -1, scrollExtra = 0, marginExpanded = 10, $window = $(window), $body = $("html, body"), transEndEventNames = {
        WebkitTransition: "webkitTransitionEnd",
        MozTransition: "transitionend",
        OTransition: "oTransitionEnd",
        msTransition: "MSTransitionEnd",
        transition: "transitionend"
    }, transEndEventName = transEndEventNames[Modernizr.prefixed("transition")], support = Modernizr.csstransitions, settings = {
        minHeight: 500,
        speed: 350,
        easing: "ease",
        showVisitButton: !0
    };
    return Preview.prototype = {
        create: function() {
            this.$title = $("<h3></h3>"), this.$description = $("<p></p>");
            var detailAppends = [ this.$title, this.$description ];
            settings.showVisitButton === !0 && (this.$href = $('<a href="#">' + Drupal.t("Details") + "</a>"), 
            detailAppends.push(this.$href)), this.$details = $('<div class="og-details"></div>').append(detailAppends), 
            this.$loading = $('<div class="og-loading"></div>'), this.$fullimage = $('<div class="og-fullimg"></div>').append(this.$loading), 
            this.$closePreview = $('<span class="og-close"></span>'), this.$previewInner = $('<div class="og-expander-inner"></div>').append(this.$closePreview, this.$fullimage, this.$details), 
            this.$previewEl = $('<div class="og-expander"></div>').append(this.$previewInner), 
            this.$item.append(this.getEl()), support && this.setTransition();
        },
        update: function($item) {
            if ($item && (this.$item = $item), -1 !== current) {
                var $currentItem = $items.eq(current);
                $currentItem.removeClass("og-expanded"), this.$item.addClass("og-expanded"), this.positionPreview();
            }
            current = this.$item.data("elindex");
            var $itemEl = this.$item.children(".og-content"), eldata = {
                href: $itemEl.data("href"),
                largesrc: $itemEl.data("largesrc"),
                title: $itemEl.data("title"),
                description: $itemEl.data("description")
            };
            this.$title.html(eldata.title), this.$description.html(eldata.description), settings.showVisitButton === !0 && eldata.href ? (this.$href.attr("href", eldata.href), 
            this.$href.show()) : this.$href.hide();
            var self = this;
            "undefined" != typeof self.$largeImg && self.$largeImg.remove(), self.$fullimage.is(":visible") && (this.$loading.show(), 
            $("<img/>").load(function() {
                var $img = $(this);
                $img.attr("src") === self.$item.children(".og-content").data("largesrc") && (self.$loading.hide(), 
                self.$fullimage.find("img").remove(), self.$largeImg = $img.fadeIn(350), self.$fullimage.append(self.$largeImg));
            }).attr("src", eldata.largesrc));
        },
        open: function() {
            setTimeout($.proxy(function() {
                this.setHeights(), this.positionPreview();
            }, this), 25);
        },
        close: function() {
            var self = this, onEndFn = function() {
                support && $(this).off(transEndEventName), self.$item.removeClass("og-expanded"), 
                self.$previewEl.remove();
            };
            return setTimeout($.proxy(function() {
                "undefined" != typeof this.$largeImg && this.$largeImg.fadeOut("fast"), this.$previewEl.css("height", 0);
                var $expandedItem = $items.eq(this.expandedIdx);
                $expandedItem.css("height", $expandedItem.data("height")).on(transEndEventName, onEndFn), 
                support || onEndFn.call();
            }, this), 25), !1;
        },
        calcHeight: function() {
            var heightPreview = winsize.height - this.$item.data("height") - marginExpanded, itemHeight = winsize.height;
            heightPreview < settings.minHeight && (heightPreview = settings.minHeight, itemHeight = settings.minHeight + this.$item.data("height") + marginExpanded), 
            this.height = heightPreview, this.itemHeight = itemHeight;
        },
        setHeights: function() {
            var self = this, onEndFn = function() {
                support && self.$item.off(transEndEventName), self.$item.addClass("og-expanded");
            };
            this.calcHeight(), this.$previewEl.css("height", this.height), this.$item.css("height", this.itemHeight).on(transEndEventName, onEndFn), 
            support || onEndFn.call();
        },
        positionPreview: function() {
            var position = this.$item.data("offsetTop"), previewOffsetT = this.$previewEl.offset().top - scrollExtra, scrollVal = this.height + this.$item.data("height") + marginExpanded <= winsize.height ? position : this.height < winsize.height ? previewOffsetT - (winsize.height - this.height) : previewOffsetT;
            $body.animate({
                scrollTop: scrollVal
            }, settings.speed);
        },
        setTransition: function() {
            this.$previewEl.css("transition", "height " + settings.speed + "ms " + settings.easing), 
            this.$item.css("transition", "height " + settings.speed + "ms " + settings.easing);
        },
        getEl: function() {
            return this.$previewEl;
        }
    }, {
        init: init,
        addItems: addItems
    };
}(jQuery);

!function($) {
    Drupal.behaviors.ZenonFixed = {
        attach: function(context, settings) {
            $(document).ready(function() {
                $("html").waitForImages(function() {
                    function scroll() {
                        $(window).scrollTop() >= origOffsetY ? $menu.addClass("header-shrink") : $menu.removeClass("header-shrink");
                    }
                    var menu = document.querySelector(".fixed-header");
                    if (!menu) return !1;
                    var $menu = $(menu), origOffsetY = menu.offsetTop + 28;
                    $("body").addClass("fixed-body-margin"), document.onscroll = scroll, $().showUp(".fixed-header", {
                        upClass: "navbar-show",
                        downClass: "navbar-hide"
                    });
                });
            });
        }
    };
}(jQuery), function($, window, document) {
    Drupal.ZenonMasonryBlog = function() {
        try {
            var $container = $(".masonry-blog .view-content");
            $container.length && ($container.isotope({
                layoutMode: "masonry",
                itemSelector: ".views-row"
            }), $(window).load(function() {
                $container.isotope("layout");
            }));
        } catch (err) {}
    };
}(jQuery, window, document), function($, window, document) {
    Drupal.random = function(range) {
        return Math.round(Math.random() * range);
    }, Drupal.dummyData = function(instance, range) {
        for (var data = [], i = 0; instance > i; i++) data[i] = Drupal.random(range);
        return data;
    }, Drupal.ChartLineOptions = function() {
        "use strict";
        var options = {
            responsive: !0,
            legendTemplate: '<ul class="list-inline <%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span class="badge" style="background-color:<%=datasets[i].strokeColor%>">&nbsp;</span>&nbsp; <%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
        };
        return options;
    }, Drupal.ChartLine = function(selector, data, options) {
        $("#" + selector).one("inview", function(event, visible) {
            if (visible = !0) {
                var width = document.getElementById(selector).parentNode.offsetWidth, height = document.getElementById(selector).getAttribute("data-height");
                document.getElementById(selector).setAttribute("width", width), document.getElementById(selector).setAttribute("height", height);
                var ctx = document.getElementById(selector).getContext("2d"), myLineChart = new Chart(ctx).Line(data, options);
                document.getElementById("myChart-legend").innerHTML = myLineChart.generateLegend();
            }
        });
    };
}(jQuery, window, document), function($) {
    Drupal.clearSelection = function() {
        if (document.selection && document.selection.empty) document.selection.empty(); else if (window.getSelection) {
            var sel = window.getSelection();
            sel.removeAllRanges();
        }
    }, Drupal.behaviors.ZenonDemostration = {
        attach: function(context, settings) {
            try {
                settings.zenon.debug && ($(".section-demostration").once("ZenonDemostration", function() {
                    $(this).on("click", function() {
                        $(this).parent(".wrapper").toggleClass("section-demostration-outline"), Drupal.clearSelection();
                    });
                }), $(".region-demostration").once("ZenonDemostration", function() {
                    $(this).on("click", function() {
                        $(this).parent(".region").toggleClass("region-demostration-outline"), Drupal.clearSelection();
                    });
                }));
            } catch (err) {}
        }
    };
}(jQuery), function($) {
    var fxdelay = function() {
        var timer = 0;
        return function(callback, ms) {
            clearTimeout(timer), timer = setTimeout(callback, ms);
        };
    }();
    Drupal.tb__Mobile_Menu_close = function() {
        $.sidr("close", "sidr-right");
    }, Drupal.behaviors.tb__Mobile_Menu = {
        attach: function(context, settings) {
            $(window).resize(function() {
                fxdelay(function() {
                    $.sidr("close", "sidr-right");
                }, 500);
            }), $(document).ready(function() {
                var menu_button = $("#open-menu");
                menu_button.sidr({
                    name: "sidr-right",
                    side: "right",
                    source: "#tb-menu-main-menu",
                    renaming: !0,
                    onOpen: function() {
                        $("#sidr-right").bind("click", Drupal.tb__Mobile_Menu_close), $(".page--overlayer").bind("click", Drupal.tb__Mobile_Menu_close), 
                        $("#globalheaderwrapper").addClass("menu-offcanvas"), $(".page--overlayer").addClass("is-active"), 
                        $(menu_button).addClass("open"), $("ul.sidr-class-exclude-mobile").remove(), $.each($(".sidr-inner"), function(key, value) {
                            $("em", this).remove(), "undefined" == $(value).html() && this.remove();
                        });
                    },
                    onClose: function() {
                        $(menu_button).removeClass("open"), $(".page--overlayer").unbind("click", Drupal.tb__Mobile_Menu_close), 
                        $("#sidr-right").unbind("click", Drupal.tb__Mobile_Menu_close), $(".page--overlayer").removeClass("is-active"), 
                        $("#globalheaderwrapper").removeClass("menu-offcanvas");
                    }
                });
            });
        }
    };
}(jQuery), function($) {
    Drupal.behaviors.ZenonParallaxSection = {
        attach: function(context, settings) {
            try {
                $("body").hasClass("mobile") || $(".parallax-section").once("ZenonParallaxSection", function() {
                    var xpos = $(this).data("parallax-xpos") || null, ratio = $(this).data("parallax-ratio") || null;
                    $(this).parallax(xpos, ratio);
                });
            } catch (err) {}
        }
    };
}(jQuery), function($, window, document) {
    Drupal.ZenonMasonryPortfolio = function() {
        try {
            var $container = $(".portfolio-masonry"), $cat_filter = Drupal.getUrlParameter("filter");
            $container.length && ($container.imagesLoaded(function() {
                $container.isotope({
                    itemSelector: "figure"
                });
            }), $(window).load(function() {
                $container.isotope("layout");
            }), $("#portfolio-filter").on("click", "button", function(event) {
                event.preventDefault();
                var filterValue = $(this).attr("data-filter");
                $container.isotope({
                    filter: filterValue
                }), $("#portfolio-filter ul button").removeClass("active"), $(this).addClass("active");
            }), $cat_filter && ($("#portfolio-filter ul button").removeClass("active"), $('[data-filter=".' + $cat_filter + '"]').addClass("active"), 
            $container.isotope({
                filter: "." + $cat_filter
            })));
        } catch (err) {}
        try {
            Modernizr.touch && $(".portfolio-masonry figure").on("click", function(e) {
                "use strict";
                var link = $(this);
                return link.hasClass("cs-hover") ? !0 : (link.addClass("cs-hover"), $(".portfolio-masonry figure").not(this).removeClass("cs-hover"), 
                e.preventDefault(), !1);
            });
        } catch (err) {}
    }, Drupal.ZenonPortfolio = function() {
        try {
            var $container = $(".view-portfolio .view-content"), $cat_filter = Drupal.getUrlParameter("filter");
            $container.length && ($container.isotope({
                itemSelector: ".node-portfolio"
            }), $(".borealis", $container).on("borealis-loaded", function(ev) {
                $container.isotope("layout");
            }), $(window).load(function() {
                $container.isotope("layout");
            }), $("#portfolio-filter").on("click", "button", function(event) {
                event.preventDefault();
                var filterValue = $(this).attr("data-filter");
                $container.isotope({
                    filter: filterValue
                }), $("#portfolio-filter ul button").removeClass("active"), $(this).addClass("active");
            }), $cat_filter && ($("#portfolio-filter ul button").removeClass("active"), $('[data-filter=".' + $cat_filter + '"]').addClass("active"), 
            $container.isotope({
                filter: "." + $cat_filter
            })));
        } catch (err) {}
    }, Drupal.behaviors.ZenonPortfolioBlocks = {
        attach: function(context, settings) {
            var $container = $("#zenon-portfolio-blocks");
            $container.imagesLoaded(function() {
                $container.isotope({
                    itemSelector: ".views-row"
                });
            }), Modernizr.touch && $("#zenon-portfolio-blocks figure").on("click", function(e) {
                "use strict";
                var link = $(this);
                return link.hasClass("cs-hover") ? !0 : (link.addClass("cs-hover"), $("#zenon-portfolio-blocks figure").not(this).removeClass("hover"), 
                e.preventDefault(), !1);
            });
        }
    };
}(jQuery, window, document), function($) {
    Drupal.behaviors.ZenonProgress = {
        attach: function(context, settings) {
            try {
                $(".progress .progress-bar").one("inview", function(event, visible) {
                    (visible = !0) && $(this).progressbar({
                        transition_delay: 250,
                        use_percentage: !1,
                        update: function(current_percentage, $this) {
                            $this.closest("section").find(".output-data").html(current_percentage);
                        }
                    });
                });
            } catch (err) {}
        }
    };
}(jQuery), function($) {
    Drupal.ZenonSmoothScroll = function() {
        var $ss = $(".ss");
        $ss.on("click", function(event) {
            event.preventDefault();
            var $offset = "";
            $offset = $("body").hasClass("admin-menu") ? -29 : $("body").hasClass("toolbar") && $("body").hasClass("toolbar-drawer") ? -64 : $("body").hasClass("toolbar") ? -30 : 0, 
            $.scrollTo($(this).data("href"), 800, {
                offset: $offset,
                easing: "easeInOutQuad"
            });
        });
    };
}(jQuery), function($) {
    Drupal.behaviors.SuperSlides = {
        attach: function(context, settings) {
            try {
                $("#slides").superslides({
                    animation_speed: "normal",
                    animation: "fade"
                }), $("body").hasClass("mobile") && ($("nav.slides-navigation").hide(), $(".smooth-scroll").hide());
            } catch (err) {}
        }
    };
}(jQuery), function($) {
    Drupal.behaviors.ZenonSVG = {
        attach: function(context, settings) {
            try {
                if (Modernizr.svg && settings.zenon.logo_svg_path) {
                    var logoSVGpath = settings.zenon.logo_svg_path;
                    $("#logo img").attr("src", Drupal.settings.basePath + logoSVGpath);
                }
            } catch (err) {}
        }
    };
}(jQuery), function($) {
    Drupal.behaviors.ZenonTaggd = {
        attach: function(context, settings) {
            var defaults = {}, options = $.extend({}, defaults, settings.ZenonTaggd);
            try {
                var default_handlers = {
                    click: function(e) {
                        $("#" + e.data.id).trigger("click");
                    },
                    mouseenter: "show",
                    mouseleave: "hide"
                };
                $.isEmptyObject(options) || $.each(options, function(index, value) {
                    $.each(value, function(i, e) {
                        e.settings.handlers || (e.settings.handlers = default_handlers), $element = $(e.selector), 
                        $element.taggd(e.settings), $element.taggd("items", e.data);
                    });
                });
            } catch (err) {}
            $(window).load(function() {
                $(window).trigger("resize"), $("body").hasClass("safari");
            });
        }
    };
}(jQuery), function($) {
    Drupal.ZenonTeamBox = function() {
        "use strict";
        try {
            Modernizr.touch && $(".team-box figure").on("click", function(e) {
                var box = $(this);
                return box.hasClass("cs-hover") ? void box.removeClass("cs-hover") : (box.addClass("cs-hover"), 
                $(".team-box figure").not(this).removeClass("cs-hover"), e.preventDefault(), !1);
            });
        } catch (err) {}
    };
}(jQuery);