<?php
/**
 *    The template for displaying the contact us section in front page.
 *
 * @package    WordPress
 * @subpackage illdy
 */
?>
<?php
if ( current_user_can( 'edit_theme_options' ) ) {

	$illdy_contact_bar_facebook_url  = get_theme_mod( 'illdy_contact_bar_facebook_url', esc_url( '#' ) );
	$illdy_contact_bar_twitter_url   = get_theme_mod( 'illdy_contact_bar_twitter_url', esc_url( '#' ) );
	$illdy_contact_bar_linkedin_url  = get_theme_mod( 'illdy_contact_bar_linkedin_url', esc_url( '#' ) );
	$illdy_contact_bar_youtube_url   = get_theme_mod( 'illdy_contact_bar_youtube_url', esc_url( '#' ) );
	$illdy_contact_bar_vimeo_url     = get_theme_mod( 'illdy_contact_bar_vimeo_url', esc_url( '#' ) );
	$illdy_contact_bar_pinterest_url = get_theme_mod( 'illdy_contact_bar_pinterest_url', esc_url( '#' ) );
	$illdy_contact_bar_instagram_url = get_theme_mod( 'illdy_contact_bar_instagram_url', esc_url( '#' ) );
	$illdy_email                     = get_theme_mod( 'illdy_email', __( 'contact@site.com', 'illdy' ) );
	$illdy_phone                     = get_theme_mod( 'illdy_phone', __( '(555) 555-5555', 'illdy' ) );
	$illdy_address1                  = get_theme_mod( 'illdy_address1', __( 'Street 221B Baker Street, ', 'illdy' ) );
	$illdy_address2                  = get_theme_mod( 'illdy_address2', __( 'London, UK', 'illdy' ) );
	$illdy_general_title             = get_theme_mod( 'illdy_contact_us_general_title', __( 'Contact us', 'illdy' ) );
	$illdy_general_entry             = get_theme_mod( 'illdy_contact_us_entry', __( 'And we will get in touch as soon as possible.', 'illdy' ) );
	$illdy_general_contact_form      = defined( 'KALIFORMS_VERSION' ) ? get_theme_mod( 'illdy_contact_us_general_kali_forms' ) : get_theme_mod( 'illdy_contact_us_general_contact_form_7' );
	$illdy_general_address_title     = get_theme_mod( 'illdy_contact_us_general_address_title', __( 'Address', 'illdy' ) );
	$illdy_customer_support_title    = get_theme_mod( 'illdy_contact_us_general_customer_support_title', __( 'Customer Support', 'illdy' ) );
} else {
	$illdy_contact_bar_facebook_url  = get_theme_mod( 'illdy_contact_bar_facebook_url' );
	$illdy_contact_bar_twitter_url   = get_theme_mod( 'illdy_contact_bar_twitter_url' );
	$illdy_contact_bar_linkedin_url  = get_theme_mod( 'illdy_contact_bar_linkedin_url' );
	$illdy_contact_bar_youtube_url   = get_theme_mod( 'illdy_contact_bar_youtube_url' );
	$illdy_contact_bar_vimeo_url     = get_theme_mod( 'illdy_contact_bar_vimeo_url' );
	$illdy_contact_bar_pinterest_url = get_theme_mod( 'illdy_contact_bar_pinterest_url' );
	$illdy_contact_bar_instagram_url = get_theme_mod( 'illdy_contact_bar_instagram_url' );
	$illdy_email                     = get_theme_mod( 'illdy_email' );
	$illdy_phone                     = get_theme_mod( 'illdy_phone' );
	$illdy_address1                  = get_theme_mod( 'illdy_address1' );
	$illdy_address2                  = get_theme_mod( 'illdy_address2' );
	$illdy_general_title             = get_theme_mod( 'illdy_contact_us_general_title' );
	$illdy_general_entry             = get_theme_mod( 'illdy_contact_us_entry' );
	$illdy_general_contact_form      = defined( 'KALIFORMS_VERSION' ) ? get_theme_mod( 'illdy_contact_us_general_kali_forms' ) : get_theme_mod( 'illdy_contact_us_general_contact_form_7' );
	$illdy_general_address_title     = get_theme_mod( 'illdy_contact_us_general_address_title' );
	$illdy_customer_support_title    = get_theme_mod( 'illdy_contact_us_general_customer_support_title' );
}

