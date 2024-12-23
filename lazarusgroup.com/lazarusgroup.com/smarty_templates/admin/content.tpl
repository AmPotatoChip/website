

<h2>Website Content</h2>
!{include file="admin/_error.tpl"}

!{if !$smarty.get.type}
	!{assign_adv var="tab" value="pages"}
!{else}
	!{assign_adv var="tab" value=$smarty.get.type}
!{/if}

<table border="0" cellpadding="3" cellspacing="0" id="tabulated" width="760">
<thead>
<tr>
<td width="140" id="link" !{if $tab eq 'pages'}class="tab_on"!{else}class="tab_off"!{/if} width="55"><a href="content.php?type=pages"><img src="/images/icons/doc_16.gif" border="0" />  Pages</a></td>
<td width ="200" id="link" !{if $tab eq 'category'}class="tab_on"!{else}class="tab_off"!{/if} width="170"><a href="content.php?type=category"><img src="/images/icons/doc_add_16.gif" border="0" />  Create Content Category</a></td>
<td class="tab_off">&nbsp;</td>
</tr>
</thead>
<tbody>
<tr>
<td colspan="3" style="border-left:1px solid #000000;border-right:1px solid #000000;border-bottom:1px solid #000000;">
!{if $tab eq 'pages'}
!{include file="admin/website_content_pages.tpl"}
!{/if}
!{if $tab eq 'category'}
!{include file="admin/website_content_category.tpl"}
!{/if}
</td>
</tr>
</tbody>
</table>

