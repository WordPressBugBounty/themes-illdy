<?php
/**
 * Jetpack compatibility.
 *
 * @link https://jetpack.com/
 *
 * @package WordPress
 * @subpackage illdy
 */

if ( ! function_exists( 'illdy_jetpack_setup' ) ) {
	/**
	 * Infinite Scroll and responsive videos.
	 *
	 * This was the _s starter's code, still named _s_*, and it pointed Infinite
	 * Scroll at a #main container that no Illdy template has: posts are listed in
	 * section#blog, so new posts had nowhere to go.
	 */
	function illdy_jetpack_setup() {
		add_theme_support(
			'infinite-scroll',
			array(
				'container' => 'blog',
				'render'    => 'illdy_infinite_scroll_render',
				'footer'    => 'page',
			)
		);
		add_theme_support( 'jetpack-responsive-videos' );
	}
	add_action( 'after_setup_theme', 'illdy_jetpack_setup' );
}

if ( ! function_exists( 'illdy_infinite_scroll_render' ) ) {
	/**
	 * Renders the posts Infinite Scroll loads, with the blog's own template part.
	 */
	function illdy_infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		}
	}
}
