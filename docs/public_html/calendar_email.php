<?
require('common/page_start.php');
require('admin/common/calendar_class.php'); // calendar class holds all the functions needed for this.
$CALENDAR = new CMS_CALENDAR();


//$content = $CALENDAR->getSingleDayEntry($_GET[calentryid],$_GET[calid]);



function default_page(){
global $dbconn,$smarty,$smarty_vars,$LGCLASS,$CALENDAR;

SmartyValidate::register_form('calendar_email',true);
$LGCLASS->page_title="Lazarus Group Demo Site";
$LGCLASS->tpl_header_file='_header.tpl'; // This is the top header
$LGCLASS->root_tpl='_main_template.tpl'; // This is the main template where everything gets put together
$LGCLASS->tpl_footer_file='_footer.tpl'; // Footer file
$LGCLASS->css_file_array[]='site.css'; // Stylesheet that needs to be added to the header.
$LGCLASS->javascript_file_array[]='images.js';
$LGCLASS->javascript_file_array[]='/common/javascript.js';
$LGCLASS->page_tpl='calendar_email.tpl'; // This current's page template file.

$header_image = array('masthead_on.gif','masthead.gif');
$smarty->assign('header_image',$header_image);

$LGCLASS->pageConstructor();

}


if(!empty($_POST)){
	if(SmartyValidate::is_valid($_POST,'calendar_email')){
		SmartyValidate::disconnect();
		$_POST[calendar_id]=$_POST[calid];
		$CALENDAR->calendarMailOut($_POST);
		$smarty_vars[hideform]=true;
		default_page();
	}else{
		$LGCLASS->postError($_POST);
		default_page();
	}
	
}else{
	default_page();
}


?>