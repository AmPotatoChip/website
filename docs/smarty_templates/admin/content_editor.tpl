<h2>Content Editor</h2>
<div style="font-size:20px;margin:5 5 25 5px;">
Page Category: <i style="color:#CC0000;">!{$category_name}</i>
</div>
<p id="link">
<a href="content_editor.php?catid=!{$smarty.get.catid}&type=editor"><img src="/images/icons/doc_add_16.gif" border="0" /> Create a New Article</a>
</p>
!{include file="admin/_error.tpl"}


<table border="0" cellpadding="3" cellspacing="0" id="tabulated">
<thead>
	<tr>
		<td onClick="contentEditorNav('!{$smarty.get.catid}','live');" width="120" !{if $smarty.get.type eq 'live'}class="tab_on"!{else}class="tab_off"!{/if}><img src="/images/icons/doc_16.gif" border="0" /> Live Articles</td>
		<td onClick="contentEditorNav('!{$smarty.get.catid}','archive');" width="120" !{if $smarty.get.type eq 'archive'}class="tab_on"!{else}class="tab_off"!{/if}><img src="/images/icons/doc_save_16.gif" border="0" /> Article Archive</td>
		<td onClick="contentEditorNav('!{$smarty.get.catid}','editor');" width="120" !{if $smarty.get.type eq 'editor'}class="tab_on"!{else}class="tab_off"!{/if}><img src="/images/icons/doc_edit_16.gif" border="0" /> Content Editor</td>
		<td class="tab_off">&nbsp;</td>
	</tr>
</thead>
<tbody>
<tr>
<td colspan="4" style="border-left:1px solid #000000;border-right:1px solid #000000;border-bottom:1px solid #000000;">

!{if $smarty.get.type eq live}
!{include file="admin/live_articles.tpl"}
!{/if}

!{if $smarty.get.type eq archive}
!{include file="admin/archived_articles.tpl"}
!{/if}

!{if $smarty.get.type eq editor}
!{include file="admin/editor_tab.tpl"}
!{/if}

</td>
</tr>
</tbody>
</table>