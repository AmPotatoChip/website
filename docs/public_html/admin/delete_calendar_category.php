<?
require('common/page_start.php');

// need to require user_admin_class.php
require('common/user_admin_class.php');
$USER_ADMIN = NEW USER_ADMINISTRATION();
checkUserLogin();
require('common/calendar_class.php');
$CALENDAR = new CMS_CALENDAR();
$CALENDAR->calendar_id=$_GET[calid];
$CALENDAR->deleteCalendar();
$url = "calendar.php";
$msg = "The calendar has been deleted";
header("location:$url"."?msg=$msg");
?>