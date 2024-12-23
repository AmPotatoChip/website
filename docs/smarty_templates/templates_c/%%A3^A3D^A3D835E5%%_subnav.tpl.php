<?php /* Smarty version 2.6.11, created on 2018-03-22 00:39:49
         compiled from _subnav.tpl */ ?>
<?php if (( $this->_tpl_vars['content_array']['config']['name'] == "fine-art-printing" ) || ( $this->_tpl_vars['content_array']['config']['name'] == "print-media" ) || ( $this->_tpl_vars['content_array']['config']['name'] == "print-costs" ) || ( $this->_tpl_vars['content_array']['config']['name'] == 'giclee' ) || ( $this->_tpl_vars['content_array']['config']['name'] == 'glow' ) || ( $this->_tpl_vars['content_array']['config']['name'] == 'scans' )): ?> 
	<ul class="printing_ul">
		<li><a href="/?page=glow" class="glow" title="Laser Engraving">Engraving</a></li>
		<li><a href="/?page=scans" class="scans" title="Large Format Scans">Artwork Scanning</a></li>
		<li><a href="/?page=giclee" class="giclee" title="Giclee Reproduction">Giclee Reproduction</a></li>
		<li><a href="/?page=print-costs" class="print-costs" title="Fine Art Print Cost">Price Estimator</a></li>
		<li><a href="/?page=print-media" class="print-media" title="Lazarus Group Availible Print Media">Print Media</a></li>
	</ul>	
<?php endif; ?>
	
<?php if (( $this->_tpl_vars['content_array']['config']['name'] == "internet-development" ) || ( $this->_tpl_vars['content_array']['config']['name'] == 'services' ) || ( $this->_tpl_vars['content_array']['config']['name'] == "success-stories" )): ?> 
	<ul class="develop_ul">
		<li><a href="/?page=success-stories" class="success-stories" title="Lazarus Group Portfolio">Success Stories</a></li>
		<li><a href="/?page=services" class="services" title="lazarus group internet services">Services</a></li>
	</ul>
<?php endif; ?>	

<?php if (( $this->_tpl_vars['content_array']['config']['name'] == 'about' ) || ( $this->_tpl_vars['content_array']['config']['name'] == 'lazaruspotter' ) || ( $this->_tpl_vars['content_array']['config']['name'] == 'websiteart' )): ?> 
	<ul class="about_ul">
		<li><a href="/?page=websiteart" class="websiteart" title="The Art used on this website">Website Art</a></li>
		<li><a href="/?page=lazaruspotter" class="lazaruspotter" title="Lazarus Potter">Lazarus Potter</a></li>
	</ul>
<?php endif; ?>	