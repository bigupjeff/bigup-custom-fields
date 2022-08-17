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
				add_settings_section( $section[ 'id' ], $section[ 'title' ], $callback, $page_slug );

				foreach( $section[ 'options' ] as $option ) { // Options.
					$t = $option[ 'input_type' ];
					$n = $option[ 'name' ];
					$r = $option[ 'required' ];
					$output_callback = function() use ( $t, $n, $r ) {
						echo "<input type=\"{$t}\" name=\"{$n}\" id=\"{$n}\" value=\"" . get_option( $n ) . "\" {$r}>";
					};
					add_settings_field(
						$option[ 'name' ],
						$option[ 'label' ],
						$output_callback,
						$page_slug,
						$section[ 'id' ]
					);
					register_setting(
						$group,
						$option[ 'name' ],
						[
							'type'              => $option[ 'var_type' ],
							'description'       => $option[ 'description' ],
							'sanitize_callback' => Sanitize::get_callback( $option[ 'sanitize_type' ] ),
							'show_in_rest'      => $option[ 'show_in_rest' ],
							'default'           => $option[ 'default' ],
						]
					);
				};
			};
		};
	}


}// Class end