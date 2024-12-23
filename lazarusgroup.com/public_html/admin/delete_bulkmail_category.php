<?
require('common/page_start.php');
checkUserLogin();


$category_id = $_GET['category_id'];
deleteBulkMailCategory($category_id);

$msg = 'The Bulkmail category has been deleted';
header("location:bulkmail.php?type=bmc&msg=$msg");
?>