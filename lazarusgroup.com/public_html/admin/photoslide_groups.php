<?
require('common/page_start.php');
checkUserLogin();


function default_page(){
	global $LGCLASS,$CONTACT,$smarty,$smarty_vars;
	SmartyValidate::register_form('slideshow_group',true);
	if($_GET[group_id]){
		$smarty->assign(loadGroupDataForUpdate($_GET[group_id]));	
	}
	
	$data = loadSlideShowGroup();
	$smarty->assign('sg',$data);
	$LGCLASS->tpl_header_file='admin/header.tpl'; // This is the top header
	$LGCLASS->root_tpl='admin/main_template.tpl'; // This is the main template where everything gets put together
	$LGCLASS->tpl_footer_file='admin/footer.tpl'; // Footer file
	$LGCLASS->css_file_array[]='/admin/stylesheet.css'; // Stylesheet that needs to be added to the header.
	$LGCLASS->javascript_file_array[]='/admin/common/javascripts.js';
	$LGCLASS->page_tpl='admin/photoslide_groups.tpl'; // This current's page template file.
	//$LGCLASS->display_data=collectContentById($page_id);
	//$smarty_vars[help]='This section is just a test to see if this will work or not.';
	$LGCLASS->pageConstructor();
}


if(!empty($_POST)){
	if(SmartyValidate::is_valid($_POST,'slideshow_group')){
		SmartyValidate::disconnect();
		if($_POST[group_id]){
			// this needs to be edited.
			$msg = slideshowGroupControl($_POST,'edit');
			header("location:photoslide_groups.php?msg=$msg");
			exit;
		}else{
			$msg = slideshowGroupControl($_POST,'new');
			header("location:photoslide_groups.php?msg=$msg");
			exit;
		}
	}else{
		$smarty_vars[show_form]=true;
		$LGCLASS->postError($_POST);
		default_page();	
	}
}else{
	default_page();	
}



?>