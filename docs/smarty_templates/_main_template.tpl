!{if $header}!{include file="$header"}!{/if}
<body id="!{$content_array.config.name}!{$cfoo}">

<div id="wrap">
	<div id="inner_wrap">

		<div id="top_line">
			<span class="rectangle">&nbsp;</span>
		</div>

		<div id="nav_wrap" class="nav_wrap">
			!{include file="_nav.tpl"}
		</div>
		
		<div id="subnav">		
			!{include file="_subnav.tpl"}
		</div>
	<div id="subnavmobile">		
		!{include file="_subnav.tpl"}
	</div>
	<div id="content">	
			
		!{if $page_type eq 'db'}
		!{$page_content|stripslashes}
		!{else}
		!{if $page_content}!{include file="$page_content"}!{/if}
		!{/if}
		<BR>
!{if $smarty.session.msg}!{$smarty.session.msg}!{/if} 						
	</div>
	
	<br clear="all">

	<div id="footerline">
		<span class="rect">&nbsp;</span>
		!{*<span class="rect-2"><a href="/?page=scp_general"><img src="/userfiles/image/site/text-only-footer-SCP.png"></a></span>
		<span class="rect-3"><a href="/?page=ap_general"><img src="/userfiles/image/site/text-only-footer-AP.png"></a></span>
		*}
	</div>


	!{if $footer}!{include file="$footer"}!{/if} 
		
	</div> 
</div> 
<a href="#" class="sf-back-to-top"><span class="arrow"></span></a>
<script>
var amountScrolled = 300;

$(window).scroll(function() {
    if ( $(window).scrollTop() > amountScrolled ) {
        $('a.sf-back-to-top').fadeIn('slow');
    } else {
        $('a.sf-back-to-top').fadeOut('slow');
    }
});

$('a.sf-back-to-top').click(function() {
    $('html, body').animate({
        scrollTop: 0
    }, 700);
    return false;
});
</script>
<script>
$(document).ready(function() {

	$('#mobile-nav').click(function () {
      $('#menu').toggleClass('open');
       
    });
    
});
</script>
</body>
</html>
