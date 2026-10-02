<?php
/**
 *    The template for displaying the header.
 *
 * @package    WordPress
 * @subpackage illdy
 */
?>
<?php
$illdy_logo_id                   = get_theme_mod( 'custom_logo' );
$illdy_logo_image                = wp_get_attachment_image_src( $illdy_logo_id, 'full' );
$illdy_logo_width                = get_theme_mod( 'illdy_logo_width', 150 ); // The Customizer's default; unset, the logo rendered at full size.
$illdy_text_logo                 = get_theme_mod( 'illdy_text_logo', __( 'Illdy', 'illdy' ) );
$illdy_jumbotron_general_image   = get_theme_mod( 'illdy_jumbotron_general_image', esc_url( get_template_directory_uri() . '/layout/images/front-page/front-page-header.jpg' ) );
$illdy_jumbotron_type            = get_theme_mod( 'illdy_jumbotron_background_type', 'image' );
$illdy_jumbotron_single_image    = get_theme_mod( 'illdy_jumbotron_enable_featured_image', false );
$illdy_jumbotron_parallax_enable = get_theme_mod( 'illdy_jumbotron_enable_parallax_effect', true );
$illdy_preloader_enable          = get_theme_mod( 'illdy_preloader_enable', 1 );
$illdy_user_agent                = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '';
$illdy_is_mobile_safari          = '' !== $illdy_user_agent && preg_match( '/(iPod|iPhone|iPad)/', $illdy_user_agent );
// Falls back to the shipped default when the stored value is not a valid hex colour.
$illdy_accent_color = sanitize_hex_color( get_theme_mod( 'epsilon_accent_color', '#f1d204' ) );
$illdy_accent_color = $illdy_accent_color ? $illdy_accent_color : '#f1d204';

$illdy_style = '';

if ( 'page' === get_option( 'show_on_front' ) && is_front_page() ) {
	if ( $illdy_jumbotron_general_image && 'image' === $illdy_jumbotron_type ) {
		$illdy_style = 'background-image: url(' . esc_url( $illdy_jumbotron_general_image ) . ');';
	}
} elseif ( ( is_single() || is_page() ) && $illdy_jumbotron_single_image ) {

	global $post;
	if ( $post instanceof WP_Post && has_post_thumbnail( $post->ID ) ) {
		$illdy_style = 'background-image: url(' . esc_url( get_the_post_thumbnail_url( $post->ID, 'full' ) ) . ');';
	} elseif ( has_header_image() ) {
		$illdy_style = 'background-image: url(' . esc_url( get_header_image() ) . ');';
	} else {
		$illdy_style = 'background-color: ' . $illdy_accent_color . ';';
	}
} elseif ( has_header_image() ) {
	$illdy_style = 'background-image: url(' . esc_url( get_header_image() ) . ');';
} else {
	$illdy_style = 'background-color: ' . $illdy_accent_color . ';';
}

// append the parallax effect
if ( $illdy_is_mobile_safari ) {
	$illdy_style .= 'background-attachment: scroll;';
} elseif ( $illdy_jumbotron_parallax_enable ) {
	$illdy_style .= 'background-attachment: fixed;';
}

if ( ( is_single() || is_page() || is_archive() ) && 2 === (int) get_theme_mod( 'illdy_archive_page_background_stretch' ) ) {
	$illdy_style .= 'background-size:contain;background-repeat:no-repeat;';
}

$illdy_header_class = '';

if ( 'page' === get_option( 'show_on_front' ) && is_front_page() ) {
	$illdy_header_class = 'header-front-page';
} else {
	$illdy_header_class = 'header-blog';
}

if ( get_theme_mod( 'illdy_sticky_header_enable', false ) ) {
	$illdy_header_class .= ' header-has-sticky-menu';
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<?php // Zoom is no longer disabled: maximum-scale=1 and user-scalable=no fail WCAG 1.4.4. ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'illdy' ); ?></a>
<?php if ( 1 === (int) $illdy_preloader_enable && ! is_customize_preview() ) : ?>
	<div class="pace-overlay"></div>
<?php endif; ?>
<header id="header" class="<?php echo esc_attr( $illdy_header_class ); ?>" style="<?php echo esc_attr( $illdy_style ); ?>">
	<div class="top-header">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-xs-8">

					<?php if ( ! empty( $illdy_logo_image ) ) : ?>
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
							<img class="header-logo-img" src="<?php echo esc_url( $illdy_logo_image[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"<?php echo $illdy_logo_width ? ' width="' . esc_attr( absint( $illdy_logo_width ) ) . '"' : ''; ?> />
						</a>
					<?php else : ?>
						<?php if ( 'page' === get_option( 'show_on_front' ) ) { ?>
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( $illdy_text_logo ); ?>" class="header-logo"><?php echo esc_html( $illdy_text_logo ); ?></a>
					<?php } else { ?>
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="header-logo"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
					<?php } ?>
					<?php endif; ?>

				</div><!--/.col-sm-2-->
				<div class="col-sm-8 col-xs-4">
					<nav class="header-navigation" aria-label="<?php esc_attr_e( 'Primary', 'illdy' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary-menu',
								'menu'           => '',
								'container'      => false,
								'menu_class'     => 'clearfix',
								'menu_id'        => '',
							)
						);
						?>
					</nav>
					<button type="button" class="open-responsive-menu" aria-expanded="false" aria-controls="illdy-responsive-menu"><i class="fa-solid fa-bars" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Menu', 'illdy' ); ?></span></button>
				</div><!--/.col-sm-10-->
			</div><!--/.row-->
		</div><!--/.container-->
	</div><!--/.top-header-->
	<nav class="responsive-menu" id="illdy-responsive-menu" aria-label="<?php esc_attr_e( 'Primary', 'illdy' ); ?>">
		<ul>
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary-menu',
					'menu'            => '',
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => '',
					'menu_id'         => '',
					'items_wrap'      => '%3$s',
				)
			);
			?>
		</ul>
	</nav><!--/.responsive-menu-->
	<?php
	if ( 'page' === get_option( 'show_on_front' ) && is_front_page() ) {
		if ( 'video' === $illdy_jumbotron_type ) {
			get_template_part( 'sections/front-page', 'header-video' );
		} elseif ( 'slider' === $illdy_jumbotron_type ) {
			get_template_part( 'sections/front-page', 'header-slider' );
		}
		get_template_part( 'sections/front-page', 'bottom-header' );
	} else {
		get_template_part( 'sections/blog', 'bottom-header' );
	}
	?>
</header><!--/#header-->
<main id="content" class="site-main">
