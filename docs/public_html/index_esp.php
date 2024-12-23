<?
require('common/page_start.php');

$LGCLASS->page_title=PAGE_TITLE;  // This is the page title
$LGCLASS->tpl_header_file='_header.tpl'; // This is the top header
$LGCLASS->tpl_footer_file='_esp_footer.tpl'; // Footer file
$LGCLASS->css_file_array[]='/esp_site.css'; // Stylesheet that needs to be added to the header.
//$LGCLASS->javascript_file_array[]='images.js';
$LGCLASS->javascript_file_array[]='/common/javascript.js';



$LGCLASS->page_tpl='article_controller.tpl'; // This current's page template file.

// This controlls the header Image

if(!$_GET[page]){
	$page = 'esp_bienvenidos_a_mi_pagina_web';
}else{
	$page = $_GET[page];
}

collectContentForCategory($page);


	$LGCLASS->root_tpl='_main_template_esp.tpl'; // This is the main template where everything gets put together
	
assignRandomQuote_esp();

$LGCLASS->pageConstructor();
?>