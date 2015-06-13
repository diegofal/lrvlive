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
		
		<form name="step5" method="post" action="booking.php?tour_id={$tour_id}&subpage=step5">
			<input name="step5" value="yes" type="hidden">

			<div class="booking-form-main">	
				
				<h3>Confirmation</h3>
					
					<div class="bookingtext_1" style="margin-left:0;"><p style="margin-bottom:0;">Please verify the details of your order below, including billing address information and purchase items. If the contents of your order are correct, select the PROCEED TO CHECKOUT button to finish placing your booking.</p></div>

					<div class="style_tour_details17">
					 	<div class="style_step3_3">
							<div class="style_step3_4">
							<!--Start Pricing-->
								<div class="style_step3_5">
									<div class="style_step3_6">Billing Name and Address:<br /><br />
										<span class="style_step5_1">
										{$order.order_title} {$order.order_first_name} {$order.order_last_name}<br>
                                    {if !empty($order.order_phone)}{$order.order_phone}<br>{/if}
                                    <a href="mailto:{$order.order_email}">{$order.order_email}</a></span>
									</div>
								</div>
							</div>
						</div>
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
									<div class="style_step3_17" style="text-align:center">1 @ &pound;{math equation="x - y + z" x=$order.order_total y=$price_fee z=$order.order_facebook_discount format="%.2f"}</div>
									<div class="style_step3_15" style="text-align:center">&pound;{math equation="x - y + z" x=$order.order_total y=$price_fee z=$order.order_facebook_discount format="%.2f"}</div>
								</div>
							</div>
							{/section}
							<!--Start Total-->
							<div class="style_step3_18"></div>
								<div class="style_step3_19">
									<div class="style_step3_20">
										<div class="style_step3_13"></div>
										<div class="style_step3_14"></div>
										<div class="style_step3_15 booking_totals booking_fee">BOOKING FEE: &nbsp;&pound;3.95</div>
									</div>
									<div class="style_step3_20">
										<div class="style_step3_13"></div>
										<div class="style_step3_14"></div>
										<div class="style_step3_15 booking_totals">DISCOUNT: &nbsp;&pound;{math equation="-1 * x" x=$order.order_facebook_discount format="%.2f"}</div>
									</div>
									<div class="style_step3_20">
										<div class="style_step3_13"></div>
										<div class="style_step3_14"></div>
										<div class="style_step3_15 booking_totals">TOTAL COST: &nbsp;&pound;{$order.order_total format="%.2f"}</div>
									</div>
							</div>
							<!--ENDS TOTAL-->
						</div>
					 </div>	
					 <!--END-->

					<div class="booking_form_row booking_buttons clearfix">
						<div class="booking-button back-button"><a href="booking.php?tour_id={$tour_id}&amp;subpage=step4">Back</a></div>
						<div class="booking-button booking-submit"><a href="javascript:document.step5.submit()">Proceed</a></div>
					</div>					 
	  </div>
  </form>
</div>

<!--Include Right Menu-->
	{include file="utils/site_right_menu_booking_sub.tpl" }
<!--END-->
</div>	
