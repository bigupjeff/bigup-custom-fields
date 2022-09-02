<?php
namespace Bigup\Custom_Fields;

/**
 * Bigup Custom Fields - Form Fields.
 *
 * A library of admin form input fields.
 *
 * @package bigup_custom_fields
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 * @license GPL2+
 * @link https://jeffersonreal.uk
 */

class Get_Input {

	/**
 	 * Return HTML markup for the passed setting object and option value.
 	 */
	public static function markup( $setting, $value, $name_attr = null ) {

		$name = $name_attr ? $name_attr : $setting[ 'id' ];

		switch ( $setting[ 'input_type' ] ) {

			case 'text':
				return sprintf(
					'<input type="%s" name="%s" id="%s" value="%s" required>',
					$setting[ 'input_type' ],
					$name,
					$setting[ 'id' ],
					$value,
					$setting[ 'required' ]
				);

			case 'textarea':
				return sprintf(
					'<textarea name="%s" id="%s" %s>%s</textarea>',
					$name,
					$setting[ 'id' ],
					$setting[ 'required' ],
					$value
				);

			case 'password':
				return sprintf(
					'<input type="%s" name="%s" id="%s" value="%s" %s>',
					$setting[ 'input_type' ],
					$name,
					$setting[ 'id' ],
					$value,
					$setting[ 'required' ]
				);

			case 'email':
				return sprintf(
					'<input type="%s" name="%s" id="%s" value="%s" %s>',
					$setting[ 'input_type' ],
					$name,
					$setting[ 'id' ],
					$value,
					$setting[ 'required' ]
				);

			case 'number':
				return sprintf(
					'<input type="%s" name="%s" id="%s" min="%s" max="%s" step="%s" value="%s" %s>',
					$setting[ 'input_type' ],
					$name,
					$setting[ 'id' ],
					$setting[ 'number_min' ],
					$setting[ 'number_max' ],
					$setting[ 'number_step' ],
					$value,
					$setting[ 'required' ]
				);

			case 'checkbox':
				return sprintf(
					'<input type="%s" name="%s" id="%s" value="%s" %s>',
					$setting[ 'input_type' ],
					$name,
					$setting[ 'id' ],
					1,
					$s = ( $value ) ? 'checked' : ''
				);

			case 'select':
				return sprintf(
					'<select name="%s" id="%s" %s>%s</select>',
					$name,
					$setting['id'],
					$setting['select_multi'],
					self::get_select_data( $setting[ 'select_type' ], $value )
				);

			default:
				return sprintf(
					'<b>PLUGIN ERROR: No input type "%s" for setting ID "%s"!</b>',
					$setting[ 'input_type' ],
					$setting[ 'id' ]
				);
		}
	}

	/**
	 * Return HTML select options markup for the passed select type.
	 */
	public static function get_select_data( $select_type, $selected_options ) {
		$markup = "\n";

		if ( 'taxonomies' === $select_type ) {
			$markup = $markup . '<option value="" disabled>--</option>' . "\n";

			$selected_options = is_array( $selected_options ) ? $selected_options : array();
			$all_post_types   = get_post_types();
			$post_taxonomies  = get_object_taxonomies( $all_post_types, 'names' );

			foreach ( $post_taxonomies as $taxonomy ) {
				if ( in_array( $taxonomy, $selected_options, true ) ) {
					$selected = ' selected';
				} else {
					$selected = '';
				}
				$markup = $markup . '<option value="' . $taxonomy . '"' . $selected . '>' . $taxonomy . '</option>' . "\n";
			}

		} else {
			$options_json = file_get_contents( BIGUP_CUSTOM_FIELDS_PLUGIN_PATH . 'data/select-options-' . $select_type . '.json' );
			if ( false === !! $options_json ) {
				return error_log( 'Bigup Web: get_select_data file not found' );
			}

			$options          = json_decode( $options_json, true );
			$selected_options = is_string( $selected_options ) ? $selected_options : '';

			foreach ( $options as $value => $label ) {
				$selected = ( $selected_options === $value ) ? ' selected' : '';
				$markup   = $markup . '<option value="' . $value . '"' . $selected . '>' . $label . '</option>' . "\n";
			}
		}

		return $markup;
	}


}