!{debug}

!{if $MessageResult}
	<h3>!{$MessageResult}</h3>
!{/if}


!{* =============================================================================================================== *}
!{* ======================== THIS SECTION DISPLAYS THE SUBCATEGORY SELECTION          ========================================= *}
!{* =============================================================================================================== *}

!{if $PageType eq "subcategory_select"}
	<div id="test_wrap">
 	<h1 class="headline_products">Select SubCategory to Edit</h1>
 	<br clear="all">
 	
 	<table style="font-size: .7em;" >
 	<thead>
<tr>
<td >Category
</td>
 
<td>Sub Category
</td>
<td> &nbsp;
</td>
 	</thead>
 	
 	<tbody>
	!{section name="x" loop="$CategoryPairs"}
	

<tr>
<td>!{$CategoryPairs[x].category}
</td>
 
<td>!{$CategoryPairs[x].sub_category}
</td>
<td><a href="/admin/manage_parts.php?sub_category_id=!{$CategoryPairs[x].id}">USE</A>
</td>
</tr>
	
	
	
	!{/section}
	</tbody>
	</table>
	</div>
!{/if}

!{* =============================================================================================================== *}
!{* ======================== THIS SECTION DISPLAYS THE ITEM DETAIL EDIT ========================================= *}
!{* =============================================================================================================== *}

!{if $PageType eq "item_detail"}
	<div id="test_wrap">
	
	!{$SubCategoryList[0].category} > !{$SubCategoryList[0].sub_category}
	
	
 	<h1 class="headline_products">Add images to groups</h1>
 	<br clear="all">
 	
 	<table style="font-size: .7em;" >
 	<thead>
<tr>
<td > ID
</td>
 <td >Name
</td>
<td>Image
</td>
<td> Page #
</td>
<td> CMS Article
</td>


</thead>
 	
 	<tbody>
<form name="IMAGE_REPLACE" method="POST" action="/admin/manage_parts.php"   enctype="multipart/form-data" >

!{section name="x" loop="$SubCategoryList"}
	
 
<input type="hidden" name="record[!{$smarty.section.x.index}]" value="!{$SubCategoryList[x].id}">
<input type="hidden" name="category" value="!{$SubCategoryList[0].category}">
<input type="hidden" name="sub_category" value="!{$SubCategoryList[0].sub_category}">

<tr bgcolor="!{cycle values="#FFFFFF,#DFE5FF"}">

<td>!{$SubCategoryList[x].id}
</td>
<td>!{$SubCategoryList[x].name}
</td>
 
<td><input type="file" name="image[!{$smarty.section.x.index}]" id="file1" size="0" onChange="validateField(this);" >!{$SubCategoryList[x].image}
</td>
<td><input type="text" name="page[!{$smarty.section.x.index}]" value="!{$SubCategoryList[x].pageno}" size="3">
</td>
<td>[ <a href="/admin/manage_parts.php?item_id=!{$SubCategoryList[x].id}">Edit Item Page</a> ]
</td>
</tr>
	
	
	
	!{/section}
	</tbody>
	</table>
	<input type="submit" value="go!">
	</FORM>
	
	</div>

!{/if}

!{* =============================================================================================================== *}
!{* ======================== THIS SECTION DISPLAYS THE ITEM DETAIL EDIT TEXT ========================================= *}
!{* =============================================================================================================== *}

!{if $PageType eq "item_detail_edit"}
	<div id="test_wrap">
	
 	<h1 class="headline_products">!{$ItemDetailText.name}</h1>
 	<br clear="all">
 	<P>image: !{$ItemDetailText.image}<br>
 	
 	</P>
	<form name="manage_parts" method="POST" action="">
		<input type="hidden" name="detail_id" value="!{$ItemDetailText.id}">
		<input type="hidden" name="testchange" value="!{$ItemDetailText.id}">
		<textarea id="full_content" name="full_content">!{$ItemDetailText.article|stripslashes}</textarea>
	<input type="submit" value="Save">
	</form>

	</div>
<script type="text/javascript">
      
        var oFCKeditor = new FCKeditor( 'full_content' ) ;
        oFCKeditor.BasePath = "fckeditor/" ;
        oFCKeditor.EditorAreaCSS = "/stylesheet.css";
        oFCKeditor.Width = '700';
        oFCKeditor.Height = '500';
        oFCKeditor.ReplaceTextarea() ;
      
</script>
!{/if}

