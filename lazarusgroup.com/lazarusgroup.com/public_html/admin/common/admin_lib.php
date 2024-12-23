<?
// Present Magazine Admin Library.

function checkUserLogin(){
	// we need to check if the user is log'ed in.
	// if you is not loged in we need to direct to login page.
	if(!$_SESSION[admin_user_id]){
		header("location:login.php");
	}	
}

function getCategories(){
	global $dbconn;
	$sql = "SELECT id,name,description FROM cms_article_category ORDER BY name";	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;
	while($row = $result->FetchRow()){
		$data[$x]->id=$row[id];
		$data[$x]->name=$row[name];
		$data[$x]->description=$row[description];
		$x++;	
	}
	return $data;
}

function assignCategoryInfo($catid){
	global $dbconn,$smarty,$smarty_vars;
	$sql = "SELECT * FROM cms_article_category WHERE id='$catid'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$data = $result->FetchRow();
	$smarty->assign($data);
}

function deletePostForm($form_id){
	global $dbconn;
	$sql = "SELECT contact_id FROM cms_contact_forms WHERE id='$form_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$contact_id = $result->Fields('contact_id');
	$sql = "DELETE FROM cms_contact_forms WHERE id='$form_id'";
	$dbconn->Execute($sql);
	$msg = 'Form has been deleted';
	header("location:edit_contact.php?contact_id=$contact_id&msg=$msg");
	exit;
}

function categoryController($postparam){
	global $dbconn,$smarty,$smarty_vars;
	// first we have to determin if the post is a new one or an update.
	foreach($postparam as $key=>$value){
		$$key=addslashes($value);	
	}
	
	if($update){
		// this is the update to a exsisting category.
		$sql = "UPDATE cms_article_category SET name='$name',description='$description',set_headline='$set_headline',
		set_subhead='$set_subhead',set_exerpt='$set_exerpt',set_byline='$set_byline',set_dateline='$set_dateline',no_articles='$no_articles',
		header_media_id='$header_media_id',square_media_id='$square_media_id',
		navlevel='$navlevel',position='$position' 
		WHERE id='$update'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		$smarty_vars[error_text]="Your category <b>\"$name\"</b> has been updated.";
		$smarty_vars[error]=true;
		return true;
	}else{
		// insertion of a new category into db.
		
		if(checkCategoryName($name)){
		
		$sql = "INSERT INTO cms_article_category (name,description,set_headline,set_subhead,set_exerpt,set_byline,set_dateline,no_articles,created,header_media_id,square_media_id,navlevel,position ) 
		VALUES ('$name','$description','$set_headline','$set_subhead','$set_exerpt','$set_byline','$set_dateline','$no_articles',NOW(),'$header_media_id','$square_media_id','$navlevel','$position' )";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		$smarty_vars[error_text]="Your new category <b>\"$name\"</b> has been added to the system.";
		$smarty_vars[error]=true;
		return true;
		}else{
			$smarty->assign('error_text',"The category name <b>\"$name\"</b> is already in the system.");
			return false;	
		}
	}
}

function checkCategoryName($category_name){
	global $dbconn;
	$sql ="SELECT COUNT(id) AS name_check FROM cms_article_category WHERE name='$category_name'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$name_check = $result->Fields('name_check');
	if($name_check<1){
		return true;	
	}else{
		return false;
	}	
}

function assignCategoryContent($catid){
	global $dbconn,$smarty;
	$sql = "SELECT * FROM cms_article WHERE cat_id='$catid' AND article_status in ('archived','off')";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;
	while(false!=($row=$result->FetchRow())){
		foreach($row AS $key=>$value){
			$data[$x]->$key=$value;	
		}	
		$x++;
	}
	if(!empty($data)){
		$smarty->assign('content',$data);	
	}
}

function assignLiveCategoryContent($catid){
	global $dbconn,$smarty;
	$sql = "SELECT * FROM cms_article WHERE cat_id='$catid' AND article_status in ('live') ORDER BY in_cat_order";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;
	while(false!=($row=$result->FetchRow())){
		foreach($row AS $key=>$value){
			$data[$x]->$key=$value;	
		}	
		$x++;
	}
	if(!empty($data)){
		$smarty->assign('livecontent',$data);	
	}
}

function assignEditorSetup($catid){
	global $dbconn,$smarty;
	$sql = "SELECT * FROM cms_article_category WHERE id='$catid' LIMIT 0,1";	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$data=$result->FetchRow();
	if(!empty($data)){
		$smarty->assign('editor_setup',$data);	
	}
}

