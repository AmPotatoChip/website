!{validate form="live_mail_date" field="month" criteria="notEmpty" assign="error_month" message="Month can not be empty"}
!{validate form="live_mail_date" field="month" criteria="notEmpty" assign="error_month" message="Month can not be empty"}
!{validate form="live_mail_date" field="day" criteria="notEmpty" assign="error_day" message="Day can not be empty"}
!{validate form="live_mail_date" field="year" criteria="notEmpty" assign="error_year" message="Year can not be empty"}
!{validate form="live_mail_date" field="hour" criteria="notEmpty" assign="error_hour" message="Hour can not be empty"}
!{validate form="live_mail_date" field="minute" criteria="notEmpty" assign="error_minute" message="Minutes can not be empty"}

<div style="padding:10 0 0 0;">
!{include file="mailsystem/_error.tpl"}

<form name="live_mail_date" id="live_mail_date" method="POST" action="send_live.php?message_id=!{$smarty.get.message_id}">

<table border="0" cellpadding="3" cellspacing="0" align="center">
<tr>
<td colspan="4">
!{if $error_month}
<span style="color:#CC0000;">!{$error_month}</span><br/>
!{/if}
!{if $error_day}
<span style="color:#CC0000;">!{$error_day}</span><br/>
!{/if}
!{if $error_year}
<span style="color:#CC0000;">!{$error_year}</span><br/>
!{/if}
!{if $error_hour}
<span style="color:#CC0000;">!{$error_hour}</span><br/>
!{/if}
!{if $error_minute}
<span style="color:#CC0000;">!{$error_minute}</span><br/>
!{/if}

</td>
</tr>
<tr>
<td class="form">Send Date:</td>
<td><select name="month" id="month">
!{assign_adv var='months' value="range(1,12)"}
<option value="">Month</option>
!{section name="item" loop=$months}
<option value="!{$months[item]}" !{if $month eq $months[item]}selected!{/if}>!{$months[item]}</option>
!{/section}
</select>
</td>
<td><select name="day" id="day">
!{assign_adv var='days' value="range(1,31)"}
<option value="">Day</option>
!{section name="item" loop=$days}
<option value="!{$days[item]}" !{if $day eq $days[item]}selected!{/if}>!{$days[item]}</option>
!{/section}
</select>
</td>
<td><select name="year" id="year">
!{assign_adv var='years' value="range($start_year,$end_year)"}
<option value="">Year</option>
!{section name="item" loop=$years}
<option value="!{$years[item]}" !{if $year eq $years[item]}selected!{/if}>!{$years[item]}</option>
!{/section}
</select>
</td>
</tr>
<tr>
<td class="form">Time:</td>
<td>
!{assign_adv var='hours' value="range(1,23)"}
<select name="hour" id="hour">
<option value="">Hour</option>
<option value="0" !{if $hour eq '0'}selected!{/if}>0</option>
!{section name="item" loop=$hours}
<option value="!{$hours[item]}" !{if $hour eq "$hours[item]"}selected!{/if}>!{$hours[item]}</option>
!{/section}
</select>
</td>
<td colspan="2">
!{assign_adv var='minutes' value="range(1,59)"}
<select name="minute" id="minute">
<option value="">Minutes</option>
<option value="0" !{if $minute eq '0'}selected!{/if}>0</option>
!{section name="item" loop=$minutes}
<option value="!{$minutes[item]}" !{if $minute eq $minutes[item]}selected!{/if}>!{$minutes[item]}</option>
!{/section}
</select>
</td>
</tr>
<tr>
<td colspan="4" align="center"><input type="submit" name="submit" value="Send Mail at above listed date and time"></td>
</tr>
</table>
<input type="hidden" name="form_name" id="form_name" value="live_mail_date">
<input type="hidden" name="message_id" id="message_id" value="!{$smarty.get.message_id}">
</form>

!{validate form="live_mail_now" field="form_name" criteria="notEmpty"}
<form name="live_mail_now" id="live_mail_now" method="POST" action="send_live.php?message_id=!{$smarty.get.message_id}">
<table border="0" cellpadding="3" cellspacing="0" align="center">
<tr>
<td><input type="submit" name="submit" id="submit" value="Send Mail Now"></td>
</tr>
</table>
<input type="hidden" name="form_name" id="form_name" value="live_mail_now">
<input type="hidden" name="message_id" id="message_id" value="!{$smarty.get.message_id}">
</form>
</div>
