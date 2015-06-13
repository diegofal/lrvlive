<div class="booking-form vouchers_form">
		<!--Form start -->
		<form name="step6" method="post" action="{$vspsite}">
			<INPUT TYPE="hidden" NAME="VPSProtocol" VALUE="2.22">
			<INPUT TYPE="hidden" NAME="TxType" VALUE="PAYMENT">
			<INPUT TYPE="hidden" NAME="Vendor" VALUE="londonribvoyage">
			<INPUT TYPE="hidden" NAME="Crypt" VALUE="{$crypt}">
			
			<div class="booking-nav voucher-nav">
					<ul>
						<li><a href="booking.php?voucher_id={$smarty.get.voucher_id}&subpage=voucher_step1" class="how_many_1" title="How Many?">How Many</a></li>
						<li><a href="booking.php?voucher_id={$smarty.get.voucher_id}&subpage=voucher_step2" class="yourdetail_1" title="Your Details">Your Details</a></li>
						<li><a href="booking.php?voucher_id={$smarty.get.voucher_id}&subpage=voucher_step3" class="payment_1 active" title="Payment">Payment</a></li>
					</ul>
			</div>
			
			<div class="booking-form-main">
				
				<h1>Vouchers</h1>
		
				<div class="bookingtext_1_new">Please click on the "proceed" button below in order to pay for your ticket(s). The payment operation will be performed through <a href="http://www.protx.com/" target="_blank">www.protx.com</a>, a provider of secure online credit card and debit card payment solutions for thousands of online and mail order businesses across the UK.
				<p><img src="WEB-INF/assets/images/utils/acceptedcards.gif" width="296" height="25" /></p>
				</div>

				<div class="booking_form_row booking_buttons clearfix">
					<div class="booking-button back-button"><a href="booking.php?voucher_id={$voucher_id}&subpage=voucher_step2">Back</a></div>
					<div class="booking-button booking-submit"><a href="javascript:document.step6.submit();">Continue</a></div>
				</div>	
				
			
			
		</form>
		
		</div>
<!--Form end -->
	
	
	</div>
											
	{include file="utils/site_right_menu_booking_sub.tpl" }
</div>
</div>
