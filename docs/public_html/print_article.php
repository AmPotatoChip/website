<?
require('common/page_start.php');

$article_id = $_GET[article_id];
getPrintArticle($article_id);


$smarty->display('_print_template.tpl');

?>