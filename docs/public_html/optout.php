<?
require('common/page_start.php');

if($_GET[contact_id] && $_GET[group_id]){
	$contact_id=$_GET[contact_id];
	$group_id = $_GET[group_id];
	
	require_once('admin/common/bulk_mail_class.php');
	$BMC = new BULK_MAIL_CLASS();
	$BMC->optout($contact_id,$group_id);
	
}

$LGCLASS->page_title=PAGE_TITLE;  // This is the page title
$LGCLASS->tpl_header_file='_header.tpl'; // This is the top header
$LGCLASS->root_tpl='_main_template.tpl'; // This is the main template where everything gets put together
$LGCLASS->tpl_footer_file='_footer.tpl'; // Footer file
$LGCLASS->css_file_array[]='site.css'; // Stylesheet that needs to be added to the header.
$LGCLASS->javascript_file_array[]='images.js';
$LGCLASS->page_tpl='optout.tpl'; // This current's page template file.


$header_image = array('masthead_on.gif','masthead.gif');
$smarty->assign('header_image',$header_image);


$LGCLASS->pageConstructor();

?>