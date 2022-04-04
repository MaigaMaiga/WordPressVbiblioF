jQuery(document).ready(function($) {
    wp.customize.panel('divi_login_designer', function(section) {
        section.expanded.bind(function(isExpanding) {
            if (isExpanding) {
                var current_url = wp.customize.previewer.previewUrl();
                var current_url = current_url.includes(
                    brainconkit_controls.login_page
                );

                if (!current_url) {
                    wp.customize.previewer.send('brainaddons-url-switcher', {
                        expanded: isExpanding,
                    });
                }
            } else {
                wp.customize.previewer.send('brainaddons-back-to-home', {
                    home_url: wp.customize.settings.url.home,
                });
                url = wp.customize.settings.url.home;
            }
        });
    });

    wp.customize.previewer.bind('logo-sizes', function(data) {
        var width, height;

        if (data.height) {
            height = parseInt(data.height / 2);
            wp.customize('brain_addons[login_designer_logo_height]').set(
                height
            );
        }

        if (data.width) {
            width = parseInt(data.width / 2);
            wp.customize('brain_addons[login_designer_logo_width]').set(width);
        }
    });

    // Background Image
    if (wp.customize('brain_addons[login_designer_bg_image]')._value === '') {
        $('#customize-control-brain_addons-login_designer_bg_position').hide();
        $('#customize-control-brain_addons-login_designer_bg_repeat').hide();
        $('#customize-control-brain_addons-login_designer_bg_size').hide();
        $('#customize-control-brain_addons-login_designer_bg_attach').hide();
    }

    wp.customize('brain_addons[login_designer_bg_image]', function(setting) {
        setting.bind(function(to) {
            if (to === '') {
                $(
                    '#customize-control-brain_addons-login_designer_bg_position'
                ).hide();
                $(
                    '#customize-control-brain_addons-login_designer_bg_repeat'
                ).hide();
                $(
                    '#customize-control-brain_addons-login_designer_bg_size'
                ).hide();
                $(
                    '#customize-control-brain_addons-login_designer_bg_attach'
                ).hide();
            } else {
                $(
                    '#customize-control-brain_addons-login_designer_bg_position'
                ).show();
                $(
                    '#customize-control-brain_addons-login_designer_bg_repeat'
                ).show();
                $(
                    '#customize-control-brain_addons-login_designer_bg_size'
                ).show();
                $(
                    '#customize-control-brain_addons-login_designer_bg_attach'
                ).show();
            }
        });
    });

    // Logo Image
    if (wp.customize('brain_addons[login_designer_logo]')._value === '') {
        $('#customize-control-brain_addons-login_designer_logo_width').hide();
        $('#customize-control-brain_addons-login_designer_logo_height').hide();
    }

    wp.customize('brain_addons[login_designer_logo]', function(setting) {
        setting.bind(function(to) {
            if (to === '') {
                $(
                    '#customize-control-brain_addons-login_designer_logo_width'
                ).hide();
                $(
                    '#customize-control-brain_addons-login_designer_logo_height'
                ).hide();
            } else {
                $(
                    '#customize-control-brain_addons-login_designer_logo_width'
                ).show();
                $(
                    '#customize-control-brain_addons-login_designer_logo_height'
                ).show();
            }
        });
    });

    //Grid Layout
    if (wp.customize('brain_addons[blog_designer_layout]')._value === '') {
        $('#customize-control-brain_addons-blog_designer_grid_title').hide();
        $('#customize-control-brain_addons-blog_designer_grid_layout').hide();
        $(
            '#customize-control-brain_addons-blog_designer_masonry_layout'
        ).hide();
        $('#customize-control-brain_addons-blog_designer_column_gap').hide();
        $('#customize-control-brain_addons-blog_designer_row_gap').hide();
    }

    wp.customize('brain_addons[blog_designer_layout]', function(setting) {
        setting.bind(function(to) {
            if (to === 'layout-1') {
                $(
                    '#customize-control-brain_addons-blog_designer_grid_title'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_grid_layout'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_masonry_layout'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_column_gap'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_row_gap'
                ).show();
            } else {
                $(
                    '#customize-control-brain_addons-blog_designer_grid_title'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_grid_layout'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_masonry_layout'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_column_gap'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_row_gap'
                ).hide();
            }
        });
    });

    if (
        wp.customize('brain_addons[blog_designer_grid_layout]')._value === '1'
    ) {
        $('#customize-control-brain_addons-blog_designer_column_gap').hide();
    }

    wp.customize('brain_addons[blog_designer_grid_layout]', function(setting) {
        setting.bind(function(to) {
            if (to === '1') {
                $(
                    '#customize-control-brain_addons-blog_designer_column_gap'
                ).hide();
            } else {
                $(
                    '#customize-control-brain_addons-blog_designer_column_gap'
                ).show();
            }
        });
    });

    // Featured
    if (
        wp.customize('brain_addons[blog_designer_post_featured]')._value ===
        false
    ) {
        $(
            '#customize-control-brain_addons-blog_designer_featured_image_title'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_featured_image_height'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_featured_image_hover'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_featured_image_space'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_featured_image_inherit'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_remove_featured_image_padding'
        ).hide();
    }

    wp.customize('brain_addons[blog_designer_post_featured]', function(
        setting
    ) {
        setting.bind(function(to) {
            if (to) {
                $(
                    '#customize-control-brain_addons-blog_designer_featured_image_title'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_featured_image_height'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_featured_image_inherit'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_featured_image_hover'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_featured_image_space'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_remove_featured_image_padding'
                ).show();
            } else {
                $(
                    '#customize-control-brain_addons-blog_designer_featured_image_title'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_featured_image_height'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_featured_image_hover'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_featured_image_space'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_featured_image_inherit'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_remove_featured_image_padding'
                ).hide();
            }
        });
    });

    if (
        wp.customize('brain_addons[blog_designer_featured_image_inherit]')
            ._value === false
    ) {
        $(
            '#customize-control-brain_addons-blog_designer_featured_image_height'
        ).hide();
    }

    wp.customize('brain_addons[blog_designer_featured_image_inherit]', function(
        setting
    ) {
        setting.bind(function(to) {
            if (to) {
                $(
                    '#customize-control-brain_addons-blog_designer_featured_image_height'
                ).show();
            } else {
                $(
                    '#customize-control-brain_addons-blog_designer_featured_image_height'
                ).hide();
            }
        });
    });

    // Readmore
    if (wp.customize('brain_addons[blog_designer_readmore]')._value === false) {
        $(
            '#customize-control-brain_addons-blog_designer_readmore_title'
        ).hide();
        $('#customize-control-brain_addons-blog_designer_readmore_text').hide();
        $(
            '#customize-control-brain_addons-blog_designer_readmore_fullwidth'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_readmore_font_size'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_readmore_text_color'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_readmore_bg_color'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_readmore_padding'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_readmore_border_width'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_readmore_border_color'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_readmore_border_radius'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_readmore_spacing'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_readmore_font_weight'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_readmore_top_space'
        ).hide();
    }

    wp.customize('brain_addons[blog_designer_readmore]', function(setting) {
        setting.bind(function(to) {
            if (to) {
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_title'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_text'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_fullwidth'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_font_size'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_text_color'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_bg_color'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_padding'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_border_width'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_border_color'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_border_radius'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_spacing'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_font_weight'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_top_space'
                ).show();
            } else {
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_title'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_text'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_fullwidth'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_font_size'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_text_color'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_bg_color'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_padding'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_border_width'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_border_color'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_border_radius'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_spacing'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_font_weight'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_readmore_top_space'
                ).hide();
            }
        });
    });

    // Single.
    if (
        wp.customize('brain_addons[blog_designer_single_custom_width]')
            ._value === false
    ) {
        $(
            '#customize-control-brain_addons-blog_designer_single_page_width'
        ).hide();
    }

    wp.customize('brain_addons[blog_designer_single_custom_width]', function(
        setting
    ) {
        setting.bind(function(to) {
            if (to) {
                $(
                    '#customize-control-brain_addons-blog_designer_single_page_width'
                ).show();
            } else {
                $(
                    '#customize-control-brain_addons-blog_designer_single_page_width'
                ).hide();
            }
        });
    });

    //Related Posts.
    if (
        wp.customize('brain_addons[blog_designer_single_related_posts]')
            ._value === false
    ) {
        $(
            '#customize-control-brain_addons-blog_designer_single_related_title'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_related_posts_fullwidth'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_related_posts_excerpt'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_related_posts_background'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_related_posts_title_color'
        ).hide();
        $(
            '#customize-control-brain_addons-blog_designer_related_posts_column'
        ).hide();
    }

    wp.customize('brain_addons[blog_designer_single_related_posts]', function(
        setting
    ) {
        setting.bind(function(to) {
            if (to) {
                $(
                    '#customize-control-brain_addons-blog_designer_single_related_title'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_related_posts_fullwidth'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_related_posts_excerpt'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_related_posts_background'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_related_posts_title_color'
                ).show();
                $(
                    '#customize-control-brain_addons-blog_designer_related_posts_column'
                ).show();
            } else {
                $(
                    '#customize-control-brain_addons-blog_designer_single_related_title'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_related_posts_fullwidth'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_related_posts_excerpt'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_related_posts_background'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_related_posts_title_color'
                ).hide();
                $(
                    '#customize-control-brain_addons-blog_designer_related_posts_column'
                ).hide();
            }
        });
    });

    // No Sidebar.
    if (
        wp.customize('brain_addons[blog_designer_single_nosidebar]')._value ===
        false
    ) {
        $(
            '#customize-control-brain_addons-blog_designer_related_posts_fullwidth'
        ).hide();
    }

    wp.customize('brain_addons[blog_designer_single_nosidebar]', function(
        setting
    ) {
        setting.bind(function(to) {
            if (to) {
                $(
                    '#customize-control-brain_addons-blog_designer_related_posts_fullwidth'
                ).show();
            } else {
                $(
                    '#customize-control-brain_addons-blog_designer_related_posts_fullwidth'
                ).hide();
            }
        });
    });
});
