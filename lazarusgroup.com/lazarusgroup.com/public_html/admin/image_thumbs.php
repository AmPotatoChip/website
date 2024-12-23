<?
require('common/page_start.php');

$file = $_GET[file];
if(!empty($file)){
createImageThumbnailOnFly($file);
}

?>