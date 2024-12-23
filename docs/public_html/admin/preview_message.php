<?
require('common/page_start.php');
checkUserLogin();

function default_page(){
	global $LGCLASS,$smarty,$smarty_vars;
	SmartyValidate::register_form('category',true);
	
	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	$LGCLASS->page_tpl='admin/preview_message.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	assignBulkMailTemplates();
	if($_GET[message_id] && $_GET[template]){
		require_once('common/bulk_mail_class.php');
		$BMC = new BULK_MAIL_CLASS();
		$BMC->message_id=$_GET[message_id];
		$BMC->template_file=$_GET[template];
		$BMC->messagePreview();
		if(!empty($BMC->message_preview_data)){
			$smarty_vars[message_preview_data]=true;
			$_SESSION[message_preview_data]=$BMC->message_preview_data;	
		}
		
	}
	$LGCLASS->pageConstructor();
}

default_page();


?>