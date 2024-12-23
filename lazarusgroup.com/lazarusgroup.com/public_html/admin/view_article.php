<?
require('common/page_start.php');
require(SITE_PATH.'common/main_lib.php');

function default_page(){
	global $LGCLASS,$smarty,$smarty_vars;
	checkUserLogin();
	
//	if(!$_GET[egap]){$page_id = 100;}else{$page_id=$_GET[egap];}
	$content = getContentByArticleId($_GET[article_id]);
//	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/view_article.tpl'; // This is the main template where everything gets put together
//	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
//	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
//	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
//	$LGCLASS->javascript_file_array[]='fckeditor/fckeditor.js';
//	$content_categories = getCategories();
//	$smarty->assign('cat',$content_categories);
//	$LGCLASS->page_tpl='admin/content_editor.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	$LGCLASS->pageConstructor();
}

default_page();

?>