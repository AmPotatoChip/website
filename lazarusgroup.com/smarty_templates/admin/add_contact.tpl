!{validate form="contact" field="fname" criteria="notEmpty" assign="error_fname" message="First Name is required"}
!{validate form="contact" field="lname" criteria="notEmpty" assign="error_lname" message="Last Name is required"}
!{validate form="contact" field="email" criteria="isEmail" assign="error_email" message="Email is required"}

<h2>New Contact</h2>
!{include file="admin/_error.tpl"}

<form name="contact" method="POST" action="">
<p style="font-size:12px;">
<span style="color:#CC0000;">*</span> Required Fields
</p>
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
</thead>
<tbody>
!{if $error_fname}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_fname}</td>
</tr>
!{/if}
	<tr>
	<td id="right"><span style="color:#CC0000;">*</span> First Name:</td>
	<td><input type="text" name="fname" size="40" value="!{$fname|stripslashes}"></td>
	</tr>
	<tr>
	<td id="right">Middle Innitial:</td>
	<td><input type="text" name="mname" size="1" maxlength="1" value="!{$mname|stripslashes}"></td>
	</tr>
!{if $error_lname}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_lname}</td>
</tr>
!{/if}	
	<tr>
	<td id="right"><span style="color:#CC0000;">*</span> Last Name:</td>
	<td><input type="text" name="lname" size="40" value="!{$lname|stripslashes}"></td>
	</tr>
	<tr>
	<td id="right">Company Name:</td>
	<td><input type="text" name="company_name" size="40" value="!{$company_name|stripslashes}"></td>
	</tr>
	<tr>
	<td id="right">Address:</td>
	<td><input type="text" name="address" value="!{$address|stripslashes}" size="40"></td>
	</tr>
	<tr>
	<td id="right">&nbsp;</td>
	<td><input type="text" name="address2" value="!{$address2|stripslashes}" size="40"></td>
	</tr>
	
	<tr>
	<td id="right">City:</td>
	<td><input type="text" name="city" value="!{$city|stripslashes}" size="40"></td>
	</tr>
	
	<tr>
	<td id="right">State:</td>
	<td><input type="text" name="state" value="!{$state|stripslashes}" size="2" maxlength="2"></td>
	</tr>
	
	<tr>
	<td id="right">Postal Code:</td>
	<td><input type="text" name="postal_code" value="!{$postal_code|stripslashes}" size="20" maxlength="20"></td>
	</tr>
	
	<tr>
	<td id="right">Phone:</td>
	<td><input type="text" name="phone" value="!{$phone|stripslashes}" size="20" maxlength="20"></td>
	</tr>
	
!{if $error_email}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_email}</td>
</tr>
!{/if}	

	<tr>
	<td id="right"><span style="color:#CC0000;">*</span> Email:</td>
	<td><input type="text" name="email" value="!{$email|stripslashes}" size="40"></td>
	</tr>
	
<tr>
<td id="right" valign="top">Bulkmail Categories:</td>
<td>
!{section name="item" loop=$bulkmail_categories}
	<input type="checkbox" name="bulkmail_category[]" value="!{$bulkmail_categories[item].id}">	!{$bulkmail_categories[item].category}<br/>
!{/section}
</td>
</tr>
	
	
	
	

</tbody>
<tfoot>
	<tr>
	<td colspan="2" align="right"><input type="submit" name="submit" value="Add"></td>
	</tr>
</tfoot>

</table>
</form>