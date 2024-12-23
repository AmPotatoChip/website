!{validate form="test_group" field="group_name" criteria="notEmpty" assign="error_group_name" message="Group Name is required and can not be empty"}
!{validate form="test_group" field="emails" criteria="notEmpty" assign="error_emails" message="You have to have at least one email in the test group"}
<br />
<p>
<a href="javascript:;" class="link" onclick="hideunhide('test_group_form');" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/clients_add_16.gif" border="0" />Create a new test group</a></p>
<p>
<table border="0" cellpadding="3" cellspacing="0" id="form" width="100%">
<thead>
<tr>
<td>Name of Group</td>
<td width="120" align="right">Number of emails</td>
<td width="50" align="center">Emails</td>
<td width="50" align="center">Edit</td>
<td width="50" align="center">Delete</td>
</tr>
</thead>
<tbody>
!{section name="group" loop="$testgroups"}
<tr bgcolor="!{cycle values="#FFFCDF,#FFFFFF"}">
<td>!{$testgroups[group]->name|stripslashes}</td>
<td width="120" align="right">!{$testgroups[group]->email_count}</td>
<td width="50" align="center"><a href="javascript:;" class="link" onClick="alert('!{$testgroups[group]->emails}');">show</a></td>
<td width="50" align="center"><a href="bulkmail.php?type=mtg&group_id=!{$testgroups[group]->id}" class="link"><img src="/images/icons/clients_edit_16.gif" border="0"></a></td>
<td width="50" align="center"><a href="delete_testgroup.php?group_id=!{$testgroups[group]->id}" class="link" onClick="return confirm('Are you sure you would like to delete this test group?');"><img src="/images/icons/clients_close_16.gif" border="0"></a></td>
</tr>
!{/section}


</tbody>
</table>
</p>

<div id="test_group_form" style="display:none">
<form name="test_group" method="POST" action="bulkmail.php?type=mtg">
<table border="0" cellpadding="3" cellspacing="0" id="form">
!{if $error_group_name}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_group_name}</td>
</tr>
!{/if}
<tr>
<td id="right">Group Name:</td>
<td><input type="text" name="group_name" value="!{$group_name|stripslashes}" size="40"></td>
</tr>
!{if $error_emails}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_emails}</td>
</tr>
!{/if}
<tr>
<td id="right" valign="top">Emails:</td>
<td><textarea cols="60" rows="4" name="emails">!{$emails|stripslashes}</textarea></td>
</tr>
<tfoot>
<tr>
<td colspan="2" align="right">
!{if $group_id}
<input type="submit" value="Update test group">
!{else}
<input type="submit" value="Add new test group">
!{/if}
</td>
</tr>
</tfoot>
</table>
<input type="hidden" name="group_id" value="!{$group_id}">
<input type="hidden" name="form_name" value="test_group">
</form>
</p>

!{if $show_form}
<script language="javascript">
onload = hideunhide('test_group_form');
</script>
!{/if}