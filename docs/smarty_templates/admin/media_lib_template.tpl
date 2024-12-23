<html>
<head>
<title>!{if $page_title}!{$page_title}!{/if}</title>
!{if $css}!{$css}!{/if}
!{if $javascripts}!{$javascripts}!{/if}
</head>
<body>
<p>
<table broder="0" cellpadding="3" cellspacing="0" width="100%" id="header">
	<tr>
		<td>Media Library</td>
	</tr>
</table>
</p>
!{if $page_type eq 'db'}
	!{$page_content|stripslashes}
!{else}
	!{if $page_content}!{include file="$page_content"}!{/if}
!{/if}

</body>
</html>