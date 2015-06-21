<?php /* Smarty version 2.6.25, created on 2015-06-13 14:32:47
         compiled from utils/site_header_details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php if ($this->_tpl_vars['content']['page_title'] != ""): ?> <?php echo $this->_tpl_vars['content']['page_title']; ?>
 <?php else: ?> London RIB Voyages<?php endif; ?></title>
<?php echo $this->_tpl_vars['MycontentpageMeta']; ?>

<?php if ($this->_tpl_vars['subpage'] == '_tour_details'): ?>
<?php echo $this->_tpl_vars['tour']['page_meta']; ?>

<?php elseif ($this->_tpl_vars['subpage'] == '_package_details'): ?>
<?php echo $this->_tpl_vars['package']['page_meta']; ?>

<?php else: ?>
<?php echo $this->_tpl_vars['content']['page_meta']; ?>

<?php endif; ?>
<link href="WEB-INF/assets/css/slider.css" rel="stylesheet" type="text/css" />
<link href="WEB-INF/assets/css/style.css" rel="stylesheet" type="text/css" />
<?php if ($this->_tpl_vars['page'] == 'location'): ?>
<?php echo '
 <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAk_PeATHc7Zk4v935p5iMORQyasHvbimZ52QT_h2fTtA71RTODRQ4xDTS8sZxMt0yUhjUPYWjkGCeew" type="text/javascript"></script>
<script type="text/javascript">
    //<![CDATA[
		var WINDOW_HTML = \'<div style="width: 210px; padding-right: 10px">London Rib Voyages 39 York Rd Lambeth, Greater London SE1 7, UK</div>\';		

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
'; ?>
 
<?php endif; ?>
<?php echo '
<script type="text/javascript" src="WEB-INF/includes/js/main.js"></script>
<script type="text/javascript" src="WEB-INF/includes/js/pngfix.js"></script>
<script type="text/javascript" src="WEB-INF/includes/js/flash.js"></script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'UA-23852518-1\']);
  _gaq.push([\'_trackPageview\']);

 (function() {
   var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
'; ?>

<?php if ($this->_tpl_vars['page'] == 'route'): ?>
<?php echo '
        <script language="javascript" type="text/javascript">
        function hidediv() {
            if (document.getElementById) { // DOM3 = IE5, NS6
                document.getElementById(\'hideshow\').style.visibility = \'hidden\';
            }
            else {
                if (document.layers) { // Netscape 4
                    document.hideshow.visibility = \'hidden\';
                }
                else { // IE 4
                    document.all.hideshow.style.visibility = \'hidden\';
                }
            }
        }
        function _absLeft(obj) { return (obj.offsetParent)? obj.offsetLeft+_absLeft(obj.offsetParent) : obj.offsetLeft; }
        function _absTop(obj) { return (obj.offsetParent)? obj.offsetTop+_absTop(obj.offsetParent) : obj.offsetTop; }
        function showdiv(item) {
            itemId = item.id;
            itemId = itemId.substring(4,itemId.length-2);

            parentE = document.getElementById(\'pd\'+itemId);
			
            //parentE = item.parentNode.parentNode;

            closeButton = document.createElement(\'a\');
            closeButton.setAttribute(\'href\',\'javascript:hidediv()\');
            '; ?>

            closeButton.innerHTML = '<img src="http://<?php echo $this->_supers['server']['SERVER_NAME']; ?>
/img/css/bclose.gif" width="13" height="13" alt="Close" title="Close" style="position:absolute;" border="0" />';
            <?php echo '

            nTable 	= document.createElement(\'table\');
            nBody 	= document.createElement(\'tbody\');
            nTr 	= document.createElement(\'tr\');

            //itemNumber = parentE.firstChild.firstChild;
			itemNumber = document.getElementById("pv"+itemId);
			//itemName = itemNumber.parentNode.nextSibling.firstChild;
			itemName = document.getElementById("pn"+itemId);
            //itemText = parentE.lastChild;
			itemText   = document.getElementById("Text"+itemId)
			
			//alert(itemText);
			//return false;

            itemTextContent = itemText.innerHTML;


            nTd1 = document.createElement(\'td\');
            nTd2 = document.createElement(\'td\');
			nTd1.setAttribute(\'class\',\'style_vertical\');
			nTd2.setAttribute(\'class\',\'style_vertical\');

            nTd1.innerHTML = \'<span class="style_heading_text">\'+itemNumber.innerHTML+\'.&nbsp;\'+itemName.innerHTML+\'</span><br /><span class="style_normal_text">\'+itemTextContent+\'</span>\';
            '; ?>

            nTd2.innerHTML = '<img src="http://<?php echo $this->_supers['server']['SERVER_NAME']; ?>
/img/route/'+itemId+'.jpg" width="119" height="138" alt="'+itemName.innerHTML+'" title="'+itemName.innerHTML+'" />';
            <?php echo '
			
            nTr.appendChild(nTd1);
            nTr.appendChild(nTd2);

            nBody.appendChild(nTr);

            detty = document.createElement(\'div\');
            detty.setAttribute(\'class\',\'detty\');

            nTable.appendChild(nBody);
            detty.appendChild(nTable);

            dettop = document.createElement(\'div\');
            dettop.setAttribute(\'class\',\'dettop\');
			

            if (document.getElementById) { // DOM3 = IE5, NS6
                element = document.getElementById(\'anchor\');
                deltaX = _absLeft(element)+155;
                deltaY = _absTop(element)-150;

                if(document.getElementById(\'hideshow\').hasChildNodes()){document.getElementById(\'hideshow\').removeChild(document.getElementById(\'hideshow\').firstChild);document.getElementById(\'hideshow\').removeChild(document.getElementById(\'hideshow\').firstChild);}
                '; ?>

                document.getElementById('hideshow').innerHTML = '<div class="dettop"><a href="javascript:hidediv()"><img src="http://<?php echo $this->_supers['server']['SERVER_NAME']; ?>
/img/css/bclose.gif" alt="Close" title="Close" style="position: absolute;margin:27px 0px 0px 412px;" height="13" width="13" border="0"></a></div><div class="detty" id="detty"></div><div class="detbot"></div>';
                <?php echo '
                //document.getElementById(\'hideshow\').appendChild(closeButton);
                document.getElementById(\'detty\').appendChild(nTable);
                document.getElementById(\'hideshow\').style.left = deltaX+\'px\';
                document.getElementById(\'hideshow\').style.top = deltaY+\'px\';
                document.getElementById(\'hideshow\').style.visibility = \'visible\';
            }
            else {
                if (document.layers) { // Netscape 4
                    document.hideshow.visibility = \'visible\';
                }
                else { // IE 4
                    document.all.hideshow.style.visibility = \'visible\';
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
'; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['subpage'] == '_tour_details' || $this->_tpl_vars['subpage'] == '_package_details' || $this->_tpl_vars['subpage'] == '_voucher_details'): ?>
<?php echo '
		<script type="text/javascript" src="WEB-INF/includes/js/prototype.js"></script>
		<script type="text/javascript" src="WEB-INF/includes/js/scriptaculous.js?load=effects"></script>
		<script type="text/javascript" src="WEB-INF/includes/js/lightbox.js"></script>
		<link rel="stylesheet" href="WEB-INF/assets/css/lightbox.css" type="text/css" media="screen" />
'; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'experience'): ?>
<?php echo '
        <style type="text/css">
            .rightT {margin-top:-576px;}
            .rightT[class] {margin-top:-576px;}
        </style>
'; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['page'] == 'route'): ?>
<?php echo '
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
'; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['page'] == 'safety' || $this->_tpl_vars['page'] == 'vessels' || $this->_tpl_vars['page'] == 'booking'): ?>
<?php echo '
        <style type="text/css">
            .rightT {margin-top:-534px;}
            .rightT[class] {margin-top:-534px;}
        </style>
'; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['page'] == 'location'): ?>
<?php echo '
        <style type="text/css">
            .rightT {margin-top:-663px;}
            .rightT[class] {margin-top:-663px;}
        </style>
'; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['page'] == 'contact' || $this->_tpl_vars['page'] == 'links'): ?>
<?php echo '
        <style type="text/css">
            .rightT {margin-top:-440px;}
            .rightT[class] {margin-top:-440px;}
        </style>
'; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['subpage'] == '_select'): ?>
<?php echo '
        <script src="WEB-INF/includes/js/lib.js" type="text/javascript"></script>
        <script src="WEB-INF/includes/js/popup.js" type="text/javascript"></script>
        <style type="text/css">
            .rightT {margin-top:-522px;}
            .rightT[class] {margin-top:-522px;}
        </style>
'; ?>

<?php endif; ?>
        <script language="javascript" src="WEB-INF/includes/js/macromedia.js" type="text/javascript"></script>
<?php if ($this->_tpl_vars['subpage'] == '_step1'): ?>
        <script language="javascript" src="WEB-INF/includes/js/step1-1.js" type="text/javascript"></script>
<?php endif; ?>
<?php if ($this->_tpl_vars['subpage'] == '_step2'): ?>
        <script language="javascript" src="WEB-INF/includes/js/step2.js" type="text/javascript"></script>
<?php endif; ?>
<?php if ($this->_tpl_vars['subpage'] == '_step3'): ?>
        <script language="javascript" src="WEB-INF/includes/js/step3.js" type="text/javascript"></script>
<?php endif; ?>
<?php if ($this->_tpl_vars['subpage'] == '_step4'): ?>
		<script language="javascript" src="WEB-INF/includes/js/validation.js" type="text/javascript"></script>  
        <script language="javascript" src="WEB-INF/includes/js/step4.js" type="text/javascript"></script>
	<?php echo '
    <script language="javascript" type="text/javascript">
    <!--
    function init_address() {
        define(\'order_first_name\', \'string\', \'First Name\',3, 50);
        define(\'order_last_name\', \'string\', \'Last Name\',3, 50);
        define(\'order_phone\', \'string\', \'Phone\',10);
        define(\'order_email\', \'email\', \'Email\',6);
    }
    -->
    </script>
    '; ?>
  
<?php endif; ?>
<?php if ($this->_tpl_vars['subpage'] == '_step5'): ?>
        <script language="javascript" src="WEB-INF/includes/js/validation.js" type="text/javascript"></script>  
        <script language="javascript" src="WEB-INF/includes/js/step5.js" type="text/javascript"></script>
    <?php echo '
    <script language="javascript" type="text/javascript">
    <!--
    function init_address() {
        define(\'order_first_name\', \'string\', \'First Name\',3, 50);
        define(\'order_last_name\', \'string\', \'Last Name\',3, 50);
        define(\'order_phone\', \'string\', \'Phone\',10);
        define(\'order_email\', \'email\', \'Email\',6);
    }
    -->
    </script>
    '; ?>
  
<?php endif; ?>
<?php if ($this->_tpl_vars['subpage'] == '_step6'): ?>
    <script language="javascript" src="WEB-INF/includes/js/step6.js" type="text/javascript"></script>
<?php endif; ?>
<?php if ($this->_tpl_vars['subpage'] == '_step8'): ?>
	<!-- STEP 8 - Google Analytics -->
	<?php if ($this->_tpl_vars['results']['status'] == 'OK'): ?><?php echo '		 
		<script language="javascript" type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push([\'_setAccount\', \'UA-23852518-1\']);
		  _gaq.push([\'_trackPageview\']);
		  _gaq.push([\'_addTrans\','; ?>

			'<?php echo $this->_tpl_vars['ga_trans']['order_id']; ?>
',           // order ID - required
			'<?php echo $this->_tpl_vars['ga_trans']['store_name']; ?>
',  // affiliation or store name
			'<?php echo $this->_tpl_vars['ga_trans']['total']; ?>
',          // total - required
			'<?php echo $this->_tpl_vars['ga_trans']['tax']; ?>
',           // tax
			'<?php echo $this->_tpl_vars['ga_trans']['shipping']; ?>
',              // shipping
			'<?php echo $this->_tpl_vars['ga_trans']['city']; ?>
',       // city
			'<?php echo $this->_tpl_vars['ga_trans']['state']; ?>
',     // state or province
			'<?php echo $this->_tpl_vars['ga_trans']['country']; ?>
'             // country<?php echo '			 
		  ]);

		   // add item might be called for every item in the shopping cart
		   // where your ecommerce engine loops through each item in the cart and
		   // prints out _addItem for each
		    '; ?>

		  <?php $_from = $this->_tpl_vars['ga_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['ticket']):
?>
		_gaq.push(['_addItem',
				'<?php echo $this->_tpl_vars['ticket']['order_id']; ?>
',           // order ID - required
				'<?php echo $this->_tpl_vars['ticket']['code']; ?>
',           // SKU/code - required
				"<?php echo $this->_tpl_vars['ticket']['product']; ?>
",        // product name
				"<?php echo $this->_tpl_vars['ticket']['variation']; ?>
",   // category or variation
				"<?php echo $this->_tpl_vars['ticket']['unit_price']; ?>
",          // unit price - required
				"<?php echo $this->_tpl_vars['ticket']['quantity']; ?>
"               // quantity - required
			  ]);
		  <?php endforeach; endif; unset($_from); ?><?php echo '		   
		  _gaq.push([\'_trackTrans\']); //submits transaction to the Analytics servers

		  (function() {
			var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
			ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
			var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
		 '; ?>

	<?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['subpage'] == '_voucher_step1'): ?>
        <script language="javascript" src="WEB-INF/includes/js/validation.js" type="text/javascript"></script>  
        <script language="javascript" src="WEB-INF/includes/js/voucher_step1.js" type="text/javascript"></script>
    <?php echo '
    <script language="javascript" type="text/javascript">
    <!--
    function init_address() {
        define(\'voucher_order_to\', \'string\', \'Name of person to receive this Voucher\',3, 50);
        define(\'voucher_order_phone_to\', \'string\', \'Phone number of receiver\',5);
        define(\'voucher_order_email\', \'email\', \'Email of sender\',6);
        define(\'voucher_order_name\', \'string\', \'Name of sender\',4);
        define(\'voucher_order_phone\', \'string\', \'Telephone of sender\',4);
        define(\'voucher_order_name_to\', \'string\', \'Name of the person voucher to be posted to\',4);
        define(\'voucher_order_address1_to\', \'string\', \'Address of where the voucher is to be posted\',4);
        define(\'voucher_order_message\', \'string\', \'Message from sender\', 0, 500);
        //define(\'voucher_order_address1\', \'string\', \'Address 1\',10);
        //define(\'voucher_order_postcode\', \'string\', \'Postcode\',4);
    }
    -->
    </script>
    '; ?>
  
<?php endif; ?>
<?php if ($this->_tpl_vars['subpage'] == '_voucher_step2'): ?>
        <script language="javascript" src="WEB-INF/includes/js/voucher_step2.js" type="text/javascript"></script>
<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'route'): ?>
    <script language="javascript" src="WEB-INF/includes/js/exp_col.js" type="text/javascript"></script>
<?php endif; ?>

	
</head>
<?php echo '<body '; ?><?php if ($this->_tpl_vars['subpage'] == '_step4' || $this->_tpl_vars['subpage'] == '_voucher_step1'): ?><?php echo 'onload="init_address();"'; ?><?php elseif ($this->_tpl_vars['page'] == 'location'): ?><?php echo 'onload="load();"'; ?><?php endif; ?><?php echo '>'; ?>


<!-- Digital Savannah Facebook re-messaging tags -->
<?php echo ' 
    <div id="ttdUniversalPixelTag4a9161caa8c54b588047dde860cf3d9f" style="display:none">
        <script src="https://js.adsrvr.org/up_loader.1.1.0.js" type="text/javascript"></script>
        <script type="text/javascript">
            (function(global) {
                if (typeof TTDUniversalPixelApi === \'function\') {
                    var universalPixelApi = new TTDUniversalPixelApi();
                    universalPixelApi.init("0bevose", ["kx216da"], "https://insight.adsrvr.org/track/up", "ttdUniversalPixelTag4a9161caa8c54b588047dde860cf3d9f");
                }
            })(this);
        </script>
    </div>
	'; ?>
 
<!-- Digital Savannah Facebook re-messaging tags -->

<div class="main_body">
	<div class="wrap_body_pat1">
		<div class="building_main">
		
		<!-- slider -->
		 <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <img src="images/header-slide-1.jpg" data-thumb="images/header-slide-1.jpg" alt="" />
                <img src="images/header-slide-2.jpg" data-thumb="images/header-slide-2.jpg" alt="" />			
			</div>
			<div class="home-slide-book-button">
				<a href="/booking.php?subpage=tours" title="book now"><img src="images/book-now-1-home-slide.png" data-thumb="images/header-slide-2.jpg" height="92" width="404" alt="" /></a>
			</div>
        </div>
		<!-- end slider -->

		</div>
									<div class="secondmain_about_main_body">
									<div class="secondmain_about_body float_left">
										<!--div class="lap_2"></div-->
										<div>
										<div class="secondmain_wrap">
											<div class="navmain_body">
											<!--Nav -->
												<div class="menu_top<?php if ($this->_tpl_vars['page'] == index): ?> homenav <?php elseif ($this->_tpl_vars['page'] == contact): ?> contactnav <?php elseif ($this->_tpl_vars['page'] == safety): ?> safetynav <?php elseif ($this->_tpl_vars['page'] == location): ?> locationnav <?php endif; ?>">
													<ul>
														<li><a href="index.php" title="Home" class="home <?php if ($this->_tpl_vars['page'] != index): ?> home_visited <?php else: ?> selected <?php endif; ?>">Home</a></li>
														<li><a href="about_us.php" title="About Us" class="about_us1 <?php if ($this->_tpl_vars['page'] == 'about_us' || $this->_tpl_vars['page'] == 'about_us_people_say' || $this->_tpl_vars['page'] == 'about_us_guides' || $this->_tpl_vars['page'] == 'about_us_videos' || $this->_tpl_vars['page'] == 'about_us_our_boat' || $this->_tpl_vars['page'] == 'about_us_guides_matt1' || $this->_tpl_vars['page'] == 'about_us_guides_matt2' || $this->_tpl_vars['page'] == 'about_us_guides_dave' || $this->_tpl_vars['page'] == 'about_us_guides_ben' || $this->_tpl_vars['page'] == 'about_us_guides_nick' || $this->_tpl_vars['page'] == 'route'): ?> selected <?php endif; ?>">About Us</a></li>
														<li><a href="booking.php?subpage=tours" title="Our Boat Trips" <?php if ($this->_tpl_vars['subpage'] == '_select' || $this->_tpl_vars['subpage'] == '_tours' || $this->_tpl_vars['subpage'] == '_tour_details' || $this->_tpl_vars['subpage'] == '_charter' || $this->_tpl_vars['subpage'] == '_voucher_details' || $this->_tpl_vars['subpage'] == '_package_details'): ?> class="ourboat_trip selected" <?php else: ?> class="ourboat_trip" <?php endif; ?>>Our Boat Trips</a></li>
														<li><a href="who_is_this_for.php" title="Who is this for?" class="Who_is_this<?php if ($this->_tpl_vars['page'] == 'who_is_this_for' || $this->_tpl_vars['page'] == 'stag_and_hen' || $this->_tpl_vars['page'] == 'individuals_couples_friends' || $this->_tpl_vars['page'] == 'families' || $this->_tpl_vars['page'] == 'corporate_groups'): ?> selected <?php endif; ?>"> Who is this for?</a></li>
														<li><a href="safety.php" title=" Safety" class="safety <?php if ($this->_tpl_vars['page'] == 'safety'): ?>selected<?php endif; ?>"> Safety</a></li>
														<li><a href="location.php" title="Our Location" class="vessel <?php if ($this->_tpl_vars['page'] == 'location'): ?>selected<?php endif; ?>"> Our Location</a></li>
														<li><a href="about_us_people_say.php" title="Testimonials" class="testimonials <?php if ($this->_tpl_vars['page'] == 'blog'): ?>selected<?php endif; ?>">Testimonials</a></li>
						                                <li><a href="http://londonribvoyages.wordpress.com" title="Blog" class="blog">Blog</a></li>
                                                        <!--li><a href="filming.php" title="Filming" class="<?php if ($this->_tpl_vars['page'] == 'filming'): ?>selected <?php else: ?>safety<?php endif; ?>">Filming</a></li-->
														<li class="contact"><a href="contact.php" title="Contact Us" class="contact <?php if ($this->_tpl_vars['page'] == 'contact'): ?> selected <?php endif; ?>"> Contact Us</a></li>
													</ul>
												</div>
											<!--Nav -->
					<?php if ($this->_tpl_vars['page'] == 'about_us' || $this->_tpl_vars['page'] == 'about_us_people_say' || $this->_tpl_vars['page'] == 'about_us_guides' || $this->_tpl_vars['page'] == 'about_us_videos' || $this->_tpl_vars['page'] == 'about_us_our_boat' || $this->_tpl_vars['page'] == 'about_us_guides_matt1' || $this->_tpl_vars['page'] == 'about_us_guides_matt2' || $this->_tpl_vars['page'] == 'about_us_guides_dave' || $this->_tpl_vars['page'] == 'about_us_guides_ben' || $this->_tpl_vars['page'] == 'about_us_guides_nick' || $this->_tpl_vars['page'] == 'route'): ?>
					
					<div class="menu_bottom">
					<a href="about_us_people_say.php" class="<?php if ($this->_tpl_vars['page'] == 'about_us_people_say'): ?> about_link_1a <?php else: ?> about_link_1 <?php endif; ?>" title="Testimonials">Testimonials</a>&nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;<a href="about_us_guides.php" class="<?php if ($this->_tpl_vars['page'] == 'about_us_guides' || $this->_tpl_vars['page'] == 'about_us_guides_matt1' || $this->_tpl_vars['page'] == 'about_us_guides_matt2' || $this->_tpl_vars['page'] == 'about_us_guides_dave' || $this->_tpl_vars['page'] == 'about_us_guides_ben' || $this->_tpl_vars['page'] == 'about_us_guides_nick'): ?> about_link_1a <?php else: ?>about_link_1<?php endif; ?>" title="Meet Our Guidess">Meet Our Guides</a>&nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;<a href="https://www.youtube.com/channel/UC_78eKTUZPWQv7Yhb6jIJVA" target="_blank" class="<?php if ($this->_tpl_vars['page'] == 'about_us_videos'): ?> about_link_1a <?php else: ?> about_link_1 <?php endif; ?>" title="Our Videos">Our Videos</a>&nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;<a href="about_us_our_boat.php" target="_blank" class="<?php if ($this->_tpl_vars['page'] == 'about_us_our_boat'): ?> about_link_1a <?php else: ?>about_link_1<?php endif; ?>" title="Our Boat">Our Boat</a>&nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;<a href="route.php" class="<?php if ($this->_tpl_vars['page'] == 'route'): ?> about_link_1a <?php else: ?>about_link_1<?php endif; ?>" title="Our Route">Our Route</a>		
					</div>
					<?php elseif ($this->_tpl_vars['page'] == 'who_is_this_for' || $this->_tpl_vars['page'] == 'stag_and_hen' || $this->_tpl_vars['page'] == 'individuals_couples_friends' || $this->_tpl_vars['page'] == 'families' || $this->_tpl_vars['page'] == 'corporate_groups'): ?>
					
					<div class="menu_bottom">
					<a href="individuals_couples_friends.php" class="<?php if ($this->_tpl_vars['page'] == 'individuals_couples_friends'): ?> about_link_1a <?php else: ?>about_link_1<?php endif; ?>" title="Individuals, Couples and Friends">Individuals, Couples and Friends</a>&nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;<a href="families.php" class="<?php if ($this->_tpl_vars['page'] == 'families'): ?> about_link_1a <?php else: ?>about_link_1<?php endif; ?>" title="Families">Families </a>&nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;     
					<a href="stag_and_hen.php" class="<?php if ($this->_tpl_vars['page'] == 'stag_and_hen'): ?> about_link_1a <?php else: ?> about_link_1<?php endif; ?>" title="Stag and Hen Group">Stag and Hen Group</a> &nbsp;&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;&nbsp;	
					<a href="corporate_groups.php" class="<?php if ($this->_tpl_vars['page'] == 'corporate_groups'): ?> about_link_1a <?php else: ?>about_link_1<?php endif; ?>" title="Corporate Groups"> Corporate Groups</a>											
					</div>
					
					<?php elseif ($this->_tpl_vars['subpage'] == '_tours' || $this->_tpl_vars['subpage'] == '_charter' || $this->_tpl_vars['subpage'] == '_voucher_details' || $this->_tpl_vars['subpage'] == '_package_details'): ?>

					
						<div class="menu_bottom">
					<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['start'] = (int)0;
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
if ($this->_sections['k']['start'] < 0)
    $this->_sections['k']['start'] = max($this->_sections['k']['step'] > 0 ? 0 : -1, $this->_sections['k']['loop'] + $this->_sections['k']['start']);
else
    $this->_sections['k']['start'] = min($this->_sections['k']['start'], $this->_sections['k']['step'] > 0 ? $this->_sections['k']['loop'] : $this->_sections['k']['loop']-1);
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = min(ceil(($this->_sections['k']['step'] > 0 ? $this->_sections['k']['loop'] - $this->_sections['k']['start'] : $this->_sections['k']['start']+1)/abs($this->_sections['k']['step'])), $this->_sections['k']['max']);
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
					<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1'] != ""): ?>	
					<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1'] != "Sunset Speed-boating"): ?>
					<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1'] != 'Tower Refresher (@St Kats)'): ?>	
					<a href="booking.php?tour_id=<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_id']; ?>
&amp;subpage=tour_details" class="<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_id'] == $this->_supers['get']['tour_id']): ?> about_link_1a <?php else: ?>about_link_1<?php endif; ?>" title="<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1']; ?>
"><?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1']; ?>
</a>&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;
					<?php endif; ?>
					<?php endif; ?>
					<?php endif; ?>
					<?php endfor; endif; ?>
					<a href="booking.php?subpage=charter" class="<?php if ($this->_tpl_vars['subpage'] == '_charter' || $this->_tpl_vars['subpage'] == '_package_details'): ?> about_link_1a <?php else: ?>about_link_1<?php endif; ?>" title="Charters">Charters</a>
					</div>	
					
					<?php elseif ($this->_tpl_vars['subpage'] == '_tour_details'): ?>
					<div class="menu_bottom">		
					<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['start'] = (int)0;
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
if ($this->_sections['k']['start'] < 0)
    $this->_sections['k']['start'] = max($this->_sections['k']['step'] > 0 ? 0 : -1, $this->_sections['k']['loop'] + $this->_sections['k']['start']);
else
    $this->_sections['k']['start'] = min($this->_sections['k']['start'], $this->_sections['k']['step'] > 0 ? $this->_sections['k']['loop'] : $this->_sections['k']['loop']-1);
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = min(ceil(($this->_sections['k']['step'] > 0 ? $this->_sections['k']['loop'] - $this->_sections['k']['start'] : $this->_sections['k']['start']+1)/abs($this->_sections['k']['step'])), $this->_sections['k']['max']);
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
					<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1'] != ''): ?>	
					<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1'] != "Sunset Speed-boating"): ?>
					<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1'] != 'Tower Refresher (@St Kats)'): ?>		
					<a href="booking.php?tour_id=<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_id']; ?>
&amp;subpage=tour_details" class="<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_id'] == $this->_supers['get']['tour_id']): ?> about_link_1a <?php else: ?>about_link_1<?php endif; ?>" title="<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1']; ?>
"><?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1']; ?>
</a>&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;
					<?php endif; ?>
					<?php endif; ?>
					<?php endif; ?>
                    <?php endfor; endif; ?>
                   
					<a href="booking.php?subpage=charter" class="<?php if ($this->_tpl_vars['subpage'] == '_charter'): ?> about_link_1a <?php else: ?>about_link_1<?php endif; ?>" title="Charters">Charters</a>
					</div>
					
					<?php elseif ($this->_tpl_vars['page'] == 'media_center' || $this->_tpl_vars['page'] == 'press_office' || $this->_tpl_vars['page'] == 'press_release' || $this->_tpl_vars['page'] == 'links'): ?>
					<div class="menu_bottom">
					<a href="press_release.php" class="<?php if ($this->_tpl_vars['page'] == 'press_release'): ?> about_link_1a <?php else: ?>about_link_1<?php endif; ?>" title="Press Releases">Press Releases </a>&nbsp;<span style="color:#FFFFFF;"><strong>|</strong></span>&nbsp;   
					  
					<a href="links.php" class="<?php if ($this->_tpl_vars['page'] == 'links'): ?> about_link_1a <?php else: ?> about_link_1<?php endif; ?>" title="Links">Links</a>
					</div>
					
					<?php else: ?>	<!--div class="menu_bottom">&nbsp;</div--><?php endif; ?>
					</div>