// JavaScript Document
function validateForm(formObj) {

	var Required = formObj.required;
	var fieldArray;
	var qname = '';
	var oField;
	var sFormName = formObj.name;
	var tmpFieldArray;
	var tmpFieldString;
	var sErrormsg = '';
	var bRetval = true;
	var undefined;
	if (Required != undefined) {
		fieldArray = Required.value.split(',');
	}
	else
	{
		alert('Required field missing on form.  Must have hidden field named \'required\' with a comma seperated list of fields in the format \'HTML Field Name|Field Label\'');	
	}
	for(var i=0;i<fieldArray.length;i++) {
		tmpFieldString = fieldArray[i].toString();
		tmpFieldArray = tmpFieldString.split('|');
		
		//if (sFormName.name != undefined) {
			
			oField=undefined;
			for(var fe=0;fe<formObj.length;fe++) {
				if (formObj.elements[fe].name == tmpFieldArray[0]) {
					
						//alert (formObj.elements[fe].name);
					if (formObj.elements[fe].type=='radio'){
						//this is a radio button CHOICE, not the radio button
						//we must make oField hold the whole radio button array, using Eval fxn
						oField = eval('formObj.' + formObj.elements[fe].name);
					}else{
						//normal treatment
						oField = formObj.elements[fe];
					}
					
				}
			}
		//}
		//else {
			
		//	oField = eval('document.' + sFormName + '.' + tmpFieldArray[0]);
		//}
		qname = tmpFieldArray[1];
		if (oField == undefined) {
			alert('Error! ' + tmpFieldArray[0] + ' is not a valid field on your form.');
			bRetval = true;
		}
		else {
			bRetval = CheckRequired(oField);
		}
		if(bRetval == false) {
			sErrormsg = sErrormsg.toString() + 'Please complete: ' + qname + '\n';
		}
	}
	if (sErrormsg.length > 0) {
		alert('The following errors were found on this form:\n' + sErrormsg);
		return false;
	}
	else {
		return true;
	}
	
}

function CheckRequired(Obj) {
	var ObjType;
	var retVal;
	var x = 0;
	var undefined;
	ObjType = Obj.type;
	/* types: password, radio, select-multiple, select-one, text, textarea */
	if (ObjType == undefined) {
		ObjType = Obj[0].type;
	}
	switch(ObjType) {
		case 'hidden':
			if(Obj.value.length < 1) {
				retVal = false;
			}
			else {
				retVal = true;
			}
		break;
		case 'text':
			if(Obj.value.length < 1) {
				retVal = false;
			}
			else {
				retVal = true;
			}
		break;
	
		case 'textarea':
			if(Obj.value.length < 1) {
				retVal = false;
			}
			else {
				retVal = true;
			}
		break;
	
		case 'password':
			if(Obj.value.length < 1) {
				retVal = false;
			}
			else {
				retVal = true;
			}
		break;
		case 'file':
			if(Obj.value.length < 1) {
				retVal = false;
			}
			else {
				retVal = true;
			}
		break;
		case 'select-one':
			if(Obj.selectedIndex > 0) {
				retVal = true;
			}
			else {
				retVal = false;
			}
		break;
		
		case 'select-multiple':
			retVal = false;
			for (var x=0;x<Obj.options.length;x++) {
				if (Obj[x].selected) {
					retVal = true;
				}
			}
		break;
		
		case 'radio':
			retVal = false;
			
			for(var x=0;x<Obj.length;x++) {
				
				if (Obj[x].checked) {
					retVal = true;
				}
			}
		break;
		
		case 'checkbox':
		
			if (navigator.appName == 'Netscape' && (navigator.appVersion.toString().substr(0,1) == '4' || navigator.appVersion.toString().substr(0,1) == '3' || navigator.appVersion.toString().substr(0,1) == '2')) {
				var arrNum = Obj.length - 1;
				var cbObj;
				if (Obj[arrNum] == undefined) {
					cbObj = Obj;
				}
				else {
					cbObj = Obj[arrNum];
				}
				var formObj = cbObj.form;
				var cbName = cbObj.name;
				var cbCount = 0;
				var cbFirstChecked = cbObj.checked;
				var cbOtherChecked = false;
				for (var cb=0;cb<formObj.length;cb++) {
					if (formObj.elements[cb].type == 'checkbox' && formObj.elements[cb].name == cbName) {
						cbCount++;
						if (formObj.elements[cb].checked) {
							cbOtherChecked = true;
							}
					}
				}
				if (cbCount > 0) {
					if (cbFirstChecked || cbOtherChecked) {
						retVal = true;
					}
					else {
						retVal = false;
					}
				}
				else {
					if (cbFirstChecked) {
						retVal = true;
					}
					else {
						retVal = false;
					}
				}
			}
			else {
			retVal = false;
			if (Obj.length != undefined) {
				for(var x=0;x<Obj.length;x++) {
					if (Obj[x].checked) {
						retVal = true;
					}
				}
			}
			else {
				if (Obj.checked == true) {
					retVal = true;
				}
			}
		}
		break;
		
		
		default:
			retVal = true;
	}
	return retVal;
}

