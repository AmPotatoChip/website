<?
require('common/page_start.php');
require('common/cms_contact_class.php');
$CONTACT = new CONTACT_SEARCH();
checkUserLogin();

if($_GET[address_id] && $_GET[contact_id]){
	$CONTACT->deleteAddressById($_GET[address_id]);
	$msg='The address has been deleted';
	header("location:edit_contact.php?contact_id=$_GET[contact_id]&msg=$msg");
}



?>