<h2>Bulk Message Preview</h2>

<a href="bulkmail.php?type=bmm" class="link"><img src="/images/icons/back_16.gif" border="0" /> Return to Bulkmail Messages</a>
<p>
<table border="0" cellpadding="3" cellspacing="0" width="100%">
<tr>
<td style="background-color:#272E4F;color:#FFFFFF;" align="center">
!{if $templates}
<select name="template" onchange="templatePreview(this,'!{$smarty.get.message_id}');">
<option value='' />Please select a template
!{section name="item" loop=$templates}
<option value="!{$templates[item]}" !{if $smarty.get.template eq $templates[item]}selected!{/if}/>!{$templates[item]}
!{/section}
</select>
!{/if}
</td>
</tr>
</table>
</p>
!{if $message_preview_data}
<center>

<iframe src="preview_message_holder.php" width="760" height="500">

</iframe>

</center>
!{/if}