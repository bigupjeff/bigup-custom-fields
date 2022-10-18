<?php
namespace Bigup\Custom_Fields;
$group    = 'bigup-custom-fields-custom-post-types';
$slug     = 'bigup-custom-fields-custom-post-types';
?>

<template>
	<tr class="inline-edit-row inline-edit-row-page quick-edit-row quick-edit-row-page inline-edit-page inline-editor" style="">
		<td>
			<div class="inline-edit-wrapper">
				<fieldset class="inline-edit-col-left">
					<legend class="inline-edit-legend">
						Quick Edit
					</legend>
					<div class="inline-edit-col">

						<?php

							settings_errors();
							settings_fields( $group );
							do_settings_sections( $slug );

						?>

					</div>
				</fieldset>
				<fieldset class="inline-edit-col-right">
					<div class="inline-edit-col"></div>
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

<a href="http://192.168.1.92:8001/wp-admin/post-new.php?post_type=page" class="page-title-action">
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

		$option_name = 'bigup-custom-fields-custom-post-types-options';
		$option      = get_option( $option_name );
		$post_types  = ( 0 < count( $option ) ) ? $option : '';

		// Pass the CPT option to front end session storage.
		echo "<script>sessionStorage.setItem( 'bigupCPTOption', '" . json_encode($option) . "' );</script>";

		foreach ( $post_types as $cpt ) {

			$cpt_name         = $cpt['post_type'];
			$has_archive      = $cpt['args']['has_archive'];
			$public           = ( $cpt['args']['public'] ) ? '✔' : '';
			$show_in_menu     = $cpt['args']['show_in_menu'];
			$menu_position    = $cpt['args']['menu_position'];
			$menu_icon        = $cpt['args']['menu_icon'];
			$hierarchical     = $cpt['args']['hierarchical'];
			$taxonomies       = implode( ', ', $cpt['args']['taxonomies'] );
			$show_in_rest     = $cpt['args']['show_in_rest'];
			$show_in_graphql  = $cpt['args']['show_in_graphql'];
			$name_plural      = $cpt['args']['name_plural'];
			$name_singular    = $cpt['args']['name_singular'];
			$delete_with_user = $cpt['args']['delete_with_user'];

echo <<<CPT
		<tr id="{$cpt_name}" class="iedit" style="">
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
				<strong>
					<a class="row-title" href="http://localhost:8001/wp-admin/post.php?post=2&amp;action=edit" aria-label="“H1 Heading” (Edit)">
						{$name_plural}
					</a>
				</strong>
				<div class="row-actions">
					<span class="inline hide-if-no-js">
						<button type="button" class="button-link editinline" aria-label="edit" aria-expanded="false">
							Edit
						</button>
						|
					</span>
					<span class="trash">
						<a href="http://localhost:8001/wp-admin/post.php?post=2&amp;action=trash&amp;_wpnonce=2efa6a683c" class="submitdelete" aria-label="Move “H1 Heading” to the Bin">
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

		}
		?>




	</tbody>
</table>
