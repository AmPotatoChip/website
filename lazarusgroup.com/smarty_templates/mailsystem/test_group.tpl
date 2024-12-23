<div style="padding: 10 0 0 0;">


<form name="test_group" id="test_group" method="POST" action="test_group.php" onSubmit="return CheckEmails('test_group');">
<table border="0" cellpadding="3" cellspacing="0" align="center" class="form">
<thead>
<tr>
<td colspan="2">Test Group</td>
</tr>
</thead>

<tbody>
<tr>
<td class="form">Group Name:</td>
<td><input type="text" name="name" id="name" size="30" value="!{$name}"></td>
</tr>
<tr>
<td class="form">Email 1:</td>
<td><input type="text" name="email1" id="email1" value="!{$email1}" size="30"></td>
</tr>
<tr>
<td class="form">Email 2:</td>
<td><input type="text" name="email2" id="email2" value="!{$email2}" size="30"></td>
</tr>
<tr>
<td class="form">Email 3:</td>
<td><input type="text" name="email3" id="email3" value="!{$email3}" size="30"></td>
</tr>
<tr>
<td class="form">Email 4:</td>
<td><input type="text" name="email4" id="email4" value="!{$email4}" size="30"></td>
</tr>
<tr>
<td class="form">Email 5:</td>
<td><input type="text" name="email5" id="email5" value="!{$email5}" size="30"></td>
</tr>

<tfoot>
<tr>
<td colspan="2" align="center">
!{if $update}
<input type="submit" name="submit" value="Update Test Group">
<input type="hidden" name="group_id" id="group_id" value="!{$id}">
!{else}
<input type="submit" name="submit" value="Create New Test Group"></td>
!{/if}
</tr>
</tfoot>
</tbody>

</table>
</form>

</div>