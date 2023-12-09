<?php
namespace Bigup\Custom_Fields;

/**
 * Bigup Custom Fields - Register Post Types.
 *
 * Handles registering and deregistering custom post types.
 *
 * @package bigup_custom_fields
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 * @license GPL2+
 * @link https://jeffersonreal.uk
 */
class Register_Post_Types {


	/**
	 * Construct.
	 */
	public function __construct() {
	}

	/**
	 * Get Registered.
	 *
	 * Retreive and return a list of custom post types.
	 */
	public static function get_registered() {

		$args = array(
			'public'   => true,
			'_builtin' => false,
		);
		$output   = 'names'; // 'names' or 'objects' (names is default).
		$operator = 'and';   // 'and'/'or' - logical operation to perform when matching $args element.

		$post_types = get_post_types( $args, $output, $operator );

		return $post_types;
	}

	/**
	 * Delete.
	 */
	public function delete() {

	}

	/**
	 * Add.
	 */
	public static function add( $post_type, $args ) {

		register_post_type(
			$post_type,
			$args
		);
	}


	/**
	 * Update.
	 */
	public function update() {

	}


}
