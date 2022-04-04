<?php

defined( 'ABSPATH' ) || die();

function ba_is_cf7_activated() {
	return class_exists( '\WPCF7' );
}

function ba_get_cf7_forms() {
	$forms = array();

	if ( ba_is_cf7_activated() ) {
		$_forms = get_posts(
			array(
				'post_type'      => 'wpcf7_contact_form',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			)
		);

		if ( ! empty( $_forms ) ) {
			$forms = wp_list_pluck( $_forms, 'post_title', 'ID' );
		}
	}

	return $forms;
}

function ba_is_calderaforms_activated() {
	return class_exists( '\Caldera_Forms' );
}

function ba_get_caldera_form() {
	$forms = array();

	if ( ba_is_calderaforms_activated() ) {
		$_forms = \Caldera_Forms_Forms::get_forms( true, true );

		if ( ! empty( $_forms ) && ! is_wp_error( $_forms ) ) {
			foreach ( $_forms as $form ) {
				$forms[ $form['ID'] ] = $form['name'];
			}
		}
	}

	return $forms;
}

function ba_is_gravityforms_activated() {
	return class_exists( '\GFForms' );
}

function ba_get_gravity_forms() {
	$forms = array();

	if ( ba_is_gravityforms_activated() ) {
		$gravity_forms = \RGFormsModel::get_forms( null, 'title' );

		if ( ! empty( $gravity_forms ) && ! is_wp_error( $gravity_forms ) ) {
			foreach ( $gravity_forms as $gravity_form ) {
				$forms[ $gravity_form->id ] = $gravity_form->title;
			}
		}
	}

	return $forms;
}
