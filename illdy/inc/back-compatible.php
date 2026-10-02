<?php
/**
 * One-time upgrade steps for settings saved by old versions of Illdy.
 *
 * These used to run on every request, front end included: a dozen theme mod reads,
 * a full get_custom_logo() render, and, until Illdy Companion had migrated them, a
 * query for every Jetpack testimonial. They now run once per theme version and per
 * active theme (a child theme keeps its own theme mods), recorded in the
 * illdy_migrated_version option. Each step is idempotent, so running them again
 * after an update is harmless.
 *
 * @package WordPress
 * @subpackage illdy
 */

if ( ! function_exists( 'illdy_migrate_legacy_settings' ) ) {
	/**
	 * Moves settings saved by Illdy 1.x to where current versions read them.
	 */
	function illdy_migrate_legacy_settings() {
		// The image logo became core's custom logo.
		$current_logo = get_theme_mod( 'illdy_img_logo', '' );
		if ( '' !== $current_logo && ! get_theme_mod( 'custom_logo' ) ) {
			$logo_id = attachment_url_to_postid( $current_logo );
			if ( $logo_id ) {
				set_theme_mod( 'custom_logo', $logo_id );
				remove_theme_mod( 'illdy_img_logo' );
			}
		}

		// Section order: eight numbered settings became one ordered list.
		$defaults = illdy_get_default_sections();
		$old_keys = array( 'first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth' );
		$new      = array();

		foreach ( $old_keys as $key ) {
			$position = (int) get_theme_mod( 'illdy_general_sections_order_' . $key . '_section' );
			$index    = $position - 1;

			if ( $position > 0 && isset( $defaults[ $index ] ) ) {
				$new[ $index ] = $defaults[ $index ];
				unset( $defaults[ $index ] );
			}
		}

		if ( ! empty( $new ) ) {
			set_theme_mod( 'illdy_frontpage_sections', array_values( array_merge( $new, $defaults ) ) );

			foreach ( $old_keys as $key ) {
				remove_theme_mod( 'illdy_general_sections_order_' . $key . '_section' );
			}
		}

		// The jumbotron title used to be three words.
		$words = array_filter(
			array(
				get_theme_mod( 'illdy_jumbotron_general_first_row_from_title' ),
				get_theme_mod( 'illdy_jumbotron_general_second_row_from_title' ),
				get_theme_mod( 'illdy_jumbotron_general_third_row_from_title' ),
			)
		);

		if ( $words ) {
			set_theme_mod( 'illdy_jumbotron_title', implode( '<span class="span-dot">.</span>', $words ) );
			remove_theme_mod( 'illdy_jumbotron_general_first_row_from_title' );
			remove_theme_mod( 'illdy_jumbotron_general_second_row_from_title' );
			remove_theme_mod( 'illdy_jumbotron_general_third_row_from_title' );
		}

		// Contact section titles were renamed.
		$renamed = array(
			'illdy_contact_us_title'                  => 'illdy_contact_us_general_title',
			'illdy_contact_us_address_title'          => 'illdy_contact_us_general_address_title',
			'illdy_contact_us_customer_support_title' => 'illdy_contact_us_general_customer_support_title',
		);

		foreach ( $renamed as $old => $current ) {
			$value = get_theme_mod( $old );
			if ( $value ) {
				set_theme_mod( $current, $value );
				remove_theme_mod( $old );
			}
		}

		// The colour scheme control once stored its label instead of its id.
		if ( 'Illdy' === get_theme_mod( 'illdy_color_scheme' ) ) {
			remove_theme_mod( 'illdy_color_scheme' );
		}
	}
}

if ( ! function_exists( 'illdy_migrate_jetpack_testimonials' ) ) {
	/**
	 * Copies Jetpack testimonials into Illdy Companion testimonial widgets.
	 *
	 * Needs the Companion's widget, so it waits until that is active rather than
	 * running with the other steps. It used to wait by re-running its query on
	 * every request for ever on sites that had no Jetpack testimonials to move;
	 * it now records that it ran either way.
	 */
	function illdy_migrate_jetpack_testimonials() {
		if ( get_theme_mod( 'illdy_testimonials_update' ) || ! class_exists( 'Illdy_Widget_Testimonial' ) ) {
			return;
		}

		$testimonials = get_posts(
			array(
				'post_type'      => 'jetpack-testimonial',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
			)
		);

		if ( $testimonials ) {
			$sidebars_widgets = get_option( 'sidebars_widgets' );
			$widgets          = get_option( 'widget_illdy_testimonial' );

			if ( ! is_array( $widgets ) ) {
				$widgets = array();
			}

			if ( ! is_array( $sidebars_widgets ) ) {
				$sidebars_widgets = array();
			}

			$numbers = array_filter( array_keys( $widgets ), 'is_int' );
			$key     = $numbers ? max( $numbers ) + 1 : 2;

			if ( ! isset( $sidebars_widgets['front-page-testimonials-sidebar'] ) || ! is_array( $sidebars_widgets['front-page-testimonials-sidebar'] ) ) {
				$sidebars_widgets['front-page-testimonials-sidebar'] = array();
			}

			foreach ( $testimonials as $testimonial ) {
				$widgets[ $key ] = array(
					'name'        => $testimonial->post_title,
					'image'       => get_the_post_thumbnail_url( $testimonial->ID, 'illdy-front-page-testimonials' ),
					'testimonial' => $testimonial->post_content,
				);

				$sidebars_widgets['front-page-testimonials-sidebar'][] = 'illdy_testimonial-' . $key;
				++$key;
			}

			update_option( 'widget_illdy_testimonial', $widgets );
			update_option( 'sidebars_widgets', $sidebars_widgets );
		}

		set_theme_mod( 'illdy_testimonials_update', true );
	}
}

if ( ! function_exists( 'illdy_run_migrations' ) ) {
	/**
	 * Runs the upgrade steps once per theme version and active theme.
	 */
	function illdy_run_migrations() {
		$done       = get_option( 'illdy_migrated_version', array() );
		$done       = is_array( $done ) ? $done : array();
		$stylesheet = get_stylesheet();

		if ( ! isset( $done[ $stylesheet ] ) || ILLDY_VERSION !== $done[ $stylesheet ] ) {
			illdy_migrate_legacy_settings();

			$done[ $stylesheet ] = ILLDY_VERSION;
			update_option( 'illdy_migrated_version', $done );
		}

		illdy_migrate_jetpack_testimonials();
	}
}

illdy_run_migrations();
