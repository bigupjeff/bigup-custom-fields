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
		table.querySelector( 'form' ).setAttribute( 'data-type-form', 'new' );

		readyForm( table.querySelector( '#editRow' ) );
		attachNameToKeyListener( document.querySelector( '#customPostsTable #editRow #name_singular' ) );
	};
	

	const insertInlineEditForm = ( editButton ) => {
		const form   = document.querySelector( '#inlineEditTemplate' ).content.cloneNode( true );
		const table  = document.querySelector( '#customPostsTable' );
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
			table.querySelector( 'form' ).setAttribute( 'data-type-form', 'edit' );

			readyForm( document.querySelector( '#editRow-' + postID ) );

		} else {
			alert( 'Error! ' + postID + ' not found in session storage. Please alert plugin maintainer.' );
		}
	};


	const readyForm = ( formRow ) => {
		colspanUpdate( formRow );
		resizeObserver.observe( formRow );
		attachFormResetListener( formRow.querySelector( '#cancelButton' ) );
		attachNameValidationListener( formRow.querySelector( '#name_singular' ) );
		attachNameValidationListener( formRow.querySelector( '#name_plural' ) );
		attachSubmitListener( formRow.querySelector( '#submitButton' ) );
	};


	const attachFormResetListener = ( button ) => {
		button.addEventListener(
			'click',
			function () {
				resetTable();
			}
		)
	};


	const attachNameValidationListener = ( input ) => {
		input.addEventListener(
			'keyup',
			function () {

				const string   = input.value;
				const regex    = new RegExp( input.getAttribute( 'pattern' ), 'ug' );
				let okChars    = string.match( regex );
				const validMsg = 'This field can only contain alphanumeric characters, spaces and hyphens.';

				if ( Array.isArray( okChars ) ) {
					const joined = okChars.join( '' );
					okChars = joined;
				} else {
					input.value = '';
					doInputMessage(
						input,
						validMsg
					);
					return;
				}

				if ( string.length !== okChars.length ) {
					doInputMessage(
						input,
						validMsg
					);
				}

				input.value = cleanSpacesAndHyphens( okChars );
			}
		)
	};


	const attachNameToKeyListener = ( input ) => {
		input.addEventListener(
			'change',
			function () {
				const hiddenKeyInput = input.closest( 'form' ).querySelector( '#post_type' );
				const lowerCase      = input.value.toLowerCase();
				const snakeCase      = lowerCase.replace( / /g, '-' );
				const trimmed        = snakeCase.substring( 0, 20 );
				hiddenKeyInput.value = trimmed;
			}
		)
	};


	const attachSubmitListener = ( button ) => {
		button.addEventListener(
			'click',
			function () {
				const form           = button.closest( 'form' );
				const formType       = form.getAttribute( 'data-type-form' );
				const inputsAreValid = form.reportValidity();
		
				if ( inputsAreValid && 'new' === formType ) {
					const data           = JSON.parse( sessionStorage.getItem( 'bigupCPTOption' ) );
					const hiddenKeyInput = form.querySelector( '#post_type' );
					let postID           = hiddenKeyInput.value;
					
					let i = 1;
					while ( postID in data ) {
						let croppedID       = postID.substring( 0, 18 );
						const noAppendedNum = croppedID.replace( /-\d+$/g, '' );

						postID = noAppendedNum + '-' + i;
console.log( croppedID );
						i++;
						if ( 10 === i ) {
							doInputMessage(
								form.querySelector( '#name_singular' ),
								'Post key already exists. Please choose a unique name.'
							);
							return;
						}
					}

					hiddenKeyInput.value = postID;




				} else if ( inputsAreValid && 'edit' === formType ) {

				}

				button.closest( 'form' ).submit();


			}
		)
	}


	const cleanSpacesAndHyphens = ( string ) => {
		const singleHyphens       = string.replace( /--+/g, '-' );
		const singleSpaces        = singleHyphens.replace( /  +/g, ' ' );
		const noLeadSpaces        = singleSpaces.trimStart();
		const max1TrailingSpace   = noLeadSpaces.replace( /\s+$/g, ' ' );
		return max1TrailingSpace;
	}


	const doInputMessage = ( input, text ) => {
		if ( true === !! input.closest( 'label' ).querySelector( '.inputMessage' ) ) {
			return;
		}
		const div     = document.createElement( 'div' );
		const message = document.createTextNode( text );
		div.appendChild( message );
		div.classList.add( 'inputMessage' );
		input.after( div );
		const removeDiv = setTimeout( () => {
			div.remove();
			clearTimeout( removeDiv );
		}, 5000);
	}


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
 