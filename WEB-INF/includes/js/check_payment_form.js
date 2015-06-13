// trimitere formular :
function submitonce(theform) {
	var valid = true;
	
	// se face verificarea formularului :
	// ------------------------------------------------------------------------------------------
	// sjname :
	if(theform.sjname.value=="") {
		valid = false;
		alert("Please fill the \"Name\" field!");
		return valid;
	}
	
	// streetaddress :
	if(theform.streetaddress.value=="") {
		valid = false;
		alert("Please fill the \"Address\" field!");
		return valid;
	}
	
	// city :
	if(theform.city.value=="") {
		valid = false;
		alert("Please fill the \"City\" field!");
		return valid;
	}
	
	// state :
	if(theform.state.value=="0") {
		valid = false;
		alert("Please choose the \"State\"!");
		return valid;
	}
	
	// zipcode :
	if(theform.zipcode.value=="") {
		valid = false;
		alert("Please fill the \"Zip Code\" field!");
		return valid;
	}
	
	// accountnumber :
	if(theform.accountnumber.value=="") {
		valid = false;
		alert("Please fill the \"Credit Card Number\" field!");
		return valid;
	}
	
	// month :
	if(theform.month.value=="0") {
		valid = false;
		alert("Please choose the \"Month\"!");
		return valid;
	}
	
	// year :
	if(theform.year.value=="0") {
		valid = false;
		alert("Please choose the \"Year\"!");
		return valid;
	}
	
	// shiptophone :
	if(theform.shiptophone.value=="") {
		valid = false;
		alert("Please fill the \"Phone\" field!");
		return valid;
	}
	
	// ------------------------------------------------------------------------------------------
	
	//if IE 4+ or NS 6+
	if(document.all || document.getElementById) {
		//screen thru every element in the form, and hunt down "submit" and "reset"
		for (i=0;i<theform.length;i++) {
			var tempobj = theform.elements[i];
			if((tempobj.type.toLowerCase()=="submit") || (tempobj.type.toLowerCase()=="reset"))
				tempobj.disabled = true; //disable em
		}
	}
	
	return valid;
}