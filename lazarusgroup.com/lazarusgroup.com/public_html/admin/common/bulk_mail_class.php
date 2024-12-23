<?
require '/var/www/sites/mfm-kc.com/public_html/Mailgun/vendor/autoload.php';
use Mailgun\Mailgun;
class BULK_MAIL_CLASS{

	var $ogData;
	var $doWhat;
	var $user_message;
	var $attachment_allow_type = array('txt','doc','mp3','mov','pdf');
	var $template_file;
	var $template_file_data;
	var $message_id;
	var $message_preview_data;
	
	function storeBulkMailData(){
		global $dbconn;
		$from_name = addslashes($this->ogData[post][from_name]);
		$from_email = addslashes($this->ogData[post][from_email]);
		$to_name = addslashes($this->ogData[post][to_name]);
		$subject = addslashes($this->ogData[post][subject]);
		$message_text = addslashes($this->ogData[post][message_text]);
		$files = $this->ogData[files];
		
		$tmp = $this->storeAttachment($files[attachment1]);
		$attachment1=$tmp->new;
		$attachment1_name=$tmp->old;
		unset($tmp);
		
		$tmp=$this->storeAttachment($files[attachment2]);
		$attachment2=$tmp->new;
		$attachment2_name=$tmp->old;
		unset($tmp);
		
		$tmp=$this->storeAttachment($files[attachment3]);
		$attachment3=$tmp->new;
		$attachment3_name=$tmp->old;
		unset($tmp);		
		
		$admin_user_id = $_SESSION[admin_user_id];
		
		if($this->ogData[post][message_id]){
			// means this is an update.
			$sql = "UPDATE ms_messages SET subject='$subject',from_name='$from_name',from_email='$from_email',
			to_name='$to_name',message_text='$message_text',author_id='$admin_user_id' 
			WHERE id='".$this->ogData[post][message_id]."'";
			
			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			
			if($attachment1!=''){
				$sql = "UPDATE ms_messages SET attachment1='$attachment1',attachment1_name='$attachment1_name'
				WHERE id='".$this->ogData[post][message_id]."'";
				$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			}
			
			if($attachment2!=''){
				$sql = "UPDATE ms_messages SET attachment2='$attachment2',attachment2_name='$attachment2_name'
				WHERE id='".$this->ogData[post][message_id]."'";
				$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			}
			
			if($attachment3!=''){
				$sql = "UPDATE ms_messages SET attachment3='$attachment3',attachment3_name='$attachment3_name'
				WHERE id='".$this->ogData[post][message_id]."'";
				$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			}
			$this->user_message='You message has been updated';
		}else{
		
			$sql = "INSERT INTO ms_messages (subject,from_name,from_email,to_name,message_text,author_id,created,
		attachment1,attachment1_name,attachment2,attachment2_name,attachment3,attachment3_name)
		 VALUES ('$subject','$from_name','$from_email','$to_name','$message_text','$admin_user_id',NOW(),
		 '$attachment1','$attachment1_name','$attachment2','$attachment2_name','$attachment3','$attachment3_name')";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$this->user_message='Your new Mail piece has been added to the system';
		}
	}
	
	function storeAttachment($tmp_data_array){
		global $dbconn;
		$file_name = $tmp_data_array[name];
		$error = $tmp_data_array[error];
		$tmp_file_location = $tmp_data_array[tmp_name];
		
		$tmp_ext = explode(".",$file_name);
		$ext = $tmp_ext[1];
		unset($tmp_ext);
		if(in_array($ext,$this->attachment_allow_type) && $error==0){
			// file is allowed and will uploaded.
			$fp = fopen($tmp_file_location,"r");
			$file_content = fread($fp,filesize($tmp_file_location));
			$new_file_name = $this->createMicrotimeName().'.'.$ext;
			$new_file_loc = SITE_PATH.'bulkmail/attachment_archive/'.$new_file_name;
			fclose($fp);
			$fp=fopen($new_file_loc,"w");
			fwrite($fp,$file_content);
			fclose($fp);
			$data->new=$new_file_name;
			$data->old=$file_name;
			return $data;
		}
	}
	
	function createMicrotimeName(){
		$microtime = microtime();
		$tmp = explode(" ",$microtime);
		$output = number_format($tmp[0]+$tmp[1],5,'.','.');
		$output = str_replace(".",'',$output);
		return $output;
	}
	
	function messagePreview(){
		global $dbconn,$smarty,$smarty_vars;
		if(!empty($this->message_id) && !empty($this->template_file)){
			// only if both vars are passed to the page will this work.
			// have to have a message id as well as the template file that needs to be used.	
			$this->loadTemplateFile($this->template_file);
			$data = $this->loadMessage($_GET[message_id]);
			
			$preview_data = $this->template_file_data;
			
			$preview_data=str_replace('<!--BODY-->',$data[message_text],$preview_data);
			$this->placeMedia($preview_data);
			
			$this->message_preview_data=$preview_data;
		}
	}
	
	function loadMessage($message_id){
		global $dbconn;
		$sql = "SELECT * FROM ms_messages WHERE id='$message_id' LIMIT 0,1";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$row = $result->FetchRow();
		$data[subject]=$row[subject];
		$data[from_name]=$row[from_name];
		$data[from_email]=$row[from_email];
		$data[to_name]=$row[to_name];
		$data[message_text]=$row[message_text];
		
		if($row[attachment1]!=''){
			$data[attachment][]="$row[attachment1]|$row[attachment1_name]";	
		}
		if($row[attachment2]!=''){
			$data[attachment][]="$row[attachment2]|$row[attachment2_name]";	
		}
		if($row[attachment3]!=''){
			$data[attachment][]="$row[attachment3]|$row[attachment3_name]";	
		}
		
		return $data;
		
	}
	
	function loadTemplateFile($template_file){
		$template_path = SITE_PATH.'bulkmail/templates/';
		$file = $template_path.$template_file;
		$fp = fopen($file,"r") or die('Can not open template file');
		$template_html = fread($fp,filesize($file));
		fclose($fp);
		$this->template_file_data=$template_html;
	}
	
	function placeMedia(&$content){
	global $dbconn;
	$placing = array('L','R','C');
	$matches = array();
	
	$replace_content = str_replace("}","}\n--",$content);
	$nameDopperPattern ="/(\{MEDIA )(.*)(.)(\})";
	@preg_match_all($nameDopperPattern,$replace_content,$matches,PREG_SET_ORDER);

	if(!empty($matches)){
		foreach($matches as $tmp){
			if(in_array($tmp[3],$placing)){
				$content = str_replace("$tmp[0]",$this->buildMediaHtml($tmp[2],$tmp[3]),$content);	
			}else{
				$tmp[2]=$tmp[2].$tmp[3];
				$content = str_replace("$tmp[0]",$this->buildMediaHtml($tmp[2]),$content);	
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
			if($align!=null){
				
				switch ($align){
					case 'L':
						$output="<div style=\"float:left;padding:0 10 0 0px;\"><table border=\"0\" cellpadding=\"3\" cellspacing=\"0\"><tr style=\"background-color:#4F4A4A;\"><td><img src=\"".URL."media_vault/$media[media_category]/$media[file_name]\"></td></tr>";
						
						if($media[caption]!=''){
							$output.="<tr style=\"background-color:#4F4A4A;\"><td  style=\"font-size:12px;color:#FFFFFF;\">$media[caption]</td></tr>";
						}
						$output.="</table></div>";
					break;
					case 'R':
						$output="<div style=\"float:right;padding:0 0 0 10px;\"><table border=\"0\" cellpadding=\"3\" cellspacing=\"0\"><tr style=\"background-color:#4F4A4A;\"><td><img src=\"".URL."media_vault/$media[media_category]/$media[file_name]\"></td></tr>";
						
						if($media[caption]!=''){
							$output.="<tr style=\"background-color:#4F4A4A;\"><td  style=\"font-size:12px;color:#FFFFFF;\">$media[caption]</td></tr>";
						}
						$output.="</table></div>";
					break;	
					case 'C':
						$output="<div style=\"float:center;padding:0 0 0 0px;\"><table border=\"0\" cellpadding=\"3\" cellspacing=\"0\"><tr style=\"background-color:#4F4A4A;\"><td><img src=\"".URL."media_vault/$media[media_category]/$media[file_name]\"></td></tr>";
						
						if($media[caption]!=''){
							$output.="<tr style=\"background-color:#4F4A4A;\"><td style=\"font-size:12px;color:#FFFFFF;\">$media[caption]</td></tr>";
						}
						$output.="</table></div>";
					break;
					
				}
				
				
				
			}else{
			
				$output="<div style=\"float:left;padding:0 10 0 0px;\"><table border=\"0\" cellpadding=\"3\" cellspacing=\"0\"><tr style=\"background-color:#4F4A4A;\"><td><img src=\"".URL."media_vault/$media[media_category]/$media[file_name]\" alt=\"$media[description]\" title=\"$media[description]\"></td></tr>";
				if($media[caption]!=''){
					$output.="<tr style=\"background-color:#4F4A4A;\"><td style=\"font-size:12px;color:#FFFFFF;\">$media[caption]</td></tr>";
				}
				$output.="</table></div>";
			}
			
		break;
		case 'movies';
			$output = "<img src=\"".URL."images/video_icon.gif\" id=\"icon\">&nbsp;<a href=\"".URL."media_vault/$media[media_category]/$media[file_name]\" target=\"_blank\">$media[name]</a>";
		break;
		case 'audio':
			$output = "<img src=\"".URL."images/audio_icon.gif\" id=\"icon\">&nbsp;<a href=\"".URL."media_vault/$media[media_category]/$media[file_name]\" target=\"_blank\">$media[name]</a>";
		break;
		case 'documents':
			$output = "Document:<a href=\"".URL."media_vault/$media[media_category]/$media[file_name]\" target=\"_blank\">$media[name]</a><br clear=\"all\">";
		break;	
	}
	
	return $output;
}

function testGroupController($params,$update=false){
	global $dbconn;
	$group_name = addslashes($params[group_name]);
	$tmp_emails_string = $params[emails];
	
	$tmp_email = explode(",",$tmp_emails_string);
	
	$emails=array();
	
	foreach($tmp_email as $email){
		if($this->checkEmail($email)){
			$emails[]=$email;	
		}	
	}
	
	$email_count = count($emails);
	
	
	switch($update){
		case true:
			$group_id = $params[group_id];
			if($email_count>0){
				unset($email);
				foreach($emails as $email){
					$sql_emails_insert.=$email.',';
				}
				$sql_emails_insert=substr($sql_emails_insert,0,-1);
				
				$sql = "UPDATE ms_test_group SET name='$group_name',emails='$sql_emails_insert',email_count='$email_count' 
				WHERE id='$group_id'";
				
				$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
				$msg = "The test group has been updated";
			}else{
				$msg = "The email that you entered is not valid";
			}
		break;
		case false:
			if($email_count>0){
				unset($email);
				foreach($emails as $email){
					$sql_emails_insert.=$email.',';
				}
				$sql_emails_insert=substr($sql_emails_insert,0,-1);
				
				$sql = "INSERT INTO ms_test_group (name,emails,email_count) VALUES ('$group_name','$sql_emails_insert','$email_count')";
				$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
				$msg = "Your new test group has been added";
			}else{
				$msg = "The email that you entered is not valid";
			}
		break;	
		
	}
	
	$this->user_message=$msg;
	
		
}

function checkEmail($email){
	// checks proper syntax
	if( !preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $email)){
		return false;
	}else{
		return true;
	}
}

function loadTestGroupDataForUpdate($test_group){
	global $dbconn;
	$sql = "SELECT * FROM ms_test_group WHERE id='$test_group'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$data=$result->FetchRow();
	
	$output[group_id]=$data[id];
	$output[group_name]=$data[name];
	$output[emails]=$data[emails];
	
	$data=$output;
	if(!empty($data)){
		return $data;	
	}
}

function sendBulkMail($params,$type=test){
	global $dbconn,$smarty;

	require_once('phpmailer/class.phpmailer.php');
	$MAIL = new PHPMailer();
	
/*	$MAIL->isSMTP = true;
	$MAIL->Host = 'smtp.mailgun.org';
	$MAIL->SMTPAuth = 'smtp.mailgun.org';
	$MAIL->Username = 'postmaster@mg.kansascityjazzcalendar.org';
	$MAIL->Password = '47662319decb7cca8ab62c6524acac46-c322068c-819c63e4';
*/	
	
	
	
	switch($type){
		case 'test':
			

			# Instantiate the client.
			$mgClient = new Mailgun('key-4n3zv64ki8d6-lbd0fkhgv2j4o073ig4');
			$domain = "mg.lazarusgroup.com";
				
			
			
			$template_file = $params[template];
			$message_id = $params[message_id];
			$test_email_group_id = $params[test_email_group];
			
			$sql = "SELECT emails FROM ms_test_group WHERE id='$test_email_group_id'";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$emails_string = $result->Fields('emails');
			$emails = explode(",",$emails_string);
			
			// load message data into variables.
			$message_data = $this->loadMessage($message_id);
			if($message_data[attachment]){
				$attachment = true;	
			}
			
			// load template data into variable.
			$this->loadTemplateFile($template_file);
			$template_data = $this->template_file_data;
			
			$message = $message_data[message_text];
			
			$this->placeMedia($message);
			
			$body = str_replace("<!--BODY-->",$message,$template_data);
			
			
			$attachment_path = SITE_PATH.'bulkmail/attachment_archive/';
			
			$MAIL->IsHTML(true);
			$MAIL->From=$message_data[from_email];
			$MAIL->FromName=$message_data[from_name];
			$MAIL->Sender=$message_data[from_email];
			$MAIL->Subject="TEST MODE: ".$message_data[subject];
			
			if($attachment){
				foreach($message_data[attachment] as $tmp_attachment){
					$tmp = explode("|",$tmp_attachment);
					$attachment_file = $attachment_path.$tmp[0];	
					$MAIL->AddAttachment($attachment_file,$tmp[1]);
				}
			}
			
			if($message_data[to_name]!=''){
				$to_name=$message_data[to_name];
			}else{
				$to_name='';
			}
			
			foreach($emails as $tmp_email){
				$MAIL->AddAddress($tmp_email,$to_name);
				$MailGunresult = $mgClient->sendMessage($domain, array(
						'from'	=> 'Lazarus Group <newsletter@mg.lazarusgroup.com>',
						'to'	=> "$to_name <$tmp_email>",
						'subject' => "TEST MODE: ".$message_data[subject],
						'html'	=> $body
				));
				
				$msgid = $MailGunresult->http_response_body->id;
				$response_msg = $MailGunresult->http_response_body->message;
				$response_code = $MailGunresult->http_response_code;
				
				
				
				
				
				
			}
			//$MAIL->Body=$body;
			//$MAIL->Send();
			
		break;
		case 'live':
			$template_file = $params[template];
			$message_id = $params[message_id];
			$contact_group_id = $params[contact_group_id];
			if($params[delivery_date]!=''){
				$date = $params[delivery_date];
				if($params[hour]!='' && $params[minute]!='' && $params[dn]!=''){
					if($params[dn]=='pm'){
						$time = ($params[hour]+12).':'.$params[minute].':00';
					}else{
						$time = ($params[hour]).':'.$params[minute].':00';
					}
					
					$delivery_date = $date.' '.$time;
				}else{
					$this->user_message='If you select a delivery date please make sure to select a time as well';
					return false;	
				}
			}else{
				$delivery_date = date("Y-m-d H:i:s",mktime());				
			}
			
			// now we can store the batch in the database.
			$sql = "INSERT INTO ms_batch (template,message_id,contact_group_id,delivery_date,status) VALUES 
			('$template_file','$message_id','$contact_group_id','$delivery_date','waiting')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$this->user_message='Your bulk mail message has been set for delivery';
			return true;
		break;	
	}
		
}

function getBulkMailBatches(){
	global $dbconn;
	$sql = "SELECT t1.id AS batch_id,t1.`status` as `status`,t3.subject,COUNT(t2.id) AS email_count,t1.delivery_date FROM (ms_batch AS t1)
	LEFT JOIN cms_contact_category_connection AS t2 ON (t2.category_id=t1.contact_group_id)
	LEFT JOIN ms_messages AS t3 ON (t1.message_id=t3.id)
	GROUP BY t1.id ORDER BY t1.delivery_date DESC";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x]->batch_id=$row[batch_id];
		$data[$x]->subject=$row[subject];
		$data[$x]->email_count=$row[email_count];
		$data[$x]->delivery_date=$row[delivery_date];
		$data[$x]->status=$row[status];
		$x++;	
	}
	if(!empty($data)){
		return $data;	
	}
	
}
//=====================================================================================================================================
function getBulkMailBatchesReport($batchdata){
	global $dbconn;
	
	$x=0;
	$returndata = array();
	foreach($batchdata as $value){
		
		$data = $this->loadBatchInfo($value->batch_id);
		$returndata[$x]->batch_id = $data['batch_id'];
		$returndata[$x]->message_subject = $data['message_subject'];
		$returndata[$x]->delivery_date = $data['delivery_date'];
		$returndata[$x]->send_count = $data['send_count'];
		$returndata[$x]->open_count = $data['open_count'];
		$returndata[$x]->links = count($data['links']);
		$x++;
	}//close foreach
	return $returndata;
	
	
}//close report
function runCronjob(){
	global $dbconn;
	
	$mgClient = new Mailgun('key-4n3zv64ki8d6-lbd0fkhgv2j4o073ig4');
	$domain = "mg.lazarusgroup.com";
	
	$sql = "SELECT * FROM ms_batch WHERE delivery_date<NOW() and `status`='waiting' LIMIT 0,1";
	$result = $dbconn->Execute($sql);
	$row = $result->FetchRow();
	
	if(empty($row)){
	exit;	
	}
	
	$data[0]->id=$row[id];
	$data[0]->template_file=$row[template];
	$data[0]->message_id=$row[message_id];
	$data[0]->contact_group_id=$row[contact_group_id];
	
	$this->changeBatchStatus($data[0]->id,'in progress');
	
	// the cronjob will only run 0 will ignore if there is more.
	$this->loadTemplateFile($data[0]->template_file);
	$template_file_content = $this->template_file_data;
	$message_data = $this->loadMessage($data[0]->message_id);
	$batch_id = $data[0]->id;
	$group_id = $data[0]->contact_group_id;
	
	
	$sql = "SELECT t1.contact_id AS `contact_id`,t2.email FROM cms_contact_category_connection AS t1
	LEFT JOIN cms_contact_email AS t2 ON (t1.contact_id=t2.contact_id) 
	WHERE t1.category_id='".$data[0]->contact_group_id."'";
	//echo $sql;
	//exit;	
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());

	
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$email_array[$x]->contact_id=$row[contact_id];
		$email_array[$x]->email=$row[email];
		$x++;	
	}
	
	$pre_content = $message_data[message_text];
	$this->placeMedia($pre_content);
	
	$pre_content = $this->collectLinksToReplace($pre_content);
	$pre_content = str_replace("<!--BODY-->",$pre_content,$template_file_content);
	$pre_content = str_replace("<!--SITE_URL-->",URL,$pre_content);
	
	foreach($email_array as $contact_data){
		require_once('phpmailer/class.phpmailer.php');
		$MAIL = new PHPMailer();
		
		// need to add into ms_sent_to table.
		// need to write seperate function that will update.
		$params[batch_id]=$batch_id;
		$params[contact_id]=$contact_data->contact_id;
		$params[email]=$contact_data->email;
		$sent_to_id = $this->controlSentTo($params,'new');
		$params[sent_to_id]=$sent_to_id;
		
		$tmp_body = $pre_content;
		// now we have a sent_to_id and can replace what we need on the template.
		$MAIL->IsHTML(true);
		$MAIL->FromName=$message_data[from_name];
		$MAIL->From=$message_data[from_email];
		$MAIL->Sender=$message_data[from_email];
		$MAIL->Subject=$message_data[subject];
		
		if(!empty($message_data[to_name])){
			$to_name = $message_data[to_name];	
		}else{
			$to_name='';	
		}
		
		if($message_data[attachment]){
			$attachment_path = SITE_PATH.'bulkmail/attachment_archive/';
			foreach($message_data[attachment] AS $tmp_attachment_string){
				$tmp_attachment = explode("|",$tmp_attachment_string);
				$MAIL->AddAttachment($attachment_path.$tmp_attachment[0],$tmp_attachment[1]);
			}
		}
		
		$tmp_body=str_replace("<!--STID-->",$sent_to_id,$tmp_body);
		$tmp_body=str_replace("<!--CONTACT_ID-->",$contact_data->contact_id,$tmp_body);
		$tmp_body=str_replace("<!--GROUP_ID-->",$group_id,$tmp_body);
		
		
		$pixel = $this->placePixel($sent_to_id);
		
		$tmp_body=$tmp_body.$pixel;
		
		
//======================convert to mailgun
		if (filter_var($contact_data->email, FILTER_VALIDATE_EMAIL)) {
			//echo "Email address '$email_a' is considered valid.\n";
			$MailGunresult = $mgClient->sendMessage($domain, array(
					'from'	=> 'Lazarus Group <newsletter@mg.lazarusgroup.com>',
					'to'	=> "$to_name <$contact_data->email>",
					'subject' => $message_data[subject],
					'html'	=> $tmp_body
			));
			
			$msgid = $MailGunresult->http_response_body->id;
			$response_msg = $MailGunresult->http_response_body->message;
			$response_code = $MailGunresult->http_response_code;
				
			$this->controlSentTo($params,$response_msg);
		}		

	}
	$this->changeBatchStatus($batch_id,'sent');
	exit;
}

