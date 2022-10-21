/**
 * Custom Post Type Edit Inline Module.
 * 
 * Handles the custom post editing form which is displayed as a row in the table on the custom posts
 * tab - fired by the 'edit' button.
 *
 * @package bigup_custom_fields
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

const cptEditInline = () => {


	function initialise() {

		[ ...document.querySelectorAll( '.inlineEditButton' ) ].forEach ( button => {
			button.addEventListener(
				'click',
				function () {
					displayInlineForm( this );
				}
			) }
		)
	}
 

	function displayInlineForm( button ) {

		const form = document.querySelector( '#inlineEditTemplate' ).content.cloneNode( true );
		const data = JSON.parse( sessionStorage.getItem( 'bigupCPTOption' ) );
		const post = button.getAttribute( 'data-post-type' );

		if ( post in data ) {
			// Replace input field values with those from the data
			const postValues = data[ post ];

			for ( let [ id, value ] of Object.entries( postValues ) ) {
				form.getElementById( id ).value = value;
			}

			console.log( form );
		} else {
			alert( 'Error! ' + post + ' not found in session storage. Please alert plugin maintainer.' );
		}
	}


	let docLoaded = setInterval( () => {
		if ( document.readyState === 'complete' ) {
			clearInterval( docLoaded );
			initialise();
		}
	}, 100 );
};
 
export { cptEditInline };
 