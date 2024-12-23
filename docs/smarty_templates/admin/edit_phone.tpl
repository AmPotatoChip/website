!{validate form="phone_form" field="phone" criteria="notEmpty" assign="error_phone" message="Phone Number can not be empty"}

<h2>Contact Phone</h2>
!{include file="admin/_error.tpl"}


!{if $smarty.get.phone_id}
<form name="phone_form" method="POST" action="edit_phone.php?phone_id=!{$smarty.get.phone_id}&contact_id=!{$smarty.get.contact_id}">
!{else}
<form name="phone_form" method="POST" action="edit_phone.php?contact_id=!{$smarty.get.contact_id}">
!{/if}

<table border="0" cellpadding="3" cellspacing="0" id="form">
	<thead>
	<tr>
	<td colspan="2">&nbsp;</td>
	</tr>
	</thead>
	<tbody>
		<tr>
		<td>Phone Type:</td>
		<td><input type="text" name="phone_type" value="!{$phone_type}" size="40"></td>
		</tr>
		<tr>
		<td>Phone:</td>
		<td><input type="text" name="phone" value="!{$phone}" size="20" maxlength="20"></td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2" align="right">
			!{if $smarty.get.phone_id}
				<input type="submit" name="submit" value="Update Phone Number">
			!{else}
				<input type="submit" name="submit" value="Add New Phone Number">
			!{/if}
			</td>
		</tr>
	</tfoot>
</table>

!{if $smarty.get.phone_id}
<input type="hidden" name="phone_id" value="!{$smarty.get.phone_id}">
!{/if}
<input type="hidden" name="contact_id" value="!{$smarty.get.contact_id}" >
</form>