<?php /* Smarty version 2.6.11, created on 2018-02-13 13:30:45
         compiled from admin/_error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign_adv', 'admin/_error.tpl', 2, false),array('modifier', 'stripslashes', 'admin/_error.tpl', 21, false),)), $this); ?>
<?php if ($_GET['msg']): ?>
	<?php echo smarty_function_assign_adv(array('var' => 'error_text','value' => ($_GET['msg'])), $this);?>

	<?php echo smarty_function_assign_adv(array('var' => 'error','value' => true), $this);?>

<?php endif; ?>


<?php if ($this->_tpl_vars['error']):  if (! $this->_tpl_vars['error_text']): ?>
	<?php echo smarty_function_assign_adv(array('var' => 'error_text','value' => 'Some required information was not completed or invalid.<br/>Please enter all the required information.<br/>Fields with errors are marked below.'), $this);?>

<?php endif; ?>
<p>
<table border="0" cellpadding="0" cellspacing="0" id="error">
	<thead>
		<tr>
			<td>User Message</td>
		</tr>
	</thead>
	
	<tbody>
		<tr>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['error_text'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
		</tr>
	</tbody>
</table>
</p>

<?php endif; ?>