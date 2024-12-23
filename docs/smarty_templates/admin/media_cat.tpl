<h2>!{$smarty.get.cat|@ucwords}</h2>
!{include file="admin/media_categories.tpl"}
<p><a href="media_library.php" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/image_add_16.gif" border="0" /> Add New Media</a></p>


!{assign_adv var='search_array' value="array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','1','2','3','4','5','6','7','8','9','0','all')"}

<p>
<span style="font-size:12px;font-weight:bold;">Search By Name:</span><br/>
!{section name="q" loop=$search_array}
<a href="media_cat.php?cat=!{$smarty.get.cat}&q=!{$search_array[q]|@strtoupper}" !{if $smarty.get.q eq $search_array[q]|@strtoupper}class="link_visit"!{else}class="link"!{/if}>!{$search_array[q]|@strtoupper}</a>&nbsp;
!{/section}
</p>

<form name="media_search_by_id" method="POST" action="media_cat.php?cat=!{$smarty.get.cat}">
<p style="font-size:12px;">
<b>Search By :</b>
<select name="search_by">
<option value="media_id" !{if $search_by eq 'media_id'}selected!{/if}/>Media ID
<option value="keyword" !{if $search_by eq 'keyword'}selected!{/if}/>Keyword
</select>
<input type="text" name="query" value="!{$query}" size="80">
<input type="submit" name="submit" value="Search">
</p>
</form>


<table border="0" cellpadding="3" cellspacing="0" id="meddisplay" width="100%">
	<thead>
		<tr>
			<td colspan="9">Media Library</td>
		</tr>
		<tr>
			<td width="100"  font-size="2">Media ID</td>
		!{if $smarty.get.cat eq 'images'}<td width="50">&nbsp;</td>!{/if}
			<td>Name</td>
			<td>Caption</td>
			<td width="130">File Name</td>
			<td width="130">Added</td>
			
			<td width="90" align="center">More Info</td>
			<td align="center" width="50">Edit</td>
			<td width="60" style="padding:0 20 0 0;">Delete</td>
		</tr>
	</thead>
	<tbody id="media_content" style="overflow-y:auto;overflow-x:hidden;height:575px;">
		!{section name="item" loop=$catcontent}
		<tr bgcolor="!{cycle values="#FFFFFF,#DFE5FF"}">
		<td>!{$catcontent[item]->id}</td>
			!{if $smarty.get.cat eq 'images'}<td width="50"><img src="image_thumbs.php?file=!{$catcontent[item]->file_name}" width="50"></td>!{/if}
			<td>!{$catcontent[item]->name}</td>
			<td>!{$catcontent[item]->caption}</td>
			<td width="130">!{$catcontent[item]->file_name}</td>
			<td width="130">!{$catcontent[item]->created}</td>
			<td width="100" align="center"><a href="javascript:;" class="link" onClick="hideunhide('info_!{$catcontent[item]->id}');"><img src="/images/icons/image_info_16.gif" border="0" /></a></td>
			<td width="50" align="center"><a href="media_lib_update.php?mid=!{$catcontent[item]->id}"><img src="/images/icons/image_edit_16.gif" border="0" /></a></td>
			<td align="center" style="padding:0 20 0 0;"><a href="delete_media.php?id=!{$catcontent[item]->id}" class="link" onClick="return confirm('Are you sure you would like to delete this media vault entry.');"><img src="/images/icons/image_close_16.gif" border="0" /></a></td>
		</tr>
		<tr class="more_info" id="info_!{$catcontent[item]->id}" style="display:none;">
			<td colspan="8">
			<b>Description:</b> !{$catcontent[item]->description}<br/>
			<b>Editor Code:</b> <input type="text" value="{MEDIA !{$catcontent[item]->id}}"><br/>
			<b>URL:</b> <a href="!{$smarty.const.URL}media_vault/!{$smarty.get.cat}/!{$catcontent[item]->file_name}" class="red" target="_blank">!{$smarty.const.URL}media_vault/!{$smarty.get.cat}/!{$catcontent[item]->file_name}</a><br/>
			!{if $catcontent[item]->dim}
			<b>Image Dimension:</b> !{$catcontent[item]->dim}
			!{/if}
			</td>
		</tr>
		!{/section}
	</tbody>
</table>