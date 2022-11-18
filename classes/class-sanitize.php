<?php
namespace Bigup\Custom_Fields;

/**
 * Bigup Custom Fields - Sanitize.
 *
 * Methods which can be called statically to sanitize field inputs.
 *
 * @package bigup_custom_fields
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 * @license GPL2+
 * @link https://jeffersonreal.uk
 */

// WordPress dependencies.
use function menu_page_url;
use sanitize_email;


class Sanitize {


	/**
	 * Sanitize Callback
	 *
	 * Returns a callback which can be passed as a function call argument.
	 */
	public static function get_callback( $type ) {
		switch ( $type ) {
			case 'text':
				return array( new Sanitize(), 'text' );

			case 'email':
				return array( new Sanitize(), 'email' );

			case 'domain':
				return array( new Sanitize(), 'domain' );

			case 'port':
				return array( new Sanitize(), 'port' );

			case 'number':
				return array( new Sanitize(), 'number' );

			case 'checkbox':
				return array( new Sanitize(), 'checkbox' );

			case 'key':
				return array( new Sanitize(), 'key' );

			default:
				error_log( 'Bigup Plugin: Invalid sanitize type passed with option' );
		}
	}


	/**
	 * Get Sanitized
	 *
	 * Sanitizes and returns a value based on the sanitize type passed.
	 */
	public static function get_sanitized( $type, $value ) {

		switch ( $type ) {
			case 'text':
				return self::text( $value );

			case 'alphanumeric':
				return self::alphanumeric( $value );

			case 'email':
				return self::email( $value );

			case 'domain':
				return self::domain( $value );

			case 'port':
				return self::port( $value );

			case 'number':
				return self::number( $value );

			case 'checkbox':
				return self::checkbox( $value );

			case 'key':
				return self::key( $value );

			case is_array( $type ):
				return self::arr( $type, $value );

			default:
				error_log( 'Bigup Plugin: Invalid sanitize type passed with value' );
		}
	}


	/**
	 * Sanitize an array of values.
	 *
	 * This special function accepts a type and a flat array of values, sanitizes each value against
	 * that type, then returns a clean value array. This function does not account for arrays with
	 * mixed value types.
	 */
	public static function arr( $arr_type, $values ) {

		if ( ! isset( $values ) ) {
			return array();
		}
		$clean_values = array();
		$type         = $arr_type[0];

		foreach ( $values as $value ) {
			array_push( $clean_values, self::get_sanitized( $type, $value ) );
		}

		return $clean_values;
	}


	/**
	 * Sanitize a text string.
	 */
	public static function text( $text ) {

		$clean_text = sanitize_text_field( $text );
		return $clean_text;
	}


	/**
	 * Sanitize an alphanumeric string.
	 */
	public static function alphanumeric( $alphanumeric ) {

		// This is incomplete!
		$clean_alphanumeric = preg_replace( '/[\W]/', '', $str);
		return $clean_alphanumeric;
	}


	/**
	 * Sanitize an email.
	 */
	public static function email( $email ) {

		$clean_email = sanitize_email( $email );
		return $clean_email;
	}


	/**
	 * Sanitize a domain name.
	 */
	public static function domain( $domain ) {

		$ip = gethostbyname( $domain );
		$ip = filter_var( $ip, FILTER_VALIDATE_IP );

		if ( $domain == '' || $domain == null ) {
			return '';
		} elseif ( $ip ) {
			return $domain;
		} else {
			return 'INVALID DOMAIN';
		}
	}


	/**
	 * Sanitize a port number.
	 */
	public static function port( $port ) {

		$port = (int) $port;

		if ( is_int( $port )
			&& $port >= 1
			&& $port <= 65535 ) {
			return $port;
		} else {
			return '';
		}
	}


	/**
	 * Sanitize a number.
	 */
	public static function number( $number ) {

		$clean_number = (int) $number;
		return $clean_number;
	}


	/**
	 * Sanitize a checkbox.
	 */
	public static function checkbox( $checkbox ) {

		$bool_checkbox = (bool) $checkbox;
		$bool_checkbox = $bool_checkbox ? 1 : 0;
		return $bool_checkbox;
	}


	/**
	 * Sanitize a WP key.
	 */
	public static function key( $key ) {

		$clean_key = sanitize_key( $key );
		return $clean_key;
	}


}//end class
