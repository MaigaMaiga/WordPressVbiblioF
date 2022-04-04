jQuery(function($) {
    // Set Image for different devices
    function _set_image(selector, photo, photo_tablet, photo_phone) {
        var _screen = $(document).width();

        if (_screen < 768) {
            if (photo_phone && photo_phone.length > 0) {
                $(selector).attr('src', photo_phone);
            }
        } else if (_screen < 981 && _screen > 767) {
            if (photo_tablet && photo_tablet.length > 0) {
                $(selector).attr('src', photo_tablet);
            }
        } else {
            $(selector).attr('src', photo);
        }
    }

    var swapped_img_parent = $('.dtq-swapped-img-selector');

    if (swapped_img_parent.length > 0) {
        swapped_img_parent.each(function() {
            var swapped_img = $(this).find('.dtq-swapped-img'),
                img_schema = swapped_img.data('schema');

            if (img_schema && typeof img_schema === 'object') {
                var photo = img_schema['desktop'],
                    photo_hover = img_schema['hover'],
                    photo_tablet = img_schema['tablet'],
                    photo_phone = img_schema['phone'];

                if (photo_hover && photo_hover.length > 0) {
                    $(this).on('hover', function() {
                        $(swapped_img).attr('src', photo_hover);
                        $(swapped_img).addClass('dtq-img-hovered');
                    });

                    $(this).on('mouseleave', function() {
                        _set_image(
                            swapped_img,
                            photo,
                            photo_tablet,
                            photo_phone
                        );
                        $(swapped_img).removeClass('dtq-img-hovered');
                    });
                }

                _set_image(swapped_img, photo, photo_tablet, photo_phone);

                if (
                    (photo_tablet && photo_tablet.length > 0) ||
                    (photo_tablet && photo_phone.length > 0)
                ) {
                    $(window).on('resize', function() {
                        _set_image(
                            swapped_img,
                            photo,
                            photo_tablet,
                            photo_phone
                        );
                    });
                }
            }
        });
    }

    var ba_img_lightbox = $('.dtq-lightbox');
    if (ba_img_lightbox) {
        try {
            ba_img_lightbox.magnificPopup({
                type: 'image',
                mainClass: 'mfp-with-zoom',
                gallery: { enabled: false },
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out',
                },
            });
        } catch (e) {
            return;
        }
    }

    var ba_carousel = $('.dtq-carousel');

    if (ba_carousel) {
        var _pre_settings = {
            edgeFriction: 0.35,
            useTransform: true,
            touchThreshold: 600,
        };
        ba_carousel.each(function() {
            var _user_settings = $(this).data('settings');
            var _settings = Object.assign(_pre_settings, _user_settings);
            $(this).slick(_settings);
        });
    }

    // Popup.
    window.baPopup = function($popup, settings) {
        var self = this,
            $window = $(window),
            $document = $(document),
            isAnimation = false,
            isOpen = false,
            popupSettings = settings;

        self.init = function() {
            self.initOpenEvent();
            self.initCloseEvent();
        };

        self.initOpenEvent = function() {
            switch (popupSettings['open-trigger']) {
                case 'page-load':
                    self.pageLoadEvent(popupSettings['page-load-delay']);
                    break;
                case 'scroll-trigger':
                    self.scrollPageEvent(popupSettings['scrolled-to']);
                    break;
                case 'try-exit-trigger':
                    self.tryExitEvent();
                    break;

                case 'custom-selector':
                    self.onCustomSelector(popupSettings['custom-selector']);
                    break;
            }
        };

        self.initCloseEvent = function() {
            $popup.on('click', '.dtq-popup-close-button', function(event) {
                var target = event.currentTarget;

                self.hidePopup();
            });

            $popup.on('click', '.dtq-popup-overlay', function(event) {
                var target = event.currentTarget;
                self.hidePopup();
            });
        };

        self.scrollPageEvent = function(scrollingValue) {
            var scrolledValue = +scrollingValue || 0;
            $window
                .on(
                    'scroll.brainScrollEvent resize.brainResizeEvent',
                    function() {
                        var $window = $(window),
                            windowHeight = $window.height(),
                            documentHeight = $(document).height(),
                            scrolledHeight = documentHeight - windowHeight,
                            scrolledProgress =
                                Math.max(
                                    0,
                                    Math.min(
                                        1,
                                        $window.scrollTop() / scrolledHeight
                                    )
                                ) * 100;

                        if (scrolledProgress >= scrolledValue) {
                            $window.off(
                                'scroll.brainScrollEvent resize.brainResizeEvent'
                            );
                            self.showPopup();
                        }
                    }
                )
                .trigger('scroll.brainResizeEvent');
        };

        self.tryExitEvent = function() {
            var pageY = 0;

            $(document).on('mouseleave', 'body', function(event) {
                pageY = event.pageY - $window.scrollTop();

                if (0 > pageY && $popup.hasClass('dtq-popup-hide-state')) {
                    self.showPopup();
                }
            });
        };

        self.pageLoadEvent = function(openDelay) {
            var delay = +openDelay || 0;
            delay = delay * 1000;
            $(window).on('load', function() {
                setTimeout(function() {
                    self.showPopup();
                }, delay);
            });
        };

        self.onCustomSelector = function(selector) {
            var $selector = $(selector);

            if ($selector[0]) {
                $selector.on('click', function(event) {
                    event.preventDefault();

                    self.showPopup();
                });
            }
        };

        self.showPopup = function() {
            var animeOverlay = null,
                animeContainer = null,
                animeOverlaySettings = jQuery.extend(
                    {
                        targets: $('.dtq-popup-overlay', $popup)[0],
                    },
                    self.avaliableEffects['fade']['show']
                ),
                animeContainerSettings = jQuery.extend(
                    {
                        targets: $('.dtq-popup-container', $popup)[0],
                        begin: function(anime) {
                            isAnimation = true;
                        },
                        complete: function(anime) {
                            isAnimation = false;
                            isOpen = true;
                        },
                    },
                    self.avaliableEffects[popupSettings['animation']]['show']
                );

            animeOverlay = anime(animeOverlaySettings);
            $popup.toggleClass('dtq-popup-hide-state dtq-popup-show-state');
            animeContainer = anime(animeContainerSettings);
        };

        self.hidePopup = function() {
            var animeOverlay = null,
                animeContainer = null,
                animeOverlaySettings = jQuery.extend(
                    {
                        targets: $('.dtq-popup-overlay', $popup)[0],
                    },
                    self.avaliableEffects['fade']['hide']
                ),
                animeContainerSettings = jQuery.extend(
                    {
                        targets: $('.dtq-popup-container', $popup)[0],

                        begin: function(anime) {
                            isAnimation = true;
                        },

                        complete: function(anime) {
                            isAnimation = false;
                            isOpen = false;
                            $popup.toggleClass(
                                'dtq-popup-show-state dtq-popup-hide-state'
                            );
                        },
                    },
                    self.avaliableEffects[popupSettings['animation']]['hide']
                );

            if (isAnimation) {
                return false;
            }

            if ($popup.hasClass('dtq-popup-show-state')) {
                animeOverlay = anime(animeOverlaySettings);
                animeContainer = anime(animeContainerSettings);
            }
        };

        self.avaliableEffects = {
            fade: {
                show: {
                    opacity: {
                        value: [0, 1],
                        duration: 600,
                        easing: 'easeOutQuart',
                    },
                },
                hide: {
                    easing: 'easeOutQuart',
                    opacity: {
                        value: [1, 0],
                        easing: 'easeOutQuart',
                        duration: 400,
                    },
                },
            },

            'zoom-in': {
                show: {
                    duration: 500,
                    easing: 'easeOutQuart',
                    opacity: {
                        value: [0, 1],
                    },
                    scale: {
                        value: [0.75, 1],
                    },
                },
                hide: {
                    duration: 400,
                    easing: 'easeOutQuart',
                    opacity: {
                        value: [1, 0],
                    },
                    scale: {
                        value: [1, 0.75],
                    },
                },
            },

            'zoom-out': {
                show: {
                    duration: 500,
                    easing: 'easeOutQuart',
                    opacity: {
                        value: [0, 1],
                    },
                    scale: {
                        value: [1.25, 1],
                    },
                },
                hide: {
                    duration: 400,
                    easing: 'easeOutQuart',
                    opacity: {
                        value: [1, 0],
                    },
                    scale: {
                        value: [1, 1.25],
                    },
                },
            },

            rotate: {
                show: {
                    duration: 500,
                    easing: 'easeOutQuart',
                    opacity: {
                        value: [0, 1],
                    },
                    scale: {
                        value: [0.75, 1],
                    },
                    rotate: {
                        value: [-65, 0],
                    },
                },
                hide: {
                    duration: 400,
                    easing: 'easeOutQuart',
                    opacity: {
                        value: [1, 0],
                    },
                    scale: {
                        value: [1, 0.9],
                    },
                },
            },

            'move-up': {
                show: {
                    duration: 500,
                    easing: 'easeOutExpo',
                    opacity: {
                        value: [0, 1],
                    },
                    translateY: {
                        value: [50, 1],
                    },
                },
                hide: {
                    duration: 400,
                    easing: 'easeOutQuart',
                    opacity: {
                        value: [1, 0],
                    },
                    translateY: {
                        value: [1, 50],
                    },
                },
            },

            'flip-x': {
                show: {
                    duration: 500,
                    easing: 'easeOutExpo',
                    opacity: {
                        value: [0, 1],
                    },
                    rotateX: {
                        value: [65, 0],
                    },
                },
                hide: {
                    duration: 400,
                    easing: 'easeOutQuart',
                    opacity: {
                        value: [1, 0],
                    },
                },
            },

            'flip-y': {
                show: {
                    duration: 500,
                    easing: 'easeOutExpo',
                    opacity: {
                        value: [0, 1],
                    },
                    rotateY: {
                        value: [65, 0],
                    },
                },
                hide: {
                    duration: 400,
                    easing: 'easeOutQuart',
                    opacity: {
                        value: [1, 0],
                    },
                },
            },

            'bounce-in': {
                show: {
                    opacity: {
                        value: [0, 1],
                        duration: 500,
                        easing: 'easeOutQuart',
                    },
                    scale: {
                        value: [0.2, 1],
                        duration: 800,
                        elasticity: function(el, i, l) {
                            return 400 + i * 200;
                        },
                    },
                },
                hide: {
                    duration: 400,
                    easing: 'easeOutQuart',
                    opacity: {
                        value: [1, 0],
                    },
                    scale: {
                        value: [1, 0.8],
                    },
                },
            },

            'bounce-out': {
                show: {
                    opacity: {
                        value: [0, 1],
                        duration: 500,
                        easing: 'easeOutQuart',
                    },
                    scale: {
                        value: [1.8, 1],
                        duration: 800,
                        elasticity: function(el, i, l) {
                            return 400 + i * 200;
                        },
                    },
                },
                hide: {
                    duration: 400,
                    easing: 'easeOutQuart',
                    opacity: {
                        value: [1, 0],
                    },
                    scale: {
                        value: [1, 1.5],
                    },
                },
            },

            'slide-in-up': {
                show: {
                    opacity: {
                        value: [0, 1],
                        duration: 400,
                        easing: 'easeOutQuart',
                    },
                    translateY: {
                        value: ['100vh', 0],
                        duration: 750,
                        easing: 'easeOutQuart',
                    },
                },
                hide: {
                    duration: 400,
                    easing: 'easeInQuart',
                    opacity: {
                        value: [1, 0],
                    },
                    translateY: {
                        value: [0, '100vh'],
                    },
                },
            },

            'slide-in-right': {
                show: {
                    opacity: {
                        value: [0, 1],
                        duration: 400,
                        easing: 'easeOutQuart',
                    },
                    translateX: {
                        value: ['100vw', 0],
                        duration: 750,
                        easing: 'easeOutQuart',
                    },
                },
                hide: {
                    duration: 400,
                    easing: 'easeInQuart',
                    opacity: {
                        value: [1, 0],
                    },
                    translateX: {
                        value: [0, '100vw'],
                    },
                },
            },

            'slide-in-down': {
                show: {
                    opacity: {
                        value: [0, 1],
                        duration: 400,
                        easing: 'easeOutQuart',
                    },
                    translateY: {
                        value: ['-100vh', 0],
                        duration: 750,
                        easing: 'easeOutQuart',
                    },
                },
                hide: {
                    duration: 400,
                    easing: 'easeInQuart',
                    opacity: {
                        value: [1, 0],
                    },
                    translateY: {
                        value: [0, '-100vh'],
                    },
                },
            },

            'slide-in-left': {
                show: {
                    opacity: {
                        value: [0, 1],
                        duration: 400,
                        easing: 'easeOutQuart',
                    },
                    translateX: {
                        value: ['-100vw', 0],
                        duration: 750,
                        easing: 'easeOutQuart',
                    },
                },
                hide: {
                    duration: 400,
                    easing: 'easeInQuart',
                    opacity: {
                        value: [1, 0],
                    },
                    translateX: {
                        value: [0, '-100vw'],
                    },
                },
            },
        };
    };
});
