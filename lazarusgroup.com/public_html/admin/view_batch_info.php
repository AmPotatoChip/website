<?
require('common/page_start.php');



function default_page(){
	global $LGCLASS,$smarty,$smarty_vars;
	checkUserLogin();
	require_once('common/bulk_mail_class.php');
	$BMC = new BULK_MAIL_CLASS();
	$data = $BMC->loadBatchInfo($_GET[batch_id]);
	$smarty->assign('bi',$data);
	
	
	SmartyValidate::register_form('category',true);
	if($_GET[catid]){ assignCategoryInfo($_GET[catid]); }

	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	$LGCLASS->page_tpl='admin/view_batch_info.tpl'; // This current's page template file.

	
	$LGCLASS->pageConstructor();
}

default_page();
?>