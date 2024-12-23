<?
require('common/page_start.php');



function default_page(){
	global $LGCLASS,$smarty,$smarty_vars;
	checkUserLogin();
	
//	$smarty_vars[show_media_lib]=true;
	SmartyValidate::register_form('media_upload',true);
	if($_GET[catid]){ assignCategoryInfo($_GET[catid]); }
	$smarty->assign('catinfo',assignMediaCategoryCount());
//	if(!$_GET[egap]){$page_id = 100;}else{$page_id=$_GET[egap];}
	$LGCLASS->root_tpl='admin/media_lib_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	$content_categories = getCategories();
	$smarty->assign('cat',$content_categories);
	$LGCLASS->page_tpl='admin/media_lib.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	$LGCLASS->pageConstructor();
}


if(!empty($_POST)){
	if(SmartyValidate::is_valid($_POST,'media_upload')){
		
		if($_FILES[data][name]=='' && $_FILES[data][tmp_name]==''){
				$smarty_vars[error_data]='A File is required';
				$LGCLASS->postError($_POST);
				default_page();	
		}else{
			if(mediaController($_POST,$_FILES[data])){		
				unset($_POST,$_FILES);
				$smarty_vars[error_text]='Your Media has been uploaded and stored in the database.';				
				$smarty_vars[error]=true;
				default_page();	
			}else{
				$LGCLASS->postError($_POST);
				default_page();	
			}
		}
	}else{
		$LGCLASS->postError($_POST);
		default_page();	
	}
		
}else{
	default_page();	
}


?>