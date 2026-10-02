<?php
/**
 *  The template for displaying the search form in sidebar.
 *
 *  @package WordPress
 *  @subpackage illdy
 */
?>

<?php
/*
 * The field was labelled only by a placeholder and a title attribute, and the submit
 * button had no accessible name at all — it is styled as an icon, so its value is
 * deliberately empty. Screen readers announced an unlabelled edit field next to an
 * unlabelled button.
 *
 * The label is visually hidden, so nothing about the design changes. It also gives the
 * block widget editor something to preview: markup with no text and no image counts as
 * an empty preview there, which is why the Search widget showed "No preview available".
 */
?>
<?php
// Unique per form: a page can carry several (the sidebar and a no-results message).
$illdy_search_id = wp_unique_id( 'illdy-search-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $illdy_search_id ); ?>"><?php echo esc_html_x( 'Search for:', 'label', 'illdy' ); ?></label>
	<div class="search-form-box">
		<input type="submit" class="search-submit" value="" aria-label="<?php echo esc_attr_x( 'Search', 'submit button', 'illdy' ); ?>" />
		<input type="search" class="search-field" id="<?php echo esc_attr( $illdy_search_id ); ?>" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'illdy' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	</div><!--/.search-form-box-->
</form><!--/.search-form-->
