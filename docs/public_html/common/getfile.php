<HTML>
<HEAD>
<TITLE> The Lazarus Group</TITLE>
</HEAD>
<BODY>
<?php
if(!empty($_REQUEST)){
  foreach($_REQUEST AS $label=>$value)
  {
  $$label = $value;
  }
}



//$uploaddir = '/home/lazwebupload/';
//$path_to_file = '/home/lazwebupload/';

$uploaddir = "/var/www/sites/lazarusgroup.com/uploads/";
$path_to_file ="/var/www/sites/lazarusgroup.com/uploads/";



$tempname = $_FILES['userfile']['name'];

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$_FILES['userfile']['name'])) {
	mail("solutions@lazarusgroup.com","File Uploaded to site.","
	NAME: $fname $lname
	ADDRESS: $address
		$city $state $zip

	E-MAIL: $email
	PHONE: $phone
	SIZE: $width x $height 
	NUMBER OF COPIES $copies 
	MEDIA $printmedia
	COMMENT: $comment
	FILE : $tempname
	
	",
	"From: solutions@lazarusgroup.com");
	
	$_SESSION['msg'] = $_FILES['userfile']['name']." uploaded successful.";
} else {
	$_SESSION['msg'] = "Upload Error.";
}
header("location:/index.php?page=message");
exit;


?>
</BODY>
</HTML>
