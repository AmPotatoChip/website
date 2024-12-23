<script language="javascript">

function messageSwitch(selectID){
	selectOBJ = document.getElementById(selectID).value;
	if(selectOBJ == ''){
		window.location.href='message_center.php?message_id=';	
	}else{
		window.location.href='message_center.php?message_id='+selectOBJ;
	}
}


function viewMessage(selectID){
	selectOBJ = document.getElementById(selectID).value;
	if (selectOBJ == ''){
		alert('You have to select a message to be able to view it');
	}else{
		url = 'view_message.php'+'?message_id='+selectOBJ;
		window.open(url,"view_message");		
	}
}


function checkEditTestGroup(select_id){
	selectOBJ = document.getElementById(select_id).value;
	if(selectOBJ=='xx'){
		window.location.href='test_group.php';
	}
	if(selectOBJ==''){
	}else{
		window.location.href='test_group.php'+'?group_id='+selectOBJ;
	}
}



function SendLiveMail(message_id){
	selectOBJ = document.getElementById(message_id).value;
	if(selectOBJ!=''){
		window.location.href='send_live.php?message_id='+selectOBJ;
	}else{
		alert('Please select a message to be mailed')
	}
}

</script>



!{validate form="send_test" field="message_id" criteria="notEmpty" assign="error_message_id" message="You have to select a message"}

!{validate form="send_test" field="test_group" criteria="notEmpty" assign="error_test_group" message="You have to select a test group"}
!{validate form="send_test" field="template" criteria="notEmpty" assign="error_template" message="You have to select a mail template"}

<center>
<div style="padding:10 0 0 0;">

!{include file="mailsystem/_error.tpl"}

<form name="send_test" id="send_test" method="POST" action="index.php">

<table border="0" cellpadding="3" cellspacing="0" align="center">

!{if $error_message_id}

	<tr>

	<td colspan="3" style="color:#CC0000;font-weight:bold">!{$error_message_id}</td>

	</tr>

!{/if}

<tr>

<td><select name="message_id" id="message_id">

<option value="">Create a new message</option>

!{if $client_messages}

	!{section name="item" loop=$client_messages}

		<option value="!{$client_messages[item]->id}" !{if $message_id eq $client_messages[item]->id}selected!{/if}>!{$client_messages[item]->subject}</option>

	!{/section}

!{/if}

</select></td>

<td><input type="button" name="edit" id="edit" value="Edit/New" onclick="messageSwitch('message_id');"></td>

<td><input type="button" name="view" id="view" value="View" onclick="viewMessage('message_id');"></td>

</tr>
!{if $error_template}
	<tr>
	<td colspan="3" style="color:#CC0000;font-weight:bold">!{$error_template}</td>
	</tr>
!{/if}


<tr>
<td><b>Mail Template:</b>

<select name="template" id="template">
<option value=''>Please select a template</option>
!{section name="item" loop="$tf"}
	<option value="!{$tf[item]}" !{if $template eq $tf[item]}selected!{/if}>!{$tf[item]}</option>
!{/section}
</select>
</td>
</tr>

!{if $error_test_group}

	<tr>

	<td colspan="3" style="color:#CC0000;font-weight:bold">!{$error_test_group}</td>

	</tr>

!{/if}

<tr>

<td colspan="3"><strong>Send test message to:</strong>

<select name="test_group" id="test_group">

<option value=''>Select Group</option>

!{if $test_groups}

!{section name=item loop=$test_groups}

<option value="!{$test_groups[item]->id}" !{if $test_group eq $test_groups[item]->id}selected!{/if}>!{$test_groups[item]->name}</option>

!{/section}

!{/if}

</select>

<input type="submit" name="submit" id="submit" value="Send">

</td>

</tr>



<tr>

<td colspan="3" style="padding:30 0 0 0;">

<strong>Edit test group:</strong>

<select name="edit_test_group" id="edit_test_group" onchange="checkEditTestGroup('edit_test_group');">

<option value=''>Select Group</option>

<option value="xx">New Test Group</option>

!{if $test_groups}

!{section name=item loop=$test_groups}

<option value="!{$test_groups[item]->id}">!{$test_groups[item]->name}</option>

!{/section}

!{/if}

</select>

</td>

</tr>

</table>
</form>

<a href="mail_report.php">View mail reports</a>

</div>
</center>