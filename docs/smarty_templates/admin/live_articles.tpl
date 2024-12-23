<table cellpadding="3" cellspacing="0" border="0" id="display" width="900">
		<thead>
			<tr>
				<td colspan="11">Live Articles</td>
			</tr>
			<tr>
				<td width="40">ID</td>
				<td width="50">Created</td>
				<td width="70">Last Mod</td>
				<td width="80">Dateline</td>
				<td>Headline</td>
				<td align="center" width="50">View</td>
				<td align="center" width="50">Edit</td>
				<td align="center" width="50">Delete</td>
				<td align="center" width="50">Status</td>
				<td>&nbsp;</td>
			</tr>
		</thead>
		<tbody style="overflow-y:auto;overflow-x:hidden;height:400px;">
			!{assign var='total_article_count' value=$livecontent|@count}
			!{section name="item" loop="$livecontent"}
				<tr bgcolor="!{cycle values="#FFFFFF,#DFE5FF"}">
					<td>!{$livecontent[item]->id}</td>
					<td width="50" style="color:#9F9F9F;">!{$livecontent[item]->created|date_format:"%D"}</td>
					<td width="70" style="color:#9F9F9F;">!{$livecontent[item]->last_mod|date_format:"%D"}</td>
					<td width="80">!{$livecontent[item]->dateline|date_format:"%D"}</td>
					<td>!{$livecontent[item]->headline}</td>
					<td align="center"><a href="javascript:;" onClick="viewArticle('!{$livecontent[item]->id}');"><img src="/images/icons/doc_prev_16.gif" border="0" /></a></td>
					<td align="center"><a href="?catid=!{$smarty.get.catid}&article_id=!{$livecontent[item]->id}&type=editor"><img src="/images/icons/doc_edit_16.gif" border="0" /></a></td>
					<td align="center"><a href="delete_article.php?article_id=!{$livecontent[item]->id}&catid=!{$smarty.get.catid}" onClick="return confirm('Are you sure you would like to delete this article?');"><img src="/images/icons/doc_close_16.gif" border="0" /></a></td>
					
					<td align="center">
					<select name="article_status" onChange="articleStatusChange(this,'!{$livecontent[item]->id}');">
						<option value="archived" !{if $livecontent[item]->article_status eq 'archived'}selected!{/if}>Archived</option>
						<option value="off" !{if $livecontent[item]->article_status eq 'off'}selected!{/if}>Off</option>
						<option value="live" !{if $livecontent[item]->article_status eq 'live'}selected!{/if}>Live</option>
					</select>
					</td>
					
					<td style="padding:0 25 0 0;">
					
					!{assign_adv var='order_range' value="range(1,$total_article_count)"}
					<select name="order" id="order_!{$livecontent[item]->id}" onChange="reorderArciles('!{$livecontent[item]->id}','order_!{$livecontent[item]->id}');">
					!{section name=order loop=$order_range}
						<option value="!{$order_range[order]}" !{if $livecontent[item]->in_cat_order eq $order_range[order]}selected!{/if}>!{$order_range[order]}</option>
					!{/section}
					</select>
					</td>
				</tr>
			!{/section}
		</tbody>
		
	</table>