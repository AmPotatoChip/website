<?php /* Smarty version 2.6.11, created on 2018-02-13 13:29:47
         compiled from admin/content.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign_adv', 'admin/content.tpl', 7, false),)), $this); ?>


<h2>Website Content</h2>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/_error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (! $_GET['type']): ?>
	<?php echo smarty_function_assign_adv(array('var' => 'tab','value' => 'pages'), $this);?>

<?php else: ?>
	<?php echo smarty_function_assign_adv(array('var' => 'tab','value' => $_GET['type']), $this);?>

<?php endif; ?>

<table border="0" cellpadding="3" cellspacing="0" id="tabulated" width="760">
<thead>
<tr>
<td width="140" id="link" <?php if ($this->_tpl_vars['tab'] == 'pages'): ?>class="tab_on"<?php else: ?>class="tab_off"<?php endif; ?> width="55"><a href="content.php?type=pages"><img src="/images/icons/doc_16.gif" border="0" />  Pages</a></td>
<td width ="200" id="link" <?php if ($this->_tpl_vars['tab'] == 'category'): ?>class="tab_on"<?php else: ?>class="tab_off"<?php endif; ?> width="170"><a href="content.php?type=category"><img src="/images/icons/doc_add_16.gif" border="0" />  Create Content Category</a></td>
<td class="tab_off">&nbsp;</td>
</tr>
</thead>
<tbody>
<tr>
<td colspan="3" style="border-left:1px solid #000000;border-right:1px solid #000000;border-bottom:1px solid #000000;">
<?php if ($this->_tpl_vars['tab'] == 'pages'):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/website_content_pages.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif;  if ($this->_tpl_vars['tab'] == 'category'):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/website_content_category.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
</td>
</tr>
</tbody>
</table>
