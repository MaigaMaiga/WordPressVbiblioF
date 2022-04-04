<?php

class DTQ_Skill_Bar extends BA_Builder_Module {

	public $slug       = 'ba_skill_bar';
	public $vb_support = 'on';
	public $child_slug = 'ba_skill_bar_child';

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com/skill-bars-module/',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->name      = esc_html__( 'Torque Skill Bars', 'addons-for-divi' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'skill-bars.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__( 'Content', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'title' => esc_html__( 'Title Text', 'addons-for-divi' ),
					'name'  => esc_html__( 'Name Text', 'addons-for-divi' ),
					'level' => esc_html__( 'Level Text', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'title' => array(
				'label'    => esc_html__( 'Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-skill__title',
			),
		);
	}

	public function get_fields() {

		$fields = array(

			'title'                => array(
				'label'       => esc_html__( 'Title', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the title text for your module.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'title_spacing_bottom' => array(
				'label'          => esc_html__( 'Spacing Bottom', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the title.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '10px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'title',
				'mobile_options' => true,
			),

			'bar_spacing_bottom'   => array(
				'label'          => esc_html__( 'Bar Spacing Bottom', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the bar item.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '20px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'margin_padding',
				'mobile_options' => true,
			),

			'name_spacing'         => array(
				'label'          => esc_html__( 'Name Spacing', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define name spacing from the edge.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '15px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'name',
			),

			'level_spacing'        => array(
				'label'          => esc_html__( 'Level Spacing', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define level spacing from the edge.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '15px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'level',
			),

		);

		return $fields;

	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['fonts']['title'] = array(
			'css'             => array(
				'main' => '%%order_class%% .dtq-skill__title',
			),
			'important'       => 'all',
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'title',
			'header_level'    => array(
				'default' => 'h3',
			),
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '30px',
			),
		);

		$advanced_fields['fonts']['name'] = array(
			'label'           => esc_html__( 'Name', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-skillbar__name',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'name',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['fonts']['level'] = array(
			'label'           => esc_html__( 'Level', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-skillbar__level',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'level',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		return $advanced_fields;
	}

	public function render_title() {

		$title                 = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level( $title_level, 'h3' );
		$processed_title_level = esc_html( $processed_title_level );

		if ( ! empty( $title ) ) {
			return sprintf(
				'<%1$s class="dtq-skill__title">%2$s</%1$s>',
				$processed_title_level,
				$title
			);
		}
	}


	public function render( $attrs, $content, $render_slug ) {

		$this->get_responsive_styles(
			'name_spacing',
			'%%order_class%% .dtq-skillbar__name',
			array( 'primary' => 'margin-left' ),
			array( 'default' => '15px' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'level_spacing',
			'%%order_class%% .dtq-skillbar__level',
			array( 'primary' => 'margin-right' ),
			array( 'default' => '15px' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'title_spacing_bottom',
			'%%order_class%% .dtq-skill__title',
			array(
				'primary'   => 'margin-bottom',
				'important' => false,
			),
			array( 'default' => '10px' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'bar_spacing_bottom',
			'%%order_class%% .ba_skill_bar_child',
			array(
				'primary'   => 'margin-bottom',
				'important' => true,
			),
			array( 'default' => '20px' ),
			$render_slug
		);

		return sprintf( '<div class="dtq-module dtq-parent dtq-skill">%1$s %2$s </div>', $this->render_title(), $this->props['content'] );
	}
}

new DTQ_Skill_Bar();
