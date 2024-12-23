<?
require('common/page_start.php');
checkUserLogin();

require_once('common/bulk_mail_class.php');
$BMC = new BULK_MAIL_CLASS();
$BMC->deleteBatch($_GET[batch_id]);

$msg = "The batch has been deleted";
header("location:bulkmail.php?type=batch&msg=$msg");

?>