function controlSentTo($params,$type){
	global $dbconn;
	switch($type){
		case 'new':
			$sql = "INSERT INTO ms_sent_to (batch_id,email,contact_id,`status`) VALUES ('$params[batch_id]','$params[email]','$params[contact_id]','not')";
			$dbconn->Execute($sql);
			$sent_to_id = $dbconn->Insert_ID();
			return $sent_to_id;
		break;
		case 'sent':
			$sql = "UPDATE ms_sent_to SET `status`='sent',sent_date=NOW() WHERE id=$params[sent_to_id]";
			$dbconn->Execute($sql);
		break;
		case 'error':
			$sql = "UPDATE ms_sent_to SET `status`='error' WHERE id=$params[sent_to_id]";
			$dbconn->Execute($sql);
		break;
	}	
}

function collectLinksToReplace($txtString){
global $dbconn;
$original_content = $txtString;

$pattern = "/(href=\")(.+?)(\")/e";
preg_match_all($pattern,$txtString,$matches,PREG_SET_ORDER);
	foreach($matches AS $change_link){
		$sql = "INSERT INTO ms_link (url) VALUES ('$change_link[2]')";
		$dbconn->Execute($sql);
		$sql = "SELECT LAST_INSERT_ID() AS link_id";
		$result = $dbconn->Execute($sql);
		$link_id = $result->Fields('link_id');
		$data[$link_id]=$change_link[2];
	}

	$change_to_link = URL.'jumper.php';
	if(!empty($data)){
		foreach ($data AS $link_id=>$link){
			$replace_with = "href=\"$change_to_link?lid=$link_id&stid=<!--STID-->\"";
			$search_for = "href=\"$link\"";
			$original_content=str_replace($search_for,$replace_with,$original_content);
		}
	}

	return $original_content;
}

