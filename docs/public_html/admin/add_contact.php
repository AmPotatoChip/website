<?
require('common/page_start.php');
require('common/cms_contact_class.php');

function default_page(){
	global $LGCLASS;
	checkUserLogin();
	
	SmartyValidate::register_form('contact',true);
	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	$LGCLASS->page_tpl='admin/add_contact.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	assignBulkmailCategoriesDisplay();
	$LGCLASS->pageConstructor();
	
}


if(!empty($_POST)){
	if(SmartyValidate::is_valid($_POST,'contact')){
		$CONTACT = new CONTACT_SEARCH();
		$contact_id = $CONTACT->addContactFromForm($_POST);
		header("location:edit_contact.php?contact_id=$contact_id");
	}else{
		$LGCLASS->postError($_POST);
		default_page();	
	}
}else{
	default_page();
}

?>