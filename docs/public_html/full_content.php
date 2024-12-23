<?
require('common/page_start.php');

$LGCLASS->page_title=PAGE_TITLE;  // This is the page title
$LGCLASS->tpl_header_file='_header.tpl'; // This is the top header
$LGCLASS->root_tpl='_main_template.tpl'; // This is the main template where everything gets put together
$LGCLASS->tpl_footer_file='_footer.tpl'; // Footer file
$LGCLASS->css_file_array[]='site.css'; // Stylesheet that needs to be added to the header.
$LGCLASS->javascript_file_array[]='images.js';
$LGCLASS->javascript_file_array[]='/common/javascript.js';
$LGCLASS->page_tpl='full_content.tpl'; // This current's page template file.


getContentByArticleId($_GET[article_id]);

assignCookieTrail($_GET[article_id]);

$LGCLASS->pageConstructor();

?>