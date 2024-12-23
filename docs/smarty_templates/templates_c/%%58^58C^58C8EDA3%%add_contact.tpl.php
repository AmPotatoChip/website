<?php /* Smarty version 2.6.11, created on 2010-11-13 18:34:27
         compiled from admin/add_contact.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'admin/add_contact.tpl', 1, false),array('modifier', 'stripslashes', 'admin/add_contact.tpl', 27, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'contact','field' => 'fname','criteria' => 'notEmpty','assign' => 'error_fname','message' => 'First Name is required'), $this);?>

<?php echo smarty_function_validate(array('form' => 'contact','field' => 'lname','criteria' => 'notEmpty','assign' => 'error_lname','message' => 'Last Name is required'), $this);?>

<?php echo smarty_function_validate(array('form' => 'contact','field' => 'email','criteria' => 'isEmail','assign' => 'error_email','message' => 'Email is required'), $this);?>


<h2>New Contact</h2>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/_error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

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
<?php if ($this->_tpl_vars['error_fname']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_fname']; ?>
</td>
</tr>
<?php endif; ?>
	<tr>
	<td id="right"><span style="color:#CC0000;">*</span> First Name:</td>
	<td><input type="text" name="fname" size="40" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></td>
	</tr>
	<tr>
	<td id="right">Middle Innitial:</td>
	<td><input type="text" name="mname" size="1" maxlength="1" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['mname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></td>
	</tr>
<?php if ($this->_tpl_vars['error_lname']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_lname']; ?>
</td>
</tr>
<?php endif; ?>	
	<tr>
	<td id="right"><span style="color:#CC0000;">*</span> Last Name:</td>
	<td><input type="text" name="lname" size="40" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['lname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></td>
	</tr>
	<tr>
	<td id="right">Company Name:</td>
	<td><input type="text" name="company_name" size="40" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['company_name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></td>
	</tr>
	<tr>
	<td id="right">Address:</td>
	<td><input type="text" name="address" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['address'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40"></td>
	</tr>
	<tr>
	<td id="right">&nbsp;</td>
	<td><input type="text" name="address2" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['address2'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40"></td>
	</tr>
	
	<tr>
	<td id="right">City:</td>
	<td><input type="text" name="city" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['city'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40"></td>
	</tr>
	
	<tr>
	<td id="right">State:</td>
	<td><input type="text" name="state" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['state'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="2" maxlength="2"></td>
	</tr>
	
	<tr>
	<td id="right">Postal Code:</td>
	<td><input type="text" name="postal_code" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['postal_code'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="20" maxlength="20"></td>
	</tr>
	
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
	<td id="right"><span style="color:#CC0000;">*</span> Email:</td>
	<td><input type="text" name="email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['email'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40"></td>
	</tr>
	
<tr>
<td id="right" valign="top">Bulkmail Categories:</td>
<td>
<?php unset($this->_sections['item']);
$this->_sections['item']['name'] = 'item';
$this->_sections['item']['loop'] = is_array($_loop=$this->_tpl_vars['bulkmail_categories']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['item']['show'] = true;
$this->_sections['item']['max'] = $this->_sections['item']['loop'];
$this->_sections['item']['step'] = 1;
$this->_sections['item']['start'] = $this->_sections['item']['step'] > 0 ? 0 : $this->_sections['item']['loop']-1;
if ($this->_sections['item']['show']) {
    $this->_sections['item']['total'] = $this->_sections['item']['loop'];
    if ($this->_sections['item']['total'] == 0)
        $this->_sections['item']['show'] = false;
} else
    $this->_sections['item']['total'] = 0;
if ($this->_sections['item']['show']):

            for ($this->_sections['item']['index'] = $this->_sections['item']['start'], $this->_sections['item']['iteration'] = 1;
                 $this->_sections['item']['iteration'] <= $this->_sections['item']['total'];
                 $this->_sections['item']['index'] += $this->_sections['item']['step'], $this->_sections['item']['iteration']++):
$this->_sections['item']['rownum'] = $this->_sections['item']['iteration'];
$this->_sections['item']['index_prev'] = $this->_sections['item']['index'] - $this->_sections['item']['step'];
$this->_sections['item']['index_next'] = $this->_sections['item']['index'] + $this->_sections['item']['step'];
$this->_sections['item']['first']      = ($this->_sections['item']['iteration'] == 1);
$this->_sections['item']['last']       = ($this->_sections['item']['iteration'] == $this->_sections['item']['total']);
?>
	<input type="checkbox" name="bulkmail_category[]" value="<?php echo $this->_tpl_vars['bulkmail_categories'][$this->_sections['item']['index']]['id']; ?>
">	<?php echo $this->_tpl_vars['bulkmail_categories'][$this->_sections['item']['index']]['category']; ?>
<br/>
<?php endfor; endif; ?>
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