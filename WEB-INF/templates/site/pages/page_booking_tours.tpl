<div class="lr_body style_min_height550">
						
	<div class="lr_left_r1">

		<div class="pep_left_r1_middle">
											  
			<h2 class="ab_text_1">Our Boat Trips</h2>
									  
			<div class="peop_r2 b_txt14">Select from the options below which ticket or voucher you would like to purchase.</div>
											 
			<div class="boat_list_mt">
												
			<!--First Tour-->	
			{section name=k loop=6 start=1}
			{if $Tour_Trip[k].tour_home_name1 ne ""}
				<div class="b_sub_main" >
					<div class="b_midn">
				
						<div class="b_mid_main">
																
							<div class="b_ulti">{$Tour_Trip[k].tour_home_name1}</div>
															
							<div class="b_ul_pic">
								<a style="background-image:url(img/tours/thumb/{$Tour_Trip[k].tour_big_image});" href="booking.php?tour_id={$Tour_Trip[k].tour_id}&amp;subpage=tour_details" title="{$Tour_Trip[k].tour_home_name1}">
								<!--img src="img/tours/thumb/{$Tour_Trip[k].tour_big_image}" alt="{$Tour_Trip[k].tour_home_name1}" width="180" height="180" /--></a>
							</div>
																
							<div class="b_ul_pic_main_r">
																	
								<div class="b_ut_txt1">{$Tour_Trip[k].tour_tickets[0].ticket_type}:</div>
								<div class="b_ut_txt2">&pound;{$Tour_Trip[k].tour_tickets[0].ticket_price}</div>
								
								{if $Tour_Trip[k].tour_home_name1 ne 'Spring has Sprung...'}
								<div class="b_ut_txt1">Children <span class="smaller">(14 years &amp; under)</span>:</div>
								{/if}
								<div class="b_ut_txt2">&pound;{$Tour_Trip[k].tour_tickets[1].ticket_price}</div>
								
								
									<div class="book-button-vouchers">
										<div class="book-button-medium"><a href="booking.php?tour_id={$Tour_Trip[k].tour_id}&amp;subpage=step1" title="BOOK ONLINE"></a></div>
									{if $Tour_Trip[k].tour_home_name1 ne 'Jingle Bell Blast'}											
									{if $Tour_Trip[k].tour_home_name1 ne 'Beefeater Blast'}	
									{if $Tour_Trip[k].tour_home_name1 ne 'Spring has Sprung...'}										
										<div class="b_ut_btn2">OR</div>
										<div class="vouchers-spread"><a href="booking.php?tour_id={$Tour_Trip[k].tour_id}&amp;voucher_id={$Tour_Trip[k].voucher_id}&amp;subpage=voucher_step1" title="Purchase Voucher"></a></div>
									{/if}
									{/if}
									{/if}
									</div>
								
							</div>
																
						</div>
					
					</div>
					
				</div>
				{/if}								
				{/section}
				
				<!-- London Edge -->
				
				<div class="b_sub_main" >
					<div class="b_midn">
				
						<!--div class="b_mid_main">
																
							<div class="b_ulti">London Edge Sky Ride Experience</div>
															
							<div class="b_ul_pic">
								<a style="background-image:url(img/tours/thumb/20_tour_big_image_1396568482.jpg);" href="booking.php?tour_id=20&amp;subpage=tour_details" title="{$Tour_Trip[k].tour_home_name1}"></a>
							</div>
																
							<div class="b_ul_pic_main_r">
							
							<div class="charters-details">					
								<p>Book Now by calling us on 0207 928 8933.</p>
								<div class="more-info-button">
								<a href="booking.php?tour_id=20&amp;subpage=tour_details" title="More Info" style="float:right;"></a>
								</div>
							</div>
							
							</div>
																
						</div-->
					
					</div>
					
				</div>
				
				<!-- end London Edge -->
											
			</div>
	
		</div>
											  
	</div>
											
											
											<div class="lr_right_r1">
												<div>
                                                <a href="http://www.londonribvoyages.com/booking.php?tour_id=12&subpage=tour_details" target="_self">
                                                <img class="main-image" src="images/tours-home-main.png" alt="" width="390" height="260" border="0" />
                                                </a>
                                                </div>
											

											                                          
                                <!-- voucher box -->
											   <div class="our_boat_review_nd_1">
													<div class="voucher_bg_nd1">
														<div class="white_txt">Gift Vouchers: </div>
														<div class="voucher_main"><a href="booking.php?subpage=tours"></a></div>
													</div>
												</div>
								<!-- end voucher box -->				
											</div>
								
                                                
										   </div>    
										</div>