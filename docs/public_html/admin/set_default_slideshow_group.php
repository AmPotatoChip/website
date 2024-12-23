<?
require('common/page_start.php');
checkUserLogin();
if($_GET[group_id]){
	setDefaultSlideshowGroup($_GET[group_id]);
	$msg="The default slideshow has been changed";
	header("location:photoslide_groups.php?msg=$msg");
}
?>