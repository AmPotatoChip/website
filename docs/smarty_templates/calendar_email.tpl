!{validate form="calendar_email" field="from_name" criteria="notEmpty" assign="error_from_name" message="Your name is required"}
!{validate form="calendar_email" field="from_email" criteria="isEmail" assign="error_from_email" message="Your email is required"}
!{validate form="calendar_email" field="rcpt" criteria="notEmpty" assign="error_rcpt" message="At least one email address is needed to send this off"}

<table width="500" border="0" cellspacing="1" cellpadding="0" align="center" id="other">
<tr>
<td width="500" colspan="2">
<div class="other_title">&middot; EMAIL CALENDAR &middot;</div>
</td>
</tr>
<tr><td colspan="2">
<div id="breadcrumbs"><a href="index.php">Home</a> ></div>
<div class="dateline">!{$smarty.now|date_format:"%h %d, %Y"}</div></td></tr>


<tr><td class="article">

<h1>Please Complete the Following Form:</h1>
!{include file="_error.tpl"}

!{if $hideform neq true}
<form name="calendar_email" method="POST" action="">
<table width="370" border="0" cellspacing="1" cellpadding="0" align="center" id="form">
!{if $error_from_name}
<tr>
	<td colspan="2" align="center" class="error">!{$error_from_name}</td>
</tr>
!{/if}
<tr>
	<td width="130" align="right">Your Name:</td>
	<td><input type="text" name="from_name" value="!{$from_name|stripslashes}" size="40"></td>
</tr>
!{if $error_from_email}
<tr>
	<td colspan="2" align="center" class="error">!{$error_from_email}</td>
</tr>
!{/if}
<tr>
	<td width="130" align="right">Your Email:</td>
	<td><input type="text" name="from_email" value="!{$from_email|stripslashes}" size="40"></td>
</tr>
!{if $error_rcpt}
<tr>
	<td colspan="2" align="center" class="error">!{$error_rcpt}</td>
</tr>
!{/if}
<tr><td colspan="2" align="center">
<div style="font-size:10px;">* comma separate email addresses</div>
		<textarea name="rcpt" cols="41" rows="4">!{$rcpt|stripslashes}</textarea>
		
	</td>
</tr>
<tr>
	<td colspan="2" class="submit"><input type="submit" name="submit" value="Send"></td>
</tr>
</table>
<input type="hidden" name="calentryid" value="!{$smarty.get.calentryid}">
<input type="hidden" name="calid" value="!{$smarty.get.calid}">
</form>
!{else}
The article has been sent to the email(s) you provided.
!{/if}

</TD></tr>
</table>