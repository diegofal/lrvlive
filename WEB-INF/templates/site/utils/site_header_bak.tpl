<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$content.page_title}</title>
{$content.page_meta}
{literal}
<link href="WEB-INF/assets/css/slider.css?v=2" rel="stylesheet" type="text/css" />
<link href="WEB-INF/assets/css/style.css?v=2" rel="stylesheet" type="text/css" />
<!--script type="text/javascript" src="WEB-INF/includes/js/main.js?v=2"></script-->
<script type="text/javascript" src="WEB-INF/includes/js/pngfix.js?v=2"></script>

<script type="text/javascript" src="WEB-INF/includes/js/flash.js?v=2"></script>
<script type="text/javascript" src="WEB-INF/includes/js/jquery-1.9.0.min.js?v=2"></script>
<script type="text/javascript" src="WEB-INF/includes/js/route.js?v=2"></script>
<script type="text/javascript" src="WEB-INF/includes/js/jcycle.js?v=2"></script>
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

<!-- Digital Savannah Twitter re-messaging tags -->
{literal}

<script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
<script type="text/javascript">
	twttr.conversion.trackPid('l5up8', { tw_sale_amount: 0, tw_order_quantity: 0 });
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=l5up8&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />
<img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=l5up8&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />
</noscript>

{/literal}
<!-- Digital Savannah Twitter re-messaging tags -->

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
			<div class="home-slide-TA-button">
				<a href="http://www.tripadvisor.co.uk/Attraction_Review-g186338-d1526046-Reviews-London_Rib_Voyages-London_England.html" title="book now" target="_blank">
				</a>
			</div>
        </div>
		<!-- end slider -->

		</div>
									<div class="secondmain_about_main_body_sadnew">
									<div class="secondmain_about_body_sad1">
										<!--div class="lap_15"></div-->
										<div>
										<div class="secondmain_wrap">
											<div class="navmain_body">
											<!--Nav -->
												<div class="menu_top{if $page==index} homenav {elseif $page==contact} contactnav {elseif $page==safety} safetynav {elseif $page==location} locationnav {/if}">
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
