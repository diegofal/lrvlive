							<div class="lr_body float_left">
								<div class="lr_left_r1_desc">
								<div class="booking_left_r1_top">&nbsp;</div>
								  <!--Description start -->
								  <div class="booking_left_r1_middle_desc">
								  <div class="style_voucher_details">
									<div class="style_tour_details_123"><h2 class="ab_text_1">Voucher Details</h2></div>	
									<div class="dOrange">{$voucher.voucher_discount} % Off</div>
									<div class="style_tour_details_2">
									 <div class="style_tour_details_3"><h2 class="ab_text_1">{$tour.tour_name}</h2></div>
									 <div class="style_tour_details_4"></div>
									 <div class="style_tour_details_5 text_4">{$tour.tour_full_description}</div>
									</div>	
								  </div>
								 <div class="style_tour_details18"><img src="img/fline.gif" width="515"></div>
								  <div class="clear_both"></div>
								   <div class="style_tour_details19">
									  <div class="bokking_form_middle2">
											<div class="ticket_type_body2">
												<div><a href="booking.php?subpage=vouchers"><img src="images/back_butten.jpg" title="back" border="0"  /></a></div>
											</div>
											<div class="quantity_body1_desc">
												<div class="ticket_text2">&nbsp;</div>
											</div>
											<div class="price_body1">
												<div class="comtinue_1">
													<a href="booking.php?voucher_id={$voucher.voucher_id}&subpage=voucher_step1"><img src="images/continue_butten.jpg" title="Continue" border="0" /></a>
												</div>
											</div>
										</div>
									</div>
								  </div>
								  <div class="booking_left_r1_bottom" style="clear:both;">&nbsp;</div>	
								</div>
										<div class="lr_right_r1">
												<div><img src="img/tours/thumb/{$tour.tour_big_image}" alt="" class="style_border2"/></div>
													<div>&nbsp;</div>
													<div style="clear:both"></div>
													<div style=" float:left;width:398px; text-align:center;">
													{if $image1}
														<div style="float:left;width:130px;"><a href="img/tours/large/{$tour.tour_image1}" rel="lightbox[roadtrip]"><img src="img/tours/thumb/{$tour.tour_image1}" alt="" class="selectpic style_border2"></a></div>
													{/if}	
													{if $image2}
														<div style="float:left;width:130px;"><a href="img/tours/large/{$tour.tour_image2}" rel="lightbox[roadtrip]"><img src="img/tours/thumb/{$tour.tour_image2}" alt="" class="selectpic style_border2"></a></div>
													{/if}	
													{if $image3}
														<div style="float:left;width:130px;"><a href="img/tours/large/{$tour.tour_image3}" rel="lightbox[roadtrip]"><img src="img/tours/thumb/{$tour.tour_image3}" alt="" class="selectpic style_border2"></a></div>
													</div>
													{/if}
											  <div>
											    <div style="clear:both"></div>
											  <div class="ultimate_1">
														<div class="ultimate_top1_nd1">
														<div class="ultimate_ticket_nd1">
														<div class="ultimate_ticket_child1_nd1">Ticket Type: </div>
														<div class="ultimate_ticket_child2_nd1">Prices:</div>
														</div></div>
														<div class="ultimate_middle1">
														<div class="ultimate2_main">
														<div class="ultimate2_main1">
														{section name=i loop=$tickets}
														<div class="ultimate_ticket_child1_nd1">
														<span class="ultimate_txt">{$tickets[i].ticket_type}</span></div>
														<div class="ultimate_ticket_child2_nd1"><span class="ultimate_txt">&pound;{$tickets[i].ticket_price}</span></div>
														{/section}
														<div class="ultimate_ticket_child1_nd1"> <span class="ultimate_txt_new">Special Offer:</span></div>
														<div class="ultimate_ticket_child2_nd1"><span class="ultimate_txt_new">Prices</span></div>
														{section name=i loop=$special_tickets}
														<div class="ultimate_ticket_child1_nd1">
														<span class="ultimate_txt">{$special_tickets[i].ticket_type}</span></div>
														<div class="ultimate_ticket_child2_nd1"><span class="ultimate_txt">&pound;{$special_tickets[i].ticket_price}</span></div>
														{/section}
														<div class="ultimate_ticket_child1_nd1"> <span class="ultimate_txt_new">Charter per hour:</span></div>
														<div class="ultimate_ticket_child2_nd1"><span class="ultimate_txt_new">&pound;{$tour.tour_charter_price}</span></div>
														<!--<div class="ultimate_ticket_child1_nd1"> <span class="ultimate_txt">Child (16 years &amp; under):</span></div>
														<div class="ultimate_ticket_child2_nd1"><span class="ultimate_txt">&pound;19.50</span></div>
														<div class="ultimate_ticket_child1_nd1"> <span class="ultimate_txt">Charte per hour: </span></div>
														<div class="ultimate_ticket_child2_nd1"><span class="ultimate_txt">&pound;365.00</span></div>-->
														</div>
														<div class="ultimate2_main2">
														  <a href="booking.php?tour_id={$tour_id}&subpage=step1" title="Book Online"><img src="images/book_online_btn_pak_nd1.jpg" alt="Book Online" border="0" title="Book Online" /></a> </div>
														</div>
													   </div>
														<div class="ultimate_bottom1"></div>
													</div>
											  </div>
											  </div>