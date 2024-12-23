!{if $header}!{include file="$header"}!{/if}
<body id="!{$content_array.config.name}!{$content_config.name}">

<div id="wrap">
		<div id="head">
			<!-- <p><span class="tag">We Make Websites</span>&nbsp;&nbsp;&nbsp;<span class="bold_cond">816.931.5525</span></p> -->
			<a href="/?page=home" class="header_img" title="Lazarus Group Kansas City Website Design Fine Art Printing"><img src="/userfiles/image/header_image.jpg" border="0" alt="Lazarus Group Kansas City Website Design Fine Art Printing"></a>
			<a href="/?page=contact" class="map_btn"><img src="userfiles/image/map_btn.png"></a>
			<div id="nav">
				!{include file="_nav.tpl"}
			</div>
		
			</div><!-- close head -->
	<div id="inner_wrap">
		
		<div id="content-wrap">
				
			<div id="content">	
					!{include file="inner_nav.tpl"}
					!{if $page_type eq 'db'}
					!{$page_content|stripslashes}
					!{else}
					!{if $page_content}!{include file="$page_content"}!{/if}
					!{/if}
					<BR>
						

					
			</div><!-- close content -->
			
				
		</div>
	<br clear="all">

	</div> <!--close inner wrap-->

 		<div id="footer">
		!{if $footer}!{include file="$footer"}!{/if} 
		</div><!-- close foot -->
</div><!-- close wrap -->

</body>
</html>
