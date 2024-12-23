<?php /* Smarty version 2.6.11, created on 2018-02-13 09:04:29
         compiled from admin/login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'admin/login.tpl', 1, false),array('modifier', 'stripslashes', 'admin/login.tpl', 22, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'login_form','field' => 'email','criteria' => 'isEmail','message' => 'Email can not be empty nor invalid','assign' => 'error_email'), $this);?>

<?php echo smarty_function_validate(array('form' => 'login_form','field' => 'passwd','criteria' => 'notEmpty','message' => 'Password can not be empty','transform' => 'trim','assign' => 'error_passwd'), $this);?>


<center><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/_error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></center>

<form name="login_form" method="POST" action="login.php">
<table border="0" cellpadding="3" cellspacing="0" id="form">
	<thead>
	<tr>
		<td colspan="2">User Login</td>
	</tr>
	</thead>
	<tbody>
	<?php if ($this->_tpl_vars['error_email']): ?>
	<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_email']; ?>
</td>
	</tr>
	<?php endif; ?>
	<tr>
		<td id="right">Email:</td>
		<td><input type="text" name="email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['email'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40"></td>
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
