<?php

array( 3 ) {
	array( 'slug' ) => string( 37 ) 'bigup-custom-fields-custom-post-types'
	['group'] => string( 37 ) 'bigup-custom-fields-custom-post-types'
	['sections'] => array( 4 ) {
		array( 'id' ) => string( 19 ) 'section_custom_post'
		['title'] => string( 20 ) 'Custom Post Settings'
		['description_html'] => null
		array( 'settings' ) => array( 13 ) {
			array( 0 ) => array( 9 ) {
				array( 'id' ) => string( 9 ) 'post_type'
				['label'] => string( 13 ) 'Post Type Key'
				['input_type'] => string( 4 ) 'text'
				['length_limit'] => int( 20 )
				['required'] => string( 8 ) 'required'
				['sanitize_type'] => string( 3 ) 'key'
				['var_type'] => string( 6 ) 'string'
				['description'] => string( 0 ) ''
				['default'] => string( 7 ) 'my-post'
			}
			[1] => array( 8 ) {
				array( 'id' ) => string( 11 ) 'has_archive'
				['label'] => string( 14 ) 'Enable Archive'
				['input_type'] => string( 8 ) 'checkbox'
				['required'] => string( 8 ) 'required'
				['sanitize_type'] => string( 8 ) 'checkbox'
				['var_type'] => string( 7 ) 'boolean'
				['description'] => string( 0 ) ''
				['default'] => bool( false )
			}
			[2] => array( 8 ) { array( 'id' ) => string( 6 ) 'public' ['label'] => string( 6 ) 'Public' ['input_type'] => string( 8 ) 'checkbox' ['required'] => string( 8 ) 'required' ['sanitize_type'] => string( 8 ) 'checkbox' ['var_type'] => string( 7 ) 'boolean' ['description'] => string( 0 ) '' ['default'] => bool( true ) } [3] => array( 8 ) { array( 'id' ) => string( 12 ) 'show_in_menu' ['label'] => string( 12 ) 'Show in Menu' ['input_type'] => string( 8 ) 'checkbox' ['required'] => string( 8 ) 'required' ['sanitize_type'] => string( 8 ) 'checkbox' ['var_type'] => string( 7 ) 'boolean' ['description'] => string( 0 ) '' ['default'] => bool( true ) } [4] => array( 11 ) { array( 'id' ) => string( 13 ) 'menu_position' ['label'] => string( 13 ) 'Menu Position' ['input_type'] => string( 6 ) 'number' ['number_min'] => int( 0 ) ['number_max'] => int( 100 ) ['number_step'] => int( 1 ) ['required'] => string( 8 ) 'required' ['sanitize_type'] => string( 6 ) 'number' ['var_type'] => string( 7 ) 'integer' ['description'] => string( 0 ) '' ['default'] => int( 5 ) } [5] => array( 10 ) { array( 'id' ) => string( 9 ) 'menu_icon' ['label'] => string( 9 ) 'Menu Icon' ['input_type'] => string( 6 ) 'select' ['select_type'] => string( 9 ) 'dashicons' ['select_multi'] => string( 0 ) '' ['required'] => string( 0 ) '' ['sanitize_type'] => string( 3 ) 'key' ['var_type'] => string( 6 ) 'string' ['description'] => string( 0 ) '' ['default'] => string( 23 ) 'dashicons-screenoptions' } [6] => array( 8 ) { array( 'id' ) => string( 12 ) 'hierarchical' ['label'] => string( 12 ) 'Hierarchical' ['input_type'] => string( 8 ) 'checkbox' ['required'] => string( 8 ) 'required' ['sanitize_type'] => string( 8 ) 'checkbox' ['var_type'] => string( 7 ) 'boolean' ['description'] => string( 0 ) '' ['default'] => bool( true ) } [7] => array( 10 ) { array( 'id' ) => string( 10 ) 'taxonomies' ['label'] => string( 10 ) 'Taxonomies' ['input_type'] => string( 6 ) 'select' ['select_type'] => string( 10 ) 'taxonomies' ['select_multi'] => string( 8 ) 'multiple' ['required'] => string( 0 ) '' ['sanitize_type'] => array( 1 ) { array( 0 ) => string( 6 ) 'string' } ['var_type'] => string( 5 ) 'array' ['description'] => string( 0 ) '' ['default'] => string( 8 ) 'category' } [8] => array( 8 ) { array( 'id' ) => string( 12 ) 'show_in_rest' ['label'] => string( 16 ) 'Show in REST API' ['input_type'] => string( 8 ) 'checkbox' ['required'] => string( 8 ) 'required' ['sanitize_type'] => string( 8 ) 'checkbox' ['var_type'] => string( 7 ) 'boolean' ['description'] => string( 0 ) '' ['default'] => bool( true ) } [9] => array( 8 ) { array( 'id' ) => string( 15 ) 'show_in_graphql' ['label'] => string( 19 ) 'Show in GraphQL API' ['input_type'] => string( 8 ) 'checkbox' ['required'] => string( 8 ) 'required' ['sanitize_type'] => string( 8 ) 'checkbox' ['var_type'] => string( 7 ) 'boolean' ['description'] => string( 0 ) '' ['default'] => bool( true ) } [10] => array( 9 ) { array( 'id' ) => string( 11 ) 'name_plural' ['label'] => string( 11 ) 'Plural Name' ['input_type'] => string( 4 ) 'text' ['length_limit'] => int( 30 ) ['required'] => string( 8 ) 'required' ['sanitize_type'] => string( 4 ) 'text' ['var_type'] => string( 6 ) 'string' ['description'] => string( 0 ) '' ['default'] => string( 8 ) 'My Posts' } [11] => array( 9 ) { array( 'id' ) => string( 13 ) 'name_singular' ['label'] => string( 13 ) 'Singular Name' ['input_type'] => string( 4 ) 'text' ['length_limit'] => int( 30 ) ['required'] => string( 8 ) 'required' ['sanitize_type'] => string( 4 ) 'text' ['var_type'] => string( 6 ) 'string' ['description'] => string( 0 ) '' ['default'] => string( 7 ) 'My Post' } [12] => array( 8 ) { array( 'id' ) => string( 16 ) 'delete_with_user' ['label'] => string( 16 ) 'Delete with User' ['input_type'] => string( 8 ) 'checkbox' ['required'] => string( 8 ) 'required' ['sanitize_type'] => string( 8 ) 'checkbox' ['var_type'] => string( 7 ) 'boolean' ['description'] => string( 0 ) '' ['default'] => bool( false ) } } } }
