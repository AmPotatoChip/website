<?php /* Smarty version 2.6.11, created on 2011-07-04 12:13:03
         compiled from admin/manage_contacts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'admin/manage_contacts.tpl', 1, false),array('function', 'assign_adv', 'admin/manage_contacts.tpl', 30, false),array('modifier', 'stripslashes', 'admin/manage_contacts.tpl', 10, false),array('modifier', 'ucwords', 'admin/manage_contacts.tpl', 34, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'search','field' => 'query','criteria' => 'notEmpty','message' => 'Search field can not be empty','assign' => 'error_query'), $this);?>

<?php echo smarty_function_validate(array('form' => 'search','field' => 'by','criteria' => 'notEmpty','message' => 'Search By can not be empty','assign' => 'error_by'), $this);?>


<h2>Manage Contacts</h2>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/_error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  if ($this->_tpl_vars['error_query']): ?><li style="font-size:12px;color:#CC0000;"><?php echo $this->_tpl_vars['error_query']; ?>
</li><?php endif;  if ($this->_tpl_vars['error_by']): ?><li style="font-size:12px;color:#CC0000;"><?php echo $this->_tpl_vars['error_by']; ?>
</li><?php endif; ?>

<form name="search" method="POST" action="manage_contacts.php">
<input type="text" name="query" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['query'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40">
<select name="by">
	<option value=''>Please select</option>
	<option value=''></option>
	
	<option value="fname" <?php if ($this->_tpl_vars['by'] == 'fname'): ?>selected<?php endif; ?>>First Name</option>
	<option value="lname" <?php if ($this->_tpl_vars['by'] == 'lname'): ?>selected<?php endif; ?>>Last Name</option>
	<option value="company" <?php if ($this->_tpl_vars['by'] == 'company'): ?>selected<?php endif; ?>>Company Name</option>
	<option value="address" <?php if ($this->_tpl_vars['by'] == 'address'): ?>selected<?php endif; ?>>Address</option>
	<option value="city" <?php if ($this->_tpl_vars['by'] == 'city'): ?>selected<?php endif; ?>>City</option>
	<option value="state" <?php if ($this->_tpl_vars['by'] == 'state'): ?>selected<?php endif; ?>>State</option>
	<option value="zip" <?php if ($this->_tpl_vars['by'] == 'zip'): ?>selected<?php endif; ?>>Postal Code</option>
	<option value="email" <?php if ($this->_tpl_vars['by'] == 'email'): ?>selected<?php endif; ?>>email</option>
	<option value="phone" <?php if ($this->_tpl_vars['by'] == 'phone'): ?>selected<?php endif; ?>>phone</option>
	
</select>
<input type="submit" name="submit" value="Search">
<input type="hidden" name="form_name" value="search">
</form>

<?php echo smarty_function_assign_adv(array('var' => 'keys','value' => "range(a,z)"), $this);?>


<div id="keys">
<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['keys']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<a href="manage_contacts.php?query=<?php echo ucwords($this->_tpl_vars['keys'][$this->_sections['x']['index']]); ?>
" <?php if ($_GET['query'] == ucwords($this->_tpl_vars['keys'][$this->_sections['x']['index']])): ?>style="background-color:#FFFFFF;border:1px solid #000000;color:#000000;"<?php endif; ?>><?php echo ucwords($this->_tpl_vars['keys'][$this->_sections['x']['index']]); ?>
</a>
<?php endfor; endif; ?>
|
<a href="manage_contacts.php?query=ALL" <?php if ($_GET['query'] == 'ALL'): ?>style="background-color:#FFFFFF;border:1px solid #000000;color:#000000;"<?php endif; ?>>ALL</a>
</div>

<?php if ($this->_tpl_vars['search_result']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/contact_search_result.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
<p><a class="link" href="add_contact.php" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/contact_add_16.gif" border="0" />  Add a new contact</a></p>