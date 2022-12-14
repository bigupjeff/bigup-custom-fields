<?php
/**
 * Default Tab Template
 *
 * @package herringbone
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace Bigup\Custom_Fields;

$keys = new Admin_Settings();

?>


<form method="post" action="options.php">

	<?php

	/* Output a div for each settings retrieval error */
	settings_errors();

	/* Setup hidden input functionality */
	settings_fields( $keys->group_name );

	/* Print the input fields */
	do_settings_sections( $keys->page_slug );

	/* Print the submit button */
	submit_button( 'Save' );

	?>

</form>
