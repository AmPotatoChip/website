<table border="0" cellpadding="3" cellspacing="0" id="form" width="100%">
<thead>
<tr>
<td colspan="6">Bulk Mail Batches</td>
</tr>
<tr>
<td>Mail Subject</td>
<td width="80">Status</td>
<td width="180">Delivery Date</td>
<td width="60" align="center">Contacts</td>
<td width="60" align="center">View</td>
<td width="60" align="center">Delete</td>
</tr>
</thead>
<tbody>
!{section name="batch" loop="$batches"}
<tr>
<td>!{$batches[batch]->subject|stripslashes}</td>
<td>!{$batches[batch]->status|stripslashes}</td>
<td>!{$batches[batch]->delivery_date|date_format} !{$batches[batch]->delivery_date|date_format:"%I:%M %p"}</td>
<td align="center">!{$batches[batch]->email_count}</td>
<td align="center"><a href="view_batch_info.php?batch_id=!{$batches[batch]->batch_id}" class="link"><img src="/images/icons/folder_edit_16.gif" border="0" /></a></td>
<td align="center"><a href="delete_batch.php?batch_id=!{$batches[batch]->batch_id}" class="link" onClick="return confirm('Are you sure you would like to delete this batch?');"><img src="/images/icons/folder_close_16.gif" border="0" /></a></td>
</tr>
!{/section}
</tbody>
</table>