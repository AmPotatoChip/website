<?php /* Smarty version 2.6.11, created on 2011-05-12 00:14:09
         compiled from _error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign_adv', '_error.tpl', 4, false),array('modifier', 'stripslashes', '_error.tpl', 7, false),)), $this); ?>
<?php if ($this->_tpl_vars['error']): ?>

	<?php if (! $this->_tpl_vars['error_text']): ?>
	<?php echo smarty_function_assign_adv(array('var' => 'error_text','value' => 'Some required information was not completed or invalid. <br>Please enter all the required information. <br>Fields with errors are marked below.'), $this);?>


	<?php endif; ?>
		<p class="error"><?php echo ((is_array($_tmp=$this->_tpl_vars['error_text'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</p>
<?php endif; ?>