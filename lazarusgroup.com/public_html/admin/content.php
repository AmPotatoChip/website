<?
require('common/page_start.php');

if($_GET[type]=='removeheader' && $_GET[catid]){
	// if client tries to remove the header we do not need to go further tan this.
	removeHeaderFromContentCategory($_GET[catid]);
	header("location:$_SERVER[HTTP_REFERER]");
	exit;
}

if($_GET[type]=='removesquare' && $_GET[catid]){
	removeSquareFromContentCategory($_GET[catid]);	
	header("location:$_SERVER[HTTP_REFERER]");
	exit;
}


function default_page(){
	global $LGCLASS,$smarty,$smarty_vars;
	checkUserLogin();
	
	$smarty_vars[show_media_lib]=true;
	SmartyValidate::register_form('category',true);
	if($_GET[catid]){ assignCategoryInfo($_GET[catid]); }
//	if(!$_GET[egap]){$page_id = 100;}else{$page_id=$_GET[egap];}
	$LGCLASS->page_title=PAGE_TITLE;  // This is the page title
	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	$content_categories = getCategories();
	$smarty->assign('cat',$content_categories);
	$LGCLASS->page_tpl='admin/content.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	$LGCLASS->pageConstructor();
}


if(!empty($_POST)){
	if(SmartyValidate::is_valid($_POST,'category')){
		// two types of posts!
		// both will be handeled by the category control function.
		SmartyValidate::disconnect();
		if(categoryController($_POST)){
			default_page();
		}else{
			$LGCLASS->postError($_POST);
			$smarty_vars[showform]=true;
			default_page();	
		}
	}else{
		$LGCLASS->postError($_POST);
		$smarty_vars[showform]=true;
		default_page();	
	}
}else{
	default_page();	
}

?>