function changeBatchStatus($batch_id,$status){
	global $dbconn;
	switch($status){
		case 'in progress':
			$sql = "UPDATE ms_batch SET `status`='in progress' WHERE id='$batch_id'";
			$dbconn->Execute($sql);
		break;
		case 'sent':
			$sql = "UPDATE ms_batch SET `status`='sent',delivery_stamp=NOW() WHERE id='$batch_id'";
			$dbconn->Execute($sql);
		break;	
	}
}

function placePixel($sent_to_id){
	$link = "<img src=\"".URL."pixel.php?stid=".$sent_to_id."\" width=\"0\" height=\"0\">";
	return $link;
}

function pixelRecorder($sent_to_id){
	global $dbconn;
	$sql = "SELECT open_count FROM ms_sent_to WHERE id='$sent_to_id'";
	$result = $dbconn->Execute($sql);
	$open_count = $result->Fields('open_count');
	$open_count++;
	$sql = "UPDATE ms_sent_to SET open_count='$open_count',open_date=NOW() WHERE id='$sent_to_id'";
	$dbconn->Execute($sql);
}

function deleteBatch($batch_id){
	global $dbconn;
	$sql ="DELETE FROM ms_batch WHERE id='$batch_id'";
	$dbconn->Execute($sql);
}

function loadBatchInfo($batch_id){
	global $dbconn;
	
	
	$sql = "SELECT t1.id,t1.template,t1.message_id,t1.contact_group_id,t1.delivery_date,t1.delivery_stamp,
	t1.`status`,t2.subject,t2.from_name,t2.from_email,t2.to_name,t2.attachment1_name,t2.attachment2_name,
	t2.attachment3_name,t3.category AS `category_name`
	FROM (ms_batch AS t1)
	LEFT JOIN ms_messages AS t2 ON (t1.message_id=t2.id)
	LEFT JOIN cms_contact_category AS t3 ON (t1.contact_group_id=t3.id)
	WHERE t1.id='$batch_id' LIMIT 0,1";
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$data[batch_id]=$result->Fields('id');
	$data[template_file]=$result->Fields('template');
	$data[message_id]=$result->Fields('message_id');
	$data[message_subject]=$result->Fields('subject');
	$data[from_name]=$result->Fields('from_name');
	$data[from_email]=$result->Fields('from_email');
	$data[to_name]=$result->Fields('to_name');
	$data[attachment1]=$result->Fields('attachment1_name');
	$data[attachment2]=$result->Fields('attachment2_name');
	$data[attachment3]=$result->Fields('attachment3_name');
	$data[contact_group_id]=$result->Fields('contact_group_id');
	$data[category_name]=$result->Fields('category_name');
	$data[delivery_date]=$result->Fields('delivery_date');
	$data[delivery_stamp]=$result->Fields('delivery_stamp');
	$data[status]=$result->Fields('status');
	
	if($data[status]=='sent'){
		$sql = "SELECT t1.id AS `sent_to_id`,
		t1.contact_id,t1.open_count,
		t1.open_date,
		CONCAT(t2.fname,' ',t2.lname) AS `contact_name`,
		t1.email
		FROM (ms_sent_to AS t1) 
		LEFT JOIN cms_contact AS t2 ON (t1.contact_id=t2.id)
		WHERE batch_id='$data[batch_id]'";	
		
		$result=$dbconn->Execute($sql) or die($sql);
		$x=0;
		while(false!=($row=$result->FetchRow())){
			$send_to[$x]->sent_to_id=$row['sent_to_id'];
			$send_to[$x]->email=$row['email'];
			$send_to[$x]->contact_id=$row['contact_id'];
			$send_to[$x]->open_count=$row['open_count'];
			$send_to[$x]->open_date=$row['open_date'];
			$send_to[$x]->contact_name=$row['contact_name'];
			$x++;
		}
		$data[send_count]=COUNT($send_to);
		$data[sent_to_data]=$send_to;
		
		$data[links]=$this->collectLinksClicked($batch_id);
		// we need to get the open count
		$sql = "SELECT COUNT(id) `open_count` FROM ms_sent_to WHERE batch_id='$batch_id' AND open_count is not null";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$data[open_count]=$result->Fields('open_count');
		
	}
	return $data;
}

