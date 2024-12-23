<?
require('common/page_start.php');
require('common/cms_contact_class.php');
checkUserLogin();

$CONTACT = new CONTACT_SEARCH();

if($_GET[email_id] && $_GET[contact_id]){
	$CONTACT->deleteEmailAddress($_GET[email_id]);
	$msg='The email address has been deleted';
	header("location:edit_contact.php?contact_id=$_GET[contact_id]&msg=$msg");
}



?>