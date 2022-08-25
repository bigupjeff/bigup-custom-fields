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

	private $post_type;
	private $custom_post_args;
	private $post_settings;
	private $post_options;

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
					$callback,           // $callback.
					$page_slug           // $page.
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
	 */
	public function build_custom_post_forms( $settings_json, $post_type ) {

		$this->post_settings = json_decode( $settings_json, true );
		$this->post_type     = $post_type;
		$page_slug           = $this->post_settings['slug'];
		$group               = $this->post_settings['group'];
		$this->post_options  = get_option( $group );

		if ( isset( $this->post_options[ $this->post_type ] ) ) {
			$values              = $this->post_options[ $this->post_type ];
			$values['post_type'] = $this->post_type;
		} else {
			$values = array();
		}

		register_setting(
			$group,                                                           // Option group.
			$group,                                                           // Option name.
			array(
				'sanitize_callback' => array( $this, 'scrape_and_sanitize' ), // Sanitize function.
				'show_in_rest'      => true,                                  // Available to REST?
				'show_in_graphql'   => true,                                  // Available to GraphQL?
			)
		);

		$this->custom_post_args = array();

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
				$callback,           // Callback.
				$page_slug           // Page.
			);

			foreach ( $section['settings'] as $setting ) { // Options.

				array_push( $this->custom_post_args, $setting['id'] );

				$value           = isset( $values[ $setting['id'] ] ) ? $values[ $setting['id'] ] : $setting['default'];
				$output_callback = function() use ( $setting, $value ) {
					echo Get_Input::markup( $setting, $value );
				};
				add_settings_field(
					$setting['id'],    // ID.
					$setting['label'], // Title.
					$output_callback,    // Callback.
					$page_slug,          // Page.
					$section['id']     // Section.
				);
			};
		};
	}


	/**
	 * Scrape and Sanitize Custom Post Form.
	 *
	 * $this->post_settings    - An array of form settings objects.
	 * $this->custom_post_args - An array of form settings IDs to use as keys.
	 */
	public function scrape_and_sanitize( $input ) {


		// $input is NULL. Check how to scrape input values ready for sanitize and save.
		var_dump( $input );


		$option = array();

		foreach ( $this->post_settings['sections'] as $section ) {
			foreach ( $section['settings'] as $setting ) {

				$sanitize_type = $setting['sanitize_type'];
				$input_value   = $input[ $setting['id'] ];

				if ( 'post_type' === $setting['id'] ) {
					$option[ $setting[ id ] ] = Sanitize::get_sanitized( $sanitize_type, $input_value );
				} else {
					$option['args'][ $setting[ id ] ] = Sanitize::get_sanitized( $sanitize_type, $input_value );
				}
			};
		};

		printf( $option );

		/*
		if ( isset( $sanitized[ $post_type ] ) ) {

			$options = [];
			foreach ( $sanitized as $key => $value ) {
				if ( 'post_type' === $key ) {
					$options[ 'post_type' ] = $value;
				} else {
					$options[ 'args' ][ $key ] = $value;
				}
			}

			$this->post_options[ $this->post_type ] = $options;

		}


		printf( $this->post_options );




		return $this->post_options;
		*/
		/*
		 Expected array values.
			$sanitized[ 'post_type' ]
			$sanitized[ 'has_archive' ]
			$sanitized[ 'public' ]
			$sanitized[ 'show_in_menu' ]
			$sanitized[ 'menu_position' ]
			$sanitized[ 'menu_icon' ]
			$sanitized[ 'hierarchical' ]
			$sanitized[ 'taxonomies' ]
			$sanitized[ 'show_in_rest' ]
			$sanitized[ 'show_in_graphql' ]
			$sanitized[ 'name_plural' ]
			$sanitized[ 'name_singular' ]
			$sanitized[ 'delete_with_user' ]
		*/
	}


}//end class
