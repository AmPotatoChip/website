<?
require('common/page_start.php');
if(!$_GET[egap]){$page_id = 100;}else{$page_id=$_GET[egap];}

$LGCLASS->page_title=PAGE_TITLE;  // This is the page title
$LGCLASS->tpl_header_file='_header.tpl'; // This is the top header
$LGCLASS->root_tpl='_main_template.tpl'; // This is the main template where everything gets put together
$LGCLASS->tpl_footer_file='_footer.tpl'; // Footer file
$LGCLASS->css_file_array[]='site.css'; // Stylesheet that needs to be added to the header.
$LGCLASS->javascript_file_array[]='images.js';
$LGCLASS->page_tpl='gallery.tpl'; // This current's page template file.
//$LGCLASS->display_data=collectContentById($page_id);

//$smarty_vars[help]='This section is just a test to see if this will work or not.';

collectContentForCategory('Gallery');
// This controlls the header Image
$header_image = array('masthead_on.gif','masthead.gif');
$smarty->assign('header_image',$header_image);
assignArticleHeaderImage("Gallery");

$LGCLASS->pageConstructor();

?>