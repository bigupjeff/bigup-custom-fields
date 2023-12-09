<?php
/**
 * Admin Settings Handler.
 *
 * @package bigup_custom_fields
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 * @license GPL2+
 * @link https://jeffersonreal.uk
 */

namespace Bigup\Custom_Fields;

// WordPress dependencies.
use function menu_page_url;
// Include for access to function add_settings_section() before admin_init to support GraphQL.
require_once ABSPATH . 'wp-admin/includes/template.php';

/**
 * Bigup Custom Fields - Admin Settings.
 *
 * Hook into the WP admin area and add menu settings pages.
 */
class Admin_Settings {


	/**
	 * Class Variables.
	 *
	 * $admin_label - Menu label for the plugin.
	 * $page_slug   - page URI where the sub-menu will be.
	 * $group_name  - Option group ID which is set when registering settings for this page.
	 * $icon        - SVG Bigup Web icon for the admin menu as a base64 string.
	 */
	public $admin_label = 'Custom Fields';
	public $page_slug   = 'bigup-custom-fields';
	public $group_name  = 'bigup-custom-fields';
	public $icon        = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMzIiIGhlaWdodD0iMTMyIj48cGF0aCBmaWxsPSJjdXJyZW50Q29sb3IiIGQ9Ik0wIDB2MTMyaDM1LjRWODcuMmMwLTUuNiAwLTExLjYgMS43LTE2LjcuOC0yLjUgNC40LTMuNyA3LjEtMy43aDM0LjVjMy4yIDAgNi45LjEgOC4yIDEuMiAyLjMgMS44IDEuOSA3LjIgMi4xIDEwLjUuNCA0LjkgMSAxNC4yLS41IDE1LjYtMy4zIDMuNC0yLjggNC05LjIgMTAuMS0xLjggMS40LTYtLjktNS4zLTQuNC43LTMuNiAzLjQtOS43IDMuNC0xMS40IDAtMS43LTIgLjgtMi44IDAtLjMtLjQtLjYtLjktLjgtMS42LS43LTIuNCA0LjgtNy43IDQuMi04LjgtLjktMS4zLTQuMyA3LTYuNCA1LS42LS41LTIuMS00LjktMi44LTUtMSAwIDEuOCA0LjguOCA3LjktLjcgMi0zLjIgMi44LTUuMiAzLTIuNi41LTEzLjMtMTAuMS0xNC05LjUtLjguNyAxMC44IDEwLjcgMTIuNCAxNCAxLjMgMi4xIDIuMyA3LjUgMS43IDguMS0uNi43LTEwLjktNC05LjItMS41IDEuOCAyLjYgMTAgMy4yIDEzLjYgMy44IDEuMS4yIDMgLjEgNC42IDIuNS4zLjQtMi42LS40LTUuMy0xLTIuNi0uMy01LjQtMS01LjktLjgtLjcuNSAyIDMuMiAyLjggMy40IDEuMS40IDExLjUtLjUgMTIuMi0uNyAyLjgtMSAzLjktMS42IDQuMy0yIDUuOC02LjcgOS40LTkgOS42LTEyLjEuMi0zLjEtLjQtMTMgMi4zLTE0LjggMi42LTEuOCA1LjMuMSA2LjUgNS44IDEuMiA1LjcgMy40IDUuNiA0LjQgMTAuOCAxIDUuMi0zLjMgMTUuOS01LjYgMjEuOS0yLjIgNi03LjQgNy42LTEwLjYgOS42LTMuMyAyLTYuNyAzLjUtMTAuOCA0LjMtMi45LjYtNy41IDEuMS05LjkgMS4zSDEzMlYwSDY2czcuNC41IDExLjQgMS4zUzg1IDMuNyA4OC4yIDUuN2MzLjIgMiA4LjQgMy42IDEwLjYgOS42IDIuMyA2IDYuNyAxNi42IDUuNiAyMS44LTEgNS4zLTMuMiA1LjEtNC40IDEwLjgtMS4yIDUuNy0zLjkgNy43LTYuNSA1LjktMi43LTEuOS0yLjEtMTEuOC0yLjMtMTQuOC0uMi0zLjEtMy44LTUuNS05LjYtMTIuMS0uNC0uNS0xLjUtMS4xLTQuMy0yLS43LS4yLTExLTEuMi0xMi4yLS44LS44LjItMy41IDMtMi44IDMuNC41LjMgMy4zLS40IDUuOS0uOSAyLjctLjQgNS42LTEuMyA1LjMtLjlDNzIgMjguMSA3MCAyOCA2OSAyOC4yYy0zLjUuNi0xMS44IDEuMi0xMy42IDMuOC0xLjcgMi42IDguNi0yLjIgOS4yLTEuNS42LjctLjQgNi0xLjcgOC4yLTEuNiAzLjMtMTMuMiAxMy4yLTEyLjQgMTMuOS43LjcgMTEuNC0xMCAxNC05LjUgMiAuMyA0LjUgMSA1LjIgMyAxIDMuMS0xLjcgOC0uOCA3LjguNyAwIDIuMi00LjQgMi44LTUgMi0yIDUuNSA2LjQgNi40IDUgLjYtMS00LjktNi4zLTQuMi04LjcuMi0uNy41LTEuMi44LTEuNS44LTEgMi44IDEuNiAyLjggMCAwLTEuOC0yLjctNy44LTMuNC0xMS40LS43LTMuNiAzLjUtNS45IDUuMy00LjUgNi40IDYgNiA2LjggOS4yIDEwLjEgMS40IDEuNSAxIDEwLjcuNSAxNS43LS4yIDMuMi4yIDguNi0yLjEgMTAuNS0yIDEuNS04LjggMS4xLTEyIDEuMUg0NC4yYy0yLjcgMC02LjMtMS4xLTcuMS0zLjctMS43LTUtMS43LTExLTEuNy0xNi43VjBaIi8+PC9zdmc+Cg==';


