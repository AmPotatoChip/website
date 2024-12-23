<?
require('common/page_start.php');

// need to require user_admin_class.php
require('common/user_admin_class.php');
$USER_ADMIN = NEW USER_ADMINISTRATION();
checkUserLogin();
require('common/calendar_class.php');
$CALENDAR = new CMS_CALENDAR();


function default_page(){
	global $LGCLASS,$smarty,$smarty_vars,$USER_ADMIN,$CALENDAR;
	$CALENDAR->assignCalendarCategories();	
	
	if($_GET[calid]){
		$CALENDAR->calendar_id=$_GET[calid];
		$smarty_vars[calendar_name]=$CALENDAR->returnCalendarName();
		$smarty_vars[calendar_id]=$_GET[calid];
		$smarty_vars[show_form]=true;
	}
	
	
	SmartyValidate::register_form('calendar_category',true);
//	if(!$_GET[egap]){$page_id = 100;}else{$page_id=$_GET[egap];}
	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	
	
	$LGCLASS->page_tpl='admin/calendar.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	$LGCLASS->pageConstructor();
}


if(!empty($_POST)){
	if(SmartyValidate::is_valid($_POST,'calendar_category')){
		SmartyValidate::disconnect();
		$CALENDAR->postparams=$_POST;
		$CALENDAR->calendarControl();
	}else{
		$LGCLASS->postError($_POST);
		$smarty_vars[show_form]=true;
		default_page();		
	}
}else{
default_page();		
}


?>