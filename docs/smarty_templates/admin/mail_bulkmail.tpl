!{validate form="test_message" field="template" criteria="notEmpty" assign="error_test_message" message="You have to select a template"}
!{validate form="test_message" field="message_id" criteria="notEmpty" assign="error_message_id" message="You have to select a message"}
!{validate form="test_message" field="test_email_group" criteria="notEmpty" transform="trim" assign="error_test_email_group" message="You have to select a group to send email to"}

<form name="test_message" method="POST" action="bulkmail.php?type=mail&do=test">
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
<tr>
<td colspan="2">Send Test Message</td>
</tr>
</thead>
<tbody>
!{if $error_test_message}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_test_message}</td>
</tr>
!{/if}

<tr>
<td id="right">Select a template:</td>
<td>
<select name="template">
<option value="" />Please select
!{section name="item" loop="$templates"}
<option value="!{$templates[item]}" !{if $template eq $templates[item]}selected!{/if}/>!{$templates[item]}
!{/section}
</select>
</td>
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
!{if $error_test_email_group}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_test_email_group}</td>
</tr>
!{/if}
<tr>
<td id="right" valign="top">Test E-mail group:</td>
<td>
<select name="test_email_group">
<option value="" />Please select a group
!{section name="x" loop="$testgroups"}
<option value="!{$testgroups[x]->id}" !{if $test_email_group eq $testgroups[x]->id}selected!{/if}/>!{$testgroups[x]->name}
!{/section}
</select>
</td>
</tr>
</tbody>
<tfoot>
<tr>
<td colspan="2" align="right"><input type="submit" name="submit" value="Send Test Message"></td>
</tr>
</tfoot>
</table>
<input type="hidden" name="form_name" value="test_message">
</form>