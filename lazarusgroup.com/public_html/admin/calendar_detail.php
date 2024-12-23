<?
require('common/page_start.php');

checkUserLogin();
// need to require user_admin_class.php
require('common/user_admin_class.php');
$USER_ADMIN = NEW USER_ADMINISTRATION();
require('common/calendar_class.php');
$CALENDAR = new CMS_CALENDAR();

function default_page(){
	global $LGCLASS,$smarty,$smarty_vars,$USER_ADMIN,$CALENDAR;
	
	
	if($_GET[d]){
		switch($_GET[d]){
			case 'u':
				$month = date("m",mktime(12,00,00,$_GET[m]+1,1,$_GET[y]));
				$year = date("Y",mktime(12,00,00,$_GET[m]+1,1,$_GET[y]));
				$string = $_GET[calid]."&m=$month&y=$year";
				if($_GET[type]=='square'){
					$string.='&type=square';
				}
				header("location:calendar_detail.php?calid=".$string);
			break;
			case 'd':
				$month = date("m",mktime(12,00,00,$_GET[m]-1,1,$_GET[y]));
				$year = date("Y",mktime(12,00,00,$_GET[m]-1,1,$_GET[y]));
				$string = $_GET[calid]."&m=$month&y=$year";
				if($_GET[type]=='square'){
					$string.='&type=square';
				}
				header("location:calendar_detail.php?calid=".$string);
			break;	
		}	
	}
	
	if($_GET[id]){
		$formData = $CALENDAR->loadCalendarDetailData($_GET[id]);	
		$smarty->assign($formData);
	}
	
	$CALENDAR->calendar_id=$_GET[calid];
	$smarty_vars[calendar_name]=$CALENDAR->returnCalendarName();
	$cd = $CALENDAR->collectCalendarDataForUpdate();
	$smarty_vars[cd]=$cd;
	
	SmartyValidate::register_form('calendar_entry',true);
//	if(!$_GET[egap]){$page_id = 100;}else{$page_id=$_GET[egap];}
	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	
	
	$LGCLASS->page_tpl='admin/calendar_detail.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	$LGCLASS->pageConstructor();
}


if(!empty($_POST)){
	if($_POST[calendar_type]=='multiple' && $_POST[todate]==''){
		$smarty_vars[error_todate]='Until Date is required if you select Multiple Day Calendar';	
	}
	if(SmartyValidate::is_valid($_POST,'calendar_entry')){
		SmartyValidate::disconnect();
		$CALENDAR->postparams=$_POST;
		$CALENDAR->calendarEntryControl();
		$smarty_vars[error]=true;
		$smarty_vars[error_text]=$CALENDAR->usermessage;
		default_page();
	}else{
		$smarty_vars[show_form]=true;
		$LGCLASS->postError($_POST);	
		default_page();
	}
}else{
	default_page();
}
?>