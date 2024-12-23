<?php /* Smarty version 2.6.11, created on 2011-10-26 10:07:22
         compiled from full_content.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign_adv', 'full_content.tpl', 2, false),array('modifier', 'date_format', 'full_content.tpl', 23, false),array('modifier', 'stripslashes', 'full_content.tpl', 30, false),)), $this); ?>
<?php if ($this->_tpl_vars['info']['main_id']): ?>
	<?php echo smarty_function_assign_adv(array('var' => 'table_id','value' => ($this->_tpl_vars['info']['main_id'])), $this);?>

	<?php echo smarty_function_assign_adv(array('var' => 'cssclass','value' => ($this->_tpl_vars['info']['cssclass'])), $this);?>

<?php else: ?>
	<?php echo smarty_function_assign_adv(array('var' => 'table_id','value' => 'other'), $this);?>

	<?php echo smarty_function_assign_adv(array('var' => 'cssclass','value' => 'other_title'), $this);?>

<?php endif; ?>

<!-- Actionline: Go Back, Print Article, Email Article -->
<ul class="actionline">
	<li><a href="#" onclick="history.back();" class="back">Back</a></li>
	<li><a href="#" onclick="window.print();return false;" class="print">Print Article</a></li>
	<li><a href="email_article.php?article_id=<?php echo $_GET['article_id']; ?>
" class="email">Email Article</a></li>
</ul>




<!-- Start -->
<?php if ($this->_tpl_vars['content_config']['set_headline'] == 'true'): ?><h2><?php echo $this->_tpl_vars['cont']['headline']; ?>
</h2><?php endif;  if ($this->_tpl_vars['content_config']['set_subhead'] == 'true'): ?><h3><?php echo $this->_tpl_vars['cont']['subhead']; ?>
</h3><?php endif;  if ($this->_tpl_vars['content_config']['set_byline'] == 'true'): ?><div class="byline"><?php echo $this->_tpl_vars['cont']['byline']; ?>
</div><?php endif;  if ($this->_tpl_vars['content_config']['set_dateline'] == 'true'): ?><div class="dateline"><?php echo ((is_array($_tmp=$this->_tpl_vars['cont']['dateline'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%h %d, %Y") : smarty_modifier_date_format($_tmp, "%h %d, %Y")); ?>
</div><?php endif; ?>

<?php if ($this->_tpl_vars['content_config']['set_exerpt'] == 'true' && ! $_GET['full']): ?>
	<p class="caption"><?php echo $this->_tpl_vars['cont']['exerpt']; ?>
</p>
<?php else: ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "article_pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php echo ((is_array($_tmp=$this->_tpl_vars['cont']['full_content'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

	<br clear="all">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "article_pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>



<?php if (! $_GET['full']): ?>
<div class="readmore"><img src="/images/readmore_arrow.gif" alt="" border="0"><a href="?article_id=<?php echo $_GET['article_id']; ?>
&full=yes&pbr=1">More &gt;</a></div>
<?php endif; ?>

<!-- End -->