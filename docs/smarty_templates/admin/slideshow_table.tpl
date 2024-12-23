!{if $slideshow_content}

!{assign_adv var='slide_count' value=$slideshow_content|@count}
!{assign_adv var='select_array' value="range(1,$slide_count)"}

<table border="0" cellpadding="3" cellspacing="0" id="display">
<thead>
<tr>
<td>Media ID</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</thead>
!{section name="x" loop=$slideshow_content}
<tr>
<td valign="top">!{$slideshow_content[x]->media_id}</td>
<td valign="top"><img src="!{$smarty.const.URL}media_vault/images/!{$slideshow_content[x]->file_name}" width="100"></td>
<td valign="top"><a href="remove_slide.php?media_id=!{$slideshow_content[x]->media_id}&group_id=!{$smarty.get.group_id}">Remove</a></td>
<td valign="top">
<select name="order" onChange="changeSlideShowOrder('!{$slideshow_content[x]->media_id}',this,'!{$smarty.get.group_id}');">
!{section name="o" loop=$select_array}
<option value="!{$select_array[o]}" !{if $select_array[o] eq $slideshow_content[x]->order}selected!{/if}/>!{$select_array[o]}
!{/section}
</select>
</td>

</tr>
!{/section}
</table>


!{else}



!{/if}