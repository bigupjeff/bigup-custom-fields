<?php
/**
 * Custom Posts Tab Template
 *
 * @package herringbone
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace Bigup\Custom_Fields;

$group   = 'bigup-custom-fields-custom-post-types';
$slug    = 'bigup-custom-fields-custom-post-types';

?>

<template id="inlineEditTemplate">
	<tr class="hidden"></tr>
	<tr id="inlineEditRow" class="inline-edit-row inline-edit-row-page quick-edit-row quick-edit-row-page inline-edit-page inline-editor">
		<td colspan="5">
			<div class="inline-edit-wrapper">
				<fieldset class="inline-edit-fieldset">
					<legend class="inline-edit-legend">
						Edit Custom Post Type
					</legend>

						<?php
							settings_errors();
							settings_fields( $group );
							Process_Settings::do_settings_in_divs( $slug );
						?>

				</fieldset>
				<div class="submit inline-edit-save">

					<?php
					submit_button(
						'Save',                       // Button Text.
						'button button-primary save', // CSS Classes.
						'submit',                     // HTML name attribute.
						false,                        // Wrap in <p>.
					);
					?>

					<button type="button" class="button cancel">Cancel</button>

				</div>
			</div>
		</td>
	</tr>
</template>

<h2 class="wp-heading-inline">
	Custom Post Types
</h2>

<a href="#" class="page-title-action">
	Add New
</a>

<table class="wp-list-table widefat fixed striped table-view-list">
	<thead>
		<tr>
			<th scope="col" id="title" class="manage-column column-title column-primary sortable desc">
				<a href="http://localhost:8001/wp-admin/edit.php?post_type=page&amp;orderby=title&amp;order=asc">
					<span>
						Post Type
					</span>
				</a>
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

		$option = get_option( 'bigup-custom-fields-custom-post-types-options' );
		if ( false === $option ) {
			echo '<tr><td><strong>No custom post types found. Click "Add New" to create one.</strong></tr></td>';
			return;
		}
		$post_types  = ( 0 < count( $option ) ) ? $option : '';

		// Pass the CPT option to front end session storage.
		echo "<script>sessionStorage.setItem( 'bigupCPTOption', '" . wp_json_encode( $option ) . "' );</script>";

		foreach ( $post_types as $cpt ) {

			$cpt_name         = $cpt['post_type'];
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
		<tr id="{$cpt_name}" class="iedit" style="">
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
				<strong>
					<a class="row-title" href="#" aria-label="“H1 Heading” (Edit)">
						{$name_plural}
					</a>
				</strong>
				<div class="row-actions">
					<span class="inline hide-if-no-js">
						<button data-post-type="{$cpt_name}" type="button" class="inlineEditButton button-link editinline" aria-label="edit" aria-expanded="false">
							Edit
						</button>
						|
					</span>
					<span class="trash">
						<a href="#" class="submitdelete" aria-label="Move “H1 Heading” to the Bin">
							Bin
						</a>
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

		}
		?>

	</tbody>
</table>