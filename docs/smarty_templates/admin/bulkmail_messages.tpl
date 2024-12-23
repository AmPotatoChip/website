<br />
<p>
<a href="create_bulkmail_message.php" class="link"style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/doc_add_16.gif" border="0" /> Create a new mail message</a>
</p>
<table border="0" cellspacing="0" cellpadding="3" id="form" width="100%">
<thead>
<tr>
<td>Subject</td>

<td width="140">Author</td>
<td width="100">Created</td>
<td width="30" align="center">Preview</td>
<td width="30" align="center">Edit</td>
<td width="30" align="center">Delete</td>
</tr>
</thead>
<tbody>
!{if $bulkmessages}
!{section name="bm" loop="$bulkmessages"}
<tr bgcolor="!{cycle values="#FFFCDF,#FFFFFF"}">
<td>!{$bulkmessages[bm]->subject|stripslashes}</td>
<td width="140">!{$bulkmessages[bm]->author|stripslashes}</td>
<td width="100">!{$bulkmessages[bm]->created|date_format}</td>
<td align="center"><a href="preview_message.php?message_id=!{$bulkmessages[bm]->id}" class="link"><img src="/images/icons/doc_prev_16.gif" border="0" /></a></td>
<td align="center"><a href="create_bulkmail_message.php?message_id=!{$bulkmessages[bm]->id}" class="link"><img src="/images/icons/doc_edit_16.gif" border="0" /></a></td>
<td align="center"><a href="delete_bulkmail_message.php?message_id=!{$bulkmessages[bm]->id}" class="link" onClick="return confirm('Are you sure you would like to delete this message?');"><img src="/images/icons/doc_close_16.gif" border="0" /></a></td>
</tr>
!{/section}
!{else}
<tr>
	<td colspan="5" id="red" align="center">You currently do not have any bulk mail messages</td>
</tr>
!{/if}
</tbody>
</table>
