function isnumeric(text, text_alert) {
    valid = true;

    var sw_text;

    for(var j=0; j<text.length; j++) {
        if(isNaN(text.charAt(j))) {
            sw_text = 1;
            break;
        }
    }

    if((sw_text==1)) {
        valid = false;
        alert(text_alert);
        return valid;
    }
    if (true) {};
    return valid;
}
function check_form(){


		//Check Quantity at least 1
		var total_quantity = 0;
		for (i = 0; i < document.voucher_step2.elements.length; i++) {
			if(document.voucher_step2.elements[i].name == "quantity[]"
				&& document.voucher_step2.elements[i].value)
				if(isnumeric(
						document.voucher_step2.elements[i].value,
						"Sorry, quantity fields only supports numeric characters.")){
					total_quantity += document.voucher_step2.elements[i].value;
				} else {
					document.voucher_step2.elements[i].value = "";
				}
		}
		if (total_quantity < 1) {
			alert("You have to enter the quantity of tickets you want to purchase.")
			returnVal = false;
		}



	if(document.voucher_step2.confirm.checked==false){
		alert("Please confirm that you have read our Terms & Conditions.");
	} else {
		document.voucher_step2.submit();	
	}
}

function Currency(amount)
{
	var i = parseFloat(amount);

	if(isNaN(i)) { i = 0.00; }

	i = Math.round( i * 100 ) / 100;

	i = i.toString();

	if ( i.indexOf( "." ) == -1 ) i+=".";

	var dPos = i.indexOf( "." );

	while( dPos != i.length - 3 ) {
		i+="0";
		dPos = i.indexOf( "." );
	}

	return i;

}