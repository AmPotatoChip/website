!{if $header}!{include file="$header"}!{/if}


<table border="0" cellpadding="3" cellspacing="0" width="100%">
<tr>
<td width="180" valign="top">!{include file="admin/main_navigation.tpl"}</td>
<td valign="top">
!{if $page_type eq 'db'}
	!{$page_content|stripslashes}
!{else}
	!{if $page_content}!{include file="$page_content"}!{/if}
!{/if}
</td>
</tr>
</table>


!{if $footer}!{include file="$footer"}!{/if}