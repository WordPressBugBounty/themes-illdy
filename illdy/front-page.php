<?php
/**
 *  The template for displaying the front page.
 *
 *  @package WordPress
 *  @subpackage illdy
 */


/*
 * With "Your latest posts" as the homepage this is the blog index, so it renders
 * exactly like index.php instead of keeping its own narrower copy of it.
 */
if ( 'posts' === get_option( 'show_on_front' ) ) {
	get_template_part( 'index' );
	return;
}

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		/*
		 * Run the standard `the_content` pipeline. Echoing get_the_content() raw
		 * meant shortcodes, dynamic blocks and oEmbeds on a static front page were
		 * never rendered, and the raw string was printed unescaped.
		 */
		$illdy_static_page_content = apply_filters( 'the_content', get_the_content() ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- core filter.
		$illdy_static_page_content = str_replace( ']]>', ']]&gt;', $illdy_static_page_content );
		if ( '' !== trim( $illdy_static_page_content ) ) :
			?>
			<section class="front-page-section" id="static-page-content">
				<div class="section-header">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<h3><?php the_title(); ?></h3>
							</div><!--/.col-sm-12-->
						</div><!--/.row-->
					</div><!--/.container-->
				</div><!--/.section-header-->
				<div class="section-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-10 col-sm-offset-1">
								<?php echo $illdy_static_page_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already through the_content filters. ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php
		endif;
	endwhile;
endif;

illdy_sections();

get_footer();

