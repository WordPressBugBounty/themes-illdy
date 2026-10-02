<?php
/**
 *    The template for displaying the footer.
 *
 * @package    WordPress
 * @subpackage illdy
 */
?>
<?php

$illdy_show_footer           = get_theme_mod( 'illdy_show_footer', 1 );
$illdy_show_footer_copyright = get_theme_mod( 'illdy_show_footer_copyright', 1 );

if ( current_user_can( 'edit_theme_options' ) ) {
	/* translators: %s: the current year. */
	$illdy_footer_copyright = get_theme_mod( 'illdy_footer_copyright', sprintf( __( '&copy; Copyright %s. All Rights Reserved.', 'illdy' ), '{year}' ) );
} else {
	$illdy_footer_copyright = get_theme_mod( 'illdy_footer_copyright' );
}
$illdy_footer_copyright = illdy_replace_year( $illdy_footer_copyright );
?>
</main><!--/#content-->
<?php if ( 1 === (int) $illdy_show_footer || 1 === (int) $illdy_show_footer_copyright ) { ?>
<footer class="site-footer">
<?php } ?>
<?php if ( 1 === (int) $illdy_show_footer ) { ?>
	<div id="footer">
		<div class="container">
			<div class="row">
				<?php
				$illdy_the_widget_args = array(
					'before_widget' => '<div class="widget">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title"><h5>',
					'after_title'   => '</h5></div>',
				);
				?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php
					if ( is_active_sidebar( 'footer-sidebar-1' ) ) :
						dynamic_sidebar( 'footer-sidebar-1' );
					elseif ( current_user_can( 'edit_theme_options' ) ) :
						the_widget( 'WP_Widget_Text', 'title=' . __( 'Products', 'illdy' ) . '&text=<ul><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Our work', 'illdy' ) . '">' . __( 'Our work', 'illdy' ) . '</a></li><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Club', 'illdy' ) . '">' . __( 'Club', 'illdy' ) . '</a></li><li><a href="' . esc_url( '#' ) . '" title="' . __( 'News', 'illdy' ) . '">' . __( 'News', 'illdy' ) . '</a></li><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Announcement', 'illdy' ) . '">' . __( 'Announcement', 'illdy' ) . '</a></li></ul>', $illdy_the_widget_args );
					endif;
					?>
				</div><!--/.col-sm-3-->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php
					if ( is_active_sidebar( 'footer-sidebar-2' ) ) :
						dynamic_sidebar( 'footer-sidebar-2' );
					elseif ( current_user_can( 'edit_theme_options' ) ) :
						the_widget( 'WP_Widget_Text', 'title=' . __( 'Information', 'illdy' ) . '&text=<ul><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Pricing', 'illdy' ) . '">' . __( 'Pricing', 'illdy' ) . '</a></li><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Terms', 'illdy' ) . '">' . __( 'Terms', 'illdy' ) . '</a></li><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Affiliates', 'illdy' ) . '">' . __( 'Affiliates', 'illdy' ) . '</a></li><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Blog', 'illdy' ) . '">' . __( 'Blog', 'illdy' ) . '</a></li></ul>', $illdy_the_widget_args );
					endif;
					?>
				</div><!--/.col-sm-3-->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php
					if ( is_active_sidebar( 'footer-sidebar-3' ) ) :
						dynamic_sidebar( 'footer-sidebar-3' );
					elseif ( current_user_can( 'edit_theme_options' ) ) :
						the_widget( 'WP_Widget_Text', 'title=' . __( 'Support', 'illdy' ) . '&text=<ul><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Documentation', 'illdy' ) . '">' . __( 'Documentation', 'illdy' ) . '</a></li><li><a href="' . esc_url( '#' ) . '" title="' . __( 'FAQs', 'illdy' ) . '">' . __( 'FAQs', 'illdy' ) . '</a></li><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Forums', 'illdy' ) . '">' . __( 'Forums', 'illdy' ) . '</a></li><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Contact', 'illdy' ) . '">' . __( 'Contact', 'illdy' ) . '</a></li></ul>', $illdy_the_widget_args );
					endif;
					?>
				</div><!--/.col-sm-3-->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php
					if ( is_active_sidebar( 'footer-sidebar-4' ) ) :
						dynamic_sidebar( 'footer-sidebar-4' );
					elseif ( current_user_can( 'edit_theme_options' ) ) :
						the_widget( 'WP_Widget_Text', 'title=' . __( 'Support', 'illdy' ) . '&text=<ul><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Documentation', 'illdy' ) . '">' . __( 'Documentation', 'illdy' ) . '</a></li><li><a href="' . esc_url( '#' ) . '" title="' . __( 'FAQs', 'illdy' ) . '">' . __( 'FAQs', 'illdy' ) . '</a></li><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Forums', 'illdy' ) . '">' . __( 'Forums', 'illdy' ) . '</a></li><li><a href="' . esc_url( '#' ) . '" title="' . __( 'Contact', 'illdy' ) . '">' . __( 'Contact', 'illdy' ) . '</a></li></ul>', $illdy_the_widget_args );
					endif;
					?>
				</div><!--/.col-sm-3-->
			</div><!--/.row-->
		</div><!--/.container-->
	</div><!--/#footer-->
<?php } ?>

<?php if ( 1 === (int) $illdy_show_footer_copyright ) { ?>
	<div class="bottom-footer">
		<div class="container">
			<p class="copyright">
				<span><?php echo esc_html__( 'Theme:', 'illdy' ); ?> <a href="<?php echo esc_url( 'https://colorlib.com/wp/themes/illdy/' ); ?>" target="_blank" rel="noopener"><?php echo esc_html__( 'Illdy', 'illdy' ); ?></a>.</span>
				<span class="bottom-copyright" data-customizer="copyright-credit"><?php echo illdy_sanitize_html( $illdy_footer_copyright ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- illdy_sanitize_html() is wp_kses() with a short allowlist. ?></span>
			</p>
		</div>
	</div>
<?php } ?>
<?php if ( 1 === (int) $illdy_show_footer || 1 === (int) $illdy_show_footer_copyright ) { ?>
</footer><!--/.site-footer-->
<?php } ?>

<?php if ( 'page' === get_option( 'show_on_front' ) && is_front_page() && get_theme_mod( 'illdy_go_to_top', false ) ) : ?>
	<a href="#header" class="illdy-top"><i class="fa-solid fa-angle-up" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Back to top', 'illdy' ); ?></span></a>
<?php endif ?>

<?php wp_footer(); ?>
</body></html>
