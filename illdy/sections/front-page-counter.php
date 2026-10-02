<?php
/**
 *  The template for displaying the counter section in front page.
 *
 *  @package WordPress
 *  @subpackage illdy
 */
?>

<?php
/*
 * The background used to fall back to the defaults only for administrators.
 * Visitors to a site that never saved these got no background at all, and the
 * counter's white text on the page's white background: an empty-looking band.
 * Styling is not placeholder content, so everyone gets the same defaults.
 */
$illdy_counter_background_type  = get_theme_mod( 'illdy_counter_background_type', 'image' );
$illdy_counter_background_image = get_theme_mod( 'illdy_counter_background_image', get_template_directory_uri() . '/layout/images/front-page/front-page-counter.jpg' );
$illdy_counter_background_color = sanitize_hex_color( (string) get_theme_mod( 'illdy_counter_background_color', '#000000' ) );
$illdy_counter_background_color = $illdy_counter_background_color ? $illdy_counter_background_color : '#000000';

if ( 'image' === $illdy_counter_background_type && $illdy_counter_background_image ) {
	$illdy_counter_style = 'background-image: url(' . esc_url( $illdy_counter_background_image ) . ');background-color:' . $illdy_counter_background_color . ';';
} else {
	$illdy_counter_style = 'background-color:' . $illdy_counter_background_color;
}
?>

<?php if ( is_active_sidebar( 'front-page-counter-sidebar' ) ) { ?>

<section id="counter" class="front-page-section" style="<?php echo esc_attr( $illdy_counter_style ); ?>">
	<div class="counter-overlay"></div>
	<div class="container">
		<div class="row inline-columns">
			<?php dynamic_sidebar( 'front-page-counter-sidebar' ); ?>
		</div><!--/.row-->
	</div><!--/.container-->
</section><!--/#counter.front-page-section-->

<?php } ?>
