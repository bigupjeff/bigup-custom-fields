<?php
/**
 * Admin menu settings class.
 *
 * @package bigup_contact_form
 */

namespace Bigup\Custom_Fields;

use BigupWeb\Toecaps\Helpers;



/**
 * Build admin menu for theme.
 *
 * ### To retrieve values:
 * Serialized array of all options:
 *  - $tc_settings = get_option( 'tc_theme_array' );
 * Single Option:
 *  - $tc_email_address = $tc_settings['tc_email_address'];
 */
class Admin_Settings {


	/**
	 * Holds the options array for us in the admin area.
	 */
	private $tc_theme;


	/**
	 * Init the class.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'tc_theme_add_settings_menu' ) );
		add_action( 'admin_init', array( $this, 'tc_theme_settings_page_init' ) );
	}


	/**
	 * Add Toecaps admin menu option to sidebar
	 */
	public function tc_theme_add_settings_menu() {
		add_menu_page(
			'Toecaps Theme Settings',                     // page_title.
			'Toecaps',                                    // menu_title.
			'manage_options',                             // capability.
			'toecaps-settings',                           // menu_slug.
			array( $this, 'tc_theme_add_settings_page' ), // function.
			'dashicons-bigup-boot',                       // icon_url.
			4                                             // position.
		);
	}


