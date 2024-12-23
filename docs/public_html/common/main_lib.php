<?php

function getContentByArticleId($article_id,$return=null){
	global $dbconn,$smarty,$smarty_vars,$_GET;

	
	$sql = "SELECT t1.* FROM cms_article_category AS t1,cms_article AS t2 WHERE t2.cat_id=t1.id AND t2.id='$article_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$content_config = $result->FetchRow();
	$smarty->assign('content_config',$content_config);
	
	// Now we select the content for this article.
	$sql = "SELECT * FROM cms_article WHERE id='$article_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$page_content = $result->FetchRow();

	$smarty->assign('seo_title',$page_content[seo_title]);
	$smarty->assign('seo_keywords',$page_content[seo_keywords]);
	$smarty->assign('seo_description',$page_content[seo_description]);
	
	
	placeMedia($page_content[full_content]);
	placeMedia($page_content[exerpt]);
	placeSlide($page_content[full_content]);
	placeCalendar($page_content[full_content]);
	placeForm($page_content[full_content]);
	
	if(strpos($page_content[full_content],'{PAGE}')){
		// means that the content needs to be split into more than one page.
		// which also means that we will have to put the content into and array and return the array.
		$split_content = explode("{PAGE}",$page_content[full_content]);
		if(!$_GET[pbr]){
			$page_content[full_content] = $split_content[0];
			$smarty_vars[page_breaks]=count($split_content);
		}else{
			$page_content[full_content] = $split_content[$_GET[pbr]-1];	
			$smarty_vars[page_breaks]=count($split_content);
		}
	}
	
	cleanUpContentOutPut($page_content[exerpt]);
	cleanUpContentOutPut($page_content[full_content]);
	if($return!=null){
		return $page_content;
	}else{
		$smarty->assign('cont',$page_content);
	}
}

function getPrintArticle($article_id,$type=null){
	global $dbconn,$smarty,$smarty_vars,$_GET;

	$sql = "SELECT t1.* FROM cms_article_category AS t1,cms_article AS t2 WHERE t2.cat_id=t1.id AND t2.id='$article_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$content_config = $result->FetchRow();
	$smarty->assign('content_config',$content_config);
	
	// Now we select the content for this article.
	$sql = "SELECT * FROM cms_article WHERE id='$article_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$page_content = $result->FetchRow();
	placeMedia($page_content[full_content]);
	placeMedia($page_content[exerpt]);
	
//	if(strpos($page_content[full_content],'{PAGE}')){
//		// means that the content needs to be split into more than one page.
//		// which also means that we will have to put the content into and array and return the array.
//		$split_content = explode("{PAGE}",$page_content[full_content]);
//		if(!$_GET[pbr]){
//			$page_content[full_content] = $split_content[0];
//			$smarty_vars[page_breaks]=count($split_content);
//		}else{
//			$page_content[full_content] = $split_content[$_GET[pbr]-1];	
//			$smarty_vars[page_breaks]=count($split_content);
//		}
//	}
	
	cleanUpContentOutPut($page_content[exerpt]);
	cleanUpContentOutPut($page_content[full_content]);
	if($type!=null){
		return $page_content;
	}else{
	$smarty->assign('cont',$page_content);
	}
}

function getAddWebAd($article_id){
	global $dbconn,$smarty,$smarty_vars,$_GET;
	
	$sql = "SELECT headline,subhead AS dimension,full_content FROM cms_article WHERE id='$article_id' AND article_status='live' LIMIT 0,1";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$data = $result->FetchRow();
	$data[article_id]=$article_id;
	
	
	placeMedia($data[full_content]);
	
//	if(strpos($page_content[full_content],'{PAGE}')){
//		// means that the content needs to be split into more than one page.
//		// which also means that we will have to put the content into and array and return the array.
//		$split_content = explode("{PAGE}",$page_content[full_content]);
//		if(!$_GET[pbr]){
//			$page_content[full_content] = $split_content[0];
//			$smarty_vars[page_breaks]=count($split_content);
//		}else{
//			$page_content[full_content] = $split_content[$_GET[pbr]-1];	
//			$smarty_vars[page_breaks]=count($split_content);
//		}
//	}
	
	cleanUpContentOutPut($data[full_content]);
	
	// need to load the dimension into a var.
	list($width,$height)=explode("x",$data[dimension]);
	
	$data[window_width]=$width;
	$data[window_height]=$height;
	
	return $data;
	
}

function placeMedia(&$content){
	global $dbconn;
	$placing = array('L','R','C');
	$matches = array();
	
	$replace_content = str_replace("}","}\n--",$content);
	$nameDopperPattern ="/(\{MEDIA )(.*)(.)(\})/e";
	preg_match_all($nameDopperPattern,$replace_content,$matches,PREG_SET_ORDER);

	if(!empty($matches)){
		foreach($matches as $tmp){
			if(in_array($tmp[3],$placing)){
				$content = str_replace("$tmp[0]",buildMediaHtml($tmp[2],$tmp[3]),$content);	
			}else{
				$tmp[2]=$tmp[2].$tmp[3];
				$content = str_replace("$tmp[0]",buildMediaHtml($tmp[2]),$content);	
			}
		}
	}
}

function placeCalendar(&$content){
	global $dbconn;
	$matches = array();
	
	$replace_content = str_replace("}","}\n",$content);
	$pattern = "/(\{CALENDAR )(.*)(\})/e";
	preg_match_all($pattern,$replace_content,$matches,PREG_SET_ORDER);
	
	if(!empty($matches)){
		foreach($matches as $tmp){
			$content = str_replace("$tmp[0]",buildCalendarHtml($tmp[2]),$content);
		}
	}
}





