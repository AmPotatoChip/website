!{if $info.main_id}
	!{assign_adv var='table_id' value="`$info.main_id`"}
	!{assign_adv var='cssclass' value="`$info.cssclass`"}
!{else}
	!{assign_adv var='table_id' value="other"}
	!{assign_adv var='cssclass' value="other_title"}
!{/if}

<!-- Actionline: Go Back, Print Article, Email Article -->
<ul class="actionline">
	<li><a href="#" onclick="history.back();" class="back">Back</a></li>
	<li><a href="#" onclick="window.print();return false;" class="print">Print Article</a></li>
	<li><a href="email_article.php?article_id=!{$smarty.get.article_id}" class="email">Email Article</a></li>
</ul>




<!-- Start -->
!{if $content_config.set_headline eq 'true'}<h2>!{$cont.headline}</h2>!{/if}
!{if $content_config.set_subhead eq 'true'}<h3>!{$cont.subhead}</h3>!{/if}
!{if $content_config.set_byline eq 'true'}<div class="byline">!{$cont.byline}</div>!{/if}
!{if $content_config.set_dateline eq 'true'}<div class="dateline">!{$cont.dateline|date_format:"%h %d, %Y"}</div>!{/if}

!{if $content_config.set_exerpt eq 'true' && !$smarty.get.full}
	<p class="caption">!{$cont.exerpt}</p>
!{else}

	!{include file="article_pagination.tpl"}
	!{$cont.full_content|stripslashes}
	<br clear="all">
	!{include file="article_pagination.tpl"}
!{/if}



!{if !$smarty.get.full}
<div class="readmore"><img src="/images/readmore_arrow.gif" alt="" border="0"><a href="?article_id=!{$smarty.get.article_id}&full=yes&pbr=1">More &gt;</a></div>
!{/if}

<!-- End -->
