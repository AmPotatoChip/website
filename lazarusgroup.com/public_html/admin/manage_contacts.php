<?
require('common/page_start.php');
require_once('common/cms_contact_class.php');
checkUserLogin();

$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
$LGCLASS->page_tpl='admin/manage_contacts.tpl'; // This current's page template file.
if(!empty($_GET[query])){
	$CONTACT = new CONTACT_SEARCH();
	$CONTACT->getSearchResult($_GET[query]);
	if(!empty($CONTACT->search_result)){
		$smarty->assign('search_result',$CONTACT->search_result);
	}
}
//$LGCLASS->display_data=collectContentById($page_id);
//$smarty_vars[help]='This section is just a test to see if this will work or not.';

if(!empty($_POST)){
	if(SmartyValidate::is_valid($_POST,'search')){
		if(!empty($_POST['query']) && !empty($_POST['by'])){
		$CONTACT = new CONTACT_SEARCH();
		$CONTACT->search_query=$_POST['query'];
		$CONTACT->search_type=$_POST['by'];
		$CONTACT->initSearch();
		$CONTACT->collectContactInfo();
		if(!empty($CONTACT->search_result)){
			$smarty->assign('search_result',$CONTACT->search_result);
		}
		$smarty->assign($_POST);
		SmartyValidate::register_form('search',true);
		$LGCLASS->pageConstructor();
	}	
	}else{
		$LGCLASS->postError($_POST);	
		SmartyValidate::register_form('search',true);
		$LGCLASS->pageConstructor();
	}
}else{
	SmartyValidate::register_form('search',true);
	$LGCLASS->pageConstructor();
}

?>