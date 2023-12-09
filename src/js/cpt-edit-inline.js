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
				insertInlineNewForm();
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
		[ ...document.querySelectorAll( '.inlineDeleteButton' ) ].forEach ( deleteButton => {
			deleteButton.addEventListener(
				'click',
				function () {
					insertInlineDeleteForm( this );
				}
			)
		} );
	};


	const insertInlineNewForm = () => {
		const form  = document.querySelector( '#inlineFormTemplate' ).content.cloneNode( true );
		const table = document.querySelector( '#customPostsTable' );
		form.querySelector( 'legend' ).innerHTML = 'New Custom Post Type';

		table.querySelector( 'tbody' ).prepend( form );
		table.querySelector( 'form' ).setAttribute( 'data-type-form', 'new' );

		readyForm( table.querySelector( '#editRow' ) );
		attachNameToKeyListener( document.querySelector( '#customPostsTable #editRow #name_singular' ) );
	};
	

	const insertInlineEditForm = ( button ) => {
		const template = document.querySelector( '#inlineFormTemplate' ).content.cloneNode( true );
		const table    = document.querySelector( '#customPostsTable' );
		const data     = JSON.parse( sessionStorage.getItem( 'bigupCPTOption' ) );
		const postID   = button.getAttribute( 'data-post-type' );

		button.setAttribute( 'aria-expanded', 'true' );

		if ( postValueExists( data, 'post_type', postID ) ) {

			const inputValues = data[ postID ];
			for ( let [ id, value ] of Object.entries( inputValues ) ) {
				template.getElementById( id ).value = value;
			}

			template.querySelector( '#hiddenRow' ).setAttribute( 'id', 'hiddenRow-' + postID );
			template.querySelector( '#editRow' ).setAttribute( 'id', 'editRow-' + postID );
			
			const postRow = document.getElementById( postID );
			postRow.after( template );
			postRow.style.display = 'none';
			
			const form = table.querySelector( 'form' );
			form.setAttribute( 'data-type-form', 'edit' );

			readyForm( document.querySelector( '#editRow-' + postID ) );

			return form;

		} else {
			alert( 'Error! ' + postID + ' not found in session storage. Please alert plugin maintainer.' );
		}
	};


	const insertInlineDeleteForm = ( deleteButton ) => {
		const form         = insertInlineEditForm( deleteButton );
		const submitButton = form.querySelector( '#submitButton' );
		const legend       = form.querySelector( 'legend' );
		const hiddenInput  = form.querySelector( '#post_type' );
		const postName     = form.querySelector( '#name_singular' ).value;
		const deleteFlag   = form.querySelector( '#deleteFlag' ).content.cloneNode( true );

		deleteButton.setAttribute( 'aria-expanded', 'true' );

		while ( true === !! hiddenInput.nextSibling  ) {
			hiddenInput.nextSibling.remove();
		}
		hiddenInput.after( deleteFlag );

		legend.innerHTML = 'Are you sure you want to delete post type "' + postName + '"?';

		submitButton.innerHTML = 'Delete';
		submitButton.classList.add( 'delete' );
	}


	const postValueExists = ( data, key, value ) => {
		if ( [ data, key, value ].includes( undefined ) ) return false;
		let exists = false;
		Object.keys( data ).forEach( post => {
			if ( value === data[ post ][ key ] ) {
				exists = true;
			}
		} );
		return exists;
	}


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
				const hiddenInput = input.closest( 'form' ).querySelector( '#post_type' );
				const lowerCase   = input.value.toLowerCase();
				const snakeCase   = lowerCase.replace( / /g, '-' );
				const trimmed     = snakeCase.substring( 0, 20 );
				hiddenInput.value = trimmed;
			}
		)
	};


	const attachSubmitListener = ( button ) => {
		button.addEventListener(
			'click',
			function () {

				const form = button.closest( 'form' );

				if ( button.classList.contains( 'delete' ) ) {
					form.submit();
					return;
				}

				const formType       = form.getAttribute( 'data-type-form' );
				const postName       = form.querySelector( '#name_singular' ).value;
				const postsName      = form.querySelector( '#name_plural' ).value;
				const hiddenInput    = form.querySelector( '#post_type' );
				let   postType       = hiddenInput.value;
				const inputsAreValid = form.reportValidity();
				const data           = JSON.parse( sessionStorage.getItem( 'bigupCPTOption' ) );
				let   areDuplicates  = false;

				if ( true === !! data ) {

					if ( inputsAreValid && 'new' === formType ) {
						let i = 1;
						while ( postValueExists( data, 'post_type', postType ) ) {
							const noAppendedNum = postType.replace( /-\d$/g, '' );
							const croppedTo18   = noAppendedNum.substring( 0, 18 );
							postType            = croppedTo18 + '-' + i;
							if ( 10 === i ) {
								doInputMessage(
									form.querySelector( '#name_singular' ),
									'Post key duplication. Please choose a unique name.'
								);
								areDuplicates = true;
							}
							i++;
						}
					}

					if ( postValueExists( data, 'name_singular', postName ) && 'edit' !== formType ) {
						doInputMessage(
							form.querySelector( '#name_singular' ),
							'Post singular name already exists. Please choose a unique name.'
						);
						areDuplicates = true;
					}

					if ( postValueExists( data, 'name_plural', postsName ) && 'edit' !== formType ) {
						doInputMessage(
							form.querySelector( '#name_plural' ),
							'Post plural name already exists. Please choose a unique name.'
						);
						areDuplicates = true;
					}

					if ( true === areDuplicates ) {
						return;
					}
				}

				hiddenInput.value = postType;
				form.submit();
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
		[ ...document.querySelectorAll( '.inlineEditButton' ) ].forEach ( editButton => {
			editButton.setAttribute( 'aria-expanded', 'false' );
		} );
		[ ...document.querySelectorAll( '.inlineDeleteButton' ) ].forEach ( deleteButton => {
			deleteButton.setAttribute( 'aria-expanded', 'false' );
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
 