<?
require('common/page_start.php');
if($_GET[lid] && $_GET[stid]){
require_once('admin/common/bulk_mail_class.php');
$BMC = new BULK_MAIL_CLASS();
$BMC->linkRedirect($_GET[lid],$_GET[stid]);
}

?>