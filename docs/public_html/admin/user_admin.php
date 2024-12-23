<?
require('common/page_start.php');

// need to require user_admin_class.php
require('common/user_admin_class.php');
$USER_ADMIN = NEW USER_ADMINISTRATION();

function default_page(){
	global $LGCLASS,$smarty,$smarty_vars,$USER_ADMIN;
	checkUserLogin();
	
//	$smarty_vars[show_media_lib]=true;
	SmartyValidate::register_form('user_admin_form',true);
	
	if($_GET[delete]==true && $_GET[delete_id]){
		$USER_ADMIN->userDelete($_GET[delete_id]);
		$msg="User has been deleted";
		header("location:user_admin.php?msg=$msg");
	}
	
	if($_GET[user_id]){
			$USER_ADMIN->assignAdminInfoById($_GET[user_id]);
	}
	$USER_ADMIN->assignAllAdminUsers();
	
//	if(!$_GET[egap]){$page_id = 100;}else{$page_id=$_GET[egap];}
	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	
	
	$LGCLASS->page_tpl='admin/user_admin.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	$LGCLASS->pageConstructor();
}


if(!empty($_POST)){
	if(SmartyValidate::is_valid($_POST,'user_admin_form')){
		SmartyValidate::disconnect();
		if($_POST[id]){
			$return = $USER_ADMIN->adminUserController($_POST,'update');
		}else{
			$return = $USER_ADMIN->adminUserController($_POST,'new');
		}	
		
		if($return[state]==false){
			$smarty_vars[error]=true;
			$smarty_vars[error_text]=$return[msg];
			$smarty->assign($_POST);	
			default_page();	
		}else{
			$smarty_vars[error]=true;
			$smarty_vars[error_text]=$return[msg];
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