<?php /* Smarty version 2.6.11, created on 2011-10-26 09:55:07
         compiled from admin/media_lib_template.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'admin/media_lib_template.tpl', 16, false),)), $this); ?>
<html>
<head>
<title><?php if ($this->_tpl_vars['page_title']):  echo $this->_tpl_vars['page_title'];  endif; ?></title>
<?php if ($this->_tpl_vars['css']):  echo $this->_tpl_vars['css'];  endif;  if ($this->_tpl_vars['javascripts']):  echo $this->_tpl_vars['javascripts'];  endif; ?>
</head>
<body>
<p>
<table broder="0" cellpadding="3" cellspacing="0" width="100%" id="header">
	<tr>
		<td>Media Library</td>
	</tr>
</table>
</p>
<?php if ($this->_tpl_vars['page_type'] == 'db'): ?>
	<?php echo ((is_array($_tmp=$this->_tpl_vars['page_content'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

<?php else: ?>
	<?php if ($this->_tpl_vars['page_content']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['page_content']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif;  endif; ?>

</body>
</html>