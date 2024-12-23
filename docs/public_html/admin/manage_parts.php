<?
require('common/page_start.php');

require_once('common/part_class.php');

checkUserLogin();

$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';


$LGCLASS->page_tpl='admin/manage_parts.tpl'; // This current's page template file.


if(!empty($_POST)){
//	print"<pre>";
//	print_r($_POST);
//	print_r($_FILES);

	if($_POST['testchange']){
		$MessageResult=UpdateItemDetailText($_POST);
		$smarty->assign('MessageResult',"$MessageResult");

		$CategoryPairs = GetCategoryPairs();
		$smarty->assign('CategoryPairs',$CategoryPairs);
		$smarty->assign('PageType',"subcategory_select");	
		
	}else{
		
		$MessageResult=UpdateItemDetail($_POST,$_FILES);
		$smarty->assign('MessageResult',"$MessageResult");
			
		$CategoryPairs = GetCategoryPairs();
		$smarty->assign('CategoryPairs',$CategoryPairs);
		$smarty->assign('PageType',"subcategory_select");	
	}
	

}//post



if(!empty($_GET)){
	
	if($_GET[sub_category_id]){
		//load all item detail from this category
		$SubCategoryList = FetchAllSubcategory($_GET[sub_category_id]);
		$smarty->assign('SubCategoryList',$SubCategoryList);
		$smarty->assign('PageType',"item_detail");	
	}//sub_category_id
	if($_GET['item_id']){
		//get content
		$ItemDetailText = FetchDetailText($_GET['item_id']);
		$smarty->assign('ItemDetailText',$ItemDetailText);
		$LGCLASS->javascript_file_array[]='fckeditor/fckeditor.js';
		$smarty->assign('PageType',"item_detail_edit");	
	}

}


else{
	//need to fix this up, first load all category-subcategory pairs into table to select which section we are editing
	$CategoryPairs = GetCategoryPairs();
	$smarty->assign('CategoryPairs',$CategoryPairs);
	$smarty->assign('PageType',"subcategory_select");
	

}
	$LGCLASS->pageConstructor();
?>