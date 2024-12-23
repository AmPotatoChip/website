<? 
include("../common/page_start.php");
include("../common/feedcreator.class.php");

$stories = collectRSSStories();

$rss = new AtomCreator03();

$rss->encoding='UTF-8';
$rss->useCached();
$rss->title = "Amy Thompson Run";
$rss->description = "My Run.  My Funn";
$rss->link = "http://www.amythompsonrun.org/rss/";
$rss->syndicationURL = "http://www.amythompsonrun.org/rss/";

foreach($stories as $tmp){
	$item = new FeedItem();
	$item->title = $tmp->headline;
	$item->link = 'http://www.presentmagazine.com/full_content.php?article_id='.$tmp->id.'&full=yes&pbr=1';
	$item->description = strip_tags(html_entity_decode($tmp->exerpt));
	$rss->addItem($item);
}

echo $rss->createFeed();
?>