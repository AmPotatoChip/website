<?
require('common/page_start.php');
require_once(SITE_PATH.'admin/common/bulk_mail_class.php');
if($_GET[stid]){
	$BMC = new BULK_MAIL_CLASS();
	$stid = $_GET[stid];
	$BMC->pixelRecorder($stid);
}
?>