<?php /* Smarty version 2.6.11, created on 2010-11-30 14:00:07
         compiled from _main_template_temp.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', '_main_template_temp.tpl', 31, false),)), $this); ?>
<?php if ($this->_tpl_vars['header']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['header']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
<body id="<?php echo $this->_tpl_vars['content_array']['config']['name'];  echo $this->_tpl_vars['content_config']['name']; ?>
">

<div id="wrap">
	<div id="inner_wrap">
		<div id="head">
			<a href="/?page=homepage"class="header_img"><img src="/images/web_logo2.jpg"></a>
			<div id="nav">
		</div>

	
			
		</div><!-- close head -->
		
		
	
		<div id="content-wrap">   
			<div id="right_side">			
				<ul>
				
				
					<li><a href="/?page=durwinrice_getinvolved" alt="durwin rice for city council get involved" class="involve" title="durwin rice get involved">Get Involved</a></li>
					<BR>

				</ul>
			</div><!--close right side-->
		
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
					<BR>
		
				

					
					
			</div><!-- close content -->
		</div>
	<br clear="all">
	<div id="footer">
		<?php if ($this->_tpl_vars['footer']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['footer']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?> 
 	</div><!-- close foot -->
	</div> <!--close inner wrap-->

 	
 	</div><!-- close wrap -->

</body>
</html>