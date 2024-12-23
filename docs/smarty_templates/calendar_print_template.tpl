<html>
<head>
<title>!{$smarty.const.PAGE_TITLE|stripslashes}</title>
<style>
body{font-size:12px;font-family:arial,verdana;}
#container{width:550px;text-align:justify;}
</style>
</head>
<body>
<a href="javascript:;" onclick="window.print();">Print Screen</a>
&nbsp;
<a href="javascript:;" onclick="window.close();">Close Window</a>
<div id="container">
!{assign var='a' value=$calendar_entry}

!{section name="item" loop=$a}
<h1>!{$a[item].title|stripslashes}</h1>
<div style="text-align:right;font-weight:bold;">!{$a[item].date}</div>
<p>!{$a[item].description|stripslashes}</p>
!{if $a[item].venue}<h2>!{$a[item].venue|stripslashes}</h2>!{/if}
!{if $a[item].venue_address}!{$a[item].venue_address|stripslashes}<br/>!{/if}
!{if $a[item].venue_city}!{$a[item].venue_city|stripslashes}, !{/if}
!{if $a[item].venue_state}!{$a[item].venue_state} !{/if}
!{if $a[item].venue_zip}!{$a[item].venue_zip}!{/if}
<br/>
!{if $a[item].venue_phone}Phone: !{$a[item].venue_phone}<br/>!{/if}
!{if $a[item].venue_url}Website: !{$a[item].venue_url}<br/>!{/if}
!{if $a[item].venue_other_url}URL: !{$a[item].venue_other_url}<br/>!{/if}

!{/section}

</div>
</body>
</html>