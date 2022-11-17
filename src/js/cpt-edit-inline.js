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

	// If this isn't the 'custom-post-types' tab, bail.
	const queryString = window.location.search;
	const urlParams   = new URLSearchParams( queryString );
	if ( ! urlParams.has( 'tab' ) || 'custom-post-types' !== urlParams.get( 'tab' ) ) {
		return;
	}

	const initialise = () => {

		document.querySelector( '#addNewButton' ).addEventListener(
			'click',
			function () {
				resetTable();
				insertInlineNewForm( this );
			}
		);

		[ ...document.querySelectorAll( '.inlineEditButton' ) ].forEach ( editButton => {
			editButton.addEventListener(
				'click',
				function () {
					resetTable();
					insertInlineEditForm( this );
				}
			)
		} );
	};


	const insertInlineNewForm = () => {
		const form  = document.querySelector( '#inlineEditTemplate' ).content.cloneNode( true );
		const table = document.querySelector( '#customPostsTable' );
		form.querySelector( 'legend' ).innerHTML = 'New Custom Post Type';
		table.querySelector( 'tbody' ).prepend( form );

		readyForm( document.querySelector( '#editRow' ) );
	};
	

	const insertInlineEditForm = ( editButton ) => {
		const form   = document.querySelector( '#inlineEditTemplate' ).content.cloneNode( true );
		const data   = JSON.parse( sessionStorage.getItem( 'bigupCPTOption' ) );
		const postID = editButton.getAttribute( 'data-post-type' );

		if ( postID in data ) {

			const inputValues = data[ postID ];
			for ( let [ id, value ] of Object.entries( inputValues ) ) {
				form.getElementById( id ).value = value;
			}

			form.querySelector( '#hiddenRow' ).setAttribute( 'id', 'hiddenRow-' + postID );
			form.querySelector( '#editRow' ).setAttribute( 'id', 'editRow-' + postID );
			form.querySelector( 'input#post_type' ).disabled = true;

			const postRow = document.getElementById( postID );
			postRow.after( form );
			postRow.style.display = 'none';

			readyForm( document.querySelector( '#editRow-' + postID ) );

		} else {
			alert( 'Error! ' + postID + ' not found in session storage. Please alert plugin maintainer.' );
		}
	};


	const readyForm = ( formRow ) => {
		colspanUpdate( formRow );
		resizeObserver.observe( formRow );
		addListenerToCanelButton( formRow.querySelector( '.inlineCancelButton' ) );
	};


	const addListenerToCanelButton = ( button ) => {
		button.addEventListener(
			'click',
			function () {
				resetTable();
			}
		)
	};


	const resetTable = () => {
		[ ...document.querySelectorAll( '.customPostTypeRow' ) ].forEach ( tr => {
			tr.style.display = 'table-row';
		} );
		[ ...document.querySelectorAll( '.editActive' ) ].forEach ( tr => {
			resizeObserver.unobserve( tr );
			tr.remove();
		} );
	};


	const colspanUpdate = ( tableRow ) => {
		const colCount = tableRow.closest( 'table' ).querySelector( 'tr' ).querySelectorAll( 'th' ).length;
		tableRow.querySelector( 'td' ).setAttribute( 'colspan', colCount );
	};


	const resizeObserver = new ResizeObserver( ( entries ) => {
		colspanUpdate( entries[ 0 ].target  );
	} );


	const docLoaded = setInterval( () => {
		if ( document.readyState === 'complete' ) {
			clearInterval( docLoaded );
			initialise();
		}
	}, 100 );
};
 
export { cptEditInline };
 