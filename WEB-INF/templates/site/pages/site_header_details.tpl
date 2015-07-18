<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>{if $content.page_title != ""} {$content.page_title} {else} London RIB Voyages{/if}</title>
{$MycontentpageMeta}
{if $subpage == '_tour_details'}
{$tour.page_meta}
{elseif $subpage == '_package_details'}
{$package.page_meta}
{else}
{$content.page_meta}
{/if}

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
        <script language="javascript" src="WEB-INF/includes/js/step1-1.js" type="text/javascript"></script>
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
	<!-- STEP 8 - Google Analytics code -->
	{if $results.status == 'OK'}
		<script language="javascript" type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-23852518-1']);
		  _gaq.push(['_trackPageview']);
		  _gaq.push(['_addTrans',
			'{$ga_trans.order_id}',           // order ID - required
			'{$ga_trans.store_name}',  // affiliation or store name
			'{$ga_trans.total}',          // total - required
			'{$ga_trans.tax}',           // tax
			'{$ga_trans.shipping}',              // shipping
			'{$ga_trans.city}',       // city
			'{$ga_trans.state}',     // state or province
			'{$ga_trans.country}'             // country
		  ]);

		   // add item might be called for every item in the shopping cart
		   // where your ecommerce engine loops through each item in the cart and
		   // prints out _addItem for each
		  {foreach from=$ga_items key=index item=ticket}
			  _gaq.push(['_addItem',
				'{$ticket.order_id}',           // order ID - required
				'{$ticket.code}',           // SKU/code - required
				'{$ticket.product}',        // product name
				'{$ticket.variation}',   // category or variation
				'{$ticket.unit_price}',          // unit price - required
				'{$ticket.quantity}'               // quantity - required
			  ]);
		  {/foreach}
		  _gaq.push(['_trackTrans']); //submits transaction to the Analytics servers

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
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

