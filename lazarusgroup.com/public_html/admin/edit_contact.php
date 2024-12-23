<?
require('common/page_start.php');
require('common/cms_contact_class.php');

function default_page(){
	global $LGCLASS,$smarty;
	checkUserLogin();
	
	if($_GET[contact_id]){
		require('smarty/SmartyPaginate.class.php');
		SmartyPaginate::connect();
		SmartyPaginate::setLimit(5);
		SmartyPaginate::setUrl('edit_contact.php?contact_id='.$_GET[contact_id]);
		SmartyPaginate::assign($smarty);
				
		$CONTACT = new CONTACT_SEARCH();
		$CONTACT->assignContactInformation($_GET[contact_id]);	
		
		$category_conn = getBulkMailCategoryContactConnection($_GET[contact_id]);
		$smarty->assign('cconn',$category_conn);
	}
	
	assignBulkMailCategories();
	
	
$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
$LGCLASS->page_tpl='admin/edit_contact.tpl'; // This current's page template file.
//$LGCLASS->display_data=collectContentById($page_id);

//$smarty_vars[help]='This section is just a test to see if this will work or not.';

$LGCLASS->pageConstructor();

}

if(!empty($_POST)){
	updateBulkMailCategoryConnection($_POST);
	$smarty_vars[error]=true;
	$smarty_vars[error_text]="The Bulk Email categories have been updated for this contact";
	default_page();
}else{
	default_page();
}
?>