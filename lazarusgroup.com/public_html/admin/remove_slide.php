<?
require('common/page_start.php');

$media_id = $_GET[media_id];
$group_id = $_GET[group_id];

removeSlideshowImage($media_id,$group_id);
reorderSlideshow($group_id);

header('location:photoslide.php?group_id='.$group_id);
?>