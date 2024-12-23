!{validate form="bulkmail_message" field="from_name" criteria="notEmpty" assign="error_from_name" message="From Name can not be empty" transform="trim"}

!{validate form="bulkmail_message" field="from_email" criteria="isEmail" assign="error_from_email" message="From Email has to be a valid email address" transform="trim"}

!{validate form="bulkmail_message" field="subject" criteria="notEmpty" assign="error_subject" message="Subject can not be empty"}

!{validate form="bulkmail_message" field="message_text" criteria="notEmpty" assign="error_message_text" message="The message can not be empty" transform="trim"}

<h2>Bulk Mail Message</h2>

!{include file="admin/_error.tpl"}


<table border="0" cellpadding="3" cellspacing="0" id="tabulated" width="760">
<thead>
<tr>
<td class="tab_off" width="160" onClick="document.location.href='bulkmail.php?type=bmc'"><img src="/images/icons/folder_16.gif" border="0" /> Bulkmail Categories</td>
<td class="tab_on" width="150" onClick="document.location.href='bulkmail.php?type=bmm'"><img src="/images/icons/doc_16.gif" border="0" /> Bulkmail Messages</td>
<td class="tab_off" width="150" onClick="document.location.href='bulkmail.php?type=mtg'"><img src="/images/icons/clients_16.gif" border="0" />  E-mail Test Groups</td> 
<td class="tab_off" width="130" onClick="document.location.href='bulkmail.php?type=mail'"><img src="/images/icons/mail_16.gif" border="0" /> Send a Bulk Mail</td> 
<td class="tab_off" width="130" onClick="document.location.href='bulkmail.php?type=batch'"><img src="/images/icons/folder_config_16.gif" border="0" /> Mail Batch</td> 
<td class="tab_off">&nbsp;</td>
</tr>
</thead>
<tbody>
<tr>
<td colspan="6" style="border-left:1px solid #000000;border-right:1px solid #000000;border-bottom:1px solid #000000;">

<form name="bulkmail_message" method="POST" action="create_bulkmail_message.php" enctype="multipart/form-data">
<table border="0" cellpadding="3" cellspacing="0" id="form" width="100%">
<tbody>

!{if $error_from_name}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_from_name}</td>
</tr>
!{/if}


<tr>
<td id="right">From Name:</td>
<td><input type="text" name="from_name" size="40" maxlength="100" value="!{$from_name|stripslashes}"></td>
</tr>

!{if $error_from_email}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_from_email}</td>
</tr>
!{/if}

<tr>
<td id="right">From Email:</td>
<td><input type="text" name="from_email" size="40" maxlength="255" value="!{$from_email}"></td>
</tr>
<tr>
<td id="right">To Name:</td>
<td><input type="text" name="to_name" size="40" maxlength="100" value="!{$to_name|stripslashes}"></td>
</tr>

!{if $error_subject}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_subject}</td>
</tr>
!{/if}

<tr>
<td id="right">Subject:</td>
<td><input type="text" name="subject" size="70" maxlength="120" value="!{$subject|stripslashes}"></td>
</tr>

!{if $error_message_text}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_message_text}</td>
</tr>
!{/if}

<tr>
<td id="right" valign="top">Message:</td>
<td>
<textarea id="message_text" name="message_text">!{$message_text|stripslashes}</textarea>
</td>
</tr>

!{if $attachment1 neq ''}
<tr>
	<td id="right">Attachment 1:</td>
	<td><a href="!{$smarty.const.URL}bulkmail/attachment_archive/!{$attachment1}" target="_blank">!{$attachment1_name}</a>
	&nbsp;-&nbsp;<a href="remove_attachment.php?type=attachment1&message_id=!{$message_id}" class="link">Remove<a/>
	</td>
</tr>
!{else}
<tr>
<td id="right">Attachment 1:</td>
<td><input type="file" name="attachment1" size="80"></td>
</tr>
!{/if}

!{if $attachment2 neq ''}
<tr>
<td id="right">Attachment 2:</td>
<td><a href="!{$smarty.const.URL}bulkmail/attachment_archive/!{$attachment2}" target="_blank">!{$attachment2_name}</a>
&nbsp;-&nbsp;<a href="remove_attachment.php?type=attachment2&message_id=!{$message_id}" class="link">Remove<a/>
</td>
</tr>
!{else}
<tr>
<td id="right">Attachment 2:</td>
<td><input type="file" name="attachment2" size="80"></td>
</tr>
!{/if}

!{if $attachment3 neq ''}
<tr>
<td id="right">Attachment 3:</td>
<td><a href="!{$smarty.const.URL}bulkmail/attachment_archive/!{$attachment3}" target="_blank">!{$attachment3_name}</a>
&nbsp;-&nbsp;<a href="remove_attachment.php?type=attachment3&message_id=!{$message_id}" class="link">Remove<a/>
</td>
</tr>
!{else}
<tr>
<td id="right">Attachment 3:</td>
<td><input type="file" name="attachment3" size="80"></td>
</tr>
!{/if}


</tbody>
<tfoot>
<tr>
<td colspan="2" align="right">
!{if $update}
<input type="submit" name="submit" value="Update Message">
!{else}
<input type="submit" name="submit" value="Add Message">
!{/if}
</td>
</tr>
</tfoot>


</table>
!{if $update}
<input type="hidden" name="message_id" value="!{$message_id}">
!{/if}
</form>

</td>
</tr>
</tbody>
</table>

<script>

 	CKEDITOR.replace('message_text', 
 	{ filebrowserBrowseUrl: 'ckeditor/filemanager/index.html',
 	extraAllowedContent: {
		'p' : {styles:'*',attributes:'*',classes:'*'}
	}}
 	);
    
</script>

