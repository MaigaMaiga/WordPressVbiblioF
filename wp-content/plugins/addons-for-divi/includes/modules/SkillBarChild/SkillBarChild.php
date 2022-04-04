<?php

class DTQ_Skill_Bar_Child extends BA_Builder_Module {

	public $slug                     = 'ba_skill_bar_child';
	public $vb_support               = 'on';
	public $type                     = 'child';
	public $child_title_var          = 'admin_title';
	public $child_title_fallback_var = 'name';

	public function init() {

		$this->name = esc_html__( 'Bar', 'addons-for-divi' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__( 'Content', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'bar'   => esc_html__( 'Bar Style', 'addons-for-divi' ),
					'name'  => esc_html__( 'Name Text', 'addons-for-divi' ),
					'level' => esc_html__( 'Level Text', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'name_text'  => array(
				'label'    => esc_html__( 'Name Text', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-skillbar__name',
			),
			'level_text' => array(
				'label'    => esc_html__( 'Level Text', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-skillbar__level',
			),
			'level'      => array(
				'label'    => esc_html__( 'Level', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-skillbar__inner',
			),
			'bar'        => array(
				'label'    => esc_html__( 'Bar', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-skillbar__wrapper',
			),
		);
	}

	public function get_fields() {
		$fields = array(

			'use_name'       => array(
				'label'           => esc_html__( 'Use Name', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether name text should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'on',
				'toggle_slug'     => 'content',
			),

			'name'           => array(
				'label'       => esc_html__( 'Name', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the name text for the skill bar.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
				'default'     => 'Web Design',
				'show_if'     => array(
					'use_name' => 'on',
				),
			),

			'level'          => array(
				'label'          => esc_html__( 'Level', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define the level text for the skill bar.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '30%',
				'fixed_unit'     => '%',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'    => 'content',
			),

			'is_hide_level'  => array(
				'label'           => esc_html__( 'Hide Level Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether level text should be hidden.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'content',
			),

			'text_placement' => array(
				'label'       => esc_html__( 'Text Placement', 'addons-for-divi' ),
				'description' => esc_html__( 'Define text placement for the skill bar.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'default'     => 'in',
				'options'     => array(
					'in'  => esc_html__( 'Inside', 'addons-for-divi' ),
					'out' => esc_html__( 'Outside', 'addons-for-divi' ),
				),
			),

			// Styling.
			'bar_height'     => array(
				'label'           => esc_html__( 'Bar Height', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define static height for the bar.', 'addons-for-divi' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '30px',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'bar',
				'mobile_options'  => true,
			),

			'bar_radius'     => array(
				'label'          => esc_html__( 'Bar Border Radius', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define border radius value for the bar.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '40px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'bar',
			),

			'text_spacing'   => array(
				'label'          => esc_html__( 'Outer Text Spacing', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define spacing for the outer text.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '12px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'bar',
				'show_if'        => array(
					'text_placement' => 'out',
				),
			),

			'name_spacing'   => array(
				'label'          => esc_html__( 'Name Spacing', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define name spacing from the edge.', 'addons-for-divi' ),
				'type'           => 'range',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'name',
				'default_unit'   => 'px',
				'mobile_options' => true,
			),

			'level_spacing'  => array(
				'label'          => esc_html__( 'Level Spacing', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define level spacing from the edge.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'level',
				'mobile_options' => true,
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

		$level_bg = $this->custom_background_fields(
			'level',
			esc_html__( 'Level', 'addons-for-divi' ),
			'advanced',
			'bar',
			array( 'color', 'gradient', 'hover' ),
			array(),
			$this->default_color
		);

		$bar_bg = $this->custom_background_fields(
			'bar',
			esc_html__( 'Bar', 'addons-for-divi' ),
			'advanced',
			'bar',
			array( 'color', 'gradient', 'hover' ),
			array(),
			'#dddddd'
		);

		return array_merge( $label, $level_bg, $bar_bg, $fields );
	}


	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['borders']     = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;
		$advanced_fields['background']  = false;

		$advanced_fields['fonts']['name'] = array(
			'label'           => esc_html__( 'Name', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '.dtq-skill %%order_class%% .dtq-skillbar__name',
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
				'main'      => '.dtq-skill %%order_class%% .dtq-skillbar__level',
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

		$advanced_fields['box_shadow']['bar'] = array(
			'toggle_slug' => 'bar',
			'label'       => esc_html__( 'Bar Box Shadow', 'addons-for-divi' ),
			'css'         => array(
				'main'      => '%%order_class%% .dtq-skillbar__wrapper',
				'important' => 'all',
			),
		);

		return $advanced_fields;
	}

	public function _renderName() {
		$use_name = $this->props['use_name'];
		$name     = $this->props['name'];

		if ( $use_name === 'on' ) {
			return '<span class="dtq-skillbar__name">' . $name . '</span>';
		}
	}

	public function _renderLevel() {
		$level         = $this->props['level'];
		$is_hide_level = $this->props['is_hide_level'];

		if ( $is_hide_level !== 'on' ) {
			return '<span class="dtq-skillbar__level">' . $level . '</span>';
		}
	}

	public function _renderInnerText() {
		$use_name      = $this->props['use_name'];
		$is_hide_level = $this->props['is_hide_level'];

		if ( $use_name === 'on' || $is_hide_level === 'off' ) {
			return sprintf(
				'<div class="dtq-skillbar__inner__text">%1$s %2$s</div>',
				$this->_renderName(),
				$this->_renderLevel()
			);

		}
	}


	public function render( $attrs, $content, $render_slug ) {

		// Module classnames
		$this->remove_classname( 'et_pb_module' );
		$this->add_classname( 'ba_et_pb_module' );

		// Render CSS
		$this->render_css( $render_slug );

		return sprintf(
			'
			<div class="dtq-module dtq-child dtq-skillbar">
				<div class="dtq-skillbar__wrapper">
				    <div class="dtq-skillbar__inner">%1$s</div>
				</div>
			</div>',
			$this->_renderInnerText()
		);
	}

	protected function render_css( $render_slug ) {

		$text_spacing                 = $this->props['text_spacing'];
		$level                        = $this->props['level'];
		$bar_height                   = $this->props['bar_height'];
		$bar_height_tablet            = $this->props['bar_height_tablet'];
		$bar_height_phone             = $this->props['bar_height_phone'];
		$bar_height_last_edited       = $this->props['bar_height_last_edited'];
		$bar_height_responsive_status = et_pb_get_responsive_status( $bar_height_last_edited );
		$text_placement               = $this->props['text_placement'];
		$bar_radius                   = $this->props['bar_radius'];
		$use_name                     = $this->props['use_name'];

		if ( $use_name === 'off' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-skillbar__inner__text',
					'declaration' => 'justify-content: flex-end;',
				)
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-skillbar__inner__text',
					'declaration' => 'justify-content: space-between;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-skillbar__inner',
				'declaration' => sprintf(
					'
                width:%1$s;
                height:%2$s;',
					$level,
					$bar_height
				),
			)
		);

		if ( $bar_height_tablet && $bar_height_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-skillbar__inner',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'height: %1$s;', $bar_height_tablet ),
				)
			);
		}

		if ( $bar_height_phone && $bar_height_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-skillbar__inner',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'height: %1$s;', $bar_height_phone ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-skillbar__wrapper',
				'declaration' => sprintf(
					'border-radius:%1$s;',
					$bar_radius
				),
			)
		);

		if ( ! empty( $this->props['name_spacing'] ) ) {
			$this->get_responsive_styles(
				'name_spacing',
				'.dtq-skill %%order_class%% .dtq-skillbar__name',
				array( 'primary' => 'margin-left' ),
				array( 'default' => '0px' ),
				$render_slug
			);
		}
		if ( ! empty( $this->props['level_spacing'] ) ) {
			$this->get_responsive_styles(
				'level_spacing',
				'.dtq-skill %%order_class%% .dtq-skillbar__level',
				array( 'primary' => 'margin-right' ),
				array( 'default' => '0px' ),
				$render_slug
			);
		}

		if ( 'out' === $text_placement ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-skillbar__inner__text',
					'declaration' => sprintf(
						'
                        position:absolute;
                        top:-%1$s;
                        width:%2$s;
                        height:auto;
                        transform:translateY(-100%%);',
						$text_spacing,
						$level
					),
				)
			);
		} elseif ( 'in' === $text_placement ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-skillbar__inner__text',
					'declaration' => 'width: 100%;height: 100%;',
				)
			);
		}

		$this->get_custom_bg_style( $render_slug, 'level', '%%order_class%% .dtq-skillbar__inner', '%%order_class%%:hover .dtq-skillbar__inner' );

		$this->get_custom_bg_style( $render_slug, 'bar', '%%order_class%% .dtq-skillbar__wrapper', '%%order_class%%:hover .dtq-skillbar__wrapper' );

	}
}

new DTQ_Skill_Bar_Child();
