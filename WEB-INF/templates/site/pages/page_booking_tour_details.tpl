<div class="lr_body float_left">
	<div class="lr_left_r1">
		<div class="pep_left_r1_middle">
			<div class="style_tour_details">
				<h2 class="ab_text_1">{$tour.tour_name}</h2>
				<div class="style_tour_details_5 text_4">{$tour.tour_full_description}</div>
			</div>
		</div>
	</div>
	
	<div class="lr_right_r1">
		<div class="tour-main-pic"><img src="img/tours/thumb/{$tour.tour_big_image}" alt="{$tourTmp.tour_big_image_altTitle}" title="{$tourTmp.tour_big_image_altTitle}" class="style_border2"/></div>
											
			<div class="tour-small-pics">
				{if $image1}
					<div><a href="img/tours/large/{$tour.tour_image1}" rel="lightbox[roadtrip]"><img src="img/tours/thumb/{$tour.tour_image1}" alt="" class="selectpic style_border2" /></a></div>
				{/if}	
				{if $image2}
					<div><a href="img/tours/large/{$tour.tour_image2}" rel="lightbox[roadtrip]"><img src="img/tours/thumb/{$tour.tour_image2}" alt="" class="selectpic style_border2" /></a></div>
				{/if}	
				{if $image3}
					<div><a href="img/tours/large/{$tour.tour_image3}" rel="lightbox[roadtrip]"><img src="img/tours/thumb/{$tour.tour_image3}" alt="" class="selectpic style_border2" /></a></div>
				{/if}
			</div>
													
			
                {if $tour.tour_name ne 'SKYFALL'}      
				<div class="ultimate_1">
					<div class="ultimate_top1_nd1">
						<div class="ultimate_ticket_nd1">
                            <div class="ultimate_ticket_child1_nd1">Ticket Type</div>
							<div class="ultimate_ticket_child2_nd1">Prices</div>
						</div>
					</div>
					
					<div class="ultimate_middle1">
						<div class="ultimate2_main">
							<div class="ultimate2_main1">
							
							{section name=i loop=$tickets}
								<div class="ultimate_ticket_child1_nd1">
									<span class="ultimate_txt">{$tickets[i].ticket_type}:</span>
								</div>
								<div class="ultimate_ticket_child2_nd1">
									<span class="ultimate_txt">&pound;{$tickets[i].ticket_price}</span>
								</div>
							{/section}
							
							<!--div class="ultimate_ticket_child1_nd1"> 
								<span class="ultimate_txt_new">Special Offer</span>
							</div>
														
							<div class="ultimate_ticket_child2_nd1">
								<span class="ultimate_txt_new">Prices</span>
							</div-->
														
                            {section name=i loop=$special_tickets}
							<div class="ultimate_ticket_child1_nd1">
								<span class="ultimate_txt">{$special_tickets[i].ticket_type}</span>
							</div>
							
							<div class="ultimate_ticket_child2_nd1">
								<span class="ultimate_txt">&pound;{$special_tickets[i].ticket_price}</span>
							</div>
							{/section}
                                                          
							
							{if $tour.tour_name == 'Thames Barrier Explorers Voyage (80mins)'} 
								
									<div class="ultimate_ticket_child1_nd1"> 
										<span class="ultimate_txt_new">Charter:</span>
									</div>
									
								{else}
								{if $tour.tour_name ne 'Spring has Sprung...'}		
									<div class="ultimate_ticket_child1_nd1"> 
										<span class="ultimate_txt_new">Charter per :</span>
									</div>
								{/if}	
							{/if} 
							{if $tour.tour_name ne 'Spring has Sprung...'}									
									<div class="ultimate_ticket_child2_nd1">
										<span class="ultimate_txt_new">&pound;{$tour.tour_charter_price}</span>
									</div>             
							{/if} 														
						</div>
                                                        
						<div class="booking-button-small">
							<a href="booking.php?tour_id={$tour_id}&amp;subpage=step1" title="Book Online"></a> 
						</div>
                                                         
					</div>
                                                        
				</div>
        {/if}
                                                     
                                                
                                                                                                     
        {if $tour.tour_name ne 'SKYFALL'}                                        		
        {if $tour.tour_name ne 'The Essential 2012 Experience'}
        {if $tour.tour_name ne 'Spring has Sprung...'}
        {if $tour.tour_name ne 'Thames Festival Blast'}       
        {if $tour.tour_name ne 'Jingle Bell Blast - December sailings only'} 		


                                <!-- voucher box -->
											   <div class="our_boat_review_nd_1">
													<div class="voucher_bg_nd1">
														<div class="white_txt">Gift Vouchers: </div>
														<div class="ultimate2_main"><a href="booking.php?tour_id={$tour_id}&amp;voucher_id={$vouchers[0].voucher_id}&amp;subpage=tours" title="Purchase Online"></div>
														</div>
													</div>
												</div>
								<!-- end voucher box -->		
		
		{/if}
        {/if}
        {/if}
        {/if}
        {/if}                                                      
</div>
              