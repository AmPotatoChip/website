<?

CLASS CMS_CALENDAR{
	var $calendar_id;
	var $postparams;
	var $usermessage;

	
	// This function adds slashes to the post data.
	function normalizePost(){
		$p = $this->postparams;
		foreach($p as $key=>$value){
			if(!is_array($value)){
			$p[$key]=addslashes($value);	
			}
		}	
		$this->postparams='';
		$this->postparams=$p;
	}
	
	function returnCalendarName(){
		global $dbconn;
		if(!empty($this->calendar_id)){
			$calid=$this->calendar_id;
			$sql = "SELECT calendar_name FROM cms_calendar WHERE id='$calid'";	
			$result = $dbconn->Execute($sql);
			$calendar_name = $result->Fields('calendar_name');
			return $calendar_name;
		}
	}
	
	function calendarEntryControl(){
		global $dbconn;
		$this->normalizePost();
		$params = $this->postparams;
//		$params[description]=str_replace("\n","<br/>",$params[description]);
		
		if($params[id]){
			// edit entrt
			
			// this updates the calendar data entry, need to make sure that it is rewritten.
			
			$sql = "UPDATE cms_calendar_data SET `date`='$params[date]',title='$params[title]',description='$params[description]',venue='$params[venue]',venue_address='$params[venue_address]',venue_city='$params[venue_city]',venue_state='$params[venue_state]',venue_zip='$params[venue_zip]',venue_phone='$params[venue_phone]',venue_url='$params[venue_url]',venue_other_url='$params[other_url]',related_articles='$params[related_articles]' WHERE id='$params[id]'";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$this->usermessage = "($params[title]) has been updated";
			
		}else{
			// new entry
			if(!$params[calendars]){
				$params[calendars][0]=$params[calid];
			}
			
			switch($params[calendar_type]){
				case 'multiple':
					list($start_year,$start_month,$start_day)=explode("-",$params[date]);
					list($end_year,$end_month,$end_day)=explode("-",$params[todate]);
					
					$start_timestamp = mktime(12,00,00,$start_month,$start_day,$start_year);
					$end_timestamp = mktime(12,00,00,$end_month,$end_day,$end_year);
					
					$time_betweend = $end_timestamp-$start_timestamp;
					
					$days_between = floor($time_betweend/86400)+1;
					
					if($days_between>=1){
						for($x=0;$x<$days_between;$x++){
							$date = date("Y-m-d",mktime(0,0,0,$start_month,$start_day+$x,$start_year));
							$sql = "INSERT INTO cms_calendar_data (`date`,title,description,venue,venue_address,venue_city,venue_state,venue_zip,venue_phone,venue_url,venue_other_url,related_articles,created)
					VALUES ('$date','$params[title]','$params[description]','$params[venue]','$params[venue_address]','$params[venue_city]','$params[venue_state]','$params[venue_zip]','$params[venue_phone]','$params[venue_url]','$params[other_url]','$params[related_articles]',NOW())";
							$result=$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
							$calendar_data_id = $dbconn->Insert_Id();
							
							foreach($params[calendars] AS $calid){
							$sql = "INSERT INTO cms_calendar_connection (calendar_data_id,calendar_id) VALUES ('$calendar_data_id','$calid')";
							$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
							
							}
						}
						$this->usermessage = "($params[title]) has been added to the calendar";
					}
					
					
					
					
				break;
				case 'single':
						$sql = "INSERT INTO cms_calendar_data (`date`,title,description,venue,venue_address,venue_city,venue_state,venue_zip,venue_phone,venue_url,venue_other_url,related_articles,created)
						VALUES ('$params[date]','$params[title]','$params[description]','$params[venue]','$params[venue_address]','$params[venue_city]','$params[venue_state]','$params[venue_zip]','$params[venue_phone]','$params[venue_url]','$params[other_url]','$params[related_articles]',NOW())";
						$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
						$calendar_data_id = $dbconn->Insert_Id();
					foreach($params[calendars] AS $calid){
						$sql = "INSERT INTO cms_calendar_connection (calendar_data_id,calendar_id) VALUES ('$calendar_data_id','$calid')";
						$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
					}
					
					$this->usermessage = "($params[title]) has been added to the calendar(s)";
				break;
			}
			
		}
	}
	
	function calendarControl(){
		global $dbconn;	
		$this->normalizePost($this->postparams);
		$params = $this->postparams;
		// there are two things that can happen here!
		// 1 is we add a new calendar to the db.
		// 2 we are updating a calendar name.
		if($params[calendar_id]){
			// means this is an update because it has calendar_id in the post vars.	
			$sql = "UPDATE cms_calendar SET calendar_name='$params[calendar_name]' WHERE id='$params[calendar_id]'";
			$dbconn->Execute($sql);
			$msg = "Your calendar has been updated";
		}else{
			// this is a new entry into the database.
			$sql = "INSERT INTO cms_calendar (calendar_name,created) VALUES ('$params[calendar_name]',NOW())";
			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$msg = "Your new calendar (<b>$params[calendar_name]</b>) has been added";
		}
		header("location:calendar.php?msg=$msg");
		exit;
	}
	
	function assignCalendarCategories(){
		global $dbconn,$smarty;
		$sql = "SELECT * FROM cms_calendar ORDER BY created DESC,calendar_name";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		while(false!=($row=$result->FetchRow())){
			$data[]=$row;
		}
		
		if(!empty($data)){
			$smarty->assign('calendar_categories',$data);	
		}
	}
	
	function deleteCalendar(){
		global $dbconn;
		if(!empty($this->calendar_id)){
			$calid = $this->calendar_id;
			$sql[]="DELETE FROM cms_calendar WHERE id='$calid'";
			$sql[]="DELETE FROM cms_calendar_data WHERE calendar_id='$calid'";
			foreach($sql as $query){
				$dbconn->Execute($query);
			}
		}
	}
	
	function calendarArray($month,$year){
		$first_day=1;
		$last_day = date("d",mktime(12,00,00,$month+1,1-1,$year));

		$month_begin = $this->calcCalendarBegin($month,$year);	
		
		$y=0;
		for($x=$first_day;$x<$last_day+1;$x++){
			$data[$y][down]=$x;	
			$data[$y][dow] = strtolower(date("D",mktime(12,00,00,$month,$x,$year)));
			$y++;
		}
		
		if(is_array($month_begin)){
			$output = array_merge($month_begin,$data);
		}else{
			$output = $data;	
		}
		
		$calendar_content = $this->calendarContent($month,$year);
		
		
		foreach($output AS $key=>$content){
			if(isset($calendar_content[$content[down]])){
				$output[$key][data]=$calendar_content[$content[down]];
			}	
		}
		
		
		return $output;
	}
	
	function calendarContent($month,$year){
		global $dbconn;
		$calendar_id=$this->calendar_id;
		$sql ="SELECT t1.*,day(t1.`date`) AS `day` FROM cms_calendar_data AS t1,cms_calendar_connection AS t2 
		WHERE t2.calendar_id=$calendar_id AND t2.calendar_data_id=t1.id AND MONTH(t1.`date`)=$month AND YEAR(t1.`date`)=$year
ORDER BY t1.`date` ASC";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg().'<br/>'.$sql);
		
		while(false!=($row=$result->FetchRow())){
			$data[$row[day]][]=$row;
		}
		
		if(!empty($data)){
			foreach($data AS $day=>$content_array){
				foreach($content_array AS $calendar_array){
					$this->placeMedia($calendar_array[description]);
					$output[$day][]=$calendar_array;
					
				}
			}	
		}
		
		if($output){
			foreach($output AS $key=>$day){
			foreach($day AS $xkey=>$entry){
				if(!empty($entry[related_articles])){
					$output[$key][$xkey][related_array]=explode(",",$output[$key][$xkey][related_articles]);
				}
			}	
			
			}
		}
		return $output;
	}
	
	
	function calcCalendarBegin($month,$year){
		$s[0]='Sun';
		$s[1]='Mon';
		$s[2]='Tue';
		$s[3]='Wed';
		$s[4]='Thu';
		$s[5]='Fri';
		$s[6]='Sat';
		
		$start_dow = date("D",mktime(12,00,00,$month,1,$year));
		
		$z=array_flip($s);
		$end=$z[$start_dow];
		for($x=0;$x<$end;$x++){
			$data[$x][dow]=$s[$x];
		}
		
		return $data;
	}
	
	function collectCalendarDataForUpdate(){
		if($this->calendar_id){
			global $dbconn;
			$calendar_id = $this->calendar_id;
			$sql = "SELECT t1.* FROM cms_calendar_data AS t1,
			cms_calendar_connection AS t2 
			WHERE t2.calendar_id='$calendar_id' 
			AND t2.calendar_data_id=t1.id 
			ORDER BY t1.`date`";
			
//			$sql = "SELECT * FROM cms_calendar_data WHERE calendar_id='$calendar_id' AND `date`>=now() ORDER BY `date`";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			while(false!=($row=$result->FetchRow())){
				$data[]=$row;
			}
			return $data;
		}	
	}
	
	function loadCalendarDetailData($id){
		global $dbconn;
		$sql = "SELECT * FROM cms_calendar_data WHERE id='$id' LIMIT 0,1";	
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$row=$result->FetchRow();
		$data[id]=$id;
		$data[calendar_type]='single';
		$data[date]=$row[date];
		$data[title]=$row[title];
		$data[description]=$row[description];
		$data[venue]=$row[venue];
		$data[venue_address]=$row[venue_address];
		$data[venue_city]=$row[venue_city];
		$data[venue_state]=$row[venue_state];
		$data[venue_zip]=$row[venue_zip];
		$data[venue_phone]=$row[venue_phone];
		$data[venue_url]=$row[venue_url];
		$data[other_url]=$row[venue_other_url];
		$data[related_articles]=$row[related_articles];
		
		$data[description]=str_replace("<br/>","\n",$data[description]);
		return $data;
	}
	
	function deleteCalendarEntry($calendar_entry_id,$calendar_id){
		global $dbconn;
		$sql = "DELETE FROM cms_calendar_connection WHERE calendar_data_id='$calendar_entry_id' AND calendar_id='$calendar_id'";
		$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	}
	
	function returnCalendarTitle(){
		global $dbconn;
		$calendar_id = $this->calendar_id;
		if(!empty($calendar_id)){
			$sql = "SELECT calendar_name FROM cms_calendar WHERE id='$calendar_id'";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$calendar_name = $result->Fields('calendar_name');
			return $calendar_name;
		}
		
	}
	
	function placeMedia(&$content){
	global $dbconn;
	$placing = array('L','R','C');
	$matches = array();
	
	$replace_content = str_replace("}","}\n--",$content);
	$nameDopperPattern ="/(\{MEDIA )(.*)(.)(\})/e";
	preg_match_all($nameDopperPattern,$replace_content,$matches,PREG_SET_ORDER);

	if(!empty($matches)){
		foreach($matches as $tmp){
			if(in_array($tmp[3],$placing)){
				$content = str_replace("$tmp[0]",buildMediaHtml($tmp[2],$tmp[3]),$content);	
			}else{
				$tmp[2]=$tmp[2].$tmp[3];
				$content = str_replace("$tmp[0]",buildMediaHtml($tmp[2]),$content);	
			}
		}
	}
	}
	
	function buildMediaHtml($media_id,$align=null){
	global $dbconn;
	$sql = "SELECT * FROM cms_media_lib WHERE id='$media_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$media = $result->FetchRow();
	
	
	switch($media[media_category]){
		case 'images':
//			$output="<div id=\"float\">
//			<img src=\"".URL."media_vault/$media[media_category]/$media[file_name]\" alt=\"$media[description]\" title=\"$media[description]\">
//			<div class=\"photo_caption\">above: $media[caption]</div>\n</div>\n<br clear=all>";

			if($align!=null){
				
				switch ($align){
					case 'L':
						$output="<div style=\"float:left;padding:0 10 0 0px;\"><table border=\"0\" cellpadding=\"3\" cellspacing=\"0\"><tr style=\"background-color:#EFEFEF;\"><td><img src=\"".URL."media_vault/$media[media_category]/$media[file_name]\"></td></tr>";
						
						if($media[caption]!=''){
							$output.="<tr style=\"background-color:#EFEFEF;\"><td id=\"caption\">above: $media[caption]</td></tr>";
						}
						$output.="</table></div>";
					break;
					case 'R':
						$output="<div style=\"float:right;padding:0 0 0 10px;\"><table border=\"0\" cellpadding=\"3\" cellspacing=\"0\"><tr style=\"background-color:#EFEFEF;\"><td><img src=\"".URL."media_vault/$media[media_category]/$media[file_name]\"></td></tr>";
						
						if($media[caption]!=''){
							$output.="<tr style=\"background-color:#EFEFEF;\"><td id=\"caption\">above: $media[caption]</td></tr>";
						}
						$output.="</table></div>";
					break;	
					case 'C':
						$output="<div style=\"float:center;padding:0 0 0 0px;\"><table border=\"0\" cellpadding=\"3\" cellspacing=\"0\"><tr style=\"background-color:#EFEFEF;\"><td><img src=\"".URL."media_vault/$media[media_category]/$media[file_name]\"></td></tr>";
						
						if($media[caption]!=''){
							$output.="<tr style=\"background-color:#EFEFEF;\"><td id=\"caption\">above: $media[caption]</td></tr>";
						}
						$output.="</table></div>";
					break;
					
				}
				
				
				
			}else{
			
				$output="<div style=\"float:left;padding:0 10 0 0px;\"><table border=\"0\" cellpadding=\"3\" cellspacing=\"0\"><tr style=\"background-color:#EFEFEF;\"><td><img src=\"".URL."media_vault/$media[media_category]/$media[file_name]\" alt=\"$media[description]\" title=\"$media[description]\"></td></tr>";
				if($media[caption]!=''){
					$output.="<tr style=\"background-color:#EFEFEF;\"><td id=\"caption\">above: $media[caption]</td></tr>";
				}
				$output.="</table></div>";
			}
			
		break;
		case 'movies';
			$output = "<img src=\"/images/video_icon.gif\" id=\"icon\">&nbsp;<a href=\"".URL."media_vault/$media[media_category]/$media[file_name]\" target=\"_blank\">$media[name]</a>";
		break;
		case 'audio':
			$output = "<img src=\"/images/audio_icon.gif\" id=\"icon\">&nbsp;<a href=\"".URL."media_vault/$media[media_category]/$media[file_name]\" target=\"_blank\">$media[name]</a>";
		break;
		case 'documents':
			$output = "<img src=\"/images/document_icon.gif\" id=\"icon\">&nbsp;<a href=\"".URL."media_vault/$media[media_category]/$media[file_name]\" target=\"_blank\">$media[name]</a><br clear=\"all\">";
		break;	
	}
	
	return $output;
}

