<?php

namespace BrainAddons;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class Login_Designer {

    public function __construct() {
        add_action( 'login_head', array( $this, 'login_head' ) );
        add_action( 'login_enqueue_scripts', array( $this, 'print_css' ) );
        add_action( 'login_enqueue_scripts', array( $this, 'login_enqueue_scripts' ) );
        add_action( 'wp_ajax_login_logo_info', array( $this, 'login_logo_info_callback' ) );
        add_action( 'login_headerurl', array( $this, 'logo_url' ) );
    }

    public static function defaults() {

        $defaults = array(
            'login_designer_bg_image'                 => '',
            'login_designer_bg_repeat'                => 'no-repeat',
            'login_designer_bg_size'                  => 'cover',
            'login_designer_bg_position'              => 'center center',
            'login_designer_bg_attach'                => 'fixed',
            'login_designer_bg_color'                 => '#f1f1f1',
            'login_designer_logo'                     => '',
            'login_designer_logo_url'                 => '',
            'login_designer_logo_width'               => '84',
            'login_designer_logo_height'              => '84',
            'login_designer_logo_margin_bottom'       => '25',
            'login_designer_form_bg_image'            => '',
            'login_designer_form_bg_color'            => '#ffffff',
            'login_designer_form_width'               => '320',
            'login_designer_form_side_padding'        => '24',
            'login_designer_form_vertical_padding'    => '26',
            'login_designer_form_radius'              => '0',
            'login_designer_form_shadow'              => '3',
            'login_designer_form_shadow_opacity'      => '13',
            'login_designer_form_border_color'        => '#c3c4c7',
            'login_designer_fields_bg_color'          => '#fbfbfb',
            'login_designer_field_padding_top'        => '3',
            'login_designer_field_padding_bottom'     => '3',
            'login_designer_field_side_padding'       => '12',
            'login_designer_field_margin_bottom'      => '16',
            'login_designer_field_border'             => '1',
            'login_designer_field_border_color'       => '#dddddd',
            'login_designer_field_radius'             => '0',
            'login_designer_field_shadow'             => '2',
            'login_designer_field_shadow_opacity'     => '7',
            'login_designer_field_shadow_inset'       => true,
            'login_designer_field_font_size'          => '24',
            'login_designer_field_color'              => '#32373c',
            'login_designer_remember_field_color'     => '#72777c',
            'login_designer_remember_field_font_size' => '12',
            'login_designer_remember_field_position'  => '5',
            'login_designer_label_position'           => '2',
            'login_designer_label_font_size'          => '14',
            'login_designer_label_color'              => '#72777c',
            'login_designer_username_label'           => esc_html__( 'Username or Email Address', 'addons-for-divi' ),
            'login_designer_password_label'           => esc_html__( 'Password', 'addons-for-divi' ),
            'login_designer_button_bg'                => '#0085ba',
            'login_designer_button_padding_top'       => '4',
            'login_designer_button_padding_bottom'    => '4',
            'login_designer_button_side_padding'      => '12',
            'login_designer_button_border'            => '1',
            'login_designer_button_border_color'      => '#0073aa',
            'login_designer_button_radius'            => '3',
            'login_designer_button_shadow'            => '0',
            'login_designer_button_shadow_opacity'    => '0',
            'login_designer_button_font_size'         => '13',
            'login_designer_button_color'             => '#ffffff',
            'login_designer_below_color'              => '#444',
            'login_designer_below_position'           => '0',
            'login_designer_below_font_size'          => '13',
            'login_designer_lost_password'            => true,
            'login_designer_back_to'                  => true,
        );

        return apply_filters( 'brainaddons_defaults', $defaults );
    }

    public function login_logo_info_callback() {

        $defaults = self::defaults();

        $options = get_option( 'brain_addons' );

        $options = wp_parse_args( $options, $defaults );

        if ( $options ) {
            $options = array_filter( $options );
        }

        $logo = $options['login_designer_logo'];
        $logo = wp_get_attachment_image_src( $logo, 'full' );

        $args = array(
            'done'   => 1,
            'url'    => esc_url( $logo[0] ),
            'width'  => absint( $logo[1] ),
            'height' => absint( $logo[2] ),
        );

        wp_send_json( $args );

        wp_die();
    }

