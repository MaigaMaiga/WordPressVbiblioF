<?php
class DTQ_Logo_Carousel_Child extends BA_Builder_Module {

	public $slug                     = 'ba_logo_carousel_child';
	public $vb_support               = 'on';
	public $type                     = 'child';
	public $child_title_var          = 'admin_title';
	public $child_title_fallback_var = 'brand_name';

	public function init() {

		$this->name = esc_html__( 'Logo', 'addons-for-divi' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Content', 'addons-for-divi' ),
					'tab_content'  => esc_html__( 'Tab Content', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'overlay' => esc_html__( 'Overlay', 'addons-for-divi' ),
					'borders' => esc_html__( 'Borders', 'addons-for-divi' ),
				),
			),
		);
	}

	public function get_fields() {

		$fields = array(

			'logo'         => array(
				'label'              => esc_html__( 'Upload Logo', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload a logo or type in the URL of the logo you would like to display.', 'addons-for-divi' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload a Logo', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose a Logo', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Logo', 'addons-for-divi' ),
				'toggle_slug'        => 'main_content',
				'mobile_options'     => true,
				'hover'              => 'tabs',
			),

			'brand_name'   => array(
				'label'       => esc_html__( 'Logo Alt Text', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the HTML ALT text for your logo image here.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'main_content',
			),

			'is_link'      => array(
				'label'           => esc_html__( 'Use Link', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether logo should be linked.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'main_content',
			),

			'link_url'     => array(
				'label'           => esc_html__( 'Link Url', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define the logo link url.', 'addons-for-divi' ),
				'type'            => 'text',
				'default'         => '',
				'dynamic_content' => 'url',
				'show_if'         => array(
					'is_link' => 'on',
				),
				'toggle_slug'     => 'main_content',
			),

			'link_options' => array(
				'type'        => 'multiple_checkboxes',
				'default'     => 'off|off',
				'toggle_slug' => 'main_content',
				'options'     => array(
					'link_target' => 'Open in new window',
					'link_rel'    => 'Add nofollow',
				),
				'show_if'     => array(
					'is_link' => 'on',
				),
			),
		);

		$label = array(
			'admin_title' => array(
				'label'       => esc_html__( 'Admin Label', 'addons-for-divi' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the item', 'addons-for-divi' ),
				'toggle_slug' => 'admin_label',
			),
		);

		$overlay = $this->get_overlay_option_fields( 'overlay', 'off', array() );

		return array_merge( $label, $fields, $overlay );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['fonts']       = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['max_width']   = false;

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%% .dtq-logo-carousel-item',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['item'] = array(
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%%',
					'border_styles' => '%%order_class%%',
				),
				'important' => 'all',
			),
			'label_prefix' => esc_html__( 'Item', 'addons-for-divi' ),
			'defaults'     => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
			'tab_slug'     => 'advanced',
			'toggle_slug'  => 'borders',
		);

		return $advanced_fields;
	}

	public function render_ref_attr() {

		if ( $this->props['is_link'] === 'on' ) {

			$link_options = explode( '|', $this->props['link_options'] );

			if ( $link_options[1] === 'on' ) {
				return sprintf( 'ref="nofollow"' );
			}
		}

	}

	public function render_logo() {

		$logo        = $this->props['logo'];
		$data_schema = $this->get_swapped_img_schema( 'logo' );
		$brand_name  = $this->props['brand_name'];

		if ( $this->props['is_link'] === 'on' ) {

			$link_options = explode( '|', $this->props['link_options'] );
			$target       = $link_options[0] === 'on' ? '_blank' : '_self';
			$link_url     = $this->props['link_url'];

			return sprintf(
				'<a target="%1$s" href="%2$s" %3$s><img class="dtq-swapped-img" data-mfp-src="%4$s" src="%4$s" alt="%5$s" %6$s /></a>',
				$target,
				$link_url,
				$this->render_ref_attr(),
				$logo,
				$brand_name,
				$data_schema
			);
		}

		return sprintf(
			'
            <div class="dtq-lightbox-ctrl"><img class="dtq-swapped-img" data-mfp-src="%1$s" src="%1$s" alt="%2$s" %3$s /></div>',
			$logo,
			$brand_name,
			$data_schema
		);
	}

	public function render( $attrs, $content, $render_slug ) {

		// Module classes.
		$this->remove_classname( 'et_pb_module' );

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'overlay_icon',
				'important'      => true,
				'selector'       => '%%order_class%% .dtq-overlay .dtq-overlay-icon',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		// Overlay Styles.
		$this->get_overlay_style( $render_slug, 'logo', '%%order_class%% .dtq-carousel-item' );
		dtq_inject_fa_icons( $this->props['overlay_icon'] );
		$processed_overlay_icon = esc_attr( et_pb_process_font_icon( $this->props['overlay_icon'] ) );
		$overlay_icon           = ! empty( $processed_overlay_icon ) ? $processed_overlay_icon : '';

		return sprintf(
			'<div class="dtq-carousel-item dtq-logo-carousel-item dtq-swapped-img-selector">
			    <div class="dtq-overlay"><i class="dtq-overlay-icon">%2$s</i></div>
				%1$s
			</div>',
			$this->render_logo(),
			$overlay_icon
		);
	}
}

new DTQ_Logo_Carousel_Child();
