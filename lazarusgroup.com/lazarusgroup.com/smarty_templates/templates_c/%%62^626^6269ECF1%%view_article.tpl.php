<?php /* Smarty version 2.6.11, created on 2011-09-20 21:31:58
         compiled from admin/view_article.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'admin/view_article.tpl', 15, false),)), $this); ?>
<link rel="stylesheet" type="text/css" href="/present_magazine.css">
<table width="500" cellspacing="1" cellpadding="0" align="center" id="other">
<tr>
<td class="article">
<!-- Start -->
<?php if ($this->_tpl_vars['content_config']['set_headline'] == 'true'): ?><h1><?php echo $this->_tpl_vars['cont']['headline']; ?>
</h1><?php endif; ?>
<?php if ($this->_tpl_vars['content_config']['set_subhead'] == 'true'): ?><h2><?php echo $this->_tpl_vars['cont']['subhead']; ?>
</h2><?php endif; ?>
<?php if ($this->_tpl_vars['content_config']['set_byline'] == 'true'): ?><div class="byline"><?php echo $this->_tpl_vars['cont']['byline']; ?>
</div><?php endif; ?>
<?php if ($this->_tpl_vars['content_config']['set_dateline'] == 'true'): ?><div class="dateline"><?php echo $this->_tpl_vars['cont']['dateline']; ?>
</div><?php endif; ?>

<?php if ($this->_tpl_vars['content_config']['set_exerpt'] == 'true' && ! $_GET['full']): ?>
	<div class="caption"><?php echo $this->_tpl_vars['cont']['exerpt']; ?>
</div>
<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/article_pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php echo ((is_array($_tmp=$this->_tpl_vars['cont']['full_content'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/article_pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>




<?php if (! $_GET['full']): ?>
<div class="readmore"><a href="?article_id=<?php echo $_GET['article_id']; ?>
&full=yes<?php if ($this->_tpl_vars['page_breaks']): ?>&pbr=1<?php endif; ?>">read more &gt;</a>
<?php endif; ?>

</div>
	<!-- End -->
	</td>
</tr>
</table>