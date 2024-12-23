<?
require('common/page_start.php');

$article_id = $_GET[article_id];
$newStatus = $_GET[newStatus];

if(!empty($article_id) && !empty($newStatus)){
	articleStatusChange($article_id,$newStatus);
}

?>