!{include file="admin/_error.tpl"}
!{validate form="calendar_entry" field="calendar_type" criteria="notEmpty" assign="error_calendar_type" message="Calendar Entry Type can not be empty"}
!{validate form="calendar_entry" field="date" criteria="notEmpty" assign="error_date" message="Date can not be empty"}
!{validate form="calendar_entry" field="title" criteria="notEmpty" assign="error_title" message="Headline can not be empty"}
!{validate form="calendar_entry" field="description" criteria="notEmpty" assign="error_description" message="Description can not be empty"}


<script language="javascript">
function calendarTypeSeletor(objID,toggleID){
	var objValue = document.getElementById(objID).value;
	switch(objValue){
		case 'single':
			document.getElementById(toggleID).style.display='none';
		break;
		case 'multiple':
			document.getElementById(toggleID).style.display='';
		break;	
	}	
}
</script>
<div style="display:none;" id="calendar_form">


<div style="font-size:12px;">
Fields marked by (<span style="color:#CC0000;font-weight:bold;">*</span>) are required!
</div>
<form name="calendar_entry" method="POST" action="calendar_detail.php?calid=!{$smarty.get.calid}">
<table id="form" style="margin-bottom:20px;">
<thead>
<tr>
<td colspan="2">Calendar Entry for (!{$calendar_name|stripslashes}) </td>
</tr>
</thead>
<tbody>
!{if $error_calendar_type}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_calendar_type}</td>
</tr>
!{/if}
<tr>
<td id="right"><span style="color:#CC0000;font-weight:bold;">*</span> Calendar Entry Type:</td>
<td><input type="radio" name="calendar_type" value="single" id="calendar_type_single" onClick="calendarTypeSeletor('calendar_type_single','untildate');" !{if $calendar_type eq 'single'}checked!{/if}><label for="calendar_type_single">Single Day</label>
<input type="radio" name="calendar_type" value="multiple" id="calendar_type_multiple" onClick="calendarTypeSeletor('calendar_type_multiple','untildate');" !{if $calendar_type eq 'multiple'}checked!{/if}><label for="calendar_type_multiple">Multiple Day</label>
</tr>
!{if $error_date}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_date}</td>
</tr>
!{/if}
<tr>
<td id="right"><span style="color:#CC0000;font-weight:bold;">*</span> Date:</td>
<td valign="top">
<link rel="stylesheet" type="text/css" media="all" href="/admin/common/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
<script type="text/javascript" src="/admin/common/calendar/calendar.js"></script>
<script type="text/javascript" src="/admin/common/calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="/admin/common/calendar/calendar-setup.js"></script>
		
<input type="text" name="date" id="date" size="10" value="!{$date|stripslashes}" style="background-color:#fff;color:#000;border:1px solid #A5ACB2;">
<img src="calendar_icon.gif" id="trigger">
		
<script type="text/javascript">
Calendar.setup({
inputField     :    "date",      // id of the input field
ifFormat       :    "%Y-%m-%d",       // format of the input field
showsTime      :    false,            // will display a time selector
button         :    "trigger",   // trigger for the calendar (button ID)
singleClick    :    true,           // double-click mode
step           :    1                // show all years in drop-down boxes (instead of every other year as default)
});
</script>
</td>
</tr>
!{if $error_todate}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_todate}</td>
</tr>
!{/if}
<tr id="untildate" style="display:none;">
<td id="right"><span style="color:#CC0000;font-weight:bold;">*</span> Until Date:</td>
<td><input type="text" name="todate" id="todate" size="10" value="!{$todate|stripslashes}" style="background-color:#fff;color:#000;border:1px solid #A5ACB2;">
<img src="calendar_icon.gif" id="trigger2">


		
<script type="text/javascript">
Calendar.setup({
inputField     :    "todate",      // id of the input field
ifFormat       :    "%Y-%m-%d",       // format of the input field
showsTime      :    false,            // will display a time selector
button         :    "trigger2",   // trigger for the calendar (button ID)
singleClick    :    true,           // double-click mode
step           :    1                // show all years in drop-down boxes (instead of every other year as default)
});
</script></td>
</tr>
!{if $error_title}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_title}</td>
</tr>
!{/if}
<tr>
<td id="right"><span style="color:#CC0000;font-weight:bold;">*</span> Headline:</td>
<td><input type="text" name="title" value="!{$title|stripslashes}" size="50"></td>
</tr>
!{if $error_description}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_description}</td>
</tr>
!{/if}
<tr>
<td id="right" valign="top"><span style="color:#CC0000;font-weight:bold;">*</span> Description:</td>
<td><textarea name="description" cols="60" rows="6">!{$description|stripslashes}</textarea></td>
</tr>
<tr>
<td id="right">Venue:</td>
<td><input type="text" name="venue" value="!{$venue|stripslashes}" size="50"></td>
</tr>
<tr>
<td id="right">Venue Address:</td>
<td><input type="text" name="venue_address" value="!{$venue_address|stripslashes}" size="50"></td>
</tr>
<tr>
<td id="right">Venue City:</td>
<td><input type="text" name="venue_city" value="!{$venue_city|stripslashes}" size="30"></td>
</tr>
<tr>
<td id="right">Venue State:</td>
<td><input type="text" name="venue_state" value="!{$venue_state|stripslashes}" size="2" maxlength="2"></td>
</tr>
<tr>
<td id="right">Venue Zip:</td>
<td><input type="text" name="venue_zip" value="!{$venue_zip|stripslashes}" size="10"></td>
</tr>
<tr>
<td id="right">Venue Phone:</td>
<td><input type="text" name="venue_phone" value="!{$venue_phone|stripslashes}" size="15" maxlength="15"></td>
</tr>
<tr>
<td id="right">Venue URL:</td>
<td><input type="text" name="venue_url" value="!{$venue_url|stripslashes}" size="50"></td>
</tr>
<tr>
<td id="right">Other URL:</td>
<td><input type="text" name="other_url" value="!{$other_url|stripslashes}" size="50"></td>
</tr>
<tr>
<td id="right" valign="top">Related Article(s):</td>
<td><textarea name="related_articles" cols="60" rows="2">!{$related_articles|stripslashes}</textarea><br/>
<span style="font-size:10px">Each Article ID must be seperated by a comma, i.e. 345.435,234</span>
</td>
</tr>
</tbody>
<tfoot>
<tr>
<td colspan="2" align="right">
!{if $id}<input type="submit" value="Update Entry">!{else}
<input type="submit" value="Add Entry">!{/if}</td>
</tr>
</tfoot>
</table>
<input type="hidden" name="calid" value="!{$smarty.get.calid}">
!{if $id}<input type="hidden" name="id" value="!{$id}">!{/if}
</form>


!{if $calendar_type eq 'multiple'}
<script language="javascript">
onload = document.getElementById('untildate').style.display='';
</script>
!{/if}

</div>




!{if $smarty.get.id}
<script language="javascript">
onload = document.getElementById('calendar_form').style.display='';
</script>
!{/if}

!{if $show_form}
<script language="javascript">
onload = document.getElementById('calendar_form').style.display='';
</script>
!{/if}