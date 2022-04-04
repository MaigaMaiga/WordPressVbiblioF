function brainaddons_css(control, css_property, selector, unit, priority) {
    wp.customize(control, function(value) {
        value.bind(function(new_value) {
            control = control.replace('[', '_');
            control = control.replace(']', '');
            if (new_value) {
                if ('undefined' !== typeof unit) {
                    if ('url' === unit) {
                        new_value = 'url(' + new_value + ')';
                    } else {
                        if ('undefined' !== typeof priority) {
                            new_value = new_value + unit + priority;
                        } else {
                            new_value = new_value + unit;
                        }
                    }
                }
                jQuery('style#' + control + '_' + css_property).remove();
                jQuery('head').append(
                    '<style id="' +
                        control +
                        '-' +
                        css_property +
                        '">' +
                        selector +
                        '	{ ' +
                        css_property +
                        ': ' +
                        new_value +
                        ' }' +
                        '</style>'
                );
            } else {
                jQuery('style#' + control).remove();
            }
        });
    });
}

function brainaddons_add_dynamic_css(control, style) {
    control = control.replace('[', '-');
    control = control.replace(']', '');
    jQuery('style#' + control).remove();
    jQuery('head').append('<style id="' + control + '">' + style + '</style>');
}

(function($) {
    wp.customize.bind('preview-ready', function() {
        wp.customize.preview.bind('brainaddons-url-switcher', function(data) {
            if (true === data.expanded) {
                wp.customize.preview.send('url', brainaddons_script.login_page);
            }
        });
        wp.customize.preview.bind('brainaddons-back-to-home', function(data) {
            wp.customize.preview.send('url', data.home_url);
        });
    });

    // Background.
    wp.customize('brain_addons[login_designer_bg_image]', function(value) {
        value.bind(function(bg_image) {
            if (bg_image === '') {
                wp.customize.preview.send('refresh');
                $('body.login').css('background-image', 'none');
            }
            if (bg_image) {
                var dynamicStyle =
                    'body.login { background-image: url(' + bg_image + '); }';
                setTimeout(function() {
                    brainaddons_add_dynamic_css(
                        'login-page-background-image',
                        dynamicStyle
                    );
                }, 500);
            }
        });
    });

    wp.customize('brain_addons[login_designer_bg_position]', function(value) {
        value.bind(function(bg_position) {
            var bg_position = bg_position;
            var bg_position = bg_position.replace(/-/g, ' ');

            var dynamicStyle =
                'body.login { background-position: ' + bg_position + '; }';
            brainaddons_add_dynamic_css(
                'login-page-background-position',
                dynamicStyle
            );
        });
    });

    brainaddons_css(
        'brain_addons[login_designer_bg_color]',
        'background-color',
        'body.login'
    );

    brainaddons_css(
        'brain_addons[login_designer_bg_repeat]',
        'background-repeat',
        'body.login'
    );

    brainaddons_css(
        'brain_addons[login_designer_bg_size]',
        'background-size',
        'body.login'
    );

    brainaddons_css(
        'brain_addons[login_designer_bg_attach]',
        'background-attachment',
        'body.login'
    );

    // Logo.
    function hasLogo() {
        var image = wp.customize('brain_addons[login_designer_logo]')();
        return '' !== image;
    }

    function LogoWidth() {
        return wp.customize('brain_addons[login_designer_logo_width]')();
    }

    function LogoHeight() {
        return wp.customize('brain_addons[login_designer_logo_height]')();
    }

    function hasLogoAction(to, width, height) {
        if (hasLogo()) {
            var width = width / 2;
            var height = height / 2;

            dynamicStyle =
                'body.login #login h1 a { width: ' +
                width +
                'px !important; height: ' +
                height +
                'px !important;  background-size:' +
                width +
                'px ' +
                height +
                'px; background-image: url(' +
                to +
                ') !important; }';

            brainaddons_add_dynamic_css('login-page-logo-custom', dynamicStyle);
        } else {
            dynamicStyle =
                'body.login #login h1 a { height: 84px !important; width: 84px !important; background-size: 84px !important; background-image: none, url(" ' +
                brainaddons_script.admin_url +
                '/images/wordpress-logo.svg ") !important; }';

            brainaddons_add_dynamic_css(
                'login-page-logo-default',
                dynamicStyle
            );
        }
    }

    wp.customize('brain_addons[login_designer_logo]', function(value) {
        value.bind(function(to) {
            if (to) {
                var data = {
                    action: 'login_logo_info',
                };

                $.post(brainaddons_script.ajax_url, data, function(res) {
                    hasLogoAction(res.url, res.width, res.height);

                    wp.customize.preview.send('logo-sizes', {
                        height: res.height,
                        width: res.width,
                    });
                    console.log(
                        'Preview response:' + res.height + res.width + res.url
                    );
                });
            } else {
                hasLogoAction(to, null, null);
            }
        });
    });

    wp.customize('brain_addons[login_designer_logo_width]', function(value) {
        value.bind(function(to) {
            dynamicStyle =
                '@media screen and (min-width: 600px) { body.login #login h1 a { background-size:' +
                to +
                'px ' +
                LogoHeight() +
                'px !important; width: ' +
                to +
                'px !important; height: ' +
                LogoHeight() +
                'px !important; } }';

            brainaddons_add_dynamic_css('login-page-logo-width', dynamicStyle);
        });
    });

    wp.customize('brain_addons[login_designer_logo_height]', function(value) {
        value.bind(function(to) {
            dynamicStyle =
                ' @media screen and (min-width: 600px) { body.login #login h1 a { background-size:' +
                LogoWidth() +
                'px ' +
                to +
                'px !important; width: ' +
                LogoWidth() +
                'px !important; height: ' +
                to +
                'px !important; } }';
            brainaddons_add_dynamic_css('login-page-logo-height', dynamicStyle);
        });
    });

    brainaddons_css(
        'brain_addons[login_designer_logo_margin_bottom]',
        'margin-bottom',
        'body.login #login h1 a',
        'px',
        '!important'
    );

    // Form.
    wp.customize('brain_addons[login_designer_form_bg_image]', function(value) {
        value.bind(function(to) {
            if (to === '') {
                wp.customize.preview.send('refresh');
                $('#login form').css('background-image', 'none');
            }

            if (to) {
                var dynamicStyle =
                    '#login form { background-image: url(' +
                    to +
                    ') !important;}';

                setTimeout(function() {
                    brainaddons_add_dynamic_css(
                        'login-page-form-background-image',
                        dynamicStyle
                    );
                }, 300);
            }
        });
    });

    brainaddons_css(
        'brain_addons[login_designer_form_bg_color]',
        'background-color',
        '#login form',
        '',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_form_width]',
        'max-width',
        '#login',
        'px',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_form_side_padding]',
        'padding-left',
        '#login form',
        'px',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_form_side_padding]',
        'padding-right',
        '#login form',
        'px',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_form_vertical_padding]',
        'padding-top',
        '#login form',
        'px',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_form_vertical_padding]',
        'padding-bottom',
        '#login form',
        'px',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_form_radius]',
        'border-radius',
        '#login form',
        'px',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_form_border_color]',
        'border-color',
        '#login form',
        '',
        '!important'
    );

    function formShadow() {
        return wp.customize('brain_addons[login_designer_form_shadow]')();
    }

    function formShadowOpacity() {
        return wp.customize(
            'brain_addons[login_designer_form_shadow_opacity]'
        )();
    }

    wp.customize('brain_addons[login_designer_form_shadow]', function(value) {
        value.bind(function(to) {
            var opacity = formShadowOpacity() * 0.01;

            var dynamicStyle =
                '#login form { box-shadow: 0 0 ' +
                to +
                'px rgba(0, 0, 0, ' +
                opacity +
                '); }';
            brainaddons_add_dynamic_css('login-page-form-shadow', dynamicStyle);
        });
    });

    wp.customize('brain_addons[login_designer_form_shadow_opacity]', function(
        value
    ) {
        value.bind(function(to) {
            var opacity = to * 0.01;
            var dynamicStyle =
                ' #login form { box-shadow: 0 0 ' +
                formShadow() +
                'px rgba(0, 0, 0, ' +
                opacity +
                '); }';

            brainaddons_add_dynamic_css(
                'login-page-form-shadow-opacity',
                dynamicStyle
            );
        });
    });

    // Fields.
    brainaddons_css(
        'brain_addons[login_designer_field_side_padding]',
        'padding-left',
        '#login form .input',
        'px',
        ''
    );

    brainaddons_css(
        'brain_addons[login_designer_field_side_padding]',
        'padding-right',
        '#login form .input',
        'px',
        ''
    );

    brainaddons_css(
        'brain_addons[login_designer_field_margin_bottom]',
        'margin-bottom',
        '#login form .input',
        'px',
        ''
    );

    brainaddons_css(
        'brain_addons[login_designer_field_padding_bottom]',
        'padding-bottom',
        '#login form .input',
        'px',
        ''
    );

    brainaddons_css(
        'brain_addons[login_designer_field_padding_top]',
        'padding-top',
        '#login form .input',
        'px',
        ''
    );

    brainaddons_css(
        'brain_addons[login_designer_field_border]',
        'border-width',
        '#login form .input',
        'px',
        ''
    );

    brainaddons_css(
        'brain_addons[login_designer_field_border_color]',
        'border-color',
        '#login form .input',
        '',
        ''
    );

    brainaddons_css(
        'brain_addons[login_designer_field_font_size]',
        'font-size',
        '#login form .input',
        'px',
        ''
    );

    brainaddons_css(
        'brain_addons[login_designer_field_color]',
        'color',
        '#login form .input',
        '',
        ''
    );

    brainaddons_css(
        'brain_addons[login_designer_field_radius]',
        'border-radius',
        '#login form .input',
        'px',
        ''
    );

    function fieldShadowSize() {
        return wp.customize('brain_addons[login_designer_field_shadow]')();
    }

    function fieldShadowOpacity() {
        return (
            wp.customize(
                'brain_addons[login_designer_field_shadow_opacity]'
            )() * 0.01
        );
    }

    function fieldShadowInset() {
        if (
            true ===
            wp.customize('brain_addons[login_designer_field_shadow_inset]')()
        ) {
            return 'inset';
        } else {
            return '';
        }
    }

    function fieldBackgroundColor() {
        return wp.customize('brain_addons[login_designer_fields_bg_color]')();
    }

    wp.customize('brain_addons[login_designer_fields_bg_color]', function(
        value
    ) {
        value.bind(function(to) {
            dynamicStyle =
                '#login form .input { background-color: ' +
                to +
                '; box-shadow: ' +
                fieldShadowInset() +
                ' 0 0 ' +
                fieldShadowSize() +
                'px rgba(0, 0, 0, ' +
                fieldShadowOpacity() +
                '), inset 0 0 0 9999px ' +
                to +
                '; }';

            brainaddons_add_dynamic_css(
                'login-page-fields-bg-color',
                dynamicStyle
            );
        });
    });

    wp.customize('brain_addons[login_designer_field_shadow]', function(value) {
        value.bind(function(to) {
            dynamicStyle =
                ' #login form .input { background-color: ' +
                fieldBackgroundColor() +
                '; box-shadow: ' +
                fieldShadowInset() +
                ' 0 0 ' +
                to +
                'px rgba(0, 0, 0, ' +
                fieldShadowOpacity() +
                '), inset 0 0 0 9999px ' +
                fieldBackgroundColor() +
                '; } ';

            brainaddons_add_dynamic_css(
                'login-page-field-shadow',
                dynamicStyle
            );
        });
    });

    wp.customize('brain_addons[login_designer_field_shadow_opacity]', function(
        value
    ) {
        value.bind(function(to) {
            var opacity = to * 0.01;

            dynamicStyle =
                ' #login form .input { background-color: ' +
                fieldBackgroundColor() +
                '; box-shadow: ' +
                fieldShadowInset() +
                ' 0 0 ' +
                fieldShadowSize() +
                'px rgba(0, 0, 0, ' +
                opacity +
                '), inset 0 0 0 9999px ' +
                fieldBackgroundColor() +
                '; }';

            brainaddons_add_dynamic_css(
                'login-page-field-shadow-opacity',
                dynamicStyle
            );
        });
    });

    wp.customize('brain_addons[login_designer_field_shadow_inset]', function(
        value
    ) {
        value.bind(function(to) {
            var inset;

            if (true === to) {
                inset = 'inset';
            } else {
                inset = '';
            }

            dynamicStyle =
                ' #login form .input { background-color: ' +
                fieldBackgroundColor() +
                '; box-shadow: ' +
                inset +
                ' 0 0 ' +
                fieldShadowSize() +
                'px rgba(0, 0, 0, ' +
                fieldShadowOpacity() +
                '), inset 0 0 0 9999px ' +
                fieldBackgroundColor() +
                '; } </style>';

            brainaddons_add_dynamic_css(
                'login-page-field-shadow-opacity',
                dynamicStyle
            );
        });
    });

    //Label.
    brainaddons_css(
        'brain_addons[login_designer_label_font_size]',
        'font-size',
        '#login form label:not([for=rememberme])',
        'px',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_label_font_size]',
        'font-size',
        '#login .message',
        'px',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_label_color]',
        'color',
        '#login form label:not([for=rememberme])',
        '',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_label_color]',
        'color',
        '#login .message',
        '',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_label_position]',
        'margin-top',
        '#login form .input',
        'px',
        '!important'
    );

    wp.customize('brain_addons[login_designer_username_label]', function(
        value
    ) {
        value.bind(function(to) {
            $('#brainaddons-username-label-text').html(to);
        });
    });

    wp.customize('brain_addons[login_designer_password_label]', function(
        value
    ) {
        value.bind(function(to) {
            $('#brainaddons-password-label-text').html(to);
        });
    });

    // Button.
    brainaddons_css(
        'brain_addons[login_designer_button_bg]',
        'background-color',
        '#login form .submit .button',
        '',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_button_padding_top]',
        'padding-top',
        '#login form .submit .button',
        'px',
        ''
    );

    brainaddons_css(
        'brain_addons[login_designer_button_padding_bottom]',
        'padding-bottom',
        '#login form .submit .button',
        'px',
        ''
    );

    brainaddons_css(
        'brain_addons[login_designer_button_side_padding]',
        'padding-left',
        '#login form .submit .button',
        'px'
    );

    brainaddons_css(
        'brain_addons[login_designer_button_side_padding]',
        'padding-right',
        '#login form .submit .button',
        'px'
    );

    brainaddons_css(
        'brain_addons[login_designer_button_border]',
        'border-width',
        '#login form .submit .button',
        'px'
    );

    brainaddons_css(
        'brain_addons[login_designer_button_radius]',
        'border-radius',
        '#login form .submit .button',
        'px'
    );

    brainaddons_css(
        'brain_addons[login_designer_button_border_color]',
        'border-color',
        '#login form .submit .button'
    );

    function buttonShadow() {
        return wp.customize('brain_addons[login_designer_button_shadow]')();
    }

    function buttonShadowOpacity() {
        return wp.customize(
            'brain_addons[login_designer_button_shadow_opacity]'
        )();
    }

    wp.customize('brain_addons[login_designer_button_shadow]', function(value) {
        value.bind(function(to) {
            var opacity = buttonShadowOpacity() * 0.01;
            var dynamicStyle =
                ' #login form .submit .button { box-shadow: 0 0 ' +
                to +
                'px rgba(0, 0, 0, ' +
                opacity +
                '); } ';

            brainaddons_add_dynamic_css(
                'login-page-button-shadow',
                dynamicStyle
            );
        });
    });

    wp.customize('brain_addons[login_designer_button_shadow_opacity]', function(
        value
    ) {
        value.bind(function(to) {
            var opacity = to * 0.01;
            var dynamicStyle =
                ' #login form .submit .button { box-shadow: 0 0 ' +
                buttonShadow() +
                'px rgba(0, 0, 0, ' +
                opacity +
                '); } ';

            brainaddons_add_dynamic_css(
                'login-page-button-shadow',
                dynamicStyle
            );
        });
    });

    brainaddons_css(
        'brain_addons[login_designer_button_font_size]',
        'font-size',
        '#login form .submit .button',
        'px',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_button_color]',
        'color',
        '#login form .submit .button',
        '',
        '!important'
    );

    // Remember
    brainaddons_css(
        'brain_addons[login_designer_remember_field_font_size]',
        'font-size',
        '#login .forgetmenot label',
        'px',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_remember_field_position]',
        'margin-top',
        '#login form .forgetmenot',
        'px',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_remember_field_color]',
        'color',
        '#login .forgetmenot label',
        '',
        '!important'
    );

    // Below Form
    wp.customize('brain_addons[login_designer_lost_password]', function(value) {
        value.bind(function(to) {
            if (false === to) {
                dynamicStyle = ' #login #nav { opacity: 0; } ';
            } else {
                dynamicStyle = ' #login #nav { display: block; opacity: 1; } ';
            }

            brainaddons_add_dynamic_css(
                'login-page-lost-password',
                dynamicStyle
            );
        });
    });

    wp.customize('brain_addons[login_designer_back_to]', function(value) {
        value.bind(function(to) {
            if (false === to) {
                dynamicStyle = ' #login #backtoblog { opacity: 0; } ';
            } else {
                dynamicStyle =
                    ' #login #backtoblog { display: block; opacity: 1;  } ';
            }

            brainaddons_add_dynamic_css(
                'login-page-back-to-website',
                dynamicStyle
            );
        });
    });

    brainaddons_css(
        'brain_addons[login_designer_below_color]',
        'color',
        '#login #nav, #login #nav a, #login #backtoblog a',
        '',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_below_position]',
        'margin-top',
        '.login #login form + p',
        'px',
        '!important'
    );

    brainaddons_css(
        'brain_addons[login_designer_below_font_size]',
        'font-size',
        '#login #nav, #login #nav a, #login #backtoblog a',
        'px',
        '!important'
    );
})(jQuery);
