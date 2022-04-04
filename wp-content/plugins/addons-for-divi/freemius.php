<?php
if ( !function_exists( 'brainaddons_fs' ) ) {
    function brainaddons_fs() {
        global $brainaddons_fs;
        if ( !isset( $brainaddons_fs ) ) {
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $brainaddons_fs = fs_dynamic_init(
                array(
                    'id'               => '7135',
                    'slug'             => 'addons-for-divi',
                    'premium_slug'     => 'addons-for-divi-premium',
                    'type'             => 'plugin',
                    'public_key'       => 'pk_c7283f055cecf2bc84f0c13a22b7c',
                    'is_premium'       => false,
                    'has_addons'       => true,
                    'has_paid_plans'   => false,
                    'is_org_compliant' => true,
                    'menu'             => array(
                        'slug'    => 'addons-for-divi',
                        'support' => false,
                    ),
                )
            );
        }

        return $brainaddons_fs;
    }

    brainaddons_fs();

    do_action( 'brainaddons_fs_loaded' );
}
