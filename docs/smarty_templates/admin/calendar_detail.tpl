<h2>Calendar</h2>

Current Calendar: <b>!{$calendar_name|stripslashes}</b><br/>


!{include file="admin/calendar_layout.tpl"}



!{section name="item" loop=$cd}
	
!{/section}


<table id="display">
<thead>
<tr>
<td>Date</td>
<td width="350">Title</td>
<td width="60" align="center">Edit</td>
<td width="60" align="center">Delete</td>
</tr>
</thead>
<tbody>
!{section name="item" loop=$cd}
<tr bgcolor="!{cycle values="#FFFFFF,#DFE5FF"}">
<td><b><i>!{$cd[item].date|stripslashes|date_format}</i></b></td>
<td>!{$cd[item].title|stripslashes}</td>
<td align="center"><a href="calendar_detail.php?calid=!{$smarty.get.calid}&id=!{$cd[item].id}"><img src="/images/icons/calendar_edit_16.gif" border="0" /></a></td>
<td align="center"><a href="delete_calendar_entry.php?calid=!{$smarty.get.calid}&id=!{$cd[item].id}" onClick="return confirm('Are you sure you would like to delete this entry?');"><img src="/images/icons/calendar_close_16.gif" border="0" /></a></td>
</tr>
!{/section}
</tbody>
</table>