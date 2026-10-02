<?php
// Set Panel ID
$illdy_panel_id = 'illdy_panel_team';

// Set prefix
$illdy_prefix = 'illdy';

/***********************************************/
/********************** TEAM  ******************/
/***********************************************/
$wp_customize->add_section(
	$illdy_panel_id,
	array(
		'priority'    => illdy_get_section_position( $illdy_panel_id ),
		'capability'  => 'edit_theme_options',
		'title'       => __( 'Team Section', 'illdy' ),
		'description' => __( 'Control various options for team section from front page.', 'illdy' ),
		'panel'       => 'illdy_frontpage_panel',
	)
);


// Show this section
$wp_customize->add_setting(
	$illdy_prefix . '_team_general_show',
	array(
		'sanitize_callback' => $illdy_prefix . '_sanitize_checkbox',
		'default'           => 1,
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	$illdy_prefix . '_team_general_show',
	array(
		'type'     => 'checkbox',
		'label'    => __( 'Show this section?', 'illdy' ),
		'section'  => $illdy_panel_id,
		'priority' => 1,
	)
);

// Title
$wp_customize->add_setting(
	$illdy_prefix . '_team_general_title',
	array(
		'sanitize_callback' => 'illdy_sanitize_html',
		'default'           => __( 'Team', 'illdy' ),
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	$illdy_prefix . '_team_general_title',
	array(
		'label'       => __( 'Title', 'illdy' ),
		'description' => __( 'Add the title for this section.', 'illdy' ),
		'section'     => $illdy_panel_id,
		'priority'    => 2,
	)
);
$wp_customize->selective_refresh->add_partial(
	$illdy_prefix . '_team_general_title',
	array(
		'selector' => '#team .section-header h3',
	)
);

// Entry
if ( get_theme_mod( $illdy_prefix . '_team_general_entry' ) ) {

	$wp_customize->add_setting(
		$illdy_prefix . '_team_general_entry',
		array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Meet the people that are going to take your business to the next level.', 'illdy' ),
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Illdy_Control_Text_Editor(
			$wp_customize,
			$illdy_prefix . '_team_general_entry',
			array(
				'label'    => __( 'Entry', 'illdy' ),
				'section'  => $illdy_panel_id,
				'priority' => 3,
				'type'     => 'illdy-text-editor',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial(
		$illdy_prefix . '_team_general_entry',
		array(
			'selector' => '#team .section-header .section-description',
		)
	);

} elseif ( ! defined( 'ILLDY_COMPANION' ) ) {

	$wp_customize->add_setting(
		$illdy_prefix . '_team_entry_text',
		array(
			'sanitize_callback' => 'esc_html',
			'default'           => '',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Illdy_Text_Custom_Control(
			$wp_customize,
			$illdy_prefix . '_team_entry_text',
			array(
				'label'       => __( 'Install Illdy Companion', 'illdy' ),
				/* translators: %s: URL of the Recommended Plugins tab where Illdy Companion can be installed. */
				'description' => sprintf( __( 'In order to edit description please install <a href="%s" target="_blank">Illdy Companion</a>', 'illdy' ), illdy_get_recommended_actions_url() ),
				'section'     => $illdy_panel_id,
				'settings'    => $illdy_prefix . '_team_entry_text',
				'priority'    => 3,
			)
		)
	);
}

$wp_customize->add_setting(
	$illdy_prefix . '_team_widget_button',
	array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Illdy_Control_Button(
		$wp_customize,
		$illdy_prefix . '_team_widget_button',
		array(
			'text'       => __( 'Add & Edit Members', 'illdy' ),
			'section_id' => 'sidebar-widgets-front-page-team-sidebar',
			'icon'       => 'dashicons-plus',
			'section'    => $illdy_panel_id,
			'priority'   => 5,
		)
	)
);


$wp_customize->add_setting(
	$illdy_prefix . '_team_tab',
	array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Illdy_Control_Tab(
		$wp_customize,
		$illdy_prefix . '_team_tab',
		array(
			'type'    => 'illdy-tab',
			'section' => $illdy_panel_id,
			'buttons' => array(
				array(
					'name'   => __( 'Colors', 'illdy' ),
					'fields' => array(
						$illdy_prefix . '_team_title_color',
						$illdy_prefix . '_team_descriptions_color',
						$illdy_prefix . '_team_general_color',
					),
					'active' => true,
				),
				array(
					'name'   => __( 'Backgrounds', 'illdy' ),
					'fields' => array(
						$illdy_prefix . '_team_general_image',
						$illdy_prefix . '_team_background_size',
						$illdy_prefix . '_team_background_repeat',
						$illdy_prefix . '_team_background_attachment',
						$illdy_prefix . '_team_background_position',
					),
				),
			),
		)
	)
);

// Background Image
$wp_customize->add_setting(
	$illdy_prefix . '_team_general_image',
	array(
		'sanitize_callback' => 'esc_url',
		'default'           => esc_url( get_template_directory_uri() . '/layout/images/front-page/pattern.png' ),
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		$illdy_prefix . '_team_general_image',
		array(
			'label'    => __( 'Background Image', 'illdy' ),
			'section'  => $illdy_panel_id,
			'settings' => $illdy_prefix . '_team_general_image',
		)
	)
);
$wp_customize->add_setting(
	$illdy_prefix . '_team_background_position_x',
	array(
		'default'           => 'center',
		'sanitize_callback' => 'esc_html',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	$illdy_prefix . '_team_background_position_y',
	array(
		'default'           => 'center',
		'sanitize_callback' => 'esc_html',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Background_Position_Control(
		$wp_customize,
		$illdy_prefix . '_team_background_position',
		array(
			'label'    => __( 'Background Position', 'illdy' ),
			'section'  => $illdy_panel_id,
			'settings' => array(
				'x' => $illdy_prefix . '_team_background_position_x',
				'y' => $illdy_prefix . '_team_background_position_y',
			),
		)
	)
);
$wp_customize->add_setting(
	$illdy_prefix . '_team_background_size',
	array(
		'default'           => 'auto',
		'sanitize_callback' => 'illdy_sanitize_background_size',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	$illdy_prefix . '_team_background_size',
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
	$illdy_prefix . '_team_background_repeat',
	array(
		'sanitize_callback' => $illdy_prefix . '_sanitize_checkbox',
		'default'           => 1,
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	$illdy_prefix . '_team_background_repeat',
	array(
		'type'    => 'checkbox',
		'label'   => __( 'Repeat Background Image', 'illdy' ),
		'section' => $illdy_panel_id,
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_team_background_attachment',
	array(
		'sanitize_callback' => $illdy_prefix . '_sanitize_checkbox',
		'default'           => 1,
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	$illdy_prefix . '_team_background_attachment',
	array(
		'type'    => 'checkbox',
		'label'   => __( 'Fixed background (it stays put while the page scrolls)', 'illdy' ),
		'section' => $illdy_panel_id,
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_team_general_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#fff',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_team_general_color',
		array(
			'label'    => __( 'Background Color', 'illdy' ),
			'section'  => $illdy_panel_id,
			'settings' => $illdy_prefix . '_team_general_color',
		)
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_team_title_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#545454',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_team_title_color',
		array(
			'label'    => __( 'Title Color', 'illdy' ),
			'section'  => $illdy_panel_id,
			'settings' => $illdy_prefix . '_team_title_color',
		)
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_team_descriptions_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#6b7375',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_team_descriptions_color',
		array(
			'label'    => __( 'Description Color', 'illdy' ),
			'section'  => $illdy_panel_id,
			'settings' => $illdy_prefix . '_team_descriptions_color',
		)
	)
);