function buildCalendarHtml($calendar_id){
	require(BASE_PATH.'public_html/admin/common/calendar_class.php');
	$CAL = new CMS_CALENDAR();
	$CAL->calendar_id = $calendar_id;
	$calendar_data = $CAL->calendarArticleInsert();
	
	if(!empty($calendar_data)){
		$html="<table id=\"calendar\">\n";
		foreach($calendar_data AS $day=>$data){
			foreach($data as $tmp_data){
				$html.="<tr>\n";
				$tmp_date = explode(' ',$tmp_data[date]);
				$html.="<td class=\"head\">".$tmp_date[0]."</td>\n";
				$html.="</tr>\n";
				
				$html.="<tr>\n";
				$html.="<td>$tmp_data[title]<br/>";
				
				$html.="$tmp_data[description]"."<br/>\n";
				
				if($tmp_data[venue]!=''){
					$html.="<br/><b>$tmp_data[venue]</b>"."<br/>\n";
				}
				
				if($tmp_data[venue_address]!=''){
					$html.="$tmp_data[venue_address]"."<br/>\n";
					if($tmp_data[venue_city]){
						$html.="$tmp_data[venue_city], ";
						if($tmp_data[venue_state]){
							$html.="$tmp_data[venue_state]";
							if($tmp_data[venue_zip]){
								$html.="$tmp_data[venue_zip]";
							}
						}
						$html.="<br/>";
					}
					
				}
				
				if($tmp_data[venue_phone]){
					$html.="Phone: $tmp_data[venue_phone]<br/>\n";
				}
				
				if($tmp_data[venue_url]){
					$html.="<a href=\"$tmp_data[venue_url]\" target=\"_blank\">$tmp_data[venue_url]</a><br/>\n";
				}
				if($tmp_data[venue_other_url]){
					$html.="<a href=\"$tmp_data[venue_other_url]\" target=\"_blank\">$tmp_data[venue_other_url]</a><br/>\n";
				}
				
				if($tmp_data[related_array]){
					$html.="<ul>\n";
					foreach($tmp_data[related_array] AS $tmp){
						$html.="<li><a href=\"".URL."full_content.php?article_id=$tmp&full=yes&pbr=1\" target=\"_blank\">More Info</a></li>";
					}
					$html.="</ul>\n";
				}
				$html.="</td>";
				$html.="</tr>\n";
			}
		}
		$html.="</table>\n";
	}
	
	return $html;
}

function placeSlide(&$content){
	$matches = array();
	$replace_content = str_replace("}","}\n--",$content);
	$nameDopperPattern ="/(\{SLIDE )(.*)(\})/e";
	preg_match_all($nameDopperPattern,$replace_content,$matches,PREG_SET_ORDER);
	
	if($matches[0][2]!=''){
		require_once('slide_include.class.php');
		$SLIDE = new SLIDE_INCLUDE_CLASS();
		$SLIDE->slideshow_gallery_id=$matches[0][2]; // gallery id;
		$SLIDE->includeSlideshow();
		$html = $SLIDE->include_data;
		$content = str_replace($matches[0][0],$html,$content);	
	}
		
}
function placeForm(&$content){
	$matches = array();
	$replace_content = str_replace("}","}\n",$content);
	$pattern = "/(\{FORM )(.*)(\})/e";
	preg_match_all($pattern,$replace_content,$matches,PREG_SET_ORDER);
	if($matches[0][2]!=''){
		$form_directory_path = SITE_PATH.'forms/';
		$form_file = $form_directory_path.$matches[0][2];
		$fp = fopen($form_file,"r");
		
		$form_content = fread($fp,filesize($form_file));
		fclose($fp);
		$content = str_replace($matches[0][0],$form_content,$content);
	}
	
}

function getMLPictureDimension($file_name){
	$output = array();
	$path = SITE_PATH.'media_vault/images/';
	$file = $path.$file_name;
	$tmp = getimagesize($file);
	return $tmp;	
}

function buildMediaHtml($media_id,$align=null){
	global $dbconn;
	$sql = "SELECT * FROM cms_media_lib WHERE id='$media_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$media = $result->FetchRow();
	
	
	switch($media[media_category]){

		case 'images':

			$img_size = getMLPictureDimension($media[file_name]);
			
			if($align!=null){
				
				switch ($align){
					case 'L':
						$ml_class="img_left";
						break;
					case 'R':
						$ml_class="img_right";
						break;	
					case 'C':
						$ml_class="img_center";
						break;
					default:
						$ml_class="img_left";
						break;
				}
			}else{
				$ml_class="img_left";
			}
			
			if ($media[caption]){
				$output="
				<span class=\"$ml_class\" style=\"width:$img_size[0]; height:$img_size[1];\">
				<img src=\"".URL."media_vault/$media[media_category]/$media[file_name]\" 
				width=\"$img_size[0]\" height=\"$img_size[1]\" alt=\"$media[description]\" name=\"$media[name]\">
				<p style=\"width:$img_size[0]px; height:auto;\"><span>$media[caption]</span></p>
				</span>
				";
			}else{
				$output="
			<span class=\"$ml_class\">
			<img src=\"".URL."media_vault/$media[media_category]/$media[file_name]\" 
			width=\"$img_size[0]\" height=\"$img_size[1]\" alt=\"$media[description]\" name=\"$media[name]\">
			</span>
			";
			}
			
		break;
		case 'movies';
			$output = "<img src=\"/images/video_icon.gif\" id=\"icon\">&nbsp;<a href=\"".URL."media_vault/$media[media_category]/$media[file_name]\" target=\"_blank\">$media[name]</a>";
		break;
		case 'audio':
			$output = "<img src=\"/images/audio_icon.gif\" id=\"icon\">&nbsp;<a href=\"".URL."media_vault/$media[media_category]/$media[file_name]\" target=\"_blank\">$media[name]</a>";
		break;
		case 'documents':
			$output = "<img src=\"/images/document_icon.gif\" id=\"icon\">&nbsp;<a href=\"".URL."media_vault/$media[media_category]/$media[file_name]\" target=\"_blank\">$media[name]</a><br clear=\"all\">";
		break;	
	}
	
	return $output;
}


function cleanUpContentOutPut(&$content){
	$cleanup_array = array('{ND','}','{KEY','{PAGE');
	foreach($cleanup_array AS $tmp_remove){
		$content = str_replace("$tmp_remove","",$content);
	}
}

