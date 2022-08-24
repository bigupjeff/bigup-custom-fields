<?php
namespace Bigup\Custom_Fields;

/**
 * Bigup Custom Fields - Process Options.
 *
 * Handles procssing options to output in admin pages.
 *
 * @package bigup_custom_fields
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 * @license GPL2+
 * @link https://jeffersonreal.uk
 * 
 */

class Process_Options {

	private $array;

	/**
	 * Build Options
	 * 
	 * This function accepts a json options object and builds a settings page.
	 * 
	 * **WP Functions**
	 * add_settings_section( $id, $title, $callback, $page )
	 * add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array() )
	 * register_setting( $option_group, $option_name, $args )
	 */
	public static function build_from_json( $options_json ) {
		$options = json_decode( $options_json, true );

		foreach( $options[ 'pages' ] as $page ) { // Pages.
			$page_slug = $page[ 'slug' ];
			$group     = $page[ 'group' ];

			foreach( $page[ 'sections' ] as $section ) { // Sections.
				$html = $section[ 'description_html' ];
				$callback = function() use ( $html ) {
					if ( null === $html ) return;
					echo $html;
				};
				add_settings_section(
					$section[ 'id' ],    // ID.
					$section[ 'title' ], // Title.
					$callback,           // Callback.
					$page_slug           // Page.
				);

				foreach( $section[ 'options' ] as $option ) { // Options.

					$output_callback = function() use ( $option ) {
						echo Get_Input::markup( $option );
					};
					add_settings_field(
						$option[ 'id' ],    // ID.
						$option[ 'label' ], // Title.
						$output_callback,   // Callback.
						$page_slug,         // Page.
						$section[ 'id' ]    // Section.
					);
					register_setting(
						$group,
						$option[ 'id' ],
						[
							'type'              => $option[ 'var_type' ],
							'description'       => $option[ 'description' ],
							'sanitize_callback' => Sanitize::get_callback( $option[ 'sanitize_type' ] ),
							'show_in_rest'      => $option[ 'show_in_rest' ],
							'show_in_graphql'   => $option[ 'show_in_graphql' ],
							'default'           => $option[ 'default' ],
						]
					);
				};
			};
		};
	}


	/**
	 * Build Serialized Options
	 * 
	 * This function accepts a json options object and builds a settings page. The options will
	 * be saved and read from a single serialized option array.
	 * 
	 * **WP Functions**
	 * add_settings_section( $id, $title, $callback, $page )
	 * add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array() )
	 * register_setting( $option_group, $option_name, $args )
	 */
	public static function build_from_json_serialized( $options_json ) {

		// Temp
		$values_json = file_get_contents( BIGUP_CUSTOM_FIELDS_PLUGIN_PATH . 'data/example-custom-post.json' );
		$values      = json_decode( $values_json, true );

/*
		"options": [
			"id": "post_type",
			"id": "has_archive",
			"id": "public",
			"id": "show_in_menu",
			"id": "menu_position",
			"id": "menu_icon",
			"id": "hierarchical",
			"id": "taxonomies",
			"id": "show_in_rest",
			"id": "show_in_graphql",
			"id": "name_plural"
			"id": "name_singular"
			"id": "delete_with_user"
		]
*/













		$options   = json_decode( $options_json, true );
		$page_slug = $options[ 'slug' ];
		$group     = $options[ 'group' ];
		$serialize = $options[ 'serialize' ];

		if ( $serialize ) {
			$this->array = get_option( $group );
		} else {
			error.log( $group . ' was not flagged as serializable. Is the correct json file being passed?' );
		}

		foreach( $group[ 'sections' ] as $section ) { // Sections.
			$html = $section[ 'description_html' ];
			$callback = function() use ( $html ) {
				if ( null === $html ) return;
				echo $html;
			};
			add_settings_section(
				$section[ 'id' ],    // ID.
				$section[ 'title' ], // Title.
				$callback,           // Callback.
				$page_slug           // Page.
			);

			foreach( $section[ 'options' ] as $option ) { // Options.


				$value = isset( $values ) ? esc_attr( $values['tc_email_address'] ) : null;


				$output_callback = function() use ( $option, $value ) {
					echo Get_Input::markup( $option, $value );
				};
				add_settings_field(
					$option[ 'id' ],    // ID.
					$option[ 'label' ], // Title.
					$output_callback,   // Callback.
					$page_slug,         // Page.
					$section[ 'id' ]    // Section.
				);
				register_setting(
					$group,
					$option[ 'id' ],
					[
						'type'              => $option[ 'var_type' ],
						'description'       => $option[ 'description' ],
						'sanitize_callback' => Sanitize::get_callback( $option[ 'sanitize_type' ] ),
						'show_in_rest'      => $option[ 'show_in_rest' ],
						'show_in_graphql'   => $option[ 'show_in_graphql' ],
						'default'           => $option[ 'default' ],
					]
				);
			};
		};
	}


}// Class end
