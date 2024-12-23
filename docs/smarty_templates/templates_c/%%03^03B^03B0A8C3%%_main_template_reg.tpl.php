<?php /* Smarty version 2.6.11, created on 2009-12-04 14:40:56
         compiled from _main_template_reg.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'debug', '_main_template_reg.tpl', 1, false),array('modifier', 'stripslashes', '_main_template_reg.tpl', 46, false),)), $this); ?>
<?php echo smarty_function_debug(array(), $this);?>

	<?php $this->assign('cont', $this->_tpl_vars['content_array']['content']); ?>

<?php if ($this->_tpl_vars['header']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['header']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?> 


	<div class="grid_2" id="nav">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	</div><!-- close nav -->

	<div class="grid_2 alpha">
	<img src="/userfiles/image/100_1613.jpg"><br>
	<img src="/userfiles/image/100_1612.jpg"><br>
	
	</div><!-- close subnav -->

		<div class="grid_8" id="mainimg">

	<?php $this->assign('conf', $this->_tpl_vars['content_array']['config']); ?>
	<?php $this->assign('cont', $this->_tpl_vars['content_array']['content']); ?>


	<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=($this->_tpl_vars['cont'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

		<?php if ($_GET['full']): ?>

			<p class="actionline">
				<a href="#" onclick="history.back();">Back to Contents</a>
				<a href="#" onclick="window.print();return false;">Print Article</a>
				<a href="email_article.php?article_id=<?php echo $_GET['article_id']; ?>
" target="_blank">Email Article</a>
			</p>

		<?php endif; ?>

		<!-- Start -->
		<?php if ($this->_tpl_vars['conf']['set_headline'] == 'true'): ?><h2><?php echo $this->_tpl_vars['cont'][$this->_sections['x']['index']]->headline; ?>
</h2><?php endif; ?>
		<?php if ($this->_tpl_vars['conf']['set_subhead'] == 'true'): ?><h3><?php echo $this->_tpl_vars['cont'][$this->_sections['x']['index']]->subhead; ?>
</h3><?php endif; ?>
		<?php if ($this->_tpl_vars['conf']['set_byline'] == 'true'): ?><div class="byline"><?php echo $this->_tpl_vars['cont'][$this->_sections['x']['index']]->byline; ?>
</div><?php endif; ?>
		<?php if ($this->_tpl_vars['conf']['set_dateline'] == 'true'): ?><div class="dateline">Last Updated:  <?php echo $this->_tpl_vars['cont'][$this->_sections['x']['index']]->dateline; ?>
</div><?php endif; ?>

		<?php if ($this->_tpl_vars['conf']['set_exerpt'] == 'true' && ! $_GET['full']): ?>
			<?php echo $this->_tpl_vars['cont'][$this->_sections['x']['index']]->exerpt; ?>

		<?php else: ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "article_pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php echo ((is_array($_tmp=$this->_tpl_vars['cont'][$this->_sections['x']['index']]->full_content)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "article_pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>

		<?php if (! $_GET['full'] && $this->_tpl_vars['conf']['set_exerpt'] != 'false'): ?>
			<p class="readmore"><a href="/full_content.php?article_id=<?php echo $this->_tpl_vars['cont'][$this->_sections['x']['index']]->id; ?>
&full=yes&pbr=1"><?php echo $this->_tpl_vars['cont'][$this->_sections['x']['index']]->headline; ?>
 continued &#187; </a></p>
			<div class="hr"></div>
		<?php endif; ?>
		<!-- End -->

	<?php endfor; endif; ?>
	

		</div><!-- close mainimg -->
	</div><!-- close content -->

<?php if ($this->_tpl_vars['footer']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['footer']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>