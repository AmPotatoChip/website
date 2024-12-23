<?php

$googleapikey = 'AIzaSyDRkmgzDBtHmcBHnrW1AHRObz8Zoxhua8Q';


// The only arguments are "address" and "callback" (the latter optional for JSONP)

//$url = "https://www.googleapis.com/civicinfo/v2/voterinfo/?key=AIzaSyDRkmgzDBtHmcBHnrW1AHRObz8Zoxhua8Q&electionId=6000&returnAllAvailableData=true";
//$url = "https://www.googleapis.com/civicinfo/v2/electionQuery/?key=AIzaSyDRkmgzDBtHmcBHnrW1AHRObz8Zoxhua8Q";
//$url = "https://www.googleapis.com/civicinfo/v2/divisions/?key=AIzaSyDRkmgzDBtHmcBHnrW1AHRObz8Zoxhua8Q";
//$url = "https://www.googleapis.com/civicinfo/v2/representatives?key=AIzaSyDRkmgzDBtHmcBHnrW1AHRObz8Zoxhua8Q&address=3212 gillham road kansas city mo 64109";
$url = "https://www.googleapis.com/civicinfo/v2/representatives/?key=AIzaSyDRkmgzDBtHmcBHnrW1AHRObz8Zoxhua8Q";


$db_db = "voterdata";
$db_uid = "lazarus";
$db_pwd = "p1eces0f8";
$db_primary = "localhost";

# Load ADOdb library for database functionality
require_once('adodb.inc.php');

$dbconn = &ADONewConnection('mysql');  # create a connection to mysql
$dbconn->noNullStrings = true;
$dbconn->Connect($db_primary,$db_uid,$db_pwd,$db_db);

$dbconn->SetFetchMode(ADODB_FETCH_ASSOC);
if (!$dbconn) {
	die("Database connection errors have occured. We are sorry for the inconvenience. Please try again later.");
}


//$sql = "SELECT * from carpmembers  where cd =''";
$sql = "SELECT * from carpmembers  where county = 'Marion' and state = 'il' order by toolboxid";

$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());

$x=0;

while(false!=($row=$result->FetchRow())){
	$x++;
	
	//make address
	$fooaddress = $row['address'].' '.$row['city'].' '.$row['state'].' '.$row['zip'];
	$urladdress = urlencode($fooaddress);
	//$url = $url.'&address='.$urladdress;
	
	//call API
	$ch = curl_init($url.'&address='.$urladdress);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$json = curl_exec($ch);
	$foo = json_decode($json);	
	curl_close($ch);
	
	$divisions = $foo->divisions;
	$data = array();
	foreach($divisions as $key=>$value){
		$level="";
	
		$level = explode('/', $key);
		/*
		if(isset($level[3])){
			$sublevel = explode(':', $level[3]);
	
		switch ($sublevel[0]){
				case 'cd':
					$data['CD'] = $sublevel[1];
					break;
				case 'sldl':
					$data['REP'] = $sublevel[1];
					break;
				case 'sldu':
					$data['SENATE'] = $sublevel[1];
					break;
						
			}
	*/		
			if(isset($level[4])){
				$sublevel = explode(':', $level[4]);
			
				switch ($sublevel[0]){
					case 'council_district':
						$data['council_district'] = $sublevel[1];
						break;
			
				}
					
			
			
			/*
			 echo '<br>';
			echo $sublevel[0].' - '.$sublevel[1];
			echo '<br>';
			*/
		}//if
	}//foreach
	
	//update record
	/*$updatesql = "UPDATE carpmembers SET
	cd = '{$data['CD']}',
	hd = '{$data['REP']}',
	sd = '{$data['SENATE']}'
	where 
	toolboxid = '{$row['toolboxid']}'";
*/
	$updatesql = "UPDATE carpmembers SET
	countydistrict = '{$data['council_district']}'
	where
	toolboxid = '{$row['toolboxid']}'";
	
	
	
	//echo $updatesql.'<br>';//.$url.'<br>';
	$resultupdate = $dbconn->Execute($updatesql) or die($dbconn->ErrorMsg());
	
	//exit;	
		
	//if($x>100)
	//	exit;
		
	
}//end while


/*
$address = "3212 gillham road kansas city mo 64109";

$urladdress = urlencode($address);
//$url = "https://www.googleapis.com/civicinfo/v2/representatives?key=AIzaSyDRkmgzDBtHmcBHnrW1AHRObz8Zoxhua8Q&address=1263%20Pacific%20Ave.%20Kansas%20City%20KS";

$url = $url.'&address='.$urladdress;

//echo $url;exit;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($ch);
$foo = json_decode($json);
curl_close($ch);

$divisions = $foo->divisions;
echo '<pre>';


foreach($divisions as $key=>$value){
	
	$level = explode('/', $key);
	if(isset($level[3])){
		$sublevel = explode(':', $level[3]);
		
		switch ($sublevel[0]){
			case 'cd':
				$data['CD'] = $sublevel[1];
				break;
			case 'sldl':
				$data['REP'] = $sublevel[1];
				break;
			case 'sldu':
				$data['SENATE'] = $sublevel[1];
				break;
							
		}

	}
	
	
	echo $key.' - ';
	echo $value->name;
	echo '<br>';
	
	
}
	echo $data['CD'].' - '.$data['REP'].' - '.$data['SENATE'].' - ';
//print_r($divisions);
*/
?>