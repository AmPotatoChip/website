<?

##### ADODB CONNECTION FILE

$db_db = "tlg";
$db_uid = "tlg";
$db_pwd = "555tlg999";
$db_primary = "localhost";

# Load ADOdb library for database functionality
require_once('adodb.inc.php');

$dbconn = &ADONewConnection('mysql');  # create a connection to mysql
$dbconn->noNullStrings = true;
$dbconn->Connect($db_primary,$db_uid,$db_pwd,$db_db);

$dbconn->SetFetchMode(ADODB_FETCH_ASSOC);
if (!$dbconn) { die("Database connection errors have occured. We are sorry for the inconvenience. Please try again later."); }


echo'<pre>';
 
echo $query;
print_r($dbconn);exit;



