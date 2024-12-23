<?
require('common/page_start.php');

if($_GET[calid]){

	function default_page(){
		global $LGCLASS,$smarty,$smarty_vars,$_GET;
		
		require('admin/common/calendar_class.php');
		$CALENDAR = new CMS_CALENDAR();
		$CALENDAR->calendar_id=$_GET[calid];
		
		
		
		if(!$_GET[m] || !$_GET[y]){
			$month = date("m",mktime());
			$year = date("Y",mktime());
			header("location:calendar.php?calid=$_GET[calid]&m=$month&y=$year&type=box");
			exit;
		}
		
		if($_GET[move]){
			$month = $_GET[m];
			$year = $_GET[y];
			
			switch($_GET[move]){
				case 'b':
					$tmp_month = date("m",mktime(12,00,00,$month-1,1,$year));	
					$tmp_year = date("Y",mktime(12,00,00,$month-1,1,$year));
				break;
				case 'f':
					$tmp_month = date("m",mktime(12,00,00,$month+1,1,$year));	
					$tmp_year = date("Y",mktime(12,00,00,$month+1,1,$year));
				break;	
			}
			if($_GET[type]){
				header("location:calendar.php?calid=$_GET[calid]&m=$tmp_month&y=$tmp_year&type=$_GET[type]");
			}else{
				header("location:calendar.php?calid=$_GET[calid]&m=$tmp_month&y=$tmp_year&type=box");
			}
			exit;
		}
		
		$caldata = $CALENDAR->calendarArray($_GET[m],$_GET[y]);
		$calendar_name = $CALENDAR->returnCalendarTitle();
		if(!empty($calendar_name)){
			$smarty->assign('calendar_name',$calendar_name);
		}
		
		
		foreach($caldata as $tmp){
			if($tmp[data]){
				$check[]=1;	
			}
		}
		
		if(!$check){
			$smarty->assign('empty',1);
		}
		
		
		$smarty->assign('caldata',$caldata);
		
//		$header_image = array('masthead_on.gif','masthead.gif');
//		$smarty->assign('header_image',$header_image);
		
		$LGCLASS->page_title="Wink in Kansas City";
		$LGCLASS->tpl_header_file='_header.tpl'; // This is the top header
		$LGCLASS->root_tpl='_main_template.tpl'; // This is the main template where everything gets put together
		$LGCLASS->tpl_footer_file='_footer.tpl'; // Footer file
		$LGCLASS->css_file_array[]='site.css'; // Stylesheet that needs to be added to the header.
		$LGCLASS->javascript_file_array[]='images.js';
		$LGCLASS->javascript_file_array[]='/common/javascript.js';
		$LGCLASS->page_tpl='_calendar_template.tpl'; // This current's page template file.
		$LGCLASS->pageConstructor();
	}
	
	default_page();

}
?>