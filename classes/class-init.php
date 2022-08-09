<?php
namespace Bigup\Custom_Fields;

/**
 * Bigup Custom Fields - Initialisation.
 *
 * Setup styles and functionality for this plugin.
 *
 * @package bigup_custom_fields
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2021, Jefferson Real
 * @license GPL2+
 * @link https://jeffersonreal.uk
 * 
 */

// WordPress dependencies.
use function add_action;


class Init {


    /**
     * Use this function to initialise all dependencies for the plugin.
     * 
     */
    public function __construct() {

		/**
		 * Enqueue admin scripts and styles.
		 */
		add_action( 'admin_enqueue_scripts', [ $this, 'register_admin_scripts_and_styles' ] );

    }


	/**
	 * Register admin scripts and styles.
	 */
	public function register_admin_scripts_and_styles() {
		if ( ! wp_script_is( 'bigup_icons', 'registered' ) ) {
			wp_register_style( 'bigup_icons', BIGUP_CUSTOM_FIELDS_PLUGIN_URL . 'dashicons/css/bigup-icons.css', array(), filemtime( BIGUP_CUSTOM_FIELDS_PLUGIN_PATH . 'dashicons/css/bigup-icons.css' ), 'all' );
		}
		if ( ! wp_script_is( 'bigup_icons', 'enqueued' ) ) {
			wp_enqueue_style( 'bigup_icons' );
		}
	}

}// Class end