if ( '' !== (string) $illdy_general_title || '' !== (string) $illdy_general_entry || '' !== (string) $illdy_general_address_title || '' !== (string) $illdy_address1 || '' !== (string) $illdy_address2 || '' !== (string) $illdy_customer_support_title || '' !== (string) $illdy_email || '' !== (string) $illdy_phone || '' !== (string) $illdy_contact_bar_twitter_url || '' !== (string) $illdy_contact_bar_facebook_url || '' !== (string) $illdy_contact_bar_linkedin_url || '' !== (string) $illdy_contact_bar_instagram_url || '' !== (string) $illdy_contact_bar_vimeo_url || '' !== (string) $illdy_contact_bar_pinterest_url || '' !== (string) $illdy_contact_bar_youtube_url || ( $illdy_general_contact_form && 'default' !== $illdy_general_contact_form ) ) {

	?>
	<section id="contact-us" class="front-page-section">
		<?php if ( $illdy_general_title || $illdy_general_entry ) : ?>
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
		<?php endif; ?>
		<div class="section-content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="row" style="margin-bottom: 45px;">
							<div class="col-sm-4">
								<div class="contact-us-box">
									<?php if ( $illdy_general_address_title ) : ?>
										<div class="box-left" data-customizer="box-left-address-title">
											<?php echo illdy_sanitize_html( $illdy_general_address_title ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_kses() with a short allowlist. ?>
										</div><!--/.box-left-->
									<?php endif; ?>
									<div class="box-right">
										<?php if ( $illdy_address1 ) : ?>
											<span class="box-right-row" data-customizer="contact-us-address-1"><?php echo illdy_sanitize_html( $illdy_address1 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_kses() with a short allowlist. ?></span>
										<?php endif; ?>
										<?php if ( $illdy_address2 ) : ?>
											<span class="box-right-row" data-customizer="contact-us-address-2"><?php echo illdy_sanitize_html( $illdy_address2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_kses() with a short allowlist. ?></span>
										<?php endif; ?>
									</div><!--/.box-right-->
								</div><!--/.contact-us-box-->
							</div><!--/.col-sm-4-->
							<div class="col-sm-5">
								<div class="contact-us-box">
									<?php if ( $illdy_customer_support_title ) : ?>
										<div class="box-left" data-customizer="box-left-customer-support-title">
											<?php echo illdy_sanitize_html( $illdy_customer_support_title ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_kses() with a short allowlist. ?>
										</div><!--/.box-left-->
									<?php endif; ?>
									<div class="box-right">
										<?php if ( $illdy_email ) : ?>
											<span class="box-right-row"><?php esc_html_e( 'E-mail:', 'illdy' ); ?>
												<a href="mailto:<?php echo esc_attr( $illdy_email ); ?>" title="<?php echo esc_attr( $illdy_email ); ?>"><?php echo esc_html( $illdy_email ); ?></a></span>
										<?php endif; ?>
										<?php if ( $illdy_phone ) : ?>
											<span class="box-right-row" data-customizer="contact-us-phone"><?php esc_html_e( 'Phone:', 'illdy' ); ?> <?php echo illdy_sanitize_html( $illdy_phone ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_kses() with a short allowlist. ?></span>
										<?php endif; ?>
									</div><!--/.box-right-->
								</div><!--/.contact-us-box-->
							</div><!--/.col-sm-5-->
							<div class="col-sm-3">
								<?php if ( $illdy_contact_bar_twitter_url || $illdy_contact_bar_facebook_url || $illdy_contact_bar_linkedin_url || $illdy_contact_bar_pinterest_url || $illdy_contact_bar_instagram_url || $illdy_contact_bar_youtube_url || $illdy_contact_bar_vimeo_url ) { ?>
									<div class="contact-us-social">
										<?php if ( $illdy_contact_bar_twitter_url ) : ?>
											<a href="<?php echo esc_url( $illdy_contact_bar_twitter_url ); ?>" title="<?php esc_attr_e( 'Twitter', 'illdy' ); ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a>
										<?php endif; ?>
										<?php if ( $illdy_contact_bar_facebook_url ) : ?>
											<a href="<?php echo esc_url( $illdy_contact_bar_facebook_url ); ?>" title="<?php esc_attr_e( 'Facebook', 'illdy' ); ?>" target="_blank"><i class="fa-brands fa-facebook"></i></a>
										<?php endif; ?>
										<?php if ( $illdy_contact_bar_linkedin_url ) : ?>
											<a href="<?php echo esc_url( $illdy_contact_bar_linkedin_url ); ?>" title="<?php esc_attr_e( 'LinkedIn', 'illdy' ); ?>" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
										<?php endif; ?>
										<?php if ( $illdy_contact_bar_pinterest_url ) : ?>
											<a href="<?php echo esc_url( $illdy_contact_bar_pinterest_url ); ?>" title="<?php esc_attr_e( 'Pinterest', 'illdy' ); ?>" target="_blank"><i class="fa-brands fa-pinterest"></i></a>
										<?php endif; ?>
										<?php if ( $illdy_contact_bar_instagram_url ) : ?>
											<a href="<?php echo esc_url( $illdy_contact_bar_instagram_url ); ?>" title="<?php esc_attr_e( 'Instagram', 'illdy' ); ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a>
										<?php endif; ?>
										<?php if ( $illdy_contact_bar_youtube_url ) : ?>
											<a href="<?php echo esc_url( $illdy_contact_bar_youtube_url ); ?>" title="<?php esc_attr_e( 'YouTube', 'illdy' ); ?>" target="_blank"><i class="fa-brands fa-youtube"></i></a>
										<?php endif; ?>
										<?php if ( $illdy_contact_bar_vimeo_url ) : ?>
											<a href="<?php echo esc_url( $illdy_contact_bar_vimeo_url ); ?>" title="<?php esc_attr_e( 'Vimeo', 'illdy' ); ?>" target="_blank"><i class="fa-brands fa-vimeo"></i></a>
										<?php endif; ?>
									</div><!--/.contact-us-social-->
								<?php } ?>
							</div><!--/.col-sm-3-->
						</div><!--/.row-->
					</div><!--/.col-sm-12-->
				</div><!--/.row-->
				<div class="row">
					<div class="col-sm-12">
						<?php if ( $illdy_general_contact_form && 'default' !== $illdy_general_contact_form && get_post( $illdy_general_contact_form ) ) : ?>
							<?php $illdy_shortcode = defined( 'KALIFORMS_VERSION' ) ? '[kaliform id="' . esc_html( $illdy_general_contact_form ) . '"]' : '[contact-form-7 id="' . esc_html( $illdy_general_contact_form ) . '"]'; ?>
							<?php echo do_shortcode( $illdy_shortcode ); ?>
						<?php endif; ?>
					</div><!--/.col-sm-12-->
				</div><!--/.row-->
			</div><!--/.container-->
		</div><!--/.section-content-->
	</section><!--/#contact-us.front-page-section-->

<?php }
?>
