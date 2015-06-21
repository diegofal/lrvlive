<?php /* Smarty version 2.6.25, created on 2015-06-21 02:32:27
         compiled from utils/site_booking_header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

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
        <script language="javascript" src="WEB-INF/includes/js/step1-1.js?v=2" type="text/javascript"></script>
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


<!-- New booking design -->
																																																	

<section id="buy">
    <div class="breadcrum-step">
        <a href="#" class="selected">1. Trip type and seats</a>
        <a href="#">2. Date and time</a>
        <a href="#">3. Personal info</a>
        <a href="#">4. Confirmation</a>
    </div>


<!-- End new booking design -->