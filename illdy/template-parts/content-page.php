<?php
/**
 *  The template for displaying the page content.
 *
 *  @package WordPress
 *  @subpackage illdy
 */

/*
 * Defaults to false, like the Customizer setting and header.php. With true here an
 * untouched site showed the featured image in neither place.
 */
$illdy_featured_in_header = (bool) get_theme_mod( 'illdy_jumbotron_enable_featured_image', false );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post' ); ?>>
	<?php if ( has_post_thumbnail() && ! $illdy_featured_in_header ) { ?>
		<div class="blog-post-image">
			<?php the_post_thumbnail( 'illdy-blog-list' ); ?>
		</div><!--/.blog-post-image-->
	<?php } ?>
	<div class="blog-post-entry markup-format">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="link-pages">' . __( 'Pages:', 'illdy' ),
				'after'  => '</div><!--/.link-pages-->',
			)
		);
		?>
	</div><!--/.blog-post-entry.markup-format-->
</article><!--/#post-<?php the_ID(); ?>.blog-post-->
