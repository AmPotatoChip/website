<?
// function globally includes dbconn ( ADODB CONNECTION)

CLASS CONTACT_SEARCH{
	var $search_query;
	var $search_type;
	var $contact_ids;
	var $search_result;
	
	function initSearch(){
		global $dbconn;
		
		switch($this->search_type){
			case 'fname':
				$sql = "SELECT id as contact_id FROM cms_contact WHERE fname like '%$this->search_query%'";
			break;
			case 'lname':
				$sql = "SELECT id as contact_id FROM cms_contact WHERE lname like '%$this->search_query%'";
			break;
			case 'company':
				$sql = "SELECT id as contact_id FROM cms_contact WHERE company_name like '%$this->search_query%'";
			break;
			case 'address':
				$sql = "SELECT contact_id FROM cms_contact_address WHERE address like '%$this->search_query%'";
			break;
			case 'city':
				$sql = "SELECT contact_id FROM cms_contact_address WHERE city like '%$this->search_query%'";
			break;
			case 'state':
				$sql = "SELECT contact_id FROM cms_contact_address WHERE state like '%$this->search_query%'";
			break;
			case 'postal_code':
				$sql = "SELECT contact_id FROM cms_contact_address WHERE postal_code like '%$this->search_query%'";
			break;
			case 'phone':
				$sql = "SELECT contact_id FROM cms_contact_phone WHERE phone LIKE '%$this->search_query%'";
			break;
			case 'email':
				$sql = "SELECT contact_id FROM cms_contact_email WHERE email LIKE '%$this->search_query%'";
			break;
		}
		
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		while(false!=($row=$result->FetchRow())){
			$data[]=$row[contact_id];	
		}
		
		if(!empty($data)){
			$this->contact_ids=$data;
		}
	}
	
	function collectContactInfo(){
		global $dbconn;
		$contact_id_array = $this->contact_ids;
		if(!empty($contact_id_array)){
		foreach($contact_id_array as $tmp){
			$sql_insert.="'$tmp'".",";	
		}
		$sql_insert = substr($sql_insert,0,-1);
		}
		if(!empty($sql_insert)){		
		$sql ="Select cms_contact.id,cms_contact.fname,cms_contact.mname,cms_contact.lname,cms_contact.company_name,
		cms_contact_email.email,cms_contact_phone.phone 
		From
		cms_contact LEFT Join cms_contact_email ON cms_contact.id = cms_contact_email.contact_id
		LEFT Join cms_contact_phone ON cms_contact.id = cms_contact_phone.contact_id 
		WHERE cms_contact.id in ($sql_insert) GROUP BY cms_contact.id ORDER BY cms_contact.lname";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$x=0;
		while(false!=($row=$result->FetchRow())){
			foreach($row as $key=>$value){
				$data[$x]->$key=$value;	
			}	
			$x++;
		}
		
		if(!empty($data)){
			$this->search_result=$data;
		}
		
		}
		
	}
	
	function getSearchResult($starting_letter){
		global $dbconn;
		if($starting_letter=='ALL'){
			$sql = "Select cms_contact.id,cms_contact.fname,cms_contact.mname,cms_contact.lname,cms_contact.company_name,
		cms_contact_email.email,cms_contact_phone.phone 
		From
		cms_contact LEFT Join cms_contact_email ON cms_contact.id = cms_contact_email.contact_id
		LEFT Join cms_contact_phone ON cms_contact.id = cms_contact_phone.contact_id GROUP BY cms_contact.id
		ORDER BY cms_contact.lname";
		}else{
			$sql ="Select cms_contact.id,cms_contact.fname,cms_contact.mname,cms_contact.lname,cms_contact.company_name,
		cms_contact_email.email,cms_contact_phone.phone 
		From
		cms_contact LEFT Join cms_contact_email ON cms_contact.id = cms_contact_email.contact_id
		LEFT Join cms_contact_phone ON cms_contact.id = cms_contact_phone.contact_id 
		WHERE cms_contact.lname like '$starting_letter%' GROUP BY cms_contact.id ORDER BY cms_contact.lname";
		}
		
		
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$x=0;
		while(false!=($row=$result->FetchRow())){
			foreach($row as $key=>$value){
				$data[$x]->$key=$value;
			}
			$x++;	
		}
		
		if(!empty($data)){
			$this->search_result=$data;	
		}
	}
	
	function deleteContact($contact_id){
		global $dbconn;
		$sql[]="DELETE FROM cms_contact WHERE id='$contact_id'";
		$sql[]="DELETE FROM cms_contact_address WHERE contact_id='$contact_id'";
		$sql[]="DELETE FROM cms_contact_email WHERE contact_id='$contact_id'";
		$sql[]="DELETE FROM cms_contact_notes WHERE contact_id='$contact_id'";
		$sql[]="DELETE FROM cms_contact_phone WHERE contact_id='$contact_id'";
		$sql[]="DELETE FROM cms_contact_category_connection WHERE contact_id='$contact_id'";
		
		foreach($sql as $query){
			@$dbconn->Execute($query);
		}
	}
	
	function addContactFromForm($param){
		global $dbconn;
		
		foreach($param as $key=>$value){
			if(!is_array($value)){
			$$key=addslashes($value);
			}else{
				$$key=$value;	
			}
		}
		// first we have to add it to the main table.
		// cms_contact	
		$sql = "INSERT INTO cms_contact (fname,mname,lname,company_name,newsletter,created) 
		VALUES ('$fname','$mname','$lname','$company_name','$newsletter',NOW())";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		$contact_id = $dbconn->Insert_ID();
		if(!empty($address)){
			$sql = "INSERT INTO cms_contact_address (contact_id,address,address2,city,state,postal_code)
			 VALUES ('$contact_id','$address','$address2','$city','$state','$postal_code')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		}
		
		// need to add phone number.
		if(!empty($phone)){
			$sql = "INSERT INTO cms_contact_phone (contact_id,phone) VALUES ('$contact_id','$phone')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		}
		
		// adding email address.
		if(!empty($email)){
			$sql = "INSERT INTO cms_contact_email (contact_id,email) VALUES ('$contact_id','$email')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		}
		
		// need to check if this contact needs to be added to a bulkmail category.
		if(!empty($bulkmail_category)){
			foreach($bulkmail_category as $category_id){
				$sql = "INSERT INTO cms_contact_category_connection (category_id,contact_id) VALUES 
				('$category_id','$contact_id')";
				$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			}	
		}
		
		
		return $contact_id;
		
	}
	
	function assignContactInformation($contact_id){
		global $dbconn,$smarty;
		
		// Get main info
		$sql = "SELECT * FROM cms_contact WHERE id='$contact_id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$data[main]->fname=$result->Fields('fname');
		$data[main]->mname=$result->Fields('mname');
		$data[main]->lname=$result->Fields('lname');
		$data[main]->company_name=$result->Fields('company_name');
		$data[main]->newsletter=$result->Fields('newsletter');
		
		
		
		// We need to collect addresses.
		$sql = "SELECT * FROM cms_contact_address WHERE contact_id='$contact_id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		$x=0;
		while(false!=($row=$result->FetchRow())){
			foreach($row as $key=>$value){
				$data[address][$x]->$key=$value;	
			}
			$x++;	
		}
		
		$sql = "SELECT * FROM cms_contact_email WHERE contact_id='$contact_id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$x=0;
		while(false!=($row=$result->FetchRow())){
			$data[emails][$x]->id=$row[id];
			$data[emails][$x]->email=$row[email];
			$data[emails][$x]->email_type=$row[email_type];			
			$x++;
		}
		
		$sql = "SELECT * FROM cms_contact_phone WHERE contact_id='$contact_id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$x=0;
		while(false!=($row=$result->FetchRow())){
			$data[phone][$x]->id=$row[id];
			$data[phone][$x]->phone=$row[phone];
			$data[phone][$x]->phone_type=$row[phone_type];
			$x++;	
		}
		
		$sql = "SELECT note,DATE_FORMAT(created,'%M %e, %Y %l:%i:%s %p') AS created FROM cms_contact_notes WHERE contact_id='$contact_id' ORDER BY cms_contact_notes.created DESC";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		$x=0;
		while(false!=($row=$result->FetchRow())){
			$note_data[$x]->note=$row[note];
			$note_data[$x]->created=$row[created];
			$x++;	
		}
		if(!empty($note_data)){
			SmartyPaginate::setTotal(count($note_data));
			$data[notes]=array_slice($note_data,SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
		}
		
		
		// need to assign the form posts
		$sql = "Select id,form_data,created FROM cms_contact_forms WHERE contact_id='$contact_id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$x=0;
		while(false!=($row=$result->FetchRow())){
			$data[forms][$x][id]=$row[id];
			$data[forms][$x][form_data]=unserialize(stripslashes($row[form_data]));
			$data[forms][$x][created]=$row[created];
			$x++;	
		}
		
		$smarty->assign('info',$data);
	}
	
	function getMainContactInfo($contact_id){
		global $dbconn;
		$sql = "SELECT * FROM cms_contact WHERE id='$contact_id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$data = $result->FetchRow();
		return $data;
	}
	
	function updateContact($type,$params){
		global $dbconn;
		foreach($params as $key=>$value){
			if(!is_array($value)){
				$params[$key]=addslashes($value);	
			}	
		}
		
		
		
		switch($type){
			
			case 'main':
				$sql = "UPDATE cms_contact SET fname='$params[fname]',mname='$params[mname]',lname='$params[lname]',company_name='$params[company_name]',newsletter='$params[newsletter]' WHERE id='$params[contact_id]'";
				$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
				$msg='The main contact information has been updated';
			break;
			case 'address':
				if($params[address_id]){
					// update and address	
					$sql = "UPDATE cms_contact_address SET address='$params[address]',address2='$params[address2]',city='$params[city]',
					state='$params[state]',postal_code='$params[postal_code]',address_info='$params[address_info]' WHERE id='$params[address_id]'";
					$result = $dbconn->Execute($sql);
					$msg='The address has been updated';
				}else{
					// setup a new address
					$sql = "INSERT INTO cms_contact_address (contact_id,address,address2,city,state,postal_code,address_info) 
					VALUES ('$params[contact_id]','$params[address]','$params[address2]','$params[city]','$params[state]',
					'$params[postal_code]','$params[address_info]')";
					$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
					$msg = 'New address has been added';
				}
			break;
			case 'email':
				if($params[email_id]){
					// update	
					$sql = "UPDATE cms_contact_email SET email='$params[email]',email_type='$params[email_type]' WHERE id='$params[email_id]'";	
					$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
					$msg = 'The email address has been updated';
				}else{
					// setup new
					$sql = "INSERT INTO cms_contact_email (contact_id,email,email_type) VALUES ('$params[contact_id]',
					'$params[email]','$params[email_type]')";
					$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
					$msg = "The new email address has been added";
				}
			break;
			case 'phone':
				if($params[phone_id]){
				//update	
					$sql = "UPDATE cms_contact_phone SET phone_type='$params[phone_type]',phone='$params[phone]' WHERE id='$params[phone_id]'";
					$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
					$msg = "The phone number has been updated";
				}else{
				// new
					$sql = "INSERT INTO cms_contact_phone (contact_id,phone,phone_type) VALUES 
					('$params[contact_id]','$params[phone]','$params[phone_type]')";
					$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
					$msg = "New phone number has been added";
				}
			break;
			case 'note':
				$sql = "INSERT INTO cms_contact_notes (contact_id,note,created) VALUES ('$params[contact_id]','$params[note]',NOW())";
				$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
				$msg = "New Note has been added";
			break;	
				
		}
		
		
		$url="location:edit_contact.php?contact_id=".$params[contact_id]."&msg=$msg";
		$url = stripslashes($url);
		header("$url");
	}
	
	function getAddressById($address_id){
		global $dbconn;
		$sql = "SELECT * FROM cms_contact_address WHERE id='$address_id'";
		$result = $dbconn->Execute($sql);
		$data = $result->FetchRow();
		return $data;
	}
	
	function deleteAddressById($address_id){
		global $dbconn;
		$sql = "DELETE FROM cms_contact_address WHERE id='$address_id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	}
	
	function getEmailById($email_id){
		global $dbconn;
		$sql = "SELECT * FROM cms_contact_email WHERE id='$email_id'";	
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$data=$result->FetchRow();
		return $data;
	}
	
	function deleteEmailAddress($email_id){
		global $dbconn;
		$sql = "DELETE FROM cms_contact_email WHERE id='$email_id'";	
		$result = $dbconn->Execute($sql);
	}
	
	function getPhoneById($phone_id){
		global $dbconn;
		$sql = "SELECT * FROM cms_contact_phone WHERE id='$phone_id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$data=$result->FetchRow();
		return $data;
	}
	
	function deletePhoneById($phone_id){
		global $dbconn;
		$sql = "DELETE FROM cms_contact_phone WHERE id='$phone_id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	}
	
	
}
?>