<div class="main_body">
	<div class="wrap_about_body">
		<div class="building_main">
		<!--header -->
			<div class="head_amtn">
				<div class="head_leftmain_amt1"><div class="logo style_pointer" onclick="window.location.href='index.php'"><h1  style="display:none;">London RIB Voyages</h1></div>
								<div class="head_img_amt1">
				<div class="the_ori_amt">
				<img src="images/the_original_amt1.jpg" title="Take a Thames Cruise with London Rib Voyages" alt="Take a Thames Cruise with London Rib Voyages" width="552" height="71" />
				</div>
				<div class="book_amt1"><script type="text/javascript">header_new()</script></div>
				
				
				</div>
				</div>
				<div class="header_right_mainmt">
                
					<div class="head_right_amtn1">
					   	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="255" height="158" id="flash2" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="http://www.londonribvoyages.com/flash5.swf?xmlsheet=offers.xml" />
    <param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="http://www.londonribvoyages.com/flash5.swf?xmlsheet=offers.xml" quality="high" bgcolor="#ffffff" width="255" height="158" name="flash2" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
	</object>
                    
                  </div>
                 
				<div class="t_icon_mt"><a href="http://twitter.com/londonrib" title="" target="_blank"><img src="images/t_icon.png" alt="" border="0" /></a></div>
				<div class="f_icon_mt"><a href="http://www.facebook.com/pages/London-United-Kingdom/London-Rib-Voyages/30356303277?ref=ts" title="Find us on Facebook" target="_blank"><img src="images/f_icon.png" alt="" width="36" height="47" border="0" /></a></div>
				
		        	<div class="head_right_mainmt2" style="margin-top:18px;padding-left:1px;text-align:center;display:inline;"><span class="head_right_mainmt2" style="margin-top:18px;padding-left:1px;text-align:center;display:inline;">
		        	  <object width="170" height="140">
		        	    <param name="movie" value="http://www.youtube.com/v/tuSpy8mIIrU&color1=0xb1b1b1&color2=0xcfcfcf&hl=en_US&feature=player_embedded&fs=1" />
		        	    <param name="allowFullScreen" value="true" />
		        	    <param name="allowScriptAccess" value="always" />
		        	    <embed src="http://www.youtube.com/v/tuSpy8mIIrU&color1=0xb1b1b1&color2=0xcfcfcf&hl=en_US&feature=player_embedded&fs=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="170" height="140"></embed>
	        	    </object>
		        	</span></div>
			  </div>	</div>
			  </div>
					
		<!--header -->
		</div>
									<div class="secondmain_about_main_body">
									<div class="secondmain_about_body float_left">
										<div class="lap_2"></div>
										<div>
										<div class="secondmain_wrap">
											<div class="navmain_body" >
											<!--Nav -->
												<div class="menu_top">
													<ul>
														<li ><a href="index.php" title="Home" class="{if $page!=index} home_nvisited {else} home_visited {/if}">Home</a></li>
														<li><a href="about_us.php" title="About Us" class="{if  $page == 'about_us' || $page == 'about_us_people_say' || $page == 'about_us_guides' || $page == 'about_us_videos' || $page == 'about_us_our_boat' || $page == 'about_us_guides_matt1' || $page == 'about_us_guides_matt2' || $page == 'about_us_guides_dave' || $page == 'about_us_guides_ben' || $page == 'about_us_guides_nick' || $page == 'route'} about_us1_visited {else} about_us1 {/if}">About Us</a></li>
														<li><a href="booking.php?subpage=tours" title="Our Boat Trips" {if  $subpage == '_select' || $subpage == '_tours'  || $subpage == '_tour_details' || $subpage == '_charter' || $subpage == '_voucher_details' || $subpage == '_package_details'} class="ourboat_trip_visited" {else} class="ourboat_trip" {/if}>Our Boat Trips</a></li>
														<li><a href="who_is_this_for.php" title="Who is this for?" class=" {if  $page == 'who_is_this_for' || $page == 'stag_and_hen' || $page == 'individuals_couples_friends' || $page == 'families' || $page == 'corporate_groups'} Who_is_this_visited {else} Who_is_this {/if}"> Who is this for?</a></li>
														<li><a href="how_book.php" title="How to book" class="{if $page == 'how_book'} how_to_book_visited {else}how_to_book{/if}"> How to book</a></li>
														<li><a href="safety.php" title=" Safety" class="{if $page=='safety'}safety_visited {else}safety{/if}"> Safety</a></li>
														<li><a href="location.php" title="Our Location" class="{if $page=='location'} vessel_visited {else}vessel{/if}"> Our Location</a></li>
														<li><a href="/blog/" title="Latest News" class="{if $page == 'blog'}blog_visited {else}blog{/if}"> Latest News</a></li>
														<li><a href="media_center.php" title="Media Centre" class="{if $page=='media_center' ||	$page == 'press_release' ||	$page == 'in_the_news' || $page == 'links'} media_center_visited {else}media_center{/if}"> Media Centre</a></li>
														<li><a href="contact.php" title="Contact Us" class="{if $page == 'contact'} media_center_visited {else}media_center{/if}"> Contact Us</a></li>
													</ul>
												</div>
											<!--Nav -->
					{if 
						$page == "about_us" 
					|| $page == "about_us_people_say" 
					|| $page == 'about_us_guides'
					|| $page == 'about_us_videos' 
					|| $page == "about_us_our_boat"
					|| $page == 'about_us_guides_matt1' 
					|| $page == 'about_us_guides_matt2' 
					|| $page == 'about_us_guides_dave' 
					|| $page == 'about_us_guides_ben' 
					|| $page == 'about_us_guides_nick'
					|| $page == 'route'
					}
					
					<div class="menu_bottom_about">
					<a href="about_us_people_say.php" class="{if $page == 'about_us_people_say'} about_link_1a {else} about_link_1 {/if}" title="What people say about us">What people say about us</a>&nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;<a href="about_us_guides.php" class="{if $page == 'about_us_guides' || $page == 'about_us_guides_matt1' || $page == 'about_us_guides_matt2' || $page == 'about_us_guides_dave' || $page == 'about_us_guides_ben' || $page == 'about_us_guides_nick'} about_link_1a {else}about_link_1{/if}" title="Meet Our Guidess">Meet Our Guides</a>&nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;<a href="about_us_videos.php" class="{if $page == 'about_us_videos'} about_link_1a {else} about_link_1 {/if}" title="Our Videos">Our Videos</a>&nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;<a href="about_us_our_boat.php" class="{if $page == 'about_us_our_boat'} about_link_1a {else}about_link_1{/if}" title="Our Boat">Our Boat</a>&nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;<a href="route.php" class="{if $page == 'route'} about_link_1a {else}about_link_1{/if}" title="Our Route">Our Route</a>		
					</div>
					{elseif 
					   $page == "who_is_this_for" 
					|| $page == "stag_and_hen" 
					|| $page == "individuals_couples_friends" 
					|| $page == "families" 
					|| $page == 'corporate_groups'
					}
					
					<div class="Who_this_menu_bottom">
					<a href="individuals_couples_friends.php" class="{if $page == 'individuals_couples_friends'} about_link_1a {else}about_link_1{/if}" title="Individuals, Couples and Friends">Individuals, Couples and Friends</a>&nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;<a href="families.php" class="{if $page == 'families'} about_link_1a {else}about_link_1{/if}" title="Families">Families </a>&nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;     
					<a href="stag_and_hen.php" class="{if $page == 'stag_and_hen'} about_link_1a {else} about_link_1{/if}" title="Stag and Hen Group">Stag and Hen Group</a> &nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;	
					<a href="corporate_groups.php" class="{if $page == 'corporate_groups'} about_link_1a {else}about_link_1{/if}" title="Corporate Groups"> Corporate Groups</a>											
					</div>
					
					{elseif 
						$subpage=="_tours"  
					||  $subpage == '_charter'
					||  $subpage == '_voucher_details'
					||  $subpage == '_package_details'
					}

					
						<div style="width:775px; height:22px; margin:0; padding:0 0 0 195px; background:url(images/orange_line.jpg) 0 no-repeat;">
					{section name=k loop=4 start=0}
					{if $Tour_Trip[k].tour_home_name1 ne ""}		
					<a href="booking.php?tour_id={$Tour_Trip[k].tour_id}&amp;subpage=tour_details" class="{if $Tour_Trip[k].tour_id == $smarty.get.tour_id} about_link_1a {else}about_link_1{/if}" title="{$Tour_Trip[k].tour_home_name1}">{$Tour_Trip[k].tour_home_name1}</a>&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;
					{/if}
					{/section}
					<a href="booking.php?subpage=charter" class="{if $subpage=='_charter' ||  $subpage == '_package_details'} about_link_1a {else}about_link_1{/if}" title="Charters">Charters</a>
					</div>	
					
					{elseif  
						$subpage == '_tour_details'
					}
					<div style="width:775px; height:22px; margin:0; padding:0 0 0 195px; background:url(images/orange_line.jpg) 0 no-repeat;">
					{section name=k loop=4 start=0}
					<a href="booking.php?tour_id={$Tour_Trip[k].tour_id}&amp;subpage=tour_details" class="{if $Tour_Trip[k].tour_id == $smarty.get.tour_id} about_link_1a {else}about_link_1{/if}" title="{$Tour_Trip[k].tour_home_name1}">{$Tour_Trip[k].tour_home_name1}</a>&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;
					{/section}
					<a href="booking.php?subpage=charter" class="{if $subpage=='_charter'} about_link_1a {else}about_link_1{/if}" title="Charters">Charters</a>
					</div>
					
					{elseif 
						$page == 'media_center'
					||	$page == 'press_office'
					||	$page == 'press_release'
					||	$page == 'in_the_news'	
					||  $page == 'links'					}
					<div style="width:325px; height:22px; margin:0; padding:0 0 0 650px; background:url(images/orange_line.jpg) 0 no-repeat;">
					<a href="press_release.php" class="{if $page == 'press_release'} about_link_1a {else}about_link_1{/if}" title="Press Releases">Press Releases </a>&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;   
					<a href="in_the_news.php" class="{if $page == 'in_the_news'} about_link_1a {else} about_link_1{/if}" title="In the News">In the News</a>&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;   
					<a href="links.php" class="{if $page == 'links'} about_link_1a {else} about_link_1{/if}" title="Links">Links</a>
					</div>
					
					{else}	<div class="menu_bottom">&nbsp;</div>{/if}
					</div>
