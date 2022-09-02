<?php
namespace Bigup\Custom_Fields;

/**
 * Bigup Custom Fields - Process Settings.
 *
 * Handles processing settings to output in admin pages.
 *
 * @package bigup_custom_fields
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 * @license GPL2+
 * @link https://jeffersonreal.uk
 */
class Process_Settings {

	private $post_settings;
	private $posts_option;

	/**
	 * Build Settings
	 *
	 * This function accepts a json settings object and builds a settings page.
	 *
	 * **WP Functions**
	 * add_settings_section( $id, $title, $callback, $page )
	 * add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array() )
	 * register_setting( $setting_group, $setting_name, $args )
	 *
	 * @param string $settings_json - JSON object formatted settings.
	 */
	public static function build_from_json( $settings_json ) {
		$settings = json_decode( $settings_json, true );

		foreach ( $settings['pages'] as $page ) { // Pages.
			$page_slug = $page['slug'];
			$group     = $page['group'];

			foreach ( $page['sections'] as $section ) { // Sections.
				$html     = $section['description_html'];
				$callback = function() use ( $html ) {
					if ( null === $html ) {
						return;
					}
					echo $html;
				};
				add_settings_section(
					$section['id'],    // $id.
					$section['title'], // $title.
					$callback,         // $callback.
					$page_slug         // $page.
				);

				foreach ( $section['settings'] as $setting ) { // Options.

					$option          = get_option( $setting['id'] );
					$value           = ( $option ) ? $option : null;
					$output_callback = function() use ( $setting, $value ) {
						echo Get_Input::markup( $setting, $value );
					};
					add_settings_field(
						$setting['id'],    // $id.
						$setting['label'], // $title.
						$output_callback,    // $callback.
						$page_slug,          // $page.
						$section['id']     // $section
					);

					register_setting(
						$group,           // $setting_group.
						$setting['id'], // $setting_name.
						array(                 // $args.
							'type'              => $setting['var_type'],
							'description'       => $setting['description'],
							'sanitize_callback' => Sanitize::get_callback( $setting['sanitize_type'] ),
							'show_in_rest'      => $setting['show_in_rest'],
							'show_in_graphql'   => $setting['show_in_graphql'],
							'default'           => $setting['default'],
						)
					);
				};
			};
		};
	}


	/**
	 * Build Serialized Settings
	 *
	 * This function accepts a json settings object and builds a settings page. The settings will
	 * be built from json and the option values will be populated from a single serialized option
	 * array.
	 *
	 * WP Lingo
	 * Options === Data from databse (values)
	 * Settings === Form field inputs
	 *
	 * **WP Functions**
	 * add_settings_section( $id, $title, $callback, $page )
	 * add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array() )
	 * register_setting( $setting_group, $setting_name, $args )
	 *
	 * @param string $settings_json - JSON object formatted settings.
	 * @param string $post_type     - The post type key (optional).
	 */
	public function build_custom_post_forms( $settings_json, $post_type = null ) {

		$this->post_settings = json_decode( $settings_json, true );
		$page_slug           = $this->post_settings['slug'];
		$group               = $this->post_settings['group'];
		$options_array_name  = $group . '-options';
		$this->posts_option  = get_option( $options_array_name );

		$values = isset( $this->posts_option[ $post_type ] ) ? $this->posts_option : array();

		register_setting(
			$group,                                                // Option group.
			$options_array_name,                                   // Option name.
			array(
				'sanitize_callback' => array( $this, 'sanitize' ), // Sanitize function.
				'show_in_rest'      => true,                       // Available to REST?
				'show_in_graphql'   => true,                       // Available to GraphQL?
			)
		);

		foreach ( $this->post_settings['sections'] as $section ) { // Sections.
			$html     = $section['description_html'];
			$callback = function() use ( $html ) {
				if ( null === $html ) {
					return;
				}
				echo $html;
			};

			add_settings_section(
				$section['id'],    // ID.
				$section['title'], // Title.
				$callback,         // Callback.
				$page_slug         // Page.
			);

			foreach ( $section['settings'] as $setting ) { // Options.
				$id = $setting['id'];

				if ( 'post_type' === $id ) {
					$value = isset( $values[ $post_type ][ $id ] )
								? $values[ $post_type ]['post_type']
								: $setting['default'];
				} else {
					$value = isset( $values[ $post_type ]['args'][ $id ] )
								? $values[ $post_type ]['args'][ $id ]
								: $setting['default'];
				}


				if ( 'select' === $setting['input_type']
				&& true === !! $setting['select_multi'] ) {
					$html_name_attr  = $options_array_name . '[' . $id . '][]';
				} else {
					$html_name_attr  = $options_array_name . '[' . $id . ']';
				}
				$output_callback = function() use ( $setting, $value, $html_name_attr ) {
					echo Get_Input::markup( $setting, $value, $html_name_attr );
				};
				add_settings_field(
					$id,               // ID.
					$setting['label'], // Title.
					$output_callback,  // Callback.
					$page_slug,        // Page.
					$section['id']     // Section.
				);

			};
		};
	}


	/**
	 * Scrape and Sanitize Custom Post Form.
	 *
	 * $this->post_settings    - An array of form settings objects.
	 */
	public function sanitize( $input ) {

		if ( ! is_array( $input ) || ! isset( $input ) ) {
			add_settings_error(
				$this->post_settings['group'],
				$this->post_settings['group'],
				'Bigup Web Error: Unexpected option values recieved. Please report this error to the plugin developer.'
			);
			return;
		}

		$option = array();

		foreach ( $this->post_settings['sections'] as $section ) {
			foreach ( $section['settings'] as $setting ) {
				$id = $setting['id'];

				$sanitize_type = $setting['sanitize_type'];
				$input_value   = isset( $input[ $id ] ) ? $input[ $id ] : null;

				if ( isset( $setting['required'] )
					&& 'required' === $setting['required']
					&& 'checkbox' !== $setting['input_type']
					&& ! isset( $input_value ) ) {

					add_settings_error(
						$id,
						$id,
						"{$setting['label']} is a required field. Please complete this field and try again."
					);
					return;
				}

				$sanitized_value = Sanitize::get_sanitized( $sanitize_type, $input_value );
				if ( 'post_type' === $id ) {
					$option[ $sanitized_value ][ $id ] = $sanitized_value;
					$post_type = $sanitized_value;
				} else {
					$option[ $post_type ]['args'][ $id ] = $sanitized_value;
				}
			};
		};

		return $option;
	}


}//end class
