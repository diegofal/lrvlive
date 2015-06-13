<div class="booking-form">
	<!--Form start -->
							 
			<div class="booking-nav">
			<ul>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step1" class="how_many_1" title="How Many?">How Many</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step2" class="date_1" title="Date &amp; Time">Time</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step3" class="yourdetail_1 active" title="Your Details">Your Details</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step6" class="payment_1" title="Payment">Payment</a></li>
			</ul>
			</div>
								   
		<form name="step4" method="post" action="booking.php?tour_id={$tour_id}&subpage=step4">						   
								   
		<div class="booking-form-main">		

		<div class="bookingtext_1"><p>Please enter your details below. All fields are mandatory.</p></div>
			
			<div class="bokking_3page clearfix">
			
			  <div class="bokking_form_middle1">
			  		<div class="bokking_3page_name1">
						<div class="bokking_3page_first_name">First Name:</div>
						<div class="bokking_3page_input_body"><input name="order_first_name" value="{$order.order_first_name}" maxlength="50" type="text" class="bokking_3page_field" size="25"></div>
					</div>
			
				<div class="bokking_3page_name1">
					<div class="bokking_3page_first_name">Last Name:</div>
					<div class="bokking_3page_input_body"><input name="order_last_name" value="{$order.order_last_name}" maxlength="50" type="text" class="bokking_3page_field" size="25"></div>
				</div>
				<div class="bokking_3page_name1">
					<div class="bokking_3page_first_name">Phone:</div>
					<div class="bokking_3page_input_body"><input name="order_phone" value="{$order.order_phone}" maxlength="16" type="text" class="bokking_3page_field" size="25"></div>
				</div>
				<div class="bokking_3page_name1">
					<div class="bokking_3page_first_name">Email:</div>
					<div class="bokking_3page_input_body"><input name="order_email" value="{$order.order_email}" maxlength="50" type="text" class="bokking_3page_field" size="25"></div>
				</div>
				
				<div class="booking_form_row clearfix" style="padding-top:10px;">
					<div class="booking_summary" style="border-top:1px solid #ccc;padding:10px 0;">
						<div class="style_step1_1">Number of People:{$order.order_tickets_number}</div>
						<div class="style_step2_1">Total Cost: <span class="profile_no2" id="total_cost">&pound;{$order.order_total format="%.2f"}</span></div>
					</div>
				</div>
			</div>
 	   </div>
	   
		<div class="booking_form_row booking_buttons clearfix">
			<div class="booking-button back-button"><a href="booking.php?tour_id={$tour_id}&amp;subpage=step1">Back</a></div>
			<div class="booking-button booking-submit"><a href="javascript:check_form();">Proceed</a></div>
		</div>
		
		</form>
	</div>
											  <!--Form end -->

	</div>
	
	{include file="utils/site_right_menu_booking_sub.tpl" }
</div>