function reorderArticlesByCatId($catid){
	global $dbconn;
	$sql = "SELECT id FROM cms_article WHERE article_status='live' AND cat_id='$catid' ORDER BY in_cat_order";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	while(false!=($row=$result->FetchRow())){
		$article_ids[]=$row[id];
	}
	
	$x=1;
	foreach($article_ids as $id){
		$sql = "UPDATE cms_article SET in_cat_order='$x' WHERE id='$id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$x++;	
	}
}	

function contentController($postparam){
	global $dbconn,$smarty_vars;
	foreach($postparam as $key=>$value){
		$$key=addslashes($value);
	}
	
	if($update){
		// need to check if the category changed if it did we need to move it over to the new one and change it's order. :-)
		$sql = "SELECT cat_id FROM cms_article WHERE id='$update'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$current_article_cat_id = $result->Fields('cat_id');
		
		if($current_article_cat_id!=$cat_id){
			$sql = "UPDATE cms_article SET seo_title='$seo_title',seo_keywords='$seo_keywords',seo_description='$seo_description',headline='$headline',subhead='$subhead',exerpt='$exerpt',full_content='$full_content',byline='$byline',dateline='$dateline',article_status='off',in_cat_order='',cat_id='$cat_id' WHERE id='$update'";
			reorderArticlesByCatId($current_article_cat_id);
		}else{
			$sql = "UPDATE cms_article SET seo_title='$seo_title',seo_keywords='$seo_keywords',seo_description='$seo_description',headline='$headline',subhead='$subhead',exerpt='$exerpt',full_content='$full_content',byline='$byline',dateline='$dateline' WHERE id='$update'";
		}
		
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		contentDroppers($update,$full_content);
		
		if($result){
			$smarty_vars[error]=true;
			$smarty_vars[error_text]='Your article has been updated.';
			return true;	
		}else{
			return false;	
		}
	}else{
		$sql = "SELECT MAX(in_cat_order) AS highest_order FROM cms_article WHERE cat_id='$catid'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$highest_order = $result->Fields('highest_order');
		if($highest_order==0){
			$next=1;	
		}else{
			$next = $highest_order+1;
		}
		
		$sql = "INSERT INTO cms_article (cat_id,headline,subhead,exerpt,full_content,byline,dateline,in_cat_order,created,seo_title,seo_keywords,seo_description) VALUES 
		('$catid','$headline','$subhead','$exerpt','$full_content','$byline','$dateline','$next',NOW(),'$seo_title','$seo_keywords','$seo_description')";
		$result=$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		$sql = "SELECT LAST_INSERT_ID() AS article_id";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$article_id = $result->Fields('article_id');
		
		contentDroppers($article_id,$full_content);
		
		if($result){
			$smarty_vars[error]=true;
			$smarty_vars[error_text]='Your new article has been added to the database';
			return true;
		}else{
			return false;	
		}
	}
}


function contentDroppers($article_id,$content){
	global $dbconn;
	
	$matches = array();
	
	$replace_content = str_replace("}","}\n--",$content);
	
	$nameDropperPatter="/(\{ND )(.*)(\})/e";
//	$nameDropperPatter="/({ND ).+(})/e";
	preg_match_all($nameDropperPatter,$replace_content,$matches,PREG_SET_ORDER);
	
	$sql = "DELETE FROM cms_name_dropper WHERE article_id='$article_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	if(!empty($matches)){
	foreach($matches As $tmp_dropper_name){
		$tmp_dropper_name[2]=strip_tags($tmp_dropper_name[2]);
		$sql = "INSERT INTO cms_name_dropper (article_id,name,created) VALUE ('$article_id','$tmp_dropper_name[2]',NOW())";
		$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	}
	}
	
	// Name Droppers have been updated.
	
	$matches=array();
	$nameDropperPatter="/(\{KEY )(.*)(\})/e";
	preg_match_all($nameDropperPatter,$replace_content,$matches,PREG_SET_ORDER);
	
	$sql = "DELETE FROM cms_index_dropper WHERE article_id='$article_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	if(!empty($matches)){
		foreach($matches as $tmp_index_name){
			$tmp_index_name[2]=strip_tags($tmp_index_name[2]);
			$sql = "INSERT INTO cms_index_dropper (article_id,name,created) VALUE ('$article_id','$tmp_index_name[2]',NOW())";
			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		}	
	}
	
	$matches=array();
	$nameDropperPattern="/(\{MEDIA )(.*)(\})/e";
	preg_match_all($nameDropperPattern,$replace_content,$matches,PREG_SET_ORDER);
	
	$sql = "DELETE FROM cms_media_dropper WHERE article_id='$article_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	
	if(!empty($matches)){
		foreach($matches as $tmp_media){
			$sql = "INSERT INTO cms_media_dropper (article_id,media_id,created) VALUE ('$article_id','$tmp_media[2]',NOW())";
			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());	
		}	
	}
	
	return true;
}

