<?
require('common/page_start.php');
checkUserLogin();

$obj->article_id=$_GET[article_id];
$obj->cat_id=$_GET[cat_id];
$obj->file_name=$_GET[file_name];

deleteHeaderImage($obj);

header("location:content_editor.php?catid=$obj->cat_id&article_id=$obj->article_id");
?>