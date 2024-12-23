<?
require('common/page_start.php');

$data->media_id = $_GET[media_id];
$data->npos = $_GET[npos];
$data->group_id = $_GET[group_id];

changeSlideOrder($data->media_id,$data->npos,$data->group_id);
header('location:photoslide.php?group_id='.$data->group_id);
?>