function delete_article($article_id,$catid){
	global $dbconn;
	$sql = "DELETE FROM cms_article WHERE id='$article_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$sql = "SELECT id,in_cat_order FROM cms_article WHERE cat_id='$catid'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$x=1;
	while(false!=($row=$result->FetchRow())){
		$data[$row[id]]=$x;
		$x++;
	}
	
	
	foreach($data as $tmp_ai=>$pos){
		$sql = "UPDATE cms_article SET in_cat_order='$pos' WHERE id='$tmp_ai'";
		$dbconn->Execute($sql) or die($dbconn->ErrorMsg());	
	}
	
	header("location:content_editor.php?catid=$catid&type=live");
	exit;
}

function assignContent($article_id){
	global $dbconn,$smarty;
	$sql = "SELECT * FROM cms_article WHERE id='$article_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$data=$result->FetchRow();
	
	$data[update]=$data[id];
	$smarty->assign($data);
}

function reorderArticle($article_id,$newpos){
	global $dbconn;
	$sql = "SELECT cat_id FROM cms_article WHERE id='$article_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->Execute($sql));
	$cat_id = $result->Fields('cat_id');

	$sql = "SELECT id,in_cat_order FROM cms_article WHERE cat_id='$cat_id' AND article_status='live' ORDER BY in_cat_order";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	while(false!=($row=$result->FetchRow())){
		$current[$row[id]]=$row[in_cat_order];	
	}
	
	$in_progress=$current;
	unset($in_progress[$article_id]);
	
	$new[$article_id]=$newpos;
	$x=1;
	foreach($in_progress as $tmp_aid=>$pos){
		if(in_array($x,$new)){
			$x++;
			$new[$tmp_aid]=$x;	
		}else{
			$new[$tmp_aid]=$x;
		$x++;
		}
	}
	
	foreach($new as $tmp_ai=>$pos){
		$sql = "UPDATE cms_article SET in_cat_order='$pos' WHERE id='$tmp_ai'";
		$dbconn->Execute($sql) or die($dbconn->ErrorMsg());	
	}
	
	header('location:content_editor.php?catid='.$cat_id.'&type=live');
}

function mediaController($p,$f=null){
	global $dbconn,$smarty,$smarty_vars;
	$allowed_file_types = array('jpg','jpeg','gif','tif','tiff','mov','mp3','doc','pdf','wmv','mpg','mpeg','m4a');
	
	foreach($p as $key=>$value){
		$p[$key]=addslashes($value);	
	}
	
	if($f!=null){
		foreach($f as $key=>$value){
			$f[$key]=addslashes($value);
		}	
	}
	
	// need to check if the uploaded file is allowed or not.
	$file_type = explode(".",$f[name]);
	if(!in_array(strtolower($file_type[1]),$allowed_file_types)){
		$smarty_vars[error_text]='The file you tried to upload is not one of our accepted file types.';
		return false;
		exit;
	}
	
	$media_category = findMediaCategory(strtolower($file_type[1]));
	$tmp_file_info = explode(".",$f[name]);
	
	
	$s[name]=$p[name];
	$s[caption]=$p[caption];
	$s[description]=$p[description];
	$s[file_type]=$f[type];
	$s[file_size]=$f[size];
	$s[media_category]=$media_category;
	
	$fp = fopen($f[tmp_name],"r");
	$file_content = fread($fp,$f[size]);
	
// 	$s[file_name] = mktime().'.'.strtolower($tmp_file_info[1]);
 	$s[file_name] = $f[name];
 	
	fclose($fp);
	
	$fp = fopen(MEDIA_VAULT.$media_category.'/'.$s[file_name],"w");
	fwrite($fp,$file_content);
	
	
	$sql = "INSERT INTO cms_media_lib (name,caption,description,file_type,file_size,file_name,media_category,created) 
			VALUES ('$s[name]','$s[caption]','$s[description]','$s[file_type]','$s[file_size]','$s[file_name]','$s[media_category]',NOW())";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg().'<br/><br/>'.$sql);
	if($result)
	return true;

	
}

function findMediaCategory($media_type){
	$array = array('jpg','jpeg','tif','gif');

	if(in_array($media_type,$array)){
		$category = "images";	
	}
	
	$array = array('mov','avi','wmv','mpeg','mpg');
	if(in_array($media_type,$array)){
		$category = "movies";	
	}
	
	$array = array('mp3','ogg','m4a');
	if(in_array($media_type,$array)){
		$category = "audio";
	}
	
	$array = array('doc','pdf');
	if(in_array($media_type,$array)){
		$category = "documents";
	}
	
	return $category;
}

