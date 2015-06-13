										<div class="lr_body float_left">
										  	<div class="lr_left_r1">
												<div class="booking_left_r1_top">&nbsp;</div>
											  <!--Form start -->
							  <div class="booking_left_r1_middle_rk">
							  <form name="step2" method="post" action="booking.php?tour_id={$tour_id}&subpage=step2">
							  <input name="selected_departure" type="hidden" value="" />
							  <input name="number_of_people" type="hidden" value="{$order.order_tickets_number}" />
							  <input name="price" type="hidden" value="" />
							  <div class="butten_body_1">
								<ul>
									<li ><a  href="booking.php?tour_id={$smarty.get.tour_id}&subpage=step1" class="how_many_1" title="How Many?"></a></li>
									<li><a href="booking.php?tour_id={$smarty.get.tour_id}&subpage=step2" class="date_1_visited" title="Date &amp; Time"></a></li>
									<li><a href="booking.php?tour_id={$smarty.get.tour_id}&subpage=step3" class="yourdetail_1_new" title="Your Details"></a></li>
									<li><a href="booking.php?tour_id={$smarty.get.tour_id}&subpage=step6" class="payment_1_new" title="Payment"></a></li>
								 </ul>
							    </div>
							    <div class="bookingtext_1"><p>Using the calendar below, please select a month and date you would like to book your ticket. Then choose what time you would like to depart.</p>
                                <p>If you are a party of over 8 and require a departure time that is not listed please call 020 7928 8933.</p></div>
								   <div class="bokking_form_mainbody">
								   		<div class="available_left1">
											<div class="darkblue_box"><img src="images/darkblue_box.jpg" alt="" /></div>
											<div class="darkblue_box_text">Tickets Available</div></div>
										<div class="available_center1">
											<div class="darkblue_box"><img src="images/lightblue_box.jpg" alt="" /></div>
											<div class="darkblue_box_text">Sold Out</div>
										</div>
										<div class="available_right1">
											<div class="darkblue_box"><img src="images/orange_box.jpg" alt="" /></div>
											<div class="darkblue_box_text">Day Selected</div>
										</div>
								   </div>
								 <div class="bokking_form_mainbody_rknew">
								   	<div class="calender_body_left_new">
										<div class="book_1top"></div>
										<div class="book_1middle float_left">
											<div class="select_month_1">Select a Month &amp; Day &nbsp;&nbsp;
											<input type="hidden" name="selected_date" value="" /><select name="month" class="booking-ddwn-length" onchange="select_month();">{section name=i loop=$months}<option value="{$months[i].departure_ym_date}" {if $months[i].departure_ym_date == $month} selected="selected" {/if}>{$months[i].departure_fm_date}</option>{/section}</select>
											</div>
											<div class="style_step2_2" align="center">
											<!--Start Calander-->
											<div class="cal_man_div">
												<div class="cal_height_width cal_style_1">Sun</div>
												<div class="cal_height_width cal_style_1">Mon</div>
												<div class="cal_height_width cal_style_1">Tue</div>
												<div class="cal_height_width cal_style_1">Wed</div>
												<div class="cal_height_width cal_style_1">Thu</div>
												<div class="cal_height_width cal_style_1">Fri</div>
												<div class="cal_height_width cal_style_1">Sat</div>
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
											<div class="clear_both"></div>
											<div class="profile_no padding_top10 float_left">
											 <div class="style_step1_1">Number of People:{$order.order_tickets_number}</div>
											 <div class="style_step2_1">Total Cost: <span class="profile_no2" id="total_cost">&pound;{$order.order_total}</span></div>
											</div>
										</div>
										<div class="clear_both"></div>
										<div class="book_1bottom"></div>
									</div> 
										<div class="calender_body_right" id="replace_div_time">
											<div class="departure_top_1"></div>
											<div class="departure_center_1">
												<div class="departure_time_1">Departure Time</div>
												<div class="time_1">09:00&nbsp;&nbsp;&nbsp;&nbsp; <input name="radiobutton" type="radio" value="radiobutton" /></div>
												<div class="time_1">11:00&nbsp;&nbsp;&nbsp;&nbsp; <input name="radiobutton" type="radio" value="radiobutton" /></div>
												<div class="time_1">12:00&nbsp;&nbsp;&nbsp;&nbsp; <input name="radiobutton" type="radio" value="radiobutton" /></div>
												<div class="time_1">13:00&nbsp;&nbsp;&nbsp;&nbsp; <input name="radiobutton" type="radio" value="radiobutton" /></div>
												<div class="time_1">14:00&nbsp;&nbsp;&nbsp;&nbsp; <input name="radiobutton" type="radio" value="radiobutton" /></div>
												<div class="time_1">15:00&nbsp;&nbsp;&nbsp;&nbsp; 
												  <input name="radiobutton" type="radio" value="radiobutton" /></div>
												<div class="time_1">16:00&nbsp;&nbsp;&nbsp;&nbsp; 
												  <input name="radiobutton" type="radio" value="radiobutton" /></div>
											</div>
											<div class="departure_bottom_1"></div>
										</div> 
								   </div>
								   <div style="clear:both; padding-top:20px;"></div>
								   <div class="bokking_form_middle2">
												<div class="ticket_type_body2">
													<div><a href="booking.php?tour_id={$tour_id}&subpage=step1"><img src="images/back_butten.jpg" title="back" border="0"/></a></div>
												</div>
												<div class="quantity_body1">
													<div class="ticket_text2">&nbsp;</div>
												</div>
												<div class="price_body1">
												  <div class="comtinue_1"><a href="javascript:check_form();"><img src="images/continue_butten.jpg" title="Continue" border="0"/></a></div>
												</div>
                                                
											</div>
							    </form>
                                <div style="clear:both;"></div>
							  </div>
											  <!--Form end -->
                                              
											  <div class="booking_left_r1_bottom">&nbsp;</div>	
											</div>
											<!--Include Right Menu-->
											{include file="utils/site_right_menu_booking.tpl" }
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
		