function collectContentForCategory($category_name){
	global $dbconn,$smarty;
	$sql = "SELECT * FROM cms_article_category WHERE name='".trim($category_name)."'";
	
	
//	echo $sql; exit;
	$result = $dbconn->Execute($sql);
	$category_config=$result->FetchRow();
	
		
	if($category_config){
		
		$sql = "SELECT * FROM cms_article WHERE cat_id='$category_config[id]' AND article_status='live' ORDER BY in_cat_order LIMIT 0,$category_config[no_articles]";
		$result = $dbconn->Execute($sql);
		$x=0;
		while(false!=($row=$result->FetchRow())){
			foreach($row as $key=>$value){
				$content[$x]->$key=$value;
			}
			$x++;
		}
	}
	
	if(!empty($content)){
	foreach($content AS $key=>$tmp_content){
		if(!$setseo){
			$smarty->assign('seo_title',"$tmp_content->seo_title");
			$smarty->assign('seo_keywords',"$tmp_content->seo_keywords");
			$smarty->assign('seo_description',"$tmp_content->seo_description");
			$setseo=true;
		}
		
		$array = returnWidgetMatches($content[$key]->full_content);
		if ($array){
			foreach($array as $widget){
				switch ($widget[options][name]){
					case "coda":
										
						$widget_replace = GetCoda($widget);
						break;
					case "slideshow":
						$widget_replace = BuildSlideShow($widget);
						break;
					case "slideshowNew":
							$widget_replace = BuildSlideShowNew($widget);
						break;
						case "categorylist":
							$widget_replace = BuildCategoryList($widget);
							break;
						case "categorylistarticles":
							$widget_replace = BuildCategoryListwithChildren($widget);
							break;
				}//switch
				$content[$key]->full_content = str_replace($widget['original'],$widget_replace,$content[$key]->full_content);	
			}
		}
		
		
		
		
		placeMedia($content[$key]->full_content);
		placeMedia($content[$key]->exerpt);
		placeCalendar($content[$key]->full_content);
		placeSlide($content[$key]->full_content);
		placeForm($content[$key]->full_content);
		cleanUpContentOutPut($content[$key]->exerpt);
		cleanUpContentOutPut($content[$key]->full_content);
		
		
	}
	}
	
	$data[content]=$content;
	$data[config]=$category_config;
	
	
	$smarty->assign('content_array',$data);
}

function assignIndexPageContent(){
	global $dbconn,$smarty;
	
	$array = array('Food','Music','Arts','Culture','Lifestyle','Community');
	shuffle($array);
	
	foreach($array as $tmp){
		$data[]->cat_name=$tmp;	
	}
	
	foreach($data as $key=>$obj){
		$sql = "SELECT id,square_media_id FROM cms_article_category WHERE name='$obj->cat_name'";
		$result = $dbconn->Execute($sql);
		$data[$key]->cat_id=$result->Fields('id');
		$tmp_cat_id=$result->Fields('id');
		$data[$key]->css=strtolower($obj->cat_name);
		$data[$key]->css2=strtolower($obj->cat_name).'_title';
		$data[$key]->url=strtolower($obj->cat_name).'.php';
		$data[$key]->square_media_id=$result->Fields('square_media_id');
	}
	

	$smarty->assign('indexData',$data);	
}

function assignArticleHeaderImage($section_name){
	global $dbconn,$smarty;
	if(!empty($section_name)){
		$sql = "SELECT t2.file_name FROM (cms_article_category AS t1,cms_media_lib AS t2) 
		WHERE t1.name='$section_name' AND t1.header_media_id=t2.id";	
		

		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		$file_name = $result->Fields('file_name');
		
		if(!empty($file_name)){
			$smarty->assign('article_image_header',$file_name);
		}
	}

}

