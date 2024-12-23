<table border="0" cellpadding="3" cellspacing="0" id="display" width="740">
<thead>
	<tr>
		<td colspan="5">Results: !{$search_result|@count}</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>Email</td>
		<td>Phone</td>
		<td align="center" width="50">Edit</td>
		<td align="center" width="50">Delete</td>
	</tr>
</thead>

<tbody style="overflow-y:auto;overflow-x:hidden;height:400px;">
!{section name="item" loop="$search_result"}
	<tr bgcolor="!{cycle values="#FFFCDF,#FFFFFF"}">
		<td>!{$search_result[item]->fname|stripslashes} !{$search_result[item]->lname|stripslashes}</td>
		<td><a href="mailto:!{$search_result[item]->email}">!{$search_result[item]->email}</a></td>
		<td>!{$search_result[item]->phone}</td>
		<td align="center"><a href="edit_contact.php?contact_id=!{$search_result[item]->id}"><img src="/images/icons/contact_edit_16.gif" border="0" /></a></td>
		<td align="center"><a href="delete_contact.php?contact_id=!{$search_result[item]->id}" onClick="return confirm('Are you sure you would like to delete this contact?');"><img src="/images/icons/contact_close_16.gif" border="0" /></a></td>
	</tr>
!{/section}	
</tbody>

</table>