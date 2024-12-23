<?
require('common/page_start.php');


if(!$_GET[days]){
	$_GET[days]=7;	
}
$name_droper_data = collectNameDroppers($_GET[days]);

$smarty->assign('namedropper',$name_droper_data);

$LGCLASS->page_title=PAGE_TITLE;  // This is the page title
$LGCLASS->tpl_header_file='_header.tpl'; // This is the top header
$LGCLASS->root_tpl='_main_template.tpl'; // This is the main template where everything gets put together
$LGCLASS->tpl_footer_file='_footer.tpl'; // Footer file
$LGCLASS->css_file_array[]='site.css'; // Stylesheet that needs to be added to the header.
$LGCLASS->javascript_file_array[]='images.js';
$LGCLASS->javascript_file_array[]='/common/javascript.js';
$LGCLASS->page_tpl='name_dropper.tpl'; // This current's page template file.
//$LGCLASS->display_data=collectContentById($page_id);

//$smarty_vars[help]='This section is just a test to see if this will work or not.';

// This controlls the header Image
$header_image = array('masthead_on.gif','masthead.gif');
$smarty->assign('header_image',$header_image);


$LGCLASS->pageConstructor();

?>