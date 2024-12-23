!{validate form="media_upload" field="name" criteria="notEmpty" assign="error_name" message="Name is required"}
!{include file="admin/_error.tpl"}
!{include file="admin/media_categories.tpl"}

<form name="media_upload" method="POST" action="" enctype="multipart/form-data">
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
	<tr>
		<td colspan="2">Media Upload Form</td>
	</tr>
</thead>
<tbody>
<tr>
<td colspan="2" id="info_text">Allowed File Types: jpg, gif, tif, mov, mp3, ogg, doc, pdf, wmv, mpg, mpeg, m4a</td>
</tr>
!{if $error_name}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_name}</td>
</tr>
!{/if}
<tr>
	<td id="right" valign="top"><span id="red">*</span> Name:</td>
	<td><input type="text" name="name" value="!{$name|stripslashes}" size="46"><br/>
	<span style="font-size:10px;">Staff use only</span>
	</td>
</tr>
<tr>
	<td id="right" valign="top">Caption:</td>
	<td><input type="text" name="caption" value="!{$caption|stripslashes}" size="46"><br/>
	<span style="font-size:10px;">Caption will display with picture on site.</span>
	</td>
</tr>
<tr>
	<td id="right" valign="top">Description:</td>
	<td><textarea name="description" cols="43" rows="3">!{$description|stripslashes}</textarea></td>
</tr>
!{if $error_data}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_data}</td>
</tr>
!{/if}
<tr>
	<td id="right"><span id="red">*</span> File:</td>
	<td><input type="file" name="data" size="44"></td>
</tr>
</tbody>
<tfoot>
	<tr>
		<td align="right" colspan="2"><input type="submit" name="submit" value="Upload Media"></td>
	</tr>	
</tfoot>
</table>
</form>


