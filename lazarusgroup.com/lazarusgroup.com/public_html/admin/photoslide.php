<?
require('common/page_start.php');



function default_page(){
	global $LGCLASS,$CONTACT,$smarty,$smarty_vars;
	checkUserLogin();
	$smarty_vars[show_media_lib]=true;
	$smarty_vars[slideshow_content]=loadSlideshowTable($_GET[group_id]);
	
	SmartyValidate::register_form('slideshow',true);
	
	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	$LGCLASS->page_tpl='admin/photoslide.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	$LGCLASS->pageConstructor();
}


if(!empty($_POST)){
	if(SmartyValidate::is_valid($_POST,'slideshow')){
		SmartyValidate::disconnect();
		if(addToSlideShow($_POST[media_id],$_POST[group_id])){
			$smarty_vars[error]=true;
			$smarty_vars[error_text]='Image has been added to the slide show.';	
		}else{
			$smarty_vars[error]=true;
			$smarty_vars[error_text]='Image was already in your slide show';	
		}
		default_page();
	}else{
		$LGCLASS->postError($_POST);
		default_page();	
	}		
}else{
default_page();	
}



?>