function assignCookieTrail($article_id,$params=null){
	global $dbconn,$smarty,$smarty_vars;
	
	$sql = "Select cms_article_category.name From cms_article Inner Join cms_article_category ON cms_article.cat_id = cms_article_category.id Where cms_article.id ='$article_id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$category_name = trim($result->Fields('name'));
	
	
	
	switch($category_name){
		case 'Arts':
			$header_image = array('masthead_on.gif','masthead_arts.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='arts';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/arts.php\">Arts</a> ></div>";
			$output[header]="Arts";
			$output[main_id]="arts";
			$output[cssclass]="arts_title";
		break;
		case 'Arts - Look':
			$header_image = array('masthead_on.gif','masthead_arts.gif');
			$smarty->assign('header_image',$header_image);
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/arts.php\">Arts</a> > <a href=\"/arts_l.php\">Look</a> ></div>";
			$output[main_id]="arts";
			$output[header]="arts";
			$output[cssclass]="arts_title";
		break;
		case 'Arts - Showcase':
			$header_image = array('masthead_on.gif','masthead_arts.gif');
			$smarty->assign('header_image',$header_image);
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/arts.php\">Arts</a> > <a href=\"/arts_s.php\">Showcase</a> ></div>";
			$output[main_id]="arts";
			$output[header]="arts";
			$output[cssclass]="arts_title";
		break;
		case 'Arts - Words Worth':
			$header_image = array('masthead_on.gif','masthead_arts.gif');
			$smarty->assign('header_image',$header_image);
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/arts.php\">Arts</a> > <a href=\"/arts_ww.php\">Words Worth</a> ></div>";
			$output[main_id]="arts";
			$output[header]="arts";
			$output[cssclass]="arts_title";
		break;
		case 'Food':
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/food.php\">Food</a> ></div>";
			$header_image = array('masthead_on.gif','masthead_food.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='food';
			$output[header]="Food";
			$output[main_id]="food";
			$output[cssclass]="food_title";
		break;
		case 'Food - Consumed':
			$header_image = array('masthead_on.gif','masthead_food.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='food';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/food.php\">Food</a> > <a href=\"/food_c.php\">Consumed</a> ></div>";
			$output[header]="Food";
			$output[main_id]="food";
			$output[cssclass]="food_title";
		break;
		case 'Food - Into the Drink':
			$header_image = array('masthead_on.gif','masthead_food.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='food';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/food.php\">Food</a> > <a href=\"/food_itd.php\">Into the Drink</a> > </div>";
			$output[header]="Food";
			$output[main_id]="food";
			$output[cssclass]="food_title";
		break;
		case 'Food - The 100 mile Diet':
			$header_image = array('masthead_on.gif','masthead_food.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='food';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/food.php\">Food</a> > <a href=\"/food_diet.php\">The 100 mile Diet</a> > </div>";
			$output[header]="Food";
			$output[main_id]="food";
			$output[cssclass]="food_title";
		break;
		case 'Music':
			$header_image = array('masthead_on.gif','masthead_music.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='music';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/music.php\">Music</a> ></div>";
			$output[header]="Music";
			$output[main_id]="music";
			$output[cssclass]="music_title";
		break;
		case 'Music - Ear on the Underground':
			$header_image = array('masthead_on.gif','masthead_music.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='music';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/music.php\">Music</a> > <a href=\"/music_eotu.php\">Ear on the Underground</a> ></div>";
			$output[header]="Music";
			$output[main_id]="music";
			$output[cssclass]="music_title";
		break;
		case 'Music - Jazz/Blues':
			$header_image = array('masthead_on.gif','masthead_music.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='music';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/music.php\">Music</a> > <a href=\"/music_j.php\">Jazz/Blues</a> ></div>";
			$output[header]="Music";
			$output[main_id]="music";
			$output[cssclass]="music_title";
		break;
		case 'Music - Listen':
			$header_image = array('masthead_on.gif','masthead_music.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='music';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/music.php\">Music</a> > <a href=\"/music_l.php\">Listen</a> ></div>";
			$output[header]="Music";
			$output[main_id]="music";
			$output[cssclass]="music_title";
		break;
		case 'Culture':
			$header_image = array('masthead_on.gif','masthead_culture.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='culture';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/culture.php\">Culture</a> ></div>";
			$output[header]="Culture";
			$output[main_id]="culture";
			$output[cssclass]="culture_title";
		break;
		case 'Culture - Comics':
			$header_image = array('masthead_on.gif','masthead_culture.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='culture';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/culture.php\">Culture</a> > <a href=\"/culture_c.php\">Comics</a> ></div>";
			$output[header]="Culture";
			$output[main_id]="culture";
			$output[cssclass]="culture_title";
		break;
		case 'Lifestyle':
			$header_image = array('masthead_on.gif','masthead_lifestyle.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='lifestyle';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/lifestyle.php\">Lifestyle</a> ></div>";
			$output[header]="Lifestyle";
			$output[main_id]="lifestyle";
			$output[cssclass]="lifestyle_title";
		break;
		case 'Links':
			$header_image = array('masthead_on.gif','masthead.gif');
			$smarty->assign('header_image',$header_image);
//			$smarty_vars[subnav]='lifestyle';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/full_content.php?article_id=275&full=yes&pbr=1\">Links</a> ></div>";
			$output[header]="Links";
			$output[main_id]="other";
			$output[cssclass]="other_title";
		break;
		case 'Lifestyle - Health':
			$header_image = array('masthead_on.gif','masthead_lifestyle.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='lifestyle';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/lifestyle.php\">Lifestyle</a> > <a href=\"/lifestyle_h.php\">Health</a> ></div>";
			$output[header]="Lifestyle";
			$output[main_id]="lifestyle";
			$output[cssclass]="lifestyle_title";
		break;
		case 'Community':
			$header_image = array('masthead_on.gif','masthead_community.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='community';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/community.php\">Community</a> ></div>";
			$output[header]="Community";
			$output[main_id]="community";
			$output[cssclass]="community_title";
		break;
		case 'Community - Chickabiddy':
			$header_image = array('masthead_on.gif','masthead_community.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='community';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/community.php\">Community</a> > <a href=\"/community_c.php\">Chickabiddy</a> ></div>";
			$output[header]="Community";
			$output[main_id]="community";
			$output[cssclass]="community_title";
		break;
		case 'Community - Presenting':
			$header_image = array('masthead_on.gif','masthead_community.gif');
			$smarty->assign('header_image',$header_image);
			$smarty_vars[subnav]='community';
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/community.php\">Community</a> > <a href=\"/community_p.php\">Presenting</a> ></div>";
			$output[header]="Community";
			$output[main_id]="community";
			$output[cssclass]="community_title";
		break;
		case 'Gallery':
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/gallery.php\">Gallery</a> > </div>";
			$output[header]="Gallery";
		break;
		case 'Letters':
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/letters.php\">Letters</a> > </div>";
			$output[header]="Letters";
		break;
		case 'Play List':
			$output[breadcrumbs] = "<div id=\"breadcrumbs\"><a href=\"/index.php\">Home</a> > <a href=\"/playlist.php\">Play List</a> > </div>";
			$output[header]="Play List";
		break;
	}
	
	if(!empty($output)){
		$smarty->assign('info',$output);	
	}
}

function emailArticle($postparams){
	global $dbconn,$smarty,$smarty_vars;
	require('phpmailer/class.phpmailer.php');
	$data->from_name=$postparams[from_name];
	$data->from_email=$postparams[from_email];
	$data->email_to = explode(",",$postparams[rcpt]);
	$data->article_id = $postparams[article_id];
	
	$db_data = getPrintArticle($data->article_id,1);
	
	$body=builtEmailContent($db_data);
	
	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->IsSMTP();
	$mail->Subject="Article Forwarded from $data->from_name";
	$mail->From = $data->from_email;
	$mail->FromName=$data->from_name;
	$mail->Sender = $data->from_email;
	foreach($data->email_to as $tmp_email){
		$mail->AddAddress($tmp_email,'');
	}
	$mail->Body=$body;
	$mail->send() or die('can not send mail!<br/>Sorry!');
	
	
}

function builtEmailContent($content_array){
	$template_file = SITE_PATH.'common/email_article.txt';
	
	$fp = fopen($template_file,"r");
	$content = fread($fp,filesize($template_file));
	
	$body = "<h1>$content_array[headline]</h1>"."\n";
	if($content_array[subhead]!=''){
		$body.="<h2>$content_array[subhead]</h2>"."\n";
	}
	
	if($content_array[byline]!=''){
		$body.="<div class=\"byline\">$content_array[byline]</div>";
	}
	if($content_array[dateline]!=''){
		$body.="<div class=\"dateline\">$content_array[dateline]</div>"."\n";	
	}
	$body.="$content_array[full_content]";

	$send_body = str_replace("<!--BODY-->",$body,$content);
	$send_body = str_replace("<!--ARTICLEID-->",$content_array[id],$send_body);
	
	return $send_body;
}

function collectTopStories($return=null){
	global $dbconn,$smarty;

	
	$include_categories = array('Food','Music','Arts','Culture','Lifestyle','Community');
	
	foreach($include_categories as $tmp){
		$sql_string.="'$tmp'".",";
	}
	$sql_string = '('.substr($sql_string,0,-1).')';
	
	$sql = "Select cms_article_category.name,cms_article.id,cms_article.cat_id,cms_article.headline,cms_article.subhead,cms_article.exerpt,
	cms_article.full_content,cms_article.byline,cms_article.dateline,cms_article.in_cat_order,cms_article.article_status,
	cms_article.sm_img_file,cms_article.lg_img_file,cms_article.main_article,cms_article.created,cms_article.last_mod
	From cms_article Inner Join cms_article_category ON cms_article.cat_id = cms_article_category.id 
	Where cms_article_category.name IN $sql_string AND cms_article.article_status = 'live' AND cms_article.in_cat_order = 1";
	
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$x=0;
	while(false!=($row=$result->FetchRow())){
		foreach($row as $key=>$value){
			$data[$x]->$key=$value;	
		}
		$x++;	
	}

	
	
	$content=$data;
	
	if(!empty($content)){
	foreach($content AS $key=>$tmp_content){
		placeMedia($content[$key]->full_content);
		placeMedia($content[$key]->exerpt);
		placeForm($content[$key]->full_content);
		cleanUpContentOutPut($content[$key]->exerpt);
		cleanUpContentOutPut($content[$key]->full_content);
	}
	
	
	foreach($content as $key=>$tmp_content){
		$tmp_to_order[$tmp_content->name]=$key;
	}
	
	
	$new_output = array();
	foreach($include_categories as $tmp_categories){
		$new_output[]=$content[$tmp_to_order[$tmp_categories]];
	}
	
	$content = $new_output;
	}
	
	if($return==null){
		return $content;	
	}else{
		$smarty->assign('topStories',$content);	
	}
	
}

function checkEmailInSystem($email){
	global $dbconn;
	$sql = "SELECT id FROM cms_contact_email WHERE email='$email'";
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$id = $result->Fields('id');
	if($id){
		return false;	
	}else{
		return true;
	}
}

function newsletterSignup($email){
	global $dbconn;
	
	if(checkEmailInSystem($email)){
		// first we have to add a record to cms_contact
		$sql = "INSERT INTO cms_contact (newsletter,created) VALUES ('Y',NOW())";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		$cms_contact_id = $dbconn->Insert_ID();
		
		$sql = "INSERT INTO cms_contact_email (contact_id,email) VALUES ('$cms_contact_id','$email')";
		$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
		
		$sql = "INSERT INTO cms_contact_category_connection (category_id,contact_id) VALUES ('2','$cms_contact_id')";
		$dbconn->Execute($sql);
		return 1;
	}else{
		return 3;
	}
}

function collectNameDroppers($days){
	global $dbconn;
	
	$sql="SELECT t1.article_id,t1.name
	FROM (cms_name_dropper as t1,cms_article AS t2) 
	WHERE TO_DAYS(NOW()) - TO_DAYS(t2.dateline)<=$days
	AND t2.id=t1.article_id 
	AND t2.article_status in ('archived','live')
	ORDER BY t1.name";
	
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x]=$row;
		$x++;
	}
	
	
	if(!empty($data)){
	foreach($data as $tmp){
		$tmp_data[$tmp[name]][]=$tmp;	
	}
	
	$x=0;
	foreach($tmp_data as $key=>$value){
		$output[$x]->data=$value;
		$output[$x]->name=$value[0][name];
		$x++;	
	}
	
	
	return $output;
	}
}


function collectDataForSlideshow(){
	global $dbconn;
	
	$sql = "SELECT t1.media_id,t2.caption,t2.file_name 
	FROM (cms_slideshow AS t1,cms_media_lib AS t2,cms_slideshow_group AS t3)
	WHERE t1.media_id=t2.id AND t3.id=t1.group_id AND t3.`default`='yes'
	AND media_category='images' ORDER BY t1.slide_order";
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x]->media_id=$row[media_id];
		$data[$x]->caption=$row[caption];
		$data[$x]->file_name=$row[file_name];
		$x++;	
	}
	if(!empty($data)){
		return $data;	
	}
}



function collectKeyDroppers($days){
	global $dbconn;
	
	$sql="SELECT t1.article_id,t1.name
	FROM (cms_index_dropper as t1,cms_article AS t2) 
	WHERE TO_DAYS(NOW()) - TO_DAYS(t2.dateline)<=$days
	AND t2.id=t1.article_id 
	AND t2.article_status in ('archived','live')
	ORDER BY t1.name";
	
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$data[$x]=$row;
		$x++;
	}
	
	
	if(!empty($data)){
	foreach($data as $tmp){
		$tmp_data[$tmp[name]][]=$tmp;	
	}
	
	$x=0;
	foreach($tmp_data as $key=>$value){
		$output[$x]->data=$value;
		$output[$x]->name=$value[0][name];
		$x++;	
	}
	
	
	return $output;
	}
}

function collectPastPresent($category_name){
	global $dbconn;
	$output_array = array();
	$no_output = 10;
	
	// we need to get the count for this category.
	$sql = "SELECT id,no_articles FROM cms_article_category WHERE name='$category_name'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$no_articles = $result->Fields('no_articles');
	$cat_id = $result->Fields('id');
	
	$sql = "SELECT t1.id,t1.headline,t1.subhead FROM (cms_article AS t1) WHERE cat_id='$cat_id'
	 AND article_status='live' ORDER BY dateline LIMIT $no_articles,10";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$x=0;
	while(false!=($row=$result->FetchRow())){
		$output_array[$x]->article_id=$row[id];
		$output_array[$x]->headline=$row[headline];
		$output_array[$x]->subhead=$row[subhead];
		$x++;
	}
	
	if(COUNT($output_array)<10){
	$sql = "SELECT t1.id,t1.headline,t1.subhead FROM (cms_article AS t1,cms_article_category AS t2)
	WHERE t1.cat_id=t2.id AND t2.name = '$category_name' AND t1.article_status='archived' ORDER BY t1.dateline";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg().'<br/>'.$sql);
	$x=COUNT($output_array);
	
	while(false!=($row=$result->FetchRow())){
		$output_array[$x]->article_id = $row[id];
		$output_array[$x]->headline = $row[headline];
		$output_array[$x]->subhead = $row[subhead];
		$x++;
	}
	}
	
	if(count($output_array)>10){
		$tmp = $output_array;
		$a=0;
		foreach($tmp as $split){
			if($a<$no_output){
				$data[$a]=$split;	
			}
			$a++;	
		}
		$output_array=$data;	
	}
	
	
	if(!empty($output_array)){
		return $output_array;
	}
}

function collectRSSStories(){
	global $dbconn,$smarty;

	
	$include_categories = array('Food','Music','Arts','Culture','Lifestyle','Community');
	
	foreach($include_categories as $tmp){
		$sql_string.="'$tmp'".",";
	}
	$sql_string = '('.substr($sql_string,0,-1).')';
	
	$sql = "Select cms_article_category.name,cms_article.id,cms_article.cat_id,cms_article.headline,cms_article.subhead,cms_article.exerpt,
	cms_article.full_content,cms_article.byline,cms_article.dateline,cms_article.in_cat_order,cms_article.article_status,
	cms_article.sm_img_file,cms_article.lg_img_file,cms_article.main_article,cms_article.created,cms_article.last_mod
	From cms_article Inner Join cms_article_category ON cms_article.cat_id = cms_article_category.id 
	Where cms_article_category.name IN $sql_string AND cms_article.article_status = 'live'
	 ORDER BY cms_article.dateline DESC limit 0,20;";
	
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	$x=0;
	while(false!=($row=$result->FetchRow())){
		foreach($row as $key=>$value){
			$data[$x]->$key=$value;	
		}
		$x++;	
	}

	
	
	$content=$data;
	
	if(!empty($content)){
	foreach($content AS $key=>$tmp_content){
		placeMedia($content[$key]->full_content);
		placeMedia($content[$key]->exerpt);
		placeForm($content[$key]->full_content);
		cleanUpContentOutPut($content[$key]->exerpt);
		cleanUpContentOutPut($content[$key]->full_content);
	}
	
	}
	
	
	return $content;
}

function assignRandomQuote($category_name){
	global $dbconn,$smarty;
	$output = array();
	
	$sql = "SELECT t1.full_content, t1.headline FROM (cms_article AS t1,cms_article_category AS t2)
	WHERE t2.name='$category_name' AND t2.id=t1.cat_id AND t1.article_status='live'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	
	while(false!=($row=$result->FetchRow())){
		$output[]=$row[full_content]."<p class=\"test_head\">$row[headline]</p>";	
	}
	
	shuffle($output);
	return $output[0];
	
}



function returnWidgetMatches($content)
{
	// {WIDGET name:coda|category:'Slidy Widget'|option1:Slow}
	$matches = array();
	$pattern = "/{WIDGET .*[}]?/i";
	preg_match_all($pattern,$content,$matches);
	
	$tmpArray = array(); 
	if(!empty($matches)){
		$matches = $matches[0];
		
		for($a=0;isset($matches[$a]);$a++)
		{
			// NOW WE START REPLACING THINGS TO FORM THE ARRAY
			$obj = array();
			$obj['original'] = trim($matches[$a]);
			$obj['string'] = str_replace('{WIDGET ','',$matches[$a]);
			$obj['string'] = str_replace('}','',$obj['string']);
			
			$tmp = explode('|',$obj['string']);
			for($b=0;isset($tmp[$b]);$b++)
			{
				$part = explode(":",$tmp[$b]);
				$obj['options'][$part[0]] = trim(str_replace("'",'',$part[1]));
			}
			
			$tmpArray[]=$obj;
			unset($obj);
		}	
	}
	//print_r($tmpArray);
	return $tmpArray;
}

function GetCoda($widget){
	global $dbconn,$smarty;
	
	
//print_r($widget);

	//CodaSlider Start
	$output = "<div class=\"coda-slider-wrapper\">\n";

	//$output .= "<div id=\"coda-nav-5\" class=\"coda-nav\">\n<ul>\n";
	
	//gather all articles from stated category
	
	$foo_cat = $widget[options][category];
	
	$sql = "SELECT * FROM cms_article_category WHERE name='".trim($foo_cat)."'";
	
	$result = $dbconn->Execute($sql);
	$category_config=$result->FetchRow();
	
	if($category_config){
		
		$sql = "SELECT * FROM cms_article WHERE cat_id='$category_config[id]' AND article_status='live' ORDER BY in_cat_order LIMIT 0,$category_config[no_articles]";
		$result = $dbconn->Execute($sql);
		$x=0;
		while(false!=($row=$result->FetchRow())){
			foreach($row as $key=>$value){
				$content[$x]->$key=$value;
			}
			$x++;
		}
	}//if

$output .= "<div class=\"coda-slider preload\" id=\"coda-slider-5\">\n";

	//write each panel
	for($i=0;$i<$x;$i++){
		$foo_count = $i+1;
		$foo=$content[$i]->headline;
		$foo_text=$content[$i]->full_content;
		
	$output .= "<div class=\"panel\">\n
<div class=\"panel-wrapper\">\n
<h2 class=\"title\">$foo</h2>\n
$foo_text\n
</div>\n
</div>\n
";		
	}	
	
	$output .="
</div>\n
</div>\n
	
	";
	
//print $output;
	
	
	return $output;	
	
	
}//GetCoda($widget);

function BuildCategoryList($widget){
	global $dbconn,$smarty;
	
	// Start the output
	$output = "<div class=\"CategoryList-wrap\">\n";
	
	
	//gather all articles from stated category
	
	$foo_cat = $widget[options][category];
	
	$sql = "SELECT * FROM cms_article_category WHERE name LIKE'".trim($foo_cat)."%'";
	$result = $dbconn->Execute($sql);

	$x=0;
	while(false!=($row=$result->FetchRow())){
			foreach($row as $key=>$value){
				$content[$x]->$key=$value;
		}
		$x++;
	}
	
	$output .= "<ul class=\"CategoryList\">\n";
	
	//write each panel
	for($i=0;$i<$x;$i++){
		$foo_count = $i+1;
		$fooName = substr($content[$i]->name, strlen($foo_cat));
		
		$fooName = ucwords(str_replace("-"," ", $fooName));
		
		$output .= "<li><a href=/?page=".$content[$i]->name.">".$fooName."</a></li>\n";
	}
	
	$output .="
	</ul>\n
	</div>\n
	";
	
	//print $output;
	
	
	return $output;	
	
	
	
}

function BuildCategoryListwithChildren($widget){
	global $dbconn,$smarty;

	// Start the output
	$output = "<div class=\"CategoryList-wrap\">\n";


	//gather all articles from stated category

	$foo_cat = $widget[options][category];

	$sql = "SELECT * FROM cms_article_category WHERE name LIKE'".trim($foo_cat)."%' ORDER BY NAME ASC";
	
//echo $sql;exit;
	$result = $dbconn->Execute($sql);

	
	$x=0;
	while(false!=($row=$result->FetchRow())){
		
		$fooName = substr($row['name'], strlen($foo_cat));
		$fooName = ucwords(str_replace("-"," ", $fooName));
		
		$output .= "<ul class=\"CategoryList\">\n";
		$output .= "<li><b>".$fooName."</b></li>\n";
//look up all the articles in this cat

		$sql2 = "SELECT * FROM cms_article WHERE cat_id=".$row['id']." AND article_status='live' ORDER BY in_cat_order";
		$result2 = $dbconn->Execute($sql2);

		$output .= "<ul class=\"CategoryListArticles\">\n";
		
		while(false!=($row2=$result2->FetchRow())){
			$output .= "<li><a href=/full_content.php?article_id=".$row2['id']."&full=yes&pbr=1>".$row2['headline']."</a></li>\n";
		}
		$output .="
		</ul>
		</ul>\n";
	}


	$output .="
	</div>\n
	";

	//print $output;


	return $output;



}

function BuildSlideShow($widget){
	global $dbconn,$smarty;
	

	//Slideshow Start
	$output = "<div class=\"widget-slideshow-wrap\">\n";
	
	//gather all articles from stated category
	
	$foo_cat = $widget[options][category];
	
	$sql = "SELECT * FROM cms_article_category WHERE name='".trim($foo_cat)."'";
	
	$result = $dbconn->Execute($sql);
	$category_config=$result->FetchRow();
	
	if($category_config){
		
		$sql = "SELECT * FROM cms_article WHERE cat_id='$category_config[id]' AND article_status='live' ORDER BY in_cat_order LIMIT 0,$category_config[no_articles]";
		$result = $dbconn->Execute($sql);
		$x=0;
		while(false!=($row=$result->FetchRow())){
			foreach($row as $key=>$value){
				$content[$x]->$key=$value;
			}
			$x++;
		}
	}//if

$output .= "<ul class=\"widget-slideshow\">\n";

	//write each panel
	for($i=0;$i<$x;$i++){
		$foo_count = $i+1;
		$foo=$content[$i]->headline;
		$foo_text=$content[$i]->full_content;
		
	$output .= "<li>\n
$foo_text\n
</li>\n
";		
	}	
	
	$output .="
</ul>\n
</div>\n
	";
	
//print $output;
	
	
	return $output;		
	
	
}//end BuildSlideShow

function collectContentForLandingPage($category_name){
	global $dbconn,$smarty;
	$sql = "SELECT * FROM cms_article_category WHERE name='".trim($category_name)."'";
	
	
//	echo $sql; exit;
	$result = $dbconn->Execute($sql);
	$category_config=$result->FetchRow();
	
		
	if($category_config){
		
	$sql = "SELECT * FROM cms_article WHERE cat_id='$category_config[id]' AND article_status='live' ORDER BY in_cat_order";
	
	$result = $dbconn->Execute($sql);
	$x=0;
	while(false!=($row=$result->FetchRow())){
		foreach($row as $key=>$value){
			$content[$x]->$key=$value;
		}
		$x++;
	}
	}
	
	if(!empty($content)){
	foreach($content AS $key=>$tmp_content){
		if(!$setseo){
			$smarty->assign('seo_title',"$tmp_content->seo_title");
			$smarty->assign('seo_keywords',"$tmp_content->seo_keywords");
			$smarty->assign('seo_description',"$tmp_content->seo_description");
			$setseo=true;
		}
		placeMedia($content[$key]->full_content);
		placeMedia($content[$key]->exerpt);
		placeCalendar($content[$key]->full_content);
		placeSlide($content[$key]->full_content);
		placeForm($content[$key]->full_content);
		cleanUpContentOutPut($content[$key]->exerpt);
		cleanUpContentOutPut($content[$key]->full_content);
		
		
	}
	}
	
	$data[content]=$content;
	$data[config]=$category_config;
	
	
	$smarty->assign('landing_content_array',$data);
}//collectContentForHomePage

function collectContentForCategory2($category_name){
	global $dbconn,$smarty;
	$sql = "SELECT * FROM cms_article_category WHERE name='".trim($category_name)."'";
	
	
//	echo $sql; exit;
	$result = $dbconn->Execute($sql);
	$category_config=$result->FetchRow();
	
		
	if($category_config){
		
		$sql = "SELECT * FROM cms_article WHERE cat_id='$category_config[id]' AND article_status='live' ORDER BY in_cat_order LIMIT 0,$category_config[no_articles]";
		$result = $dbconn->Execute($sql);
		$x=0;
		while(false!=($row=$result->FetchRow())){
			foreach($row as $key=>$value){
				$content[$x]->$key=$value;
			}
			$x++;
		}
	}
	
	if(!empty($content)){
	foreach($content AS $key=>$tmp_content){
		placeMedia($content[$key]->full_content);
		placeMedia($content[$key]->exerpt);
		placeCalendar($content[$key]->full_content);
		placeSlide($content[$key]->full_content);
		placeForm($content[$key]->full_content);
		cleanUpContentOutPut($content[$key]->exerpt);
		cleanUpContentOutPut($content[$key]->full_content);
	}
	}
	
	$data[content2]=$content;
	$data[config2]=$category_config;
	
	
	$smarty->assign('content_array2',$data);
}

function GetCategoryFromArticle($id){
	global $dbconn,$smarty,$smarty_vars;
	
	$sql = "Select cms_article_category.name From cms_article Inner Join cms_article_category ON cms_article.cat_id = cms_article_category.id Where cms_article.id ='$id'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());
	$category_name = trim($result->Fields('name'));

	return($category_name);
	
	
}//GetCategoryFromArticle
function BuildNavTree($name){
	
	global $dbconn,$smarty;

	if (strpos($name, '-'))
		$categoryprime = substr($name, 0,strpos($name, '-'));
	else
		$categoryprime=$name;

	$categoryprime=$categoryprime.'-';
	
	// Start the output
	$output = "<div class=\"SubNav-Wrap\">\n";


	//gather all articles from stated category


	$sql = "SELECT * FROM cms_article_category WHERE name LIKE'".trim($categoryprime)."%' ORDER BY no_articles ASC";

	//echo $sql;//exit;
	$result = $dbconn->Execute($sql);

	$output .= "<ul class=\"SubNav\">\n";
	$x=0;
	while(false!=($row=$result->FetchRow())){

		$Link = $row['name'];
		$LinkName = $row['description'];

		$output .= "<li><a href=\"/?page=$Link\" title=\"$LinkName\">".$LinkName."</a></li>\n";
		
		//look up all the articles in this cat  IF this is the nav element we are on!
		
		if($name==$Link){

			$sql2 = "SELECT * FROM cms_article WHERE cat_id=".$row['id']." AND article_status='live' ORDER BY in_cat_order";
			$result2 = $dbconn->Execute($sql2);
	
			$rowcount = $result2->RecordCount();
			
			//echo $sql2; 
			//echo $rowcount;
			
			if($rowcount>1){
				$output .= "<ul class=\"ThirdNav\">\n";
				
				while(false!=($row2=$result2->FetchRow())){
					$output .= "<li><a href=/full_content.php?article_id=".$row2['id']."&full=yes&pbr=1>".$row2['headline']."</a></li>\n";
				}
				
				$output .="</ul>";
			}//end row count
		}//need sub
	}//end while

	$output .="</ul>\n";
	
	$output .="
	</div>\n
	";

	//print $output;exit;
	return $output;

}
function assignRandomContent($category_name){
	global $dbconn,$smarty;
	$output = array();

	$sql = "SELECT t1.full_content, t1.headline FROM (cms_article AS t1,cms_article_category AS t2)
	WHERE t2.name='$category_name' AND t2.id=t1.cat_id AND article_status = 'live'";
	$result = $dbconn->Execute($sql) or die($dbconn->ErrorMsg());

	while(false!=($row=$result->FetchRow())){
		$output[]=$row[full_content];
	}

	shuffle($output);
	return $output[0];

}
function returnSpecificContent($article_category_name)
{
	global $dbconn;

	$content = array();
	$sql = "SELECT * FROM cms_article_category WHERE name='" . trim($article_category_name) . "'";

	$result = $dbconn->Execute($sql);
	$category_config=$result->FetchRow();

	if($category_config){

		$sql = "SELECT * FROM cms_article WHERE cat_id='$category_config[id]' AND article_status='live' ORDER BY in_cat_order";

		$result = $dbconn->Execute($sql);
		$x=0;
		while(false!=($row=$result->FetchRow())){
			foreach($row as $key=>$value){
				$content[$x]->$key=$value;
			}
			$x++;
		}
	}

	if(!empty($content)){
		foreach($content AS $key=>$tmp_content){
			placeMedia($content[$key]->full_content);
			placeMedia($content[$key]->exerpt);
			placeCalendar($content[$key]->full_content);
			placeSlide($content[$key]->full_content);
			placeForm($content[$key]->full_content);
			cleanUpContentOutPut($content[$key]->exerpt);
			cleanUpContentOutPut($content[$key]->full_content);
		}
	}


	return $content;
}
function BuildSlideShowNew($widget){
	global $dbconn,$smarty;


	//Slideshow Start
	$output = "
	<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js\"></script>
	<script src=\"/js/jquery.bxslider.js\"></script>
	<link href=\"/js/jquery.bxslider.css\" rel=\"stylesheet\" />


	<div class=\"widget-slideshow-wrap\">\n";

	//gather all articles from stated category

	$foo_cat = $widget[options][category];

	$sql = "SELECT * FROM cms_article_category WHERE name='".trim($foo_cat)."'";

	$result = $dbconn->Execute($sql);
	$category_config=$result->FetchRow();

	if($category_config){

		$sql = "SELECT * FROM cms_article WHERE cat_id='$category_config[id]' AND article_status='live' ORDER BY in_cat_order LIMIT 0,$category_config[no_articles]";
		$result = $dbconn->Execute($sql);
		$x=0;
		while(false!=($row=$result->FetchRow())){
			foreach($row as $key=>$value){
				$content[$x]->$key=$value;
			}
			$x++;
		}
	}//if

	$output .= "<ul class=\"bxslider\">\n";

	//write each panel
	for($i=0;$i<$x;$i++){
		$foo_count = $i+1;
		$foo=$content[$i]->headline;
		$foo_text=$content[$i]->full_content;

		$output .= "<li>\n
		$foo_text\n
		</li>\n
		";
	}

	$output .="
	</ul>\n
	</div>
	<script src=\"/js/slidestart.js\"></script>

	";

	//print $output;


	return $output;


}//end BuildSlideShow
function BuildMainNavTree($name,$classname){

	global $dbconn,$smarty;
	
	
	//gather cat names based on passed value

	$sqlone = "SELECT * FROM cms_article_category WHERE navlevel LIKE '".trim($name)."' ORDER BY position ASC";
	$resultone = $dbconn->Execute($sqlone);
	
	$output .= "<ul class=\"$classname\">\n";
	$x=0;
	//echo $sqlone;
	while(false!=($row=$resultone->FetchRow())){
	
		$Link = $row['name'];
		$LinkName = $row['description'];
		
		//check for sub nav based on passed name  ie  services subnav is services-ANYTHING
		if (strpos($Link, '-'))
			$categoryprime = substr($Link, 0,strpos($Link, '-'));
		else
			$categoryprime=$Link;
		
		$categoryprime=$categoryprime.'-';		

		
		$output .= "<li class=\"$Link\"><a class=\"$Link\" href=\"/?page=$Link\" title=\"$LinkName\" >".$LinkName."</a>\n";
	//LAZ I broke this query to remove drop downs //	
		$sql = "SELECT * FROM cms_article_category WHERE name LIKE 'asdred".trim($categoryprime)."%' ORDER BY no_articles ASC";
		
		//echo $sql;//exit;
		$result2 = $dbconn->Execute($sql);
		$rowcount = $result2->RecordCount();

		if($rowcount>1){
			$output .= "<ul class=\"second-level\">\n";
		
			while(false!=($row2=$result2->FetchRow())){
				$Link2 = $row2['name'];
				$LinkName2 = $row2['description'];
				
				
				$output .= "<li><a href=\"/?page={$row2['name']}\" title=\"{$row2['description']}\">{$row2['description']}</a></li>\n";
				
				$sql3 = "SELECT * FROM cms_article WHERE cat_id=".$row['id']." AND article_status='live' ORDER BY in_cat_order";
				$result3 = $dbconn->Execute($sql3);
	
				$rowcount = $result3->RecordCount();
					
				//echo $sql2;
				//echo $rowcount;
					
				if($rowcount>1){
					$output .= "<ul class=\"ThirdNav\">\n";
	
					while(false!=($row3=$result3->FetchRow())){
						$output .= "<li><a href=/full_content.php?article_id=".$row3['id']."&full=yes&pbr=1>".$row3['headline']."</a></li>\n";
					}
	
					$output .="</ul>";
				}//end row count
			}
		
			$output .="</ul>\n</li>\n";
		}else{ //end row count
				
			$output .= "</li>\n";
		
		}//end else
	


	
	}
	$output .="</ul>\n";
	//print $output;exit;
	return $output;

}

?>