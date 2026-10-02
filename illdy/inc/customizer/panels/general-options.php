<?php
// Set Panel ID
$illdy_panel_id = 'illdy_panel_general';

// Set prefix
$illdy_prefix = 'illdy';

// Change panel for Static Front Page
$illdy_site_title        = $wp_customize->get_section( 'static_front_page' );
$illdy_site_title->panel = $illdy_panel_id;

// Change Logo section
$illdy_site_logo              = $wp_customize->get_control( 'custom_logo' );
$illdy_site_logo->description = __( 'The site logo is used as a graphical representation of your company name.', 'illdy' );
$illdy_site_logo->label       = __( 'Site logo', 'illdy' );
$illdy_site_logo->section     = $illdy_prefix . '_general_logo_section';
$illdy_site_logo->priority    = 1;

// Change site icon section
$illdy_site_icon           = $wp_customize->get_control( 'site_icon' );
$illdy_site_icon->section  = $illdy_prefix . '_general_logo_section';
$illdy_site_icon->priority = 2;

/***********************************************/
/************** GENERAL OPTIONS  ***************/
/***********************************************/

$wp_customize->add_panel(
	$illdy_panel_id,
	array(
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'General Options', 'illdy' ),
		'description'    => __( 'You can change the site layout in this area as well as your contact details (the ones displayed in the header & footer) ', 'illdy' ),
	)
);

/***********************************************/
/******************* Header  *******************/
/***********************************************/

$wp_customize->add_section(
	$illdy_prefix . '_header_section',
	array(
		'title'    => __( 'Header', 'illdy' ),
		'priority' => 1,
		'panel'    => $illdy_panel_id,
	)
);

// Enable sticky header
$wp_customize->add_setting(
	$illdy_prefix . '_sticky_header_enable',
	array(
		'sanitize_callback' => $illdy_prefix . '_value_checkbox_helper',
		'default'           => 0,
	)
);
$wp_customize->add_control(
	$illdy_prefix . '_sticky_header_enable',
	array(
		'type'     => 'checkbox',
		'label'    => __( 'Enable the sticky header', 'illdy' ),
		'section'  => $illdy_prefix . '_header_section',
		'priority' => 1,
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_sticky_header_background_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#000',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_sticky_header_background_color',
		array(
			'label'           => __( 'Sticky header background color', 'illdy' ),
			'description'     => __( 'Controls the background color for header when this is sticky', 'illdy' ),
			'section'         => $illdy_prefix . '_header_section',
			'settings'        => $illdy_prefix . '_sticky_header_background_color',
			'priority'        => 2,
			'active_callback' => 'illdy_is_sticky_header',
		)
	)
);

// Featured image in header
$wp_customize->add_setting(
	$illdy_prefix . '_jumbotron_enable_featured_image',
	array(
		'sanitize_callback' => $illdy_prefix . '_sanitize_checkbox',
		'default'           => 0,
	)
);

$wp_customize->add_control(
	$illdy_prefix . '_jumbotron_enable_featured_image',
	array(
		'type'        => 'checkbox',
		'label'       => __( 'Enable featured image as header image', 'illdy' ),
		'description' => __( 'This will remove the featured image from inside the post content and use it in the jumbotron as a background image. Works for single posts & pages.', 'illdy' ),
		'section'     => $illdy_prefix . '_header_section',
	)
);

/***********************************************/
/****************** Preloader  *****************/
/***********************************************/

$wp_customize->add_section(
	$illdy_prefix . '_preloader_section',
	array(
		'title'    => __( 'Preloader', 'illdy' ),
		'priority' => 2,
		'panel'    => $illdy_panel_id,
	)
);

// Enable the preloader?
$wp_customize->add_setting(
	$illdy_prefix . '_preloader_enable',
	array(
		'sanitize_callback' => $illdy_prefix . '_value_checkbox_helper',
		'default'           => 1,
	)
);
$wp_customize->add_control(
	$illdy_prefix . '_preloader_enable',
	array(
		'type'     => 'checkbox',
		'label'    => __( 'Enable the site preloader', 'illdy' ),
		'section'  => $illdy_prefix . '_preloader_section',
		'priority' => 1,
	)
);

