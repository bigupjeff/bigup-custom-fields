<?php
namespace Bigup\Custom_Fields;

/**
 * Bigup Custom Fields - Sanitize.
 *
 * Methods which can be called statically to sanitize field inputs.
 *
 * @package bigup_custom_fields
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2021, Jefferson Real
 * @license GPL2+
 * @link https://jeffersonreal.uk
 * 
 */

// WordPress dependencies.
use function menu_page_url;
use sanitize_email;


class Sanitize {


    /**
     * Sanitize a text string.
     */
    public static function text( $text ) {
 
        $clean_text = sanitize_text_field( $text );
        return $clean_text;
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

        $port = (int)$port;

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

        $number = (int)$number;
        return $number;
    }


    /**
     * Sanitize a checkbox.
     */
    public static function checkbox( $checkbox ) {

        $bool_checkbox = (bool)$checkbox;
        return $bool_checkbox;
    }


}// Class end