	/**
	 * Holds the WP_Post object for the add_meta_boxes callback.
	 */
	public $post_obj = '';


	/**
	 * Init the class by hooking into the admin interface.
	 *
	 * do_settings() is hooked in  to 'init' instead of 'admin_init' to support GraphQL.
	 */
	public function __construct() {
		add_action( 'bigup_settings_dashboard_entry', array( &$this, 'echo_plugin_settings_link' ) );
		new Admin_Settings_Parent();
		add_action( 'admin_menu', array( &$this, 'register_admin_menu' ), 99 );
		add_action( 'init', array( &$this, 'do_settings' ) );
		add_action( 'updated_option', array( &$this, 'process_custom_fields' ) );

	}


	/**
	 * Add admin menu entry to sidebar
	 */
	public function register_admin_menu() {

		add_submenu_page(
			Admin_Settings_Parent::$page_slug,  // parent_slug
			$this->admin_label . ' Settings',   // page_title
			$this->admin_label,                 // menu_title
			'manage_options',                   // capability
			$this->page_slug,                   // menu_slug
			array( &$this, 'create_settings_page' ), // function
			null,                               // position
		);

	}


	/**
	 * Echo a link to this plugin's settings page.
	 */
	public function echo_plugin_settings_link() {
		?>

		<a href="/wp-admin/admin.php?page=<?php echo $this->page_slug; ?>">
			Go to <?php echo $this->admin_label; ?> settings
		</a>
		<br>

		<?php
	}


	/**
	 * Create Custom Fields Settings Page
	 */
	public function create_settings_page() {

		/* Get the active tab from the $_GET URL param. */
		$default_tab = null;
		$tab         = isset( $_GET['tab'] ) ? $_GET['tab'] : $default_tab;
		$slug        = $this->page_slug;
		?>

		<div class="wrap">

			<h1>
				<span class="dashicons-bigup-logo" style="font-size: 2em; margin-right: 0.2em;"></span>
				<?php echo esc_html( get_admin_page_title() ); ?>
			</h1>

			<?php settings_errors(); // Display the form save notices here. ?>

			<nav class="nav-tab-wrapper">
				<a
					href="?page=<?php echo $slug; ?>"
					class="nav-tab 
					<?php
					if ( $tab === null ) :
						?>
						nav-tab-active<?php endif; ?>"
				>
					Default Tab
				</a>
				<a
					href="?page=<?php echo $slug; ?>&tab=custom-post-types"
					class="nav-tab 
					<?php
					if ( $tab === 'custom-post-types' ) :
						?>
						nav-tab-active<?php endif; ?>"
				>
					Custom Post Types
				</a>
				<a
					href="?page=<?php echo $slug; ?>&tab=custom-fields"
					class="nav-tab 
					<?php
					if ( $tab === 'custom-fields' ) :
						?>
						nav-tab-active<?php endif; ?>"
				>
					Custom Fields
				</a>
			</nav>

			<div class="tab-content">
			<?php
			switch ( $tab ) :
				case 'custom-post-types':
					require BIGUP_CUSTOM_FIELDS_PLUGIN_PATH . 'templates/custom-post-types-tab.php';
					break;
				case 'custom-fields':
					require BIGUP_CUSTOM_FIELDS_PLUGIN_PATH . 'templates/custom-fields-tab.php';
					break;
				default:
					require BIGUP_CUSTOM_FIELDS_PLUGIN_PATH . 'templates/default-tab.php';
					break;
			endswitch;
			?>
			</div>

		</div>

		<?php
	}


