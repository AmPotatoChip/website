<table width="500" border="0" cellspacing="1" cellpadding="0" align="center" id="other">
<tr>
<td width="500" colspan="2">
<div class="other_title">&middot; THE KEYCHAIN &middot;</div>
</td>
</tr>
<tr><td colspan="2">
<div id="breadcrumbs"><a href="index.htm">Home</a> > <a href="keychain.php">The Keychain</a> ></div>
<div class="dateline">!{$smarty.now|date_format:"%h %d, %Y"}</div></td></tr>
</table>

<div id="pagination">
<b>
Dropped in the last
<a href="keychain.php?days=7" !{if $smarty.get.days eq 7} style="font-weight:bold;color:#CC0000;background-color:#fff;"!{/if}>7</a>&nbsp;<a href="keychain.php?days=30" !{if $smarty.get.days eq 30} style="font-weight:bold;color:#CC0000;background-color:#fff;"!{/if}>30</a>&nbsp;<a href="keychain.php?days=60" !{if $smarty.get.days eq 60} style="font-weight:bold;color:#CC0000;background-color:#fff;"!{/if}>60</a>
Days.
</b>
</div>


!{if $keydropper}
<table width="500" border="0" cellspacing="1" cellpadding="0" align="center" id="other">
!{section name="item" loop="$keydropper"}
!{if !$tr_count}
!{assign_adv var="tr_count" value="1"}
<tr>
!{else}
!{math equation="a+b" a=$tr_count b=1 assign='tr_count'}
!{/if}
	
<td>
!{$keydropper[item]->name|ucwords}
&nbsp;

!{section name="link" loop=$keydropper[item]->data}
<a href="/full_content.php?article_id=!{$keydropper[item]->data[link].article_id}&full=yes&pbr=1" class="namedropper">|</a>
!{/section}

</td>
	
!{if $tr_count eq '2'}
</tr>
!{assign_adv var='tr_count' value=''}
!{/if}
	
!{/section}
!{if $tr_count eq '2'}
</tr>
!{/if}
</table>
!{/if}