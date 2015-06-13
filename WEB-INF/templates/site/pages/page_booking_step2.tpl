<div class="booking-form">
	
	<!--Form start -->

	<form name="step2" method="post" action="booking.php?tour_id={$tour_id}&subpage=step2">
		<input name="selected_departure" type="hidden" value="" />
		<input name="number_of_people" type="hidden" value="{$order.order_tickets_number}" />
		<input name="price" type="hidden" value="" />
		
		<div class="booking-nav">
			<ul>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step1" class="how_many_1" title="How Many?">How Many</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step2" class="date_1 active" title="Date &amp; Time">Time</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step3" class="yourdetail_1" title="Your Details">Your Details</a></li>
				<li><a href="booking.php?tour_id={$smarty.get.tour_id}&amp;subpage=step6" class="payment_1" title="Payment">Payment</a></li>
			</ul>
		</div>
	
		<div class="booking-form-main">
			
			<div class="bookingtext_1">
			
			<p>Using the calendar below, please select a month and date you would like to book your ticket. Then choose what time you would like to depart.</p>
            
			<p>If you are a party of over 8 and require a departure time that is not listed please call 020 7928 8933.</p></div>
			
			<div class="booking_form_key">
				<div class="available_left1">
					<div class="darkblue_box"><img src="images/darkblue_box.jpg" alt="" /></div>
					<div class="darkblue_box_text">Tickets Available</div>
				</div>
				
				<div class="available_center1">
					<div class="darkblue_box"><img src="images/lightblue_box.jpg" alt="" /></div>
					<div class="darkblue_box_text">Sold Out</div>
				</div>
				
				<div class="available_right1">
					<div class="darkblue_box"><img src="images/orange_box.jpg" alt="" /></div>
					<div class="darkblue_box_text">Day Selected</div>
				</div>
			</div>
								 
			<div class="bokking_form_mainbody_rknew clearfix">
				<div class="calender_body_left_new">
					<div class="book_1middle float_left">
					<div class="select_month_1">Select a Month &amp; Day &nbsp;&nbsp;
						<input type="hidden" name="selected_date" value="" /><select name="month" class="booking-ddwn-length" onchange="select_month();">{section name=i loop=$months}<option value="{$months[i].departure_ym_date}" {if $months[i].departure_ym_date == $month} selected="selected" {/if}>{$months[i].departure_fm_date}</option>{/section}</select>
					</div>
					<div class="style_step2_2" align="center">
						<!--Start Calender-->
						<div class="cal_man_div">
							<div class="cal_height_width cal_head">Sun</div>
							<div class="cal_height_width cal_head">Mon</div>
							<div class="cal_height_width cal_head">Tue</div>
							<div class="cal_height_width cal_head">Wed</div>
							<div class="cal_height_width cal_head">Thu</div>
							<div class="cal_height_width cal_head">Fri</div>
							<div class="cal_height_width cal_head">Sat</div>
						</div>
											
						<!--Start Days-->
						{section name=i loop=$days step=7}
						<div class="cal_main_div_a">
							{section name=j loop=$contor}
								{assign var="x" value=$smarty.section.i.index+$smarty.section.j.index}
									{if isset($days[$x].type) && ($days[$x].type == 0)}
									<div class="cal_height_width cal_style_2">{$days[$x].day}</div>
										{elseif $days[$x].type == 1}	
									<div class="cal_height_width cal_style_2">{$days[$x].day}</div>
										{elseif $days[$x].type == 2}	
									<div class="cal_height_width cal_style_3 style_pointer" id="{$days[$x].date}" onclick="select_day('{$days[$x].date}');SelectedMenus('{$smarty.get.tour_id}','{$days[$x].date}','{$sessionId[0]}');">{$days[$x].day}</div>
										{else}
									<div class="cal_height_width"></div>
									{/if}	
								{/section}	
							</div>
						{/section}
						<!--End-->
					</div>
				

			</div>
		</div> 
										
		<div class="calender_body_right" id="replace_div_time">
			<div class="departure_center_1">
				<div class="departure_time_1">Departure Time</div>
				<div class="time_1">09:00<input name="radiobutton" type="radio" value="radiobutton" /></div>
				<div class="time_1">11:00<input name="radiobutton" type="radio" value="radiobutton" /></div>
				<div class="time_1">12:00<input name="radiobutton" type="radio" value="radiobutton" /></div>
				<div class="time_1">13:00<input name="radiobutton" type="radio" value="radiobutton" /></div>
				<div class="time_1">14:00<input name="radiobutton" type="radio" value="radiobutton" /></div>
				<div class="time_1">15:00<input name="radiobutton" type="radio" value="radiobutton" /></div>
				<div class="time_1">16:00<input name="radiobutton" type="radio" value="radiobutton" /></div>
			</div>
		</div> 
	</div>
				<div class="booking_summary">
					<div class="style_step1_1">Number of People:{$order.order_tickets_number}</div>
					<div class="style_step2_1">Total Cost: <span class="profile_no2" id="total_cost">&pound;{$order.order_total}</span></div>
				</div>	
	
	<div class="booking_form_row booking_buttons clearfix">
		<div class="booking-button back-button"><a href="booking.php?tour_id={$tour_id}&amp;subpage=step1">Back</a></div>
		<div class="booking-button booking-submit"><a href="javascript:check_form();">Proceed</a></div>
	</div>
</div>
    </form>
 
											  <!--Form end -->

											</div>
											<!--Include Right Menu-->
											{include file="utils/site_right_menu_booking_sub.tpl" }
											<!--END-->
										  </div>
		{if !empty($order.order_date)}
		<script language="javascript">
		<!--
			select_day('{$order.order_date}');
			SelectedMenus('{$smarty.get.tour_id}','{$order.order_date}','{$sessionId[0]}')
		-->
		</script>
		{/if}	
		
