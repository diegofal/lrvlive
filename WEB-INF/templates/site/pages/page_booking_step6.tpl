<div class="booking-form">
	<!--Form start -->
	<form id="step6" name="step6" method="post" action="{$vspsite}">
	    <input type="hidden" name="VPSProtocol" value="2.22">
		<input type="hidden" name="TxType" value="PAYMENT">
		<input type="hidden" name="Vendor" value="londonribvoyage">
		<input type="hidden" name="Crypt" value="{$crypt}">
		<div class="booking-nav">
			<ul>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step1" class="how_many_1" title="How Many?">How Many</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step2" class="date_1" title="Date &amp; Time">Time</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step3" class="yourdetail_1" title="Your Details">Your Details</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step6" class="payment_1 active" title="Payment">Payment</a></li>
			</ul>
		</div>
		<div class="booking-form-main">
			<h3>Payment</h3>
			<div class="bookingtext_1"><p>Please click on the "proceed" button below in order to pay for your ticket(s). The payment operation will be performed through <a href="http://www.protx.com/" target="_blank">www.protx.com</a>, a provider of secure online credit card and debit card payment solutions for thousands of online and mail order businesses across the UK.</p>
			<p style="text-align:center;"><img src="WEB-INF/assets/images/utils/acceptedcards.gif" width="296" height="25"></p>		
			</div>
			<div class="booking_form_row booking_buttons clearfix">
				<div class="booking-button back-button"><a href="booking.php?tour_id={$tour_id}&amp;subpage=step5">Back</a></div>
				<div class="booking-button booking-submit"><a href="javascript:document.step6.submit()">Proceed</a></div>
			</div>					 
	  	</div>
  	</form>
</div>

<!--Include Right Menu-->
	{include file="utils/site_right_menu_booking_sub.tpl" }
<!--END-->
</div>	