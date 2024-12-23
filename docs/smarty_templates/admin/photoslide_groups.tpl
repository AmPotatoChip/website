!{validate form="slideshow_group" field="group_name" criteria="notEmpty" assign="error_group_name" message="Group Name can not be empty"}

<h2>Photo Slideshow Groups</h2>
!{include file="admin/_error.tpl"}
<p><a href="javascript:;" class="link" onClick="hideunhide('form');" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/briefcase_add_16.gif" border="0" /> Add a new group</a></p>

<p>
!{if $smarty.get.group_id}
<form name="slideshow_group" method="POST" action="photoslide_groups.php?group_id=!{$smarty.get.group_id}">
!{else}
<form name="slideshow_group" method="POST" action="photoslide_groups.php">
!{/if}
<table id="form" style="display:none;">
<thead>
<tr>
<td colspan="2">Photo Slideshow Groups</td>
</tr>
</thead>
<tbody>
!{if $error_group_name}
<tr>
<td>&nbsp;</td>
<td id="red">!{$error_group_name}</td>
</tr>
!{/if}
<tr>
<td id="right">Slideshow Group Name:</td>
<td><input type="text" name="group_name" value="!{$group_name}" size="40" maxlength="80"></td>
</tr>

<tr>
<td id="right" valign="top">Description:</td>
<td><textarea name="description" rows="6" cols="37">!{$description|stripslashes}</textarea></td>
</tr>

</tbody>

<tfoot>
<tr>
<td colspan="2" align="right">
<input type="button" value="Clear Form" onClick="document.location.href='photoslide_groups.php';">
!{if $smarty.get.group_id}
<input type="submit" value="Update Slideshow Group">
!{else}
<input type="submit" value="Add New Slideshow Group">
!{/if}</td>
</tr>
</tfoot>
</table>
!{if $group_id}
<input type="hidden" name="group_id" value="!{$group_id}">
!{/if}
</form>
</p>

<table id="display" width="850" style="font-size: 12px">
<thead>
<tr valign="bottom">
<td width="30">ID</td>
<td width="125">Group Name</td>
<td>Description</td>
<td width="100" align="center"># of Images</td>
<td width="60" align="center">Default</td>
<td width="70" align="center">Edit Group</td>
<td width="120" align="center">Edit Slideshow</td>
<td width="65" align="center">Delete</td>
</tr>
</thead>
<tbody>
!{section name="item" loop="$sg"}
<tr bgcolor="!{cycle values="#FFFFFF,#DFE5FF"}">
	<td valign="top">!{$sg[item].group_id}</td>
	<td valign="top"><b>!{$sg[item].group_name|stripslashes}</b></td>
	<td valign="top">!{$sg[item].description|stripslashes}</td>
	<td valign="top" align="center">!{$sg[item].slide_count}</td>
	<td valign="top" align="center"><input type="radio" value="!{$sg[item].group_id}" name="default_group" !{if $sg[item].default eq 'yes'}checked!{/if} onclick="setSlideshowGroupDefault(this);"></td>
	<td valign="top" align="center"><a href="photoslide_groups.php?group_id=!{$sg[item].group_id}"><img src="/images/icons/briefcase_config_16.gif" border="0" /></a></td>
	<td valign="top" align="center"><a href="photoslide.php?group_id=!{$sg[item].group_id}"><img src="/images/icons/briefcase_edit_16.gif" border="0" /></a></td>
	<td valign="top" align="center"><a href="delete_photoslide_group.php?group_id=!{$sg[item].group_id}" onclick="return confirm('Are you sure you would like to delete (!{$sg[item].group_name|addslashes})');"><img src="/images/icons/briefcase_close_16.gif" border="0" /></a></td>
</tr>
!{/section}
</tbody>
</table>

!{if $smarty.get.group_id}
<script language="javascript">
onload=hideunhide('form');
</script>
!{/if}

!{if $show_form}
<script language="javascript">
onload=hideunhide('form');
</script>
!{/if}