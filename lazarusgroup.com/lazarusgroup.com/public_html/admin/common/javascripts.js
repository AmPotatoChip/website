function hideunhide(objID){
	var object = document.getElementById(objID).style.display;
	switch(object){
		default:
			document.getElementById(objID).style.display='none';
		break;	
		case 'none':
			document.getElementById(objID).style.display='';
		break;
	}
}

function reorderArciles(articleID,newOrder){
	newPosition = document.getElementById(newOrder).value;	
	document.location.href='article_order_change.php?article_id='+articleID+'&newpos='+newPosition;
}

function viewArticle(articleID){
	var page=window.open('view_article.php?article_id='+articleID,'medialib','width=750,height=500,scrollbars=yes');
	page.focus();
}

function changeMainArticle(obj,catID){
	var newMainArticleID = obj.value;
	window.location.href='content_editor.php?catid='+catID+'&main='+newMainArticleID+'&changeMainArticle=true'+'&type=live';
	
}

function articleStatusChange(obj,articleID){
	var newStatus = obj.value;
	window.location.href='change_article_status.php?article_id='+articleID+'&newStatus='+newStatus;
}

function contentEditorNav(catid,type){
	document.location.href='content_editor.php?'+'catid='+catid+'&type='+type;	
}

function changeSlideShowOrder(media_id,obj,group_id){
	document.location.href='change_slide.php?media_id='+media_id+'&npos='+obj.value+'&group_id='+group_id;
}

function templatePreview(tempSelect,messageID){
	var template = tempSelect.value;
	if(template != ''){
		document.location.href='preview_message.php?message_id='+messageID+'&template='+template;
	}
}

function setSlideshowGroupDefault(obj){
	var oGroupID = obj.value;
	if(oGroupID!=''){
		document.location.href='set_default_slideshow_group.php?group_id='+oGroupID;	
	}
}