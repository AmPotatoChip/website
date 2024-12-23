<?php
/*******************************************************************************
 *                VirtualMerchant Interface using CURL
 *******************************************************************************
 *      Author:     Lazarus Potter
 *      Email:      solutions@lazarusgorup.com
 *      Website:    N/A
 *
 *      File:       virtualmerchant.class.php
 *      Version:    1.00
 *      Copyright:  (c) 2010 - Lazarus Potter
 *                  You are free to use, distribute, and modify this software 
 *                  under the terms of the GNU General Public License.  See the
 *                  included license.txt file.
 *      
 *******************************************************************************
 *  REQUIREMENTS:
 *      - PHP5+ with CURL and SSL support
 *      - An VirtualMerchant  merchant account
 *      - (optionally) https://www.myvirtualmerchant.com
 *  
 *******************************************************************************
 *  VERION HISTORY:
 *  
 *
 *******************************************************************************
 *  DESCRIPTION:
 *
 *      This class was developed to simplify interfacing a PHP script to the
 *      https://www.myvirtualmerchant.com payment gateway.  It does not do all the work for
 *      you as some of the other scripts out there do.  It simply provides
 *      an easy way to implement and debug your own script.  
 * 
 *******************************************************************************
*/

class virtualmerchant_class {
   var $field_string;
   var $fields = array();
   var $response_string;
   var $response = array();
   var $gateway_url = "https://www.myvirtualmerchant.com/VirtualMerchant/process.do";


   function add_field($field, $value) {
      // adds a field/value pair to the list of fields which is going to be 
      // passed to authorize.net.  For example: "x_version=3.1" would be one
      // field/value pair.  A list of the required and optional fields to pass
      // to the authorize.net payment gateway are listed in the AIM document
      // available in PDF form from www.authorize.net
//      $this->fields["$field"] = urlencode($value);   
      $this->fields["$field"] = $value;   
   }

   function process() {
      // This function actually processes the payment.  This function will 
      // load the $response array with all the returned information.  The return
      // values for the function are:
      // 1 - Approved
      // 2 - Declined
      // 3 - Error
      // construct the fields string to pass to authorize.net

      foreach( $this->fields as $key => $value ) 
         $this->field_string .= "$key=" . urlencode( $value ) . "&";
         
         
      // execute the HTTPS post via CURL
      $ch = curl_init($this->gateway_url); 
      
//      curl_setopt($ch, CURLOPT_HEADER, 0); 
//      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
//      curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $this->field_string, "& " )); 
//      
//	  curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
//      $this->response_string = urldecode(curl_exec($ch));

   $refer = $_SERVER["HTTP_REFERER"];

  $postdata = substr($this->field_string, 0, -1);
   $url = 'https://www.myvirtualmerchant.com/VirtualMerchant/process.do';
 
$ch = curl_init();
  curl_setopt($ch, CURLOPT_REFERER, $refer);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_NOPROGRESS, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION,0);
  $authorize = curl_exec($ch);
  if ($error = curl_error($ch)) {
    print_r($error);
  }
  curl_close($ch);

  $authorize = trim($authorize);
//  print"<pre>";
// print_r($postdata);
// print_r($authorize);exit;
  
  $authorize = str_replace("\r", "", $authorize);
  $authorize = str_replace("\n", "&", $authorize);

  // Put the results into an associative array.
  parse_str($authorize, $response);

  $ssl_result = $response['ssl_result'];
  $ssl_txn_id = $response['ssl_txn_id'];
                       
  $ssl_approval_text = $response['ssl_avs_response'];
  
//  $ssl_approval_text = uc_virtualmerchant_get_response_text($response['ssl_avs_response']);

  $ssl_approval_code = $response['ssl_approval_code'];

  if ($ssl_result != '0') {
    $result = array(
      'success' => FALSE,
      'comment' => 'Credit card payment declined.',
      'message' => 'Credit card payment declined error message. '.print_r($response, TRUE),
      'ssl_approval_code' => $ssl_approval_code,
 		'ssl_approval_text'=>$ssl_approval_text,
 		'ssl_txn_id'=>$ssl_txn_id,
 	      'uid' => $user->uid,
    );
  }
  else {
    $result = array(
      'success' => TRUE,
      'comment' => 'Credit card payment processed successfully.',
      'message' => 'Credit card payment processed successfully.',
      'ssl_approval_code' => $ssl_approval_code,
 		'ssl_approval_text'=>$ssl_approval_text,
 		'ssl_txn_id'=>$ssl_txn_id,
      'uid' => $user->uid,
    );
  }

  $this->response= $result;
   
   


      return $this->response;
   }

   function get_response_reason_text() {
      return $this->response['Response Reason Text'];
   }

   function dump_fields() {
      // Used for debugging, this function will output all the field/value pairs
      // that are currently defined in the instance of the class using the
      // add_field() function.
      echo "<h3>authorizenet_class->dump_fields() Output:</h3>";
      echo "<table width=\"95%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\">
            <tr>
               <td bgcolor=\"black\"><b><font color=\"white\">Field Name</font></b></td>
               <td bgcolor=\"black\"><b><font color=\"white\">Value</font></b></td>
            </tr>"; 
      foreach ($this->fields as $key => $value) {
         echo "<tr><td>$key</td><td>".urldecode($value)."&nbsp;</td></tr>";
      }

      echo "</table><br>"; 
   }

   function dump_response() {
      // Used for debuggin, this function will output all the response field
      // names and the values returned for the payment submission.  This should
      // be called AFTER the process() function has been called to view details
      // about authorize.net's response.

      echo "<h3>virtualmerchant_class->dump_response() Output:</h3>";
      echo "<table width=\"95%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\">
            <tr>
               <td bgcolor=\"black\"><b><font color=\"white\">Index&nbsp;</font></b></td>
               <td bgcolor=\"black\"><b><font color=\"white\">Field Name</font></b></td>
               <td bgcolor=\"black\"><b><font color=\"white\">Value</font></b></td>
            </tr>";

      $i = 0;
      foreach ($this->response as $key => $value) {
         echo "<tr>
                  <td valign=\"top\" align=\"center\">$i</td>
                  <td valign=\"top\">$key</td>
                  <td valign=\"top\">$value&nbsp;</td>
               </tr>";
         $i++;
      } 

      echo "</table><br>";

   }
   
function uc_virtualmerchant_get_response_text($code) {
	
  $codes = array (
    'A' => 'Address matches - Zip Code does not match.',
    'B' => 'Street address match, Postal code in wrong format. (International issuer)',
    'C' => 'Street address and postal code in wrong formats',
    'D' => 'Street address and postal code match (international issuer)',
    'E' => 'AVS Error',
    'G' => 'Service not supported by non-US issuer',
    'I' => 'Address information not verified by international issuer.',
    'M' => 'Street Address and Postal code match (international issuer)',
    'N' => 'No Match on Address (Street) or Zip',
    'O' => 'No Response sent',
    'P' => 'Postal codes match, Street address not verified due to incompatible formats.',
    'R' => 'Retry, System unavailable or Timed out',
    'S' => 'Service not supported by issuer',
    'U' => 'Address information is unavailable',
    'W' => '9 digit Zip matches, Address (Street) does not match.',
    'X' => 'Exact AVS Match',
    'Y' => 'Address (Street) and 5 digit Zip match.',
    'Z' => '5 digit Zip matches, Address (Street) does not match.'
  );
  
  return $codes[$code]; 
}    

}