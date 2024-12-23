<?
require_once('../../private/dbconn.php');
$sql = "SELECT id FROM cms_contact";
$result = $dbconn->Execute($sql);
while(false!=($row=$result->FetchRow())){
	$data[]=$row[id];	
}

$cat = 2;
foreach($data AS $tmp_id){
	$sql = "INSERT INTO cms_contact_category_connection (category_id,contact_id) 
	VALUES ('$cat','$tmp_id')";
	$dbconn->Execute($sql);
}
?>