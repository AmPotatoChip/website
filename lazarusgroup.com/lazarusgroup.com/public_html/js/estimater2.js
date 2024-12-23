/**


 * 
*/

	$(document).ready(function(){
		$('.estimateFrm').on('submit', function () {
			
		    calculate();
		    //alert(estimateAmount);
	           $('.currency').formatCurrency();
		    return false;
		});
		
		$('#printmedia').change(function(){
			var foo = document.getElementById('printmedia').value;
			//alert(foo);
		    document.getElementById("estimateAmount").value = "";
		    document.getElementById("estimateFrame").value = "";

			switch(foo)
			{
			case '1':
			case '2':
			case '3':
			case '4':
			case '5':
			case '6':
			case '7':
			case '8':
				var elem = document.getElementById('stretch');
				document.getElementById('canvasstretch').value = "-";
				elem.style.display = "none";
				document.getElementById('frame').style.display = "none";

				break;
			case '9':
			case '10':
			case '11':
				var elem = document.getElementById('stretch');
				elem.style.display = "block";
				document.getElementById('frame').style.display = "block";
				break;
			}
		});

		$('form input').on('keypress', function(e) {
		    return e.which !== 13;
		});
       $('.currency').blur(function()
        {
            $('.currency').formatCurrency();
        });
		
	});

function calculate(){
	var name = document.getElementById('printmedia').value;
	var estimateAmount = 0.00;
	var estimateFrame = 0.00;
	var frameprice = 0.00;
	var total = 0.00;
	
	 //alert(name);	
	var width  = Number(document.getElementById('width').value);
	var height = Number(document.getElementById('height').value);
	var framewidth  = Number(document.getElementById('width').value);
	var frameheight = Number(document.getElementById('height').value);
	var price = 0.00;
	
	
	var canvasmod = document.getElementById('canvasstretch').value;
	var bag = +document.getElementById('bag').value;


	var bag = +document.getElementById('bag').value;
/*
	switch(canvasmod)
	{
	case '1':
		width = (width+4);
		height = (height+4);
		frameprice = 1.49;
		break;
	case '2':
		width = (width+6);
		height = (height+6);
		frameprice = 1.80;
		break;
	case '3':
	default:
		width = (width+4);
		height = (height+4);
		break;
	}
	*/
		//alert(name);
		switch(name)
		{
		case '1':
			price = .071;
			estimateAmount = (price*width*height);
			estimateAmount = (estimateAmount+1.50);
			//alert(price);
			//alert(width);
			//alert(height);
			
			break;
		case '2':
			price = .078;
			estimateAmount = (price*width*height);
			estimateAmount = (estimateAmount+1.50);
			break;

		case '3':
			price = .075;
			estimateAmount = (price*width*height);
			estimateAmount = (estimateAmount+1.50);
			break;
		case '4':
			price = .114;
			estimateAmount = (price*width*height);
			estimateAmount = (estimateAmount+1.50);
			break;
		case '5':
			price = .109;
			estimateAmount = (price*width*height);
			estimateAmount = (estimateAmount+1.50);
			break;
		case '6':
			price = .116;
			estimateAmount = (price*width*height);
			estimateAmount = (estimateAmount+1.50);
			break;

		case '7':
			price = .107;
			estimateAmount = (price*width*height);
			estimateAmount = (estimateAmount+1.50);
			break;
		case '8':
			price = .105;
			estimateAmount = (price*width*height);
			estimateAmount = (estimateAmount+1.50);
			break;
			
		case '9':
			price = .095;
			width = (width+4);
			height = (height+4);
			frameprice = 1.80;
			
			//alert(price);
			//alert(width);
			//alert(height);
			
			estimateAmount = (price*width*height);
			estimateAmount = (estimateAmount+1.50);
			estimateFrame = (framewidth+frameheight)*frameprice;
			//alert(estimateAmount);
			break;
		case '10':
			price = .116;
			width = (width+4);
			height = (height+4);
			frameprice = 1.80;
			estimateAmount = (price*width*height);
			estimateAmount = (estimateAmount+1.50);
			estimateFrame = (framewidth+frameheight)*frameprice;
			
			break;
		case '11':
			price = .119;
			width = (width+4);
			height = (height+4);
			frameprice = 1.80;
			estimateAmount = (price*width*height);
			estimateAmount = (estimateAmount+1.50);
			estimateFrame = (framewidth+frameheight)*frameprice;
			break;
		case '12':
			price = .089;
			estimateAmount = (price*width*height);
			estimateAmount = (estimateAmount+1.50);
			break;
		}
	    //alert(estimateAmount);	
		
		total = estimateAmount+estimateFrame+bag;
		//alert(total);
	    document.getElementById("estimateAmount").value = estimateAmount.toFixed(2);
	    document.getElementById("estimateFrame").value = estimateFrame.toFixed(2);
	    document.getElementById("estimatetotal").value = total.toFixed(2);

		return true;

}