function assignMediaCategoryCount(){
	global $dbconn;
	$sql = "SELECT COUNT(id) as `count`,media_category FROM cms_media_lib GROUP BY media_category";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	while(false!=($row=$result->FetchRow())){
		$data[$row[media_category]]=$row[count];
	}
	
	return $data;
}

function searchMediaLibrary($params){
	global $dbconn;
	
	$search_by = $params->search_by;
	$query = $params->query;
	
	switch($search_by){
		case 'media_id':
			$sql = "SELECT * FROM cms_media_lib WHERE id='$query'";
			$result = $dbconn->Execute($sql);
			$row = $result->FetchRow();
			if(!empty($row)){
				$data[0]->id=$row[id];
				$data[0]->name=$row[name];
				$data[0]->media_category=$row[media_category];
				$data[0]->caption=$row[caption];
				$data[0]->description=$row[description];
				$data[0]->file_name=$row[file_name];
				if($row[media_category]=='images'){
					$data[0]->dim=getPictureDimension($row[file_name]);
				}
				$data[0]->created=$row[created];
			}		
		break;
		case 'keyword':
			$sql = "SELECT * FROM cms_media_lib WHERE description like '%$query%'";
			$result = $dbconn->Execute($sql);
			$x=0;
			while(false!=($row=$result->FetchRow())){
				$data[$x]->id=$row[id];
				$data[$x]->name=$row[name];
				$data[$x]->media_category=$row[media_category];
				$data[$x]->caption=$row[caption];
				$data[$x]->description=$row[description];
				$data[$x]->file_name=$row[file_name];
				$data[$x]->created=$row[created];
				if($row[media_category]=='images'){
					$data[$x]->dim=getPictureDimension($row[file_name]);
				}
				$x++;
			}
		break;
	}
	
	
	if(!empty($data)){
		return $data;	
	}
}

function getPictureDimension($file_name){
	$path = SITE_PATH.'media_vault/images/';
	$file = $path.$file_name;
	$tmp = getimagesize($file);
	$output = $tmp[0].'x'.$tmp[1];
	return $output;	
}

function loadMediaCategoryContent($cat,$query){
	
	if($query!=''){
		global $dbconn;
		
		if($query=='ALL'){
			$sql = "SELECT * FROM cms_media_lib WHERE media_category='$cat' ORDER BY created DESC";
		}else{
			$sql = "SELECT * FROM cms_media_lib WHERE media_category='$cat' AND name like '$query%' ORDER BY created DESC";
		}
		

	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x]->id=$row[id];
		$data[$x]->media_category=$row[media_category];
		$data[$x]->name=$row[name];
		$data[$x]->caption=$row[caption];
		$data[$x]->description=$row[description];
		$data[$x]->file_name=$row[file_name];
		$data[$x]->created=$row[created];
		if($row[media_category]=='images'){
			$data[$x]->dim=getPictureDimension($row[file_name]);
		}
		
		$x++;
	}
	
	return $data;
	}
}


function deleteMediaContentById($media_id){
	global $dbconn;
	$sql = "SELECT * FROM cms_media_lib WHERE id='$media_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$row = $result->FetchRow();
	
	$file_to_delete = MEDIA_VAULT."$row[media_category]/".$row[file_name];
	
	exec("rm -f $file_to_delete");
	
	$sql = "DELETE FROM cms_media_lib WHERE id='$media_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->Execute($sql));
	
	return true;
}

function assignContentNameDroppers($article_id){
	global $dbconn,$smarty;
	$sql = "SELECT * FROM cms_name_dropper WHERE article_id='$article_id'";	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	while(false!=($row=$result->FetchRow())){
		$data[]=$row[name];
	}
	
	if(!empty($data)){
		$smarty->assign('cnd',$data);	
	}
}

function assignContentKeychainDroppers($article_id){
	global $dbconn,$smarty;
	$sql = "SELECT * FROM cms_index_dropper WHERE article_id='$article_id'";	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	while(false!=($row=$result->FetchRow())){
		$data[]=$row[name];
	}
	
	if(!empty($data)){
		$smarty->assign('keycd',$data);	
	}
}

function assignContentMediaDropper($article_id){
	global $dbconn,$smarty;
	$sql = "Select cms_media_lib.name,cms_media_lib.media_category,cms_media_lib.id From cms_media_dropper 
	Inner Join cms_media_lib ON cms_media_dropper.media_id = cms_media_lib.id Where cms_media_dropper.article_id = '$article_id'";
	$result = $dbconn->Execute($sql);
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x]->name = $row[name];
		$data[$x]->media_category = $row[media_category];
		$data[$x]->media_id = $row[id];
		$x++;	
	}
	
	
	if(!empty($data)){
		$smarty->assign('mkd',$data);	
	}
	
}

