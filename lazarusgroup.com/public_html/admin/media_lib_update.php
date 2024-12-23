<?
require('common/page_start.php');



function default_page(){
	global $LGCLASS,$smarty,$smarty_vars;
	checkUserLogin();
	
//	$smarty_vars[show_media_lib]=true;
	SmartyValidate::register_form('media_update',true);
	if(!$smarty_vars['nodataload']){assignMediaForUpdate($_GET[mid]);}
	$smarty->assign('catinfo',assignMediaCategoryCount());
//	if(!$_GET[egap]){$page_id = 100;}else{$page_id=$_GET[egap];}
	$LGCLASS->root_tpl='admin/media_lib_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	$content_categories = getCategories();
	$smarty->assign('cat',$content_categories);
	$LGCLASS->page_tpl='admin/media_lib_update.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	$LGCLASS->pageConstructor();
}


if(!empty($_POST)){
	if(SmartyValidate::is_valid($_POST,'media_update')){
		SmartyValidate::disconnect();
		$smarty_vars[error]=true;
		$smarty_vars[error_text]='Media has been updated';
		updateMedia($_POST,$_FILES);
		default_page();
	}else{
		$smarty_vars['nodataload']=true;
		$LGCLASS->postError($_POST);
		default_page();
	}
}else{
	default_page();
}


?>