function linkRedirect($link_id,$stid){
	global $dbconn;
	$sql = "SELECT url FROM ms_link WHERE id='$link_id'";
	$result = $dbconn->Execute($sql);
	$url = $result->Fields('url');
	
	$sql = "INSERT INTO ms_link_log (link_id,sent_to_id,stamp) VALUES 
	('$link_id','$stid',NOW())";
	$dbconn->Execute($sql);
	
	header("location:$url");
	exit;
}

function collectLinksClicked($batch_id){
	global $dbconn;
	$sql ="SELECT t1.url,t3.email,t2.stamp FROM (ms_link AS t1,ms_link_log AS t2,ms_sent_to AS t3)
	WHERE t3.batch_id='$batch_id' AND t3.id=t2.sent_to_id AND t2.link_id=t1.id";
	$result = $dbconn->Execute($sql);
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x]->email=$row[email];
		$data[$x]->url=$row[url];
		$data[$x]->stamp=$row[stamp];
		$x++;	
	}
	if(!empty($data)){
		return $data;	
	}
}

function optout($contact_id,$group_id){
	global $dbconn;
	$sql = "DELETE FROM cms_contact_category_connection WHERE category_id='$group_id' AND contact_id='$contact_id'";
	$dbconn->Execute($sql);
}


}

?>