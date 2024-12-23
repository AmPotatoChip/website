<?
require('common/page_start.php');


function default_page(){
	global $LGCLASS,$smarty;
	SmartyValidate::register_form('email_friend',true);
	$LGCLASS->page_title=PAGE_TITLE;  // This is the page title;
	$LGCLASS->tpl_header_file='_header.tpl'; // This is the top header
	$LGCLASS->root_tpl='_main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='_footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='site.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='images.js';
	$LGCLASS->javascript_file_array[]='/common/javascript.js';
	$LGCLASS->page_tpl='email_article.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	
	collectContentForCategory('Contributors');
	// This controls the header Image
	$header_image = array('masthead_on.gif','masthead.gif');
	$smarty->assign('header_image',$header_image);
	$LGCLASS->pageConstructor();
}


if(!empty($_POST)){
	if(SmartyValidate::is_valid($_POST,'email_friend')){
		SmartyValidate::disconnect();
		emailArticle($_POST);
		$smarty_vars[error]=true;
		$smarty_vars[error_text]="Your Email has been sent out";
		$smarty_vars[hideform]=true;
		default_page();
	}else{
		$LGCLASS->postError($_POST);	
		default_page();
	}
}else{
	default_page();
}
?>