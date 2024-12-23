<?
require('common/page_start.php');
checkUserLogin();
if($_GET[group_id]){
	// only do this if the group is given.
	deleteSlideshowGroup($_GET[group_id]);
	$msg="The slideshow group has been deleted";
	header("location:photoslide_groups.php?msg=$msg");
}
?>