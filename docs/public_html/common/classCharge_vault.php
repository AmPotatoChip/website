<?php

class Charge_vault{
	
	private $id;
	private $contact_id;
	private $charge_amount;
	private $cc_type;
	private $cc_name;
	private $cc_num;
	private $cc_exp_m;
	private $cc_exp_y;
	private $cc_sec;
	private $form_name;
	private $status;
	private $raw;
	private $entry_date;
	private $updated_date;
	
	// ADDON
	private $gift_type;
	
	function __construct()
	{
		
	}
	
	function __destruct()
	{
		
	}
	
	// SETTERS AND GETTERS
	// START
	
	// id
	public function setId($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->id = trim($inValue);
		}
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	// contact_id
	public function setContact_id($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->contact_id = trim($inValue);
		}
	}
	
	public function getContact_id()
	{
		return $this->contact_id;
	}
	
	// charge_amount
	public function setCharge_amount($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->charge_amount = trim($inValue);
		}
	}
	
	public function getCharge_amount()
	{
		return $this->charge_amount;
	}
	
	// cc_type
	public function setCC_type($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->cc_type = trim($inValue);
		}
	}
	
	public function getCC_type()
	{
		return $this->cc_type;
	}
	
	// cc_name
	public function setCC_name($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->cc_name = trim($inValue);
		}
	}
	
	public function getCC_name()
	{
		return $this->cc_name;
	}
	
	// cc_num
	public function setCC_num($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->cc_num = trim($inValue);
		}
	}
	
	public function getCC_num()
	{
		return $this->cc_num;
	}
	
	// cc_exp_m
	public function setCC_exp_m($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->cc_exp_m = trim($inValue);
		}
	}
	
	public function getCC_exp_m()
	{
		return $this->cc_exp_m;
	}
	
	//cc_exp_y
	public function setCC_exp_y($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->cc_exp_y = trim($inValue);
		}
	}
	
	public function getCC_exp_y()
	{
		return $this->cc_exp_y;
	}
	
	// cc_sec
	public function setCC_sec($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->cc_sec = trim($inValue);
		}
	}
	
	public function getCC_sec()
	{
		return $this->cc_sec;
	}
	
	// form_name
	public function setForm_name($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->form_name = trim($inValue);
		}
	}
	
	public function getForm_name()
	{
		return $this->form_name;	
	}
	
	//status
	public function setStatus($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->status = trim($inValue);
		}
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	// raw
	public function setRaw($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->raw = trim($inValue);
		}
	}
	
	public function getRaw()
	{
		return $this->raw;
	}
	
	// entry_date
	public function setEntry_date($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->entry_date = trim($inValue);
		}
	}
	
	public function getEntry_date()
	{
		return $this->entry_date;
	}
	
	public function setUpdated_date($inValue)
	{
		if(trim($inValue) != '')
		{
			$this->updated_date = trim($inValue);
		}
	}
	
	public function getUpdated_date()
	{
		return $this->updated_date;
	}
	
	public function setGift_type( $inValue )
	{
		if($inValue != '')
		{
			$this->gift_type = trim($inValue);
		}
	}
	
	public function getGift_type()
	{
		return $this->gift_type;
	}
	// END
	
	// INSERT UPDATE POPULATE LISTING
	public function insert()
	{
		global $dbconn;
		
		$sql = 'INSERT INTO charge_vault ';
		$sql.= '(contact_id,charge_amount,cc_type,cc_name,cc_num,cc_exp_m,cc_exp_y,cc_sec,form_name,';
		$sql.= 'status,raw,entry_date,updated_date) ';
		$sql.= 'VALUES ( ';
		
		$sql.= '\'' . addslashes($this->getContact_id()) . '\', ';
		$sql.= '\'' . addslashes($this->getCharge_amount()) . '\', ';
		$sql.= '\'' . addslashes($this->getCC_type()) . '\', ';
		$sql.= '\'' . addslashes($this->getCC_name()) . '\', ';
		$sql.= '\'' . addslashes($this->getCC_num()) . '\', ';
		$sql.= '\'' . addslashes($this->getCC_exp_m()) . '\', ';
		$sql.= '\'' . addslashes($this->getCC_exp_y()) . '\', ';
		$sql.= '\'' . addslashes($this->getCC_sec()) . '\', ';
		$sql.= '\'' . addslashes($this->getForm_name()) . '\', ';
		$sql.= '\'' . addslashes($this->getStatus()) . '\', ';
		$sql.= '\'' . addslashes($this->getRaw()) . '\', ';
		$sql.= 'NOW(), ';
		$sql.= 'NOW() ';
		$sql.= ') ';
		
		
		$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$this->setId($dbconn->Insert_ID());
	
	}
	
	public function update()
	{
		global $dbconn;
		
		$sql = 'UPDATE charge_vault SET ';
		$sql.= 'contact_id=\'' . addslashes($this->getContact_id()) . '\', ';
		$sql.= 'charge_amount=\'' . addslashes($this->getCharge_amount()) . '\', ';
		$sql.= 'cc_type=\'' . addslashes($this->getCC_type()) . '\', ';
		$sql.= 'cc_name=\'' . addslashes($this->getCC_name()) . '\', ';
		$sql.= 'cc_num=\'' . addslashes($this->getCC_num()) . '\', ';
		$sql.= 'cc_exp_m=\'' . addslashes($this->getCC_exp_m()) . '\', ';
		$sql.= 'cc_exp_y=\'' . addslashes($this->getCC_exp_y()) . '\', ';
		$sql.= 'cc_sec=\'' . addslashes($this->getCC_sec()) . '\', ';
		$sql.= 'form_name=\'' . addslashes($this->getForm_name()) . '\', ';
		$sql.= 'status=\'' . addslashes($this->getStatus()) . '\', ';
		$sql.= 'raw=\'' . addslashes($this->getRaw()) . '\', ';
		$sql.= 'status=\'' . addslashes($this->getStatus()) . '\', ';
		$sql.= 'updated_date=NOW() ';
		
		$sql.= 'WHERE id=\'' . $this->getId() . '\' ';
		
		$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	}
	
	public function populate()
	{
		global $dbconn;
		
		$sql = 'SELECT * FROM charge_vault WHERE id=\'' . $this->getId() . '\' ';
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$row = $result->FetchRow();
		
		$this->setContact_id(stripslashes($row['contact_id']));
		$this->setCharge_amount(stripslashes($row['charge_amount']));
		$this->setCC_type(stripslashes($row['cc_type']));
		$this->setCC_name(stripslashes($row['cc_name']));
		$this->setCC_num(stripslashes($row['cc_num']));
		$this->setCC_exp_m(stripslashes($row['cc_exp_m']));
		$this->setCC_exp_y(stripslashes($row['cc_exp_y']));
		$this->setCC_sec(stripslashes($row['cc_sec']));
		$this->setForm_name(stripslashes($row['form_name']));
		$this->setStatus(stripslashes($row['status']));
		$this->setRaw(stripslashes($row['raw']));
		$this->setEntry_date(stripslashes($row['entry_date']));
		$this->setUpdated_date(stripslashes($row['updated_date']));
		
	}
	
	public function listing($form_name = '')
	{
		global $dbconn;
		$tmpArray = array();
		
		$sql = 'SELECT * FROM charge_vault ';
		
		if($form_name != '')
		{
			$sql.= 'WHERE form_name=\'' . $this->getForm_name() . '\' ';
		}
		
		$sql.= 'ORDER BY entry_date ';
		
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		while(false!=($row=$result->FetchRow()))
		{
			$tmpObj = new Charge_vault();
			$tmpObj->setId(stripslashes($row['id']));
			$tmpObj->setContact_id(stripslashes($row['contact_id']));
			$tmpObj->setCharge_amount(stripslashes($row['charge_amount']));
			$tmpObj->setCC_type(stripslashes($row['cc_type']));
			$tmpObj->setCC_name(stripslashes($row['cc_name']));
			$tmpObj->setCC_num(stripslashes($row['num']));
			$tmpObj->setCC_exp_m(stripslashes($row['cc_exp_m']));
			$tmpObj->setCC_exp_y(stripslashes($row['cc_exp_y']));
			$tmpObj->setCC_sec(stripslashes($row['cc_sec']));
			$tmpObj->setForm_name(stripslashes($row['form_name']));
			$tmpObj->setStatus(stripslashes($row['status']));
			$tmpObj->setRaw(stripslashes($row['raw']));
			$tmpObj->setEntry_date(stripslashes($row['entry_date']));
			$tmpObj->setUpdated_date(stripslashes($row['updated_date']));
			
			$tmpArray[]=$tmpObj;
			unset($tmpObj);
		}
		
		return $tmpArray;
	}
	
	public function specialListing($form_name = '', $status = 0)
	{
		global $dbconn;
		$tmpArray = array();
		
		$sql = 'SELECT t1.id, ';
		$sql.= 't1.contact_id, ';
		$sql.= 't1.charge_amount, ';
		$sql.= 't1.entry_date, ';
		$sql.= 't1.form_name, ';
		$sql.= 't2.fname, ';
		$sql.= 't2.lname, ';
		$sql.= 't3.email ';
		$sql.= 'FROM charge_vault AS t1 ';
		$sql.= 'INNER JOIN cms_contact AS t2 ON (t1.contact_id=t2.id) ';
		$sql.= 'INNER JOIN cms_contact_email AS t3 ON (t1.contact_id=t3.contact_id) ';
		
		$sql.= 'WHERE t1.status =\'' . $status . '\' ';
		if($form_name != '')
		{
			$sql.= 'AND t1.form_name=\'' . $this->getForm_name() . '\' ';
		}
				
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		while(false!=($row=$result->FetchRow()))
		{
			$tmpObj = new Charge_vault();
			$tmpObj->setId(stripslashes($row['id']));
			$tmpObj->setContact_id(stripslashes($row['contact_id']));
			$tmpObj->setCharge_amount(stripslashes($row['charge_amount']));
			$tmpObj->setStatus(stripslashes($row['status']));
			$tmpObj->email = $row['email'];
			$tmpObj->setForm_name($row['form_name']);
			$tmpObj->setEntry_date(stripslashes($row['entry_date']));
			$tmpObj->name = stripslashes($row['fname']) . ' ' . stripslashes($row['lname']);
			
			
			$tmpArray[]=$tmpObj;
			unset($tmpObj);
		}
		
		return $tmpArray;
		
	}
	
	public function checkEmail($email)
	{
		global $dbconn;
		$sql = 'SELECT contact_id FROM cms_contact_email WHERE email=\'' . $email . '\' ';
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$row = $result->FetchRow();
		
		if($row['contact_id'] != '')
		{
			$this->setContact_id($row['contact_id']);
		}
	}
	
	public function addContact($fname,$lname,$optin)
	{
		global $dbconn;
		
		$sql = 'INSERT INTO cms_contact (fname,lname,newsletter,created) ';
		$sql.= 'VALUES ( ';
		$sql.= '\'' . addslashes($fname) . '\', ';
		$sql.= '\'' . addslashes($lname) . '\', ';
		$sql.= '\'' . addslashes($optin) . '\', ';
		$sql.= 'NOW() ';
		$sql.= ') ';
		
		$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		$this->setContact_id($dbconn->Insert_ID());
	}
	
	public function addEmail($email)
	{
		global $dbconn;
		
		if($this->getContact_id() != '')
		{
			$sql = 'INSERT INTO cms_contact_email (contact_id,email) VALUES ( ';
			$sql.= '\'' . $this->getContact_id() . '\', ';
			$sql.= '\'' . $email . '\' ';
			$sql.= ') ';

			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		}
	}
	
	public function addAddress($address,$address2,$city,$state,$zip)
	{
		global $dbconn;
		
		if($this->getContact_id() != '')
		{
			$sql = 'INSERT INTO cms_contact_address (contact_id,address,address2,city,state,postal_code) ';
			$sql.= 'VALUES ( ';
			$sql.= '\'' . $this->getContact_id() . '\', ';
			$sql.= '\'' . $address . '\', ';
			$sql.= '\'' . $address2 . '\', ';
			$sql.= '\'' . $city . '\', ';
			$sql.= '\'' . $state . '\', ';
			$sql.= '\'' . $zip . '\' ';
			$sql.= ') ';
			
			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		}
	}
	
	public function addPhone($phone)
	{	
		global $dbconn;

		if($this->getContact_id() != '')
		{
			$sql = 'INSERT INTO cms_contact_phone (contact_id,phone) ';
			$sql.= 'VALUES ( ';
			$sql.= '\'' . $this->getContact_id() . '\', ';
			$sql.= '\'' . $phone . '\' ';
			$sql.= ') ';
			
			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		}
	}
	
	public function emailConfirmation($type)
	{
		global $dbconn;
		require_once('phpmailer/class.phpmailer.php');
		
		$MAIL = new PHPMailer();
		
		switch($type)
		{
			case 'GALA2011':
				$data = unserialize($this->getRaw());
				
				$MAIL->Subject = 'Spring for the Unicorn Form Confirmation';
				$MAIL->Sender = 'boxoffice@unicorntheatre.org';
				$MAIL->From = 'boxoffice@unicorntheatre.org';
				$MAIL->FromName = 'Unicorn Theatre';
				$MAIL->AddCC('boxoffice@unicorntheatre.org','Unicorn Theatre');
				$MAIL->AddAddress($data['email'],$data['fname'] . ' ' .$data['lname']);
				
				// BUILD MAIL BODY
				$body = date('m/d/Y',mktime()) . "\n";
				$body.= 'Dear ' . $data['fname'] . ' ' . $data['lname'] . ",\n\n";
				$body.= 'We are so glad you will be joining us for a Spring for the Unicorn Event.  Details of your order are below.' . "\n\n";
				$body.= 'Order Summary' . "\n\n";
				
				$body.= 'ORDER ID: ' . $this->getId() . "\n";
				
				// ENVET5
				if($data['event5']>0)
				{
					$body.='General Admission - ' . $data[event5] . ' ticket(s).'."\n"; 
				}
				// ENVET6
				if($data['event6']>0)
				{
					$body.='Premium Reserved Table (seats 8) - ' . $data[event6] . ' ticket(s).'."\n"; 
				}

				// ENVET7
				if($data['event7']>0)
				{
					$body.='Patron Party and Gala Admission - ' . $data[event7] . ' ticket(s).'."\n"; 
				}
				
				// ENVET8
				if($data['event8']>0)
				{
					$body.='Cabaret Table (seats 4) - ' . $data[event8] . ' ticket(s).'."\n"; 
				}
				
				
				$body.= "\n";
				
				if($data['donation'] != '')
				{
					$body.= "\n" . 'Donation: $' . number_format($data['donation'],2) . " USD\n";
				}
				$body.= "\n";
							
				$body.= 'Charge Amount: $' . $data['charge_amount'] . " USD\n\n";
				
				$body.= 'Credit Card Type: ' . $data['cc_type'] . "\n";
				$body.= 'Name on Credit Card: ' . $data['cc_name'] . "\n";
				
				$body.= "\n" . 'If you have any questions, please direct them to the development department at 816-531-7529 x12 or ggerling@unicorntheatre.org';
				
				$MAIL->Body = $body;
				$MAIL->Send() or die($MAIL->ErrorInfo);
			break;
			
			
			
			
			
			
			
			case 'EVENTS2011':
				$data = unserialize($this->getRaw());
				
				$MAIL->Subject = 'Spring for the Unicorn Form Confirmation';
				$MAIL->Sender = 'boxoffice@unicorntheatre.org';
				$MAIL->From = 'boxoffice@unicorntheatre.org';
				$MAIL->FromName = 'Unicorn Theatre';
				$MAIL->AddCC('boxoffice@unicorntheatre.org','Unicorn Theatre');
				$MAIL->AddAddress($data['email'],$data['fname'] . ' ' .$data['lname']);
				
				// BUILD MAIL BODY
				$body = date('m/d/Y',mktime()) . "\n";
				$body.= 'Dear ' . $data['fname'] . ' ' . $data['lname'] . ",\n\n";
				$body.= 'We are so glad you will be joining us for a Spring for the Unicorn Event.  Details of your order are below.' . "\n\n";
				$body.= 'Order Summary' . "\n\n";
				
				$body.= 'ORDER ID: ' . $this->getId() . "\n";
				
				// EVENT1
				if($data['event1']>0)
				{
					$body.='Cofee in the Congo with Ricardo Khan - ' . $data[event1] . ' ticket(s).'."\n"; 
				}
				// ENVET2
				if($data['event2']>0)
				{
					$body.='How Merlot Can You Go? - ' . $data[event2] . ' ticket(s).'."\n"; 
				}
				// ENVET3
				if($data['event3']>0)
				{
					$body.='Party After the Arty - ' . $data[event3] . ' ticket(s).'."\n"; 
				}
				// ENVET4
				if($data['event4']>0)
				{
					$body.='A Tour Through The Gardens - ' . $data[event4] . ' ticket(s).'."\n"; 
				}
				// ENVET5
				if($data['event5']>0)
				{
					$body.='Skyline Soiree - ' . $data[event5] . ' ticket(s).'."\n"; 
				}
				// ENVET6
				if($data['event6']>0)
				{
					$body.='Tipsy at the Tee Pee - ' . $data[event6] . ' ticket(s).'."\n"; 
				}

				// ENVET7
				if($data['event7']>0)
				{
					$body.='i-Ron Chef: A Cooking Event With Ron Megee - ' . $data[event6] . ' ticket(s).'."\n"; 
				}
				
				// ENVET8
				if($data['event8']>0)
				{
					$body.='i-Ron Chef: A Cooking Event With Ron Megee - VIP TICKETS - ' . $data[event6] . ' ticket(s).'."\n"; 
				}
				
				
				$body.= "\n";
				
				if($data['donation'] != '')
				{
					$body.= "\n" . 'Donation: $' . number_format($data['donation'],2) . " USD\n";
				}
				$body.= "\n";
							
				$body.= 'Charge Amount: $' . $data['charge_amount'] . " USD\n\n";
				
				$body.= 'Credit Card Type: ' . $data['cc_type'] . "\n";
				$body.= 'Name on Credit Card: ' . $data['cc_name'] . "\n";
				
				$body.= "\n" . 'If you have any questions, please direct them to the development department at 816-531-7529 x12 or ggerling@unicorntheatre.org';
				
				$MAIL->Body = $body;
				$MAIL->Send() or die($MAIL->ErrorInfo);
			break;
			case 'SEASON_TICKETS_2011':
			case 'SEASON_TICKETS_2012':
				$data = unserialize($this->getRaw());
				
				$MAIL->Subject = 'Season Tickets Confirmation';
				$MAIL->Sender = 'boxoffice@unicorntheatre.org';
				$MAIL->From = 'boxoffice@unicorntheatre.org';
				$MAIL->FromName = 'Unicorn Theatre';
				
				$MAIL->AddCC('boxoffice@unicorntheatre.org','Unicorn Theatre');
				$MAIL->AddAddress($data['email'],$data['fname'] . ' ' .$data['lname']);
				
				// BUILD MAIL BODY
				$body = date('m/d/Y',mktime()) . "\n";
				$body.= 'Dear ' . $data['fname'] . ' ' . $data['lname'] . ",\n\n";
				
				$body.= 'Thank you for your Unicorn Theatre Subscription Purchase!' . "\n"; 
				$body.= 'This e-mail contains a summary of your order.  Your order has been received and will be processed by our box office shortly. You will receive your subscriber packet over the summer.  You can call to reserve your seats during regular box office hours by calling 816-531-7529 x 10.  Thank you for subscribing to the Unicorn Theatre for our 2011-2012 Season! ' . "\n\n";
				
				$body.= 'Order Summary' . "\n";
				$body.= 'ID: ' . $this->getId() . "\n";
				
				// TWO DIFFERENT TYPES OF PACAKGES
				$body.= 'Ticket Type: ' . $data['type'] . "\n";

				if($data['type'] == 'Series Season Package')
				{
					switch($data['series_package'])
					{
						case 'week1_wed':
							$body.= "Series Package: 7 Shows Week 1 Wednesday (Preview) - $140.00" . "\n";
						break;
						case 'week1_thur':
							$body.= "Series Package: 7 Shows Week 1 Thursday (Preview) - $140.00" . "\n";
						break;
						case 'week1_fri':
							$body.= "Series Package: 7 Shows Week 1 Friday (Preview) - $140.00" . "\n";
						break;
						case 'week1_sat':
							$body.= "Series Package: 7 Shows Week 1 Saturday (Opening Night) - $196.00" . "\n";
						break;
						case 'week1_sun':
							$body.= "Series Package: 7 Shows Week 1 Sunday - $196.00" . "\n";
						break;
						case 'week2_tues':
							$body.= "Series Package: 7 Shows Week 2 Tuesday (Talk Back) - $168.00" . "\n";
						break;
						case 'week2_wed':
							$body.= "Series Package: 7 Shows Week 2 Wednesday - $168.00" . "\n";
						break;
						case 'week2_thur':
							$body.= "Series Package: 7 Shows Week 2 Thursday - $168.00" . "\n";
						break;
						case 'week2_fri':
							$body.= "Series Package: 7 Shows Week 2 Friday - $196.00" . "\n";
						break;
						case 'week2_sat':
							$body.= "Series Package: 7 Shows Week 2 Saturday - $196.00" . "\n";
						break;
						case 'week2_sun':
							$body.= "Series Package: 7 Shows Week 2 Sunday (Talk Back) - $196.00" . "\n";
						break;
						case 'week3_tues':
							$body.= "Series Package: 7 Shows Week 3 Tuesday (Talk Back) - $168.00" . "\n"; 
						break;
						case 'week3_wed':
							$body.= "Series Package: 7 Shows Week 3 Wednesday - $168.00" . "\n";
						break;
						case 'week3_thur':
							$body.= "Series Package: 7 Shows Week 3 Thursday - $168.00" . "\n";
						break;
						case 'week3_fri':
							$body.= "Series Package: 7 Shows Week 3 Friday - $196.00" . "\n";
						break;
						case 'week3_sat':
							$body.= "Series Package: 7 Shows Week 3 Saturday - $196.00" . "\n";
						break;
						case 'week3_sun':
							$body.= "Series Package: 7 Shows Week 3 Sunday - $196.00" . "\n";
						break;
					}	
				}else{
					// Flexible Season Package
					$body.= 'Your Package: ' . $data['package'] . "\n";
					$body.= 'Number of Play: ' . $data['HowManyPlays'] . "\n";
				}
								
				$body.= 'Number of People: ' . $data['numberofseats'] . "\n\n";
				
				if($data['donation'] != '')
				{
					$body.= 'Donation: $' . number_format($data['donation'],2) . " USD\n";
				}
							
				$body.= 'Charge Amount: $' . $data['charge_amount'] . " USD\n\n";
				
				$body.= 'Credit Card Type: ' . $data['cc_type'] . "\n";
				$body.= 'Name on Credit Card: ' . $data['cc_name'] . "\n";
				
				$MAIL->Body = $body;
				$MAIL->Send() or die($MAIL->ErrorInfo);
			break;
			case 'SEASON_TICKETS':
				$data = unserialize($this->getRaw());
				
				$MAIL->Subject = 'Season Tickets Confirmation';
				$MAIL->Sender = 'boxoffice@unicorntheatre.org';
				$MAIL->From = 'boxoffice@unicorntheatre.org';
				$MAIL->FromName = 'Unicorn Theatre';
				$MAIL->AddCC('boxoffice@unicorntheatre.org','Unicorn Theatre');
				$MAIL->AddAddress($data['email'],$data['fname'] . ' ' .$data['lname']);
				
				// BUILD MAIL BODY
				
				$body = date('m/d/Y',mktime()) . "\n";
				$body.= 'Dear ' . $data['fname'] . ' ' . $data['lname'] . ",\n\n";
				$body.= 'Thank you for your Unicorn Theatre Subscription Purchase! ' . "\n";
				$body.= 'This e-mail contains a summary of your order. Please Note: Unicorn Theatre will add a $5 fee per ';
				$body.= 'subscriber  to your total.  Your order has been received and will be processed by our box office shortly. ';
				$body.= 'You will receive your subscriber packet within 5 business days.  You can call to reserve your seats during regular ';
				$body.= 'box office hours by calling 816-531-7529 x 10.  Thank you for subscribing to the Unicorn Theatre for our 2010-2011 Season!' . "\n\n";
				
				$body.= 'Order Summary' . "\n";
				$body.= 'ID: ' . $this->getId() . "\n";
				$body.= 'Your Package: ' . $data['package'] . "\n";
				$body.= 'Number of People: ' . $data['HowManyPlays'] . "\n";
				$body.= 'Number of Seats: ' . $data['numberofseats'] . "\n\n";
				
				if($data['donation'] != '')
				{
					$body.= 'Donation: $' . number_format($data['donation'],2) . " USD\n";
				}
							
				$body.= 'Charge Amount: $' . $data['charge_amount'] . "USD\n\n";
				
				$body.= 'Credit Card Type: ' . $data['cc_type'] . "\n";
				$body.= 'Name on Credit Card: ' . $data['cc_name'] . "\n";
				
				$MAIL->Body = $body;
				$MAIL->Send() or die($MAIL->ErrorInfo);
			break;
			case 'GIFT_CERTIFICATE':
				$data = unserialize($this->getRaw());
				
				$MAIL->Subject = 'Gift Certificate Confirmation';
				$MAIL->Sender = 'boxoffice@unicorntheatre.org';
				$MAIL->From = 'boxoffice@unicorntheatre.org';
				$MAIL->FromName = 'Unicorn Theatre';
				$MAIL->AddCC('boxoffice@unicorntheatre.org','Unicorn Theatre');
				$MAIL->AddAddress($data['email'],$data['fname'] . ' ' .$data['lname']);
				
				// BUILD MAIL BODY
				
				$number_for_email = number_format($data['charge_amount'],2);
				
/*
			switch($data['charge_amount']){
					case 25:
						$number_for_email = "$50 Black Friday Deal!";
						break;
					case 50:
						$number_for_email = "$100 Black Friday Deal!";
						break;
					case 75:
						$number_for_email = "$150 Black Friday Deal!";
						break;
					case 100:
						$number_for_email = "$200 Black Friday Deal!";
						break;
					case 125:
						$number_for_email = "$250 Black Friday Deal!";
						break;
					case 250:
						$number_for_email = "$500 Black Friday Deal!";
						break;
					case 500:
						$number_for_email = "$1000 Black Friday Deal!";
						break;
					
				}				
*/	
				
				
				$body = date('m/d/Y',mktime()) . "\n";
				$body.= 'Dear ' . $data['fname'] . ' ' . $data['lname'] . ",\n\n";
				$body.= 'Thank you for your purchase of a Gift Certificate (' . $number_for_email . ') ';
				$body.= 'Your gift certificate will be mailed to the indicated address within 3 business days. ' . "\n"; 
				$body.= 'If you have any questions, please direct them to the box office at ';
				$body.= '816-531-7529 x10 or boxoffice@unicorntheatre.org' . "\n\n";
				
				if($data['gift_type'] != '')
				{
					$body.= 'Gift Certificate Type: ' . $data['gift_type'] . "\n\n";
				}
				
				$MAIL->Body = $body;
				$MAIL->Send() or die($MAIL->ErrorInfo);
				break;
			case 'PLEDGE':
				$data = unserialize($this->getRaw());
				
				$MAIL->Subject = 'Pledge Confirmation';
				$MAIL->Sender = 'boxoffice@unicorntheatre.org';
				$MAIL->From = 'boxoffice@unicorntheatre.org';
				$MAIL->FromName = 'Unicorn Theatre';
				$MAIL->AddCC('boxoffice@unicorntheatre.org','Unicorn Theatre');
				$MAIL->AddAddress($data['email'],$data['fname'] . ' ' .$data['lname']);
				
				// BUILD MAIL BODY
				$body = date('m/d/Y',mktime()) . "\n";
				$body.= 'Dear ' . $data['fname'] . ' ' . $data['lname'] . ",\n\n";
				$body.= 'Thank you for your donation of ($' . $data['charge_amount'] . ' USD) to Unicorn Theatre.  We wouldn’t exist without the generosity ';
				$body.= 'of people like you.  Your name will appear as ('.$data['listby'].') in gift listings and acknowledgements. ';
				$body.= 'You will receive an acknowledgment letter for tax purposes in the coming weeks. ' . "\n\n";
				$body.= 'If you have any questions, please direct them to the development department at 816-531-7529 x12 or ggerling@unicorntheatre.org ';
				
				$MAIL->Body = $body;
				$MAIL->Send() or die($MAIL->ErrorInfo);
				break;
		}
	}
	
	public function processRecord($id)
	{
		global $dbconn;
		$tmpObj = new Charge_vault();
		$tmpObj->setId($id);
		$tmpObj->populate();

		$raw = unserialize($tmpObj->getRaw());
		$current_cc_num = $tmpObj->getCC_num();
		
		$count = strlen($current_cc_num);
		
		for($a=$count-4;$a<$count;$a++)
		{
			$tmp.=$current_cc_num[$a];
		}
		
		$new_cc_num = '**** **** **** ' . $tmp;
		$tmpObj->setCC_num($new_cc_num);
		$raw['cc_num'] = $new_cc_num;
		$new_raw = serialize($raw);
		$tmpObj->setRaw($new_raw);
		
		$tmpObj->setStatus(1);
		$tmpObj->update();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

?>