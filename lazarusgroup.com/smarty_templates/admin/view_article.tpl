<link rel="stylesheet" type="text/css" href="/present_magazine.css">
<table width="500" cellspacing="1" cellpadding="0" align="center" id="other">
<tr>
<td class="article">
<!-- Start -->
!{if $content_config.set_headline eq 'true'}<h1>!{$cont.headline}</h1>!{/if}
!{if $content_config.set_subhead eq 'true'}<h2>!{$cont.subhead}</h2>!{/if}
!{if $content_config.set_byline eq 'true'}<div class="byline">!{$cont.byline}</div>!{/if}
!{if $content_config.set_dateline eq 'true'}<div class="dateline">!{$cont.dateline}</div>!{/if}

!{if $content_config.set_exerpt eq 'true' && !$smarty.get.full}
	<div class="caption">!{$cont.exerpt}</div>
!{else}
	!{include file="admin/article_pagination.tpl"}
	!{$cont.full_content|stripslashes}
	!{include file="admin/article_pagination.tpl"}
!{/if}




!{if !$smarty.get.full}
<div class="readmore"><a href="?article_id=!{$smarty.get.article_id}&full=yes!{if $page_breaks}&pbr=1!{/if}">read more &gt;</a>
!{/if}

</div>
	<!-- End -->
	</td>
</tr>
</table>