<?php
// Set prefix
$illdy_prefix   = 'illdy';
$illdy_panel_id = $illdy_prefix . '_testimonials_general';

/***********************************************/
/******************* General *******************/
/***********************************************/
$wp_customize->add_section(
	$illdy_prefix . '_testimonials_general',
	array(
		'title'       => __( 'Testimonials Section', 'illdy' ),
		'description' => __( 'Control various options for testimonials section from front page.', 'illdy' ),
		'priority'    => illdy_get_section_position( $illdy_prefix . '_testimonials_general' ),
		'panel'       => 'illdy_frontpage_panel',
	)
);

// Show this section
$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_general_show',
	array(
		'sanitize_callback' => $illdy_prefix . '_sanitize_checkbox',
		'default'           => 1,
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	$illdy_prefix . '_testimonials_general_show',
	array(
		'type'     => 'checkbox',
		'label'    => __( 'Show this section?', 'illdy' ),
		'section'  => $illdy_prefix . '_testimonials_general',
		'priority' => 1,
	)
);

// Title
$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_general_title',
	array(
		'sanitize_callback' => 'illdy_sanitize_html',
		'default'           => __( 'Testimonials', 'illdy' ),
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	$illdy_prefix . '_testimonials_general_title',
	array(
		'label'       => __( 'Title', 'illdy' ),
		'description' => __( 'Add the title for this section.', 'illdy' ),
		'section'     => $illdy_prefix . '_testimonials_general',
		'priority'    => 2,
	)
);
$wp_customize->selective_refresh->add_partial(
	$illdy_prefix . '_testimonials_general_title',
	array(
		'selector' => '#testimonials .section-header h3',
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_testimonial_widget_button',
	array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Illdy_Control_Button(
		$wp_customize,
		$illdy_prefix . '_testimonial_widget_button',
		array(
			'text'       => __( 'Add & Edit Testimonials', 'illdy' ),
			'section_id' => 'sidebar-widgets-front-page-testimonials-sidebar',
			'icon'       => 'dashicons-plus',
			'section'    => $illdy_panel_id,
			'priority'   => 5,
		)
	)
);


$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_tab',
	array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Illdy_Control_Tab(
		$wp_customize,
		$illdy_prefix . '_testimonials_tab',
		array(
			'type'    => 'illdy-tab',
			'section' => $illdy_panel_id,
			'buttons' => array(
				array(
					'name'   => __( 'Colors', 'illdy' ),
					'fields' => array(
						$illdy_prefix . '_testimonials_title_color',
						$illdy_prefix . '_testimonials_dots_color',
						$illdy_prefix . '_testimonials_general_color',
						$illdy_prefix . '_testimonials_author_text_color',
						$illdy_prefix . '_testimonials_text_color',
						$illdy_prefix . '_testimonials_container_background_color',
					),
					'active' => true,
				),
				array(
					'name'   => __( 'Backgrounds', 'illdy' ),
					'fields' => array(
						$illdy_prefix . '_testimonials_general_background_image',
						$illdy_prefix . '_testimonials_background_size',
						$illdy_prefix . '_testimonials_background_repeat',
						$illdy_prefix . '_testimonials_background_attachment',
						$illdy_prefix . '_testimonials_background_position',
					),
				),
			),
		)
	)
);

// Background Image
$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_general_background_image',
	array(
		'sanitize_callback' => 'esc_url',
		'default'           => esc_url( get_template_directory_uri() . '/layout/images/testiomnials-background.jpg' ),
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		$illdy_prefix . '_testimonials_general_background_image',
		array(
			'label'    => __( 'Background Image', 'illdy' ),
			'section'  => $illdy_panel_id,
			'settings' => $illdy_prefix . '_testimonials_general_background_image',
		)
	)
);
$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_background_position_x',
	array(
		'default'           => 'center',
		'sanitize_callback' => 'esc_html',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_background_position_y',
	array(
		'default'           => 'center',
		'sanitize_callback' => 'esc_html',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Background_Position_Control(
		$wp_customize,
		$illdy_prefix . '_testimonials_background_position',
		array(
			'label'    => __( 'Background Position', 'illdy' ),
			'section'  => $illdy_prefix . '_testimonials_general',
			'settings' => array(
				'x' => $illdy_prefix . '_testimonials_background_position_x',
				'y' => $illdy_prefix . '_testimonials_background_position_y',
			),
		)
	)
);
$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_background_size',
	array(
		'default'           => 'cover',
		'sanitize_callback' => 'illdy_sanitize_background_size',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	$illdy_prefix . '_testimonials_background_size',
	array(
		'label'   => __( 'Image Size', 'illdy' ),
		'section' => $illdy_panel_id,
		'type'    => 'select',
		'choices' => array(
			'auto'    => __( 'Original', 'illdy' ),
			'contain' => __( 'Fit to Screen', 'illdy' ),
			'cover'   => __( 'Fill Screen', 'illdy' ),
		),
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_background_repeat',
	array(
		'sanitize_callback' => $illdy_prefix . '_sanitize_checkbox',
		'default'           => 0,
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	$illdy_prefix . '_testimonials_background_repeat',
	array(
		'type'    => 'checkbox',
		'label'   => __( 'Repeat Background Image', 'illdy' ),
		'section' => $illdy_panel_id,
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_background_attachment',
	array(
		'sanitize_callback' => $illdy_prefix . '_sanitize_checkbox',
		// The front end has always treated an unsaved value as off (scrolling).
		'default'           => 0,
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	$illdy_prefix . '_testimonials_background_attachment',
	array(
		'type'    => 'checkbox',
		'label'   => __( 'Fixed background (it stays put while the page scrolls)', 'illdy' ),
		'section' => $illdy_panel_id,
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_general_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#fff',
		'transport'         => 'postMessage',

	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_testimonials_general_color',
		array(
			'label'    => __( 'Background Color', 'illdy' ),
			'section'  => $illdy_panel_id,
			'settings' => $illdy_prefix . '_testimonials_general_color',
		)
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_title_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#fff',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_testimonials_title_color',
		array(
			'label'    => __( 'Title Color', 'illdy' ),
			'section'  => $illdy_panel_id,
			'settings' => $illdy_prefix . '_testimonials_title_color',
		)
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_container_background_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#6a4d8a',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_testimonials_container_background_color',
		array(
			'label'    => __( 'Testimonial Container Color', 'illdy' ),
			'section'  => $illdy_panel_id,
			'settings' => $illdy_prefix . '_testimonials_container_background_color',
		)
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_text_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#fff',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_testimonials_text_color',
		array(
			'label'    => __( 'Testimonial Content Color', 'illdy' ),
			'section'  => $illdy_panel_id,
			'settings' => $illdy_prefix . '_testimonials_text_color',
		)
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_author_text_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#fff',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_testimonials_author_text_color',
		array(
			'label'    => __( 'Testimonial Author Text Color', 'illdy' ),
			'section'  => $illdy_panel_id,
			'settings' => $illdy_prefix . '_testimonials_author_text_color',
		)
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_testimonials_dots_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#fff',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_testimonials_dots_color',
		array(
			'label'    => __( 'Testimonial Dots Color', 'illdy' ),
			'section'  => $illdy_panel_id,
			'settings' => $illdy_prefix . '_testimonials_dots_color',
		)
	)
);
