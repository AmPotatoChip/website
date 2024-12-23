!{validate form="main_contact" field="fname" criteria="notEmpty" assign="error_fname" message="First Name is required"}
!{validate form="main_contact" field="lname" criteria="notEmpty" assign="error_lname" message="Last Name is required"}

<h2>Main Contact Info</h2>

<form name="main_contact" method="POST" action="edit_address_main.php">

<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
</thead>
!{if $error_fname}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_fname}</td>
</tr>
!{/if}
<tr>
	<td id="right">First Name:</td>
	<td><input type="text" name="fname" value="!{$fname|stripslashes}" size="40" maxlength="120"></td>
</tr>
<tr>
	<td id="right">Middle Initial:</td>
	<td><input type="text" name="mname" value="!{$mname|stripslashes}" size="1" maxlength="1"></td>
</tr>
!{if $error_lname}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_lname}</td>
</tr>
!{/if}
<tr>
	<td id="right">Last Name:</td>
	<td><input type="text" name="lname" value="!{$lname|stripslashes}" size="40" maxlength="200"></td>
</tr>
<tr>
	<td id="right">Company Name:</td>
	<td><input type="text" name="company_name" value="!{$company_name|stripslashes}" size="40" maxlength="200"></td>
</tr>
<tr>
	<td id="right">Newsletter:</td>
	<td><select name="newsletter">
	<option value="Y" !{if $newsletter eq 'Y'}selected!{/if}/>Yes
	<option value="N" !{if $newsletter eq 'N'}selected!{/if}/>No
	</select></td>
</tr>
<tfoot>
<tr>
<td colspan="2" align="right"><input type="submit" name="submit" value="Update"></td>
</tr>
</tfoot>
</table>

!{if $smarty.get.contact_id}
	<input type="hidden" name="contact_id" value="!{$smarty.get.contact_id}">
!{else}
	<input type="hidden" name="contact_id" value="!{$contact_id}">
!{/if}






</form>