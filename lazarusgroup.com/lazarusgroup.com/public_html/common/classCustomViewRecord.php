<?php

class CustomViewRecord{
	
	public $form_name = '';
	public $form_params;
	
	function __construct()
	{
		
	}
	
	function __destruct()
	{
		
	}
	
	public function convert()
	{
		if(!empty($this->form_params) && $this->form_name != '')
		{
			switch($this->form_name)
			{
				case 'EVENTS2011':
					$out = array();
					$in = $this->form_params;
					
					$tmpTotal = (30*$in['event1']);
					$out['Coffee in the Congo with Ricardo Khan'] =  '$30.00 USD X ' . $in['event1'] . ' Ticket(s) = $' . number_format($tmpTotal,2) . ' USD';
					unset($tmpTotal);
					
					$tmpTotal = (50*$in['event2']);
					$out['How Merlot Can You Go'] =  '$50.00 USD X ' . $in['event2'] . ' Ticket(s) = $' . number_format($tmpTotal,2) . ' USD';
					unset($tmpTotal);
					
					$tmpTotal = (40*$in['event3']);
					$out['Party After the Arty'] =  '$40.00 USD X ' . $in['event3'] . ' Ticket(s) = $' . number_format($tmpTotal,2) . ' USD';
					unset($tmpTotal);
					
					$tmpTotal = (65*$in['event4']);
					$out['A Tour Through The Gardens'] =  '$65.00 USD X ' . $in['event4'] . ' Ticket(s) = $' . number_format($tmpTotal,2) . ' USD';
					unset($tmpTotal);
					
					$tmpTotal = (50*$in['event5']);
					$out['Skyline Soiree'] =  '$50.00 USD X ' . $in['event5'] . ' Ticket(s) = $' . number_format($tmpTotal,2) . ' USD';
					unset($tmpTotal);
					
					$tmpTotal = (65*$in['event6']);
					$out['Tipsy at the Tee Pee'] =  '$65.00 USD X ' . $in['event6'] . ' Ticket(s) = $' . number_format($tmpTotal,2) . ' USD';
					unset($tmpTotal);
					
					$tmpTotal = (100*$in['event7']);
					$out['i-Ron Chef: A Cooking Event With Ron Megee'] =  '$100.00 USD X ' . $in['event7'] . ' Ticket(s) = $' . number_format($tmpTotal,2) . ' USD';
					unset($tmpTotal);
					
					$tmpTotal = (150*$in['event8']);
					$out['i-Ron Chef: A Cooking Event With Ron Megee - VIP Ticket'] =  '$150.00 USD X ' . $in['event8'] . ' Ticket(s) = $' . number_format($tmpTotal,2) . ' USD';
					unset($tmpTotal);
					
					$out['Guest #1'] = $in['guest1'];
					$out['Guest #2'] = $in['guest2'];
					$out['Guest #3'] = $in['guest3'];
					$out['Guest #4'] = $in['guest4'];
					
					$out['Donation'] = '$' . number_format($in['donation'],2) . ' USD';
					
					$out['First Name'] = $in['fname'];
					$out['Last Name'] = $in["lname"];
					
					$out['Email Address'] = $in['email'];
					$out['Phone'] = $in['phone'];
					$out['Address'] = $in['address'];
					$out['Address2'] = $in['address2'];
					$out['City'] = $in['city'];
					$out['State'] = $in['state'];
					$out['Zip Code'] = $in['zip'];
					
					$out['Credit Card Type'] = $in['cc_type'];
					$out['Name on Credit Card'] = $in['cc_name'];
					$out['Credit Card Number'] = $in['cc_num'];
					$out['Credit Card Expiration Date'] = $in['cc_mm'].'/'.$in['cc_yy'];
					$out['Security Code'] = $in['security_code'];
					
					$out['CC Address'] = $in['cc_address'];
					$out['CC Address2'] = $in['cc_address2'];
					$out['CC City'] = $in['cc_city'];
					$out['CC State'] = $in['cc_state'];
					$out['CC Zip Code'] = $in['cc_zip'];
					$out['Charge Amount'] = '$' . number_format($in['charge_amount'],2) . ' USD';
					
					$out['Comment'] = $in['comment'];
					
					$out['Form Name'] = $in['form_name'];
					
					
					
//					print_r($this->form_params);
					
					return $out;
				break;
				
				default:
					return $this->form_params;
				break;
			
			}
		}
	}
	
	
	
}

?>