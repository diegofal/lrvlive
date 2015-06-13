<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>London RIB Voyages</title>
{literal}
<link href="WEB-INF/assets/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="WEB-INF/includes/js/main.js"></script>
<script type="text/javascript" src="WEB-INF/includes/js/pngfix.js"></script>
<script type="text/javascript" src="WEB-INF/includes/js/flash.js"></script>
<script type="text/javascript" src="WEB-INF/includes/js/jquery-1.2.2.pack.js"></script>
<link rel="stylesheet" type="text/css" href="WEB-INF/assets/css/featuredcontentglider.css" />
<script type="text/javascript" src="WEB-INF/includes/js/featuredcontentglider.js"></script>
{/literal} 
</head>
{strip}
<body onLoad="
{if $subpage=="_step5" || $subpage=="_voucher_step1"}
    init_address();
{/if}" onUnload="
{if $subpage=="_step4" || $subpage=="_step5" || $subpage=="_step6"  || $subpage=="_step7"}
wipe(need);
{/if}
">
{/strip}
{literal}
<script language="javascript">

featuredcontentglider.init({
	gliderid: "", //ID of main glider container
	contentclass: "", //Shared CSS class name of each glider content
	togglerid: "p-select", //ID of toggler container
	remotecontent: "", //Get gliding contents from external file on server? "filename" or "" to disable
	selected: 0, //Default selected content index (0=1st)
	persiststate: false, //Remember last content shown within browser session (true/false)?
	speed: 1200, //Glide animation duration (in milliseconds)
	direction: "rightleft", //set direction of glide: "updown", "downup", "leftright", or "rightleft"
	autorotate: true, //Auto rotate contents (true/false)?
	autorotateconfig: [3000, 2] //if auto rotate enabled, set [milliseconds_btw_rotations, cycles_before_stopping]
})

</script>
{/literal}
<div class="main_body">
	<div class="wrap_body_pat1">
		<div class="building_main">
		<!--header -->
			<div class="head_amtn">
			
				<div class="head_leftmain_amt1">	<div class="logo"><h1>London RIB Voyages</h1></div>
				<div class="head_img_amt1">
				<div class="the_ori_amt">
				<img src="images/the_original_amt1.jpg" alt="" width="552" height="71" />
				</div>
				<div class="book_amt1"><script type="text/javascript">header_new()</script></div>
				
				<div class="tf_icon_amt1">
				<div class="t_icon_mt"><a href="#"><img src="images/t_icon.png" alt="" border="0" /></a></div>
				<div class="f_icon_mt"><a href="#"><img src="images/f_icon.png" alt="" width="36" height="47" border="0" /></a></div>
				</div>
				</div>
				</div>
				<div class="header_right_mainmt">
				<div class="head_right_amtn1">
			 <div id="canadaprovinces" class="glidecontentwrapper">
				<div class="glidecontent">
				<h2 class="right_mt_text18">Today's Special</h2>
				<div class="right_mt_text14">For today only all trips 50% Discount! Click below for more details.</div>
				</div>
		      </div>
			  <div id="p-select" class="glidecontenttoggler">
				<a href="#" class="prev">Prev</a> 
				<a href="#" class="toc">Page 1</a> <a href="#" class="toc">Page 2</a> <a href="#" class="toc">Page 3</a>
				<a href="#" class="next">Next</a>
				</div>
				<div class="moreinfo_mt">
				<div class="left_arrow_mt"><a href="#"><img src="images/arrow_left1.jpg" alt="Arrow" width="24" height="23" border="0" /></a></div>
				<div class="moreinfo_button_mt"><a href="#" title="More Info"><img src="images/more_info_mt1.jpg" alt="More Info" width="82" height="23" border="0" /></a></div>
				<div class="right_arrow_mt"><a href="#"><img src="images/arrow_right1.jpg" alt="Arrow" width="24" height="23" border="0" /></a></div>
				</div>
				</div>
		        <div class="head_right_mainmt2">
				<div class="timeout_amt"><img src="images/timeout1.jpg" alt="Time Out" width="98" height="44" /></div>
				<div class="star_amt"><img src="images/star_amt1.jpg" alt="Star" /></div>
				<div class="head_amtn2_text14">"A brilliant introduction<br /> to London for vivitors"</div>
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
														<li ><a href="index.php" title="Home" class="home_visited">Home</a></li>
														<li><a href="about_us.php" title="About Us" class="about_us1">About Us</a></li>
														<li><a href="booking.php?subpage=tours" title="Our Boat Trips" class="ourboat_trip">Our Boat Trips</a></li>
														<li><a href="who_is_this_for.php" title=" Who is this for?" class="Who_is_this"> Who is this for?</a></li>
														<li><a href="how_book.php" title=" How to book" class="how_to_book"> How to book</a></li>
														<li><a href="safety.php" title=" Safety" class="safety"> Safety</a></li>
														<li><a href="location.php" title="Our Location" class="vessel"> Our Location</a></li>
														<li><a href="blog.php" title=" Blog" class="blog"> Blog</a></li>
														<li><a href="media_center.php" title=" Media Centre" class="media_center"> Media Centre</a></li>
														<li><a href="contact.php" title=" Contact Us" class="media_center"> Contact Us</a></li>
														
													</ul>
												</div>
											<!--Nav -->
												<div class="menu_bottom">&nbsp;</div>
											</div>