<?
require('common/page_start.php');
checkUserLogin();
$referer = $_SERVER['HTTP_REFERER'];

if(deleteMediaContentById($_GET[id])){
	header("location:$referer");	
}





?>