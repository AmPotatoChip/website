!{validate form="calendar_category" field="calendar_name" criteria="notEmpty" transform="trim" assign="error_calendar_name" message="Calendar Name can not be empty"}
<h2>Calendar</h2>

!{include file="admin/_error.tpl"}
<p><a href="javascript:;" class="link" onClick="hideunhide('calendar_form');" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/calendar_add_16.gif" border="0" /> Add a new calendar</a></p>
<table id="display" width="700">
<thead>
<tr>
<td colspan="6">Current Calendar's</td>
</tr>
<tr style="vertical-align:bottom; font-size: 10pt;">
<td width="120">Calendar ID</td>
<td>Calendar Name</td>
<td width="60">Created</td>
<td width="100" align="center">Edit Calendar</td>
<td width="100" align="center">Edit Content</td>
<td width="50" align="center">Delete</td>
</tr>
</thead>
<tbody>
!{if $calendar_categories}
!{section name="item" loop=$calendar_categories}
<tr bgcolor="!{cycle values="#FFFFFF,#DFE5FF"}">
<td><b><i>!{$calendar_categories[item].id}</i></b></td>
<td>!{$calendar_categories[item].calendar_name|stripslashes}</td>
<td>!{$calendar_categories[item].created|date_format}</td>
<td align="center"><a href="calendar.php?calid=!{$calendar_categories[item].id}"><img src="/images/icons/calendar_config_16.gif" border="0" /></a></td>
<td align="center"><a href="calendar_detail.php?calid=!{$calendar_categories[item].id}"><img src="/images/icons/calendar_edit_16.gif" border="0" /></a></td>
<td align="center"><a href="delete_calendar_category.php?calid=!{$calendar_categories[item].id}" onClick="return confirm('Are you sure you would like to delete this Calendar?\nThis will delete the entries for the calendar as well.');"><img src="/images/icons/calendar_close_16.gif" border="0" /></a></td>
</tr>
!{/section}
!{else}
<tr>
<td colspan="6" id="red" align="center">You currently do not have any calendars</td>
</tr>
!{/if}
</tbody>
</table>

<div id="calendar_form" style="display:none;padding-top:10px;">
<form name="calendar_category" method="POST">
<table id="form">
<thead>
<tr>
<td colspan="2">Calendar Setup</td>
</tr>
</thead>
<tbody>
!{if $error_calendar_name}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_calendar_name}</td>
</tr>
!{/if}
<tr>
<td>Calendar Name:</td>
<td><input type="text" name="calendar_name" value="!{$calendar_name|stripslashes}" size="40"></td>
</tr>
</tbody>
<tfoot>
<tr>
<td colspan="2" align="right"><input type="button" value="Reset" onClick="document.location.href='calendar.php?show_calendar=yes';">&nbsp;
!{if $calendar_id}
<input type="submit" value="Update Calendar">
!{else}
<input type="submit" value="Add Calendar">!{/if}</td>
</tr>
</tfoot>
</table>
!{if $calendar_id}
<input type="hidden" name="calendar_id" value="!{$calendar_id}">
!{/if}
</form>
</div>

!{if $smarty.get.show_calendar eq 'yes'}
<script language="javascript">
onload = document.getElementById('calendar_form').style.display='';
</script>
!{/if}

!{if $show_form}
<script language="javascript">
onload = document.getElementById('calendar_form').style.display='';
</script>
!{/if}