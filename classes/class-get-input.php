<?php
namespace Bigup\Custom_Fields;

/**
 * Bigup Custom Fields - Form Fields.
 *
 * A library of admin form input fields.
 *
 * @package bigup_custom_fields
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2021, Jefferson Real
 * @license GPL2+
 * @link https://jeffersonreal.uk
 */

class Get_Input {

	public static function markup( $id, $args ) {

		switch ( $args[ 'input_type' ] ) {

			case 'text':
				return printf(
					'<input type="%s" name="%s" id="%s" value="%s" %s>',
					$args[ 'input_type' ],
					$id,
					$id,
					get_option( $id ),
					$args[ 'required' ]
				);
				break;

			case 'textarea':
				return printf(
					'<textarea name="%s" id="%s" %s>%s</textarea>',
					$id,
					$id,
					$args[ 'required' ],
					get_option( $id )
				);
				break;

			case 'password':
				return printf(
					'<input type="%s" name="%s" id="%s" value="%s" %s>',
					$args[ 'input_type' ],
					$id,
					$id,
					get_option( $id ),
					$args[ 'required' ]
				);
				break;

			case 'email':
				return printf(
					'<input type="%s" name="%s" id="%s" value="%s" %s>',
					$args[ 'input_type' ],
					$id,
					$id,
					get_option( $id ),
					$args[ 'required' ]
				);
				break;

		}
	}
}