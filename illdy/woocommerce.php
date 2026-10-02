<?php
/**
 *  The template for displaying WooCommerce.
 *
 *  @package WordPress
 *  @subpackage illdy
 */
?>
<?php get_header(); ?>
<?php
/*
 * The fallback cart and category widgets were shown to every visitor, under the
 * placeholder title "WooCommerce Title". Like the theme's other placeholders they
 * are now for administrators only, and without a sidebar the shop uses the full row.
 */
$illdy_woo_sidebar     = is_active_sidebar( 'woocommerce-sidebar' );
$illdy_woo_placeholder = ! $illdy_woo_sidebar && current_user_can( 'edit_theme_options' );
?>
<div class="container">
	<div class="row">
		<div class="<?php echo ( $illdy_woo_sidebar || $illdy_woo_placeholder ) ? 'col-sm-8' : 'col-sm-12'; ?>">
			<section id="blog">
				<?php woocommerce_content(); ?>
			</section><!--/#blog-->
		</div>
		<?php if ( $illdy_woo_sidebar ) : ?>
			<div class="col-sm-4">
				<div id="sidebar">
					<?php dynamic_sidebar( 'woocommerce-sidebar' ); ?>
				</div><!--/#sidebar-->
			</div><!--/.col-sm-4-->
		<?php elseif ( $illdy_woo_placeholder ) : ?>
			<div class="col-sm-4">
				<div id="sidebar">
					<?php
					$illdy_widget_args = array(
						'before_widget' => '<div class="widget">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="widget-title"><h3>',
						'after_title'   => '</h3></div>',
					);

					the_widget( 'WC_Widget_Cart', 'title=' . __( 'Cart', 'illdy' ), $illdy_widget_args );
					the_widget( 'WC_Widget_Product_Categories', 'title=' . __( 'Product Categories', 'illdy' ), $illdy_widget_args );
					?>
				</div><!--/#sidebar-->
			</div><!--/.col-sm-4-->
		<?php endif; ?>
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
