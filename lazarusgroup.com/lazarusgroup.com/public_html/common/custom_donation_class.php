<?
CLASS CUSTOM_DONATION_CLASS{
	public $post_params;
	private $serialized_post_params;
	private $contact_id = false;
	public $transaction_id=false;
	public $status;
	public $user_message;

	function init(){
		$this->addSlashesToPostParam($this->post_params);
		$this->prepData();
		$this->serializePostParams();
		$this->addContact();
		$this->postDonation();
		$this->emailReceipt();
	}
	
	function initSimple(){
		$this->addSlashesToPostParam($this->post_params);
		
		$this->post_params[cc_exp]=$this->post_params[cc_month].'/'.$this->post_params[cc_year];
		$this->post_params[cc_num_store]=$this->ccNum4($this->post_params[cc_num]);
		
		$this->serializePostParams();

		
		$this->addContact();
		$this->postSimpleDonation();
		$this->emailReceipt();
	}
	
	function serializePostParams(){
		
		$foo = $this->post_params;
		$foo[cc_num] = $foo[cc_num_store];
		
		$this->serialized_post_params = serialize($foo);
	}
	
	function addSlashesToPostParam(&$params){
		foreach($params AS $label=>$value){
			if(!is_array($value)){
				$params[$label]=addslashes($value);
			}
		}
	}
	
	function postSimpleDonation(){
		global $dbconn;
		$p = $this->post_params;
		
		$sql = "INSERT INTO donation_transactions 
		(contact_id,
		donation_amount,
		cc_type,
		cc_name,
		cc_num,
		cc_exp,
		cc_ccv,
		raw,
		created) 
		VALUES 
		('$this->contact_id',
		'$p[donation_amount]',
		'$p[cc_type]',
		'$p[cc_name]',
		'$p[cc_num_store]',
		'$p[cc_exp]',
		'$p[cc_ccv]',
		'$this->serialized_post_params',
		NOW())";
		
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$this->transaction_id = $dbconn->Insert_ID();
		
		$auth_response = $this->process_the_transaction(
		$p[fname],
		$p[lname],
		$p[address],
		$p[city],
		$p[state],
		$p[zip],
		$p[email],
		$p[phone],
		$p[cc_name],
		$p[cc_type],
		$p[donation_amount],
		$p[cc_num],
		$p[cc_month],
		$p[cc_year],
		$p[cc_ccv],
		$this->transaction_id,
		'WebsiteDonation',
		$p[employer_occupation],
		$p[kccontract]
		
		);
		
//print_r($auth_response);exit;

		// updating database with the result.
		switch($auth_response["success"]){
			case '1':
				// The Credit Card was accepted and everything is ok!
				$p[response_code]=$auth_response['success'];
				$p[auth_code]=$auth_response['ssl_approval_code'];
				$p[avs]=$auth_response['ssl_approval_text'];
				$p[trans_id]=$auth_response['ssl_txn_id'];
				
				$sql = "UPDATE donation_transactions SET response_code='$p[response_code]',auth_code='$p[auth_code]',avs='$p[avs]',
				trans_id='$p[trans_id]',`status`='ok' WHERE id='$this->transaction_id'";
				$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
				
				
				$this->status='ok';
			break;
			default:
				$p[response_code]=$auth_response['success'];
				$p[auth_code]=$auth_response['ssl_approval_code'];
				$p[avs]=$auth_response['ssl_approval_text'];
				$p[trans_id]=$auth_response['ssl_txn_id]'];
				
				$sql = "UPDATE donation_transactions SET response_code='$p[response_code]',auth_code='$p[auth_code]',avs='$p[avs]',
				trans_id='$p[trans_id]',`status`='error' WHERE id='$this->transaction_id'";
				$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
				
				$this->status='error';
				$this->user_message = $auth_response['Response Reason Text'];
			break;
		}
	}
	
	function postDonation(){
		global $dbconn;
		$p = $this->post_params;
		
		$sql = "INSERT INTO donation_transactions 
		(contact_id,
		donation_amount,
		cc_type,
		cc_name,
		cc_num,
		cc_exp,
		cc_ccv,
		raw,
		created) 
		VALUES 
		('$this->contact_id',
		'$p[donation_amount]',
		'$p[cc_type]',
		'$p[cc_name]',
		'$p[cc_num_store]',
		'$p[cc_exp]',
		'$p[cc_ccv]',
		'$this->serialized_post_params',
		NOW())";
		
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$this->transaction_id = $dbconn->Insert_ID();
		
		$auth_response = $this->process_the_transaction(
		$p[fname],
		$p[lname],
		$p[address],
		$p[city],
		$p[state],
		$p[zip],
		$p[email],
		$p[phone],
		$p[cc_name],
		$p[cc_type],
		$p[donation_amount],
		$p[cc_num],
		$p[cc_month],
		$p[cc_year],
		$p[cc_ccv],
		$this->transaction_id,
		'donation'
		);
		
	print_r($auth_response);exit;
		
		// updating database with the result.
		switch($auth_response["Response Code"]){
			case '1':
				// The Credit Card was accepted and everything is ok!
				$p[response_code]=$auth_response['Response Code'];
				$p[auth_code]=$auth_response['Approval Code'];
				$p[avs]=$auth_response['AVS Result Code'];
				$p[trans_id]=$auth_response['Transaction ID'];
				
				$sql = "UPDATE donation_transactions SET response_code='$p[response_code]',auth_code='$p[auth_code]',avs='$p[avs]',
				trans_id='$p[trans_id]',`status`='ok' WHERE id='$this->transaction_id'";
				$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
				
				
				$this->status='ok';
			break;
			default:
				$p[response_code]=$auth_response['Response Code'];
				$p[auth_code]=$auth_response['Approval Code'];
				$p[avs]=$auth_response['AVS Result Code'];
				$p[trans_id]=$auth_response['Transaction ID'];
				
				$sql = "UPDATE donation_transactions SET response_code='$p[response_code]',auth_code='$p[auth_code]',avs='$p[avs]',
				trans_id='$p[trans_id]',`status`='error' WHERE id='$this->transaction_id'";
				$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
				
				$this->status='error';
				$this->user_message = $auth_response['Response Reason Text'];
			break;
		}
		
	}
	
	function prepData(){
		// this function sets the donation amount. and cc_exp
		switch($this->post_params[level_of_support]){
			case 'sapphire_5000':
				$donation_amount = 5000;
			break;
			case 'azure_2500':
				$donation_amount = 2500;
			break;
			case 'cerulean_1000':
				$donation_amount = 1000;
			break;
			case 'indigo_250':
				$donation_amount = 250;
			break;
			case 'turquoise_125':
				$ticket_price_per = 150;
				/*
				// This option has another option within.
				// The user can select more tickets.
				// wichi should change the price
				*/
				$number_of_tickets = $this->post_params[tickets];
				$donation_amount = ($ticket_price_per*$number_of_tickets);
			break;
			case 'none':
				$donation_amount = $this->post_params[donation];
			break;
		}
		
		$this->post_params[donation_amount]=$donation_amount;
		$this->post_params[cc_exp]=$this->post_params[cc_month].'/'.$this->post_params[cc_year];
		$this->post_params[cc_num_store]=$this->ccNum4($this->post_params[cc_num]);
	}
	
	function ccNum4($cc_num){
		$s = strlen($cc_num)-4;
		$cc_number_out = '****-****-****-'.$cc_num[$s].$cc_num[$s+1].$cc_num[$s+2].$cc_num[$s+3];
		return $cc_number_out;
	}
	
	function collectReceiptData(){
		if(!empty($this->transaction_id)){
			global $dbconn;
			$sql = "SELECT * FROM donation_transactions WHERE id='$this->transaction_id'";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$row = $result->FetchRow();
			$row[raw]=unserialize($row[raw]);
			
			$row[eventname]=$row[raw][eventname];
			$row[name]=$row[raw][fname].' '.$row[raw][lname];
			$row[address]=$row[raw][address];
			$row[city]=$row[raw][city];
			$row[state]=$row[raw][state];
			$row[zip]=$row[raw][zip];
			$row[email]=$row[raw][email];
			$row[level_support]=$row[raw][level_of_support];
			$row[number_of_guests]=$row[raw][number_of_guests];
			$row[guest_names]=$row[raw][guest_names];
			$row[name_listed_in_program]=$row[raw][name_listed_in_program];
			$row[comments]=$row[raw][comments];
			$row[specific_use]=$row[raw][specific_use];
			$row[interested_in]=$row[raw][interested_in];
			
			unset($row[raw]);
			
			
			return $row;
		}
	}
	
	function addContact(){
		global $dbconn;
		// first we have to check if the user is in the database or not.
		// check by email address.
		$params = $this->post_params;
		$sql = "SELECT contact_id FROM cms_contact_email WHERE email='$params[email]'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$contact_id = $result->Fields('contact_id');
		
		if($contact_id==''){
			// means user is not in database and we can continue to add the person.
			$sql = "INSERT INTO cms_contact (fname,lname) VALUES ('$params[fname]','$params[lname]')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$contact_id = $dbconn->Insert_ID();
			
			// now add address since we have that information as well.
			$sql = "INSERT INTO cms_contact_address (contact_id,address,address2,city,state,postal_code) 
			VALUES ('$contact_id','$params[address]','$params[address2]','$params[city]','$params[state]','$params[zip]')";
			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			
			// now we add the email address.
			$sql = "INSERT INTO cms_contact_email (contact_id,email) VALUES ('$contact_id','$params[email]')";
			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			
			// now we add the phone number.
			$sql = "INSERT INTO cms_contact_phone (contact_id,phone) VALUES ('$contact_id','$params[phone]')";
			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			
			// The User has been added to the database.
			$this->contact_id = $contact_id;	// Assigning contact_id to a class var. So we can reuse it.
		}else{
			// person has been to website before and is in database. 
			// need to reuse the contact_id.
			// UPDATE DATABASE WITH INFO given.
			
			// UPDATING ADDRESS INFO
			$sql = "UPDATE cms_contact_address SET address='$params[address]',address2='$params[address2]',city='$params[city]',
			state='$params[state]',postal_code='$params[zip]' WHERE contact_id='$contact_id'";
			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			
			// Updating phone record
			$sql = "UPDATE cms_contact_phone SET phone='$params[phone]' WHERE contact_id='$contact_id'";
			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			
			$this->contact_id=$contact_id;
		}
		
	}
	
	function process_the_transaction(){
		require_once('virtualmerchant.class.php');
		$ccdata=func_get_args();
		
		$a = new virtualmerchant_class;


		$a->add_field('ssl_merchant_id', '557329');// yorick
		$a->add_field('ssl_user_id ', 'website');
		$a->add_field('ssl_pin', 'FV5I1B');
	
		$a->add_field('ssl_show_form', 'FALSE');
		$a->add_field('ssl_receipt_link_method', 'GET');
		
		$a->add_field('ssl_test_mode', 'FALSE');
		
		$a->add_field('ssl_result_format', 'ASCII');	//When set to ASCII Virtual Merchant will generate a plain text key-value document.

//		$a->add_field('x_delim_data', 'TRUE');
//		$a->add_field('x_delim_data', 'TRUE');
//
//		$a->add_field('x_delim_char', '|');     
//		$a->add_field('x_encap_char', '');
	
		$a->add_field('ssl_invoice_number', urlencode($ccdata[15]));
		$a->add_field('ssl_description', urlencode($ccdata[16]));
		$a->add_field('ssl_salestax', "0");
	
		$a->add_field('ssl_first_name', urlencode($ccdata[0]));
		$a->add_field('ssl_last_name', urlencode($ccdata[1]));
		$a->add_field('ssl_avs_address', urlencode($ccdata[2]));
		$a->add_field('ssl_city', urlencode($ccdata[3]));
		$a->add_field('ssl_state', urlencode($ccdata[4]));
		$a->add_field('ssl_avs_zip', urlencode($ccdata[5]));
		$a->add_field('ssl_country','USA');
		$a->add_field('ssl_email', $ccdata[6]);
		$a->add_field('ssl_phone', urlencode($ccdata[7]));
		$a->add_field('kansascity', urlencode($ccdata[18]));
		$a->add_field('employer', urlencode($ccdata[17]));
	
		//  Setup fields for payment information
		$a->add_field('ssl_transaction_type', 'ccsale');//Credit Card Transaction Types
//															Sale(CCSALE)
//															Auth Only(CCAUTHONLY)
//															Credit(CCCREDIT)
//															Force(CCFORCE)
//															Balance Inquiry(CCBALINQUIRY)
//															EGC Transaction Types
//															Activation(EGCACTIVATION)
//															Sale / Redemption(EGCSALE)
//															Card Refund(EGCCARDREFUND)
//															Replenishment / Reload(EGCRELOAD)
//															Card Balance Inquiry(EGCBALINQUIRY)
//															Credit(EGCCREDIT)
//															PIN Less Debit Transaction Types
//															PINLess Debit Purchase(PLDPURCHASE)

		$a->add_field('ssl_cvv2cvc2_indicator', '1'); //CVV2 Indicator 0=Bypassed, 1=present,2=Illegible, and 9=Not Present'
		$a->add_field('ssl_cvv2cvc2', $ccdata[14]);		//CVV2 value

		$a->add_field('ssl_card_number',$ccdata[11]);// $ccdata[12]);// "4007000000027");//$ccdata[13]);   // test successful visa 4007000000027
		$a->add_field('ssl_amount', $ccdata[10]);
		$foo = substr($ccdata[13],2,2);
		$a->add_field('ssl_exp_date', $ccdata[12].$foo);    // mmyy
	
		// Process the payment and output the results
		return ($a->process());
	}
	
	function emailReceipt(){
		require_once('phpmailer/class.phpmailer.php');
		$receipt_data = $this->collectReceiptData();
		$MAIL = new PHPMailer();
		$MAIL->Host='mail.lazarusgroup.com';
		$MAIL->From='staff@debhermannforkansascity.com';
		$MAIL->FromName='Deb Hermann for Kansas City';
		$MAIL->Sender='staff@debhermannforkansascity.com';
		$MAIL->Subject = "Deb Hermann for Kansas City Donation ($this->transaction_id)";
		$MAIL->Body=$this->emailBodyReceipt($receipt_data);
		$MAIL->AddAddress($receipt_data[email],$receipt_data[name]);
		$MAIL->AddBCC("lazarus@lazarusgroup.com","Laz");
		$MAIL->Send() or die($MAIL->ErrorInfo);		
	}
	
	function emailBodyReceipt($data){
		$out.="Transaction ID: ".$data[id]."\n";
		$out.="Donation Amount: ".$data[donation_amount]."\n\n";
		$out.="$data[name]"."\n";
		$out.="$data[address]"."\n";
		$out.="$data[city], $data[state] $data[zip]"."\n\n";
		$out.="Name on Credit Card: ".$data[cc_name]."\n";
		$out.="Credit Card Type: ".$data[cc_type]."\n";
		$out.="Credit Card Number: ".$data[cc_num]."\n";
		$out.="Credit Card Expiration Date: ".$data[cc_exp]."\n\n";
		
		
		/*
		
		$row[comments]=$row[raw][comments];
			$row[specific_use]=$row[raw][specific_use];
			$row[interested_in]=$row[raw][interested_in];
		
		*/
		
		if($data[specific_use]){
		$out.="Specific Use of Donation: ".$data[specific_use]."\n\n";
		}
		
		if($data[commets]){
			$out.="Comment: ".$data[comments]."\n\n";
		}
		
		if($data[interested_in]){
			$out.="Interested in: ";
			foreach($data[interested_in] AS $it){
				$out.="$it".", ";
			}
			$out.="\n\n";
			
		}
		
		
		if($data[number_of_guests]!=0){
			$out.="Number of Guests: ".$data[number_of_guests]."\n";
			$out.="Guest Names: ".$data[guest_names]."\n";
		}
		$out.="\n\n";
		$out.="Thank you for supporting. ";
		
		return $out;
	}
	
}
?>