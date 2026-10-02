<?php
/**
 *  The template for displaying about section in front page.
 *
 *  @package WordPress
 *  @subpackage illdy
 */
?>
<?php

$illdy_general_title = get_theme_mod( 'illdy_full_width_general_title' );
$illdy_general_entry = get_theme_mod( 'illdy_full_width_general_entry' );
$illdy_padding       = get_theme_mod( 'illdy_full_width_padding', 1 );

?>

<?php if ( '' !== (string) $illdy_general_title || '' !== (string) $illdy_general_entry || is_active_sidebar( 'front-page-full-width-sidebar' ) ) { ?>

<section id="full-width" class="front-page-section <?php echo $illdy_padding ? 'width-padding' : ''; ?>">
	<?php if ( $illdy_general_title || $illdy_general_entry ) : ?>
		<div class="section-header">
			<div class="container">
				<div class="row">
					<?php if ( $illdy_general_title ) : ?>
						<div class="col-sm-12">
							<h3><?php echo do_shortcode( wp_kses_post( $illdy_general_title ) ); ?></h3>
						</div><!--/.col-sm-12-->
					<?php endif; ?>
					<?php if ( $illdy_general_entry ) : ?>
						<div class="col-sm-10 col-sm-offset-1">
							<div class="section-description"><?php echo do_shortcode( wp_kses_post( $illdy_general_entry ) ); ?></div>
						</div><!--/.col-sm-10.col-sm-offset-1-->
					<?php endif; ?>
				</div><!--/.row-->
			</div><!--/.container-->
		</div><!--/.section-header-->
	<?php endif; ?>
	<div class="section-content">
		<?php
		if ( is_active_sidebar( 'front-page-full-width-sidebar' ) ) {
				dynamic_sidebar( 'front-page-full-width-sidebar' );
		}
		?>
	</div><!--/.section-content-->
</section><!--/#about.front-page-section-->

<?php } ?>