    public function print_css() {

        $defaults = self::defaults();

        $options = get_option( 'brain_addons' );

        $options = wp_parse_args( $options, $defaults );

        if ( $options ) {
            $options = array_filter( $options );
        }

        $print_css = '';

        if ( !empty( $options ) ):

            $print_css .= $this->customize_css(
                'login_designer_bg_image',
                'background-image',
                'body.login',
                'url',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_bg_color',
                'background-color',
                'body.login',
                '',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_bg_repeat',
                'background-repeat',
                'body.login',
                '',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_bg_position',
                'background-position',
                'body.login',
                '',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_bg_size',
                'background-size',
                'body.login',
                '',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_bg_attach',
                'background-attachment',
                'body.login',
                '',
                ''
            );

            // Logo.
            if ( isset( $options['login_designer_logo'] ) ) {

                $image = wp_get_attachment_image_src( $options['login_designer_logo'], 'full' );

                $image_width  = $image[1] / 2;
                $image_height = $image[2] / 2;

                $width  = $options['login_designer_logo_width'];
                $height = $options['login_designer_logo_height'];

                $width  = isset( $width ) ? $width : $image_width;
                $height = isset( $height ) ? $height : $image_height;

                $print_css .= '

		                    body.login #login h1 a {
		                        background-image: url(" ' . esc_url( $image[0] ) . ' ");
		                        background-position: center center;
		                    }

		                    body.login #login h1 a {
		                        background-size: ' . absint( $width ) . 'px ' . absint( $height ) . 'px ;
		                    }

