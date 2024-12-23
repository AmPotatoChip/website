!{validate form="message_center" field="from_name" criteria="notEmpty" assign="error_from_name" message="Message From Name can not be empty"}

!{validate form="message_center" field="from_email" criteria="isEmail" assign="error_from_email" message="You have to use a valid email address"}



!{validate form="message_center" field="subject" criteria="notEmpty" assign="error_subject" message="Message Subject can not be empty"}



!{validate form="message_center" field="message_body" criteria="notEmpty" assign="error_message_body" message="Message Body can not be empty"}





<script type="text/javascript" src="/admin/fckeditor/fckeditor.js"></script>

<script type="text/javascript">

      window.onload = function()

      {

        var oFCKeditor = new FCKeditor('message_body') ;
        oFCKeditor.BasePath = "/admin/fckeditor/";
        oFCKeditor.Width = '740';
        oFCKeditor.Height = '500';
        oFCKeditor.ReplaceTextarea() ;
      }



</script>







<div style="padding:10 0 0 0;">

!{include file="admin/_error.tpl"}



<form name="message_center" id="message_create" method="POST" action="message_center.php?message_id=!{$smarty.get.message_id}"><table border="0" cellpadding="3" cellspacing="0" align="center" class="form">

<thead>

<tr>

<td>&nbsp;</td>

</tr>

</thead>

<tr>

<td>

<table border="0" cellpadding="3" cellspacing="0">

<tbody>



!{if $error_subject}

<tr>

<td>&nbsp;</td>

<td style="color:#CC0000;font-weight:bold;">!{$error_subject}</td>

</tr>

!{/if}

<tr>

<td class="form">Message Subject:</td>

<td><input type="text" name="subject" id="subject" value="!{$subject|stripslashes}" size="50" maxlength="120"></td>

</tr>









!{if $error_from_name}

<tr>

<td>&nbsp;</td>

<td style="color:#CC0000;font-weight:bold;">!{$error_from_name}</td>

</tr>

!{/if}

<tr>

<td class="form">Message From Name:</td>

<td><input type="text" name="from_name" id="from_name" value="!{$from_name}" size="30" maxlength="100"></td>

</tr>

!{if $error_from_email}

<tr>

<td>&nbsp;</td>

<td style="color:#CC0000;font-weight:bold;">!{$error_from_email}</td>

</tr>

!{/if}

<tr>

<td class="form">Message From Email:</td>

<td><input type="text" name="from_email" id="from_email" value="!{$from_email}" size="30" maxlength="255"></td>

</tr>



<tr>

<td class="form">To Name:</td>

<td><input type="text" name="to_name" id="to_name" value="!{$to_name}" size="30" maxlength="100"></td>

</tr>



</table>

</td>

</tr>



<tr>

<td>

<table border="0" cellpadding="3" cellspacing="0" align="center">

!{if $error_message_body}

<tr>

<td style="color:#CC0000;font-weight:bold;">!{$error_message_body}</td>

</tr>

!{/if}

<tr>

<td colspan="2">

<div align="left" style="font-weight:bold;">Message Body:</div>

<textarea name="message_body" id="message_body" rows="5" cols="45">!{$message_body|stripslashes}</textarea>



</td>

</tr>





<tr>

<td colspan="2" align="center">

!{if $message_update}

<input type="submit" name="submit" id="submit" value="Update Message">

<input type="hidden" name="message_update" id="message_update" value="true">

<input type="hidden" name="message_id" id="message_id" value="!{$smarty.get.message_id}">

!{else}

<input type="submit" name="submit" id="submit" value="Create Message">

!{/if}

</td>

</tr>



</tbody>

</table>

</td>

</tr>

</table>

<input type="hidden" name="form_name" value="message_center">

</form>

</div>