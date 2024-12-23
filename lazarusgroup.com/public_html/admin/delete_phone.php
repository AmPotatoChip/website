<?
require('common/page_start.php');
require('common/cms_contact_class.php');
checkUserLogin();
$CONTACT = new CONTACT_SEARCH();

if($_GET[phone_id] && $_GET[contact_id]){
	$CONTACT->deletePhoneById($_GET[phone_id]);
	$msg='The Phone number has been deleted';
	header("location:edit_contact.php?contact_id=$_GET[contact_id]&msg=$msg");
}

?>