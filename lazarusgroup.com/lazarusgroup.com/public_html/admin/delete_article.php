<?
require('common/page_start.php');
checkUserLogin();

delete_article($_GET[article_id],$_GET[catid]);
?>