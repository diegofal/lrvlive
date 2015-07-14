<div class="booking-form vouchers_form">
	<!--Form start -->
	<form name="voucher_step2" method="post" action="booking.php?voucher_id={$voucher_id}&amp;subpage=voucher_step2">
		<div class="booking-nav voucher-nav">
					<ul>
						<li><a href="booking.php?voucher_id={$smarty.get.voucher_id}&subpage=voucher_step1" class="how_many_1" title="How Many?">How Many</a></li>
						<li><a href="booking.php?voucher_id={$smarty.get.voucher_id}&subpage=voucher_step2" class="yourdetail_1 active" title="Your Details">Your Details</a></li>
						<li><a href="booking.php?voucher_id={$smarty.get.voucher_id}&subpage=voucher_step3" class="payment_1" title="Payment">Payment</a></li>
					</ul>
	    </div>

		<div class="booking-form-main">
				
			<h1>Vouchers</h1>
		
			<div class="bookingtext_1_new">
			Please verify the booking information you have selected. If you need to make any changes, please use the Back button below.
			</div>
				
			<div class="booking_form_row booking_terms">
				<input type="checkbox" class="checkbox" name="confirm" value="checkbox" {if !empty($order.order_find)} checked="checked"{/if}>&nbsp;Please confirm that you have read our <a href="javascript:openwind('terms.php', 700, 500, 'yes')">Terms & Conditions</a>.
			</div>
				
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Name of person to receive this Voucher:</div>
					<div class="style_step3_10">{$voucher_order.voucher_order_to}</div>
			</div>
				
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Phone number of receiver:</div>
					<div class="style_step3_10">{$voucher_order.voucher_order_phone_to}</div>
			</div>
				
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Email of sender:</div>
					<div class="style_step3_10">{$voucher_order.voucher_order_email}</div>
			</div>
				
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Name of sender:</div>
					<div class="style_step3_10">{$voucher_order.voucher_order_name}</div>
			</div>
			
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Telephone of sender:</div>
					<div class="style_step3_10">{$voucher_order.voucher_order_phone}</div>
			</div>
			
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Name of the person of who it is to be posted:</div>
					<div class="style_step3_10">{$voucher_order.voucher_order_name_to}</div>
			</div>
			
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Address of where the voucher is to be posted:</div>
					<div class="style_step3_10">{$voucher_order.voucher_order_address1_to}</div>
			</div>

			<!--Second Div Starts-->
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Item :</div>
					<div class="style_step3_10">{$voucher.voucher_name}</div>
			</div>
			
			 <!--END-->
			 <div class="style_tour_details17">
				<div class="style_step3_3">
					<div class="style_step3_12">
						<div class="style_step3_7">
							<div class="style_step3_13"></div>
							<div class="style_step3_14">Quantity</div>
							<div class="style_step3_15">Total</div>
						</div>
					</div>

					{section name=i loop=$tickets}
					<div class="style_div_detail1">
						<div class="style_step3_7">
							<div class="style_step3_16">{$tickets[i].type}</div>
							<div class="style_step3_17">{$tickets[i].quantity} @ &pound;{$tickets[i].price}</div>
							<div class="style_step3_15">&pound;{$tickets[i].total}</div>
						</div>
					</div>
					{/section}
				
					<!--Start Total-->
					<div class="style_step3_18"></div>
					<div class="style_step3_19">
						<div class="style_step3_20">
							<div class="style_step3_13"></div>
							<div class="style_step3_14"></div>
							<div class="style_step3_15 booking_totals booking_fee">PRICE: &nbsp; {$voucher_order.voucher_order_total}</div>
						</div>
						<div class="style_step3_20">
							<div class="style_step3_13"></div>
							<div class="style_step3_14"></div>
							<div class="style_step3_15 booking_totals">DISCOUNT: &nbsp;{$voucher.voucher_discount}%</div>
						</div>
						<div class="style_step3_20">
							<div class="style_step3_13"></div>
							<div class="style_step3_14"></div>
							<div class="style_step3_15 booking_totals booking_fee">BOOKING FEE: &nbsp;&pound;2.95</div>
						</div>
						<div class="style_step3_20">
							<div class="style_step3_13"></div>
							<div class="style_step3_14"></div>
							<div class="style_step3_15 booking_totals">FINAL PRICE: &nbsp;&pound;{$voucher_order.voucher_order_discounted_total}</div>
						</div>
					</div>
				<!--ENDS TOTAL-->
			</div>
		</div>
	

			<div class="booking_form_row booking_buttons clearfix">
				<div class="booking-button back-button"><a href="booking.php?voucher_id={$voucher_id}&subpage=voucher_step1">Back</a></div>
				<div class="booking-button booking-submit"><a href="javascript:check_form();">Continue</a></div>
			</div>
		
		</form>
</div>
</div>
	
	<!--Include Right Menu-->
		{include file="utils/site_right_menu_booking_sub.tpl" }
	<!--END-->
</div>	