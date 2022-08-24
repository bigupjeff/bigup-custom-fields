<?php
	namespace Bigup\Custom_Fields;
	$group    = 'bigup-custom-fields-custom-post-type';
	$slug     = 'bigup-custom-fields-custom-post-type';
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