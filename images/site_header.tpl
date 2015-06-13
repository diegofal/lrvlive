<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$content.page_title}</title>
{$content.page_meta}
{literal}
<link href="WEB-INF/assets/css/style.css" rel="stylesheet" type="text/css" />
<!--script type="text/javascript" src="WEB-INF/includes/js/main.js"></script-->
<script type="text/javascript" src="WEB-INF/includes/js/pngfix.js"></script>

<script type="text/javascript" src="WEB-INF/includes/js/flash.js"></script>
<script type="text/javascript" src="WEB-INF/includes/js/jquery.js"></script>
<script type="text/javascript" src="WEB-INF/includes/js/route.js"></script>
<script type="text/javascript" src="WEB-INF/includes/js/jcycle.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('.slideshow').cycle({
		fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});
});
</script>
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
</head>
{strip}
<body onload="
{if $subpage=="_step5" || $subpage=="_voucher_step1"}
    init_address();
{/if}" onunload="
{if $subpage=="_step4" || $subpage=="_step5" || $subpage=="_step6"  || $subpage=="_step7"}
wipe(need);
{/if}
">
{/strip}
<div class="main_body">
	<div class="wrap_body_pat1">
		<div class="building_main">
		
		<!-- slider -->
		 <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <img src="images/head-slide-1.jpg" data-thumb="images/head-slide-1.jpg" alt="" />
                <img src="images/head-slide-2.jpg" data-thumb="images/head-slide-2.jpg" alt="" />			
			</div>
        </div>
		<!-- end slider -->
		<!--header -->
			<div class="head_amtn">
				<div class="head_leftmain_amt1">
					<div class="logo style_pointer" onclick="window.location.href='index.php'">
						<h1 style="display:none;">London RIB Voyages</h1>
					</div>
					
                    	<div class="bookNow"><a href="http://www.londonribvoyages.com/booking.php?subpage=tours"></a></div>
                    
					<div class="head_img_amt1">
						<div class="the_ori_amt">
							<img src="images/the_original_amt2.jpg" title="Take a Thames Cruise with London Rib Voyages"
								alt="Take a Thames Cruise with London Rib Voyages" width="515" height="71" />
                                
						</div>
						<div class="book_amt1"><a href="http://www.tripadvisor.co.uk/Attraction_Review-g186338-d1526046-Reviews-London_Rib_Voyages-London_England.html" title="London RIB Voyages recommended by TripAdvisor"><img src="images/trip-advisor-header.jpg" title="Take a Thames Cruise with London Rib Voyages"
								alt="Take a Thames Cruise with London Rib Voyages" width="163" height="71" border="0" /></a>
							<!--script type="text/javascript">header_new()</script-->
						</div>
					</div>
				</div>
				<div class="header_right_mainmt">                
					<div class="head_right_amtn1">
					   	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="255" height="158" id="flash2" align="middle">
						<param name="allowScriptAccess" value="sameDomain" />
						<param name="allowFullScreen" value="false" />
						<param name="movie" value="/flash5.swf?xmlsheet=offers.xml" />
						<param name="quality" value="high" />
						<param name="wmode" value="transparent" />
						<embed src="/flash5.swf?xmlsheet=offers.xml" quality="high" bgcolor="#ffffff" width="255" height="158" name="flash2" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
						</object>                    
					</div>
		        	<div class="head_right_mainmt2" style="margin-top:18px;text-align:center;display:inline;">
		        		<span class="head_right_mainmt2" style="margin-top:18px;text-align:center;display:inline;">
							<!--object width="170" height="140">
							    <param name="movie" value="http://www.youtube.com/v/tchYd4ybFAw&color1=0xb1b1b1&color2=0xcfcfcf&hl=en_US&feature=player_embedded&fs=1" />
							    <param name="allowFullScreen" value="true" />
							    <param name="allowScriptAccess" value="always" />
				                <embed src="http://www.youtube.com/v/tchYd4ybFAw" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="170" height="140"></embed>
						    </object-->
                            <div id="TA_certificateOfExcellence814" class="TA_certificateOfExcellence" style="width:170px;margin-left:10px;">
                    <ul id="lgdrF4" class="TA_links 1yselV">
                    <li id="LCK2sK" class="AF4oUWwn7HM"><a href="http://www.tripadvisor.co.uk/Attraction_Review-g186338-d1526046-Reviews-London_Rib_Voyages-London_England.html">London Rib Voyages</a></li>
                    </ul>
                    </div>
                    <script src="http://www.jscache.com/wejs?wtype=certificateOfExcellence&amp;uniq=814&amp;locationId=1526046&amp;lang=en_UK&amp;year=2012"></script>

				    	</span>
				    </div>
					<!--Starts
					<div style="overflow: hidden; position: relative;" id="qscroller3" class="qscroller">
					<div id="qscroller3-nav"></div>
					{section name=i loop=$Testimonial}
						<div style="overflow: hidden; position: absolute; top: 0px; left: 0px; width: 180px; height: 170px; z-index: 0; visibility: visible; opacity: 1; float:left;">
							<div class="qslide3" style="float:left;background:#FFFFFF;height: 170px;" align="center">
								<div class="timeout_amt" align="left"><img src="img/testimonial/thumb/{$Testimonial[i].TesimonialImage}" alt="" /></div>
								<div class="star_amt" align="left">&nbsp;</div>
								<div class="head_amtn2_text14" align="left">{$Testimonial[i].TestimonialDesc}</div>
							</div>	
						</div>
					{/section}	
					</div>	
					Ends-->
		  		</div>
			  </div>
			</div>	
		<!--header -->
		</div>		
									<div class="secondmain_about_main_body_sadnew">
									<div class="secondmain_about_body_sad1">
										<div class="lap_15"></div>
										<div>
										<div class="secondmain_wrap">
											<div class="navmain_body">
											<!--Nav -->
												<div class="menu_top">
													<ul>
														<li><a href="index.php" title="Home" class="home selected">Home</a></li>
														<li><a href="about_us.php" title="About Us" class="about_us1">About Us</a></li>
														<li><a href="booking.php?subpage=tours" title="Our Boat Trips" class="ourboat_trip">Our Boat Trips</a></li>
														<li><a href="who_is_this_for.php" title=" Who is this for?" class="Who_is_this"> Who is this for?</a></li>
														<li><a href="safety.php" title=" Safety" class="safety"> Safety</a></li>
														<li><a href="location.php" title="Our Location" class="vessel"> Our Location</a></li>
														<li><a href="about_us_people_say.php" title="Testimonials" class="testimonials">Testimonials</a></li>
                                                        <li><a href="http://londonribvoyages.wordpress.com" title="Blog" class="blog">Blog</a></li>
														<li class="end"><a href="contact.php" title=" Contact Us" class="contact">Contact Us</a></li>
														
													</ul>
												</div>
											<!--Nav -->
												{if $page!=index} <div class="menu_bottom">&nbsp;</div> {/if}
											</div>
