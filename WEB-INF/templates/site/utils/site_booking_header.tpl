<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- New booking design -->
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1" />
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<!-- Place favicon.ico in the root directory -->
<link rel="stylesheet/less" type="text/css" href="css/main.less" />
<link href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900' rel='stylesheet' type='text/css'>
<script src="js/vendor/modernizr-2.8.3.min.js"></script>
<script src="js/vendor/less.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- End New booking design -->

    <title>{if $content.page_title != ""} {$content.page_title} {else}

            London RIB Voyages{/if}</title>
{$MycontentpageMeta}
{if $subpage == '_tour_details'}
{$tour.page_meta}
{elseif $subpage == '_package_details'}
{$package.page_meta}
{else}
{$content.page_meta}
{/if}
<link href="WEB-INF/assets/css/style.css" rel="stylesheet" type="text/css" />
{if $page == "location"}
{literal}
 <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAk_PeATHc7Zk4v935p5iMORQyasHvbimZ52QT_h2fTtA71RTODRQ4xDTS8sZxMt0yUhjUPYWjkGCeew" type="text/javascript"></script>
<script type="text/javascript">
    //<![CDATA[
		var WINDOW_HTML = '<div style="width: 210px; padding-right: 10px">London Rib Voyages 39 York Rd Lambeth, Greater London SE1 7, UK</div>';

    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("mapsearch"));
            	map.addControl(new GSmallMapControl());
			map.addControl(new GMapTypeControl());
        map.setMapType(G_HYBRID_MAP);
        map.setCenter(new GLatLng(51.503293230761045, -0.11954069137573242), 16);

        var marker = new GMarker(new GLatLng(51.503293230761045, -0.11954069137573242));
				map.addOverlay(marker);
				GEvent.addListener(marker, "click", function() {
				marker.openInfoWindowHtml(WINDOW_HTML);
				  });
				//marker.openInfoWindowHtml(WINDOW_HTML);
      }
    }
    //]]>
    </script>
{/literal}
{/if}
{literal}
<script type="text/javascript" src="WEB-INF/includes/js/main.js"></script>
<script type="text/javascript" src="WEB-INF/includes/js/pngfix.js"></script>
<script type="text/javascript" src="WEB-INF/includes/js/flash.js"></script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23852518-1']);
  _gaq.push(['_trackPageview']);

 (function() {
   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
{/literal}
{if $page=="route"}
{literal}
        <script language="javascript" type="text/javascript">
        function hidediv() {
            if (document.getElementById) { // DOM3 = IE5, NS6
                document.getElementById('hideshow').style.visibility = 'hidden';
            }
            else {
                if (document.layers) { // Netscape 4
                    document.hideshow.visibility = 'hidden';
                }
                else { // IE 4
                    document.all.hideshow.style.visibility = 'hidden';
                }
            }
        }
        function _absLeft(obj) { return (obj.offsetParent)? obj.offsetLeft+_absLeft(obj.offsetParent) : obj.offsetLeft; }
        function _absTop(obj) { return (obj.offsetParent)? obj.offsetTop+_absTop(obj.offsetParent) : obj.offsetTop; }
        function showdiv(item) {
            itemId = item.id;
            itemId = itemId.substring(4,itemId.length-2);

            parentE = document.getElementById('pd'+itemId);

            //parentE = item.parentNode.parentNode;

            closeButton = document.createElement('a');
            closeButton.setAttribute('href','javascript:hidediv()');
            {/literal}
            closeButton.innerHTML = '<img src="http://{$smarty.server.SERVER_NAME}/img/css/bclose.gif" width="13" height="13" alt="Close" title="Close" style="position:absolute;" border="0" />';
            {literal}

            nTable 	= document.createElement('table');
            nBody 	= document.createElement('tbody');
            nTr 	= document.createElement('tr');

            //itemNumber = parentE.firstChild.firstChild;
			itemNumber = document.getElementById("pv"+itemId);
			//itemName = itemNumber.parentNode.nextSibling.firstChild;
			itemName = document.getElementById("pn"+itemId);
            //itemText = parentE.lastChild;
			itemText   = document.getElementById("Text"+itemId)

			//alert(itemText);
			//return false;

            itemTextContent = itemText.innerHTML;


            nTd1 = document.createElement('td');
            nTd2 = document.createElement('td');
			nTd1.setAttribute('class','style_vertical');
			nTd2.setAttribute('class','style_vertical');

            nTd1.innerHTML = '<span class="style_heading_text">'+itemNumber.innerHTML+'.&nbsp;'+itemName.innerHTML+'</span><br /><span class="style_normal_text">'+itemTextContent+'</span>';
            {/literal}
            nTd2.innerHTML = '<img src="http://{$smarty.server.SERVER_NAME}/img/route/'+itemId+'.jpg" width="119" height="138" alt="'+itemName.innerHTML+'" title="'+itemName.innerHTML+'" />';
            {literal}

            nTr.appendChild(nTd1);
            nTr.appendChild(nTd2);

            nBody.appendChild(nTr);

            detty = document.createElement('div');
            detty.setAttribute('class','detty');

            nTable.appendChild(nBody);
            detty.appendChild(nTable);

            dettop = document.createElement('div');
            dettop.setAttribute('class','dettop');


            if (document.getElementById) { // DOM3 = IE5, NS6
                element = document.getElementById('anchor');
                deltaX = _absLeft(element)+155;
                deltaY = _absTop(element)-150;

                if(document.getElementById('hideshow').hasChildNodes()){document.getElementById('hideshow').removeChild(document.getElementById('hideshow').firstChild);document.getElementById('hideshow').removeChild(document.getElementById('hideshow').firstChild);}
                {/literal}
                document.getElementById('hideshow').innerHTML = '<div class="dettop"><a href="javascript:hidediv()"><img src="http://{$smarty.server.SERVER_NAME}/img/css/bclose.gif" alt="Close" title="Close" style="position: absolute;margin:27px 0px 0px 412px;" height="13" width="13" border="0"></a></div><div class="detty" id="detty"></div><div class="detbot"></div>';
                {literal}
                //document.getElementById('hideshow').appendChild(closeButton);
                document.getElementById('detty').appendChild(nTable);
                document.getElementById('hideshow').style.left = deltaX+'px';
                document.getElementById('hideshow').style.top = deltaY+'px';
                document.getElementById('hideshow').style.visibility = 'visible';
            }
            else {
                if (document.layers) { // Netscape 4
                    document.hideshow.visibility = 'visible';
                }
                else { // IE 4
                    document.all.hideshow.style.visibility = 'visible';
                }
            }
        }
        function _clearEvent(event) {if(event.preventDefault) {event.preventDefault();event.returnValue = false;} else {window.event.returnValue = false;}}
        function rollUp(item)
        {
            itemId = item.id;
            itemId = itemId.substring(4,itemId.length-2);
        }
        function rollDown(item)
        {
            itemId = item.id;
            itemId = itemId.substring(4,itemId.length-2);
        }
        </script>
{/literal}
{/if}
{if $subpage=="_tour_details" || $subpage=="_package_details" || $subpage=="_voucher_details"}
{literal}
		<script type="text/javascript" src="WEB-INF/includes/js/prototype.js"></script>
		<script type="text/javascript" src="WEB-INF/includes/js/scriptaculous.js?load=effects"></script>
		<script type="text/javascript" src="WEB-INF/includes/js/lightbox.js"></script>
		<link rel="stylesheet" href="WEB-INF/assets/css/lightbox.css" type="text/css" media="screen" />
{/literal}
{/if}

{if $page=="experience"}
{literal}
        <style type="text/css">
            .rightT {margin-top:-576px;}
            .rightT[class] {margin-top:-576px;}
        </style>
{/literal}
{/if}
{if $page=="route"}
{literal}
        <script language="javascript" type="text/javascript">
        function _clearEvent(event) {if(event.preventDefault) {event.preventDefault();event.returnValue = false;} else {window.event.returnValue = false;}}
        function rollUp(item)
        {
            itemId = item.id;
            itemId = itemId.substring(4,itemId.length-2);
        }
        function rollDown(item)
        {
            itemId = item.id;
            itemId = itemId.substring(4,itemId.length-2);
        }
        </script>
{/literal}
{/if}
{if $page=="safety" or $page=="vessels" or $page=="booking"}
{literal}
        <style type="text/css">
            .rightT {margin-top:-534px;}
            .rightT[class] {margin-top:-534px;}
        </style>
{/literal}
{/if}
{if $page=="location"}
{literal}
        <style type="text/css">
            .rightT {margin-top:-663px;}
            .rightT[class] {margin-top:-663px;}
        </style>
{/literal}
{/if}
{if $page=="contact" or $page=="links"}
{literal}
        <style type="text/css">
            .rightT {margin-top:-440px;}
            .rightT[class] {margin-top:-440px;}
        </style>
{/literal}
{/if}
{if $subpage=="_select"}
{literal}
        <script src="WEB-INF/includes/js/lib.js" type="text/javascript"></script>
        <script src="WEB-INF/includes/js/popup.js" type="text/javascript"></script>
        <style type="text/css">
            .rightT {margin-top:-522px;}
            .rightT[class] {margin-top:-522px;}
        </style>
{/literal}
{/if}
        <script language="javascript" src="WEB-INF/includes/js/macromedia.js" type="text/javascript"></script>
{if $subpage=="_step1"}
        <script language="javascript" src="WEB-INF/includes/js/step1-1.js?v=2" type="text/javascript"></script>
{/if}
{if $subpage=="_step2"}
        <script language="javascript" src="WEB-INF/includes/js/step2.js" type="text/javascript"></script>
{/if}
{if $subpage=="_step3"}
        <script language="javascript" src="WEB-INF/includes/js/step3.js" type="text/javascript"></script>
{/if}
{if $subpage=="_step4"}
		<script language="javascript" src="WEB-INF/includes/js/validation.js" type="text/javascript"></script>
        <script language="javascript" src="WEB-INF/includes/js/step4.js" type="text/javascript"></script>
	{literal}
    <script language="javascript" type="text/javascript">
    <!--
    function init_address() {
        define('order_first_name', 'string', 'First Name',3, 50);
        define('order_last_name', 'string', 'Last Name',3, 50);
        define('order_phone', 'string', 'Phone',10);
        define('order_email', 'email', 'Email',6);
    }
    -->
    </script>
    {/literal}
{/if}
{if $subpage=="_step5"}
        <script language="javascript" src="WEB-INF/includes/js/validation.js" type="text/javascript"></script>
        <script language="javascript" src="WEB-INF/includes/js/step5.js" type="text/javascript"></script>
    {literal}
    <script language="javascript" type="text/javascript">
    <!--
    function init_address() {
        define('order_first_name', 'string', 'First Name',3, 50);
        define('order_last_name', 'string', 'Last Name',3, 50);
        define('order_phone', 'string', 'Phone',10);
        define('order_email', 'email', 'Email',6);
    }
    -->
    </script>
    {/literal}
{/if}
{if $subpage=="_step6"}
    <script language="javascript" src="WEB-INF/includes/js/step6.js" type="text/javascript"></script>
{/if}
{if $subpage=="_step8"}
	<!-- STEP 8 - Google Analytics -->
	{if $results.status=="OK"}{literal}
		<script language="javascript" type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-23852518-1']);
		  _gaq.push(['_trackPageview']);
		  _gaq.push(['_addTrans',{/literal}
			'{$ga_trans.order_id}',           // order ID - required
			'{$ga_trans.store_name}',  // affiliation or store name
			'{$ga_trans.total}',          // total - required
			'{$ga_trans.tax}',           // tax
			'{$ga_trans.shipping}',              // shipping
			'{$ga_trans.city}',       // city
			'{$ga_trans.state}',     // state or province
			'{$ga_trans.country}'             // country{literal}
		  ]);

		   // add item might be called for every item in the shopping cart
		   // where your ecommerce engine loops through each item in the cart and
		   // prints out _addItem for each
		    {/literal}
		  {foreach from=$ga_items key=id item=ticket}
		_gaq.push(['_addItem',
				'{$ticket.order_id}',           // order ID - required
				'{$ticket.code}',           // SKU/code - required
				"{$ticket.product}",        // product name
				"{$ticket.variation}",   // category or variation
				"{$ticket.unit_price}",          // unit price - required
				"{$ticket.quantity}"               // quantity - required
			  ]);
		  {/foreach}{literal}
		  _gaq.push(['_trackTrans']); //submits transaction to the Analytics servers

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
		 {/literal}
	{/if}
{/if}
{if $subpage=="_voucher_step1"}
        <script language="javascript" src="WEB-INF/includes/js/validation.js" type="text/javascript"></script>
        <script language="javascript" src="WEB-INF/includes/js/voucher_step1.js" type="text/javascript"></script>
    {literal}
    <script language="javascript" type="text/javascript">
    <!--
    function init_address() {
        define('voucher_order_to', 'string', 'Name of person to receive this Voucher',3, 50);
        define('voucher_order_phone_to', 'string', 'Phone number of receiver',5);
        define('voucher_order_email', 'email', 'Email of sender',6);
        define('voucher_order_name', 'string', 'Name of sender',4);
        define('voucher_order_phone', 'string', 'Telephone of sender',4);
        define('voucher_order_name_to', 'string', 'Name of the person voucher to be posted to',4);
        define('voucher_order_address1_to', 'string', 'Address of where the voucher is to be posted',4);
        define('voucher_order_message', 'string', 'Message from sender', 0, 500);
        //define('voucher_order_address1', 'string', 'Address 1',10);
        //define('voucher_order_postcode', 'string', 'Postcode',4);
    }
    -->
    </script>
    {/literal}
{/if}
{if $subpage=="_voucher_step2"}
        <script language="javascript" src="WEB-INF/includes/js/voucher_step2.js" type="text/javascript"></script>
{/if}

{if $page=="route"}
    <script language="javascript" src="WEB-INF/includes/js/exp_col.js" type="text/javascript"></script>
{/if}


</head>
{strip}
<body {if $subpage=="_step4" || $subpage=="_voucher_step1"}onload="init_address();"{elseif  $page=="location"}onload="load();"{/if}>
{/strip}


<!-- Digital Savannah Facebook re-messaging tags -->
{literal}
    <div id="ttdUniversalPixelTag4a9161caa8c54b588047dde860cf3d9f" style="display:none">
        <script src="https://js.adsrvr.org/up_loader.1.1.0.js" type="text/javascript"></script>
        <script type="text/javascript">
            (function(global) {
                if (typeof TTDUniversalPixelApi === 'function') {
                    var universalPixelApi = new TTDUniversalPixelApi();
                    universalPixelApi.init("0bevose", ["kx216da"], "https://insight.adsrvr.org/track/up", "ttdUniversalPixelTag4a9161caa8c54b588047dde860cf3d9f");
                }
            })(this);
        </script>
    </div>
	{/literal}
<!-- Digital Savannah Facebook re-messaging tags -->


<!-- New booking design -->
{*<div class="main_body">*}
	{*<div class="wrap_about_body">*}
									{*<div class="secondmain_about_main_body">*}
									{*<div class="secondmain_about_body float_left">*}
										{*<div class="lap_2"></div>*}
										{*<div>*}
										{*<div class="secondmain_wrap">*}


{if $subpage == _voucher_step1 or $subpage == _voucher_step2 or $subpage == _voucher_step3 or $subpage == _voucher_step4 }
<section id="voucher">
    {else}
<section id="buy">
    {/if}


    {literal}
    <script type="text/javascript">
        $(document).ready(function(){
//            debugger;
//            $(window.parent.document).find("#modal-1").height($(document).find("html").height());
//            $(window.parent.document).find("#bookingFrame").height($(document).find("html").height())
        })
    </script>
    {/literal}

<!-- End new booking design -->