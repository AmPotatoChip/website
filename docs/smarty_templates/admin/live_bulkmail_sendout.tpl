!{validate form="live_message" field="contact_group_id" criteria="notEmpty" assign="error_live_message" message="Contact Group has to be selected"}
!{validate form="live_message" field="template" criteria="notEmpty" assign="error_template" message="Please select a template"}
!{validate form="live_message" field="message_id" criteria="notEmpty" assign="error_message_id" message="Please select a message"}

<form name="live_message" method="POST" action="bulkmail.php?type=mail&do=live">
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
<tr>
<td colspan="2">Live Bulk Mail Setup</td>
</tr>
</thead>

<tbody>
!{if $error_live_message}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_live_message}</td>
</tr>
!{/if}
<tr>
<td id="right">Contact Group:</td>
<td><select name="contact_group_id">
<option value="" />Please select
!{section name="b" loop="$bulkmail_categories"}
<option value="!{$bulkmail_categories[b]->id}" !{if $contact_group_id eq $bulkmail_categories[b]->id}selected!{/if}/>!{$bulkmail_categories[b]->category}
!{/section}
</select></td>
</tr>
!{if $error_template}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_template}</td>
</tr>
!{/if}
<tr>
<td id="right">Select a template:</td>
<td><select name="template">
<option value="" />Please select
!{section name="item" loop="$templates"}
<option value="!{$templates[item]}" !{if $template eq $templates[item]}selected!{/if}/>!{$templates[item]}
!{/section}
</select></td>
</tr>
!{if $error_message_id}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_message_id}</td>
</tr>
!{/if}
<tr>
<td id="right">Select a message:</td>
<td>
<select name="message_id">
<option value="" />Please select
!{section name="x" loop="$bulkmessages"}
<option value="!{$bulkmessages[x]->id}" !{if $message_id eq $bulkmessages[x]->id}selected!{/if}/>!{$bulkmessages[x]->subject}
!{/section}
</select>
</td>
</tr>
<tr>
<td id="right">Delivery Date:</td>
<td>
<link rel="stylesheet" type="text/css" media="all" href="/admin/common/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
		<script type="text/javascript" src="/admin/common/calendar/calendar.js"></script>
		<script type="text/javascript" src="/admin/common/calendar/lang/calendar-en.js"></script>
		<script type="text/javascript" src="/admin/common/calendar/calendar-setup.js"></script>
		
		<input type="text" name="delivery_date" id="delivery_date" size="15" value="!{$delivery_date|stripslashes}">
		<button type="reset" id="trigger">...</button>
		
		<script type="text/javascript">
		Calendar.setup({
			inputField     :    "delivery_date",      // id of the input field
			ifFormat       :    "%Y-%m-%d",       // format of the input field
			showsTime      :    false,            // will display a time selector
			button         :    "trigger",   // trigger for the calendar (button ID)
			singleClick    :    true,           // double-click mode
			step           :    1                // show all years in drop-down boxes (instead of every other year as default)
		});
		</script>
</td>
</tr>
<tr>
<td id="right">Delivery Time:</td>
<td>
<select name="hour">
<option value="" />Hour
<option value="1" !{if $hour eq '1'}selected!{/if}/>1
<option value="2" !{if $hour eq '2'}selected!{/if} />2
<option value="3" !{if $hour eq '3'}selected!{/if} />3
<option value="4" !{if $hour eq '4'}selected!{/if} />4
<option value="5" !{if $hour eq '5'}selected!{/if} />5
<option value="6" !{if $hour eq '6'}selected!{/if} />6
<option value="7" !{if $hour eq '7'}selected!{/if} />7
<option value="8" !{if $hour eq '8'}selected!{/if} />8
<option value="9" !{if $hour eq '9'}selected!{/if} />9
<option value="10" !{if $hour eq '10'}selected!{/if} />10
<option value="11" !{if $hour eq '11'}selected!{/if} />11
<option value="12" !{if $hour eq '12'}selected!{/if} />12
</select>

<select name="minute">
<option value="" />Minute
<option value="00" !{if $minute eq '00'}selected!{/if}/>00
<option value="15" !{if $minute eq '15'}selected!{/if} />15
<option value="30" !{if $minute eq '30'}selected!{/if} />30
<option value="45" !{if $minute eq '45'}selected!{/if} />45
</select>

<select name="dn">
<option value="pm" !{if $dn eq 'pm'}selected!{/if} />PM
<option value="am" !{if $dn eq 'am'}selected!{/if} />AM
</select>
</td>
</tr>

</tbody>
<tfoot>
<tr>
<td colspan="2" align="right"><input type="submit" value="Send Message"></td>
</tr>
</tfoot>
</table>
<input type="hidden" name="form_name" value="live_message">
</form>