function assignMediaForUpdate($media_id){
	global $dbconn,$smarty;
	$sql = "SELECT * FROM cms_media_lib WHERE id='$media_id' LIMIT 0,1";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$data=$result->FetchRow();
	if(!empty($data)){
		$smarty->assign($data);
	}		
}

function updateMedia($postparam,$fileparam){
	global $dbconn,$smarty_vars;
	$file_types = array('jpg','jpeg','gif','tif','tiff','mov','mp3','doc','pdf','wmv','mpg','mpeg','m4a');
	$media_dir = SITE_PATH.'/media_vault/';
	
	$data->name=addslashes($postparam[name]);
	$data->caption=addslashes($postparam[caption]);
	$data->description=addslashes($postparam[description]);
	$data->media_id=$postparam[media_id];
	$data->media_category=$postparam[media_category];
	$data->file_name=$postparam[file_name];
	
	if($fileparam[data][tmp_name] && $fileparam[data][error]!=4){
		$file->name=$fileparam[data][name];
		$file->type=$fileparam[data][type];
		$file->tmp_name=$fileparam[data][tmp_name];
		$file->size=$fileparam[data][size];
	}
	
	// first we can update the information into the database.
	$sql = "UPDATE cms_media_lib SET name='$data->name',caption='$data->caption',description='$data->description' WHERE id='$data->media_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	if(!empty($file)){
		$ext=explode(".",$file->name);
		if(!in_array($ext[1],$file_types)){
			$smarty_vars[error]=true;
			$smarty_vars[error_text]='The file you are trying to update is not one of the allowed file types.';
		}else{
			$fp = fopen($file->tmp_name,"r");
			$file_content = fread($fp,filesize($file->tmp_name));
			
			$file->new_file_name = mktime().'.'.$ext[1];
			$fp = fopen($media_dir.$data->media_category.'/'.$file->new_file_name,"w");
			fwrite($fp,$file_content);
			fclose($fp);
			
			$sql = "UPDATE cms_media_lib SET file_type='$file->type',file_size='$file->size',file_name='$file->new_file_name'
			WHERE id='$data->media_id'";
			$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			
			$file_to_delete = $media_dir.$data->media_category.'/'.$data->file_name;
			exec("rm $file_to_delete");
		}
	}
}

function setMainArticle($catid,$articleid){
	global $dbconn;
	// need to check if the small and large image is there.
	$sql = "SELECT sm_img_file,lg_img_file FROM cms_article WHERE id='$articleid'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$data->sm_img_file = $result->Fields('sm_img_file');
	$data->lg_img_file = $result->Fields('lg_img_file');
	if($data->sm_img_file=='' || $data->lg_img_file==''){
		// this article does not have the images it need to continue on.
		return false;	
	}else{
		// setting this article to the main article.
		$sql = "UPDATE cms_article SET main_article='no' WHERE cat_id='$catid'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$sql = "UPDATE cms_article SET main_article='yes' WHERE id='$articleid'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		reorderArticle($articleid,1);
		return true;
	}
}

function createImageThumbnailOnFly($image_file){
	$obj->image_path=SITE_PATH.'media_vault/images/';
	$obj->width=50; // 50px
	$obj->file=$obj->image_path.$image_file;
	list($obj->file_name,$obj->file_extention)=explode(".",$image_file);
	
	list($obj->width_orig,$obj->height_orig)=getimagesize($obj->file);
	
	$obj->height = ($obj->height_orig*$obj->width)/$obj->width_orig;
	$obj->height = number_format($obj->height,0);
	
	
	$image_p = imagecreatetruecolor($obj->width,$obj->height);

	
	switch ($obj->file_extention){
		case 'jpg':
			$image = imagecreatefromjpeg($obj->file);
			imagecopyresampled($image_p,$image,0,0,0,0,$obj->width,$obj->height,$obj->width_orig,$obj->height_orig);
			header('Content-type: image/jpeg');
			imagejpeg($image_p);
			imagedestroy($image);
			imagedestroy($image_p);	
		break;
		case 'gif':
			$image = imagecreatefromgif($obj->file);
			imagecopyresampled($image_p,$image,0,0,0,0,$obj->width,$obj->height,$obj->width_orig,$obj->height_orig);
			header('Content-type: image/jpeg');
			imagegif($image_p);
			imagedestroy($image);
			imagedestroy($image_p);	
		break;
	}
}


