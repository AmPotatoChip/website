<?php /* Smarty version 2.6.11, created on 2011-06-17 10:46:16
         compiled from _main_template_landing.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', '_main_template_landing.tpl', 37, false),)), $this); ?>
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
			<a href="/?page=home" class="header_img" title="TCD PARTS EDGERTON MISSOURI"><img src="/images/tcd_logo.png" border="0" alt="TCD PARTS EDGERTON MISSOURI"></a>
			
		<img class="header_photo" src="/images/ex_photo.jpg">
		</div><!-- close head -->
		<div id="nav">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
	
		<div id="content-wrap">
		<div id="left_nav">
		<img src="images/catalog_btn.jpg">
		<ul id="navlist">
				<li><a href="/?page=tubing"  class="tubing" alt="tubing" title="TCD Parts tubing">Tubing</a></li>
				<li><a href="/?page=chemical_dispensers" class="dispensers" title="TCD Parts Chemical Dispensers">Chemical Dispensers</a></li>
				<li><a href="/?page=dishmachine_parts" class="dishmachine" title="TCD Parts Dishmachine Parts">Dishmachine Parts</a></li>
				<li><a href="/?page=fittings_connectors" class="fittings" title="TCD Parts Fittings & Connectors">Fittings & Connectors</a></li>
				<li><a href="/?page=valves" class="valves" title="TCD Parts Valves">Valves</a></li>
				<li><a href="/?page=electrical_switches" class="electrical" title="TCD Parts Electrical Switches">Electrical Switches</a></li>
				<li><a href="/?page=kitchen_equipment" class="kitchen" title="TCD Parts Kitchen Equipment">Kitchen Equipment</a></li>
				<li><a href="/?page=racks_dollies" class="racks" title="TCD Parts Racks & Dollies">Racks & Dollies</a></li>
				<li><a href="/?page=testing_safety" class="testing" title="TCD Parts Testing & Safety">Testing & Safety</a></li>

</ul>
<img class="live_help" src="/images/livehelp.jpg">
			</div>
				
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
			<div id="right_side">
						<img class="callus" src="/images/call_us.png">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "right_side_ads.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>	
				
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