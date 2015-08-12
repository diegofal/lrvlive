COUNTRIES_WITHOUT_POSTCODES = [
	"AO" ,
	"AG" ,
	"AW" ,
	"BS" ,
	"BZ" ,
	"BJ" ,
	"BW" ,
	"BF" ,
	"BI" ,
	"CM" ,
	"CF" ,
	"KM" ,
	"CG" ,
	"CD" ,
	"CK" ,
	"CI" ,
	"DJ" ,
	"DM" ,
	"GQ" ,
	"ER" ,
	"FJ" ,
	"TF" ,
	"GM" ,
	"GH" ,
	"GD" ,
	"GN" ,
	"GY" ,
	"HK" ,
	"IE" ,
	"JM" ,
	"KE" ,
	"KI" ,
	"MO" ,
	"MW" ,
	"ML" ,
	"MR" ,
	"MU" ,
	"MS" ,
	"NR" ,
	"AN" ,
	"NU" ,
	"KP" ,
	"PA" ,
	"QA" ,
	"RW" ,
	"KN" ,
	"LC" ,
	"ST" ,
	"SA" ,
	"SC" ,
	"SL" ,
	"SB" ,
	"SO" ,
	"ZA" ,
	"SR" ,
	"SY" ,
	"TZ" ,
	"TL" ,
	"TK" ,
	"TO" ,
	"TT" ,
	"TV" ,
	"UG" ,
	"AE" ,
	"VU" ,
	"YE" ,
	"ZW"
];


function checkemail(){
	var str=document.step3.order_email.value
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	if (filter.test(str)){
		return false;
	} else {
		return true;
	}
}

function openwind(file_link, width, height, scrollbar) {
	var parameters;
	var winx = (screen.width - width) / 2;
    var winy = (screen.height - height) / 2;
	
	parameters = "width="+width+", height="+height+", top="+winy+", left="+winx+", status=no, scrollbars="+scrollbar;
	
	win = window.open(file_link,'view',parameters);
	win.window.focus();
}
function countryChange(){
	if($.inArray($('#country').val(), COUNTRIES_WITHOUT_POSTCODES) >= 0){
		document.step3.order_zip.value = 0;
		$("#divPostCode").css('display', 'none');
	} else {
		document.step3.order_zip.value = '';
		$("#divPostCode").css('display', 'block');
	}

	if ($('#country').val() == 'US') {$('#stateDiv').css('display', 'block')} else { $('#stateDiv').css('display', 'none') };
}

$( document ).ready(function() {
	if ($('#country').val() == 'US') {$('#stateDiv').css('display', 'block')} else { $('#stateDiv').css('display', 'none') };
	if($.inArray($('#country').val(), COUNTRIES_WITHOUT_POSTCODES) >= 0){
		document.step3.order_zip.value = 0;
		$("#divPostCode").css('display', 'none');
	} else {
		$("#divPostCode").css('display', 'block');
	}
});

function check_form(){
		try {
			if(document.step3.terms.checked==false) throw("Please confirm that you have read our Terms & Conditions.");
			if(document.step3.order_find.value=='0') throw("Please select a suitable option from the dropdown!");
			if (document.step3.order_first_name.value == '') throw("Please type your name");
			if (document.step3.order_last_name.value == '') throw("Please type your Surname");
			if (document.step3.order_phone.value == '') throw("Please type your phone");
			if (checkemail()) throw("Please type a valid email address");
			//if (document.step3.order_email.value == '') throw("Please type your email");
			if (document.step3.order_city.value == '') throw("Please type your city");
			if (document.step3.order_street_address1.value == '') throw("Please type your address");
			if (document.step3.order_zip.value == '') throw("Please type your Post code or 0");
		}
		catch (err){
			alert(err);
			return;
		}
		document.step3.submit();


}