<?

class SEARCH_CLASS{
	var $search_query;
	var $page;
	var $limit = 5;
	
	
	function addSearchQuerySlashes(){
		return $this->search_query=addslashes($this->search_query);	
	}
	
	function initSearch(){
		if(!empty($this->search_query)){
			global $dbconn,$smarty;
			
			$this->addSearchQuerySlashes();
					
			if(!$this->page){
				$this->page=0;	
			}
			if($this->page==1){
				$this->page=0;	
			}
			if($this->page>1){
				$this->page=$this->page-1;	
			}
			
			$sql = "SELECT * FROM cms_article 
			WHERE (full_content like '%$this->search_query%' OR exerpt like '%$this->search_query%' OR 
			headline like '%$this->search_query%') AND article_status in ('live','archived')";
			$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg().'<br/>'.$sql);
			
			$x=0;
			while(false!=($row=$result->FetchRow())){
				foreach($row as $key=>$value){
					$data[$x]->$key=$value;
				}	
				$x++;
			}
			$content=$data;
//			echo $content[0]->headline;
			$total_count = COUNT($content);
			
			$start = $this->page*5;
			$end = $start+5;
			for($x=$start;$x<$end;$x++){
				if(!empty($content[$x])){
				$output[]=$content[$x];
				}
			}
			
			
			if(!empty($output)){
				foreach($output AS $key=>$tmp_content){
					placeMedia($output[$key]->full_content);
					placeMedia($output[$key]->exerpt);
					cleanUpContentOutPut($output[$key]->exerpt);
					cleanUpContentOutPut($output[$key]->full_content);
				}

				
				$smarty->assign('page_range',range(1,ceil($total_count/5)));
				$smarty->assign('total_count',$total_count);
				$smarty->assign('current_end',$end);
				$smarty->assign('sr',$output);
				$smarty->assign('limit',$this->limit);
			}
			
			
		}
	}
	
}

?>