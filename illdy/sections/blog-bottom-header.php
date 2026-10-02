<?php
/**
 *    The template for displaying the bottom header section in blog.
 *
 *    Prints the one h1 of every view that is not the front page. The single product
 *    page is the exception: WooCommerce prints the product title as its h1, so the
 *    same title here is a paragraph styled like the heading.
 *
 * @package    WordPress
 * @subpackage illdy
 */

$illdy_is_product = function_exists( 'is_product' ) && is_product();
?>
<div class="bottom-header blog">
	<div class="container">
		<div class="row">
			<?php
			if ( is_404() ) {
				$illdy_page_title = get_theme_mod( 'illdy_404_title', esc_html__( 'Page not found', 'illdy' ) );
				echo '<h1>' . wp_kses_post( $illdy_page_title ) . '</h1>';
			} elseif ( is_singular() ) {
				?>
				<div class="col-sm-12">
					<?php
					if ( $illdy_is_product ) {
						echo '<p class="illdy-page-title">' . wp_kses_post( get_the_title() ) . '</p>';
					} else {
						echo '<h1>' . wp_kses_post( get_the_title() ) . '</h1>';
					}
					?>
				</div><!--/.col-sm-12-->
				<?php
			} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
				echo '<h1>' . esc_html( get_the_title( wc_get_page_id( 'shop' ) ) ) . '</h1>';
			} else {
				?>
				<div class="col-sm-12">
					<?php
					if ( is_home() ) {
						$illdy_archive_title = is_front_page() ? get_bloginfo( 'name' ) : get_the_title( get_option( 'page_for_posts' ) );
						echo '<h1 class="archive-title">' . esc_html( $illdy_archive_title ) . '</h1>';
					} elseif ( is_search() ) {
						/* translators: %s: the search query. */
						echo '<h1 class="archive-title">' . esc_html( sprintf( __( 'Search results for: %s', 'illdy' ), get_search_query( false ) ) ) . '</h1>';
					} else {
						echo '<h1 class="archive-title">' . wp_kses_post( get_the_archive_title() ) . '</h1>';
					}
					?>
				</div><!--/.col-sm-12-->
				<div class="col-sm-8 col-sm-offset-2">
					<?php
					if ( is_home() ) {
						echo '<p>' . esc_html( get_bloginfo( 'description' ) ) . '</p>';
					} else {
						the_archive_description( '<div class="archive-description">', '</div>' );
					}
					?>
				</div><!--/.col-sm-8.col-sm-offset-2-->
				<?php
			}
			?>
		</div><!--/.row-->
	</div><!--/.container-->
</div><!--/.bottom-header.blog-->
