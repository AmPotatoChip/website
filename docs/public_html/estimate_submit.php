<?
require('common/page_start.php');

if(!empty($_POST))
{
	// CHECKING TO MAKE SURE THIS IS NOT SOME AUTOMATED SCRIPT TRYING TO DONATE!
	if($_POST['math_result'] != $_SESSION['captcha']['result'])
	{
		print 'The math result you provided is incorrect, please double check';
		exit;
	}
	
	require_once 'common/classDonations.php';	
	require_once 'common/classDonations_custom.php';
	require_once 'common/linkpoint.php';

	$myDonation = new Donations_custom();
	
	$myDonation->setFname($_POST['fname']);
	$myDonation->setLname($_POST['lname']);
	$myDonation->setEmail($_POST['email']);
	$myDonation->setPhone($_POST['phone']);
	$myDonation->setAddress($_POST['address']);
	$myDonation->setAddress2($_POST['address2']);
	$myDonation->setCity($_POST['city']);
	$myDonation->setState($_POST['state']);
	$myDonation->setZip($_POST['zip']);
	
	$myDonation->setDonation_type($_POST['monthly_recuring']);
	$myDonation->setAmount($_POST['charge_amount']);
	
	$myDonation->setCc_type($_POST['cc_type']);
	$myDonation->setCc_name($_POST['cc_name']);
	
	$real_cc_num = $_POST['cc_num'];
	$myDonation->setCc_num(Donations_custom::returnLastFour($_POST['cc_num']));
	
	$myDonation->setCc_exp($_POST['cc_mm'].'/'.$_POST['cc_yy']);
	$myDonation->setCc_ccv($_POST['cc_ccv']);
	
	$myDonation->setComment($_POST['comment']);
	
	if($myDonation->hasError())
	{
		print $myDonation->getHtmlError();
		exit;
	}else{
		// WE CAN SAVE THE RECORD EVERYTHING IS THERE THAT NEEDS TO BE THERE
 		// FIRST WE STORE THE CSV LINE


		if($_POST['charge_amount']>=5)
			$transaction_result = process_transaction($_POST);
		
// 		echo '<pre>';
// 		print_r($transaction_result);
// 		exit;

		if($transaction_result["r_approved"] != "APPROVED"){
			print "Transaction was declined, <br>{$transaction_result["r_message"]}<br>	{$transaction_result["r_error"]}<br>";
 		}else{
	 		$myDonation->save();
	 		$myDonation->populate();
	 		$myDonation->storeCsvData($real_cc_num);
	 		
	 		// Sending off EMAIL Confirmation
	 		$myDonation->emailReceipt();
 		}
 		
	}
}

?>