// Background Color
$wp_customize->add_setting(
	$illdy_prefix . '_preloader_background_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#ffffff',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_preloader_background_color',
		array(
			'label'       => __( 'Preloader background color', 'illdy' ),
			'description' => __( 'Controls the background color for the container the preloader is displayed on', 'illdy' ),
			'section'     => $illdy_prefix . '_preloader_section',
			'settings'    => $illdy_prefix . '_preloader_background_color',
			'priority'    => 2,
		)
	)
);

// Primary Color
$wp_customize->add_setting(
	$illdy_prefix . '_preloader_primary_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#f1d204',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_preloader_primary_color',
		array(
			'label'       => __( 'Preloader primary color', 'illdy' ),
			'description' => __( 'Controls the color of the loading bar & of the percentage.', 'illdy' ),
			'section'     => $illdy_prefix . '_preloader_section',
			'settings'    => $illdy_prefix . '_preloader_primary_color',
			'priority'    => 3,
		)
	)
);

// Secondly Color
$wp_customize->add_setting(
	$illdy_prefix . '_preloader_secondly_color',
	array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#ffffff',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		$illdy_prefix . '_preloader_secondly_color',
		array(
			'label'       => __( 'Preloader secondary color', 'illdy' ),
			'description' => __( 'Controls the color outline of the preloader (the border)', 'illdy' ),
			'section'     => $illdy_prefix . '_preloader_section',
			'settings'    => $illdy_prefix . '_preloader_secondly_color',
			'priority'    => 4,
		)
	)
);

/***********************************************/
/*********** Logo section  ************/
/***********************************************/

$wp_customize->add_section(
	$illdy_prefix . '_general_logo_section',
	array(
		'title'    => __( 'Logo', 'illdy' ),
		'priority' => 3,
		'panel'    => $illdy_panel_id,
	)
);

/***********************************************/
/*********** General Site Settings  ************/
/***********************************************/
$wp_customize->selective_refresh->add_partial(
	'custom_logo',
	array(
		'selector'        => '#header .top-header .col-sm-4 > a',
		'render_callback' => $illdy_prefix . '_custom_logo',
	)
);

/* Logo Width */
$wp_customize->add_setting(
	$illdy_prefix . '_logo_width',
	array(
		'sanitize_callback' => 'absint',
		'validate_callback' => 'illdy_validate_logo_width',
		'default'           => 150,
	)
);

$wp_customize->add_control(
	$illdy_prefix . '_logo_width',
	array(
		'label'       => __( 'Logo Width', 'illdy' ),
		'description' => __( 'Site logo width (in pixels)', 'illdy' ),
		'section'     => $illdy_prefix . '_general_logo_section',
		'type'        => 'number',
		'priority'    => 1,
	)
);


