!{validate form="note_form" field="note" criteria="notEmpty" assign="error_note" message="Note can not be empty"}

<h2>Contact Note</h2>

!{include file="admin/_error.tpl"}

<form name="note_form" method="POST" action="add_note.php?contact_id=!{$smarty.get.contact_id}">
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
</thead>
<tbody>
!{if $error_note}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_note}</td>
</tr>
!{/if}
	<tr>
		<td valign="top">Note:</td>
		<td><textarea name="note" cols="100" rows="10">!{$note|stripslashes}</textarea></td>
	</tr>
</tbody>
<tfoot>
<tr>
	<td colspan="2" align="right"><input type="submit" name="submit" value="Add Note"></td>
</tr>
</tfoot>
</table>
<input type="hidden" name="contact_id" value="!{$smarty.get.contact_id}">
</form>