	/**
	 * Do Settings.
	 *
	 * Get the json data from settings.json and convert to an array before sending to build_settings();
	 */
	public function do_settings() {
		$this->build_plugin_settings();

		$process_settings = new Process_Settings();
		$json             = file_get_contents( BIGUP_CUSTOM_FIELDS_PLUGIN_PATH . 'data/settings.json' );
		$process_settings->build_from_json( $json );
		$process_settings->build_custom_post_forms();

		$option = $process_settings->posts_option;
		foreach ( $option as $post_type => $args ) {
			unset( $args['post_type'] );
			Register_Post_Types::add( $post_type, $args );
		}

		$cpts = Register_Post_Types::get_registered();
		error_log( '### Register_Post_Types->get_registered() ###' );
		error_log( json_encode( $cpts ) );
	}


	/**
	 * Build Plugin Page Settings
	 *
	 * Create the settings for the plugin page.
	 */
	public function build_plugin_settings() {

		$setting = array(
			'name'            => 'target_page',
			'label'           => 'Target Page',
			'sanitize_type'   => 'number',
			'var_type'        => 'integer',
			'description'     => '',
			'show_in_rest'    => true,
			'show_in_graphql' => true,
			'default'         => null,
			'page'            => 'bigup-web-custom-fields',
			'group'           => 'bigup-custom-fields',
		);

		$page_id = get_option( $setting['name'] );
		$page_id = ( ! $page_id ) ? 0 : $page_id;

		$dropdown_markup = wp_dropdown_pages(
			array(
				'depth'                 => 0,                  // Max depth.
				'child_of'              => 0,                  // Page ID to retrieve children of.
				'selected'              => $page_id,           // Value of the default option.
				'echo'                  => 0,                  // Whether to echo or return.
				'name'                  => $setting['name'], // 'name' attribute.
				'id'                    => '',                 // 'id' attribute.
				'class'                 => '',                 // 'class' attribute.
				'show_option_none'      => 'Select page',      // Text when none selected.
				'show_option_no_change' => '',                 // Text to show if "no change".
				'option_none_value'     => '',                 // Value when no page selected.
				'value_field'           => 'ID',               // Post field to populate the 'value' attribute.
			)
		);

		$output_callback = function() use ( $dropdown_markup ) {
			echo $dropdown_markup;
		};

		$page          = $this->page_slug;
		$section_id    = 'section_page';
		$section_title = 'Select Page';
		$html          = '<p>Custom fields will be applied to this page.</p>';
		$callback      = function() use ( $html ) {
			if ( null === $html ) {
				return;
			}
			echo $html;
		};
		add_settings_section(
			$section_id,
			$section_title,
			$callback,
			$page
		);
		add_settings_field(
			$setting['name'],
			$setting['label'],
			$output_callback,
			$setting['page'],
			$section_id
		);
		register_setting(
			$setting['group'],
			$setting['name'],
			array(
				'type'              => $setting['var_type'],
				'description'       => $setting['description'],
				'sanitize_callback' => array( new Sanitize(), 'number' ),
				'show_in_rest'      => $setting['show_in_rest'],
				'show_in_graphql'   => $setting['show_in_graphql'],
				'default'           => $setting['default'],
			)
		);
	}


	/**
	 * Process Custom Fields
	 *
	 * Fired on admin settings form submit and handles attaching custom fields to the page.
	 */
	public function process_custom_fields() {


return;

		$page_id = get_option( 'target_page' );
		if ( false === ! ! $page_id ) {
			return;
		}

		// error_log( 'process_custom_fields CALLED!!' );

		$this->post_obj = get_post( $page_id );
		$type           = $this->post_obj->post_type;

		// This hook doesn't seem to work.

		add_action(
			"add_meta_boxes_{$type}",       // Action hook.
			array( &$this, 'add_custom_fields' ) // Callback function.
		);
	}

	public function add_custom_fields() {

		error_log( 'add_custom_fields CALLED!!' );

		$type = $this->post_obj->post_type;
		$id   = $this->post_obj->ID;

		add_meta_box(
			'custom_fields_' . $id,              // ID of metabox.
			'Custom Fields',                     // Title of metabox.
			array( &$this, 'display_custom_fields' ), // Callback to output content.
			$type,                               // Post type.
			'normal',                            // Position on admin page area (See docs).
			'high'                               // Priority.
		);
	}

	public function display_custom_fields() {

		error_log( 'display_custom_fields CALLED!!' );

		$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
		if ( 6 === $post_id ) {

			echo 'HELLO';

			/* Setup hidden input functionality */
			settings_fields( 'bigup-custom-fields' );

			/* Print the input fields */
			do_settings_sections( 'bigup-web-custom-fields' );

			/* Print the submit button */
			submit_button( 'Save' );
		}
	}


}//end class
