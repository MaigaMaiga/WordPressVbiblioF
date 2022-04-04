<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Exit if WP_Customize_Control does not exsist.
if (!class_exists('WP_Customize_Control')) {
    return null;
}

class BrainAddons_Title_Control extends WP_Customize_Control {

    public $type = 'brainaddons-title';

    public function render_content() {}

    protected function content_template() {
        ?>
		<# if ( data.label ) { #>
			<div class="control-field title-control">
				<span class="customize-control-title">{{ data.label }}</span>
			</div>
		<# } #>

		<# if ( data.description ) { #>
			<span class="customize-control-description">{{ data.description }}</span>
		<# } #>
		<?php
}
}
