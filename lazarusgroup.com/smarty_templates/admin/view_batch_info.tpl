<h2>Detailed Batch Information</h2>

<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
</thead>
<tbody>
<tr>
<td id="right">Batch ID:</td>
<td>!{$bi.batch_id}</td>
</tr>
<tr>
<td id="right">Template:</td>
<td>!{$bi.template_file|stripslashes}</td>
</tr>
<tr>
<td id="right">Message Subject:</td>
<td>!{$bi.message_subject|stripslashes}</td>
</tr>
<tr>
<td id="right">From Name:</td>
<td>!{$bi.from_name|stripslashes}</td>
</tr>
<tr>
<td id="right">From Email:</td>
<td>!{$bi.from_email|stripslashes}</td>
</tr>
<tr>
<td id="right">Category Name:</td>
<td>!{$bi.category_name|stripslashes}</td>
</tr>
<tr>
<td id="right">Deliver Date:</td>
<td>!{$bi.delivery_date|date_format} !{$bi.delivery_date|date_format:"%I:%M %p"}</td>
</tr>
<tr>
<td id="right">Delivered:</td>
<td>
!{if $bi.delivery_stamp eq '0000-00-00 00:00:00'}
	Not sent yet
!{else}
!{$bi.delivery_stamp|date_format} !{$bi.delivery_stamp|date_format:"%I:%M %p"}
!{/if}
</td>
</tr>
<tr>
<td id="right">Status:</td>
<td>!{$bi.status|stripslashes}</td>
</tr>
!{if $bi.status eq 'sent'}
<tr>
<td id="right">Emails Sent Out:</td>
<td>!{$bi.send_count}</td>
</tr>
<tr>
<td id="right">Opened Emails:</td>
<td>!{$bi.open_count}</td>
</tr>
!{/if}
</tbody>
</table>

!{if $bi.status eq 'sent'}
<p>
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
<tr>
<td>Name</td>
<td>Email</td>
<td>Open Date</td>
<td align="center">Open Count</td>
</tr>
</thead>
!{section name="item" loop=$bi.sent_to_data}
<tr bgcolor="!{cycle values="#FFFCDF,#FFFFFF"}">
<td>!{$bi.sent_to_data[item]->contact_name|stripslashes}</td>
<td>!{$bi.sent_to_data[item]->email}</td>
<td>!{$bi.sent_to_data[item]->open_date|date_format} !{$bi.sent_to_data[item]->open_date|date_format:"%I:%M %p"}</td>
<td align="center">!{$bi.sent_to_data[item]->open_count}</td>
</tr>

!{/section}
</table>
</p>
!{/if}

!{if $bi.links}
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
<tr>
<td colspan="3">Links Clicked</td>
</tr>
<tr>
<td>Email</td>
<td>URL</td>
<td>Timestamp</td>
</tr>
</thead>
!{section name="x" loop=$bi.links}
<tr>
	<td>!{$bi.links[x]->email}</td>
	<td>!{$bi.links[x]->url}</td>
	<td>!{$bi.links[x]->stamp}</td>
</tr>
!{/section}
</table>
!{/if}

















