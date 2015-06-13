// functii utile in diverse operatii asupra aplicatiei web
// ------------------------------------------------------------------------------------------------------

// ACTION: 			functie de trimitere a datelor dintr-un form la confirmarea unei actiuni
// Parametrii: 		form - numele formularului
// 					id - valoare (id-ul) care se trimite ca variabila
// 					text - textul care va fi afisat in caseta de confirmare generata
// Returneaza:		testeza confirmarea si lanseaza trimitera datelor in caz afirmativ
// Uz: 				la operatiile care necesita confirmarea actiunii
// ------------------------------------------------------------------------------------------------------
function action(form, id, text) {
	if(confirm(text)) {
		eval("document."+form+".id.value="+id);
		eval("document."+form+".submit()");
	}
}
// ------------------------------------------------------------------------------------------------------


// OPENWIND:	functie de deschidere a unei fereastre popup
// Parametrii: 	file_link - fisierul care se deschide in fereastra popup
// 				width - latimea ferestrei popup
// 				height - inaltimea ferestrei popup
// 				scrollbar - este yes sau no, functie de preferinte
// Returneaza:	deschiderea unei ferestre popup
// Uz: 			uneori
// ------------------------------------------------------------------------------------------------------
function openwind(file_link, width, height, scrollbar) {
	var parameters;
	var winx = (screen.width - width) / 2;
    var winy = (screen.height - height) / 2;
	
	parameters = "width="+width+", height="+height+", top="+winy+", left="+winx+", status=no, scrollbars="+scrollbar;
	
	win = window.open(file_link,'view',parameters);
	win.window.focus();
}
// ------------------------------------------------------------------------------------------------------


// CHECK_PASS:	functie de verificare a egalitatii parolelor dintr-un formular
// Parametrii: 	form - numele formularului ptr care se verifica egalitatea celor 2 parole
// 				field_pass - numele campului de introducere al parolei
// 				field_pass_re - numele campului de reintroducere al parolei
// 				field_pass_re - 
// Returneaza:	TRUE - in caz de succes, FLASE	
// Uz:			uneori
// ------------------------------------------------------------------------------------------------------
function check_pass(form, field_pass, field_pass_re) {
	var valid = true;
	
	// verificare egalitate parole :
	if(eval("form."+field_pass+".value!=form."+field_pass_re+".value")) {
		valid = false;
		alert("Both passwords must have the same value!");
		return valid;
	}
	
	return valid;
}
// ------------------------------------------------------------------------------------------------------


// GO_TO_LOCATION:	functie de redirectare catre o alta pagina
// Parametrii: 		form_name - numele formularului in care este inclus select-ul de redirectare
// 					select_name - numele campului select
// 					var_name - numele variabilei GET care se trimite
// 					var_value - valoarea variabilei GET care se trimite
// 					uri - pagina care se va accesa
// 					operation - este "" daca variabila GET este unica
// Returneaza:		
// Uz:				ptr redirectarea catre o pagina printr-un formular
// ------------------------------------------------------------------------------------------------------
function go_to_location(form_name, select_name, var_name, var_value, uri, operation) {
	var url = "";
	
	if(operation!="") {
		url = uri+"&";
	} else {
		url = uri+"?";
	}
	
	if(eval(form_name+"."+select_name+".value!=0")) {
		window.location = url+var_name+"="+var_value;
	}
}
// ------------------------------------------------------------------------------------------------------


// functie ce verifica sa se introduca doar numere :
// ------------------------------------------------------------------------------------------------------
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
	
	return valid;
}
// ------------------------------------------------------------------------------------------------------


// functie utila ptr introducerea preturilor :
// ------------------------------------------------------------------------------------------------------
function verify_price_field(price, price_alert, points_error) {
	valid = true;
	
	var sw_price, puncte;
	puncte = 0;

	for(var j=0; j<price.length; j++) {
		if(isNaN(price.charAt(j)) && price.indexOf(".")==-1) {
			sw_price = 1;
			break;
		}
		
		if(price.charAt(j)==".")
			puncte++;
	}
	
	if((sw_price==1)) {
		valid = false;
		alert(price_alert);
		return valid;
	} else {
		// se verifica ca pretul sa nu aiba mai multe puncte asociate :
		if(puncte>1) {
			valid = false;
			alert(points_error);
			return valid;
		}
	}
	
	return valid;
}
// ------------------------------------------------------------------------------------------------------


// functie de verificare a extensiei imaginilor :
// ------------------------------------------------------------------------------------------------------
function check_ext(path) {
	var array_ext = Array("jpg","jpeg","jpe");
	var img_array = path.split(".");
	var ext, sw_ext=0;
	
	for(i=0;i<img_array.length;i++) {
		if(i==(img_array.length-1)) {
			ext = img_array[i];
		}
	}
	
	for(i=0;i<array_ext.length;i++) {
		if(ext.toUpperCase()==array_ext[i] || ext.toLowerCase()==array_ext[i]) {
			sw_ext = 1;
			break;
		}
	}
	
	return sw_ext;
}
// ------------------------------------------------------------------------------------------------------


// functie de verificare a extensiei unui fisier :
// ------------------------------------------------------------------------------------------------------
function check_ext_file(path) {
	var array_ext = Array("pdf");
	var img_array = path.split(".");
	var ext, sw_ext=0;
	
	for(i=0;i<img_array.length;i++) {
		if(i==(img_array.length-1)) {
			ext = img_array[i];
		}
	}
	
	for(i=0;i<array_ext.length;i++) {
		if(ext.toUpperCase()==array_ext[i] || ext.toLowerCase()==array_ext[i]) {
			sw_ext = 1;
			break;
		}
	}
	
	return sw_ext;
}
// ------------------------------------------------------------------------------------------------------


// functie de verificare a adresei de e-mail :
// ------------------------------------------------------------------------------------------------------
function check_mail(str,text) {
	valid = true;
	if(str=="") {
		alert(text);
		valid = false;
	} else {
		tmp = str;
		if(tmp.indexOf("@")==-1 || tmp.indexOf("@")==0) {
			alert(text);
			valid = false;
		} else {
			arr1 = new Array();
			arr1 = tmp.split("@");
			if(arr1[1].indexOf(".")==-1 || arr1[1].indexOf(".")==0) {
				alert(text);
				valid = false;
			} else {
				arr2 = new Array();
				arr2 = arr1[1].split(".");
				if(arr2[1].length<2 || arr2[1].length>20) {
					alert(text);
					valid = false;
				}
			}
		}
	}
	return valid;
}
// ------------------------------------------------------------------------------------------------------




// ------------------------------------------------------------------------------------------------------