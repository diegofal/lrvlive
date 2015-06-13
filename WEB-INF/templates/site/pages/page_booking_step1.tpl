<div class="booking-form">
		<!--Form start -->
		<form name="step1" method="post" action="booking.php?tour_id={$tour_id}&amp;subpage=step1">
				<div class="booking-nav">
					<ul>
						<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step1" class="how_many_1 active" title="How Many?">How Many</a></li>
						<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step2" class="date_1" title="Date &amp; Time">Time</a></li>
						<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step3" class="yourdetail_1" title="Your Details">Your Details</a></li>
						<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step6" class="payment_1" title="Payment">Payment</a></li>
					</ul>
				</div>
			
			<div class="booking-form-main">
			
			{if !empty($smarty.get.busy) && ($smarty.get.busy==true) }
				<div class="bookingtext_1_new"><strong>The ticket(s) you booked has just been paid by another person.<br /> Please try again with other options.</strong></div>
			{/if}
			
			{if !empty($smarty.get.expired) && ($smarty.get.expired==true)}
				<div class="bookingtext_1_new"><span class="warning"><strong>Sorry, your session has expired. Please try &amp; make another booking.  <br />Please note: You will need to complete your booking within 30 minutes.<br>Please, don't refresh the page in time of the booking.</strong></span></div>
			{/if}
			
			
			
			<h1>Boat Trip: {$tour.tour_home_name1}</h1>
			
			<div class="{if $smarty.get.busy==true || $smarty.get.expired==true} bookingtext_1_new1 {else}bookingtext_111{/if}">Please specify the number of people for your voyage, as well as the ticket types you would like to purchase. If you would like to book a charter, please select this option below.</div>
								   
				<div>
					<div class="booking_form_mainbody">
						<div class="booking_form_middle clearfix">
							<div>
								<div class="ticket_text1_new">Ticket Type:</div>
								<div class="ticket_text1_new2">Quantity:</div>
								<div class="ticket_text_price">Price:</div>
							</div>
						{section name=i loop=$tickets}
						<div>
							<div class="ticket_text1_new"><span class="ticket_text2">{$tickets[i].ticket_type}:</span></div>
							<div class="ticket_text1_new2"><span class="ticket_text2">
							<input name="ticket[]" type="hidden" value="{$tickets[i].ticket_id}" /><input name="quantity[]" type="text" class="ticket_textfield_1" size="4" maxlength="3" value="{$tickets[i].quantity}" onkeyup="calculate_total()" /><input name="price[]" type="hidden" value="{$tickets[i].ticket_price}" />
							</span></div>
						<div class="ticket_text1_price"><span class="ticket_text2">&pound;{$tickets[i].ticket_price}</span></div>
					</div>
					{/section}
				</div>
			</div>
			
<!--Package Div Starts Here-->
	{if !empty($special_tickets)}
		<div class="bokking_form_mainbody_lar">
			<div class="bokking_form_middle1">
				<div>
					<div class="ticket_text1_new">Special Offers:</div>
					<div class="ticket_text1_new">Price:</div>
					<div class="ticket_text1"></div>
				</div>
				{section name=i loop=$special_tickets}
				
				<div>
					<div class="ticket_text1_new"><span class="ticket_text2">{$special_tickets[i].ticket_type}:</span></div>
					<div class="ticket_text1_new"><span class="ticket_text2">&pound;{$special_tickets[i].ticket_price}</span></div>
					<div class="ticket_text1"><span class="ticket_text2"><input name="ticket[]" type="hidden" value="{$special_tickets[i].ticket_id}" /><input name="quantity[]" type="hidden" class="booking-cell" value="{$special_tickets[i].quantity}" size="4" maxlength="3" /><input name="price[]" type="hidden" value="{$special_tickets[i].ticket_price}" /><input type="checkbox" class="checkbox" name="special[]" value="{$special_tickets[i].ticket_price}" onclick="calculate_total();" {if $special_tickets[i].quantity==1}checked="checked"{/if} /></span></div>
				</div>
				{/section}
			</div>
			
		</div>
	{/if}
<!--ENDS HERE-->
								   
<div class="booking_form_row booking_charters clearfix">
		<div class="ticket_type_body1">
		Charter{if $tour_id eq 4} (usually &pound;545){/if}: &pound;{$tour.tour_charter_price}
		</div>
												
		<div class="quantity_body1"></div>
		
		<div class="price_body1">
			Book Now: <input type="checkbox" class="checkbox" name="charter" value="yes" onclick="is_charter('{$tour.tour_charter_price}');" {if ($order.order_tickets_number == 1) && ($order.order_tickets == 0)} checked="checked"{/if} />
		</div>
</div>

<!-- BOOKING FEE -->
<div class="booking_form_row booking_fee clearfix">
		<div class="ticket_type_body1">BOOKING FEE</div>
		<div class="quantity_body1"></div>
		<div class="price_body1">&pound;{$price_fee}</div>
			<input type="hidden" name="price_fee" value="{$price_fee}" id="price_fee" />
</div>

<!-- END BOOKING FEE-->	
<div class="booking_form_row booking_total clearfix">
		<div class="ticket_type_body1">Total Booking Cost:</div>
		<div class="quantity_body1"></div>
		<div class="price_body1">
		<input type="hidden" name="total" value="" id="total_val" />&pound;<span id="tot_price">0.00</span>
		</div>
</div>

<div class="booking_form_row booking_buttons clearfix">
		<div class="booking-button back-button"><a href="booking.php?tour_id={$tour_id}&amp;subpage=tours">Back</a></div>
		<div class="booking-button booking-submit"><a href="javascript:check_form();">Proceed</a></div>
</div>
</div>
</div>

</form>
<!--Form end -->

</div>
											<!--Include Right Menu-->
											{include file="utils/site_right_menu_booking_sub.tpl" }
											<!--END-->
										  </div>
		{if ($order.order_tickets_number == 1) && ($order.order_tickets == 0)}
			<script language="javascript" type="text/javascript">
			<!--
				is_charter('{$tour.tour_charter_price}');
			-->
			</script>
			{else}
			<script language="javascript" type="text/javascript">
			<!--
				calculate_total({$no_tickets});
			-->
			</script>
		{/if}