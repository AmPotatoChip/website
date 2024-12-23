<?
require('common/page_start.php');
require('common/form_controller.class.php');
$allowed = array('tcdparts.com','www.tcdparts.com','tcd.lazarusgroup.com');
$FORMC = new FORM_CONTROLLER();
$FORMC->sendToEmails = 'notify@lazarusgroup.com';

validSubmission();

function validSubmission(){
	global $allowed;
	$referer = $_SERVER['HTTP_REFERER'];
	$tmp = explode("/",$referer,4);
	$post_from = $tmp[2];
	
	if(!in_array($post_from,$allowed)){
		echo "<center><h2>Permission Denied!</h2>";
		echo "Your IP has been logged (".$_SERVER['REMOTE_ADDR'].")</center>";
		exit;	
	}
}

if(!empty($_POST)){
	
	$FORMC->formRedir=$_POST[redir];
	$FORMC->postParams=$_POST;	
	
	if($_POST[rcpt]){
		$FORMC->sendToEmails=$_POST[rcpt];
	}
	
	if($_POST[letter]){
		$FORMC->letter_group = $_POST[letter];
	}
	

	$FORMC->formPostInit();	
}
?>