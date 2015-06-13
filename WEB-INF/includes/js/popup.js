// the functions in this file require the supplementary library lib.js

// These defaults should be changed the way it best fits your site
var _POPUP_FEATURES = '';

function raw_popup(url, target, features) {
    // pops up a window containing url optionally named target, optionally having features
    if (isUndefined(features)) features = _POPUP_FEATURES;
    if (isUndefined(target  )) target   = '_blank';
    var theWindow = window.open(url, target, features);
    theWindow.focus();
    return theWindow;
}

function raw_popup_image(url, target, features) {
    // pops up a window containing url optionally named target, optionally having features
    if (isUndefined(features)) features = _POPUP_FEATURES;
    if (isUndefined(target  )) target   = '_blank';
    var theWindow = window.open('', target, features);
	
	theWindow.document.write('<html><head><title>'+url+'</title><style>body {padding:0}</style></head>'); 
	theWindow.document.write('<body onload="if(this.document.images.length>0) {this.resizeTo(this.document.images[0].width+30,this.document.images[0].height+75);}"><img src="'+url+'"></body></html>'); 
	theWindow.document.close(); 
    theWindow.focus();
    return theWindow;
}

function link_popup(src, features) {
    // to be used in an html event handler as in: <a href="..." onclick="link_popup(this,...)" ...
    // pops up a window grabbing the url from the event source's href
    return raw_popup(src.getAttribute('href'), src.getAttribute('target') || '_blank', features);
}

function link_popup_image(src, features) {
    // to be used in an html event handler as in: <a href="..." onclick="link_popup(this,...)" ...
    // pops up a window grabbing the url from the event source's href
    return raw_popup_image(src.getAttribute('href'), src.getAttribute('target') || '_blank', features);
}

function event_popup(e) {
    // to be passed as an event listener
    // pops up a window grabbing the url from the event source's href
    link_popup(e.currentTarget);
    e.preventDefault();
}

function event_popup_features(features) {
    // generates an event listener similar to event_popup, but allowing window features
    return function(e) { link_popup(e.currentTarget, features); e.preventDefault() }
}

function event_popup_image(features) {
    // generates an event listener similar to event_popup, but allowing window features
    return function(e) { link_popup_image(e.currentTarget, features); e.preventDefault() }
}
