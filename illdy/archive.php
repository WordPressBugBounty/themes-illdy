<?php
/**
 *  The template for displaying the archive.
 *
 *  @package WordPress
 *  @subpackage illdy
 */
?>
<?php get_header(); ?>
<div class="container">
	<div class="row">
		<?php // Same columns as the blog index; this used col-sm-7 beside a col-sm-4 sidebar. ?>
		<div class="<?php echo is_active_sidebar( 'blog-sidebar' ) ? 'col-sm-8' : 'col-sm-8 col-sm-offset-2'; ?>">
			<section id="blog">
				<?php do_action( 'illdy_above_content_after_header' ); ?>
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_format() );
					endwhile;
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
				<?php do_action( 'illdy_after_content_above_footer' ); ?>
			</section><!--/#blog-->
		</div>
		<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
			<div class="col-sm-4">
				<div id="sidebar">
					<?php dynamic_sidebar( 'blog-sidebar' ); ?>
				</div>
			</div>
		<?php endif; ?>
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
