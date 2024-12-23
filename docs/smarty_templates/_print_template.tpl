<html>
<head>
<title>CircleTax.com</title>
</head>

<body style="font-family:Arial, sans-serif">

<a href="javascript:;" onclick="window.print();">Print Page</a>
<table border="0" cellpadding="0" cellspacing="0" width="500">
<tr>
<td>
!{if $cont.headline}<h2>!{$cont.headline|stripslashes}</h2>!{/if}
<div>
!{if $cont.subhead}!{$cont.subhead|stripslashes}<br/>!{/if}

!{if $cont.byline}!{$cont.byline|stripslashes}<br/>!{/if}
!{if $cont.dateline}!{$cont.dateline|stripslashes}<br clear="all">!{/if}
<p>
!{$cont.full_content|stripslashes}
</p>
</td>
</tr>
</table>

</body>
</html>