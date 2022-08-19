<?php ?>

<h2 class="wp-heading-inline">Custom Post Types</h2>

<a href="http://192.168.1.92:8001/wp-admin/post-new.php?post_type=page" class="page-title-action">Add New</a>

<table class="wp-list-table widefat fixed striped table-view-list pages">
	<thead>
		<tr>
			<td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">Select all</label><input id="cb-select-all-1" type="checkbox"></td>
			<th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a href="http://localhost:8001/wp-admin/edit.php?post_type=page&amp;orderby=title&amp;order=asc"><span>Title</span><span class="sorting-indicator"></span></a></th>
			<th scope="col" id="author" class="manage-column column-author">Author</th>
			<th scope="col" id="comments" class="manage-column column-comments num sortable desc"><a href="http://localhost:8001/wp-admin/edit.php?post_type=page&amp;orderby=comment_count&amp;order=asc"><span><span class="vers comment-grey-bubble" title="Comments"><span class="screen-reader-text">Comments</span></span></span><span class="sorting-indicator"></span></a></th>
			<th scope="col" id="date" class="manage-column column-date sortable asc"><a href="http://localhost:8001/wp-admin/edit.php?post_type=page&amp;orderby=date&amp;order=desc"><span>Date</span><span class="sorting-indicator"></span></a></th>
		</tr>
	</thead>
	<tbody id="the-list">
		<tr id="post-2" class="iedit author-self level-0 post-2 type-page status-publish hentry" style="">
			<th scope="row" class="check-column">
				<label class="screen-reader-text" for="cb-select-2">
				Select H1 Heading			</label>
				<input id="cb-select-2" type="checkbox" name="post[]" value="2">
				<div class="locked-indicator">
					<span class="locked-indicator-icon" aria-hidden="true"></span>
					<span class="screen-reader-text">
					“H1 Heading” is locked				</span>
				</div>
			</th>
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
				<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
				<strong><a class="row-title" href="http://localhost:8001/wp-admin/post.php?post=2&amp;action=edit" aria-label="“H1 Heading” (Edit)">H1 Heading</a></strong>
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
				<div class="row-actions"><span class="edit"><a href="http://localhost:8001/wp-admin/post.php?post=2&amp;action=edit" aria-label="Edit “H1 Heading”">Edit</a> | </span><span class="inline hide-if-no-js"><button type="button" class="button-link editinline" aria-label="Quick edit “H1 Heading” inline" aria-expanded="false">Quick&nbsp;Edit</button> | </span><span class="trash"><a href="http://localhost:8001/wp-admin/post.php?post=2&amp;action=trash&amp;_wpnonce=2efa6a683c" class="submitdelete" aria-label="Move “H1 Heading” to the Bin">Bin</a> | </span><span class="view"><a href="http://localhost:8001/sample-page/" rel="bookmark" aria-label="View “H1 Heading”">View</a></span></div>
				<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
			</td>
			<td class="author column-author" data-colname="Author"><a href="edit.php?post_type=page&amp;author=1">jeff</a></td>
			<td class="comments column-comments" data-colname="Comments">
				<div class="post-com-count-wrapper">
					<span aria-hidden="true">—</span><span class="screen-reader-text">No Comments</span><span class="post-com-count post-com-count-pending post-com-count-no-pending"><span class="comment-count comment-count-no-pending" aria-hidden="true">0</span><span class="screen-reader-text">No Comments</span></span>		
				</div>
			</td>
			<td class="date column-date" data-colname="Date">Published<br>2022/02/27 at 23:12</td>
		</tr>
		<tr id="post-3" class="iedit author-self level-1 post-3 type-page status-publish hentry">
			<th scope="row" class="check-column">
				<label class="screen-reader-text" for="cb-select-3">
				Select Privacy Policy			</label>
				<input id="cb-select-3" type="checkbox" name="post[]" value="3">
				<div class="locked-indicator">
					<span class="locked-indicator-icon" aria-hidden="true"></span>
					<span class="screen-reader-text">
					“Privacy Policy” is locked				</span>
				</div>
			</th>
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
				<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
				<strong><a class="row-title" href="http://localhost:8001/wp-admin/post.php?post=3&amp;action=edit" aria-label="“Privacy Policy” (Edit)">— Privacy Policy</a> — <span class="post-state">Privacy Policy Page</span></strong>
				<div class="hidden" id="inline_3">
					<div class="post_title">Privacy Policy</div>
					<div class="post_name">privacy-policy</div>
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
					<div class="post_parent">2</div>
					<div class="page_template">page-templates/toecaps-teal.php</div>
					<div class="menu_order">0</div>
				</div>
				<div class="row-actions"><span class="edit"><a href="http://localhost:8001/wp-admin/post.php?post=3&amp;action=edit" aria-label="Edit “Privacy Policy”">Edit</a> | </span><span class="inline hide-if-no-js"><button type="button" class="button-link editinline" aria-label="Quick edit “Privacy Policy” inline" aria-expanded="false">Quick&nbsp;Edit</button> | </span><span class="trash"><a href="http://localhost:8001/wp-admin/post.php?post=3&amp;action=trash&amp;_wpnonce=8166478061" class="submitdelete" aria-label="Move “Privacy Policy” to the Bin">Bin</a> | </span><span class="view"><a href="http://localhost:8001/sample-page/privacy-policy/" rel="bookmark" aria-label="View “Privacy Policy”">View</a></span></div>
				<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
			</td>
			<td class="author column-author" data-colname="Author"><a href="edit.php?post_type=page&amp;author=1">jeff</a></td>
			<td class="comments column-comments" data-colname="Comments">
				<div class="post-com-count-wrapper">
					<span aria-hidden="true">—</span><span class="screen-reader-text">No Comments</span><span class="post-com-count post-com-count-pending post-com-count-no-pending"><span class="comment-count comment-count-no-pending" aria-hidden="true">0</span><span class="screen-reader-text">No Comments</span></span>		
				</div>
			</td>
			<td class="date column-date" data-colname="Date">Published<br>2022/02/27 at 23:12</td>
		</tr>
		<tr id="post-9" class="iedit author-self level-0 post-9 type-page status-publish has-post-thumbnail hentry">
			<th scope="row" class="check-column">
				<label class="screen-reader-text" for="cb-select-9">
				Select Home			</label>
				<input id="cb-select-9" type="checkbox" name="post[]" value="9">
				<div class="locked-indicator">
					<span class="locked-indicator-icon" aria-hidden="true"></span>
					<span class="screen-reader-text">
					“Home” is locked				</span>
				</div>
			</th>
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
				<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
				<strong><a class="row-title" href="http://localhost:8001/wp-admin/post.php?post=9&amp;action=edit" aria-label="“Home” (Edit)">Home</a> — <span class="post-state">Front Page</span></strong>
				<div class="hidden" id="inline_9">
					<div class="post_title">Home</div>
					<div class="post_name">landing-page-developer</div>
					<div class="post_author">1</div>
					<div class="comment_status">closed</div>
					<div class="ping_status">closed</div>
					<div class="_status">publish</div>
					<div class="jj">28</div>
					<div class="mm">02</div>
					<div class="aa">2022</div>
					<div class="hh">01</div>
					<div class="mn">02</div>
					<div class="ss">50</div>
					<div class="post_password"></div>
					<div class="post_parent">0</div>
					<div class="page_template">page-templates/toecaps-home.php</div>
					<div class="menu_order">0</div>
				</div>
				<div class="row-actions"><span class="edit"><a href="http://localhost:8001/wp-admin/post.php?post=9&amp;action=edit" aria-label="Edit “Home”">Edit</a> | </span><span class="inline hide-if-no-js"><button type="button" class="button-link editinline" aria-label="Quick edit “Home” inline" aria-expanded="false">Quick&nbsp;Edit</button> | </span><span class="trash"><a href="http://localhost:8001/wp-admin/post.php?post=9&amp;action=trash&amp;_wpnonce=45cd193fed" class="submitdelete" aria-label="Move “Home” to the Bin">Bin</a> | </span><span class="view"><a href="http://localhost:8001/" rel="bookmark" aria-label="View “Home”">View</a></span></div>
				<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
			</td>
			<td class="author column-author" data-colname="Author"><a href="edit.php?post_type=page&amp;author=1">jeff</a></td>
			<td class="comments column-comments" data-colname="Comments">
				<div class="post-com-count-wrapper">
					<span aria-hidden="true">—</span><span class="screen-reader-text">No Comments</span><span class="post-com-count post-com-count-pending post-com-count-no-pending"><span class="comment-count comment-count-no-pending" aria-hidden="true">0</span><span class="screen-reader-text">No Comments</span></span>		
				</div>
			</td>
			<td class="date column-date" data-colname="Date">Published<br>2022/02/28 at 01:02</td>
		</tr>
		<tr id="post-99" class="iedit author-self level-0 post-99 type-page status-publish has-post-thumbnail hentry">
			<th scope="row" class="check-column">
				<label class="screen-reader-text" for="cb-select-99">
				Select Tan parent			</label>
				<input id="cb-select-99" type="checkbox" name="post[]" value="99">
				<div class="locked-indicator">
					<span class="locked-indicator-icon" aria-hidden="true"></span>
					<span class="screen-reader-text">
					“Tan parent” is locked				</span>
				</div>
			</th>
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
				<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
				<strong><a class="row-title" href="http://localhost:8001/wp-admin/post.php?post=99&amp;action=edit" aria-label="“Tan parent” (Edit)">Tan parent</a></strong>
				<div class="hidden" id="inline_99">
					<div class="post_title">Tan parent</div>
					<div class="post_name">tan-parent</div>
					<div class="post_author">1</div>
					<div class="comment_status">closed</div>
					<div class="ping_status">closed</div>
					<div class="_status">publish</div>
					<div class="jj">07</div>
					<div class="mm">05</div>
					<div class="aa">2022</div>
					<div class="hh">22</div>
					<div class="mn">47</div>
					<div class="ss">33</div>
					<div class="post_password"></div>
					<div class="post_parent">0</div>
					<div class="page_template">page-templates/toecaps-tan.php</div>
					<div class="menu_order">0</div>
				</div>
				<div class="row-actions"><span class="edit"><a href="http://localhost:8001/wp-admin/post.php?post=99&amp;action=edit" aria-label="Edit “Tan parent”">Edit</a> | </span><span class="inline hide-if-no-js"><button type="button" class="button-link editinline" aria-label="Quick edit “Tan parent” inline" aria-expanded="false">Quick&nbsp;Edit</button> | </span><span class="trash"><a href="http://localhost:8001/wp-admin/post.php?post=99&amp;action=trash&amp;_wpnonce=90c0c39235" class="submitdelete" aria-label="Move “Tan parent” to the Bin">Bin</a> | </span><span class="view"><a href="http://localhost:8001/tan-parent/" rel="bookmark" aria-label="View “Tan parent”">View</a></span></div>
				<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
			</td>
			<td class="author column-author" data-colname="Author"><a href="edit.php?post_type=page&amp;author=1">jeff</a></td>
			<td class="comments column-comments" data-colname="Comments">
				<div class="post-com-count-wrapper">
					<span aria-hidden="true">—</span><span class="screen-reader-text">No Comments</span><span class="post-com-count post-com-count-pending post-com-count-no-pending"><span class="comment-count comment-count-no-pending" aria-hidden="true">0</span><span class="screen-reader-text">No Comments</span></span>		
				</div>
			</td>
			<td class="date column-date" data-colname="Date">Published<br>2022/05/07 at 22:47</td>
		</tr>
		<tr id="post-96" class="iedit author-self level-1 post-96 type-page status-publish hentry">
			<th scope="row" class="check-column">
				<label class="screen-reader-text" for="cb-select-96">
				Select Wooden Gates			</label>
				<input id="cb-select-96" type="checkbox" name="post[]" value="96">
				<div class="locked-indicator">
					<span class="locked-indicator-icon" aria-hidden="true"></span>
					<span class="screen-reader-text">
					“Wooden Gates” is locked				</span>
				</div>
			</th>
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
				<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
				<strong><a class="row-title" href="http://localhost:8001/wp-admin/post.php?post=96&amp;action=edit" aria-label="“Wooden Gates” (Edit)">— Wooden Gates</a></strong>
				<div class="hidden" id="inline_96">
					<div class="post_title">Wooden Gates</div>
					<div class="post_name">wooden-gates</div>
					<div class="post_author">1</div>
					<div class="comment_status">closed</div>
					<div class="ping_status">closed</div>
					<div class="_status">publish</div>
					<div class="jj">06</div>
					<div class="mm">05</div>
					<div class="aa">2022</div>
					<div class="hh">23</div>
					<div class="mn">38</div>
					<div class="ss">53</div>
					<div class="post_password"></div>
					<div class="post_parent">99</div>
					<div class="page_template">page-templates/toecaps-tan.php</div>
					<div class="menu_order">0</div>
				</div>
				<div class="row-actions"><span class="edit"><a href="http://localhost:8001/wp-admin/post.php?post=96&amp;action=edit" aria-label="Edit “Wooden Gates”">Edit</a> | </span><span class="inline hide-if-no-js"><button type="button" class="button-link editinline" aria-label="Quick edit “Wooden Gates” inline" aria-expanded="false">Quick&nbsp;Edit</button> | </span><span class="trash"><a href="http://localhost:8001/wp-admin/post.php?post=96&amp;action=trash&amp;_wpnonce=104ce38989" class="submitdelete" aria-label="Move “Wooden Gates” to the Bin">Bin</a> | </span><span class="view"><a href="http://localhost:8001/tan-parent/wooden-gates/" rel="bookmark" aria-label="View “Wooden Gates”">View</a></span></div>
				<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
			</td>
			<td class="author column-author" data-colname="Author"><a href="edit.php?post_type=page&amp;author=1">jeff</a></td>
			<td class="comments column-comments" data-colname="Comments">
				<div class="post-com-count-wrapper">
					<span aria-hidden="true">—</span><span class="screen-reader-text">No Comments</span><span class="post-com-count post-com-count-pending post-com-count-no-pending"><span class="comment-count comment-count-no-pending" aria-hidden="true">0</span><span class="screen-reader-text">No Comments</span></span>		
				</div>
			</td>
			<td class="date column-date" data-colname="Date">Published<br>2022/05/06 at 23:38</td>
		</tr>
		<tr id="post-82" class="iedit author-self level-2 post-82 type-page status-publish hentry">
			<th scope="row" class="check-column">
				<label class="screen-reader-text" for="cb-select-82">
				Select Somepage			</label>
				<input id="cb-select-82" type="checkbox" name="post[]" value="82">
				<div class="locked-indicator">
					<span class="locked-indicator-icon" aria-hidden="true"></span>
					<span class="screen-reader-text">
					“Somepage” is locked				</span>
				</div>
			</th>
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
				<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
				<strong><a class="row-title" href="http://localhost:8001/wp-admin/post.php?post=82&amp;action=edit" aria-label="“Somepage” (Edit)">— — Somepage</a></strong>
				<div class="hidden" id="inline_82">
					<div class="post_title">Somepage</div>
					<div class="post_name">somepage</div>
					<div class="post_author">1</div>
					<div class="comment_status">closed</div>
					<div class="ping_status">closed</div>
					<div class="_status">publish</div>
					<div class="jj">27</div>
					<div class="mm">04</div>
					<div class="aa">2022</div>
					<div class="hh">21</div>
					<div class="mn">49</div>
					<div class="ss">06</div>
					<div class="post_password"></div>
					<div class="post_parent">96</div>
					<div class="page_template">page-templates/toecaps-tan.php</div>
					<div class="menu_order">0</div>
				</div>
				<div class="row-actions"><span class="edit"><a href="http://localhost:8001/wp-admin/post.php?post=82&amp;action=edit" aria-label="Edit “Somepage”">Edit</a> | </span><span class="inline hide-if-no-js"><button type="button" class="button-link editinline" aria-label="Quick edit “Somepage” inline" aria-expanded="false">Quick&nbsp;Edit</button> | </span><span class="trash"><a href="http://localhost:8001/wp-admin/post.php?post=82&amp;action=trash&amp;_wpnonce=b2dc467784" class="submitdelete" aria-label="Move “Somepage” to the Bin">Bin</a> | </span><span class="view"><a href="http://localhost:8001/tan-parent/wooden-gates/somepage/" rel="bookmark" aria-label="View “Somepage”">View</a></span></div>
				<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
			</td>
			<td class="author column-author" data-colname="Author"><a href="edit.php?post_type=page&amp;author=1">jeff</a></td>
			<td class="comments column-comments" data-colname="Comments">
				<div class="post-com-count-wrapper">
					<span aria-hidden="true">—</span><span class="screen-reader-text">No Comments</span><span class="post-com-count post-com-count-pending post-com-count-no-pending"><span class="comment-count comment-count-no-pending" aria-hidden="true">0</span><span class="screen-reader-text">No Comments</span></span>		
				</div>
			</td>
			<td class="date column-date" data-colname="Date">Published<br>2022/04/27 at 21:49</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-2">Select all</label><input id="cb-select-all-2" type="checkbox"></td>
			<th scope="col" class="manage-column column-title column-primary sortable desc"><a href="http://localhost:8001/wp-admin/edit.php?post_type=page&amp;orderby=title&amp;order=asc"><span>Title</span><span class="sorting-indicator"></span></a></th>
			<th scope="col" class="manage-column column-author">Author</th>
			<th scope="col" class="manage-column column-comments num sortable desc"><a href="http://localhost:8001/wp-admin/edit.php?post_type=page&amp;orderby=comment_count&amp;order=asc"><span><span class="vers comment-grey-bubble" title="Comments"><span class="screen-reader-text">Comments</span></span></span><span class="sorting-indicator"></span></a></th>
			<th scope="col" class="manage-column column-date sortable asc"><a href="http://localhost:8001/wp-admin/edit.php?post_type=page&amp;orderby=date&amp;order=desc"><span>Date</span><span class="sorting-indicator"></span></a></th>
		</tr>
	</tfoot>
</table>
