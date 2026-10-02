<?php

/**
 *  Custom Control: Kaliforms
 */
if ( ! class_exists( 'Illdy_Kaliforms_Custom_Control' ) ) {
	class Illdy_Kaliforms_Custom_Control extends WP_Customize_Control {
		/**
		 * Returns true / false if the plugin: Kaliforms is activated;
		 *
		 * This right here disables the control for selecting a contact form IF the plugin isn\'t active
		 *
		 * @since Pixova Lite 1.15
		 *
		* @return bool
		 */
		public function active_callback() {

			return defined( 'KALIFORMS_VERSION' );
		}

		public function get_kaliforms_forms() {

			// no more php warnings
			$contact_forms = array();

			// check if Kaliforms is activated
			if ( $this->active_callback() ) {

				$kali_forms = get_posts(
					array(
						'post_type'      => 'kaliforms_forms',
						'post_status'    => 'publish',
						'posts_per_page' => 100,
					)
				);
				if ( $kali_forms ) {
					foreach ( $kali_forms as $kali_form ) {
						$contact_forms[ $kali_form->ID ] = $kali_form->post_title;
					}
				} else {
					$contact_forms[0] = __( 'No contact forms found', 'illdy' );
				}
			}
			return $contact_forms;
		}

		public function render_content() {
			$contact_forms = $this->get_kaliforms_forms();

			if ( empty( $contact_forms ) ) {
				return;
			}

			// The saved form was never marked selected, so the picker always showed
			// "Select your contact form" and saving anything else reset it.
			$current = (string) $this->value();
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> style="width:100%;">
					<option value="default"<?php selected( $current, 'default' ); ?>><?php esc_html_e( 'Select your contact form', 'illdy' ); ?></option>
					<?php foreach ( $contact_forms as $form_id => $form_title ) : ?>
						<option value="<?php echo esc_attr( $form_id ); ?>"<?php selected( $current, (string) $form_id ); ?>><?php echo esc_html( $form_title ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
			<?php
		}
	}
}
