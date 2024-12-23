<?php /* Smarty version 2.6.11, created on 2018-02-12 11:51:29
         compiled from _landing_template.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', '_landing_template.tpl', 21, false),)), $this); ?>
<?php if ($this->_tpl_vars['header']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['header']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
<body id="<?php echo $this->_tpl_vars['content_array']['config']['name'];  echo $this->_tpl_vars['content_config']['name']; ?>
">

<div id="wrap">
		<div id="head">
			<!-- <p><span class="tag">We Make Websites</span>&nbsp;&nbsp;&nbsp;<span class="bold_cond">816.931.5525</span></p> -->
			<a href="/?page=home" class="header_img" title="Lazarus Group Kansas City Website Design Fine Art Printing"><img src="/userfiles/image/header_image.jpg" border="0" alt="Lazarus Group Kansas City Website Design Fine Art Printing"></a>
			<a href="/?page=contact" class="map_btn"><img src="userfiles/image/map_btn.png"></a>
			<div id="nav">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		
			</div><!-- close head -->
	<div id="inner_wrap">
		
		<div id="content-wrap">
				
			<div id="content">	
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inner_nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php if ($this->_tpl_vars['page_type'] == 'db'): ?>
					<?php echo ((is_array($_tmp=$this->_tpl_vars['page_content'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

					<?php else: ?>
					<?php if ($this->_tpl_vars['page_content']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['page_content']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
					<?php endif; ?>
					<BR>
						

					
			</div><!-- close content -->
			
				
		</div>
	<br clear="all">

	</div> <!--close inner wrap-->

 		<div id="footer">
		<?php if ($this->_tpl_vars['footer']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['footer']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?> 
		</div><!-- close foot -->
</div><!-- close wrap -->

</body>
</html>