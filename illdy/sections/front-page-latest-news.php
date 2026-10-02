<?php
/**
 *    The template for displaying the latest news section in front page.
 *
 * @package    WordPress
 * @subpackage illdy
 */
?>
<?php

$illdy_blog_page_id = get_option( 'page_for_posts' );
$illdy_button_url   = '#';
if ( $illdy_blog_page_id ) {
	$illdy_button_url = get_permalink( $illdy_blog_page_id );
}
if ( current_user_can( 'edit_theme_options' ) ) {
	$illdy_general_title   = get_theme_mod( 'illdy_latest_news_general_title', __( 'Latest News', 'illdy' ) );
	$illdy_general_entry   = get_theme_mod( 'illdy_latest_news_general_entry', __( 'If you are interested in the latest articles in the industry, take a sneak peek at our blog. You have got nothing to lose!', 'illdy' ) );
	$illdy_button_text     = get_theme_mod( 'illdy_latest_news_button_text', __( 'See blog', 'illdy' ) );
	$illdy_number_of_posts = get_theme_mod( 'illdy_latest_news_number_of_posts', absint( 3 ) );
} else {
	$illdy_general_title   = get_theme_mod( 'illdy_latest_news_general_title' );
	$illdy_general_entry   = get_theme_mod( 'illdy_latest_news_general_entry' );
	$illdy_button_text     = get_theme_mod( 'illdy_latest_news_button_text' );
	$illdy_number_of_posts = get_theme_mod( 'illdy_latest_news_number_of_posts', absint( 3 ) );
}

$illdy_number_of_words = get_theme_mod( 'illdy_latest_news_words_number', absint( 20 ) );

$illdy_post_query_args = array(
	'post_type'              => array( 'post' ),
	'nopaging'               => false,
	'posts_per_page'         => absint( $illdy_number_of_posts ),
	'ignore_sticky_posts'    => true,
	'cache_results'          => true,
	'update_post_meta_cache' => true,
	'update_post_term_cache' => true,
);

$illdy_post_query = new WP_Query( $illdy_post_query_args );

if ( $illdy_post_query->have_posts() || '' !== (string) $illdy_general_title || '' !== (string) $illdy_general_entry || '' !== (string) $illdy_button_text ) {

	?>

	<section id="latest-news" class="front-page-section">
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
		<?php if ( $illdy_button_text ) : ?>
			<a href="<?php echo esc_url( $illdy_button_url ); ?>" title="<?php echo esc_attr( $illdy_button_text ); ?>" class="latest-news-button"><i class="fa-solid fa-chevron-circle-right"></i><?php echo esc_html( $illdy_button_text ); ?>
			</a>
		<?php endif; ?>

		<?php if ( $illdy_post_query->have_posts() ) : ?>
			<div class="section-content">
				<div class="container">
					<div class="row blog-carousel">
						<?php while ( $illdy_post_query->have_posts() ) : ?>
							<?php $illdy_post_query->the_post(); ?>
							<?php $illdy_post_thumbnail = has_post_thumbnail() ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'illdy-front-page-latest-news' ) : false; ?>
							<?php $illdy_random_image = ! $illdy_post_thumbnail && get_theme_mod( 'illdy_disable_random_featured_image' ); ?>

							<div class="illdy-blog-post col-md-4 col-sm-6 col-xs-12">
								<div class="post"<?php echo ( $illdy_post_thumbnail || $illdy_random_image ) ? '' : ' style="padding-top: 40px;"'; ?>>
									<?php if ( $illdy_post_thumbnail ) { ?>
										<div class="post-image" style="background-image: url('<?php echo esc_url( $illdy_post_thumbnail[0] ); ?>');"></div>
									<?php } elseif ( $illdy_random_image ) { ?>
										<div class="post-image" style="background-image: url('<?php echo esc_url( illdy_get_random_featured_image() ); ?>');"></div><!--/.blog-post-image-->
									<?php } ?>
									<h5><a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a></h5>
									<div class="post-entry">
										<?php echo esc_html( wp_trim_words( get_the_excerpt(), absint( $illdy_number_of_words ) ) ); ?>
									</div><!--/.post-entry-->
									<a href="<?php the_permalink(); ?>" class="post-button"><i class="fa-solid fa-chevron-circle-right" aria-hidden="true"></i><?php esc_html_e( 'Read more', 'illdy' ); ?><span class="screen-reader-text"> <?php the_title(); ?></span>
									</a>
								</div><!--/.post-->
							</div><!--/.col-sm-4-->
						<?php endwhile; ?>
					</div><!--/.row-->
				</div><!--/.container-->
			</div><!--/.section-content-->
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</section><!--/#latest-news.front-page-section-->

<?php }
?>
