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


	const initialise = () => {

		[ ...document.querySelectorAll( '.inlineEditButton' ) ].forEach ( button => {
			button.addEventListener(
				'click',
				function () {

					displayInlineForm( this );
				}
			) }
		)
	}
	
 
	const colspanUpdate = ( tableRow ) => {
		const colCount = tableRow.closest( 'table' ).querySelector( 'tr' ).querySelectorAll( 'th' ).length;
		tableRow.querySelector( 'td' ).setAttribute( 'colspan', colCount );
	}

	const displayInlineForm = ( button ) => {

		const form   = document.querySelector( '#inlineEditTemplate' ).content.cloneNode( true );
		const data   = JSON.parse( sessionStorage.getItem( 'bigupCPTOption' ) );
		const postID = button.getAttribute( 'data-post-type' );

		if ( postID in data ) {

			const inputValues = data[ postID ];
			for ( let [ id, value ] of Object.entries( inputValues ) ) {
				form.getElementById( id ).value = value;
			}
			form.querySelector( 'input#post_type' ).disabled = true;

			const postRow = document.getElementById( postID );
			postRow.after( form );
			postRow.style.display = 'none';
			const editRow = document.getElementById( 'inlineEditRow' );

			colspanUpdate( editRow );

		} else {
			alert( 'Error! ' + postID + ' not found in session storage. Please alert plugin maintainer.' );
		}
	}


	const docLoaded = setInterval( () => {
		if ( document.readyState === 'complete' ) {
			clearInterval( docLoaded );
			initialise();
		}
	}, 100 );
};
 
export { cptEditInline };
 