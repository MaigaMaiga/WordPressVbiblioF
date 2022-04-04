<?php

if ( ! class_exists( 'ET_Builder_Element' ) ) {
	return;
}

function ba_register_modules() {

	require_once plugin_dir_path( __FILE__ ) . 'modules/ModulesCore/ModulesCore.php';
	require_once plugin_dir_path( __FILE__ ) . 'modules/ModulesCore/BaBuilderModuleTypePostBased.php';
	require_once plugin_dir_path( __FILE__ ) . 'modules/ModulesCore/PostHelper.php';

	$inactive_modules = get_option( 'ba_inactive_modules', array() );

	if ( ! in_array( 'icon-box', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/IconBox/IconBox.php';
	}

	if ( ! in_array( 'cf7-module', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/Cf7Styler/Cf7Styler.php';
	}

	if ( ! in_array( 'advanced-divider', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/AdvancedDivider/AdvancedDivider.php';
	}

	if ( ! in_array( 'skill-bars', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/SkillBar/SkillBar.php';
		require_once plugin_dir_path( __FILE__ ) . 'modules/SkillBarChild/SkillBarChild.php';
	}

	if ( ! in_array( 'logo-grid', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/LogoGrid/LogoGrid.php';
		require_once plugin_dir_path( __FILE__ ) . 'modules/LogoGridChild/LogoGridChild.php';
	}

	if ( ! in_array( 'advanced-team', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/AdvancedTeam/AdvancedTeam.php';
	}

	if ( ! in_array( 'testimonial', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/Testimonial/Testimonial.php';
	}

	if ( ! in_array( 'card', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/Card/Card.php';
	}

	if ( ! in_array( 'dual-button', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/DualButton/DualButton.php';
	}

	if ( ! in_array( 'image-compare', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/ImageCompare/ImageCompare.php';
	}

	if ( ! in_array( 'image-carousel', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/ImageCarousel/ImageCarousel.php';
		require_once plugin_dir_path( __FILE__ ) . 'modules/ImageCarouselChild/ImageCarouselChild.php';
	}

	if ( ! in_array( 'logo-carousel', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/LogoCarousel/LogoCarousel.php';
		require_once plugin_dir_path( __FILE__ ) . 'modules/LogoCarouselChild/LogoCarouselChild.php';
	}

	if ( ! in_array( 'twitter-feed-carousel', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/TwitterFeedCarousel/TwitterFeedCarousel.php';
	}

	if ( ! in_array( 'twitter-feed', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/TwitterFeed/TwitterFeed.php';
	}

	if ( ! in_array( 'number', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/Number/Number.php';
	}

	if ( ! in_array( 'video-popup', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/VideoPopup/VideoPopup.php';
	}

	if ( ! in_array( 'info-box', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/InfoBox/InfoBox.php';
	}

	if ( ! in_array( 'scroll-image', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/ScrollImage/ScrollImage.php';
	}

	if ( ! in_array( 'news-ticker', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/NewsTicker/NewsTicker.php';
	}

	if ( ! in_array( 'post-list', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/PostList/PostList.php';
	}

	if ( ! in_array( 'review', $inactive_modules ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/Review/Review.php';
	}

	if ( ! in_array( 'flipbox', $inactive_modules, true ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/Flipbox/Flipbox.php';
	}

	if ( ! in_array( 'animated-text', $inactive_modules, true ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/AnimatedText/AnimatedText.php';
	}

	if ( ! in_array( 'business-hour', $inactive_modules, true ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/BusinessHour/BusinessHour.php';
		require_once plugin_dir_path( __FILE__ ) . 'modules/BusinessHourChild/BusinessHourChild.php';
	}

	if ( ! in_array( 'gradient-heading', $inactive_modules, true ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/GradientHeading/GradientHeading.php';
	}

	if ( ! in_array( 'alert', $inactive_modules, true ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'modules/Alert/Alert.php';
	}
}

// Kickoff.
ba_register_modules();
