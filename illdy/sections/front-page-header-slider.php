<?php

$illdy_slides = get_theme_mod( 'illdy_jumbotron_slides', false );

if ( ! $illdy_slides ) {
	return;
}

$illdy_autoplay      = get_theme_mod( 'illdy_jumbotron_slider_autoplay', true );
$illdy_navigation    = get_theme_mod( 'illdy_jumbotron_slider_nav', true );
$illdy_autoplay_time = get_theme_mod( 'illdy_jumbotron_slider_autoplay_time', 5000 );

?>
<div class="illdy-slider illdy-jumbotron-background owl-carousel" data-autoplay="<?php echo esc_attr( $illdy_autoplay ); ?>" data-autoplay-time="<?php echo esc_attr( $illdy_autoplay_time ); ?>">
	<?php

	foreach ( (array) $illdy_slides as $illdy_slide ) {
		// Repeater rows are arrays; guard in case an older value stored objects.
		$illdy_slide = (array) $illdy_slide;

		if ( ! empty( $illdy_slide['slide_image'] ) ) {
			printf(
				'<div class="illdy-slide" style="background-image:url(%1$s)"><img src="%1$s" alt="" style="display:none"></div>',
				esc_url( $illdy_slide['slide_image'] )
			);
		}
	}

	?>
</div>
<?php if ( $illdy_navigation ) { ?>
	<div class="illdy-slider-navigation">
		<button type="button" class="illdy-navigation-button illdy-slider-prev" aria-label="<?php esc_attr_e( 'Previous slide', 'illdy' ); ?>">
			<i class="fa-solid fa-angle-left" aria-hidden="true"></i>
		</button>
		<button type="button" class="illdy-navigation-button illdy-slider-next" aria-label="<?php esc_attr_e( 'Next slide', 'illdy' ); ?>">
			<i class="fa-solid fa-angle-right" aria-hidden="true"></i>
		</button>
	</div>
<?php } ?>
