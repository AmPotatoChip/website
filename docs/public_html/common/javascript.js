function nextSlide(play){
	var location = '/media_vault/images/';
	startCount=startCount+1;
	if(!slideFile[startCount]){
		startCount=0;	
	}
	
	document.getElementById('slidecaption').innerHTML = slideCap[startCount];
	document.getElementById('imagedata').src = location+slideFile[startCount];
	if(play=='continue'){
		playSlideShow();	
	}
}

function prevSlide(){
	var location = '/media_vault/images/';
	if(startCount == 0){
		startCount = total-1;	
	}else{
		startCount = startCount-1;	
	}
	
	document.getElementById('imagedata').src = location+slideFile[startCount];
	document.getElementById('slidecaption').innerHTML = slideCap[startCount];
}

function playSlideShow(){
	if(automatic==true){
	setTimeout("nextSlide('continue')",3000);
	}
}

