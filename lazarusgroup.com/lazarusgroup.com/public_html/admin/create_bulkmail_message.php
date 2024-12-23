<?
require('common/page_start.php');
checkUserLogin();

function default_page(){
	global $LGCLASS,$smarty,$smarty_vars;
	SmartyValidate::register_form('bulkmail_message',true);
	if($_GET[message_id]){
		// means we are updating a message.
		$data = loadMessageDataForUpdate($_GET[message_id]);
		$data[update]=true;
		$smarty->assign($data);	
	}
	$smarty_vars[show_media_lib]=true;
	
	$LGCLASS->page_title=PAGE_TITLE;  // This is the page title
	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	$LGCLASS->javascript_file_array[]='ckeditor/ckeditor.js';
		$LGCLASS->page_tpl='admin/create_bulkmail_message.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	
	$LGCLASS->pageConstructor();
}


if(!empty($_POST)){
	if(SmartyValidate::is_valid($_POST,'bulkmail_message')){
		SmartyValidate::disconnect();
		// need to pass information to the bulk mail class
		require_once('common/bulk_mail_class.php');
		$BMC = new BULK_MAIL_CLASS();
		$data[post]=$_POST;
		$data[files]=$_FILES;
		$BMC->ogData=$data;
		
		$BMC->storeBulkMailData();
		if($BMC->user_message){
			$msg = $BMC->user_message;
			header("location:bulkmail.php?type=bmm&msg=$msg");
			exit;
		}
	}else{
		$LGCLASS->postError($_POST);
		default_page();
	}	
}else{
default_page();
}

?>