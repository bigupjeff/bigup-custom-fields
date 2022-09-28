
<h2 class="wp-heading-inline">
	Custom Post Types
</h2>

<a href="http://192.168.1.92:8001/wp-admin/post-new.php?post_type=page" class="page-title-action">
	Add New
</a>

<table class="wp-list-table widefat fixed striped table-view-list pages">
	<thead>
		<tr>
			<th scope="col" id="title" class="manage-column column-title column-primary sortable desc">
				<a href="http://localhost:8001/wp-admin/edit.php?post_type=page&amp;orderby=title&amp;order=asc">
					<span>
						Post Type
					</span>
					<span class="sorting-indicator"></span>
				</a>
			</th>
		</tr>
	</thead>
	<tbody id="the-list">

		<?php

		$option_name = 'bigup-custom-fields-custom-post-types-options';
		$option      = get_option( $option_name );
		$post_types  = ( 0 < count($option) ) ? $option : '';

		echo '<pre>';
			var_dump( $post_types );
		echo '</pre>';

		foreach ( $post_types as $cpt ) {

			$cpt_name         = $cpt['post_type'];
			$has_archive      = $cpt['args']['has_archive'];
			$public           = $cpt['args']['public'];
			$show_in_menu     = $cpt['args']['show_in_menu'];
			$menu_position    = $cpt['args']['menu_position'];
			$menu_icon        = $cpt['args']['menu_icon'];
			$hierarchical     = $cpt['args']['hierarchical'];
			$taxonomies       = $cpt['args']['taxonomies'];
			$show_in_rest     = $cpt['args']['show_in_rest'];
			$show_in_graphql  = $cpt['args']['show_in_graphql'];
			$name_plural      = $cpt['args']['name_plural'];
			$name_singular    = $cpt['args']['name_singular'];
			$delete_with_user = $cpt['args']['delete_with_user'];

echo <<<CPT
		<tr id="post-2" class="iedit author-self level-0 post-2 type-page status-publish hentry" style="">
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
				<div class="locked-info">
					<span class="locked-avatar"></span>
					<span class="locked-text"></span>
				</div>
				<strong>
					<a class="row-title" href="http://localhost:8001/wp-admin/post.php?post=2&amp;action=edit" aria-label="“H1 Heading” (Edit)">
						{$cpt_name}
					</a>
				</strong>
				<div class="hidden" id="inline_2">
					<div class="post_title">H1 Heading</div>
					<div class="post_name">sample-page</div>
					<div class="post_author">1</div>
					<div class="comment_status">closed</div>
					<div class="ping_status">closed</div>
					<div class="_status">publish</div>
					<div class="jj">27</div>
					<div class="mm">02</div>
					<div class="aa">2022</div>
					<div class="hh">23</div>
					<div class="mn">12</div>
					<div class="ss">49</div>
					<div class="post_password"></div>
					<div class="post_parent">0</div>
					<div class="page_template">page-templates/toecaps-teal.php</div>
					<div class="menu_order">0</div>
				</div>
				<div class="row-actions">
					<span class="edit">
						<a href="http://localhost:8001/wp-admin/post.php?post=2&amp;action=edit" aria-label="Edit “H1 Heading”">
							Edit
						</a>
						|
					</span>
					<span class="inline hide-if-no-js">
						<button type="button" class="button-link editinline" aria-label="Quick edit “H1 Heading” inline" aria-expanded="false">
							Quick&nbsp;Edit
						</button>
						|
					</span>
					<span class="trash">
						<a href="http://localhost:8001/wp-admin/post.php?post=2&amp;action=trash&amp;_wpnonce=2efa6a683c" class="submitdelete" aria-label="Move “H1 Heading” to the Bin">
							Bin
						</a>
						|
					</span>
					<span class="view">
						<a href="http://localhost:8001/sample-page/" rel="bookmark" aria-label="View “H1 Heading”">
							View
						</a>
					</span>
				</div>
				<button type="button" class="toggle-row">
					<span class="screen-reader-text">
						Show more details
					</span>
				</button>
			</td>
		</tr>
CPT;

		}
		?>




	</tbody>
</table>
