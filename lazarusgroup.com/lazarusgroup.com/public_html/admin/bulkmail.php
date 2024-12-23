<?
require('common/page_start.php');
checkUserLogin();


function default_page(){
	global $LGCLASS,$smarty,$smarty_vars;
	
	
	
	$smarty_vars[show_media_lib]=true;
	
	
	assignBulkMailMessages();
	
	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	$LGCLASS->page_tpl='admin/bulkmail.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	if($_GET[edit]){
		// means we would like to edit the category information.
		$data = getBulkMailCategoryForUpdate($_GET[edit]);
		$data['update']=$_GET[edit];
		$smarty->assign($data);
		$smarty_vars[show_form]=true;
	}
	
	switch($_GET[type]){
		case 'bmc':
			SmartyValidate::register_form('category',true);	
			assignBulkMailCategories();
		break;
		case 'mail':
			SmartyValidate::register_form('test_message',true);
			SmartyValidate::register_form('live_message',true);
			assignBulkMailTemplates();
			assignBulkMailCategories();
			assignBulkmailTestGroups();
		break;	
		case 'mtg':
			if($_GET[group_id]){
				require_once('common/bulk_mail_class.php');
				$BMC = new BULK_MAIL_CLASS();
				$data = $BMC->loadTestGroupDataForUpdate($_GET[group_id]);
				$smarty->assign($data);
				$smarty_vars[show_form]=true;
			}
			assignBulkmailTestGroups();
			SmartyValidate::register_form('test_group',true);
		break;
		case 'batch':
			require_once('common/bulk_mail_class.php');
			$BMC = new BULK_MAIL_CLASS();
			$data = $BMC->getBulkMailBatches();
			$smarty->assign('batches',$data);
		break;
	}
	
	$LGCLASS->pageConstructor();
}


if(!empty($_POST)){
	
	switch($_POST[form_name]){
		case 'category':
			if(SmartyValidate::is_valid($_POST,'category')){
				SmartyValidate::disconnect();
				$msg = addBulkMailCategory($_POST);
				header("location:bulkmail.php?type=bmc&msg=$msg");
			}else{
				$LGCLASS->postError($_POST);	
				$smarty_vars[show_form]=true;
				default_page();
			}
		break;
		case 'test_message':
			if(SmartyValidate::is_valid($_POST,'test_message')){
				SmartyValidate::disconnect();
				require_once('common/bulk_mail_class.php');
				$BMC = new BULK_MAIL_CLASS();
				$BMC->sendBulkMail($_POST,'test');
				$smarty_vars[error]=true;
				$smarty_vars[error_text]='Test mail has been send out.';
				default_page();
			}else{
				$LGCLASS->postError($_POST);
				default_page();
			}
		break;
		case 'test_group':
			if(SmartyValidate::is_valid($_POST,'test_group')){
				SmartyValidate::disconnect();
				require_once('common/bulk_mail_class.php');
				$BMC = new BULK_MAIL_CLASS();
				
				if($_POST[group_id]){
					$BMC->testGroupController($_POST,true);
					$smarty_vars[error]=true;
					$smarty_vars[error_text]=$BMC->user_message;
				}else{
					$BMC->testGroupController($_POST);
					$smarty_vars[error]=true;
					$smarty_vars[error_text]=$BMC->user_message;
				}
				default_page();	
			}else{
				$smarty_vars[show_form]=true;
				$LGCLASS->postError($_POST);
				default_page();
			}
		break;
		case 'live_message':
			if(SmartyValidate::is_valid($_POST,'live_message')){
				SmartyValidate::disconnect();
				require_once('common/bulk_mail_class.php');
				$BMC = new BULK_MAIL_CLASS();
				if($BMC->sendBulkMail($_POST,'live')){
					$msg = $BMC->user_message;
					$smarty_vars[error]=true;
					$smarty_vars[error_text]=$msg;
				}else{
					$msg = $BMC->user_message;
					$smarty->assign($_POST);
					$smarty_vars[error]=true;
					$smarty_vars[error_text]=$msg;
				}
				default_page();
			}else{
				$LGCLASS->postError($_POST);	
				default_page();
			}
		break;
	
	}
}else{
	default_page();	
}


?>