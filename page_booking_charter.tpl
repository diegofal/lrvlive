							<div class="lr_body float_left">
								<div class="lr_left_r1">
												<div class="online_1_lr_left_r1_top"></div>
													<div class="online_1_lr_left_r1_middle">
													<!--Package Div Starts Here-->
													<div class="style_tours_2">
													<div class="style_tours_3">
													<h2 class="ab_text_1">Charters</h2>
													</div>		
													<!--First Div-->
													{section name=i loop=$packages}														
													<div class="online_1_main_body">
                                                    
                                                    <div style="width:175px; height:168px; margin:0 5px 0 0; padding:0; float:left; background:url(images/row_imgbg4.gif) 3px top no-repeat;">
            <div class="our_boat_image_nd1 style_pointer" onclick="window.location.href='booking.php?package_id={$packages[i].package_id}&amp;subpage=package_details'">
           <div class="imagerow_image_two1">
           <img src="img/packages/thumb/{$packages[i].package_home_image}" alt="{$packagesTmp[i].package_name}" title="{$packagesTmp[i].package_name}"/>
           </div>
			<!--div class="imagerow_image_one_text">
            {$packagesTmp[i].package_name}<br />
            From&nbsp;&pound;{$tours[$content.page_link2].tour_tickets[0].ticket_price}
            </div-->
            <div class="imagerow_image_one_text">
            {$packagesTmp[i].package_name}<br />
            </div>
		</div>
	</div> 
                                                    
	<div style="width:340px; float:left; font:normal 11px Arial, Helvetica, sans-serif; color:#666666; line-height:15px;">
		<h2 class="online_1_hed_text_p1">{$packages[i].package_name}</h2>
        	<div class="text_4" style="margin-left:10px;">
            <a href="booking.php?package_id={$packages[i].package_id}&amp;subpage=package_details" title="More Info" style="float:right;"><img src="images/more-info-button.png" alt="More Info" border="0" width="58" height="59" style="margin:5px 0 10px 10px;" />
             </a>{$packages[i].package_short_description}
             <div class="our_boat_pak_nd1" style="float:left;">
             
             </div>
    </div>
</div>
													
													
													</div>
													{/section}
													</div>
													<!--END-->	
													</div>
													<div class="online_1_lr_left_r1_bottom"></div>	
											</div>
											<div class="lr_right_r1">
												<div><img src="images/charter-main.png" alt="" width="401" height="231" /></div>
                                                
                                              
                                                
													<div>&nbsp;</div>
											  <div class="our_boat_main">
													  <div class="our_boat_nd1">
                                                        <div class="imagerow_image_one1 style_pointer" onclick="window.location.href='booking.php?tour_id={$tours[$TourId_0].tour_id}&amp;subpage=tour_details'"><img src="img/tours/thumb/{$tours[$TourId_0].tour_home_image}"  alt="{$tours[$TourId_0].tour_home_name1}" title="{$tours[$TourId_0].tour_home_name1}" /></div>
													    <div class="imagerow_image_one_text">{$tours[$TourId_0].tour_home_name1}<br />
                                                        {if $TourId_0 ne '12'}
                                                        {if $TourId_0 ne '16'}
                                                        From&nbsp;&pound;{$tours[$TourId_0].tour_tickets[0].ticket_price}
                                                        {/if}
                                                        {/if}
                                                        </div>
													    <div class="book_now_pak_2"><a href="booking.php?tour_id={$tours[$TourId_0].tour_id}&amp;subpage=tour_details" title="More Info"><img src="images/book-now-button.png" alt="More Info" border="0" width="61"  height="61"/></a></div>
												      </div>
													  <div class="our_boat_nd1">
                                                        <div class="our_boat_image_nd1 style_pointer" onclick="window.location.href='booking.php?tour_id={$tours[$TourId_1].tour_id}&amp;subpage=tour_details'"><div class="imagerow_image_two1"><img src="img/tours/thumb/{$tours[$TourId_1].tour_home_image}"  alt="{$tours[$TourId_1].tour_home_name1}" title="{$tours[$TourId_1].tour_home_name1}"/></div>
													    <div class="imagerow_image_one_text">{$tours[$TourId_1].tour_home_name1}<br />
                                                         {if $TourId_1 ne '12'}
                                                        {if $TourId_1 ne '16'}
                                                        From&nbsp;&pound;{$tours[$TourId_1].tour_tickets[0].ticket_price}
                                                         {/if}
                                                        {/if}
                                                        </div>
													    <div class="our_boat_pak_nd1"><a href="booking.php?tour_id={$tours[$TourId_1].tour_id}&amp;subpage=tour_details" title="Book Now"><img src="images/book-now-button.png" alt="BOOK ONLINE" border="0"  width="61"  height="61" /></a></div>
											    </div>
													</div>
											  <div>
											   <div class="our_boat_review_nd_1" style="height:180px;">
														<div class="voucher_bg_nd1">
														<div class="white_txt">Gift Vouchers: </div>
													<div class="ultimate2_main">
													  <div class="purchase2_main2"><img src="images/purchase_nd1.jpg" alt="Purchase Online" width="87" height="86" border="0" title="Purchase Online" /></div>
													</div>
														</div>
												</div>
                                                
                                                            <div style="clear:both"></div>                                    
  <!--div class="ultimate_1">
			<div class="ultimate_top1_nd1">
					<div class="ultimate_ticket_nd1">
							<div class="ultimate_ticket_child1_nd1">Christmas Vouchers</div>
					</div>
            </div>
			<div class="ultimate_middle1" style="height:70px;">
				<div class="ultimate2_main">
					<div class="ultimate2_main1" style="width:360px;">
						<div class="ultimate_ticket_child1_nd1" style="width:220px;">
                            <span class="ultimate_txt" style="font-size:12px;line-height:15px;">Last date for delivered vouchers sent directly to your home:</span>
                            <span class="ultimate_txt" style="font-size:12px;padding-top:10px;line-height:15px;">Last date for electronic vouchers sent directly to your email:</span>
						</div>
                        <div class="ultimate_ticket_child2_nd1" style="width:138px;">
                            <span class="ultimate_txt" style="font-size:12px;font-weight:bold;line-height:15px;">19th December 2011</span>
                            <span class="ultimate_txt" style="font-size:12px;font-weight:bold;padding-top:25px;line-height:15px;">22nd December 2011</span>
                         </div>								
					</div>
				</div>
			</div>
			<div class="ultimate_bottom1"></div>
	</div-->
										      </div>
											  </div></div>
                                             