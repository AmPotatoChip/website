<?php /* Smarty version 2.6.11, created on 2010-04-14 15:35:35
         compiled from _main_mo_cant_wait.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', '_main_mo_cant_wait.tpl', 26, false),)), $this); ?>
<?php if ($this->_tpl_vars['header']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['header']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
<body id="<?php echo $this->_tpl_vars['content_array']['config']['name'];  echo $this->_tpl_vars['content_config']['name']; ?>
">
<div id="wrap">
	<div id="head">
		<div id="header_img">
		<a href="http://www.arcusmo.com/?page=missouri_cant_wait_home"><img src="/images/header_campaign.png"></a>
		</div>
			
	</div><!-- close head -->
<!--put back here-->
		<ul id="sub_nav_ul">
		<li><a href="/?page=missouri_cant_wait_donate" class="sub_donate">Donate to the Missouri Can't Wait Campaign</a></li>
		<li><a href="/?page=missouri_cant_wait_take_action" class="sub_takeaction">find out how to take action the Missouri Can't Wait Campaign</a></li>
		<li><a href="/?page=missouri_cant_wait_learn_more" class="sub_learnmore">learn more about the Missouri Can't Wait Campaign</a></li>
		<li><a href="/?page=missouri_cant_wait_share" class="sub_share">share your stories with the Missouri Can't Wait Campaign</a></li>
		<li><a href="/?page=missouri_cant_wait_home" class="mo_home">The home page for the Missouri Can't Wait Campaign</a></li>
		</ul>
	<div id="inner_wrap">
	<div id="nav">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div><!-- close nav -->

<div id="content">	
	
			<?php if ($this->_tpl_vars['page_type'] == 'db'): ?>
			<?php echo ((is_array($_tmp=$this->_tpl_vars['page_content'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

			<?php else: ?>
			<?php if ($this->_tpl_vars['page_content']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['page_content']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
			<?php endif; ?>
			
		
	<?php if ($this->_tpl_vars['letterNames']): ?>
	<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=($this->_tpl_vars['letterNames'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<?php if ($this->_tpl_vars['letterNames'][$this->_sections['x']['index']]->lname): ?>
		<?php echo $this->_sections['x']['iteration']; ?>

 <?php echo $this->_tpl_vars['letterNames'][$this->_sections['x']['index']]->fname; ?>
 <?php echo $this->_tpl_vars['letterNames'][$this->_sections['x']['index']]->lname;  if ($this->_tpl_vars['letterNames'][$this->_sections['x']['index']]->city): ?>, <?php echo $this->_tpl_vars['letterNames'][$this->_sections['x']['index']]->city; ?>
<br/>
			<?php endif; ?>
	<?php endif; ?>
	<?php endfor; endif; ?>	

	<?php endif; ?>
			
		</div><!-- close content -->
		
 <div style="clear: both;"></div>
	</div> <!--close inner wrap-->


<br clear="all" />
	<div id="foot">
	<?php if ($this->_tpl_vars['footer']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['footer']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>  

	</div><!-- close foot -->
	
</div><!-- close wrap -->
</body>
</html>