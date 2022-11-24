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
	private $group;
	private $options_array_name;

	public function __construct() {
		$settings_json            = file_get_contents( BIGUP_CUSTOM_FIELDS_PLUGIN_PATH . 'data/settings-custom-post-type.json' );
		$this->post_settings      = json_decode( $settings_json, true );
		$this->group              = $this->post_settings['group'];
		$this->options_array_name = $this->group . '-options';
		$this->posts_option       = get_option( $this->options_array_name );
	}

	/**
	 * Build From JSON
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
	 * Build Custom Post Forms
	 *
	 * Output the settings form for new custom post types.
	 *
	 *
	 * Also creates a form to edit an existing custom post type if the post type key is passed. This
	 * could be used of the form was generated via ajax/fetch. It may be removed as the plan is to
	 * send all setting data to the front end using localize script. In this case, this function only
	 * ever needs to generate a form with default values.
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
	public function build_custom_post_forms( $post_type = null ) {

		$post_settings       = $this->post_settings;
		$posts_option        = $this->posts_option;
		$page_slug           = $post_settings['slug'];
		$group               = $this->group;
		$options_array_name  = $this->options_array_name;

		$values = isset( $posts_option[ $post_type ] ) ? $posts_option : array();

		register_setting(
			$group,                                                // Option group.
			$options_array_name,                                   // Option name.
			array(
				'sanitize_callback' => array( $this, 'sanitize' ), // Sanitize function.
				'show_in_rest'      => true,                       // Available to REST?
				'show_in_graphql'   => true,                       // Available to GraphQL?
			)
		);

		foreach ( $post_settings['sections'] as $section ) { // Sections.
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

				$id    = $setting['id'];
				$value = isset( $values[ $post_type ][ $id ] )
							? $values[ $post_type ][ $id ]
							: $setting['default'];

				if ( 'select' === $setting['input_type']
				&& true === ! ! $setting['select_multi'] ) {
					$html_name_attr = $options_array_name . '[' . $id . '][]';
				} else {
					$html_name_attr = $options_array_name . '[' . $id . ']';
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
	 */
	public function sanitize( $input ) {

		$posts_option  = $this->posts_option;
		$post_settings = $this->post_settings;

//DEBUG
error_log( '### DEBUG ###' );
$out = var_dump( $input );
error_log( json_encode($input) );

		if ( ! is_array( $input ) || ! isset( $input ) ) {
			add_settings_error(
				$post_settings['group'],
				'submitted-form-inputs',
				'Bigup Web Error: Unexpected option values recieved. Please report this error to the plugin developer.',
				'error'
			);
			return;
		}


		if ( isset( $input['delete'] ) ) {
			add_settings_error(
				$post_settings['group'],
				'submitted-delete-request',
				'Custom post type deleted successfully.',
				'success'
			);
			return;
		}





		// Grab the existing option with array of ALL post types.
		$option = ( is_array( $posts_option ) ) ? $posts_option : array();

		foreach ( $post_settings['sections'] as $section ) {
			foreach ( $section['settings'] as $setting ) {

				$id            = $setting['id'];
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

					// TO FIX: This only works if post_type is the first value in array.
					$post_type                         = $sanitized_value;
				} else {
					$option[ $post_type ][ $id ] = $sanitized_value;
				}
// DEBUG
error_log( json_encode( $option[ $post_type ][ $id ] ) );

			};
		};

// DEBUG
error_log( json_encode( $option ));
		return $option;
	}


	/**
	 * Output the settings fields for a section wrapped in divs.
	 *
	 * This mimics most of the functionality of WP do_settings_sections() and do_settings_fields()
	 * which wrap settings in a table by default.
	 *
	 * @param string $page Slug title of the admin page.
	 * @param string $section Slug title of the settings section.
	 */
	public static function do_settings_in_divs( $page ) {
		global $wp_settings_sections, $wp_settings_fields;

		if ( ! isset( $wp_settings_sections[ $page ] ) ) {
			return;
		}

		foreach ( (array) $wp_settings_sections[ $page ] as $section) {

			if ( ! isset( $wp_settings_fields[ $page ][ $section[ 'id' ] ] ) ) {
				return;
			}

			foreach ( (array) $wp_settings_fields[ $page ][ $section[ 'id' ] ] as $field ) {

				// Hide $post_type which should not be edited by the user.
				if ( 'post_type' !== $field['id'] ) {
					echo '<label class="field">';
					echo '<span class="field_title">' . $field['title'] . '</span>';
					call_user_func( $field['callback'], $field['args'] );
					echo '</label>';

				} else {
					call_user_func( $field['callback'], $field['args'] );

				}
			}
		}
	}
}
