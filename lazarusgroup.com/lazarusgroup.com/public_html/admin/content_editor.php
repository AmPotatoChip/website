<?
require('common/page_start.php');



function default_page(){
	global $LGCLASS,$smarty,$smarty_vars;
	checkUserLogin();
	
	$smarty_vars[show_media_lib]=true;
	SmartyValidate::register_form('content_editor',true);
	
	if($_GET[catid]){ 
		$smarty_vars[category_name]=assignCategoryName($_GET[catid]);
		assignCategoryContent($_GET[catid]);
		assignLiveCategoryContent($_GET[catid]);
		assignEditorSetup($_GET[catid]);
	}
	
	if(!$smarty_vars[nodataload]){if($_GET[article_id]){ assignContent($_GET[article_id]); }}
	
	if($_GET[article_id]){ 
		assignContentNameDroppers($_GET[article_id]); 
		assignContentKeyChainDroppers($_GET[article_id]);
		assignContentMediaDropper($_GET[article_id]);
		$categories = getCategories();
		$smarty->assign('categories',$categories);
	}
	
	
//	if(!$_GET[egap]){$page_id = 100;}else{$page_id=$_GET[egap];}
	$LGCLASS->page_title=PAGE_TITLE;  // This is the page title
	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	$LGCLASS->javascript_file_array[]='ckeditor/ckeditor.js';
		$content_categories = getCategories();
	$smarty->assign('cat',$content_categories);
	$LGCLASS->page_tpl='admin/content_editor.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	$smarty_vars[content_help]=true;
	$LGCLASS->pageConstructor();
}

if(!empty($_POST)){
	
	switch($_POST[form_name]){
		case 'content':
			if(SmartyValidate::is_valid($_POST,'content_editor')){
				SmartyValidate::disconnect();
			if(contentController($_POST)){
				default_page();
			}
			}else{
				$smarty_vars['nodataload']=true;
				$LGCLASS->postError($_POST);	
				default_page();
			}	
		break;
	}
		
}else{
	if($_GET[changeMainArticle]){
		if(!setMainArticle($_GET[catid],$_GET[main])){
			$smarty_vars[error]=true;
			$smarty_vars[error_text]='You can not make this article your main article, because it does not have header images attached.';	
		}
	}
	default_page();	
}


?>