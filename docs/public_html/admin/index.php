<?
require('common/page_start.php');
checkUserLogin();

$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
$LGCLASS->page_tpl='admin/index.tpl'; // This current's page template file.
//$LGCLASS->display_data=collectContentById($page_id);

//$smarty_vars[help]='This section is just a test to see if this will work or not.';

$LGCLASS->pageConstructor();

?>