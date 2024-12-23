<?
require('common/page_start.php');
require('admin/common/calendar_class.php'); // calendar class holds all the functions needed for this.
$CALENDAR = new CMS_CALENDAR();


$content = $CALENDAR->getSingleDayEntry($_GET[calentryid],$_GET[calid]);
$smarty->assign('calendar_entry',$content);
$smarty->display('calendar_print_template.tpl');


?>