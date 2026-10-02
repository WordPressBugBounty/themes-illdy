<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @package WordPress
 * @subpackage illdy
 */
?>
<article class="blog-post no-results">
	<h2 class="blog-post-heading"><span class="blog-post-title"><?php esc_html_e( 'Nothing Found', 'illdy' ); ?></span></h2>
	<div class="blog-post-entry">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p>
			<?php
			printf(
				/* translators: %1$s: URL of the new post screen. */
				wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'illdy' ), array( 'a' => array( 'href' => array() ) ) ),
				esc_url( admin_url( 'post-new.php' ) )
			);
			?>
			</p>
		<?php elseif ( is_search() ) : ?>
			<p><?php esc_html_e( 'Nothing matched your search terms. Please try again with some different keywords.', 'illdy' ); ?></p>
			<div class="widget widget_search"><?php get_search_form(); ?></div>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'illdy' ); ?></p>
			<div class="widget widget_search"><?php get_search_form(); ?></div>
		<?php endif; ?>
	</div><!--/.blog-post-entry-->
</article><!--/.blog-post.no-results-->
