<?
require('common/page_start.php');
$referer = $_SERVER["HTTP_REFERER"];



if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST[email])) {
	$num = newsletterSignup($_POST[email]);
}else{
  $num = 2;
}


$tmp->referer = explode("?",$referer);
if(!empty($referer)){
	Header("location:".$tmp->referer[0]."?em=$num");	
}
?>