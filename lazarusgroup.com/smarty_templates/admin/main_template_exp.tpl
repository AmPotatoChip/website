!{if $header}!{include file="$header"}!{/if}



!{include file="admin/main_navigation.tpl"}
<div>
!{if $page_type eq 'db'}
	!{$page_content|stripslashes}
!{else}
	!{if $page_content}!{include file="$page_content"}!{/if}
!{/if}
</div>


!{if $footer}!{include file="$footer"}!{/if}