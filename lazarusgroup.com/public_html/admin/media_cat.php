<?
require('common/page_start.php');

function default_page(){
	global $LGCLASS,$smarty,$smarty_vars;
	checkUserLogin();
	
	if($catcontent = loadMediaCategoryContent($_GET[cat],$_GET[q])){
		$smarty->assign('catcontent',$catcontent);	
	}
	//	if($_GET[catid]){ assignCategoryInfo($_GET[catid]); }
	$smarty->assign('catinfo',assignMediaCategoryCount());
//	if(!$_GET[egap]){$page_id = 100;}else{$page_id=$_GET[egap];}
	$LGCLASS->root_tpl='admin/media_lib_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	
	$LGCLASS->page_tpl='admin/media_cat.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	$LGCLASS->pageConstructor();
}


if(!empty($_POST)){
	$data->search_by=$_POST[search_by];
	$data->query=$_POST[query];
	$catcontent = searchMediaLibrary($data);
	$smarty->assign($_POST);
	$smarty->assign('catcontent',$catcontent);
	default_page();
}else{
	default_page();
}

?>