<?php
namespace Bigup\Custom_Fields;

/**
 * Plugin Name: Bigup Web: Custom Fields
 * Plugin URI: https://jeffersonreal.uk
 * Description: A plugin to handle custom fields.
 * Version: 0.0.1
 * Author: Jefferson Real
 * Author URI: https://jeffersonreal.uk
 * License: GPL2
 *
 * @package bigup_contact_form
 * @version 0.0.1
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 * @license GPL2+
 * @link https://jeffersonreal.uk
 */

/**
 * Set this plugin's base URL constant for use throughout the plugin.
 * 
 * There is no in-built WP function to get the base URL for a plugin, so this constant allows us to
 * write relative file references, making code portable.
 */
$url = plugin_dir_url( __FILE__ );
define( 'BIGUP_CUSTOM_FIELDS_PLUGIN_URL', $url );
$path = plugin_dir_path( __FILE__ );
define( 'BIGUP_CUSTOM_FIELDS_PLUGIN_PATH', $path );

/**
 * Load PHP autoloader to ready the classes.
 */
require_once( BIGUP_CUSTOM_FIELDS_PLUGIN_PATH . 'classes/autoload.php' );

/**
 * Init class which in turn calls all plugin dependencies.
 */
new Init();

/**
 * If the user is on admin page, process the admin settings menu.
 * 
 * Do not register with is_admin(), otherwise options will not show in GraphQL.
 */
new Admin_Settings();
