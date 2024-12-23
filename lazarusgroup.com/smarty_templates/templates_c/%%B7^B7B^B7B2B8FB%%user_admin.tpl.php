<?php /* Smarty version 2.6.11, created on 2011-09-20 21:33:15
         compiled from admin/user_admin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'admin/user_admin.tpl', 1, false),array('function', 'cycle', 'admin/user_admin.tpl', 31, false),array('modifier', 'stripslashes', 'admin/user_admin.tpl', 65, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'user_admin_form','field' => 'fname','criteria' => 'notEmpty','message' => 'First Name can not be empty','assign' => 'error_fname'), $this);?>

<?php echo smarty_function_validate(array('form' => 'user_admin_form','field' => 'lname','criteria' => 'notEmpty','message' => 'Last Name can not be empty','assign' => 'error_lname'), $this);?>

<?php echo smarty_function_validate(array('form' => 'user_admin_form','field' => 'phone','criteria' => 'notEmpty','message' => 'Phone can not be empty','assign' => 'error_phone'), $this);?>

<?php echo smarty_function_validate(array('form' => 'user_admin_form','field' => 'email','criteria' => 'isEmail','message' => 'You have to use a valid email address','assign' => 'error_email'), $this);?>



<?php if (! $this->_tpl_vars['id']):  echo smarty_function_validate(array('form' => 'user_admin_form','field' => 'passwd','criteria' => 'notEmpty','message' => 'Password can not be empty','assign' => 'error_passwd','transform' => 'trim'), $this);?>

<?php endif; ?>

<?php echo smarty_function_validate(array('form' => 'user_admin_form','field' => 'user_privs','criteria' => 'notEmpty','message' => 'User Privileges can not be empty','assign' => 'error_user_privs'), $this);?>


<h2>User Administration</h2>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/_error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
	<?php if ($this->_tpl_vars['users']): ?>
	<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=($this->_tpl_vars['users'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>
		<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#DFE5FF"), $this);?>
">
			<td><?php echo $this->_tpl_vars['users'][$this->_sections['x']['index']]->fname; ?>
 <?php echo $this->_tpl_vars['users'][$this->_sections['x']['index']]->lname; ?>
</td>
			<td><?php echo $this->_tpl_vars['users'][$this->_sections['x']['index']]->phone; ?>
</td>
			<td><a href="mailto:<?php echo $this->_tpl_vars['users'][$this->_sections['x']['index']]->email; ?>
"><?php echo $this->_tpl_vars['users'][$this->_sections['x']['index']]->email; ?>
</a></td>
			<td><?php echo $this->_tpl_vars['users'][$this->_sections['x']['index']]->user_privs; ?>
</td>
			<td align="center"><a href="javascript:;" onClick="alert('<?php echo $this->_tpl_vars['users'][$this->_sections['x']['index']]->fname; ?>
 <?php echo $this->_tpl_vars['users'][$this->_sections['x']['index']]->lname; ?>
 login password is: \n<?php echo $this->_tpl_vars['users'][$this->_sections['x']['index']]->passwd; ?>
');">Show</a></td>
			<td align="center"><a href="user_admin.php?user_id=<?php echo $this->_tpl_vars['users'][$this->_sections['x']['index']]->id; ?>
"><img src="/images/icons/user_edit_16.gif" border="0" /></a></td>
			<td align="center"><?php if ($this->_tpl_vars['users'][$this->_sections['x']['index']]->user_privs != 'Super User'): ?><a href="user_admin.php?delete=true&delete_id=<?php echo $this->_tpl_vars['users'][$this->_sections['x']['index']]->id; ?>
" onClick="return confirm('Are you sure you would like to delete this admin user?');"><img src="/images/icons/user_close_16.gif" border="0" /></a><?php endif; ?></td>
		</tr>
	<?php endfor; endif; ?>
	<?php endif; ?>
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
<?php if ($this->_tpl_vars['error_fname']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_fname']; ?>
</td>
</tr>
<?php endif; ?>
	<tr>
		<td id="right">First Name:</td>
		<td><input type="text" name="fname" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="30" maxlength="60"></td>
	</tr>
<?php if ($this->_tpl_vars['error_lname']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_lname']; ?>
</td>
</tr>
<?php endif; ?>	
	<tr>
		<td id="right">Last Name:</td>
		<td><input type="text" name="lname" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['lname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40" maxlength="120"></td>
	</tr>
	<tr>
		<td id="right">Address:</td>
		<td><input type="text" name="address" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['address'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40" maxlength="120"></td>
	</tr>
	<tr>
		<td id="right">City:</td>
		<td><input type="text" name="city" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['city'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40" maxlength="120"></td>
	</tr>
	<tr>
		<td id="right">State:</td>
		<td><input type="text" name="state" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['state'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="2" maxlength="2"></td>
	</tr>
	<tr>
		<td id="right">Zip:</td>
		<td><input type="text" name="zip" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['zip'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="5" maxlength="5"></td>
	</tr>
<?php if ($this->_tpl_vars['error_phone']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_phone']; ?>
</td>
</tr>
<?php endif; ?>	
	<tr>
		<td id="right">Phone:</td>
		<td><input type="text" name="phone" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['phone'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="20" maxlength="20"></td>
	</tr>
<?php if ($this->_tpl_vars['error_email']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_email']; ?>
</td>
</tr>
<?php endif; ?>		
	<tr>
		<td id="right">Email:</td>
		<td>
			<input type="text" name="email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['email'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40" maxlength="255">
		</td>
	</tr>
<?php if ($this->_tpl_vars['error_passwd']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_passwd']; ?>
</td>
</tr>
<?php endif; ?>	
	<tr>
		<td id="right">Password:</td>
		<td><input type="text" name="passwd" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['passwd'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40" maxlength="50"></td>
	</tr>
<?php if ($this->_tpl_vars['error_user_privs']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_user_privs']; ?>
</td>
</tr>
<?php endif; ?>		
	<tr>
		<td id="right">User Privileges:</td>
		<td>
			<select name="user_privs">
				<option value=''>Please select</option>
				<option value='Super User' <?php if ($this->_tpl_vars['user_privs'] == 'Super User'): ?>selected<?php endif; ?>>Super User</option>
				<option value='Contact Manager' <?php if ($this->_tpl_vars['user_privs'] == 'Contact Manager'): ?>selected<?php endif; ?>>Contact Manager</option>
				<option value='Bulk Email Manager' <?php if ($this->_tpl_vars['user_privs'] == 'Bulk Email Manager'): ?>selected<?php endif; ?>>Bulk Email Manager</option>
				<option value='Website Editor' <?php if ($this->_tpl_vars['user_privs'] == 'Website Editor'): ?>selected<?php endif; ?>>Website Editor</option>
			</select>	
		</td>
	</tr>
</tbody>
<tfoot>
	<tr>
		<td colspan="2" align="right">
		<input type="button" value="Reset" onClick="document.location.href='user_admin.php';">
<?php if ($_GET['user_id']): ?>
<input type="submit" name="submit" value="Update User">
<?php else: ?>
<input type="submit" name="submit" value="Add New User">
<?php endif; ?>
</td>
	</tr>
</tfoot>
</table>
</p>
<?php if ($this->_tpl_vars['id']): ?>
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
<?php endif; ?>
</form>

<?php if ($this->_tpl_vars['showform']): ?>
<script language="javascript">
	window.onload=function(){
		hideunhide('user_form');	
	}
</script>
<?php endif; ?>

<?php if ($_GET['user_id']): ?>
<script language="javascript">
	window.onload=function(){
		hideunhide('user_form');	
	}
</script>
<?php endif; ?>