!{validate form="category" field="category_name" criteria="notEmpty" transform="trim" assign="error_category" message="Category Name is required"}
!{validate form="category" field="display" criteria="notEmpty" assign="error_display" message="Display Category is required"}
<br />
<p>
<a href="javascript:;" class="link" onClick="hideunhide('category_form');" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/folder_add_16.gif" border="0" /> Add a new category</a>
</p>
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
<tr>
<td colspan="4">Bulk Mail Categories</td>
</tr>
<tr>
	<td width="250">Category Name</td>
	<td width="100">Display</td>
	<td width="60" align="center">Edit</td>
	<td width="60" align="center">Delete</td>
</tr>
</thead>
<tbody>
!{if $bulkmail_categories}
!{section name="item" loop=$bulkmail_categories}
<tr>
	<td>!{$bulkmail_categories[item]->category}</td>
	<td>!{$bulkmail_categories[item]->display}</td>
	<td align="center"><a href="bulkmail.php?type=bmc&edit=!{$bulkmail_categories[item]->id}" class="link"><img src="/images/icons/mail_edit_16.gif" border="0" /></a></td>
	<td align="center"><a href="delete_bulkmail_category.php?category_id=!{$bulkmail_categories[item]->id}" class="link" onClick="return confirm('Are you sure you would like to delete this category?\nThis will remove the contacts out of this category as well.');"><img src="/images/icons/mail_close_16.gif" border="0" /></a></td>
</tr>
!{/section}
!{else}
<tr>
<td colspan="3" id="red">You currently do not have any categories</td>
</tr>
!{/if}
</tbody>
</table>


<div id="category_form" style="display:none;">
<br/>
<form name="category" method="POST" action="bulkmail.php?type=bmc">
<table border="0" cellpadding="3" cellspacing="0" id="form">
<tbody>
!{if $error_category}
<tr>
<td colspan="2" id="red">!{$error_category}</td>
</tr>
!{/if}
<tr>
<td id="right">Category Name:</td>
<td><input type="text" name="category_name" value="!{$category_name|stripslashes}" size="40" maxlength="80"></td>
</tr>
!{if $error_display}
<tr>
<td colspan="2" id="red">!{$error_display}</td>
</tr>
!{/if}
<tr>
<td id="right">Display Category:</td>
<td><input type="radio" name="display" value="es" !{if $display eq 'yes'}checked!{/if}>Yes<input type="radio" name="display" value="no" !{if $display eq 'no'}checked!{/if}>No
</tr>

<tr>
<td colspan="2" align="right">
!{if $update}
<input type="submit" name="submit" value="Update Category">
!{else}
<input type="submit" name="submit" value="Add Category">
!{/if}
</td>
</tr>

</tbody>
</table>
<input type="hidden" name="form_name" value="category">
!{if $update}
<input type="hidden" name="update" value="!{$update}">
!{/if}
</form>
</div>

!{if $show_form}
<script language="javascript">
onload = hideunhide('category_form');
</script>
!{/if}