!{validate form="login_form" field="email" criteria="isEmail" message="Email can not be empty nor invalid" assign="error_email"}
!{validate form="login_form" field="passwd" criteria="notEmpty" message="Password can not be empty" transform="trim" assign="error_passwd"}

<center>!{include file="admin/_error.tpl"}</center>

<form name="login_form" method="POST" action="login.php">
<table border="0" cellpadding="3" cellspacing="0" id="form">
	<thead>
	<tr>
		<td colspan="2">User Login</td>
	</tr>
	</thead>
	<tbody>
	!{if $error_email}
	<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_email}</td>
	</tr>
	!{/if}
	<tr>
		<td id="right">Email:</td>
		<td><input type="text" name="email" value="!{$email|stripslashes}" size="40"></td>
	</tr>
	!{if $error_passwd}
	<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_passwd}</td>
	</tr>
	!{/if}
	<tr>
		<td id="right">Password:</td>
		<td><input type="password" name="passwd" size="40"></td>
	</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2" align="right"><input type="submit" value="Login"></td>
		</tr>
	</tfoot>
</table>
</form>

