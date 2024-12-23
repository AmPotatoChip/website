<?
require('common/page_start.php');

class CONTACT_IMPORT{
	var $file;


	function loadFile(){
		$fp = fopen($this->file,"r");
		$content = fread($fp,filesize($this->file));
		$content_split = explode("\r",$content);
		
		
		foreach($content_split AS $tmp){
			$data[]=explode("\t",$tmp);	
		}
		
		foreach($data as $tmp){
			$this->importData($tmp);
		}
	}
	
function importData($params){
		global $dbconn;

		foreach($params as $key=>$value){
			$data[$key]=addslashes($value);
		}
		
		$params=$data;
				
		$sql = "INSERT INTO cms_contact (fname,mname,lname,company_name,created) VALUES
		('$params[3]','','$params[4]','$params[5]',NOW())";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg().'<br/>'.$sql);
		$contact_id = $dbconn->Insert_ID();

		if(!empty($params[6]) && !empty($params[8])){
			$sql = "INSERT INTO cms_contact_address (contact_id,address,address2,city,state,postal_code,country)
			VALUES ('$contact_id','$params[6]','$params[7]','$params[8]','$params[9]','$params[10]','')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg().'<br/>'.$sql);
		}
		
		if(!empty($params[11])){
			$sql = "INSERT INTO cms_contact_phone (contact_id,phone) VALUES ('$contact_id','$params[11]')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		}
		
		if(!empty($params[16])){
			$sql = "INSERT INTO cms_contact_email (contact_id,email) VALUES ('$contact_id','$params[16]')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		}
	}
}

//$IMPORT = new CONTACT_IMPORT();
//$IMPORT->file = 'present_magazine_contact.txt';
//$IMPORT->loadFile();

?>