function getSingleDayEntry($id,$calendar_id){
	global $dbconn;
	$sql = "SELECT `date` FROM cms_calendar_data WHERE id='$id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$entry_date = $result->Fields('date');
	
	$sql = "SELECT t1.* FROM cms_calendar_data AS t1,cms_calendar_connection AS t2 WHERE 
	t1.`date`='$entry_date' AND t2.calendar_id='$calendar_id' AND t2.calendar_data_id=t1.id";
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	while(false!=($row=$result->FetchRow())){
		$this->placeMedia($row[description]);
		$tmp_date = explode(" ",$row[date]);
		$row[date]=$tmp_date[0];
		$data[]=$row;
	}
	return $data;
}

function getAllCalendars(){
	global $dbconn;
	$sql = "SELECT id,calendar_name FROM cms_calendar ORDER BY calendar_name";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x]['id']=$row[id];
		$data[$x]['name']=$row[calendar_name];
		$x++;
	}
	if(count($data)>1 && !empty($data)){
		return $data;
	}
}

function calendarArticleInsert(){
	if($this->calendar_id){
		global $dbconn;
		$calendar_id=$this->calendar_id;
		$sql ="SELECT t1.*,day(t1.`date`) AS `day` FROM cms_calendar_data AS t1,cms_calendar_connection AS t2 
		WHERE t2.calendar_id=$calendar_id AND t2.calendar_data_id=t1.id AND t1.`date`>=NOW() ORDER BY t1.`date` ASC";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg().'<br/>'.$sql);
		
		while(false!=($row=$result->FetchRow())){
			$data[$row[day]][]=$row;
		}
		
		if(!empty($data)){
			foreach($data AS $day=>$content_array){
				foreach($content_array AS $calendar_array){
					$this->placeMedia($calendar_array[description]);
					$output[$day][]=$calendar_array;
					
				}
			}	
		}
		
		if($output){
			foreach($output AS $key=>$day){
			foreach($day AS $xkey=>$entry){
				if(!empty($entry[related_articles])){
					$output[$key][$xkey][related_array]=explode(",",$output[$key][$xkey][related_articles]);
				}
			}	
			
			}
		}
		return $output;
	}
}

