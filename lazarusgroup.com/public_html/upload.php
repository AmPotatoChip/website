<?php
$output_dir = "/var/www/sites/lazarusgroup.com/uploads/";
if(isset($_FILES["myfile"]))
{
	$ret = array();
	
//	This is for custom errors;	
/*	$custom_error= array();
	$custom_error['jquery-upload-file-error']="File already exists";
	echo json_encode($custom_error);
	die();
*/
	$error =$_FILES["myfile"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
 	 	$fileName = $_FILES["myfile"]["name"];
 	 	$fileName = $fileName.$_POST['printmedia'];
 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
    	$ret[]= $fileName;
    	mail("solutions@lazarusgroup.com","File Uploaded to site.","
    	
    			FILE : $fileName
    	
    			",
    			"From: solutions@lazarusgroup.com");
	}
	else  //Multiple files, file[]
	{
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i < $fileCount; $i++)
	  {
	  	$fileName = $_FILES["myfile"]["name"][$i];
		move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
	  	$ret[]= $fileName;
	  	
        mail("solutions@lazarusgroup.com","File Uploaded to site.","
        
        FILE : $fileName

        ",
        "From: solutions@lazarusgroup.com");
	  		  	
	  	
	  	
	  	
	  	
	  }
	
	}
    echo json_encode($ret);
 }
 ?>