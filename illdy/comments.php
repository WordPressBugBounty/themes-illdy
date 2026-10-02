<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage illdy
 */
?>
<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments">
	<?php if ( have_comments() ) : ?>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav id="comment-nav-above" class="navigation comment-navigation" aria-label="<?php esc_attr_e( 'Comments', 'illdy' ); ?>">
					<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'illdy' ); ?></h2>
					<div class="nav-links">
						<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'illdy' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'illdy' ) ); ?></div>
					</div><!-- .nav-links -->
				</nav><!-- #comment-nav-above -->
			<?php endif; ?>

			<div id="comments-list">
				<h3 class="medium">
					<?php
						$illdy_comments_number = (int) get_comments_number();
					if ( 1 === $illdy_comments_number ) {
						/* translators: %s: post title */
						printf( esc_html_x( 'One thought to &ldquo;%s&rdquo;', 'comments title', 'illdy' ), '<span>' . wp_kses_post( get_the_title() ) . '</span>' );
					} else {
						printf(
							esc_html(
								/* translators: 1: number of comments, 2: post title */
								_nx(
									'%1$s thought to &ldquo;%2$s&rdquo;',
									'%1$s thoughts to &ldquo;%2$s&rdquo;',
									$illdy_comments_number,
									'comments title',
									'illdy'
								)
							),
							esc_html( number_format_i18n( $illdy_comments_number ) ),
							'<span>' . wp_kses_post( get_the_title() ) . '</span>'
						);
					}
					?>
				</h3>
				<ul class="comments">
					<?php
					// The depth comes from Settings > Discussion; it was hard-coded to 5.
					wp_list_comments(
						array(
							'callback' => 'illdy_comment',
						)
					);
					?>
				</ul><!--/.comments-->
			</div><!--/#comments-list-->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav id="comment-nav-below" class="navigation comment-navigation" aria-label="<?php esc_attr_e( 'Comments', 'illdy' ); ?>">
					<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'illdy' ); ?></h2>
					<div class="nav-links">

						<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'illdy' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'illdy' ) ); ?></div>

					</div><!-- .nav-links -->
				</nav><!-- #comment-nav-below -->
			<?php endif; ?>
	<?php endif; ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'illdy' ); ?></p>
	<?php endif; ?>

	<?php
	$illdy_commenter = wp_get_current_commenter();
	// Only required when Settings > Discussion says so; they were always marked required.
	$illdy_required = get_option( 'require_name_email' ) ? ' required' : '';

	/*
	 * The inputs had placeholders but no labels and no ids, so screen readers
	 * announced unlabelled fields and nothing could point a label at them. The
	 * labels are visually hidden; the layout is unchanged.
	 */
	$illdy_fields = array(
		'author' => '<div class="row"><div class="col-sm-4"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'illdy' ) . '</label><input class="input-full" id="author" placeholder="' . esc_attr__( 'Name', 'illdy' ) . '" name="author" type="text" autocomplete="name" value="' . esc_attr( $illdy_commenter['comment_author'] ) . '"' . $illdy_required . ' /></div>',
		'email'  => '<div class="col-sm-4"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'illdy' ) . '</label><input class="input-full" id="email" placeholder="' . esc_attr__( 'Email', 'illdy' ) . '" name="email" type="email" autocomplete="email" value="' . esc_attr( $illdy_commenter['comment_author_email'] ) . '"' . $illdy_required . ' /></div>',
		'url'    => '<div class="col-sm-4"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'illdy' ) . '</label><input class="input-full" id="url" placeholder="' . esc_attr__( 'Website', 'illdy' ) . '" name="url" type="url" autocomplete="url" value="' . esc_attr( $illdy_commenter['comment_author_url'] ) . '" /></div></div><!--/.row-->',
	);

	comment_form(
		array(
			'fields'         => $illdy_fields,
			// A complete row of its own: logged-in users get no other fields around it.
			'comment_field'  => '<div class="row"><div class="col-sm-12"><label class="screen-reader-text" for="comment">' . esc_html__( 'Message', 'illdy' ) . '</label><textarea id="comment" placeholder="' . esc_attr__( 'Message', 'illdy' ) . '" name="comment" required></textarea></div><!--/.col-sm-12--></div><!--/.row-->',
			'id_submit'      => 'input-submit',
			'label_submit'   => __( 'Send', 'illdy' ),
			'title_reply'    => __( 'Leave a comment', 'illdy' ),
			/* translators: %s: name of the comment author being replied to. */
			'title_reply_to' => __( 'Leave a comment to %s', 'illdy' ),
		)
	);
	?>
</div><!--/#comments-->
