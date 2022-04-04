<?php
namespace BrainAddons;

if ( !defined( 'WPINC' ) ) {
    die;
}

class Popup_Post_Type {

    private static $instance = null;

    protected $post_type = 'brainaddons-popup';

    protected $meta_key = 'brainaddons-popup-item';

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Constructor for the class
     * 
     */
    public function __construct() {

        // Init Brain Popup CPT.
        self::register_post_type();

        add_filter( 'et_builder_post_types', array( $this, 'builder_post_types' ) );
        add_filter( 'et_fb_post_types', array( $this, 'maybe_filter_builder_post_types' ) );
        add_filter( 'et_builder_third_party_post_types', array( $this, 'builder_post_types' ) );
        add_filter( 'manage_' . $this->slug() . '_posts_columns', array( $this, 'set_post_columns' ) );
        add_action( 'template_include', array($this, 'register_preview_template'), 999 );
        add_action( 'do_meta_boxes' , array($this, 'remove_post_meta_box' ), 11, 1 );
        add_action( 'wp_trash_post', array( $this, 'remove_post_from_popup_conditions' ) );

        //Init metabox.
        self::metabox();

    }

    /**
     * Remove popup conditions
     *
     * @param integer $post_id
     * @return void
     */
    public function remove_post_from_popup_conditions( $post_id = 0 ) {
        $conditions = get_option( 'ba_display_conditions', [] );
        $conditions = $this->remove_post_from_conditions_array( $post_id, $conditions );
        update_option( 'ba_display_conditions', $conditions, true );
    }

    /**
     * Conditions
     *
     * @param integer $post_id
     * @param array $conditions
     * @return void
     */
    public function remove_post_from_conditions_array( $post_id = 0, $conditions = array() ) {
        foreach ( $conditions as $type => $type_conditions ) {
            if ( array_key_exists( $post_id, $type_conditions ) ) {
                unset( $conditions[ $type ][ $post_id ] );
            }
        }
        return $conditions;
    }

    /**
     * Popup Metabox
     *
     * @return void
     */
    public static function metabox(){
        require_once DIVI_TORQUE_PLUGIN_DIR . 'includes/metabox/popup-metabox.php';
        
        Metabox::instance();

    }

    /**
     * Post types builder enabled.
     *
     * @param [type] $post_types
     * @return void
     */
    public function maybe_filter_builder_post_types( $post_types ) {
        $index = array_search( $this->post_type, $post_types );
        array_splice( $post_types, $index, 1 );
        return $post_types;
    }

    /**
     * Builder Support.
     *
     * @param  array  $post_types
     * @return void
     */
    public function builder_post_types( $post_types ) {
        $post_types[] = $this->slug();
        return $post_types;
    }

    /**
     * Slug
     *
     * @return void
     */
    public function slug() {
        return $this->post_type;
    }

    public function set_post_columns( $columns ) {

        unset( $columns['date'] );

        $columns['conditions'] = __( 'Active Conditions', 'addons-for-divi' );
        $columns['date']       = __( 'Date', 'addons-for-divi' );

        return $columns;
    }

    /**
     * Reguster Post Type.
     *
     * @return void
     */
    static public function register_post_type() {

        $labels = array(
            'name'          => esc_html__( 'Popups', 'addons-for-divi' ),
            'singular_name' => esc_html__( 'Popups', 'addons-for-divi' ),
            'all_items'     => esc_html__( 'All Popups', 'addons-for-divi' ),
            'add_new'       => esc_html__( 'Add New Popup', 'addons-for-divi' ),
            'add_new_item'  => esc_html__( 'Add New Popup', 'addons-for-divi' ),
            'edit_item'     => esc_html__( 'Edit Popup', 'addons-for-divi' ),
            'menu_name'     => esc_html__( 'Popups', 'addons-for-divi' ),
        );

        $args = array(
            'labels'              => $labels,
            'hierarchical'        => false,
            'description'         => 'description',
            'taxonomies'          => array(),
            'public'              => true,
            'show_ui'             => true,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => false,
            'publicly_queryable'  => true,
            'exclude_from_search' => true,
            'has_archive'         => true,
            'show_in_menu'        => 'edit.php?post_type=brainaddons-popup',
            'query_var'           => true,
            'can_export'          => true,
            'rewrite'             => true,
            'capability_type'     => 'post',
            'public'              => true,
            'show_in_rest'        => true,
            'supports'            => array( 'title', 'editor' ),
        );

        register_post_type( 'brainaddons-popup', $args );
    }

    public function remove_post_meta_box() {
        remove_meta_box( 'et_settings_meta_box_gutenberg', 'brainaddons-popup', 'side' ); 
    }

    /**
     * Blank post type single template.
     *
     * @return void
     */
    public function register_preview_template( $template ) {

        if ( is_singular( $this->slug() ) ) {
            $template = plugin_dir_path( __FILE__ ) . 'single.php';
            if ( isset( $_GET['et_fb'] ) && 1 === $_GET['et_fb'] ) { //phpcs:ignore
                $template = plugin_dir_path( __FILE__ ) . 'single.php'; //phpcs:ignore
                return $template;
            }
        }
        
        return $template;
    }
}
