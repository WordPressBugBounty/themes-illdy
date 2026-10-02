<?php
/**
 *    The template for displaying the content.
 *
 * @package    WordPress
 * @subpackage illdy
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post' ); ?>>
	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<span class="sticky-label"><?php esc_html_e( 'Featured', 'illdy' ); ?></span>
	<?php endif; ?>
	<h2 class="blog-post-heading"><a href="<?php the_permalink(); ?>" class="blog-post-title"><?php the_title(); ?></a></h2>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="blog-post-image">
			<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true"><?php the_post_thumbnail( 'illdy-blog-list' ); ?></a>
		</div><!--/.blog-post-image-->
	<?php } elseif ( get_theme_mod( 'illdy_disable_random_featured_image' ) ) { ?>
		<div class="blog-post-image">
			<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true"><img src="<?php echo esc_url( illdy_get_random_featured_image() ); ?>" alt=""></a>
		</div><!--/.blog-post-image-->
	<?php } ?>
	<?php do_action( 'illdy_archive_meta_content' ); ?>
	<div class="blog-post-entry">
		<?php the_excerpt(); ?>
	</div><!--/.blog-post-entry-->
	<a href="<?php the_permalink(); ?>" class="blog-post-button"><?php esc_html_e( 'Read more', 'illdy' ); ?><span class="screen-reader-text"> <?php the_title(); ?></span></a>
</article><!--/#post-<?php the_ID(); ?>.blog-post-->
