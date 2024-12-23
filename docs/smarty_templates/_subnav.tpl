!{if ($content_array.config.name eq "fine-art-printing") ||
	 ($content_array.config.name eq "print-media") ||
	 ($content_array.config.name eq "print-costs") ||
	 ($content_array.config.name eq "giclee") ||
	 ($content_array.config.name eq "glow") ||
	 ($content_array.config.name eq "scans") 
 } 
	<ul class="printing_ul">
		<li><a href="/?page=glow" class="glow" title="Laser Engraving">Engraving</a></li>
		<li><a href="/?page=scans" class="scans" title="Large Format Scans">Artwork Scanning</a></li>
		<li><a href="/?page=giclee" class="giclee" title="Giclee Reproduction">Giclee Reproduction</a></li>
		<li><a href="/?page=print-costs" class="print-costs" title="Fine Art Print Cost">Price Estimator</a></li>
		<li><a href="/?page=print-media" class="print-media" title="Lazarus Group Availible Print Media">Print Media</a></li>
	</ul>	
!{/if}
	
!{if ($content_array.config.name eq "internet-development") ||
	($content_array.config.name eq "services") ||
	($content_array.config.name eq "success-stories")
} 
	<ul class="develop_ul">
		<li><a href="/?page=success-stories" class="success-stories" title="Lazarus Group Portfolio">Success Stories</a></li>
		<li><a href="/?page=services" class="services" title="lazarus group internet services">Services</a></li>
	</ul>
!{/if}	

!{if ($content_array.config.name eq "about") ||
	($content_array.config.name eq "lazaruspotter") || 
	($content_array.config.name eq "websiteart") 
} 
	<ul class="about_ul">
		<li><a href="/?page=websiteart" class="websiteart" title="The Art used on this website">Website Art</a></li>
		<li><a href="/?page=lazaruspotter" class="lazaruspotter" title="Lazarus Potter">Lazarus Potter</a></li>
	</ul>
!{/if}	