function articleStatusChange($article_id,$newStatus){
	global $dbconn;

	$sql = "SELECT cat_id FROM cms_article WHERE id='$article_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$categroy_id = $result->Fields('cat_id');
	
	switch ($newStatus){
		case 'off':
			$sql = "UPDATE cms_article SET in_cat_order='',article_status='$newStatus' WHERE id='$article_id'";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			reorderArticlesByCatId($categroy_id);
			$type='archive';
		break;
		case 'archived':
			$sql = "UPDATE cms_article SET in_cat_order='',article_status='$newStatus' WHERE id='$article_id'";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			reorderArticlesByCatId($categroy_id);
			$type='archive';
		break;
		case 'live':
			$sql = "SELECT MAX(in_cat_order) AS highest_count FROM cms_article WHERE cat_id='$categroy_id' AND article_status='live'";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			
			$highest_count = $result->Fields('highest_count');
			
//			echo $highest_count;
			if($highest_count==0){
				$next = 1;	
			}else{
				$next = $highest_count+1;	
			}
			
			$sql = "UPDATE cms_article SET article_status='$newStatus',in_cat_order='$next' WHERE id='$article_id'";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$type='live';
		break;	
	}
	
	
	header('location:content_editor.php?catid='.$categroy_id.'&type='.$type);
}

function assignCategoryName($catid){
	global $dbconn;
	$sql = "SELECT name FROM cms_article_category WHERE id='$catid'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$category_name = $result->Fields('name');
	return $category_name;
}

function addToSlideShow($media_id,$group_id){
	global $dbconn;
	// need to check if the media id that was given is an image.
	
	if(slideShowImageCheck($media_id)){
	// first we should check to make sure that this media id is not already in the slide show.
	$sql = "SELECT id FROM cms_slideshow WHERE media_id='$media_id' AND group_id='$group_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$slide_show_id = $result->Fields('id');
	if($slide_show_id==''){
		// now we need to get the highest slide_order and add on to it.
		$sql = "SELECT MAX(slide_order) AS `cur_high_order` FROM cms_slideshow WHERE group_id='$group_id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$cur_high_order = $result->Fields('cur_high_order');
		$next_order = $cur_high_order+1;
		
		$sql = "INSERT INTO cms_slideshow (media_id,slide_order,group_id) VALUES ('$media_id','$next_order','$group_id')";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		return true;
	}else{
		// media id is already in the slide show table and can not be added again.
		return false;	
	}
	}
}

function slideShowImageCheck($media_id){
	global $dbconn;
	$sql = "SELECT media_category FROM cms_media_lib WHERE id='$media_id'";	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$media_category = $result->Fields('media_category');
	if($media_category=='images'){
		return true;			
	}else{
		return false;
	}
}

function loadSlideshowTable($group_id){
	global $dbconn;

	$sql = "SELECT t1.media_id,t1.slide_order,t2.file_name FROM (cms_slideshow AS t1,cms_media_lib AS t2) WHERE t1.media_id=t2.id AND t1.group_id='$group_id' ORDER BY t1.slide_order";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x]->media_id=$row[media_id];
		$data[$x]->file_name=$row[file_name];
		$data[$x]->order=$row[slide_order];
		$x++;	
	}
	
	if(!empty($data)){
		return $data;
	}
}

function changeSlideOrder($media_id,$npos,$group_id){
	global $dbconn;
	$sql = "SELECT media_id,slide_order FROM cms_slideshow WHERE group_id='$group_id' ORDER BY slide_order";
	$result = $dbconn->Execute($sql) or die ($dbconn->ErrorMsg());
	while(false!=($row=$result->FetchRow())){
		$data[$row[slide_order]]=$row[media_id];	
	}
	
	$new_order[$npos]=$media_id;

	$x=1;
	foreach($data as $tmp){
		if(isset($new_order[$x])){
			$x++;
			$new_order[$x]=$tmp;	
		}
		if($media_id!=$tmp){
		$new_order[$x]=$tmp;
		$x++;	
		}
	}
	
	foreach($new_order as $key=>$value){
		$sql = "UPDATE cms_slideshow SET slide_order='$key' WHERE media_id='$value' AND group_id='$group_id'";
		$dbconn->Execute($sql) or die($dbconn->ErrorMsg());	
	}
}

function removeSlideshowImage($media_id,$group_id){
	global $dbconn;
	$sql = "DELETE FROM cms_slideshow WHERE media_id='$media_id' AND group_id='$group_id'";
	$dbconn->Execute($sql);
 }

