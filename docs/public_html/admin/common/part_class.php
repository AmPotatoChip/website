<?
// function globally includes dbconn ( ADODB CONNECTION)


	
function GetCategoryPairs(){
	global $dbconn;
	
	$sql="
SELECT
item_category.name AS category,
item_subcategory.name AS sub_category,
item_subcategory.id
FROM
item_category
Inner Join item_subcategory ON item_category.id = item_subcategory.item_category_id
ORDER BY
item_category.name ASC,
item_subcategory.name ASC
	";
	
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;

	while(false!=($row=$result->FetchRow())){
		$data[$x]=$row;
		$x++;
	}

	return $data;
	
}//end of GetCategoryPairs

function FetchAllSubcategory($sub_category_id){
	global $dbconn;
	
	$sql="
SELECT
item_details.item_category_id,
item_details.item_sub_category_id,
item_details.name,
item_details.image,
item_details.article,
item_details.id,
item_details.pageno,
item_details.sortorder,
item_category.name AS category,
item_subcategory.name AS sub_category
FROM
item_details
Inner Join item_category ON item_details.item_category_id = item_category.id
Inner Join item_subcategory ON item_details.item_sub_category_id = item_subcategory.id
WHERE
item_details.item_sub_category_id =  '$sub_category_id'
	";
	
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;

	while(false!=($row=$result->FetchRow())){
		$data[$x]=$row;
		$x++;
	}

	return $data;
	
}//end of FetchAllSubcategory	


function UpdateItemDetail($post,$files){
	global $dbconn;

	//update each record IF there is an image or page
	$x=0;

	foreach ($post[record] as $data){
	

//			print $post[record][3]."<br>".$foo['name'][0];


		$sql = "UPDATE item_details SET ";

		if($files['image']['size'][$x]){
			$foo_name= $files['image']['name'][$x];
			$sql .= "image = '$foo_name', ";
			$foo_trap=1;
		}

		if($post[page][$x]>0){
			$foo_page = $post[page][$x];
			$sql .= " pageno = '$foo_page', ";
			$foo_trap=1;
		}
		
		$sql .= "lastmodified=NOW()";
		
		if($foo_trap == 1){
			$foo_id = $post[record][$x];
			$sql .=" WHERE id='$foo_id'";
			print $sql."<br>";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
			
		}
		$foo_trap=0;
		$foo_name="";
		$x++;
		
	}//for each
	
	
}//end UpdateItemDetail
function FetchDetailText($id){
	global $dbconn;
	$sql="
SELECT
item_details.item_category_id,
item_details.name,
item_details.image,
item_details.article,
item_details.id
FROM
item_details
WHERE
item_details.id =  '$id'
	";
	
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$row=$result->FetchRow();
	$data=$row;

	return $data;	
	
}//FetchDetailText



function UpdateItemDetailText($post){
	global $dbconn;

		$sql = "UPDATE item_details SET ";

		$foo_content = addslashes($post['full_content']);
		$sql .= " article = '$foo_content', ";
		
		$sql .= "lastmodified=NOW()";
		
		$foo_id = $post['detail_id'];
		$sql .=" WHERE id='$foo_id'";
		//print $sql."<br>";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	
}//end UpdateItemDetailText
?>