/* Company text logo */
$wp_customize->add_setting(
	$illdy_prefix . '_text_logo',
	array(
		'sanitize_callback' => 'illdy_sanitize_html',
		'default'           => __( 'Illdy', 'illdy' ),
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	$illdy_prefix . '_text_logo',
	array(
		'label'       => __( 'Text logo (company name)', 'illdy' ),
		'description' => __( 'This field is best used when you don\'t have an image logo or simply prefer using a text as your logo / company name.', 'illdy' ),
		'section'     => $illdy_prefix . '_general_logo_section',
		'priority'    => 2,
	)
);

/***********************************************/
/************** 404 Customization  ***************/
/***********************************************/
$wp_customize->add_section(
	$illdy_prefix . '_404',
	array(
		'title'       => __( '404 Page', 'illdy' ),
		'description' => __( 'From this section, you\'ll be able to alter texts from 404 page', 'illdy' ),
		'priority'    => 4,
		'panel'       => $illdy_panel_id,
	)
);
$wp_customize->add_setting(
	$illdy_prefix . '_404_title',
	array(
		'sanitize_callback' => 'wp_kses_post',
		'default'           => __( 'Page not found', 'illdy' ),
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	$illdy_prefix . '_404_title',
	array(
		'label'    => __( '404 Page Title', 'illdy' ),
		'section'  => $illdy_prefix . '_404',
		'priority' => 1,
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_404_subtitle',
	array(
		'sanitize_callback' => 'wp_kses_post',
		'default'           => __( 'OOOPS!', 'illdy' ),
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	$illdy_prefix . '_404_subtitle',
	array(
		'label'    => __( '404 Page Subtitle', 'illdy' ),
		'section'  => $illdy_prefix . '_404',
		'priority' => 2,
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_404_content',
	array(
		'sanitize_callback' => 'wp_kses_post',
		'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec aliquet lorem ac orci dictum sodales et eget orci. Vestibulum a laoreet dolor. Sed finibus vulputate nisl, at pulvinar nisi commodo ac. Proin placerat auctor libero. Phasellus nec suscipit mi, sed faucibus purus.', 'illdy' ),
		'transport'         => 'refresh',
	)
);
$wp_customize->add_control(
	new Illdy_Control_Text_Editor(
		$wp_customize,
		$illdy_prefix . '_404_content',
		array(
			'type'     => 'illdy-text-editor',
			'label'    => __( '404 Page Entry', 'illdy' ),
			'section'  => $illdy_prefix . '_404',
			'priority' => 3,
		)
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_404_button_label',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => __( 'Home', 'illdy' ),
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	$illdy_prefix . '_404_button_label',
	array(
		'label'    => __( '404 Page Button Label', 'illdy' ),
		'section'  => $illdy_prefix . '_404',
		'priority' => 4,
	)
);

/***********************************************/
/************** Footer Details  ***************/
/***********************************************/
$wp_customize->add_section(
	$illdy_prefix . '_general_footer_section',
	array(
		'title'       => __( 'Footer', 'illdy' ),
		'description' => __( 'From this section, you\'ll be able to alter the footer settings. Manage your copyright message as well as the logo shown in the footer of the theme.', 'illdy' ),
		'priority'    => 5,
		'panel'       => $illdy_panel_id,
	)
);

/* Footer Copyright */

$wp_customize->add_setting(
	$illdy_prefix . '_footer_copyright',
	array(
		'sanitize_callback'       => 'illdy_sanitize_html',
		/* translators: %s: the current year. */
						'default' => sprintf( __( '&copy; Copyright %s. All Rights Reserved.', 'illdy' ), '{year}' ),
		'transport'               => 'postMessage',
	)
);

$wp_customize->add_control(
	$illdy_prefix . '_footer_copyright',
	array(
		'label'       => __( 'Footer Copyright', 'illdy' ),
		'description' => __( 'Use this to display your company copyright message. {year} shows the current year.', 'illdy' ),
		'section'     => $illdy_prefix . '_general_footer_section',
		'priority'    => 2,
	)
);


$wp_customize->add_setting(
	$illdy_prefix . '_go_to_top',
	array(
		'sanitize_callback' => $illdy_prefix . '_value_checkbox_helper',
		'default'           => 0,
	)
);
$wp_customize->add_control(
	$illdy_prefix . '_go_to_top',
	array(
		'type'     => 'checkbox',
		'label'    => __( 'Enable the go to top icon', 'illdy' ),
		'section'  => $illdy_prefix . '_general_footer_section',
		'priority' => 3,
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_show_footer',
	array(
		'sanitize_callback' => $illdy_prefix . '_value_checkbox_helper',
		'default'           => 1,
	)
);
$wp_customize->add_control(
	$illdy_prefix . '_show_footer',
	array(
		'type'     => 'checkbox',
		'label'    => __( 'Show footer widget area?', 'illdy' ),
		'section'  => $illdy_prefix . '_general_footer_section',
		'priority' => 4,
	)
);

$wp_customize->add_setting(
	$illdy_prefix . '_show_footer_copyright',
	array(
		'sanitize_callback' => $illdy_prefix . '_value_checkbox_helper',
		'default'           => 1,
	)
);
$wp_customize->add_control(
	$illdy_prefix . '_show_footer_copyright',
	array(
		'type'     => 'checkbox',
		'label'    => __( 'Show footer copyright area?', 'illdy' ),
		'section'  => $illdy_prefix . '_general_footer_section',
		'priority' => 4,
	)
);
