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

	public static function markup( $option, $value ) {

		switch ( $option[ 'input_type' ] ) {

			case 'text':
				return sprintf(
					'<input type="%s" name="%s" id="%s" value="%s" %s>',
					$option[ 'input_type' ],
					$option[ 'id' ],
					$option[ 'id' ],
					get_option( $option[ 'id' ] ),
					$option[ 'required' ]
				);
				break;

			case 'textarea':
				return sprintf(
					'<textarea name="%s" id="%s" %s>%s</textarea>',
					$option[ 'id' ],
					$option[ 'id' ],
					$option[ 'required' ],
					get_option( $option[ 'id' ] )
				);
				break;

			case 'password':
				return sprintf(
					'<input type="%s" name="%s" id="%s" value="%s" %s>',
					$option[ 'input_type' ],
					$option[ 'id' ],
					$option[ 'id' ],
					get_option( $option[ 'id' ] ),
					$option[ 'required' ]
				);
				break;

			case 'email':
				return sprintf(
					'<input type="%s" name="%s" id="%s" value="%s" %s>',
					$option[ 'input_type' ],
					$option[ 'id' ],
					$option[ 'id' ],
					get_option( $option[ 'id' ] ),
					$option[ 'required' ]
				);
				break;

		}
	}
}