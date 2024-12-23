!{validate form="email_form" field="email" criteria="isEmail" assign="error_email" message="The Email address has to be valid"}

<h2>Email Address</h2>
!{include file="admin/_error.tpl"}

!{if $smarty.get.email_id && $smarty.get.contact_id}
<form name="email_form" method="POST" action="edit_email.php?email_id=!{$smarty.get.email_id}&contact_id=!{$smarty.get.contact_id}">
!{else}
<form name="email_form" method="POST" action="edit_email.php?contact_id=!{$smarty.get.contact_id}">
!{/if}
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
</thead>
<tbody>
<tr>
<td id="right">Email Type:</td>
<td><input type="text" name="email_type" value="!{$email_type|stripslashes}" size="40"></td>
</tr>
!{if $error_email}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_email}</td>
</tr>
!{/if}
<tr>
<td id="right">Email:</td>
<td><input type="text" name="email" value="!{$email}" size="40"></td>
</tr>
</tbody>
<tfoot>
<tr>
<td colspan="2" align="right">
!{if $smarty.get.email_id}
<input type="submit" name="submit" value="Update Email">
!{else}
<input type="submit" name="submit" value="Add Email">
!{/if}
</td>
</tr>
</tfoot>
</table>

!{if $smarty.get.contact_id}
<input type="hidden" name="contact_id" value="!{$smarty.get.contact_id}">
!{/if}

!{if $smarty.get.email_id}
<input type="hidden" name="email_id" value="!{$smarty.get.email_id}">
!{/if}
</form>