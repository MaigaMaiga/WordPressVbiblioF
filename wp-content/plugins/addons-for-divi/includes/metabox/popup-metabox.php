<?php
namespace BrainAddons;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Metabox {

	protected $post_type = 'brainaddons-popup';

	public static function instance() {
		static $instance;
		if ( ! $instance ) {
			$instance = new self();
		}
		return $instance;
	}

	protected function __construct() {
		add_action( 'wp_loaded', array( $this, '_initialize' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_head', array( $this, 'scripts' ), 20 );
		add_action( 'admin_footer', array( $this, 'templates' ), 10 );
	}

	public function _initialize() {
		if ( is_admin() ) {
			add_action( 'add_meta_boxes', array( $this, 'register_popup_metabox' ), 10 );
			add_action( 'save_post', array( $this, 'save_popup_metabox' ), 10, 2 );
		}
	}

	public function register_popup_metabox() {
		add_meta_box(
			'popup-rules',
			__( 'Display Conditions', 'addons-for-divi' ),
			array( $this, 'display_conditions' ),
			$this->slug(),
			'side',
			'core'
		);
	}

	public function get_all_posts( $posttype = 'post' ) {

		$all_posts     = array();
		$all_posts[''] = 'All';

		$args = array(
			'post_type'   => $posttype,
			'post_status' => 'publish',
			'numberposts' => -1,
		);

		$myposts = get_posts( $args );

		if ( $myposts ) {
			foreach ( $myposts as $post ) :
				$all_posts[ $post->ID ] = $post->post_title;
			endforeach;
			wp_reset_postdata();
		}

		return $all_posts;
	}

	public function save_popup_metabox( $post_id, $post ) {

		if ( $this->slug() !== $post->post_type ) {
			return;
		}

		if ( ! isset( $_POST['_ba_display_conditions_nonce'] ) ||
            !wp_verify_nonce( $_POST['_ba_display_conditions_nonce'], '_ba_display_conditions_nonce' ) ) { //phpcs:ignore
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$new        = array();
		$old        = get_post_meta( $post_id, '_ba_display_conditions', true );
        $conditions = !empty( $_POST['conditions'] ) ? $_POST['conditions'] : array(); //phpcs:ignore
		$count      = count( $conditions['type'] );

		for ( $i = 0; $i < $count; $i++ ) {

			if ( '' !== $conditions['type'][ $i ] ) :

				if ( in_array( $conditions['type'][ $i ], array( '1' ), true ) ) {
					$new[ $i ]['include'] = true;
				} else {
					$new[ $i ]['include'] = false;
				}

				$options = array( 'entire', 'page_selected' );
				if ( in_array( $conditions['target'][ $i ], $options, true ) ) {
					$new[ $i ]['target'] = $conditions['target'][ $i ];
				} else {
					$new[ $i ]['target'] = '';
				}

				$options = array( 'page_selected' );
				if ( in_array( $conditions['target'][ $i ], $options, true ) ) {
					$new[ $i ]['post'] = $conditions['target']['post'][ $i ];
				}

			endif;
		}

		if ( ! empty( $new ) && $new !== $old ) {
			update_post_meta( $post_id, '_ba_display_conditions', $new );
		} elseif ( empty( $new ) && $old ) {
			delete_post_meta( $post_id, '_ba_display_conditions', $old );
		}

		$type = 'brain-popup';

		$conditions = get_post_meta( $post_id, '_ba_display_conditions', true );
		$conditions = ! empty( $conditions ) ? $conditions : array();
		$saved      = get_option( 'ba_display_conditions', array() );

		if ( ! isset( $saved[ $type ] ) ) {
			$saved[ $type ] = array();
		}

		$saved[ $type ][ $post_id ] = $conditions;

		update_option( 'ba_display_conditions', $saved, true );

	}

	public function display_conditions() {
		include plugin_dir_path( __FILE__ ) . 'view/display-conditions.php';
	}

	public function templates() {
		?>
		<script type="text/html" id="tmpl-dtq-condition-page">
			<select class="dtq-select2-initialized" name="conditions[target][post][]">
				<?php
					$myposts = $this->get_all_posts( 'page' );
				if ( $myposts ) :
					foreach ( $myposts as $id => $lebel ) :
						?>
					<option value="<?php echo esc_attr( $id ); ?>">
						<?php echo esc_attr( $lebel ); ?>
					</option>
						<?php
					endforeach;
					wp_reset_postdata();
					endif;
				?>
			</select>
		</script>

		<script type="text/html" id="tmpl-dtq-condition-group">
			<div class="row">
				<div class="dtq-popup-select">
					<select name="conditions[type][]">
						<option value="1"> Include </option>
						<option value="0"> Exclude </option>
					</select>
				</div>

				<div class="dtq-popup-select">
					<select id="dtq-target" class="dtq-taget dtq-select2-initialized" name="conditions[target][]">
						<option value="entire"><?php esc_html_e( 'Entire Site', 'addons-for-divi' ); ?></option>
						<option value="page_selected"><?php esc_html_e( 'Pages', 'addons-for-divi' ); ?></option>
						<!-- <option value="post_selected"><?php // esc_html_e( 'Posts', 'addons-for-divi' ); ?></option>
						<option value="is_front_page"><?php // esc_html_e( 'Frontpage', 'addons-for-divi' ); ?></option>
						<option value="is_404"><?php // esc_html_e( '404 Page', 'addons-for-divi' ); ?></option> -->
					</select>
				</div>
				<div class="dtq-popup-select dtq-popup-target"></div>
				<div class="dtq-popup-remove">
					<?php esc_html_e( 'Remove', 'addons-for-divi' ); ?>
				</div>
			</div>
		</script>

		<?php
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'jquery' );
	}

	public function scripts() {
		?>
		<script>
			jQuery(function($) {

				$('.dtq-select2-initialized').select2();

				$('#dtq-repeat').click(function(){
					var template = wp.template('dtq-condition-group');
					$('.dtq-popup-holder').append(template);
					return false;
				});

				$('.dtq-popup-holder').on('click', '.dtq-popup-remove',function(){
					console.log('removed');
					$parent = $(this).parent('.row');
					$parent.remove();
					return false;
				});

				$('.dtq-popup-holder').on('change', '.dtq-taget', function() {

					var $this = $( this ),
					$allrow = $this.parents( '.row' ),
					$target = $this.val(),
					$page_select = wp.template('dtq-condition-page');

					if( 'page_selected' == $target ) {
						$allrow.find( '.dtq-popup-target' ).empty();
						$allrow.find( '.dtq-popup-target' ).html($page_select);
					} else {
						$allrow.find( '.dtq-popup-target' ).empty();
					}

					$('.dtq-select2-initialized').select2();
				});

			});
		</script>

		<style type="text/css">
			#popup-rules h2 {
				display: block;
				padding: 0;
				font-size: 13px;
				margin-top: 0;
				margin-bottom: 0;
				color: #1d39d8 !important;
			}
			#popup-rules h4 {
				display: block;
				padding: 0;
				font-size: 12px;
				margin-top: 0;
				margin-bottom: 0;
			}
			.dtq-popup-conditions-body {
				width: 100%;
				position: relative;
				overflow: hidden;
				display: flex;
				flex-direction: column;
			}
			.dtq-popup-conditions-body .row {
				padding: 20px 0 10px 0;
				border-bottom: 1px solid rgba(0,0,0,.1);
				display: flex;
				flex-direction: column;
			}
			.dtq-popup-select {
				margin-bottom: 10px;
				display: flex;
				flex-direction: column;
			}
			.dtq-popup-select select {
				box-sizing: border-box;
			}
			.dtq-popup-add-condition {
				margin-top: 10px;
				display: flex;
				align-items: center;
				justify-content: flex-start;
				line-height: 1;
				cursor: pointer;
				font-size: 12px;
				font-weight: 700;
				color: #1d39d8 !important;
				opacity: .8;
			}
			.dtq-popup-remove {
				font-size: 12px;
				font-weight: 700;
				color: #cc1818 !important;
				text-align: right;
				line-height: 1;
				cursor: pointer;
				opacity: .8;
			}
			.dtq-popup-remove:hover,
			.dtq-popup-add-condition:hover {
				opacity: 1;
			}
			.dtq-popup-add-condition svg {
				display: inline-block;
				padding-right: 6px;
				width: 1em;
				height: 1em;
				stroke: none;
				max-width: none;
				position: relative;
				fill: currentColor;
				color: currentColor;
			}
		</style>
		<?php
	}

	public function slug() {
		return $this->post_type;
	}

}
