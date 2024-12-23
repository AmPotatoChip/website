<?

/*
# For this class to work you have to have $dbconn (ADODB) Connection.
# You will also need the database table called cms_admin_users
*/

CLASS USER_ADMINISTRATION{
	function adminUserEmailCheck($email){
		global $dbconn;
		
		$sql = "SELECT COUNT(id) AS `id_count` FROM cms_admin_users WHERE email='$email'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$id_count = $result->Fields('id_count');
		if($id_count>0){
			return false;	
		}else{
			return true;	
		}
	}
	
	function adminUserController($params,$type){
		global $dbconn;
		require_once('encryption_class.php');
		$ENC_CLASS = new ENCRYPTION_CALSS();
		$ENC_CLASS->encryption_key_file = BASE_PATH.'private/key.txt';
	
	
		foreach($params as $key=>$value){
			$p[$key]=addslashes($value);	
		}
		
		if($p[passwd]!=''){
			$p[passwd] = $ENC_CLASS->Encrypt_Data($p[passwd]);
		}
		
		switch($type){
			case 'new':
				if($this->adminUserEmailCheck($p[email])){
			
				$sql = "INSERT INTO cms_admin_users (fname,lname,address,city,state,zip,phone,email,passwd,user_privs,user_status,created) VALUES ('$p[fname]','$p[lname]','$p[address]','$p[city]','$p[state]','$p[zip]','$p[phone]','$p[email]','$p[passwd]','$p[user_privs]',1,NOW())";
				$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
				$return[msg]="The new user ($p[fname] $p[lname]) has been added to your system";
				$return[state]=true;
				return $return;
			}else{
				// the email is already in the system and can not be added again.
				$return[msg]="The email for the user you provided is already in the system and can not be added again.";
				$return[state]=false;
				return $return;
			}
			break;
			case 'update':
				// if the password is given we need to change the password.
				if(!empty($p[passwd])){
					// query with password update					
					$sql = "UPDATE cms_admin_users SET fname='$p[fname]',lname='$p[lname]',address='$p[address]',
					city='$p[city]',state='$p[state]',zip='$p[zip]',phone='$p[phone]',user_privs='$p[user_privs]',passwd='$p[passwd]'
					WHERE id='$p[id]'";
					$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg);
					$return[msg]="User information has been updated";
					$return[state]=true;
					return $return;
					
				}else{
					// query just normal info update.
					$sql = "UPDATE cms_admin_users SET fname='$p[fname]',lname='$p[lname]',address='$p[address]',
					city='$p[city]',state='$p[state]',zip='$p[zip]',phone='$p[phone]',user_privs='$p[user_privs]'
					WHERE id='$p[id]'";
					$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg);
					$return[msg]="User information has been updated";
					$return[state]=true;
					return $return;
				}
			break;
		}
	}
	
	function assignAllAdminUsers(){
		global $dbconn,$smarty_vars,$smarty;
		require_once('encryption_class.php');
		$ENC_CLASS = new ENCRYPTION_CALSS();
		$ENC_CLASS->encryption_key_file = BASE_PATH.'private/key.txt';
		
		$sql = "SELECT * FROM cms_admin_users ORDER BY fname";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$x=0;
		while(false!=($row=$result->FetchRow())){
			$data[$x]->id = $row[id];
			$data[$x]->fname = $row[fname];
			$data[$x]->lname = $row[lname];
			$data[$x]->phone = $row[phone];
			$data[$x]->email = $row[email];
			$data[$x]->user_privs = $row[user_privs];
			$data[$x]->passwd = $ENC_CLASS->Decrypt_Data($row[passwd]);
			$x++;	
		}
		
		if(!empty($data)){
			$smarty->assign('users',$data);
		}
	}

	function assignAdminInfoById($admin_user_id){
		global $dbconn,$smarty;
		$sql = "SELECT * FROM cms_admin_users WHERE id='$admin_user_id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$data = $result->FetchRow();
		
		if(!empty($data)){
			unset($data[passwd]);
			$smarty->assign($data);	
		}
	}
	
	function userLogin($params){
		global $dbconn;
		require_once('encryption_class.php');
		$ENC_CLASS = new ENCRYPTION_CALSS();
		$ENC_CLASS->encryption_key_file = BASE_PATH.'private/key.txt';
		
		$passwd = $ENC_CLASS->Encrypt_Data($params[passwd]);
		
		
		$sql = "SELECT id,fname,lname FROM cms_admin_users WHERE email='$params[email]' AND passwd='$passwd'";
		//echo $sql;exit;
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$id = $result->Fields('id');
		if($id>0){
			$_SESSION[admin_user_id]=$id;
			$_SESSION[admin_user_name]=$result->Fields('fname').' '.$result->Fields('lname');
			return true;	
		}else{
			return false;	
		}
	}
	
	function userDelete($admin_user_id){
		global $dbconn;
		$sql = "DELETE FROM cms_admin_users WHERE id='$admin_user_id'";
		$result = $dbconn->Execute($sql);	
	}
	

}

?>