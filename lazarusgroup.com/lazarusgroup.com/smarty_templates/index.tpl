<table id="home">
!{section name="squares" loop="$indexData"}
!{if !$tr_count}
	!{assign var="tr_count" value="1"}
	<tr>
!{else}
	!{math equation="a+b" a=$tr_count b=1 assign="tr_count"}
!{/if}

<td width="240">
<div class="!{$indexData[squares]->css2}"><a href="!{$indexData[squares]->url}" class="white">&middot; !{$indexData[squares]->cat_name} &middot;</a></div>
<a href="!{$indexData[squares]->url}">
<img src="!{present_image_display_by_media_id value=$indexData[squares]->square_media_id}" width="240" height="190" border="0" class="door">
</a>
</td>
!{if $tr_count eq 2}
	!{assign var="tr_count" value=""}
	</tr>
!{/if}
!{/section}
</table>


<br clear="all" />


!{if $topStories}
!{section name='item' loop=$topStories}
<table width="500" border="0" cellspacing="1" cellpadding="0" align="center" id="other">
<tr>
<td class="article">
!{if $topStories[item]->headline}<h1>!{$topStories[item]->headline|stripslashes}</h1>!{/if}
!{if $topStories[item]->subhead}<h2>!{$topStories[item]->subhead|stripslashes}</h2>!{/if}
!{if $topStories[item]->byline}<div class="byline">!{$topStories[item]->byline|stripslashes}</div>!{/if}
!{if $topStories[item]->dateline}<div class="dateline">!{$topStories[item]->dateline|stripslashes}</div>!{/if}
!{$topStories[item]->exerpt|stripslashes}

<div id="readmore"><img src="/images/readmore_arrow.gif" alt="" border="0">
<a href="!{$smarty.const.URL}full_content.php?article_id=!{$topStories[item]->id}&full=yes&pbr=1">read more</a>
</div>
</td>
</tr>
</table>
!{/section}
!{/if}