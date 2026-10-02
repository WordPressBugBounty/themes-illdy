<?php
// phpcs:disable Universal.Files.SeparateFunctionsFromOO.Mixed -- the class and the pluggable function that boots it stay together, as in every release since 1.0.

if ( ! function_exists( 'illdy_call_entry_meta_class' ) ) {

	function illdy_call_entry_meta_class() {

		// instantiate the class & load everything else
		Illdy_Entry_Meta_Output::get_instance();
	}
	add_action( 'wp_loaded', 'illdy_call_entry_meta_class' );
}



if ( ! class_exists( 'Illdy_Entry_Meta_Output' ) ) {

	class Illdy_Entry_Meta_Output {


		/**
		 * @var Singleton The reference to *Singleton* instance of this class
		 */
		private static $instance;


		protected function __construct() {
			add_action( 'illdy_single_entry_meta', array( $this, 'single_entry_meta_output' ), 1 );
			add_action( 'illdy_archive_meta_content', array( $this, 'archive_entry_meta_output' ), 1 );
			add_action( 'illdy_single_after_content', array( $this, 'single_content_tags' ), 1 );
		}

		/**
		 * Returns the *Singleton* instance of this class.
		 *
		 * @return Singleton The *Singleton* instance.
		 */
		public static function get_instance() {
			if ( null === static::$instance ) {
				static::$instance = new static();
			}

			return static::$instance;
		}

		/**
		 * The comment count, or a note that comments are closed.
		 *
		 * @return string
		 */
		protected function comments_meta() {
			$number_comments = (int) get_comments_number();

			if ( ! comments_open() ) {
				return '<span class="post-meta-comments"><i class="fa-regular fa-comment" aria-hidden="true"></i>' . esc_html__( 'Comments are off for this post', 'illdy' ) . '</span>';
			}

			if ( 0 === $number_comments ) {
				return '<span class="post-meta-comments"><i class="fa-regular fa-comment" aria-hidden="true"></i>' . esc_html__( 'No comments', 'illdy' ) . '</span>';
			}

			/* translators: %s: number of comments. */
			$label = sprintf( _n( '%s comment', '%s comments', $number_comments, 'illdy' ), number_format_i18n( $number_comments ) );

			return '<span class="post-meta-comments"><i class="fa-regular fa-comment" aria-hidden="true"></i><a class="meta-comments" href="' . esc_url( get_comments_link() ) . '">' . esc_html( $label ) . '</a></span>';
		}

		/**
		 * The author, date and categories shared by both meta lines.
		 *
		 * @param bool $show_author     Whether to print the author.
		 * @param bool $show_categories Whether to print the categories.
		 *
		 * @return string
		 */
		protected function common_meta( $show_author, $show_categories ) {
			$output = '';

			if ( $show_author ) {
				$output .= '<span class="post-meta-author"><i class="fa-solid fa-user" aria-hidden="true"></i>' . esc_html( get_the_author() ) . '</span>';
			}

			$output .= '<span class="post-meta-time"><i class="fa-solid fa-calendar" aria-hidden="true"></i><time datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time></span>';

			$categories_list = get_the_category_list( esc_html__( ', ', 'illdy' ) );

			if ( $show_categories && $categories_list ) {
				$output .= '<span class="post-meta-categories"><i class="fa-regular fa-folder" aria-hidden="true"></i>' . $categories_list . '</span>';
			}

			return $output;
		}

		/**
		 *  Prints HTML with meta information for the current post-date/time and author on single post.
		 */
		public function single_entry_meta_output() {
			if ( 1 !== (int) get_theme_mod( 'illdy_enable_post_posted_on_blog_posts', 1 ) ) {
				return;
			}

			// "Show category" was registered in the Customizer but never read.
			$output  = '<div class="blog-post-meta">';
			$output .= $this->common_meta( true, 1 === (int) get_theme_mod( 'illdy_enable_post_category_blog_posts', 1 ) );

			if ( 1 === (int) get_theme_mod( 'illdy_enable_post_comments_blog_posts', 1 ) ) {
				$output .= $this->comments_meta();
			}

			$output .= '</div><!--/.blog-post-meta-->';

			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- every part is escaped where it is built.
		}

		/**
		 *  Prints HTML with meta information for the current post-date/time and author on archive.
		 */
		public function archive_entry_meta_output() {
			$output  = '<div class="blog-post-meta">';
			$output .= $this->common_meta( 1 === (int) get_theme_mod( 'illdy_post_standard_enable_author', 1 ), true );
			$output .= $this->comments_meta();
			$output .= '</div><!--/.blog-post-meta-->';

			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- every part is escaped where it is built.
		}

		/**
		 *  Prints HTML with tags on single post.
		 */
		public function single_content_tags() {
			if ( post_password_required() ) {
				return;
			}

			$display_tags_post_meta = get_theme_mod( 'illdy_enable_post_tags_blog_posts', 1 );

			$output = '';

			if ( 1 === (int) $display_tags_post_meta ) {
				if ( get_the_tag_list() ) {
					$output     .= '<ul class="blog-post-tags">';
						$output .= '<li>' . esc_html__( 'Tags: ', 'illdy' ) . '</li>';
						$output .= get_the_tag_list( '<li>', '</li>, <li>', '</li>' );
					$output     .= '</ul><!--/.blog-post-tags-->';
				}
			}

			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- the tag list is core markup; the label is escaped.
		}

		/**
		 * Private clone method to prevent cloning of the instance of the
		 * *Singleton* instance.
		 *
		 * @return void
		 */
		private function __clone() {
		}

		/**
		 * Private unserialize method to prevent unserializing of the *Singleton*
		 * instance.
		 *
		 * @return void
		 */
		public function __wakeup() {
		}
	}
}