function returnCalendarArrayForBulkEmailMessage($calendar_id,$max=false){
	global $dbconn;
	
	$sql = "SELECT t1.* FROM cms_calendar_data AS t1,cms_calendar_connection AS t2 WHERE t2.calendar_id='$calendar_id' 
	AND t2.calendar_data_id=t1.id AND t1.`date`>=DATE_FORMAT(NOW(),'%Y-%m-%d') ORDER BY t1.`date` ASC LIMIT 0,$max";
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg().'<br/>'.$sql);
	while(false!=($row=$result->FetchRow())){
		if(!empty($row[related_articles])){
			$row[related_articles] = explode(",",$row[related_articles]);
		}
		$data[]=$row;
	}
	
	return $data;
}

function calendarMailOut($params){
	global $dbconn;
	require_once('phpmailer/class.phpmailer.php');
	
	$MAIL = new PHPMailer();
	$MAIL->IsHTML(true);
	$MAIL->FromName="$params[from_name]";
	$MAIL->From="$params[from_email]";
	$MAIL->Subject = 'Present Magazine - Article Forward by '.$params[from_name];
	
	$calendar_data = $this->getSingleDayEntry($params[calentryid],$params[calid]);
	$tmp_rcpt=explode(",",$params[rcpt]);
	
	foreach($tmp_rcpt as $to_email){
		$MAIL->AddAddress($to_email,'');
	}
	
	$calendar_html=$this->buildCalendarHtmlMailer($calendar_data);
	$MAIL->Body=$calendar_html;
	
	$MAIL->Send() or die($MAIL->ErrorInfo);
}

