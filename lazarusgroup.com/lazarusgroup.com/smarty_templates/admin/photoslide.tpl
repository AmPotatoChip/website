!{validate form="slideshow" criteria="notEmpty" field="media_id" assign="error_media_id" message="Media ID can not be empty"}

<h2>Photo Slideshow</h2>
!{include file="admin/_error.tpl"}
<form name="slideshow" method="POST" action="photoslide.php?group_id=!{$smarty.get.group_id}">

<table border="0" cellpadding="3" cellspacing="0" id="form">

<tbody>
!{if $error_media_id}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_media_id}</td>
</tr>
!{/if}

<tr>
<td id="right">Media ID:</td>
<td><input type="text" name="media_id" id="media_id" size="20"></td>
</tr>

</tbody>

<tfoot>
<tr>
	<td colspan="2" align="right"><input type="submit" name="submit" value="Add to Slideshow"></td>
</tr>
</tfoot>
</table>
<input type="hidden" name="group_id" value="!{$smarty.get.group_id}">
</form>

<script language="javascript">
onload=document.getElementById('media_id').focus();
</script>

!{include file="admin/slideshow_table.tpl"}