		                    body.login #login h1 a {
		                        width: ' . absint( $width ) . 'px;
		                        height: ' . absint( $height ) . 'px;
		                    }

		                ';
            }

            $print_css .= $this->customize_css(
                'login_designer_logo_margin_bottom',
                'margin-bottom',
                'body.login #login h1 a',
                'px',
                '!important'
            );

            // Form.
            $print_css .= $this->customize_css(
                'login_designer_form_bg_image',
                'background-image',
                '#login form',
                'url',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_form_bg_color',
                'background-color',
                '#login form',
                '',
                '!important'
            );

            $print_css .= '#login { width:100%; }';

            $print_css .= $this->customize_css(
                'login_designer_form_width',
                'max-width',
                '#login',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_form_side_padding',
                'padding-left',
                '#login form',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_form_side_padding',
                'padding-right',
                '#login form',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_form_vertical_padding',
                'padding-top',
                '#login form',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_form_vertical_padding',
                'padding-bottom',
                '#login form',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_form_radius',
                'border-radius',
                '#login form',
                'px',
                '!important'
            );

            $print_css .= $this->customize_css(
                'login_designer_form_border_color',
                'border-color',
                '#login form',
                '',
                '!important'
            );

            if ( isset( $options['login_designer_form_shadow'] ) ) {

                $opacity = ( isset( $options['login_designer_form_shadow_opacity'] ) * .01 ) ? $options['login_designer_form_shadow_opacity'] * .01 : 0;

                $print_css .= '#login form { box-shadow: 0 0 ' . esc_attr( $options['login_designer_form_shadow'] ) . 'px rgba(0, 0, 0, ' . esc_attr( $opacity ) . '); }';

            } else {
                $print_css .= '#login form { box-shadow: none; }';
            }

            // Fields.
            if ( isset( $options['login_designer_fields_bg_color'] ) ) {

                $print_css .= '#login form .input { background-color:' . esc_attr( $options['login_designer_fields_bg_color'] ) . ';  -webkit-box-shadow: inset 0 0 0px 9999px ' . esc_attr( $options['login_designer_fields_bg_color'] ) . '; }';
            }

            $print_css .= '#brainaddons-password { position: relative; }';

            $print_css .= $this->customize_css(
                'login_designer_field_side_padding',
                'padding-right',
                '#login form .input',
                'px',
                '!important'
            );

            $print_css .= $this->customize_css(
                'login_designer_field_side_padding',
                'padding-left',
                '#login form .input',
                'px',
                '!important'
            );

            $print_css .= $this->customize_css(
                'login_designer_field_margin_bottom',
                'margin-bottom',
                '#login form .input',
                'px',
                '!important'
            );

            $print_css .= $this->customize_css(
                'login_designer_field_padding_bottom',
                'padding-bottom',
                '#login form .input',
                'px',
                '!important'
            );

            $print_css .= $this->customize_css(
                'login_designer_field_padding_top',
                'padding-top',
                '#login form .input',
                'px',
                '!important'
            );

            $print_css .= $this->customize_css(
                'login_designer_field_border',
                'border-width',
                '#login form .input',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_field_border_color',
                'border-color',
                '#login form .input',
                '',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_field_radius',
                'border-radius',
                '#login form .input',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_field_font_size',
                'font-size',
                '#login form .input',
                'px',
                '!important'
            );

            $print_css .= $this->customize_css(
                'login_designer_field_color',
                'color',
                '#login form .input',
                '',
                '!important'
            );

            if ( isset( $options['login_designer_field_shadow'] ) ) {

                $opacity = ( isset( $options['login_designer_field_shadow_opacity'] ) ) ? $options['login_designer_field_shadow_opacity'] * .01 : 0;

                $inset = isset( $options['login_designer_field_shadow_inset'] ) ? 'inset' : '';

                $shadow = esc_attr( $inset ) . ' 0 0 ' . esc_attr( $options['login_designer_field_shadow'] ) . 'px rgba(0, 0, 0, ' . esc_attr( $opacity ) . ')';

                if ( isset( $options['login_designer_fields_bg_color'] ) ) {

                    $print_css .= '#login form .input { box-shadow: ' . $shadow . ', inset 0 0 0 9999px ' . esc_attr( $options['login_designer_fields_bg_color'] ) . ' }';

                } else {
                    $print_css .= '#login form .input { box-shadow: ' . $shadow . ' }';
                }
            } else {

                if ( isset( $options['login_designer_fields_bg_color'] ) ) {

                    $print_css .= 'login form .input { box-shadow: inset 0 0 0 9999px ' . esc_attr( $options['login_designer_fields_bg_color'] ) . ' }';

                } else {
                    $print_css .= '#login form .input { box-shadow: none; }';
                }
            }

            $print_css .= $this->customize_css(
                'login_designer_label_font_size',
                'font-size',
                '#login .message',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_label_font_size',
                'font-size',
                '#login form label:not([for=rememberme])',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_label_color',
                'color',
                '#login .message',
                '',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_label_color',
                'color',
                '#login form label:not([for=rememberme])',
                '',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_label_position',
                'margin-top',
                '#login form .input',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_button_bg',
                'background-color',
                '#login form .submit .button',
                '',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_button_padding_top',
                'padding-top',
                '#login form .submit .button',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_button_padding_bottom',
                'padding-bottom',
                '#login form .submit .button',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_button_side_padding',
                'padding-left',
                '#login form .submit .button',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_button_side_padding',
                'padding-right',
                '#login form .submit .button',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_button_border',
                'border-width',
                '#login form .submit .button',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_button_radius',
                'border-radius',
                '#login form .submit .button',
                'px',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_button_border_color',
                'border-color',
                '#login form .submit .button',
                '',
                ''
            );

            $print_css .= $this->customize_css(
                'login_designer_button_font_size',
                'font-size',
                '#login form .submit .button',
                'px',
                '!important'
            );

            $print_css .= $this->customize_css(
                'login_designer_button_color',
                'color',
                '#login form .submit .button',
                '',
                '!important'
            );

            if ( isset( $options['login_designer_button_shadow'] ) ) {

                $opacity = ( isset( $options['login_designer_button_shadow_opacity'] ) ) ? $options['login_designer_button_shadow_opacity'] * .01 : 0;

                $shadow = '0 0 ' . esc_attr( $options['login_designer_button_shadow'] ) . 'px rgba(0, 0, 0, ' . esc_attr( $opacity ) . ')';

                $print_css .= '#login form .submit .button { box-shadow: ' . $shadow . ' }';
            }

            // Remember.
            $print_css .= $this->customize_css(
                'login_designer_remember_field_font_size',
                'font-size',
                '#login .forgetmenot label',
                'px',
                '!important'
            );

            $print_css .= $this->customize_css(
                'login_designer_remember_field_position',
                'margin-top',
                '#login form .forgetmenot',
                'px',
                '!important'
            );

            $print_css .= $this->customize_css(
                'login_designer_remember_field_color',
                'color',
                '#login .forgetmenot label',
                '',
                '!important'
            );

            if ( false === isset( $options['login_designer_lost_password'] ) ) {
                if ( is_customize_preview() ) {
                    $print_css .= '#login #nav { opacity: 0; }';
                } else {
                    $print_css .= '#login #nav { display: none; }';
                }
            }

            if ( false === isset( $options['login_designer_back_to'] ) ) {
                if ( is_customize_preview() ) {
                    $print_css .= '#login #backtoblog { opacity: 0; }';
                } else {
                    $print_css .= '#login #backtoblog { display: none; }';
                }
            }

            $print_css .= $this->customize_css(
                'login_designer_below_color',
                'color',
                '#login #nav, #login #nav a, #login #backtoblog a',
                '',
                '!important'
            );
            $print_css .= $this->customize_css(
                'login_designer_below_position',
                'margin-top',
                '.login #login form + p',
                'px',
                '!important'
            );

            $print_css .= $this->customize_css(
                'login_designer_below_font_size',
                'font-size',
                '#login #nav, #login #nav a, #login #backtoblog a',
                'px',
                '!important'
            );

        endif;

        $print_css = preg_replace( '#/\*.*?\*/#s', '', $print_css );
        $print_css = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $print_css );
        $print_css = preg_replace( '/\s\s+(.*)/', '$1', $print_css );

        wp_add_inline_style( 'login', wp_strip_all_tags( $print_css ) );
    }

    public function customize_css( $control, $css_property, $selector, $unit, $priority ) {

        $defaults = self::defaults();
        $options  = get_option( 'brain_addons' );
        $options  = wp_parse_args( $options, $defaults );

        if ( $options ) {
            $options = array_filter( $options );
        }

        if ( isset( $options[$control] ) ) {
            if ( isset( $unit ) ) {
                if ( 'url' === $unit ) {
                    $new_value = 'url(' . $options[$control] . ')';
                } else {
                    if ( isset( $priority ) ) {
                        $new_value = $options[$control] . $unit . $priority;
                    } else {
                        $new_value = $options[$control] . $unit;
                    }
                }
            } else {
                if ( isset( $priority ) ) {
                    $new_value = $options[$control] . $priority;
                } else {
                    $new_value = $options[$control];
                }
            }

            return $selector . ' { ' . $css_property . ': ' . esc_attr( $new_value ) . '; }';
        }

        return;
    }

    public function bc_options( $option ) {
        $options = get_option( 'brain_addons' );
        if ( !$options ) {
            return false;
        }
        if ( isset( $options[$option] ) ) {
            return $options[$option];
        } else {
            return false;
        }
    }

    public function login_head() {
        add_filter( 'gettext', array( $this, 'username_label' ), 20, 3 );
        add_filter( 'gettext', array( $this, 'password_label' ), 20, 3 );
    }

    public function logo_url() {

        $option = $this->bc_options( 'login_designer_logo_url' );

        if ( $option ) {
            return get_page_link( $option );
        } else {
            return esc_url( home_url( '/' ) );
        }
    }

    public function username_label( $translated_text, $text, $domain ) {

        $default = 'Username or Email Address';
        $options = get_option( 'brain_addons' );
        $label   = $this->bc_options( 'login_designer_username_label' );

        if ( !$options && $default === $text ) {
            return $translated_text;
        }

        if ( $options && $default === $text ) {
            if ( isset( $options['login_designer_username_label'] ) ) {
                $translated_text = esc_html( $label );
            } else {
                return $translated_text;
            }
        }

        return $translated_text;
    }

    public function password_label( $translated_text, $text, $domain ) {

        $default = 'Password';
        $options = get_option( 'brain_addons' );
        $label   = $this->bc_options( 'login_designer_password_label' );

        if ( !$options && $default === $text ) {
            return $translated_text;
        }

        if ( $options && $default === $text ) {

            if ( isset( $options['login_designer_password_label'] ) ) {
                $translated_text = esc_html( $label );
            } else {
                return $translated_text;
            }
        }

        return $translated_text;
    }

    public function login_enqueue_scripts() {
        $path = DIVI_TORQUE_PLUGIN_URL . '/includes/customizer/';
        wp_enqueue_style(
            'brainaddons-customizer-preview',
            $path . 'css/brainaddons-customizer-preview.css',
            false,
            DIVI_TORQUE_PLUGIN_VERSION
        );
    }
}

new Login_Designer();
