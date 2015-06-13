<div id="fb-root"></div>
<script type="text/javascript">
var lblOrderTotal = {$order.order_total};
</script>
{literal}
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>


window.onload = function () { 
	
	FB.Event.subscribe('edge.create', page_like_callback);
	FB.Event.subscribe('edge.remove', page_unlike_callback);
	document.getElementById('lblOrderTotal').innerHTML = lblOrderTotal;

	if (getCookie("likeFacebookCookie"))
		page_like_callback();
	else
		page_unlike_callback();
	
};

var page_like_callback = function(url, html_element) {
	setCookie("likeFacebookCookie", "true", 1000);

	document.getElementById('lblOrderTotal').innerHTML = lblOrderTotal - 1;
	document.getElementById('fbLikeDiscount').style.display = 'block' ;
	document.getElementById('facebook_discount').value = 1;
}
var page_unlike_callback = function(url, html_element) {
	  setCookie("likeFacebookCookie", "true", -1);
	  document.getElementById('lblOrderTotal').innerHTML = lblOrderTotal;
	  document.getElementById('fbLikeDiscount').style.display = 'none';
	  document.getElementById('facebook_discount').value = 0;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
}

function checkCookie(cookieName) {
    var cookieName=getCookie(cookieName);
    if (cookieName!="") {
        return true;
    }else{
        return false;
    }
}
</script>
{/literal}

<div class="booking-form">
	<!--Form start -->
	<form name="step3" method="post" action="booking.php?tour_id={$tour_id}&subpage=step3">
		<input type="hidden" id="facebook_discount" name="facebook_discount" value="0" />
		<div class="booking-nav">
			<ul>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step1" class="how_many_1" title="How Many?">How Many</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step2" class="date_1" title="Date &amp; Time">Time</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step3" class="yourdetail_1 active" title="Your Details">Your Details</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step6" class="payment_1" title="Payment">Payment</a></li>
			</ul>
		</div>
		
		<div class="booking-form-main">
		
			<h3>Shopping Cart</h3>
		
			<div class="bookingtext_1_new1">Please verify the booking information you have selected. If you need to make any changes, please use the Back button below. </div>
		   
			<div class="booking_form_row booking_terms">
				<input type="checkbox" class="checkbox" name="confirm" value="checkbox" {if !empty($order.order_find)} checked="checked"{/if}>&nbsp;Please confirm that you have read our <a href="javascript:openwind('terms.php', 700, 500, 'yes')">Terms & Conditions</a>.
			</div>
			
			<!--Second Div Starts-->
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Item :</div>
					<div class="style_step3_10">{$tour.tour_name}</div>
			</div>
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Date of Voyage :</div>
					<div class="style_step3_10">{$departure.departure_date|date_format:"%d %b %Y"}</div>
			</div>
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Departure Time :</div>
					<div class="style_step3_10">{$departure.departure_time|truncate:5:""}</div>
			</div>
		
	 <!--END-->
		 <div class="style_tour_details17">
		 	<div class="style_step3_3">
				<div class="style_step3_12">
					<div class="style_step3_7">
						<div class="style_step3_13"></div>
						<div class="style_step3_14" style="text-align:center"><strong>Quantity</strong></div>
						<div class="style_step3_15" style="text-align:center"><strong>Total</strong></div>
					</div>
				</div>
				<!--Second Div Starts Here-->
				{section name=i loop=$tickets}
				<div class="style_div_detail1">
					<div class="style_step3_7">
						<div class="style_step3_16">{$tickets[i].type}</div>
						<div class="style_step3_17" style="text-align:center">{$tickets[i].quantity} @ &pound;{$tickets[i].price}</div>
						<div class="style_step3_15" style="text-align:center">&pound;{$tickets[i].total}</div>
					</div>
				</div>
				{sectionelse}
				<div class="style_div_detail1">
					<div class="style_step3_7">
						<div class="style_step3_16" style="text-align:center"><strong>Charter</strong></div>
						<div class="style_step3_17" style="text-align:center">1 @ &pound;{$order.order_total}</div>
						<div class="style_step3_15" style="text-align:center">&pound;{$order.order_total}</div>
					</div>
				</div>
				{/section}
				<!--Start Total-->

				<div class="booking_form_row" style="height:80px;padding-top: 30px;">
					<div style="float:left;float:left;margin-top: 17px;">Come join us on Facebook and<br />save &pound;1 on your booking</div>
					<div style="float:right;">
						<div class="fb-like-box" data-href="https://www.facebook.com/londonribvoyages" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false"></div>
					</div>
				</div>

				<div class="style_step3_18"></div>
				<div class="style_step3_19">
					<div class="style_step3_20">
						<div class="style_step3_13"></div>
						<div class="style_step3_14"></div>
						<div class="style_step3_15 booking_totals booking_fee">BOOKING FEE: &nbsp;&pound;3.95</div>
					</div>					
					<div class="style_step3_20" id="fbLikeDiscount" style="display:none;">
						<div class="style_step3_13"></div>
						<div class="style_step3_14"></div>
						<div class="style_step3_15 booking_totals">DISCOUNT: &nbsp;-&pound;1</div>
					</div>
					<div class="style_step3_20">
						<div class="style_step3_13"></div>
						<div class="style_step3_14"></div>
						<div class="style_step3_15 booking_totals">TOTAL COST: &nbsp;&pound;<span id="lblOrderTotal"></span></div>
					</div>
				</div>
			<!--ENDS TOTAL-->
		</div>
		
	<div class="style_step3_21 booking_form_row">
		<div class="style_step3_22">How did you find us?</div>
			<div class="style_step3_23">
				<select name="order_find" class="booking-ddwn-length">
					<option value="0">Please select</option>
					{section name=b loop=$hear_about_us}
					<option value="{$hear_about_us[b].Title}" {if $order.order_find == $hear_about_us[b].Title} selected="selected"{/if}>{$hear_about_us[b].Title}</option>
					{/section}
				</select>
			</div>
		 </div>
	</div>		 
		<!--END-->
		<div class="booking_form_row booking_buttons clearfix">
			<div class="booking-button back-button"><a href="booking.php?tour_id={$tour_id}&amp;subpage=step1">Back</a></div>
			<div class="booking-button booking-submit"><a href="javascript:check_form();">Proceed</a></div>
		</div>

	</form>
</div>
</div>
	
	<!--Include Right Menu-->
		{include file="utils/site_right_menu_booking_sub.tpl" }
	<!--END-->
</div>	
