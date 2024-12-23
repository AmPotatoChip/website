<table width="500" border="0" cellspacing="1" cellpadding="0" align="center" id="music">						
<tr>
<td width="500" colspan="2">
<div class="music_title">&middot; SEARCH RESULTS &middot;</div>
</td>
</tr>
<tr><td colspan="2">
<div id="breadcrumbs"><a href="index.php">Home</a> ></div>
<div class="dateline">!{$smarty.now|date_format:"%h %d, %Y"}</div></td></tr>
</table>

!{if !$sr}
<div style="font-size:14px;font-weight:bold;">No Results Found.</div>
!{else}



!{if $total_count>$limit}
<div id="pagination">
!{if !$smarty.get.page}
	!{assign_adv var='page' value=1}
!{else}
	!{assign_adv var='page' value=$smarty.get.page}
!{/if}


!{section name="p" loop="$page_range"}
<a href="search.php?searchbox=!{$smarty.get.searchbox}&page=!{$page_range[p]}" !{if $page eq $page_range[p]}style="font-weight:bold;color:#CC0000;"!{/if} >!{$page_range[p]}</a>
!{/section}
</div>
!{/if}
!{section name='item' loop=$sr}
<table width="500" border="0" cellspacing="1" cellpadding="0" align="center" id="other">
<tr>
<td class="article">
!{if $sr[item]->headline}<h1>!{$sr[item]->headline|stripslashes}</h1>!{/if}
!{if $sr[item]->subhead}<h2>!{$sr[item]->subhead|stripslashes}</h2>!{/if}
!{if $sr[item]->byline}<div class="byline">!{$sr[item]->byline|stripslashes}</div>!{/if}
!{if $sr[item]->dateline}<div class="dateline">!{$sr[item]->dateline|stripslashes}</div>!{/if}
!{$sr[item]->exerpt|stripslashes}

<div id="readmore"><img src="/images/readmore_arrow.gif" alt="" border="0">
<a href="!{$smarty.const.URL}full_content.php?article_id=!{$sr[item]->id}&full=yes&pbr=1">read more</a>
</div>
</td>
</tr>
</table>
!{/section}






!{/if}