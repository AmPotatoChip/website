<center>
<div style="padding:10 0 0 0">

<h1>Bulk Email Report</h1>


<table border="0" cellpadding="3" cellspacing="0" align="center" class="form">
<thead class="header">
<tr>
<td width="80">Batch ID</td>
<td width="250">Message</td>
<td width="130">Delivery Time</td>
<td width="130">Completion Time</td>
<td width="80" align="center">Status</td>

</tr>
</thead>
!{if $batch_info}
<tbody>
	!{section name="item" loop=$batch_info}
		<tr bgcolor="!{cycle values="#EFEFEF,#FFFFFF"}" class="link" onClick="window.location.href='batch_report.php?batch_id=!{$batch_info[item]->batch_id}';">
			<td id="padded">!{$batch_info[item]->batch_id}</td>
			<td id="padded" title="!{$batch_info[item]->message}"><strong>!{$batch_info[item]->message_split}</strong></td>
			<td id="padded">!{$batch_info[item]->delivery_time}</td>
			<td id="padded">!{$batch_info[item]->completion_time}</td>
			<td id="padded" align="center">!{$batch_info[item]->status}</td>
		</tr>
	!{/section}
</tbody>
!{/if}
</table>


</div>
</center>