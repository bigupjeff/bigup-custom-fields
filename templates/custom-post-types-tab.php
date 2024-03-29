<?php
/**
 * Custom Posts Tab Template
 *
 * @package herringbone
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace Bigup\Custom_Fields;

$group = 'bigup-custom-fields-custom-post-types';
$slug  = 'bigup-custom-fields-custom-post-types';

?>

<template id="inlineFormTemplate">
	<tr id="hiddenRow" class="editActive hidden"></tr>
	<tr id="editRow" class="editActive inline-edit-row inline-edit-row-page quick-edit-row quick-edit-row-page inline-edit-page inline-editor">
		<td colspan="5">
			<form method="post" action="options.php" class="inline-edit-wrapper">

				<fieldset class="inline-edit-fieldset">
					<legend class="inline-edit-legend">
						Edit Custom Post Type
					</legend>

					<template id="deleteFlag">
						<input type="hidden" name="bigup-custom-fields-custom-post-types-options[delete]" id="delete" value="1" checked></input>	
					</template>

					<?php
						settings_fields( $group );
						Process_Settings::do_settings_in_divs( $slug );
					?>

				</fieldset>
				<div class="submit inline-edit-save">
					<button
						type="button"
						title="Submit and save form"
						id="submitButton"
						class="button button-primary save"
					>
						Save
					</button>
					<button
						type="button"
						id="cancelButton"
						class="button"
					>
						Cancel
					</button>

				</div>
			</form>
		</td>
	</tr>
</template>

<h2 class="wp-heading-inline">
	Custom Post Types
</h2>

<button id="addNewButton" class="page-title-action">
	Add New
</button>

<table id="customPostsTable" class="wp-list-table widefat fixed striped table-view-list">
	<thead>
		<tr>
			<th scope="col" id="title" class="manage-column column-primary">
				<span>
					Post Type
				</span>
			</th>
			<th scope="col" id="icon" class="manage-column column-primary">
				<span>
					Icon
				</span>
			</th>
			<th scope="col" id="taxonomies" class="manage-column column-primary">
				<span>
					Taxonomies
				</span>
			</th>
			<th scope="col" id="public" class="manage-column column-primary">
				<span>
					Public
				</span>
			</th>
		</tr>
	</thead>
	<tbody id="the-list">

		<?php

		$custom_post_types = get_option( 'bigup-custom-fields-custom-post-types-options' );
		// $custom_post_types passed to front end session storage below the table.

		if ( false === $custom_post_types || ! is_array( $custom_post_types) ) {
			echo '<tr class="editActive"><td><strong>No custom post types found. Click "Add New" to create one.</strong></tr></td>';
			$custom_post_types = null;

		} else {
			foreach ( $custom_post_types as $cpt ) {

				$post_type_key    = $cpt['post_type'];
				$has_archive      = $cpt['has_archive'];
				$public           = ( $cpt['public'] ) ? '✔' : '';
				$show_in_menu     = $cpt['show_in_menu'];
				$menu_position    = $cpt['menu_position'];
				$menu_icon        = $cpt['menu_icon'];
				$hierarchical     = $cpt['hierarchical'];
				$taxonomies       = implode( ', ', $cpt['taxonomies'] );
				$show_in_rest     = $cpt['show_in_rest'];
				$show_in_graphql  = $cpt['show_in_graphql'];
				$name_plural      = $cpt['name_plural'];
				$name_singular    = $cpt['name_singular'];
				$delete_with_user = $cpt['delete_with_user'];

$html = <<<CPT
		<tr id="{$post_type_key}" class="customPostTypeRow iedit">
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
				<strong>
					{$name_singular}
				</strong>
				<div class="row-actions">
					<span class="inline hide-if-no-js">
						<button
							data-post-type="{$post_type_key}"
							type="button"
							class="inlineEditButton button-link editinline"
							aria-label="edit custom post type"
							aria-expanded="false"
						>
							Edit
						</button>
					</span>
					<span class="inline hide-if-no-js">
						|
					</span>
					<span class="hide-if-no-js">
						<button
							data-post-type="{$post_type_key}"
							type="button"
							class="inlineDeleteButton button-link"
							aria-label="delete custom post type"
							aria-expanded="false"
						>
							Delete
						</button>
					</span>
				</div>
			</td>
			<td class="has-row-actions column-primary" data-colname="Icon">
				<span class="dashicons {$menu_icon}"></span>
			</td>
			<td class="has-row-actions column-primary" data-colname="Taxonomies">
				{$taxonomies}
			</td>
			<td class="has-row-actions column-primary" data-colname="Public">
				{$public}
			</td>
		</tr>
CPT;
				echo $html;

			}// forEach end.
		?>

	</tbody>
</table>

		<?php

		}// if end.

		echo "<script>sessionStorage.setItem( 'bigupCPTOption', '" . wp_json_encode( $custom_post_types ) . "' );</script>\n";
