<?php

class FORM_CONTROLLER{
	var $postParams;
	var $formRedir;
	var $formRedir_title = PAGE_TITLE;
	var $filter = array('required','redir');
	var $contact_id;
	var $emailBody;
	var $serializedFormPost;
	var $sendToEmails;
	
	var $letter_group;

	
	function formPostInit(){
		global $dbconn;
		if(!empty($this->postParams)){
		$this->normalizePostParams($this->postParams);
		$this->checkIfInSystem($this->postParams[email]); // checks if the user is already in the db.
		$this->serializePostParams(); // serialized the form into a class obj. (serializedFormPost)
		$this->controlPost();
		$this->mailOutBodyBuilder($this->postParams); // now we have the mail out body as well.
		$this->mailOut();
		$this->reDirect();
		}
	}
	
	function checkIfInSystem($email){
		global $dbconn;
		$sql = "SELECT contact_id FROM cms_contact_email WHERE email='$email'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$contact_id = $result->Fields('contact_id');
		if($contact_id){
			$this->contact_id=$contact_id;	
		}	
	}
	
	function controlPost(){
		global $dbconn;
		if($this->contact_id!=''){
			// means this user is already in the db. and doesn't need to be added again.	
			$sql = "INSERT INTO cms_contact_forms (contact_id,form_data,created) VALUES ('$this->contact_id','$this->serializedFormPost',NOW())";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		}else{
			// user is not in the system yet and needs to be added to the correct fields.	
			$fname = $this->postParams[fname];
			$lname = $this->postParams[lname];
			$email = $this->postParams[email];
			$sql = "INSERT INTO cms_contact (fname,lname) values ('$fname','$lname')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$contact_id = $dbconn->Insert_ID();
			$this->contact_id=$contact_id;

			// since we know that they have to have first name and last name and the email address.
			// we can add the email address into the system as well.
			if($email!=''){
			$sql = "INSERT INTO cms_contact_email (contact_id,email) VALUES ('$contact_id','$email')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			}
			
			$sql = "INSERT INTO cms_contact_forms (contact_id,form_data,created) VALUES ('$contact_id','$this->serializedFormPost',NOW())";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());

			// add the address
			$address=$this->postParams[address]; 
			$address2=$this->postParams[address2];
			$city=$this->postParams[city];
			$state=$this->postParams[state]; 
			$postal_code=$this->postParams[postal_code];
			
			
			
			$sql = "INSERT INTO cms_contact_address 
			set 
			`address`='$address', 
			`address2`='$address2', 
			`city`='$city', 
			`state`='$state', 
			`postal_code`='$postal_code',			
			`contact_id` = $contact_id";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			
			
			
			// add the email groups
			$sql = "INSERT INTO cms_contact_category_connection set `category_id`='1', `contact_id` = $contact_id";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			
			if ($this->letter_group){
				// add the email groups
				$sql = "INSERT INTO cms_contact_category_connection set `category_id`=$this->letter_group, `contact_id` = $contact_id";
				$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			}
			
			
			
		}
	}
	
	function reDirect(){
		$html ="<html>\n";
		$html.="<head>\n";
		$html.="<title>".$this->formRedir_title."</title>\n";
		$html.="<meta http-equiv=\"refresh\" content=\"4;url=".$this->formRedir."\">\n";
		$html.="</head>\n";
		$html.="<body>\n";
		$html.="<div style=\"text-align:center;\">\n";
		$html.="<h1>We have received your submission</h1>";
		$html.="</div>\n";
		$html.="</body>\n";
		$html.="</html>\n";
		echo $html;
		exit;	
	}
	
	function normalizePostParams(&$params){
		foreach($params as $key=>$value){
			if(!is_array($value)){
				$params[$key]=addslashes($value);
			}	
		}	
	}
	
	function mailOutBodyBuilder($params){
		$body='';
		$params = $this->postParams;
		foreach($params as $key=>$value){
			if(!in_array($key,$this->filter)){
				$body.="$key".": ".$value."\n";
			}
		}
		if(!empty($body)){
			$this->emailBody=$body;
		}
	}
	
	function serializePostParams(){
		$serialized = serialize($this->postParams);
		$this->serializedFormPost=addslashes($serialized);
	}
	
	function mailOut(){
		require('phpmailer/class.phpmailer.php');
		$p = $this->postParams;
		$rcpt = $this->sendToEmails;
		
		$MAIL = new PHPMailer();
		$MAIL->Sender = $p[email];
		$MAIL->From = $p[email];
		$MAIL->FromName = "$p[fname] $p[lname]";
		$MAIL->Subject = "Contact From Website - ".$_SERVER['HTTP_REFERER'];
		$MAIL->Body=$this->emailBody;
		$MAIL->IsHTML(false);
		if(is_array($rcpt)){
			foreach($rcpt as $email){
				$MAIL->AddAddress($email,'');	
			}	
		}else{
			$MAIL->AddAddress($rcpt,'');
		}
		
		$MAIL->AddBCC('notify@lazarusgroup.com','Lazarus Group');
		$MAIL->Send() or die($MAIL->ErrorInfo);
	}
	
	
}

?>