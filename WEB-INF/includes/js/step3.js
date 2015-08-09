function openwind(file_link, width, height, scrollbar) {
	var parameters;
	var winx = (screen.width - width) / 2;
    var winy = (screen.height - height) / 2;
	
	parameters = "width="+width+", height="+height+", top="+winy+", left="+winx+", status=no, scrollbars="+scrollbar;
	
	win = window.open(file_link,'view',parameters);
	win.window.focus();
}
function countryChange(){
	if ($('#country').val() == 'US') {$('#stateDiv').css('display', 'block')} else { $('#stateDiv').css('display', 'none') };
}

$( document ).ready(function() {
	if ($('#country').val() == 'US') {$('#stateDiv').css('display', 'block')} else { $('#stateDiv').css('display', 'none') };
});

function check_form(){
		try {
			if(document.step3.terms.checked==false) throw("Please confirm that you have read our Terms & Conditions.");
			if(document.step3.order_find.value=='0') throw("Please select a suitable option from the dropdown!");
			if (document.step3.order_first_name.value == '') throw("Please type your name");
			if (document.step3.order_last_name.value == '') throw("Please type your Surname");
			if (document.step3.order_phone.value == '') throw("Please type your phone");
			if (document.step3.order_email.value == '') throw("Please type your email");
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