!{validate form="user_admin_form" field="fname" criteria="notEmpty" message="First Name can not be empty" assign="error_fname"}
!{validate form="user_admin_form" field="lname" criteria="notEmpty" message="Last Name can not be empty" assign="error_lname"}
!{validate form="user_admin_form" field="phone" criteria="notEmpty" message="Phone can not be empty" assign="error_phone"}
!{validate form="user_admin_form" field="email" criteria="isEmail" message="You have to use a valid email address" assign="error_email"}


!{if !$id}
!{validate form="user_admin_form" field="passwd" criteria="notEmpty" message="Password can not be empty" assign="error_passwd" transform="trim"}
!{/if}

!{validate form="user_admin_form" field="user_privs" criteria="notEmpty" message="User Privileges can not be empty" assign="error_user_privs"}

<h2>User Administration</h2>
!{include file="admin/_error.tpl"}
<p>
<table border="0" cellpadding="3" cellspacing="0" id="display">
	<thead>
		<tr>
			<td>Name</td>
			<td>Phone</td>
			<td>Email</td>
			<td>User Type</td>
			<td>Password</td>
			<td align="center">Edit</td>
			<td align="center">Delete</td>
		</tr>
	</thead>
	<tbody>
	!{if $users}
	!{section name="x" loop="$users"}
		<tr bgcolor="!{cycle values="#FFFFFF,#DFE5FF"}">
			<td>!{$users[x]->fname} !{$users[x]->lname}</td>
			<td>!{$users[x]->phone}</td>
			<td><a href="mailto:!{$users[x]->email}">!{$users[x]->email}</a></td>
			<td>!{$users[x]->user_privs}</td>
			<td align="center"><a href="javascript:;" onClick="alert('!{$users[x]->fname} !{$users[x]->lname} login password is: \n!{$users[x]->passwd}');">Show</a></td>
			<td align="center"><a href="user_admin.php?user_id=!{$users[x]->id}"><img src="/images/icons/user_edit_16.gif" border="0" /></a></td>
			<td align="center">!{if $users[x]->user_privs neq 'Super User'}<a href="user_admin.php?delete=true&delete_id=!{$users[x]->id}" onClick="return confirm('Are you sure you would like to delete this admin user?');"><img src="/images/icons/user_close_16.gif" border="0" /></a>!{/if}</td>
		</tr>
	!{/section}
	!{/if}
	</tbody>
</table>
</p>
<p><a href="javascript:;" class="link" onclick="hideunhide('user_form');" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/user_16.gif" border="0" /> Add a new user</a></p>


<form name="user_admin_form" method="POST" action="user_admin.php">
<p id="user_form" style="display:none;">
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
	<tr>
		<td colspan="2">User Setup</td>
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
		<td id="right">First Name:</td>
		<td><input type="text" name="fname" value="!{$fname|stripslashes}" size="30" maxlength="60"></td>
	</tr>
!{if $error_lname}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_lname}</td>
</tr>
!{/if}	
	<tr>
		<td id="right">Last Name:</td>
		<td><input type="text" name="lname" value="!{$lname|stripslashes}" size="40" maxlength="120"></td>
	</tr>
	<tr>
		<td id="right">Address:</td>
		<td><input type="text" name="address" value="!{$address|stripslashes}" size="40" maxlength="120"></td>
	</tr>
	<tr>
		<td id="right">City:</td>
		<td><input type="text" name="city" value="!{$city|stripslashes}" size="40" maxlength="120"></td>
	</tr>
	<tr>
		<td id="right">State:</td>
		<td><input type="text" name="state" value="!{$state|stripslashes}" size="2" maxlength="2"></td>
	</tr>
	<tr>
		<td id="right">Zip:</td>
		<td><input type="text" name="zip" value="!{$zip|stripslashes}" size="5" maxlength="5"></td>
	</tr>
!{if $error_phone}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_phone}</td>
</tr>
!{/if}	
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
		<td id="right">Email:</td>
		<td>
			<input type="text" name="email" value="!{$email|stripslashes}" size="40" maxlength="255">
		</td>
	</tr>
!{if $error_passwd}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_passwd}</td>
</tr>
!{/if}	
	<tr>
		<td id="right">Password:</td>
		<td><input type="text" name="passwd" value="!{$passwd|stripslashes}" size="40" maxlength="50"></td>
	</tr>
!{if $error_user_privs}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_user_privs}</td>
</tr>
!{/if}		
	<tr>
		<td id="right">User Privileges:</td>
		<td>
			<select name="user_privs">
				<option value=''>Please select</option>
				<option value='Super User' !{if $user_privs eq 'Super User'}selected!{/if}>Super User</option>
				<option value='Contact Manager' !{if $user_privs eq 'Contact Manager'}selected!{/if}>Contact Manager</option>
				<option value='Bulk Email Manager' !{if $user_privs eq 'Bulk Email Manager'}selected!{/if}>Bulk Email Manager</option>
				<option value='Website Editor' !{if $user_privs eq 'Website Editor'}selected!{/if}>Website Editor</option>
			</select>	
		</td>
	</tr>
</tbody>
<tfoot>
	<tr>
		<td colspan="2" align="right">
		<input type="button" value="Reset" onClick="document.location.href='user_admin.php';">
!{if $smarty.get.user_id}
<input type="submit" name="submit" value="Update User">
!{else}
<input type="submit" name="submit" value="Add New User">
!{/if}
</td>
	</tr>
</tfoot>
</table>
</p>
!{if $id}
<input type="hidden" name="id" value="!{$id}">
!{/if}
</form>

!{if $showform}
<script language="javascript">
	window.onload=function(){
		hideunhide('user_form');	
	}
</script>
!{/if}

!{if $smarty.get.user_id}
<script language="javascript">
	window.onload=function(){
		hideunhide('user_form');	
	}
</script>
!{/if}