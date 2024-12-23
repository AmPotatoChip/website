<?php
require('common/page_start.php');
checkUserLogin();

class CONTACT_IMPORT{
	
	function initImport($tmp_file){
		$fp = fopen("/var/www/sites/lazarusgroup.com/public_html/admin/tlg1.csv","r");
		$content = fread($fp,filesize($tmp_file));
		$rows = explode("\r",$content);
		foreach($rows as $single_entry){
			$this->importContact($single_entry);
		}
	}
	
	function importContact($contact){
		global $dbconn;
		list($fname,$lname,$address,$address2,$city,$state,$zip,$phone,$email,$group)=explode("\t",$contact);
		//if($this->check_email_address($email)){
			// need to add contact into database now.
			
		$fname = addslashes($fname);
		$address = addslashes($address);
		$city = addslashes($city);
		
			$sql = "INSERT INTO cms_contact (fname,lname) VALUES ('$fname','$lname')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$contact_id = $dbconn->Insert_Id();
			
			// now we add the email address into the database.
			$sql = "INSERT INTO cms_contact_email (contact_id,email) VALUES ('$contact_id','$email')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg().$sql);
			
			$this->addContactToGroup($contact_id,$group);
			
			// add address to database.
			if($address!=''){
				$sql = "INSERT INTO cms_contact_address (contact_id,address,address2,city,state,postal_code) VALUES ('$contact_id','$address','$address2','$city','$state','$zip')";
				$result = $dbconn->Execute($sql);
			} 
			
			if($phone!=''){
				$sql = "INSERT INTO cms_contact_phone (contact_id,phone) VALUES ('$contact_id','$phone')";
				$result = $dbconn->Execute($sql);
						}
		//}
	}
	
	function addContactToGroup($contact_id,$group_name){
		global $dbconn;
		$sql = "SELECT id FROM cms_contact_category WHERE category='$group_name' LIMIT 0,1";
		$result = $dbconn->Execute($sql);
		$group_id = $result->Fields('id');
		
		if($group_id!=''){
			$sql = "INSERT INTO cms_contact_category_connection (category_id,contact_id) VALUES ('$group_id','$contact_id')";
			$result = $dbconn->Execute($sql);
		}else{
			$sql = "INSERT INTO cms_contact_category (category) VALUES ('$group_name')";
			$result = $dbconn->Execute($sql);
			$group_id = $dbconn->Insert_Id();
			
			$sql = "INSERT INTO cms_contact_category_connection (category_id,contact_id) VALUES ('$group_id','$contact_id')";
			$result = $dbconn->Execute($sql);
		}
	}
	
	function check_email_address($email) {
	// First, we check that there's one @ symbol, and that the lengths are right
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
	// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
	return false;
	}
	// Split it into sections to make life easier
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
	if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
	return false;
	}
	}
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
	$domain_array = explode(".", $email_array[1]);
	if (sizeof($domain_array) < 2) {
	return false; // Not enough parts to domain
	}
	for ($i = 0; $i < sizeof($domain_array); $i++) {
	if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
	return false;
	}
	}
	}
	return true;
}
}


if(!empty($_FILES)){
	$file = $_FILES[contacts];
	$IC = new CONTACT_IMPORT();
	$IC->initImport($file[tmp_name]);
}

?>

<form name="contact_import" method="POST" action="" enctype="multipart/form-data">
<input type="file" name="contacts">
<input type="submit" value="import">
</form>