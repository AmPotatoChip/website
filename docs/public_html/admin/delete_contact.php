<?
require('common/page_start.php');
require_once('common/cms_contact_class.php');
checkUserLogin();

if($_GET[contact_id]){
$CONTACT = new CONTACT_SEARCH();
$CONTACT->deleteContact($_GET[contact_id]);
}
header("location:manage_contacts.php?msg="."The contact has been deleted");


?>