<?
require_once('common/page_start.php');
checkUserLogin();

$group_id = $_GET[group_id];

$sql = "DELETE FROM ms_test_group WHERE id='$group_id'";
$dbconn->Execute($sql) or die($dbconn->ErrorMsg());

$msg="The test group has been deleted";
header("location:bulkmail.php?type=mtg&msg=$msg");
?>