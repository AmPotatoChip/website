<?
require('common/page_start.php');

$LGCLASS->page_title=PAGE_TITLE;  // This is the page title
$LGCLASS->tpl_header_file='_header.tpl'; // This is the top header
$LGCLASS->tpl_footer_file='_footer.tpl'; // Footer file
$LGCLASS->css_file_array[]='site.css'; // Stylesheet that needs to be added to the header.
//$LGCLASS->javascript_file_array[]='images.js';
$LGCLASS->javascript_file_array[]='/common/javascript.js';



$LGCLASS->page_tpl='article_controller.tpl'; // This current's page template file.

// This controlls the header Image

	if(!$_GET[page]){
		$page = 'home';
	}else{
		$page = $_GET[page];
	}
	
	if($page=="home")
		$LGCLASS->root_tpl='_main_template.tpl'; // This is the main template where everything gets put together	
	else 
		$LGCLASS->root_tpl='_main_template.tpl'; // This is the main template where everything gets put together
	

	collectContentForCategory($page);
	
	if (strpos($page, '-'))
		$categoryprime = substr($page, 0,strpos($page, '-'));
	else
		$categoryprime=$page;
	
	$smarty->assign('categoryprime',$categoryprime);
	
	$mainNav = BuildMainNavTree("main","topnav");
	$smarty->assign('mainnav',$mainNav);
	
	$navTree = BuildNavTree($page);
	$smarty->assign('navTree',$navTree);
	
	$testimonials = assignRandomContent("testimonials");
	$smarty->assign('testimonials',$testimonials);
	
	$right_two = assignRandomContent("right_two");
	$smarty->assign('right_two',$right_two);
	
	$right_three = assignRandomContent("right_three");
	$smarty->assign('right_three',$right_three);
	
	$right_four = assignRandomContent("right_four");
	$smarty->assign('right_four',$right_four);
	
	
	$LGCLASS->pageConstructor();
	
?>