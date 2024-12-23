<?
// this is the shell for the cms system
// $smarty and $dbconn have been initiated at this point
// and this will not function if it hasn't

class LGSystems_CLASS{
	var $page_title;
	var $display_data;
	var $tpl_header_file;
	var $tpl_footer_file;
	var $error_display = false;
	var $root_tpl;
	var $page_tpl;
	var $page;
	var $error_array = array();
	var $css_file_array = array();
	var $javascript_file_array = array();
	
	function pageConstructor(){
		global $dbconn,$smarty,$smarty_vars;
		switch($this->page){
			default:
				if(!empty($this->tpl_header_file)){
					$smarty->assign('header',$this->tpl_header_file);	
				}
				
				if(!empty($this->tpl_footer_file)){
					$smarty->assign('footer',$this->tpl_footer_file);	
				}
				
				if(!empty($this->page_title)){
					$smarty->assign('page_title',$this->page_title);	
				}
					
				$this->cssVarAssign();
				$this->javascriptVarAssign();
				if(!empty($this->page_tpl)){$smarty->assign('page_content',$this->page_tpl);}
				if(!empty($this->display_data)){
					$smarty->assign('page_type','db');
					$smarty->assign('page_content',$this->display_data);
				}
				$this->pageDisplay();
			break;
		}
	}
	
	function pageDisplay(){
		global $smarty,$smarty_vars;
		if($this->error_display){
			if(!empty($this->error_array)){
			$this->errorDisplayFunction();
			exit;
			}
		}
		
		if(!empty($this->root_tpl)){
			$smarty->assign($smarty_vars);
			$smarty->display($this->root_tpl);
		}else{
			$this->error_array[]='Root template was empty. ($root_tpl/class obj)';
			$this->error_display=true;
			$this->pageDisplay();
		}
	}
	
	function errorDisplayFunction(){
		global $smarty,$smarty_vars;
		$smarty->assign('error_array',$this->error_array);
		$smarty->display('system/error_dump.tpl');
	}
	
	function cssVarAssign(){
		global $smarty;
		if(!empty($this->css_file_array)){
			foreach($this->css_file_array as $tmp_var){
				$var.='<link rel="stylesheet" href="'.$tmp_var.'">'."\n";
			}
			if(!empty($var))
			$smarty->assign('css',$var);
		}
	}
	
	function javascriptVarAssign(){
		global $smarty;
		if(!empty($this->javascript_file_array)){
			foreach($this->javascript_file_array as $tmp_var){
				$var.='<script language="javascript" type="text/javascript" src="'.$tmp_var.'"></script>'."\n";
			}
		}
		if(!empty($var)){
			$smarty->assign('javascripts',$var);
		}
	}
	
	function postError($postparam){
		global $smarty,$smarty_vars;
		$smarty->assign($postparam);
		$smarty_vars[error]=true;
		
	}
	
	
	
}

?>