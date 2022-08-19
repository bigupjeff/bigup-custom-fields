<?php
namespace Bigup\Custom_Fields;

/**
 * Bigup Custom Fields - Process Options.
 *
 * Handles procssing options to output in admin pages.
 *
 * @package bigup_custom_fields
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2021, Jefferson Real
 * @license GPL2+
 * @link https://jeffersonreal.uk
 * 
 */

class Process_Options {


	/**
	 * Build Options
	 * 
	 * This function accepts an array of options and builds the settings page.
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
					$id   = $option[ 'id' ];
					$args = $option[ 'input_args' ];

error_log( Get_Input::markup( $id, $args ) );

					$output_callback = function() use ( $id, $args ) {
						echo Get_Input::markup( $id, $args );
					};
					add_settings_field(
						$option[ 'id' ],  // ID.
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


}// Class end
