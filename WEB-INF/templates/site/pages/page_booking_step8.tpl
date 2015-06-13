<div class="booking-form">
	<!--Form start -->
		<div class="booking-nav">
			<ul>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step1" class="how_many_1" title="How Many?">How Many</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step2" class="date_1" title="Date &amp; Time">Time</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step3" class="yourdetail_1" title="Your Details">Your Details</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step6" class="payment_1" title="Payment">Payment</a></li>
			</ul>
		</div>
		
		<div class="booking-form-main">	
			<h3>Complete</h3>	
			
			<div class="bookingtext_1" style="margin-left:0;"><p>
							{if $results.status == 'OK'}
                            Thank you for purchasing your ticket with London RIB  Voyages. Please check your mail and follow the link we sent you in order to view your ticket and our Information  page which you will need to read.
                            <br /><br />
                            <strong>Please click on the link below to print out your Booking Confirmation</strong>
                            <br /><br />
                            <a target="_blank" href="booking/print.php?code={$results.code}" title="Please click to print out your Booking Confirmation">print</a>
                            {else}                      
                            Sorry, the payment operation could not be performed properly. <br /><br />The error message: <strong>{$results.status}</strong>. <br /><br />Please follow <a href="booking.php?subpage=step6">this link</a> in order to try again. 
                       		 {/if}
							</p>
									 
			</div>

		<div class="booking_form_row booking_buttons clearfix">
			<div class="booking-button booking-submit"><a href="/">Finish</a></div>
		</div>

	</div>
	</div>
								<!--Include Right Menu-->
											{include file="utils/site_right_menu_booking_sub.tpl" }
								<!--END-->
								</div>	
