<div class="booking-form">
		<!--Form start -->
			<form name="voucher_step1" method="post" action="booking.php?voucher_id={$voucher_id}&amp;subpage=voucher_step1">
				<div class="booking-nav voucher-nav">
					<ul>
						<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step1" class="how_many_1 active" title="How Many?">How Many</a></li>
						<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step3" class="yourdetail_1" title="Your Details">Your Details</a></li>
						<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step6" class="payment_1" title="Payment">Payment</a></li>
					</ul>
			    </div>

				<div class="booking-form-main">
				
					<h1>Vouchers</h1>
					
					<div class="bookingtext_1_new">Please enter the following details to purchase your Voucher</div>

					<div class="bokking_3page clearfix">
					
					  <div class="bokking_form_middle1">
							<div class="voucher_3page_name1">
								<div class="voucher_3page_first_name">Name of person to receive this Voucher:</div>
								<div class="voucher_3page_input_body"><input name="voucher_order_to" value="{$voucher_order.voucher_order_to}" maxlength="80" type="text" class="bokking_3page_field" size="25" /></div>
							</div>
							<div class="voucher_3page_name1">
								<div class="voucher_3page_first_name">Phone number of receiver:</div>
								<div class="voucher_3page_input_body"><input name="voucher_order_phone_to" value="{$voucher_order.voucher_order_phone_to}" maxlength="20" type="text" class="bokking_3page_field" size="25" /></div>
							</div>
							<div class="voucher_3page_name1">
								<div class="voucher_3page_first_name">Email of sender:</div>
								<div class="voucher_3page_input_body"><input name="voucher_order_email" value="{$voucher_order.voucher_order_email}" maxlength="100" type="text" class="bokking_3page_field" size="25" /></div>
							</div>
							<div class="voucher_3page_name1">
								<div class="voucher_3page_first_name">Name of sender:</div>
								<div class="voucher_3page_input_body"><input name="voucher_order_name" value="{$voucher_order.voucher_order_name}" maxlength="100" type="text" class="bokking_3page_field" size="25" /></div>
							</div>
							<div class="voucher_3page_name1">
								<div class="voucher_3page_first_name">Telephone of sender:</div>
								<div class="voucher_3page_input_body"><input name="voucher_order_phone" value="{$voucher_order.voucher_order_phone}" maxlength="20" type="text" class="bokking_3page_field" size="25" /></div>
							</div>
							<div class="voucher_3page_name1">
								<div class="voucher_3page_first_name">Name of the person voucher to be posted to:</div>
								<div class="voucher_3page_input_body"><input name="voucher_order_name_to" value="{$voucher_order.voucher_order_name_to}" maxlength="100" type="text" class="bokking_3page_field" size="25" /></div>
							</div>
							<div class="voucher_3page_name1">
								<div class="voucher_3page_first_name">Address of where the voucher is to be posted:</div>
								<div class="voucher_3page_input_body"><input name="voucher_order_address1_to" value="{$voucher_order.voucher_order_address1_to}" maxlength="250" type="text" class="bokking_3page_field" size="25" /></div>
							</div>
							<div class="voucher_3page_name1_message">
								<div class="voucher_3page_first_name">Message from sender:</div>
								<div class="voucher_3page_input_body"><textarea cols="23" rows="3" class="bokking_3page_field2" name="voucher_order_message">{$voucher_order.voucher_order_message}</textarea></div>
							</div>
						</div>
									
					</div>
				
					

				<div>
					<div class="booking_form_mainbody">
						<div class="booking_form_middle">
							<div>
								<div class="ticket_text1_new">Ticket Type:</div>
								<div class="ticket_text1_new2">Quantity:</div>
								<div class="ticket_text_price">Price:</div>
							</div>
							{section name=i loop=$tickets}
							<div>
								<div class="ticket_text1_new"><span class="ticket_text2">{$tickets[i].ticket_type}:</span></div>
								<div class="ticket_text1_new2">
									<span class="ticket_text2">
										<input name="ticket[]" type="hidden" value="{$tickets[i].ticket_id}" />
										<input name="quantity[]" size="4" maxlength="3" value="{$tickets[i].quantity}" onkeyup="check_input()" />
										<input name="price[]" type="hidden" value="{$tickets[i].ticket_price}" class="bokking_3page_field_new" />
									</span>
								</div>
								<div class="ticket_text1_price"><span class="ticket_text2">&pound;{$tickets[i].ticket_price}</span></div>
							</div>
							{/section}
							
							{if !empty($special_tickets)}
							{section name=i loop=$special_tickets}
							<div>
								<div class="ticket_text1_new"><span class="ticket_text2">{$special_tickets[i].ticket_type}:</span></div>
								<div class="ticket_text1_new2">
									<span class="ticket_text2">
										<input name="ticket[]" type="hidden" value="{$special_tickets[i].ticket_id}" />
										<input name="quantity[]" type="hidden" class="booking-cell" value="{$special_tickets[i].quantity}" size="4" maxlength="3" />
										<input name="price[]" type="hidden" value="{$special_tickets[i].ticket_price}" />
										<input type="checkbox" class="checkbox" name="special[]" value="{$special_tickets[i].ticket_price}" onclick="check_input();" {if $special_tickets[i].quantity==1}checked="checked"{/if} />&nbsp;&nbsp;&nbsp;&nbsp;
										<span style="font:bold 12px Arial, Helvetica, sans-serif; color:#000000;">&pound;{$special_tickets[i].ticket_price}</span>
									</span>
								</div>
								<div class="ticket_text1_price"><span class="ticket_text2">&pound;{$tickets[i].ticket_price}</span></div>
							</div>
							{/section}	
							{/if}
							
						</div>


						
					</div>
				</div>
			
						
			<div class="booking_form_row booking_buttons clearfix">
				<div class="booking-button back-button"><a href="booking.php?subpage=tours">Back</a></div>
				<div class="booking-button booking-submit"><a href="javascript:check_form();">Continue</a></div>
			</div>
		</form>
		
		</div>
<!--Form end -->
	
	</div>
											
	{include file="utils/site_right_menu_booking_sub.tpl" }

</div>