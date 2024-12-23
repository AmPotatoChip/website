<?
class SLIDE_INCLUDE_CLASS{
	var $slideshow_gallery_id;
	var $slideshow_data;
	var $include_data;
	
	function includeSlideshow(){
		if(!empty($this->slideshow_gallery_id)){
			$this->collectSlideShowData();
			$this->buildSlideShowHTML();
		}	
	}
	
	function collectSlideShowData(){
		global $dbconn;
		$sql = "SELECT t1.media_id,t2.caption,t2.file_name FROM (cms_slideshow AS t1,cms_media_lib AS t2,cms_slideshow_group AS t3) WHERE t1.media_id=t2.id AND t3.id=t1.group_id AND t3.id='".$this->slideshow_gallery_id."' AND media_category='images' ORDER BY t1.slide_order";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$x=0;
		while(false!=($row=$result->FetchRow())){
			$data[$x]->media_id=$row[media_id];
			$data[$x]->caption=$row[caption];
			$data[$x]->file_name=$row[file_name];
			$x++;
		}
		$this->slideshow_data=$data;
	}
	
	function buildSlideShowHTML(){
		if(!empty($this->slideshow_data)){
			$data = $this->slideshow_data;
			$lb="\n";
			$dlb=$lb.$lb;
			$html ='<!-- Slide Show Include -->'.$lb;
			$html.="<script language=\"javascript\">".$lb;
			$html.="var slideFile = new Array();".$lb;
			$html.="var slideCap = new Array();".$lb;
			$html.="var startCount = 0;".$lb;
			$html.="var total = ".count($data).";".$lb;
			$html.="var automatic = false;".$lb;
			$html.="</script>".$dlb;
			$html.="<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" align=\"center\" id=\"slideshow\">".$lb;
			$html.="<tr>".$lb;
			$html.="<td style=\"background-color:#efefef;color:#fff;text-align:right;letter-spacing:.1em;\"></td>".$lb;
			$html.="<td width=\"25\"><a href=\"javascript:;\" onClick=\"prevSlide();\" title=\"previous slide\">".$lb;
			$html.="<img src=\"images/slideshow_previous.gif\" alt=\"\" width=\"22\" height=\"22\" border=\"0\" style=\"border:0px;\"></a></td>".$lb;
			$html.="<td width=\"25\"><a href=\"javascript:;\" onClick=\"automatic=false;\" title=\"stop slideshow\">".$lb;
			$html.="<img src=\"images/slideshow_stop.gif\"  width=\"22\" height=\"22\" style=\"border:0px;\"></a></td>".$lb;
			$html.="<td width=\"25\"><a href=\"javascript:;\" onClick=\"automatic=true;playSlideShow();\" title=\"play slideshow\">".$lb;
			$html.="<img src=\"images/slideshow_play.gif\"  width=\"22\" height=\"22\" style=\"border:0px;\"></a></td>".$lb;
			$html.="<td width=\"25\"><a href=\"javascript:;\" onClick=\"nextSlide(this);\" title=\"next slide\">".$lb;
			$html.="<img src=\"images/slideshow_next.gif\"  width=\"22\" height=\"22\" style=\"border:0px;\"></a></td>".$lb;
			$html.="<td style=\"background-color:#efefef;color:#fff;text-align:right;letter-spacing:.1em;\"></td>".$lb;
			$html.="</tr>".$lb;
			$html.="</table>".$lb;
			$html.="<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">".$lb;
			$html.="<tr><td id=\"slidecaption\">".trim($data[0]->caption)."</td></tr>".$lb;
			$html.="<tr><td><img src=\"/media_vault/images/".$data[0]->file_name."\" id=\"imagedata\"></td></tr>".$lb;
			$html.="</table>".$dlb;
			$html.="<script language=\"javascript\">".$lb;
			for($a=0;$a<count($data);$a++){
				$html.="slideFile[".$a."] = '".$data[$a]->file_name."';".$lb;
				$html.="slideCap[".$a."] = '".htmlentities($data[$a]->caption,ENT_QUOTES)."';".$lb;
			}
			$html.="</script>".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
//			$html.="".$lb;
			
			$this->include_data=$html;	
		}	
	}

}
?>