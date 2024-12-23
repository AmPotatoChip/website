!{if $header}!{include file="$header"}!{/if}
<table border="0" cellpadding="3" cellspacing="0" width="100%">
<tr>
<td valign="top" align="center" style="padding:100 0 0 0;">
!{if $page_type eq 'db'}
	!{$page_content|stripslashes}
!{else}
	!{if $page_content}!{include file="$page_content"}!{/if}
!{/if}
</td>
</tr>
</table>


!{if $footer}!{include file="$footer"}!{/if}