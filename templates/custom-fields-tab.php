<?php
/**
 * Custom Fields Tab Template
 *
 * @package herringbone
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace Bigup\Custom_Fields;

$group = 'bigup-custom-fields-custom-post-types';
$slug  = 'bigup-custom-fields-custom-post-types';
?>


<form method="post" action="options.php">

	<?php

	/* Output a div for each settings retrieval error */
	settings_errors();

	/* Setup hidden input functionality */
	settings_fields( $group );

	/* Print the input fields */
	do_settings_sections( $slug );

	/* Print the submit button */
	submit_button( 'Save' );

	?>

</form>
