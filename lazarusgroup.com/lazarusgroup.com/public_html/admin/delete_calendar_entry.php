<?
require('common/page_start.php');

// need to require user_admin_class.php
require('common/user_admin_class.php');
$USER_ADMIN = NEW USER_ADMINISTRATION();
checkUserLogin();
require('common/calendar_class.php');
$CALENDAR = new CMS_CALENDAR();
$CALENDAR->calendar_id=$_GET[calid];
$CALENDAR->deleteCalendarEntry($_GET[id]);




$url = "calendar_detail.php?calid=$CALENDAR->calendar_id";
$msg = "The calendar entry has been deleted";
header("location:$url"."&msg=$msg");
?>