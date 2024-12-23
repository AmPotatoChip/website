!{validate form="category" field="name" criteria="notEmpty" assign="error_name" message="Name can not be empty."}
!{validate form="category" field="set_headline" criteria="notEmpty" assign="error_set_headline" message="Headline can not be empty."}
!{validate form="category" field="set_subhead" criteria="notEmpty" assign="error_set_subhead" message="Subhead can not be empty."}
!{validate form="category" field="set_exerpt" criteria="notEmpty" assign="error_set_exerpt" message="Exerpt can not be empty."}
!{validate form="category" field="set_byline" criteria="notEmpty" assign="error_set_byline" message="Byline can not be empty."}
!{validate form="category" field="set_dateline" criteria="notEmpty" assign="error_set_dateline" message="Dateline can not be empty."}
!{validate form="category" field="no_articles" criteria="notEmpty" assign="error_no_articles" message="Number of articles to display can not be empty."}

<form name="category" method="post" action="">
<table border="0" cellpadding="3" cellspacing="0" id="form" width="100%">
<thead>
<tr>
<td colspan="2">Content Category Form</td>
</tr>
</thead>

<tbody>
!{if $error_name}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_name}</td>
</tr>
!{/if}
<tr>
	<td id="right">Name:</td>
	<td><input type="text" name="name" value="!{$name}" size="40" maxlength="120"></td>
</tr>
<tr>
	<td id="right" valign="top">Description:</td>
	<td><textarea name="description" cols="37" rows="3">!{$description|stripslashes}</textarea></td>
</tr>
!{if $error_set_headline}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_set_headline}</td>
</tr>
!{/if}
<tr>
	<td id="right">Headline:</td>
	<td><input type="radio" name="set_headline" value="true" !{if $set_headline eq 'true'}checked!{/if}>Yes<input type="radio" name="set_headline" value="false"  !{if $set_headline eq 'false'}checked!{/if}>No</td>
</tr>
!{if $error_set_subhead}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_set_subhead}</td>
</tr>
!{/if}
<tr>
	<td id="right">Subhead:</td>
	<td><input type="radio" name="set_subhead" value="true" !{if $set_subhead eq 'true'}checked!{/if}>Yes<input type="radio" name="set_subhead" value="false" !{if $set_subhead eq 'false'}checked!{/if}>No</td>
</tr>
!{if $error_set_exerpt}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_set_exerpt}</td>
</tr>
!{/if}
<tr>
	<td id="right">Exerpt:</td>
	<td><input type="radio" name="set_exerpt" value="true" !{if $set_exerpt eq 'true'}checked!{/if}>Yes<input type="radio" name="set_exerpt" value="false" !{if $set_exerpt eq 'false'}checked!{/if}>No</td>
</tr>
!{if $error_set_byline}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_set_byline}</td>
</tr>
!{/if}
<tr>
	<td id="right">Byline:</td>
	<td><input type="radio" name="set_byline" value="true" !{if $set_byline eq 'true'}checked!{/if}>Yes<input type="radio" name="set_byline" value="false" !{if $set_byline eq 'false'}checked!{/if}>No</td>
</tr>
!{if $error_set_dateline}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_set_dateline}</td>
</tr>
!{/if}
<tr>
	<td id="right">Dateline:</td>
	<td><input type="radio" name="set_dateline" value="true" !{if $set_dateline eq 'true'}checked!{/if}>Yes<input type="radio" name="set_dateline" value="false" !{if $set_dateline eq 'false'}checked!{/if}>No</td>
</tr>
!{if $error_no_articles}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_no_articles}</td>
</tr>
!{/if}
<tr>
	<td id="right">Number of articles to display:</td>
	<td><input type="text" name="no_articles" size="3" maxlength="2" value="!{$no_articles}"></td>
</tr>
!{if $error_navlevel}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_navlevel}</td>
</tr>
!{/if}
<tr>
	<td id="right">Nav Level:</td>
	<td><input type="text" name="navlevel" size="12" maxlength="11" value="!{$navlevel}"></td>
</tr>
!{if $error_position}
<tr>
	<td>&nbsp;</td>
	<td id="red">!{$error_position}</td>
</tr>
!{/if}
<tr>
	<td id="right">Position:</td>
	<td><input type="text" name="position" size="5" maxlength="5" value="!{$position}"></td>
</tr>
!{if !$header_media_id}
<tr>
<td id="right">Header Media ID:</td>
<td><input type="text" name="header_media_id" size="10" value="!{$header_media_id}"></td>
</tr>
!{else}
<tr>
<td colspan="2" align="center">
<a href="content.php?type=removeheader&catid=!{$smarty.get.catid}" class="link">Remove Header</a><br/>
<img src="!{present_image_display_by_media_id value=$header_media_id}">
<input type="hidden" name="header_media_id" value="!{$header_media_id}">
</td>
</tr>

!{/if}

!{if !$square_media_id}
<tr>
<td id="right">Square Image Media ID:</td>
<td><input type="text" name="square_media_id" size="10" value="!{$square_media_id}"></td>
</tr>
!{else}
<tr>
<td colspan="2" align="center">
<a href="content.php?type=removesquare&catid=!{$smarty.get.catid}" class="link">Remove Square Image</a><br/>
<img src="!{present_image_display_by_media_id value=$square_media_id}">
<input type="hidden" name="square_media_id" value="!{$square_media_id}">
</td>
</tr>
!{/if}


</tbody>

<tfoot>
<tr>
<td colspan="2" align="center">
<input type="button" value="Reset Form" onClick="document.location.href='content.php';">
!{if $smarty.get.catid}
<input type="submit" name="submit" value="Update Category">
<input type="hidden" name="update" value="!{$smarty.get.catid}">
!{else}
<input type="submit" name="submit" value="Add New Content Category">
!{/if}	
	</td>
</tr>
</tfoot>
</table>
</form>