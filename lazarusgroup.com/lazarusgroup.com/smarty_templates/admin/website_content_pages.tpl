<table border="0" cellpadding="3" cellspacing="0" id="display" width="100%">
<thead>
	<tr>
	<td>Name</td>
	<td>Description</td>
	<td width="60" align="center">Edit</td>	
	<td width="60" align="center">Content</td>
	</tr>
</thead>
<tbody style="overflow-y:auto;overflow-x:hidden;height:400px;">
	!{section name="item" loop="$cat"}
	<tr bgcolor="!{cycle values="#FFFFFF,#DFE5FF"}">
	<td>!{$cat[item]->name}</td>
	<td>!{$cat[item]->description}</td>
	<td align="center"><a href="?catid=!{$cat[item]->id}&type=category"><img src="/images/icons/doc_config_16.gif" border="0"></a></td>
	<td align="center"><a href="content_editor.php?catid=!{$cat[item]->id}&type=live"><img src="/images/icons/doc_edit_16.gif" border="0"></a></td>
	</tr>
	!{/section}
</tbody>
</table>