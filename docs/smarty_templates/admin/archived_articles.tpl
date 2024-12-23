<table cellpadding="3" cellspacing="0" border="0" id="display" width="900">
		<thead>
			<tr>
				<td colspan="11">Article Archive</td>
			</tr>
			<tr>
				<td width="40">ID</td>
				<td width="50">Created</td>
				<td width="70">Last Mod</td>
				<td width="50">Dateline</td>
				<td>Headline</td>
				<td align="center" width="70">View</td>
				<td align="center" width="70">Edit</td>
				<td align="center" width="70">Delete</td>
				<td align="left" width="70">Status</td>
			</tr>
		</thead>
		<tbody style="overflow-y:auto;overflow-x:hidden;height:400px;">
			!{assign var='total_article_count' value=$content|@count}
			!{section name="item" loop="$content"}
				<tr bgcolor="!{cycle values="#FFFFFF,#DFE5FF"}">
					<td>!{$content[item]->id}</td>
					<td width="50" style="color:#9F9F9F;">!{$content[item]->created|date_format:"%D"}</td>
					<td width="70" style="color:#9F9F9F;">!{$content[item]->last_mod|date_format:"%D"}</td>
					<td width="50">!{$content[item]->dateline|date_format:"%D"}</td>
					
					
					<td>!{$content[item]->headline}</td>
					<td align="center"><a href="javascript:;" onClick="viewArticle('!{$content[item]->id}');"><img src="/images/icons/doc_prev_16.gif" border="0" /></a></td>
					<td align="center"><a href="?catid=!{$smarty.get.catid}&article_id=!{$content[item]->id}&type=editor"><img src="/images/icons/doc_edit_16.gif" border="0" /></a></td>
					<td align="center"><a href="delete_article.php?article_id=!{$content[item]->id}&catid=!{$smarty.get.catid}" onClick="return confirm('Are you sure you would like to delete this article?');"><img src="/images/icons/doc_close_16.gif" border="0" /></a></td>
					<td style="padding:0 25 0 0;">
					<select name="article_status" onChange="articleStatusChange(this,'!{$content[item]->id}');">
						<option value="archived" !{if $content[item]->article_status eq 'archived'}selected!{/if}>Archived</option>
						<option value="off" !{if $content[item]->article_status eq 'off'}selected!{/if}>Off</option>
						<option value="live" !{if $content[item]->article_status eq 'live'}selected!{/if}>Live</option>
					</select>
					</td>
				</tr>
			!{/section}
		</tbody>
		
	</table>