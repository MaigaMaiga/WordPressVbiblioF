<?php

class DTQ_Twitter_Feed_Carousel extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com/twitter-feed-carousel-module/',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->vb_support = 'on';
		$this->slug       = 'ba_twitter_feed_carousel';
		$this->name       = esc_html__( 'Torque Twitter Carousel', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'twitter-carousel.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'twitter_feed'      => esc_html__( 'Twitter Feed', 'addons-for-divi' ),
					'twitter_settings'  => esc_html__( 'Twitter Settings', 'addons-for-divi' ),
					'carousel_settings' => array(
						'title'             => esc_html__( 'Carousel Settings', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general'  => array(
								'name' => esc_html__( 'General', 'addons-for-divi' ),
							),
							'advanced' => array(
								'name' => esc_html__( 'Advanced', 'addons-for-divi' ),
							),
						),
					),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'tweets'      => esc_html__( 'Tweets Box', 'addons-for-divi' ),
					'user_avatar' => esc_html__( 'User Avatar', 'addons-for-divi' ),
					'user_text'   => array(
						'title'             => esc_html__( 'User Text', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'name'     => array(
								'name' => esc_html__( 'Name', 'addons-for-divi' ),
							),
							'username' => array(
								'name' => esc_html__( 'Username', 'addons-for-divi' ),
							),
						),
					),
					'content'     => array(
						'title'             => esc_html__( 'Content', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'description' => array(
								'name' => esc_html__( 'Description', 'addons-for-divi' ),
							),
							'read_more'   => array(
								'name' => esc_html__( 'Read More', 'addons-for-divi' ),
							),
							'date'        => array(
								'name' => esc_html__( 'Date', 'addons-for-divi' ),
							),
						),
					),
					'footer'      => esc_html__( 'Footer', 'addons-for-divi' ),
					'nav'         => array(
						'title'             => esc_html__( 'Navigation', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'nav_common' => array(
								'name' => esc_html( 'Common', 'addons-for-divi' ),
							),
							'nav_left'   => array(
								'name' => esc_html( 'Left', 'addons-for-divi' ),
							),
							'nav_right'  => array(
								'name' => esc_html( 'Right', 'addons-for-divi' ),
							),
						),
					),
					'pagi'        => array(
						'title'             => esc_html( 'Pagination', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'pagi_common' => array(
								'name' => esc_html( 'Common', 'addons-for-divi' ),
							),
							'pagi_active' => array(
								'name' => esc_html( 'Active', 'addons-for-divi' ),
							),
						),
					),
				),
			),
		);
	}

	public function get_fields() {

		$fields = array(
			// Twitter Feed.
			'user_name'           => array(
				'label'            => __( 'User Name', 'addons-for-divi' ),
				'type'             => 'text',
				'default'          => '@divipeople',
				'description'      => __( 'Use @ sign with your Twitter user name.', 'addons-for-divi' ),
				'toggle_slug'      => 'twitter_feed',
				'computed_affects' => array( '__twitterfeed' ),
			),
			'consumer_key'        => array(
				'label'            => __( 'Consumer Key', 'addons-for-divi' ),
				'type'             => 'text',
				'default'          => 'okjSlxMnSMCKTKlBVjPhg5R1v',
				'description'      => '<a href="https://apps.twitter.com/app/" target="_blank">Get Consumer Key.</a> Create a new app or select existing app and grab the consumer key.',
				'toggle_slug'      => 'twitter_feed',
				'computed_affects' => array( '__twitterfeed' ),
			),
			'consumer_secret'     => array(
				'label'            => __( 'Consumer Secret', 'addons-for-divi' ),
				'type'             => 'text',
				'default'          => '8GhKIROr4kT1byyCqiXsJkttS3BXqePOJlWN2TfKCVgenHMCeb',
				'description'      => '<a href="https://apps.twitter.com/app/" target="_blank">Get Consumer Secret key.</a> Create a new app or select existing app and grab the consumer secret.',
				'toggle_slug'      => 'twitter_feed',
				'computed_affects' => array( '__twitterfeed' ),
			),
			// Twitter Settings.
			'sort_by'             => array(
				'label'            => __( 'Sort By', 'addons-for-divi' ),
				'description'      => __( 'Choose how your feed should be sorted.', 'addons-for-divi' ),
				'type'             => 'select',
				'default'          => 'recent-posts',
				'options'          => array(
					'recent-posts'   => __( 'Recent Posts', 'addons-for-divi' ),
					'old-posts'      => __( 'Old Posts', 'addons-for-divi' ),
					'favorite_count' => __( 'Favorite', 'addons-for-divi' ),
					'retweet_count'  => __( 'Retweet', 'addons-for-divi' ),
				),
				'toggle_slug'      => 'twitter_settings',
				'computed_affects' => array( '__twitterfeed' ),
			),
			'tweets_limit'        => array(
				'label'            => __( 'Number of tweets to show', 'addons-for-divi' ),
				'description'      => __( 'Choose how much posts you would like to display per List.', 'addons-for-divi' ),
				'type'             => 'range',
				'default'          => '8',
				'unitless'         => true,
				'range_settings'   => array(
					'step' => 1,
					'min'  => 3,
					'max'  => 24,
				),
				'toggle_slug'      => 'twitter_settings',
				'computed_affects' => array( '__twitterfeed' ),
			),
			'show_twitter_icon'   => array(
				'label'            => __( 'Show Twitter Logo', 'addons-for-divi' ),
				'description'      => __( 'Here you can choose whether twitter logo should be displayed.', 'addons-for-divi' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => __( 'Yes', 'addons-for-divi' ),
					'off' => __( 'No', 'addons-for-divi' ),
				),
				'default'          => 'on',
				'toggle_slug'      => 'twitter_settings',
				'computed_affects' => array( '__twitterfeed' ),
			),
			'show_user_image'     => array(
				'label'            => __( 'Show User Image', 'addons-for-divi' ),
				'description'      => __( 'Here you can choose whether user image should be displayed.', 'addons-for-divi' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => __( 'Yes', 'addons-for-divi' ),
					'off' => __( 'No', 'addons-for-divi' ),
				),
				'default'          => 'on',
				'toggle_slug'      => 'twitter_settings',
				'computed_affects' => array( '__twitterfeed' ),
			),
			'show_name'           => array(
				'label'            => __( 'Show Name', 'addons-for-divi' ),
				'description'      => __( 'Here you can choose whether name should be displayed.', 'addons-for-divi' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => __( 'Yes', 'addons-for-divi' ),
					'off' => __( 'No', 'addons-for-divi' ),
				),
				'default'          => 'on',
				'toggle_slug'      => 'twitter_settings',
				'computed_affects' => array( '__twitterfeed' ),
			),
			'show_user_name'      => array(
				'label'            => __( 'Show User Name', 'addons-for-divi' ),
				'description'      => __( 'Here you can choose whether user name should be displayed.', 'addons-for-divi' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => __( 'Yes', 'addons-for-divi' ),
					'off' => __( 'No', 'addons-for-divi' ),
				),
				'default'          => 'off',
				'toggle_slug'      => 'twitter_settings',
				'computed_affects' => array( '__twitterfeed' ),
			),
			'show_date'           => array(
				'label'            => __( 'Show Date', 'addons-for-divi' ),
				'description'      => __( 'Here you can choose whether date should be displayed.', 'addons-for-divi' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => __( 'Yes', 'addons-for-divi' ),
					'off' => __( 'No', 'addons-for-divi' ),
				),
				'default'          => 'on',
				'toggle_slug'      => 'twitter_settings',
				'computed_affects' => array( '__twitterfeed' ),
			),
			'show_favorite'       => array(
				'label'            => __( 'Show Favorite', 'addons-for-divi' ),
				'description'      => __( 'Here you can choose whether favorite should be displayed.', 'addons-for-divi' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => __( 'Yes', 'addons-for-divi' ),
					'off' => __( 'No', 'addons-for-divi' ),
				),
				'default'          => 'on',
				'toggle_slug'      => 'twitter_settings',
				'computed_affects' => array( '__twitterfeed' ),
			),
			'show_retweet'        => array(
				'label'            => __( 'Show Retweet', 'addons-for-divi' ),
				'description'      => __( 'Here you can choose whether retweet should be displayed.', 'addons-for-divi' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => __( 'Yes', 'addons-for-divi' ),
					'off' => __( 'No', 'addons-for-divi' ),
				),
				'default'          => 'on',
				'toggle_slug'      => 'twitter_settings',
				'computed_affects' => array( '__twitterfeed' ),
			),
			'read_more'           => array(
				'label'            => __( ' Show Read More', 'addons-for-divi' ),
				'description'      => __( 'Here you can choose whether readmore should be displayed.', 'addons-for-divi' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => __( 'Yes', 'addons-for-divi' ),
					'off' => __( 'No', 'addons-for-divi' ),
				),
				'default'          => 'on',
				'toggle_slug'      => 'twitter_settings',
				'computed_affects' => array(
					'__twitterfeed',
				),
			),
			'read_more_text'      => array(
				'label'            => __( 'Read More Text', 'addons-for-divi' ),
				'description'      => __( 'Define your custom readmore text.', 'addons-for-divi' ),
				'type'             => 'text',
				'default'          => 'Read More',
				'description'      => __( 'Use @ sign with your Twitter user name.', 'addons-for-divi' ),
				'toggle_slug'      => 'twitter_settings',
				'show_if'          => array( 'read_more' => 'on' ),
				'computed_affects' => array(
					'__twitterfeed',
				),
			),
			// User Avatar.
			'avatar_position'     => array(
				'label'       => __( 'Avatar Position', 'addons-for-divi' ),
				'description' => __( 'Here you can define avatar position. By selecting absolute position avatar can be placed any where on the feed.', 'addons-for-divi' ),
				'type'        => 'select',
				'default'     => 'normal',
				'options'     => array(
					'normal'   => __( 'Normal', 'addons-for-divi' ),
					'absolute' => __( 'Absolute', 'addons-for-divi' ),
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'user_avatar',
			),
			'avatar_placement'    => array(
				'label'       => esc_html__( 'Avatar Placement', 'addons-for-divi' ),
				'description' => __( 'Here you can define avatar placement.', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'user_avatar',
				'default'     => 'top',
				'options'     => array(
					'top'    => esc_html__( 'Top', 'addons-for-divi' ),
					'bottom' => esc_html__( 'Bottom', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'avatar_position' => 'absolute',
				),
			),
			'avatar_offset_x'     => array(
				'label'          => esc_html__( 'Avatar Offset X', 'addons-for-divi' ),
				'description'    => __( 'Define avatar horizontal offset value.', 'addons-for-divi' ),
				'type'           => 'range',
				'unitless'       => true,
				'range_settings' => array(
					'min'  => -50,
					'max'  => 50,
					'step' => 1,
				),
				'show_if'        => array(
					'avatar_position' => 'absolute',
				),
				'toggle_slug'    => 'user_avatar',
				'tab_slug'       => 'advanced',
			),
			'avatar_size'         => array(
				'label'          => __( 'Profile Image Size', 'addons-for-divi' ),
				'description'    => __( 'Here you can define custom size for your avatar.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '50px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'user_avatar',
			),
			'avatar_spacing'      => array(
				'label'          => __( 'Avatar Spacing', 'addons-for-divi' ),
				'description'    => __( 'Define avatar spacing gap.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '15px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 200,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'user_avatar',
				'show_if'        => array(
					'avatar_position' => 'normal',
				),
			),
			// Tweets.
			'alignment'           => array(
				'label'            => __( 'Alignment', 'addons-for-divi' ),
				'description'      => __( 'Align content to the left, right or center.', 'addons-for-divi' ),
				'type'             => 'text_align',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'module_align',
				'default'          => 'left',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'tweets',
				'computed_affects' => array( '__feed' ),
			),
			'twitter_icon_size'   => array(
				'label'          => __( 'Twitter Icon Size', 'addons-for-divi' ),
				'description'    => __( 'Here you can define custom size for your twitter icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '20px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'tweets',
			),
			'content_padding'     => array(
				'label'          => __( 'Tweets Padding', 'addons-for-divi' ),
				'description'    => __( 'Here you can define custom padding for your tweets content.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'tweets',
				'default'        => '50px|50px|50px|50px',
				'mobile_options' => true,
			),
			// Description.
			'description_spacing' => array(
				'label'          => __( 'Bottom Spacing', 'addons-for-divi' ),
				'description'    => __( 'Here you can define a custom spacing at the bottom of the description text.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '25px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'mobile_options' => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'content',
				'sub_toggle'     => 'description',
			),
			// Footer.
			'footer_alignment'    => array(
				'label'       => esc_html__( 'Footer Alignment', 'addons-for-divi' ),
				'description' => __( 'Define footer content alignment from the list.', 'addons-for-divi' ),
				'type'        => 'select',
				'default'     => 'space-between',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'footer',
				'options'     => array(
					'flex-start'    => esc_html__( 'Left', 'addons-for-divi' ),
					'flex-end'      => esc_html__( 'Right', 'addons-for-divi' ),
					'center'        => esc_html__( 'Center', 'addons-for-divi' ),
					'space-around'  => esc_html__( 'Space Around', 'addons-for-divi' ),
					'space-between' => esc_html__( 'Space Between', 'addons-for-divi' ),
				),
			),
			'footer_padding'      => array(
				'label'          => __( 'Footer Padding', 'addons-for-divi' ),
				'description'    => __( 'Define custom padding for the footer content.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'footer',
				'default'        => '0px|50px|50px|50px',
				'mobile_options' => true,
			),
			'favorite_color'      => array(
				'label'       => __( 'Favorite Text Color', 'addons-for-divi' ),
				'description' => __( 'Here you can define custom color for favorite text.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'footer',

				'show_if'     => array( 'show_favorite' => 'on' ),
				'default'     => '#000000',
			),
			'favorite_font_size'  => array(
				'label'          => __( 'Favorite Text Size', 'addons-for-divi' ),
				'description'    => __( 'Here you can define custom size for favorite text.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '14px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'mobile_options' => true,
				'show_if'        => array( 'show_favorite' => 'on' ),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'footer',
			),
			'favorite_icon_color' => array(
				'label'       => __( 'Favorite Icon Color', 'addons-for-divi' ),
				'description' => __( 'Here you can define custom color for favorite icon.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'footer',

				'show_if'     => array( 'show_favorite' => 'on' ),
				'default'     => '#000000',
			),
			'favorite_icon_size'  => array(
				'label'          => __( 'Favorite Icon Size', 'addons-for-divi' ),
				'description'    => __( 'Here you can define custom size for favorite icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '14px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'mobile_options' => true,
				'show_if'        => array( 'show_favorite' => 'on' ),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'footer',
			),
			'retweet_color'       => array(
				'label'       => __( 'Retweet Text Color', 'addons-for-divi' ),
				'description' => __( 'Here you can define custom color for retweet text.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'footer',
				'show_if'     => array( 'show_retweet' => 'on' ),
				'default'     => '#000000',
			),
			'retweet_font_size'   => array(
				'label'          => __( 'Retweet Text Size', 'addons-for-divi' ),
				'description'    => __( 'Here you can define custom size for retweet text.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '14px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'mobile_options' => true,
				'tab_slug'       => 'advanced',
				'show_if'        => array( 'show_retweet' => 'on' ),
				'toggle_slug'    => 'footer',
			),
			'retweet_icon_color'  => array(
				'label'       => __( 'Retweet Icon Color', 'addons-for-divi' ),
				'description' => __( 'Here you can define custom color for retweet icon.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'footer',
				'show_if'     => array( 'show_retweet' => 'on' ),
				'default'     => '#000000',
			),
			'retweet_icon_size'   => array(
				'label'          => __( 'Retweet Icon Size', 'addons-for-divi' ),
				'description'    => __( 'Here you can define custom size for retweet icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '14px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'mobile_options' => true,
				'tab_slug'       => 'advanced',
				'show_if'        => array( 'show_retweet' => 'on' ),
				'toggle_slug'    => 'footer',
			),
			'__twitterfeed'       => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'DTQ_Twitter_Feed_Carousel', 'twitter_feed_render' ),
				'computed_depends_on' => array(
					'user_name',
					'consumer_key',
					'consumer_secret',
					'sort_by',
					'tweets_limit',
					'show_twitter_icon',
					'show_user_image',
					'show_name',
					'show_user_name',
					'show_date',
					'show_favorite',
					'show_retweet',
					'read_more',
					'read_more_text',
				),
				'computed_minimum'    => array(
					'user_name',
					'consumer_key',
					'consumer_secret',
				),
			),
		);

		$carousel_options = $this->get_carousel_option_fields( array( 'equal_height' ), array(), array() );

		$additional_options = $this->custom_background_fields(
			'tweets_item',
			__( 'Tweets', 'addons-for-divi' ),
			'advanced',
			'tweets',
			array( 'color', 'gradient', 'hover' ),
			array(),
			''
		);

		return array_merge( $carousel_options, $fields, $additional_options );
	}

	public function get_advanced_fields_config() {

		$advanced_fields = array();

		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['borders']['tweets'] = array(
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-twitter-feed-item-inner',
					'border_styles' => '%%order_class%% .dtq-twitter-feed-item-inner',
				),
				'important' => 'all',
			),
			'label_prefix' => esc_html__( 'Tweets Box', 'addons-for-divi' ),
			'defaults'     => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '1px',
					'color' => '#efefef',
					'style' => 'solid',
				),
			),
			'tab_slug'     => 'advanced',
			'toggle_slug'  => 'tweets',
		);

		$advanced_fields['borders']['avatar'] = array(
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-twitter-feed-avatar',
					'border_styles' => '%%order_class%% .dtq-twitter-feed-avatar',
				),
				'important' => 'all',
			),
			'label_prefix' => esc_html__( 'Avatar', 'addons-for-divi' ),
			'defaults'     => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
			'tab_slug'     => 'advanced',
			'toggle_slug'  => 'user_avatar',
		);

		$advanced_fields['box_shadow']['tweets'] = array(
			'label'       => esc_html__( 'Tweets Box Shadow', 'addons-for-divi' ),
			'css'         => array(
				'main'      => '%%order_class%% .dtq-twitter-feed-item-inner',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'tweets',
		);

		$advanced_fields['box_shadow']['avatar'] = array(
			'label'       => esc_html__( 'Avatar Box Shadow', 'addons-for-divi' ),
			'css'         => array(
				'main'      => '%%order_class%% .dtq-twitter-feed-avatar',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'user_avatar',
		);

		$advanced_fields['fonts']['name'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-twitter-feed-author-name',
				'important' => 'all',
			),
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '1',
				),
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'user_text',
			'sub_toggle'      => 'name',
		);

		$advanced_fields['fonts']['username'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-twitter-feed-username',
				'important' => 'all',
			),
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '1',
				),
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'user_text',
			'sub_toggle'      => 'username',
		);

		$advanced_fields['fonts']['description'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-twitter-feed-content p',
				'important' => 'all',
			),
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '1',
				),
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'content',
			'sub_toggle'      => 'description',
		);

		$advanced_fields['fonts']['readmore'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-twitter-feed-content p a',
				'important' => 'all',
			),
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '1',
				),
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'content',
			'sub_toggle'      => 'read_more',
		);

		$advanced_fields['fonts']['date'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-twitter-feed-date',
				'important' => 'all',
			),
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '1',
				),
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'content',
			'sub_toggle'      => 'date',
		);

		return $advanced_fields;
	}

	public static function twitter_feed_render( $args = array(), $conditional_tags = array(), $current_page = array() ) {

		$defaults = array(
			'user_name'         => '',
			'consumer_key'      => '',
			'consumer_secret'   => '',
			'sort_by'           => '',
			'tweets_limit'      => '',
			'show_twitter_icon' => '',
			'show_user_image'   => '',
			'show_name'         => '',
			'show_user_name'    => '',
			'show_date'         => '',
			'show_favorite'     => '',
			'show_retweet'      => '',
			'read_more'         => '',
			'read_more_text'    => '',
		);

		$args = wp_parse_args( $args, $defaults );

		$ba_tweets_token = '_ba_builder_tweet_token';
		$ba_tweets_cash  = '_ba_builder_tweet_cash';
		$user_name       = trim( $args['user_name'] );

		if ( empty( $user_name ) || empty( $args['consumer_key'] ) || empty( $args['consumer_secret'] ) ) {
			return;
		}

		$transient_key = $user_name . $ba_tweets_cash;
		$twitter_data  = get_transient( $transient_key );
		$credentials   = base64_encode( $args['consumer_key'] . ':' . $args['consumer_secret'] );

		$messages = array();
		if ( $twitter_data === false ) {

			$auth_url      = 'https://api.twitter.com/oauth2/token';
			$auth_response = wp_remote_post(
				$auth_url,
				array(
					'method'      => 'POST',
					'httpversion' => '1.1',
					'blocking'    => true,
					'headers'     => array(
						'Authorization' => 'Basic ' . $credentials,
						'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8',
					),
					'body'        => array(
						'grant_type' => 'client_credentials',
					),
				)
			);

			$body  = json_decode( wp_remote_retrieve_body( $auth_response ) );
			$token = $body->access_token;

			// Twitter Url
			$twitter_url     = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $user_name . '&count=999&tweet_mode=extended';
			$tweets_response = wp_remote_get(
				$twitter_url,
				array(
					'httpversion' => '1.1',
					'blocking'    => true,
					'headers'     => array( 'Authorization' => "Bearer $token" ),
				)
			);

			$twitter_data = json_decode( wp_remote_retrieve_body( $tweets_response ), true );
			set_transient( $user_name . $ba_tweets_cash, $twitter_data, 5 * MINUTE_IN_SECONDS );
		}

		if ( ! empty( $twitter_data ) && array_key_exists( 'errors', $twitter_data ) ) {
			foreach ( $twitter_data['errors'] as $error ) {
				$messages['error'] = $error['message'];
			}
		} elseif ( count( $twitter_data ) < $args['tweets_limit'] ) {
			$messages['item_limit'] = __( '"Number of Tweets to show" is more than your actual total Tweets\'s number. You have only ' . count( $twitter_data ) . ' Tweets', 'addons-for-divi' );

		}

		if ( ! empty( $messages ) ) {
			foreach ( $messages as $key => $message ) {
				$output = sprintf( '<div class="dtq-%2$s dtq-tweet-error-message">%1$s</div>', esc_html( $message ), esc_html( $key ) );
			}

			return $output;
		}

		switch ( $args['sort_by'] ) {

			case 'old-posts':
				usort(
					$twitter_data,
					function ( $a, $b ) {
						if ( strtotime( $a['created_at'] ) == strtotime( $b['created_at'] ) ) {
							return 0;
						}
						return ( strtotime( $a['created_at'] ) < strtotime( $b['created_at'] ) ? -1 : 1 );
					}
				);
				break;

			case 'favorite_count':
				usort(
					$twitter_data,
					function ( $a, $b ) {
						if ( $a['favorite_count'] == $b['favorite_count'] ) {
							return 0;
						}
						return ( $a['favorite_count'] > $b['favorite_count'] ) ? -1 : 1;
					}
				);
				break;

			case 'retweet_count':
				usort(
					$twitter_data,
					function ( $a, $b ) {
						if ( $a['retweet_count'] == $b['retweet_count'] ) {
							return 0;
						}
						return ( $a['retweet_count'] > $b['retweet_count'] ) ? -1 : 1;
					}
				);
				break;
			default:
				$twitter_data;

		}

		if ( ! empty( $args['tweets_limit'] ) && count( $twitter_data ) > $args['tweets_limit'] ) {
			$items = array_splice( $twitter_data, 0, $args['tweets_limit'] );
		}

		if ( empty( $args['tweets_limit'] ) ) {
			$items = $twitter_data;
		}

		ob_start();

		foreach ( $items as $item ) : ?>
			<div class = "dtq-twitter-feed-item">
			<div class = "dtq-twitter-has-shadow dtq-twitter-feed-item-inner">

					<?php if ( $args['show_twitter_icon'] == 'on' ) : ?>
						<div class = "dtq-twitter-feed-icon">
							<span>
								<svg  version="1.1" id="dtq-twitter" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space = "preserve">
								<path style="fill:#1da1f2;" d="M512,97.248c-19.04,8.352-39.328,13.888-60.48,16.576c21.76-12.992,38.368-33.408,46.176-58.016
									c-20.288,12.096-42.688,20.64-66.56,25.408C411.872,60.704,384.416,48,354.464,48c-58.112,0-104.896,47.168-104.896,104.992
									c0,8.32,0.704,16.32,2.432,23.936c-87.264-4.256-164.48-46.08-216.352-109.792c-9.056,15.712-14.368,33.696-14.368,53.056
									c0,36.352,18.72,68.576,46.624,87.232c-16.864-0.32-33.408-5.216-47.424-12.928c0,0.32,0,0.736,0,1.152
									c0,51.008,36.384,93.376,84.096,103.136c-8.544,2.336-17.856,3.456-27.52,3.456c-6.72,0-13.504-0.384-19.872-1.792
									c13.6,41.568,52.192,72.128,98.08,73.12c-35.712,27.936-81.056,44.768-130.144,44.768c-8.608,0-16.864-0.384-25.12-1.44
									C46.496,446.88,101.6,464,161.024,464c193.152,0,298.752-160,298.752-298.688c0-4.64-0.16-9.12-0.384-13.568
									C480.224,136.96,497.728,118.496,512,97.248z"/>
								</svg>
							</span>
						</div>
					<?php endif; ?>

					<div class = "dtq-twitter-feed-inner-wrapper">
					<div class = "dtq-twitter-feed-author">

							<?php if ( $args['show_user_image'] == 'on' ) : ?>

								<a class="dtq-twitter-feed-avatar-wrapper" href="<?php echo esc_url( 'https://twitter.com/' . $user_name ); ?>">
									<img
										src="<?php echo esc_url( $item['user']['profile_image_url_https'] ); ?>"
										alt="<?php echo esc_attr( $item['user']['name'] ); ?>"
										class="dtq-twitter-feed-avatar"
									>
								</a>

							<?php endif; ?>

							<div class = "dtq-twitter-feed-user">

								<?php if ( $args['show_name'] == 'on' ) : ?>
									<a href = "<?php echo esc_url( 'https://twitter.com/' . $user_name ); ?>" class = "dtq-twitter-feed-author-name">
										<?php echo esc_html( $item['user']['name'] ); ?>
									</a>
								<?php endif; ?>

								<?php if ( $args['show_user_name'] == 'on' ) : ?>
									<a href = "<?php echo esc_url( 'https://twitter.com/' . $user_name ); ?>" class = "dtq-twitter-feed-username">
										<?php echo esc_html( $args['user_name'] ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
						<div class = "dtq-twitter-feed-content">

							<?php
							if ( isset( $item['entities']['urls'][0] ) ) {
								$content = str_replace( $item['entities']['urls'][0]['url'], '', $item['full_text'] );
							} else {
								$content = $item['full_text'];
							}
							?>

							<div class = "dtq-inner-twitter-feed-content">
								<p>
									<?php echo esc_html( $content ); ?>
									<?php if ( $args['read_more'] == 'on' ) : ?>
										<a href = "<?php echo esc_url( '//twitter.com/' . $item['user']['screen_name'] . '/status/' . $item['id'] ); ?>" target = "_blank">
											<?php echo esc_html( $args['read_more_text'] ); ?>
										</a>
									<?php endif; ?>
								</p>
							</div>

							<?php if ( $args['show_date'] == 'on' ) : ?>
								<div class = "dtq-twitter-feed-date">
									<?php echo esc_html( date( 'M d Y', strtotime( $item['created_at'] ) ) ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<?php if ( $args['show_favorite'] == 'on' || $args['show_retweet'] == 'on' ) : ?>
						<div class = "dtq-twitter-feed-footer-wrapper">
						<div class = "dtq-twitter-feed-footer">
								<?php if ( $args['show_favorite'] == 'on' ) : ?>
									<div class = "dtq-tweet-favorite">
										<?php echo esc_html( $item['favorite_count'] ); ?>
										<span class = "et-pb-icon dtq-icon dtq-tweet-favorite-icon"></span>
									</div>
								<?php endif; ?>

								<?php if ( $args['show_retweet'] == 'on' ) : ?>
									<div class = "dtq-tweet-retweet">
										<?php echo esc_html( $item['retweet_count'] ); ?>
										<span class = "et-pb-icon dtq-icon dtq-tweet-retweet-icon"></span>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php

		endforeach;

		$output = ob_get_clean();

		if ( ! $output ) {
			$output = 'Something is wrong';
		}

		return $output;
	}

	public function render( $attrs, $content, $render_slug ) {

		wp_enqueue_script( 'dtqj-slick' );
		wp_enqueue_style( 'dtqc-slick' );
		$this->render_css( $render_slug );

		$user_name         = $this->props['user_name'];
		$consumer_key      = $this->props['consumer_key'];
		$consumer_secret   = $this->props['consumer_secret'];
		$sort_by           = $this->props['sort_by'];
		$tweets_limit      = $this->props['tweets_limit'];
		$show_twitter_icon = $this->props['show_twitter_icon'];
		$show_user_image   = $this->props['show_user_image'];
		$show_name         = $this->props['show_name'];
		$show_user_name    = $this->props['show_user_name'];
		$show_date         = $this->props['show_date'];
		$show_favorite     = $this->props['show_favorite'];
		$show_retweet      = $this->props['show_retweet'];
		$read_more         = $this->props['read_more'];
		$read_more_text    = $this->props['read_more_text'];
		$order_class       = self::get_module_order_class( $render_slug );
		$unique_number     = str_replace( '_', '', str_replace( $this->slug, '', $order_class ) );
		$ba_tweets_token   = '_' . $unique_number . '_ba_tweet_token';
		$ba_tweets_cash    = '_' . $unique_number . '_ba_tweet_cash';
		$user_name         = trim( $user_name );
		$alignment         = $this->props['alignment'];

		$is_equal_height  = $this->props['is_equal_height'];
		$is_center        = $this->props['is_center'];
		$center_mode_type = $this->props['center_mode_type'];
		$custom_cursor    = $this->props['custom_cursor'];

		if ( empty( $user_name ) || empty( $consumer_key ) || empty( $consumer_secret ) ) {
			return;
		}

		$transient_key = $user_name . $ba_tweets_cash;
		$twitter_data  = get_transient( $transient_key );
		$credentials   = base64_encode( $consumer_key . ':' . $consumer_secret );

		$messages = array();

		if ( $twitter_data === false ) {

			$auth_url = 'https://api.twitter.com/oauth2/token';

			$auth_response = wp_remote_post(
				$auth_url,
				array(
					'method'      => 'POST',
					'httpversion' => '1.1',
					'blocking'    => true,
					'headers'     => array(
						'Authorization' => 'Basic ' . $credentials,
						'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8',
					),
					'body'        => array(
						'grant_type' => 'client_credentials',
					),
				)
			);

			$body = json_decode( wp_remote_retrieve_body( $auth_response ) );

			$token = $body->access_token;

			// Twitter Url
			$twitter_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $user_name . '&count=999&tweet_mode=extended';

			$tweets_response = wp_remote_get(
				$twitter_url,
				array(
					'httpversion' => '1.1',
					'blocking'    => true,
					'headers'     => array( 'Authorization' => "Bearer $token" ),
				)
			);

			$twitter_data = json_decode( wp_remote_retrieve_body( $tweets_response ), true );
			set_transient( $user_name . $ba_tweets_cash, $twitter_data, 5 * MINUTE_IN_SECONDS );

		}

		if ( ! empty( $twitter_data ) && array_key_exists( 'errors', $twitter_data ) ) {

			foreach ( $twitter_data['errors'] as $error ) {
				$messages['error'] = $error['message'];
			}
		} elseif ( count( $twitter_data ) < $tweets_limit ) {

			$messages['item_limit'] = __( ' "Number of Tweets to show"  is more than your actual total Tweets\'s number. You have only ' . count( $twitter_data ) . ' Tweets', 'addons-for-divi' );

		}

		if ( ! empty( $messages ) ) {

			foreach ( $messages as $key => $message ) {
				$output = sprintf( '<div class="dtq-tweet-error-message">%1$s</div>', esc_html( $message ) );
			}
			return $output;
		}

		switch ( $sort_by ) {

			case 'old-posts':
				usort(
					$twitter_data,
					function ( $a, $b ) {
						if ( strtotime( $a['created_at'] ) == strtotime( $b['created_at'] ) ) {
							return 0;
						}
						return ( strtotime( $a['created_at'] ) < strtotime( $b['created_at'] ) ? -1 : 1 );
					}
				);
				break;

			case 'favorite_count':
				usort(
					$twitter_data,
					function ( $a, $b ) {
						if ( $a['favorite_count'] == $b['favorite_count'] ) {
							return 0;
						}
						return ( $a['favorite_count'] > $b['favorite_count'] ) ? -1 : 1;
					}
				);
				break;

			case 'retweet_count':
				usort(
					$twitter_data,
					function ( $a, $b ) {
						if ( $a['retweet_count'] == $b['retweet_count'] ) {
							return 0;
						}
						return ( $a['retweet_count'] > $b['retweet_count'] ) ? -1 : 1;
					}
				);
				break;

			default:
				$twitter_data;

		}

		if ( ! empty( $tweets_limit ) && count( $twitter_data ) > $tweets_limit ) {
			$items = array_splice( $twitter_data, 0, $tweets_limit );
		}

		if ( empty( $tweets_limit ) ) {
			$items = $twitter_data;
		}

		ob_start();

		foreach ( $items as $item ) :
			?>
			<div class = "dtq-twitter-feed-item">
			<div class = "dtq-twitter-feed-item-inner">

					<?php if ( $show_twitter_icon == 'on' ) : ?>
						<div class = "dtq-twitter-feed-icon">
							<span>
								<svg  version = "1.1" id            = "dtq-twitter" xmlns                           = "http://www.w3.org/2000/svg" xmlns:xlink = "http://www.w3.org/1999/xlink" x = "0px" y = "0px"
									  viewBox = "0 0 512 512" style = "enable-background:new 0 0 512 512;" xml:space = "preserve">
								<path style   = "fill:#1da1f2;" d   = "M512,97.248c-19.04,8.352-39.328,13.888-60.48,16.576c21.76-12.992,38.368-33.408,46.176-58.016
									c-20.288,12.096-42.688,20.64-66.56,25.408C411.872,60.704,384.416,48,354.464,48c-58.112,0-104.896,47.168-104.896,104.992
									c0,8.32,0.704,16.32,2.432,23.936c-87.264-4.256-164.48-46.08-216.352-109.792c-9.056,15.712-14.368,33.696-14.368,53.056
									c0,36.352,18.72,68.576,46.624,87.232c-16.864-0.32-33.408-5.216-47.424-12.928c0,0.32,0,0.736,0,1.152
									c0,51.008,36.384,93.376,84.096,103.136c-8.544,2.336-17.856,3.456-27.52,3.456c-6.72,0-13.504-0.384-19.872-1.792
									c13.6,41.568,52.192,72.128,98.08,73.12c-35.712,27.936-81.056,44.768-130.144,44.768c-8.608,0-16.864-0.384-25.12-1.44
									C46.496,446.88,101.6,464,161.024,464c193.152,0,298.752-160,298.752-298.688c0-4.64-0.16-9.12-0.384-13.568
									C480.224,136.96,497.728,118.496,512,97.248z"/>
								</svg>
							</span>
						</div>
					<?php endif; ?>

					<div class = "dtq-twitter-feed-inner-wrapper">
					<div class = "dtq-twitter-feed-author">

							<?php if ( $show_user_image == 'on' ) : ?>
								<a class = "dtq-twitter-feed-avatar-wrapper" href = "<?php echo esc_url( 'https://twitter.com/' . $user_name ); ?>">
									<img
										src   = "<?php echo esc_url( $item['user']['profile_image_url_https'] ); ?>"
										alt   = "<?php echo esc_attr( $item['user']['name'] ); ?>"
										class = "dtq-twitter-feed-avatar"
									>
								</a>
							<?php endif; ?>
							<div class = "dtq-twitter-feed-user">

								<?php if ( $show_name == 'on' ) : ?>
									<a href = "<?php echo esc_url( 'https://twitter.com/' . $user_name ); ?>" class = "dtq-twitter-feed-author-name">
										<?php echo esc_html( $item['user']['name'] ); ?>
									</a>
								<?php endif; ?>

								<?php if ( $show_user_name == 'on' ) : ?>
									<a href = "<?php echo esc_url( 'https://twitter.com/' . $user_name ); ?>" class = "dtq-twitter-feed-username">
										<?php echo esc_html( $user_name ); ?>
									</a>
								<?php endif; ?>

							</div>

						</div>

						<div class = "dtq-twitter-feed-content">

							<?php
							if ( isset( $item['entities']['urls'][0] ) ) {
								$content = str_replace( $item['entities']['urls'][0]['url'], '', $item['full_text'] );
							} else {
								$content = $item['full_text'];
							}
							?>

							<div class = "dtq-inner-twitter-feed-content">
								<p>
									<?php echo esc_html( $content ); ?>
									<?php if ( $read_more == 'on' ) : ?>
										<a href = "<?php echo esc_url( '//twitter.com/' . $item['user']['screen_name'] . '/status/' . $item['id'] ); ?>" target = "_blank">
											<?php echo esc_html( $read_more_text ); ?>
										</a>
									<?php endif; ?>
								</p>
							</div>

							<?php if ( $show_date == 'on' ) : ?>
								<div class = "dtq-twitter-feed-date">
									<?php echo esc_html( date( 'M d Y', strtotime( $item['created_at'] ) ) ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<?php if ( $show_favorite == 'on' || $show_retweet == 'on' ) : ?>
						<div class = "dtq-twitter-feed-footer-wrapper">
						<div class = "dtq-twitter-feed-footer">
								<?php if ( $show_favorite == 'on' ) : ?>
									<div class = "dtq-tweet-favorite">
										<?php echo esc_html( $item['favorite_count'] ); ?>
										<span class = "et-pb-icon dtq-icon dtq-tweet-favorite-icon"></span>
									</div>
								<?php endif; ?>

								<?php if ( $show_retweet == 'on' ) : ?>
									<div class = "dtq-tweet-retweet">
										<?php echo esc_html( $item['retweet_count'] ); ?>
										<span class = "et-pb-icon dtq-icon dtq-tweet-retweet-icon"></span>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>

				</div>
			</div>
			<?php
		endforeach;

		if ( ! $twitter_items = ob_get_clean() ) {
			$twitter_items = 'Something is wrong!';
		}

		// CSS Classes
		$classes = array();

		if ( $is_center === 'on' ) {
			array_push( $classes, 'dtq-centered' );
			array_push( $classes, "dtq-centered--{$center_mode_type}" );
		}

		if ( $custom_cursor === 'on' ) {
			array_push( $classes, 'dtq-cursor' );
		}

		array_push( $classes, "dtq-twitter-{$alignment}" );
		array_push( $classes, "equal-height-{$is_equal_height}" );

		$output = sprintf(
			'
            <div class = "dtq-carousel dtq-twitter-feed-carousel dtq-carousel-frontend %2$s" %3$s>
                %1$s
            </div>',
			$twitter_items,
			join( ' ', $classes ),
			$this->get_carousel_options_data()
		);

		return $output;
	}

	public function render_user_info_css( $render_slug ) {

		// Twitter icon
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-twitter-feed-icon span',
				'declaration' => sprintf( 'width: %1$s; height: %1$s;', $this->props['twitter_icon_size'] ),
			)
		);

		// User image size
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-twitter-feed-avatar',
				'declaration' => sprintf( 'width: %1$s; height: %1$s;', $this->props['avatar_size'] ),
			)
		);
	}

	public function render_footer_css( $render_slug ) {

		$favorite_color                   = $this->props['favorite_color'];
		$favorite_icon_color              = $this->props['favorite_icon_color'];
		$favorite_font_size               = $this->props['favorite_font_size'];
		$favorite_icon_size               = $this->props['favorite_icon_size'];
		$retweet_color                    = $this->props['retweet_color'];
		$retweet_icon_color               = $this->props['retweet_icon_color'];
		$retweet_font_size                = $this->props['retweet_font_size'];
		$retweet_icon_size                = $this->props['retweet_icon_size'];
		$footer_padding                   = $this->props['footer_padding'];
		$footer_padding_phone             = $this->props['footer_padding_phone'];
		$footer_padding_tablet            = $this->props['footer_padding_tablet'];
		$footer_padding_last_edited       = $this->props['footer_padding_last_edited'];
		$footer_padding_responsive_status = et_pb_get_responsive_status( $footer_padding_last_edited );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-tweet-favorite',
				'declaration' => sprintf( 'color: %1$s !important;', $favorite_color ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-tweet-favorite',
				'declaration' => sprintf( 'font-size: %1$s !important;', $favorite_font_size ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-tweet-favorite span',
				'declaration' => sprintf( 'color: %1$s !important;', $favorite_icon_color ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-tweet-favorite span',
				'declaration' => sprintf( 'font-size: %1$s !important;', $favorite_icon_size ),
			)
		);

		// Retweets
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-tweet-retweet',
				'declaration' => sprintf( 'color: %1$s !important;', $retweet_color ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-tweet-retweet span',
				'declaration' => sprintf( 'color: %1$s !important;', $retweet_icon_color ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-tweet-retweet',
				'declaration' => sprintf( 'font-size: %1$s !important;', $retweet_font_size ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-tweet-retweet span',
				'declaration' => sprintf( 'font-size: %1$s !important;', $retweet_icon_size ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-twitter-feed-footer-wrapper',
				'declaration' => $this->process_margin_padding( $footer_padding, 'padding', false ),
			)
		);

		// Tablet
		if ( $footer_padding_tablet && $footer_padding_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-twitter-feed-footer-wrapper',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => $this->process_margin_padding( $footer_padding_tablet, 'padding', false ),
				)
			);

		}

		if ( $footer_padding_phone && $footer_padding_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-twitter-feed-footer-wrapper',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => $this->process_margin_padding( $footer_padding_phone, 'padding', false ),
				)
			);
		}
	}

	public function render_content_css( $render_slug ) {

		$description_spacing                   = $this->props['description_spacing'];
		$description_spacing_tablet            = isset( $this->props['description_spacing_tablet'] ) ? $this->props['description_spacing_tablet'] : $description_spacing;
		$description_spacing_phone             = isset( $this->props['description_spacing_phone'] ) ? $this->props['description_spacing_phone'] : $description_spacing_tablet;
		$description_spacing_last_edited       = isset( $this->props['description_spacing_last_edited'] ) ? $this->props['description_spacing_last_edited'] : '';
		$description_spacing_responsive_status = et_pb_get_responsive_status( $description_spacing_last_edited );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-twitter-feed-content p',
				'declaration' => sprintf( 'margin-bottom: %1$s !important;', $description_spacing ),
			)
		);

		if ( $description_spacing_tablet && $description_spacing_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-twitter-feed-content p',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin-bottom: %1$s !important;', $description_spacing_tablet ),
				)
			);
		}

		if ( $description_spacing_phone && $description_spacing_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-twitter-feed-content p',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin-bottom: %1$s !important;', $description_spacing_phone ),
				)
			);
		}

		$content_padding                   = $this->props['content_padding'];
		$content_padding_phone             = $this->props['content_padding_phone'];
		$content_padding_tablet            = $this->props['content_padding_tablet'];
		$content_padding_last_edited       = $this->props['content_padding_last_edited'];
		$content_padding_responsive_status = et_pb_get_responsive_status( $content_padding_last_edited );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-twitter-feed-inner-wrapper',
				'declaration' => $this->process_margin_padding( $content_padding, 'padding', false ),
			)
		);

		// Tablet
		if ( $content_padding_tablet && $content_padding_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-twitter-feed-inner-wrapper',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => $this->process_margin_padding( $content_padding_tablet, 'padding', false ),
				)
			);

		}

		if ( $content_padding_phone && $content_padding_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-twitter-feed-inner-wrapper',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => $this->process_margin_padding( $content_padding_phone, 'padding', false ),
				)
			);
		}

	}

	public function render_css( $render_slug ) {

		$border_width_all_tweets = $this->props['border_width_all_tweets'];
		$border_color_all_tweets = $this->props['border_color_all_tweets'];
		$avatar_position         = $this->props['avatar_position'];
		$alignment               = $this->props['alignment'];
		$avatar_spacing          = $this->props['avatar_spacing'];
		$avatar_offset_x         = $this->props['avatar_offset_x'];
		$avatar_placement        = $this->props['avatar_placement'];

		$this->render_carousel_css( $render_slug );
		$this->render_content_css( $render_slug );
		$this->render_user_info_css( $render_slug );

		// Item background
		$tweets_item_background = $this->process_custom_background_fields( 'tweets_item', '' );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-twitter-feed-item-inner',
				'declaration' => $tweets_item_background,
			)
		);

		// Item background: hover
		$tweets_item_hover_background = $this->process_custom_background_fields( 'tweets_item', '__hover' );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-twitter-feed-item-inner:hover',
				'declaration' => $tweets_item_hover_background,
			)
		);

		// Avatar spacing
		if ( $avatar_position === 'normal' ) {
			if ( $alignment === 'center' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-twitter-feed-avatar-wrapper',
						'declaration' => sprintf( 'margin-bottom: %1$s;', $avatar_spacing ),
					)
				);
			} elseif ( $alignment === 'left' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-twitter-feed-avatar-wrapper',
						'declaration' => sprintf( 'margin-right: %1$s;', $avatar_spacing ),
					)
				);
			} elseif ( $alignment === 'right' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-twitter-feed-avatar-wrapper',
						'declaration' => sprintf( 'margin-left: %1$s;', $avatar_spacing ),
					)
				);
			}
		}

		// avatar position
		if ( $avatar_position === 'absolute' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-twitter-feed-avatar-wrapper',
					'declaration' => 'position: absolute; z-index: 99;',
				)
			);

			// Image offset X.
			$translate_x = '-50%';
			if ( empty( $avatar_offset_x ) ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-twitter-feed-avatar-wrapper',
						'declaration' => 'left: 50%;',
					)
				);
			} else {
				$translate_x     = '0';
				$avatar_offset_x = intval( $avatar_offset_x );

				if ( $avatar_offset_x < 0 ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-twitter-feed-avatar-wrapper',
							'declaration' => sprintf(
								'left: %1$s%%;',
								abs( 50 + $avatar_offset_x )
							),
						)
					);
				} else {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-twitter-feed-avatar-wrapper',
							'declaration' => sprintf(
								'right: %1$s%%;',
								50 - $avatar_offset_x
							),
						)
					);
				}
			}

			if ( 'top' === $avatar_placement ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-twitter-feed-avatar-wrapper',
						'declaration' => sprintf(
							'top: 0;
							transform : translateX(%1$s) translateY(-50%%);',
							$translate_x
						),
					)
				);
			} elseif ( 'bottom' === $avatar_placement ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-twitter-feed-avatar-wrapper',
						'declaration' => sprintf(
							'bottom: 0;
							transform : translateX(%1$s) translateY(50%%);',
							$translate_x
						),
					)
				);
			}
		}

		// footer css.
		$this->render_footer_css( $render_slug );

		// Footer Alignment.
		$footer_alignment = $this->props['footer_alignment'];
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-twitter-feed-footer',
				'declaration' => sprintf( 'display: flex; justify-content: %1$s;', $footer_alignment ),
			)
		);

		// Item Border.
		if ( empty( $border_color_all_tweets ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-twitter-feed-item-inner',
					'declaration' => 'border-color: #efefef;',
				)
			);
		}

		if ( empty( $border_width_all_tweets ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-twitter-feed-item-inner',
					'declaration' => 'border-width: 1px;',
				)
			);
		}
	}

}

new DTQ_Twitter_Feed_Carousel();