function buildCalendarHtmlMailer($input){
	if(!empty($input)){
		$html="<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" style=\"border:1px solid #25588B;\" width=\"600\">\n";
		foreach($input AS $c){
			$html.="<tr>";
			$html.="<td style=\"background-color:#25588B;font-size:20px;color:#FFFFFF;\">$c[title]</td>\n";
			$html.="</tr>";
			$html.="<tr>";
			$html.="<td align=\"right\"><b>$c[date]</b></td>\n";
			$html.="</tr>";
			$html.="<tr>";
			$html.="<td style=\"text-align:justify;\">$c[description]</td>\n";
			$html.="</tr>";
			if($c[venue]){
				$html.="<tr>";
				$html.="<td style=\"font-size:18px;\">$c[venue]</td>\n";
				$html.="</tr>";
			}
			if($c[venue_address]){
				$html.="<tr>";
				$html.="<td style=\"padding-top:10px;\">$c[venue_address]<br/>";
				if($c[venue_city]){
					$html.="$c[venue_city], ";
				}
				if($c[venue_state]){
					$html.="$c[venue_state] ";
				}
				if($c[venue_zip]){
					$html.="$c[venue_zip]";
				}
				$html.="</td>\n";
				$html.="</tr>\n";
			}
			
			
			if($c[venue_phone]){
				$html.="<tr>\n";
				$html.="<td>Phone: $c[venue_phone]</td>\n";
				$html.="</tr>\n";
			}
			if($c[venue_url]){
				$html.="<tr>\n";
				$html.="<td>Website: <a href=\"$c[venue_url]\">$c[venue_url]</a></td>\n";
				$html.="</tr>\n";
			}
			if($c[venue_other_url]){
				$html.="<tr>\n";
				$html.="<td>Website: <a href=\"$c[venue_other_url]\">$c[venue_other_url]</a></td>\n";
				$html.="</tr>\n";
			}
			if($c[related_articles]){
				$tmp_article_id = explode(",",$c[related_articles]);
				$html.="<tr>\n";
				$html.="<td>\n";
				foreach($tmp_article_id AS $aid){
					$html.="<li><a href=\"".URL."full_content.php?article_id=$aid&full=yes&pbr=1\">More Info</a></li>\n";
				}
				$html.="</td>\n";
				$html.="</tr>\n";
			}
		}
		$html.="</table>";
		return $html;
	}
}



}


?>