function reorderSlideshow($group_id){
	global $dbconn;
	$sql = "SELECT id FROM cms_slideshow WHERE group_id='$group_id' ORDER BY slide_order";
	$result=$dbconn->Execute($sql);
	while(false!=($row=$result->FetchRow())){
		$data[]=$row[id];	
	}
	
	$x=1;
	foreach($data as $tmp){
		$sql = "UPDATE cms_slideshow SET slide_order='$x' WHERE id='$tmp'";
		$dbconn->Execute($sql);
		$x++;
	}
}

function addBulkMailCategory($params){
	global $dbconn;
	if($params[update]){
		$category_name = addslashes($params[category_name]);
		$display = $params[display];
		$category_id=$params[update];
		
		$sql = "UPDATE cms_contact_category SET category='$category_name',display='$display' WHERE id='$category_id'";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$msg = "The category has been updated";
		
	}else{
		$category_name = addslashes($params[category_name]);
		$display = $params[display];
		$sql = "INSERT INTO cms_contact_category (category,display) VALUES ('$category_name','$display')";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		$msg = "The category has been added";
	}
	return $msg;
}

function assignBulkMailCategories(){
	global $dbconn,$smarty;
	$sql = "SELECT id,category,display FROM cms_contact_category ORDER BY category";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x]->id=$row[id];
		$data[$x]->category=$row[category];
		$data[$x]->display=$row[display];
		$x++;	
	}
	if(!empty($data)){
		$smarty->assign('bulkmail_categories',$data);	
	}
		
}

function deleteBulkMailCategory($category_id){
	global $dbconn;
	$sql[]="DELETE FROM cms_contact_category WHERE id='$category_id'";
	$sql[]="DELETE FROM cms_contact_category_connection WHERE category_id='$category_id'";
	
	foreach($sql as $query){
		$dbconn->Execute($query) or die ($dbconn->ErrorMsg());	
	}
}

function getBulkMailCategoryForUpdate($category_id){
	global $dbconn;
	$sql = "SELECT * FROM cms_contact_category WHERE id='$category_id' LIMIT 0,1";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$data[id]=$result->Fields('id');
	$data[category_name]=$result->Fields('category');
	$data[display]=$result->Fields('display');
	return $data;
}

function getBulkMailCategoryContactConnection($contact_id){
	global $dbconn;
	$data=array();
	$sql = "SELECT category_id FROM cms_contact_category_connection WHERE contact_id='$contact_id'";
	$result = $dbconn->Execute($sql);
	
	while(false!=($row=$result->FetchRow())){
		$data[]=$row[category_id];	
	}
	
	return $data;
}

function updateBulkMailCategoryConnection($params){
	global $dbconn;
	
	$contact_id = $params[contact_id];
	$categories = $params[catergories];
	// first we delete the connection and then built the new connection.
	
	$sql = "DELETE FROM cms_contact_category_connection WHERE contact_id='$contact_id'";
	$result = $dbconn->Execute($sql);
	
	if(!empty($categories)){
	foreach($categories as $tmp){
		$sql = "INSERT INTO cms_contact_category_connection (category_id,contact_id) VALUES 
		('$tmp','$contact_id')";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	}
	}
	
}

function assignBulkMailMessages(){
	global $dbconn,$smarty;
	$sql = "SELECT t1.id,t1.created,t1.subject,t1.from_name,t1.from_email,t1.to_name,t1.author_id,
	CONCAT(t2.fname,' ',t2.lname) AS `author_name` FROM (ms_messages AS t1,cms_admin_users AS t2) 
	WHERE t1.author_id=t2.id ORDER BY t1.created DESC";	
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg().'<br/>'.$sql);
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x]->id=$row[id];
		
		$data[$x]->subject=$row[subject];
		$data[$x]->author=$row[author_name];
		$data[$x]->created=$row[created];
		$x++;	
	}
	if(!empty($data)){
		$smarty->assign('bulkmessages',$data);
	}
}

function loadMessageDataForUpdate($message_id){
	global $dbconn;
	$sql = "SELECT * FROM ms_messages WHERE id='$message_id' LIMIT 0,1";	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$data = $result->FetchRow();
	$data[message_id]=$data[id];
	if(!empty($data)){
		return $data;	
	}
}

function removeAttachment($type,$message_id){
	global $dbconn;
	$sql = "SELECT $type FROM ms_messages WHERE id='$message_id'";
	$result=$dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$file_to_delete = $result->Fields($type);
	
	$attachment_path = SITE_PATH.'bulkmail/attachment_archive/';
	$delete_file = $attachment_path.$file_to_delete;
	
	exec("rm -f $delete_file");
	
	$type_name = $type.'_name';
	
	$sql = "UPDATE ms_messages SET $type='',$type_name='' WHERE id='$message_id'";
	
	$dbconn->Execute($sql) or die($dbconn->ErrorMsg().'<br/>'.$sql);
	$msg = 'The attachment has been deleted';
	header("location:create_bulkmail_message.php?message_id=$message_id&msg=$msg");
	
}