	/**
	 * Create Toecaps Global Settings Page
	 */
	public function tc_theme_add_settings_page() {
		$this->tc_theme = get_option( 'tc_theme_array' ); ?>

		<div class="wrap">

			<h1>
				<span class="dashicons-bigup-boot" style="font-size: 2em; margin-right: 0.2em;"></span>
				Toecaps Settings
			</h1>

			<p>These settings manage content that appears on the front end of the Toecaps theme.</p>
			<p>After updating content in these fields, don't forget to click SAVE at the bottom of the page!</strong></p>

			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'tc_theme_group' );
					do_settings_sections( 'tc_theme_page' );
					submit_button();
				?>
			</form>
		</div>
		<?php
	}


	public function tc_theme_settings_page_init() {
		register_setting(
			'tc_theme_group', // option_group
			'tc_theme_array', // option_name
			array( $this, 'tc_theme_sanitize' ) // sanitize_callback
		);

		// ============================================================= Contact Section

		add_settings_section(
			'tc_theme_contact_section', // id
			'Contact Information', // title
			array( $this, 'tc_theme_contact_section_callback' ), // callback
			'tc_theme_page' // page
		);

			add_settings_field(
				'tc_email_address', // id
				'Email Address', // title
				array( $this, 'tc_email_address_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_contact_section' // section
			);

			add_settings_field(
				'tc_phone_number', // id
				'Phone Number', // title
				array( $this, 'tc_phone_number_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_contact_section' // section
			);

			add_settings_field(
				'tc_street_address', // id
				'Street Address', // title
				array( $this, 'tc_street_address_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_contact_section' // section
			);

			add_settings_field(
				'tc_openstreetmap', // id
				'OpenStreetMap URL', // title
				array( $this, 'tc_openstreetmap_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_contact_section' // section
			);

		// ============================================== Social Media and External Links

		add_settings_section(
			'tc_theme_social_section', // id
			'Social Media Links', // title
			array( $this, 'tc_theme_social_section_section_callback' ), // callback
			'tc_theme_page' // page
		);

			add_settings_field(
				'tc_social_url_facebook', // id
				'Social URL - Facebook', // title
				array( $this, 'tc_social_url_facebook_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_social_section' // section
			);

			add_settings_field(
				'tc_social_url_instagram', // id
				'Social URL - Instagram', // title
				array( $this, 'tc_social_url_instagram_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_social_section' // section
			);

			add_settings_field(
				'tc_social_url_pinterest', // id
				'Social URL - Pinterest', // title
				array( $this, 'tc_social_url_pinterest_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_social_section' // section
			);

			add_settings_field(
				'tc_social_url_linkedin', // id
				'Social URL - LinkedIn', // title
				array( $this, 'tc_social_url_linkedin_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_social_section' // section
			);

		// ============================================================= Homepage Section

		add_settings_section(
			'tc_theme_usp_section', // id
			'Unique Selling Point (USP) Settings', // title
			array( $this, 'tc_theme_usp_section_callback' ), // callback
			'tc_theme_page' // page
		);

			add_settings_field(
				'tc_usp_1_text', // id
				'USP 1 Text', // title
				array( $this, 'tc_usp_1_text_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_usp_section' // section
			);

			add_settings_field(
				'tc_usp_1_url', // id
				'USP 2 URL', // title
				array( $this, 'tc_usp_1_url_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_usp_section' // section
			);

			add_settings_field(
				'tc_usp_1_icon', // id
				'USP 1 Icon', // title
				array( $this, 'tc_usp_1_icon_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_usp_section' // section
			);

			add_settings_field(
				'tc_usp_2_text', // id
				'USP 2 Text', // title
				array( $this, 'tc_usp_2_text_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_usp_section' // section
			);

			add_settings_field(
				'tc_usp_2_url', // id
				'USP 2 URL', // title
				array( $this, 'tc_usp_2_url_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_usp_section' // section
			);

			add_settings_field(
				'tc_usp_2_icon', // id
				'USP 2 Icon', // title
				array( $this, 'tc_usp_2_icon_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_usp_section' // section
			);

			add_settings_field(
				'tc_usp_3_text', // id
				'USP 3 Text', // title
				array( $this, 'tc_usp_3_text_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_usp_section' // section
			);

			add_settings_field(
				'tc_usp_3_url', // id
				'USP 3 URL', // title
				array( $this, 'tc_usp_3_url_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_usp_section' // section
			);

			add_settings_field(
				'tc_usp_3_icon', // id
				'USP 3 Icon', // title
				array( $this, 'tc_usp_3_icon_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_usp_section' // section
			);

			add_settings_field(
				'tc_usp_4_text', // id
				'USP 4 Text', // title
				array( $this, 'tc_usp_4_text_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_usp_section' // section
			);

			add_settings_field(
				'tc_usp_4_url', // id
				'USP 4 URL', // title
				array( $this, 'tc_usp_4_url_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_usp_section' // section
			);

			add_settings_field(
				'tc_usp_4_icon', // id
				'USP 4 Icon', // title
				array( $this, 'tc_usp_4_icon_callback' ), // callback
				'tc_theme_page', // page
				'tc_theme_usp_section' // section
			);

	}

	public function tc_theme_sanitize( $input ) {
		$sanitary_values = array();

		if ( isset( $input['tc_email_address'] ) ) {
			$sanitary_values['tc_email_address'] = sanitize_email( $input['tc_email_address'] );
		}

		if ( isset( $input['tc_phone_number'] ) ) {
			$sanitary_values['tc_phone_number'] = Helpers::sanitise_phone_number( $input['tc_phone_number'] );
		}

		if ( isset( $input['tc_street_address'] ) ) {
			$sanitary_values['tc_street_address'] = sanitize_textarea_field( $input['tc_street_address'] );
		}

		if ( isset( $input['tc_openstreetmap'] ) ) {
			$sanitary_values['tc_openstreetmap'] = sanitize_text_field( urldecode( $input['tc_openstreetmap'] ) );
		}

		if ( isset( $input['tc_social_url_facebook'] ) ) {
			$sanitary_values['tc_social_url_facebook'] = sanitize_url( $input['tc_social_url_facebook'] );
		}

		if ( isset( $input['tc_social_url_instagram'] ) ) {
			$sanitary_values['tc_social_url_instagram'] = sanitize_url( $input['tc_social_url_instagram'] );
		}

		if ( isset( $input['tc_social_url_pinterest'] ) ) {
			$sanitary_values['tc_social_url_pinterest'] = sanitize_url( $input['tc_social_url_pinterest'] );
		}

		if ( isset( $input['tc_social_url_linkedin'] ) ) {
			$sanitary_values['tc_social_url_linkedin'] = sanitize_url( $input['tc_social_url_linkedin'] );
		}

		if ( isset( $input['tc_usp_1_text'] ) ) {
			$sanitary_values['tc_usp_1_text'] = sanitize_text_field( $input['tc_usp_1_text'] );
		}

		if ( isset( $input['tc_usp_1_url'] ) ) {
			$sanitary_values['tc_usp_1_url'] = sanitize_url( $input['tc_usp_1_url'] );
		}

		if ( isset( $input['tc_usp_1_icon'] ) ) {
			$sanitary_values['tc_usp_1_icon'] = Helpers::sanitise_classes( $input['tc_usp_1_icon'] );
		}

		if ( isset( $input['tc_usp_2_text'] ) ) {
			$sanitary_values['tc_usp_2_text'] = sanitize_text_field( $input['tc_usp_2_text'] );
		}

		if ( isset( $input['tc_usp_2_url'] ) ) {
			$sanitary_values['tc_usp_2_url'] = sanitize_url( $input['tc_usp_2_url'] );
		}

		if ( isset( $input['tc_usp_2_icon'] ) ) {
			$sanitary_values['tc_usp_2_icon'] = Helpers::sanitise_classes( $input['tc_usp_2_icon'] );
		}

		if ( isset( $input['tc_usp_3_text'] ) ) {
			$sanitary_values['tc_usp_3_text'] = sanitize_text_field( $input['tc_usp_3_text'] );
		}

		if ( isset( $input['tc_usp_3_url'] ) ) {
			$sanitary_values['tc_usp_3_url'] = sanitize_url( $input['tc_usp_3_url'] );
		}

		if ( isset( $input['tc_usp_3_icon'] ) ) {
			$sanitary_values['tc_usp_3_icon'] = Helpers::sanitise_classes( $input['tc_usp_3_icon'] );
		}

		if ( isset( $input['tc_usp_4_text'] ) ) {
			$sanitary_values['tc_usp_4_text'] = sanitize_text_field( $input['tc_usp_4_text'] );
		}

		if ( isset( $input['tc_usp_4_url'] ) ) {
			$sanitary_values['tc_usp_4_url'] = sanitize_url( $input['tc_usp_4_url'] );
		}

		if ( isset( $input['tc_usp_4_icon'] ) ) {
			$sanitary_values['tc_usp_4_icon'] = Helpers::sanitise_classes( $input['tc_usp_4_icon'] );
		}

		return $sanitary_values;
	}

	// ========================================================= Section Descriptions

	public function tc_theme_contact_section_callback() {
		echo '<p>Contact Information displayed across the website. Put each line
                 of the street address on a new line as it will appear this way
                 on the front end.</p>';
	}

	public function tc_theme_social_section_section_callback() {
		echo '<p>Configure external links for social accounts including "https://".</p>';
	}

	public function tc_theme_usp_section_callback() {
		echo '<p>The unique selling points and their icons. The icon should be a valid FontAwesome
				icon class e.g "fa-solid fa-alarm-clock" without quotations.</p>
				<p>Visit <a target="_blank" href="https://fontawesome.com/icons">FontAwesome</a> to search available
				icons and find their classes.</p>';
	}

	public function tc_email_address_callback() {
		printf(
			'<input class="regular-text" type="email" name="tc_theme_array[tc_email_address]" id="tc_email_address" value="%s">',
			isset( $this->tc_theme['tc_email_address'] ) ? esc_attr( $this->tc_theme['tc_email_address'] ) : ''
		);
	}

	public function tc_phone_number_callback() {
		printf(
			'<input class="regular-text" type="tel" pattern="[0-9 ]+" name="tc_theme_array[tc_phone_number]" id="tc_phone_number" value="%s">',
			isset( $this->tc_theme['tc_phone_number'] ) ? esc_attr( $this->tc_theme['tc_phone_number'] ) : ''
		);
	}

	public function tc_street_address_callback() {
		printf(
			'<textarea class="regular-text" rows="8" cols="50" name="tc_theme_array[tc_street_address]" id="tc_street_address">%s</textarea>',
			isset( $this->tc_theme['tc_street_address'] ) ? esc_textarea( $this->tc_theme['tc_street_address'] ) : ''
		);
	}

	public function tc_openstreetmap_callback() {
		printf(
			'<input class="regular-text" type="url" name="tc_theme_array[tc_openstreetmap]" id="tc_openstreetmap" value="%s">',
			isset( $this->tc_theme['tc_openstreetmap'] ) ? esc_url_raw( $this->tc_theme['tc_openstreetmap'] ) : ''
		);
	}

	public function tc_social_url_facebook_callback() {
		printf(
			'<input class="regular-text" type="url" name="tc_theme_array[tc_social_url_facebook]" id="tc_social_url_facebook" value="%s">',
			isset( $this->tc_theme['tc_social_url_facebook'] ) ? esc_url( $this->tc_theme['tc_social_url_facebook'] ) : ''
		);
	}

	public function tc_social_url_instagram_callback() {
		printf(
			'<input class="regular-text" type="url" name="tc_theme_array[tc_social_url_instagram]" id="tc_social_url_instagram" value="%s">',
			isset( $this->tc_theme['tc_social_url_instagram'] ) ? esc_url( $this->tc_theme['tc_social_url_instagram'] ) : ''
		);
	}

	public function tc_social_url_pinterest_callback() {
		printf(
			'<input class="regular-text" type="url" name="tc_theme_array[tc_social_url_pinterest]" id="tc_social_url_pinterest" value="%s">',
			isset( $this->tc_theme['tc_social_url_pinterest'] ) ? esc_url( $this->tc_theme['tc_social_url_pinterest'] ) : ''
		);
	}

	public function tc_social_url_linkedin_callback() {
		printf(
			'<input class="regular-text" type="url" name="tc_theme_array[tc_social_url_linkedin]" id="tc_social_url_linkedin" value="%s">',
			isset( $this->tc_theme['tc_social_url_linkedin'] ) ? esc_url( $this->tc_theme['tc_social_url_linkedin'] ) : ''
		);
	}

	public function tc_usp_1_text_callback() {
		printf(
			'<input class="regular-text" type="text" name="tc_theme_array[tc_usp_1_text]" id="tc_usp_1_text" value="%s">',
			isset( $this->tc_theme['tc_usp_1_text'] ) ? esc_attr( $this->tc_theme['tc_usp_1_text'] ) : ''
		);
	}

	public function tc_usp_1_url_callback() {
		printf(
			'<input class="regular-text" type="text" name="tc_theme_array[tc_usp_1_url]" id="tc_usp_1_url" value="%s">',
			isset( $this->tc_theme['tc_usp_1_url'] ) ? esc_attr( $this->tc_theme['tc_usp_1_url'] ) : ''
		);
	}

	public function tc_usp_1_icon_callback() {
		printf(
			'<input class="regular-text" type="text" name="tc_theme_array[tc_usp_1_icon]" id="tc_usp_1_icon" value="%s">',
			isset( $this->tc_theme['tc_usp_1_icon'] ) ? esc_attr( $this->tc_theme['tc_usp_1_icon'] ) : ''
		);
	}

	public function tc_usp_2_text_callback() {
		printf(
			'<input class="regular-text" type="text" name="tc_theme_array[tc_usp_2_text]" id="tc_usp_2_text" value="%s">',
			isset( $this->tc_theme['tc_usp_2_text'] ) ? esc_attr( $this->tc_theme['tc_usp_2_text'] ) : ''
		);
	}

	public function tc_usp_2_url_callback() {
		printf(
			'<input class="regular-text" type="text" name="tc_theme_array[tc_usp_2_url]" id="tc_usp_2_url" value="%s">',
			isset( $this->tc_theme['tc_usp_2_url'] ) ? esc_attr( $this->tc_theme['tc_usp_2_url'] ) : ''
		);
	}

	public function tc_usp_2_icon_callback() {
		printf(
			'<input class="regular-text" type="text" name="tc_theme_array[tc_usp_2_icon]" id="tc_usp_2_icon" value="%s">',
			isset( $this->tc_theme['tc_usp_2_icon'] ) ? esc_attr( $this->tc_theme['tc_usp_2_icon'] ) : ''
		);
	}

	public function tc_usp_3_text_callback() {
		printf(
			'<input class="regular-text" type="text" name="tc_theme_array[tc_usp_3_text]" id="tc_usp_3_text" value="%s">',
			isset( $this->tc_theme['tc_usp_3_text'] ) ? esc_attr( $this->tc_theme['tc_usp_3_text'] ) : ''
		);
	}

	public function tc_usp_3_url_callback() {
		printf(
			'<input class="regular-text" type="text" name="tc_theme_array[tc_usp_3_url]" id="tc_usp_3_url" value="%s">',
			isset( $this->tc_theme['tc_usp_3_url'] ) ? esc_attr( $this->tc_theme['tc_usp_3_url'] ) : ''
		);
	}

	public function tc_usp_3_icon_callback() {
		printf(
			'<input class="regular-text" type="text" name="tc_theme_array[tc_usp_3_icon]" id="tc_usp_3_icon" value="%s">',
			isset( $this->tc_theme['tc_usp_3_icon'] ) ? esc_attr( $this->tc_theme['tc_usp_3_icon'] ) : ''
		);
	}

	public function tc_usp_4_text_callback() {
		printf(
			'<input class="regular-text" type="text" name="tc_theme_array[tc_usp_4_text]" id="tc_usp_4_text" value="%s">',
			isset( $this->tc_theme['tc_usp_4_text'] ) ? esc_attr( $this->tc_theme['tc_usp_4_text'] ) : ''
		);
	}

	public function tc_usp_4_url_callback() {
		printf(
			'<input class="regular-text" type="text" name="tc_theme_array[tc_usp_4_url]" id="tc_usp_4_url" value="%s">',
			isset( $this->tc_theme['tc_usp_4_url'] ) ? esc_attr( $this->tc_theme['tc_usp_4_url'] ) : ''
		);
	}

	public function tc_usp_4_icon_callback() {
		printf(
			'<input class="regular-text" type="text" name="tc_theme_array[tc_usp_4_icon]" id="tc_usp_4_icon" value="%s">',
			isset( $this->tc_theme['tc_usp_4_icon'] ) ? esc_attr( $this->tc_theme['tc_usp_4_icon'] ) : ''
		);
	}

}//end class
