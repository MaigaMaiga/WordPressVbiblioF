jQuery(function($) {
    'use strict';
    function brainSessionStorage($key) {
        var $post_id = window.ETBuilderBackendDynamic.postId,
            $sessionStorage = sessionStorage.getItem('etfb-autosave-1');

        if (!$.isEmptyObject($sessionStorage)) {
            var $json_data = JSON.parse($sessionStorage),
                $_postdata = $json_data['post_' + $post_id];
            console.log($_postdata);
            if ('brainaddons-popup' === $_postdata['post_type']) {
                var $_settings = $_postdata['builder_settings'];
                if ($_settings.hasOwnProperty($key)) {
                    return $_settings[$key];
                }
            }
        }
        return false;
    }

    function brainPaddingMargin(value, css_property, important) {
        if (!value || '' === value || 'undefined' === value) {
            value = '0px|0px|0px|0px';
        }

        var $_top = '';
        var $_right = '';
        var $_bottom = '';
        var $_left = '';
        var $_value = value.split('|');

        var $is_important = important ? '!important' : '';

        if ('' !== $_value[0]) {
            $_top = css_property + '-top:' + $_value[0] + $is_important + ';';
        }

        if ('' !== $_value[1]) {
            $_right =
                css_property + '-right:' + $_value[1] + $is_important + ';';
        }

        if ('' !== $_value[2]) {
            $_bottom =
                css_property + '-bottom:' + $_value[2] + $is_important + ';';
        }

        if ('' !== $_value[3]) {
            $_left = css_property + '-left:' + $_value[3] + $is_important + ';';
        }

        return $_top + $_right + $_bottom + $_left;
    }
    function brainBorderRadius(value, important) {
        if (!value || '' === value || 'undefined' === value) {
            value = '0px|0px|0px|0px';
        }

        var $_top = '';
        var $_right = '';
        var $_bottom = '';
        var $_left = '';
        var $_value = value.split('|');

        var $is_important = important ? '!important' : '';

        if ('' !== $_value[0]) {
            $_top =
                'border-top-left-radius:' + $_value[0] + $is_important + ';';
        }

        if ('' !== $_value[1]) {
            $_right =
                'border-top-right-radius:' + $_value[1] + $is_important + ';';
        }

        if ('' !== $_value[2]) {
            $_bottom =
                'border-bottom-right-radius:' +
                $_value[2] +
                $is_important +
                ';';
        }

        if ('' !== $_value[3]) {
            $_left =
                'border-bottom-left-radius:' + $_value[3] + $is_important + ';';
        }

        return $_top + $_right + $_bottom + $_left;
    }

    window.addEventListener('message', function(e) {
        var $post_id = window.ETBuilderBackendDynamic.postId,
            $c_width = brainSessionStorage('ba_container_width'),
            $c_width_unit = brainSessionStorage('ba_container_width_unit'),
            $c_use_height = brainSessionStorage('ba_use_container_height'),
            $c_height = brainSessionStorage('ba_container_height'),
            $c_height_unit = brainSessionStorage('ba_container_height_unit'),
            $c_color = brainSessionStorage('ba_container_color'),
            $c_padding = brainSessionStorage('ba_container_padding'),
            $c_radius = brainSessionStorage('ba_container_border_radius'),
            $position_x = brainSessionStorage('ba_position_x'),
            $position_y = brainSessionStorage('ba_position_y'),
            $close_btn = brainSessionStorage('ba_close_button'),
            $close_btn_radius = brainSessionStorage('ba_close_button_radius'),
            $close_button_color = brainSessionStorage('ba_close_button_color'),
            $icon_transform_x = brainSessionStorage('ba_close_icon_x_position'),
            $icon_transform_y = brainSessionStorage('ba_close_icon_y_position'),
            $ba_overlay = brainSessionStorage('ba_overlay'),
            $ba_overlay_color = brainSessionStorage('ba_overlay_color'),
            $app_frame = $('#et-fb-app-frame'),
            $app_content = $app_frame.contents(),
            $app_head = $app_content.find('head'),
            $app_container = $app_content.find('.ba-popup-inner');

        var $close_btn_radius_all = '',
            $c_radius_all = '',
            $c_padding_all = '';

        var $c_width_unit = $c_width_unit ? $c_width_unit : 'px';
        var $c_height_unit = $c_height_unit ? $c_height_unit : 'px';

        if ($close_btn_radius) {
        }
        if ($position_x) {
            $app_head.find('style.ba-popup-position-x').remove();
            $app_head.append(
                '<style class="ba-popup-position-x">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    ' .ba-popup-inner {justify-content:' +
                    $position_x +
                    '!important;}</style>'
            );
        }

        if ($position_y) {
            $app_head.find('style.ba-popup-position-y').remove();
            $app_head.append(
                '<style class="ba-popup-position-y">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    ' .ba-popup-inner {align-items:' +
                    $position_y +
                    '!important;}</style>'
            );
        }

        if ($c_padding) {
            $app_head.find('style.ba-popup-padding').remove();
            $c_padding_all = brainPaddingMargin($c_padding, 'padding', true);
            $app_head.append(
                '<style class="ba-popup-padding">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    ' .ba-popup-container .ba-popup-container-inner{' +
                    $c_padding_all +
                    '}</style>'
            );
        }

        if ($c_radius) {
            $app_head.find('style.ba-popup-radius').remove();
            $c_radius_all = brainBorderRadius($c_radius, true);
            $app_head.append(
                '<style class="ba-popup-radius">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    ' .ba-popup-container .ba-popup-container-inner{' +
                    $c_radius_all +
                    '}</style>'
            );
        }

        if ($c_color) {
            $app_head.find('style.ba-popup-bg-color').remove();
            $app_head.append(
                '<style class="ba-popup-bg-color">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    ' .ba-popup-container .ba-popup-container-inner{ background-color:' +
                    $c_color +
                    '!important; }</style>'
            );
        }

        if ($c_width) {
            $app_container.find('style.ba-popup-width').remove();
            $app_container.append(
                '<style class="ba-popup-width">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    ' { width:' +
                    $c_width +
                    $c_width_unit +
                    '!important; }</style>'
            );

            console.log($c_width);
            console.log($c_width_unit);
        }

        if ('on' === $c_use_height) {
            $app_container.find('style.ba-popup-height').remove();
            $app_container.append(
                '<style class="ba-popup-height">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    '{ height:' +
                    $c_height +
                    $c_height_unit +
                    '!important; }</style>'
            );
            $app_content
                .find('.ba-popup')
                .addClass('ba-popup-custom-height-on');
        }

        if ('off' === $c_use_height) {
            $app_container.find('style.ba-popup-height').remove();
            $app_content
                .find('.ba-popup')
                .removeClass('ba-popup-custom-height-on');
        }

        if ($close_btn && 'off' === $close_btn) {
            $app_head.find('style.ba-close-button').remove();
            $app_head.append(
                '<style class="ba-close-button">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    ' .ba-popup-container .ba-popup-close-button{ display:none !important; }</style>'
            );
        } else if ($close_btn && 'on' === $close_btn) {
            $app_head.find('style.ba-close-button').remove();
            $app_head.append(
                '<style class="ba-close-button">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    ' .ba-popup-container .ba-popup-close-button{ display:block !important; }</style>'
            );
        }

        if ($close_button_color) {
            $app_head.find('style.ba-close-button-color').remove();
            $app_head.append(
                '<style class="ba-close-button-color">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    ' .ba-popup-container .ba-popup-close-button{ background-color:' +
                    $close_button_color +
                    '!important; }</style>'
            );
        }

        if ($close_btn_radius) {
            $app_head.find('style.ba-close-button-radius').remove();
            $close_btn_radius_all = brainBorderRadius($close_btn_radius, true);
            $app_head.append(
                '<style class="ba-close-button-radius">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    ' .ba-popup-container .ba-popup-close-button {' +
                    $close_btn_radius_all +
                    '}</style>'
            );
        }

        if ($icon_transform_x && $icon_transform_y) {
            $app_head.find('style.ba-popup-radius').remove();
            $app_head.append(
                '<style class="ba-popup-radius">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    ' .ba-popup-container .ba-popup-close-button{ transform: translateX(' +
                    $icon_transform_x +
                    'px) translateY(' +
                    $icon_transform_y +
                    'px) !important;' +
                    '}</style>'
            );
        }

        if ($ba_overlay_color) {
            $app_head.find('style.ba-popup-overlay-color').remove();
            $app_head.append(
                '<style class="ba-popup-overlay-color">.et-fb-app-frame #ba-popup-' +
                    $post_id +
                    ' .ba-popup-inner .ba-popup-overlay { background-color:' +
                    $ba_overlay_color +
                    '!important; }</style>'
            );
        }

        if ($ba_overlay) {
            if ('off' === $ba_overlay) {
                $app_head.find('style.ba-popup-overlay').remove();
                $app_head.append(
                    '<style class="ba-popup-overlay">.et-fb-app-frame #ba-popup-' +
                        $post_id +
                        ' .ba-popup-inner .ba-popup-overlay { display:none !important; }</style>'
                );
            } else if ('on' === $ba_overlay) {
                $app_head.find('style.ba-popup-overlay').remove();
                $app_head.append(
                    '<style class="ba-popup-overlay">.et-fb-app-frame #ba-popup-' +
                        $post_id +
                        ' .ba-popup-inner .ba-popup-overlay { display:block !important; }</style>'
                );
            }
        }
    });
});