function assignBulkMailTemplates(){
	global $smarty;
	$directory = SITE_PATH.'bulkmail/templates/';
	$filter_out = array('.','..','images');
	
	if($handle=opendir($directory)){
		while(false!==($file=readdir($handle))){
			if(!in_array($file,$filter_out)){
			$data[]=$file;
			}
		}
	}
	
	if(!empty($data)){
		$smarty->assign('templates',$data);
	}

}

function assignBulkmailTestGroups(){
	global $dbconn,$smarty;
	$sql = "SELECT * FROM ms_test_group ORDER BY name";	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x]->id=$row[id];
		$data[$x]->name=$row[name];
		$data[$x]->emails=$row[emails];
		$data[$x]->email_count=$row[email_count];
		$data[$x]->last_mod=$row[last_mod];
		$x++;	
	}
	if(!empty($data)){
		$smarty->assign('testgroups',$data);	
	}
}

function removeHeaderFromContentCategory($catid){
	global $dbconn;
	$sql = "UPDATE cms_article_category SET header_media_id='' WHERE id='$catid'";
	$dbconn->Execute($sql);
}

function removeSquareFromContentCategory($catid){
	global $dbconn;
	$sql = "UPDATE cms_article_category SET square_media_id='' WHERE id='$catid'";
	$dbconn->Execute($sql);
}

function postCleanup(&$params){
	foreach($params as $key=>$value){
		if(!is_array($value)){
			$params[$key]=addslashes($value);	
		}	
	}	
}

function slideshowGroupControl($params,$type){
	global $dbconn;
	postCleanup($params); // cleans up the post in case there are quotes.
	switch($type){
		case 'new':
			// if new then we just have to add it to the database.
			$sql = "INSERT INTO cms_slideshow_group (group_name,description,created) VALUES ('$params[group_name]','$params[description]',NOW())";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$msg = "Your new Slideshow group has been added";
		break;
		case 'edit':
			// has to just update
			$sql = "UPDATE cms_slideshow_group SET group_name='$params[group_name]',description='$params[description]' WHERE id='$params[group_id]'";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			$msg = "Your slideshow has been updated";
		break;	
	}
	return $msg;
}

function loadSlideShowGroup(){
	global $dbconn;
	$sql = "SELECT t1.`default`,t1.group_name,t1.description,t1.id AS `group_id`,COUNT(t2.id) AS `slide_count` 
FROM cms_slideshow_group AS t1
LEFT JOIN cms_slideshow AS t2 ON (t2.group_id=t1.id)
GROUP BY t1.id ORDER BY t1.group_name";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x][group_id]=$row[group_id];
		$data[$x][group_name]=$row[group_name];
		$data[$x][description]=$row[description];
		$data[$x][slide_count]=$row[slide_count];
		$data[$x]['default']=$row['default'];
		$x++;	
	}
	
	return $data;
}

function loadGroupDataForUpdate($group_id){
	global $dbconn;
	$sql = "SELECT id AS group_id,group_name,description FROM cms_slideshow_group WHERE id='$group_id' LIMIT 0,1";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$row = $result->FetchRow();
	return $row;
}

function deleteSlideshowGroup($group_id){
	global $dbconn;
	$sql[]="DELETE FROM cms_slideshow_group WHERE id='$group_id'";
	$sql[]="DELETE FROM cms_slideshow WHERE group_id='$group_id'";
	foreach ($sql as $query) {
		$dbconn->Execute($query) or die($dbconn->ErrorMsg());	
	}
}

function setDefaultSlideshowGroup($group_id){
	global $dbconn;
	$sql = "UPDATE cms_slideshow_group SET `default`='no'";
	$dbconn->Execute($sql);
	$sql = "UPDATE cms_slideshow_group SET `default`='yes' WHERE id='$group_id'";
	$dbconn->Execute($sql);
}


function assignBulkmailCategoriesDisplay(){
	global $dbconn,$smarty;
	$sql = "SELECT id,category FROM cms_contact_category WHERE display='yes' ORDER BY category";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;

	while(false!=($row=$result->FetchRow())){
		$data[$x][id]=$row[id];
		$data[$x][category]=$row[category];
		$x++;
	}

	if(!empty($data)){
		$smarty->assign('bulkmail_categories',$data);
	}
}




















































?>