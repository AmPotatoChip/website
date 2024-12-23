<div style="padding:10 0 0 0;text-align:center;">
<center>

<h1>Batch Information</h1>
<a href="mail_report.php">Back to view all batches</a>
<br/>
<br/>
<table border="0" cellpadding="3" cellspacing="2" class="form">
<tr>
<td style="background-color:#000;color:#fff;padding: 2 2 2 2;">Batch ID</td>
<td style="background-color:#ECECEC;color:#000;padding: 2 2 2 2;">!{$batch_info->batch_id}</td>
</tr>
<tr>
<td style="background-color:#000;color:#fff;padding: 2 2 2 2;">Message</td>
<td style="background-color:#ECECEC;color:#000;padding: 2 2 2 2;"><strong>!{$batch_info->message}</strong></td>
</tr>
<tr>
<td style="background-color:#000;color:#fff;padding: 2 2 2 2;">Delivery Time</td>
<td style="background-color:#ECECEC;color:#000;padding: 2 2 2 2;">!{$batch_info->delivery_time}</td>
</tr>
<tr>
<td style="background-color:#000;color:#fff;padding: 2 2 2 2;">Completed Time</td>
<td style="background-color:#ECECEC;color:#000;padding: 2 2 2 2;">!{$batch_info->completion_time}</td>
</tr>
<tr>
<td style="background-color:#000;color:#fff;padding: 2 2 2 2;">Status</td>
<td style="background-color:#ECECEC;color:#000;padding: 2 2 2 2;">!{$batch_info->status}</td>
</tr>
</table>
<br/>



<table border="0" cellpadding="3" cellspacing="2" class="form">
<thead class="header">
<tr>
<td style="padding:2 2 2 2;">Total Email Sent Out</td>
<td style="padding:2 2 2 2;">Emails Opened</td>
<td style="padding:2 2 2 2;">Successfuly Sent</td>
<td style="padding:2 2 2 2;">Error Sent</td>
</tr>
</thead>
<tbody>
<tr bgcolor="#ECECEC">
<td style="padding:2 2 2 2;" align="center"><strong>!{$stats->total_sent}</strong></td>
<td style="padding:2 2 2 2;" align="center"><strong>!{$stats->open_count}</strong></td>
<td style="padding:2 2 2 2;" align="center"><strong>!{$stats->successful_sent}</strong></td>
<td style="padding:2 2 2 2;" align="center"><strong>!{$stats->error_sent}</strong></td>
</tr>
</tbody>
</table>
<br/>

<script language="javascript">
function showTable(table_id){
	var tableCheck = document.getElementById(table_id).style.display;
	switch(tableCheck){
		case 'none':
			document.getElementById(table_id).style.display='';
		break;
		default:
			document.getElementById(table_id).style.display='none';
		break;	
	}
}
</script>

!{if $opened_contacts}

<a href="javascript:;" onClick="showTable('opened');">Who opened the email?</a>

!{/if}

!{if $links_opened}
<a href="javascript:;" onClick="showTable('links');">Who clicked on links?</a>
!{/if}
<br/><br/>
!{if $opened_contacts}

<table border="0" cellpadding="3" cellspacing="0" class="form" style="display:none" id="opened">
<thead class="header">
<tr>
<td colspan="9"><h1 style="color:#FFF;">Opened Email</h1></td>
</tr>
<tr>
<td style="padding:2 2 2 2;" width="120">Name</td>
<td style="padding:2 2 2 2;" width="120">Company</td>
<td style="padding:2 2 2 2;" width="120">Address</td>
<td style="padding:2 2 2 2;" width="120">City</td>
<td style="padding:2 2 2 2;" width="70">State</td>
<td style="padding:2 2 2 2;" width="80">Zip</td>
<td style="padding:2 2 2 2;" width="100">Email</td>
<td style="padding:2 2 2 2;" width="100">Phone</td>
<td style="padding:2 2 2 2;" width="60" align="center">Opened</td>
</tr>
</thead>

<tbody class="scroll">
!{section name="item" loop=$opened_contacts}
	<tr bgcolor="!{cycle values="#ECECEC,#FFFFFF"}" class="link">
	<td style="padding:2 2 2 2;" width="120">!{$opened_contacts[item]->first_name} !{$opened_contacts[item]->last_name}</td>
	<td style="padding:2 2 2 2;" width="120">!{$opened_contacts[item]->company}</td>
	<td style="padding:2 2 2 2;" width="120">!{$opened_contacts[item]->address}</td>
	<td style="padding:2 2 2 2;" width="120">!{$opened_contacts[item]->city}</td>
	<td style="padding:2 2 2 2;" width="70">!{$opened_contacts[item]->state}</td>
	<td style="padding:2 2 2 2;" width="80">!{$opened_contacts[item]->zip}</td>
	<td style="padding:2 2 2 2;" width="100">!{$opened_contacts[item]->email}</td>
	<td style="padding:2 2 2 2;" width="100">!{$opened_contacts[item]->phone}</td>
	<td style="padding:2 2 2 2;" width="60" align="center">!{$opened_contacts[item]->open_count}</td>
	</tr>
!{/section}
</tbody>

</table>
<br/>
!{/if}

!{if $links_opened}
<table border="0" cellpadding="3" cellspacing="0" class="form" style="display:none" id="links">
<thead class="header">
<tr>
<td colspan="8"><h1 style="color:#fff;">Clicked Links</h1></td>
</tr>
<tr>
<td style="padding:2 2 2 2;" width="120">Name</td>
<td style="padding:2 2 2 2;" width="120">Company</td>
<td style="padding:2 2 2 2;" width="120">Address</td>
<td style="padding:2 2 2 2;" width="120">City</td>
<td style="padding:2 2 2 2;" width="70">State</td>
<td style="padding:2 2 2 2;" width="80">Zip</td>
<td style="padding:2 2 2 2;" width="100">Email</td>
<td style="padding:2 2 2 2;" width="100">link</td>
</tr>
</thead>

<tbody class="scroll">
!{section name="item" loop=$links_opened}
	<tr bgcolor="!{cycle values="#ECECEC,#FFFFFF"}" class="link">
	<td style="padding:2 2 2 2;" width="120">!{$links_opened[item]->first_name} !{$opened_contacts[item]->last_name}</td>
	<td style="padding:2 2 2 2;" width="120">!{$links_opened[item]->company}</td>
	<td style="padding:2 2 2 2;" width="120">!{$links_opened[item]->address}</td>
	<td style="padding:2 2 2 2;" width="120">!{$links_opened[item]->city}</td>
	<td style="padding:2 2 2 2;" width="70">!{$links_opened[item]->state}</td>
	<td style="padding:2 2 2 2;" width="80">!{$links_opened[item]->zip}</td>
	<td style="padding:2 2 2 2;" width="100">!{$links_opened[item]->email}</td>
	<td style="padding:2 2 2 2;" width="100">!{$links_opened[item]->url}</td>
	</tr>
!{/section}
</tbody>

</table>
<br/>
!{/if}


</center>
</div>