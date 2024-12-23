!{validate form="address_form" field="address" criteria="notEmpty" assign="error_address" message="Address can not be empty"}
!{validate form="address_form" field="city" criteria="notEmpty" assign="error_city" message="City can not be empty"}
!{validate form="address_form" field="state" criteria="notEmpty" assign="error_state" message="State can not be empty"}
!{validate form="address_form" field="postal_code" criteria="notEmpty" assign="error_postal_code" message="Zip can not be empty"}

<h2>Contact Address</h2>
!{include file="admin/_error.tpl"}


!{if $smarty.get.address_id && $smarty.get.contact_id}
<form name="address_form" method="POST" action="edit_address.php?address_id=!{$smarty.get.address_id}&contact_id=!{$smarty.get.contact_id}">
!{else}
<form name="address_form" method="POST" action="edit_address.php">
!{/if}

<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
</thead>
<tbody>
<tr>
	<td id="right">Address Name:</td>
	<td><input type="text" name="address_info" value="!{$address_info|stripslashes}" size="40"></td>
</tr>
!{if $error_address}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_address|stripslashes}</td>
</tr>
!{/if}
<tr>
<td id="right">Address:</td>
<td><input type="text" name="address" value="!{$address|stripslashes}" size="40"></td>
</tr>
<tr>
<td id="right">&nbsp;</td>
<td><input type="text" name="address2" value="!{$address2|stripslashes}" size="40"></td>
</tr>
!{if $error_city}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_city|stripslashes}</td>
</tr>
!{/if}
<tr>
<td id="right">City:</td>
<td><input type="text" name="city" value="!{$city|stripslashes}" size="40"></td>
</tr>
!{if $error_state}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_state|stripslashes}</td>
</tr>
!{/if}
<tr>
<td id="right">State:</td>
<td><input type="text" name="state" value="!{$state|stripslashes}" size="2" maxlength="2"></td>
</tr>
!{if $error_postal_code}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_postal_code|stripslashes}</td>
</tr>
!{/if}
<tr>
<td id="right">Zip:</td>
<td><input type="text" name="postal_code" value="!{$postal_code|stripslashes}" size="10"></td>
</tr>
</tbody>
<tfoot>
<tr>
<td colspan="2" align="right">
!{if $smarty.get.address_id}
<input type="submit" name="submit" value="Update">
!{else}
<input type="submit" name="submit" value="Add New Address">
!{/if}
</td>
</tr>
</tfoot>
</table>

!{if $smarty.get.address_id}
<input type="hidden" name="address_id" value="!{$smarty.get.address_id}">
!{/if}

!{if $smarty.get.contact_id}
<input type="hidden" name="contact_id" value="!{$smarty.get.contact_id}">
!{/if}


</form>