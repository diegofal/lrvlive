<div class="lr_body float_left charter-list">
	
	<div class="lr_left_r1">
		
		<div class="pep_left_r1_middle">
		
		<!--Package Div Starts Here-->
		<div class="style_tours_2">
			
			<h2 class="ab_text_1">Charters</h2>
			
			<!--First Div-->
			{section name=i loop=$packages}	
			
			<div class="b_sub_main" >
				
				<div class="b_midn">
														
					<div class="b_mid_main" onclick="window.location.href='booking.php?package_id={$packages[i].package_id}&amp;subpage=package_details'">
						<div class="charter-title">
							<h2 class="b_ulti">{$packages[i].package_name}</h2>
							<div class="charter-home-price">
								{if $packages[i].package_name == 'Ultimate London Adventure'}
								From&nbsp;&pound;405
								{/if}
								{if $packages[i].package_name == 'Pirates of the Thames'}
								From&nbsp;&pound;450
								{/if}
								{if $packages[i].package_name == 'Private Charter Speedboats'}
								From&nbsp;&pound;405
								{/if}
							</div>
						</div>
						<div class="b_ul_pic">
						{if $packages[i].package_name == 'Ultimate London Adventure'}
							<a href="booking.php?tour_id=9&subpage=tour_details" style="background-image:url(img/packages/thumb/{$packages[i].package_home_image});"></a>
						{else}
							<a href="booking.php?package_id={$packages[i].package_id}&amp;subpage=package_details" style="background-image:url(img/packages/thumb/{$packages[i].package_home_image});"></a>
						{/if}
			</div>
						<div class="charters-details">
							
							<p>{$packages[i].package_short_description}</p>
							<div class="more-info-button">
						{if $packages[i].package_name == 'Ultimate London Adventure'}
							<a href="booking.php?tour_id=9&subpage=tour_details"></a>
						{else}
							<a href="booking.php?package_id={$packages[i].package_id}&amp;subpage=package_details"></a>
						{/if}</div>
						
						</div>

					</div>
			</div>
		</div>
	{/section}
              
			<!-- package -->			  
			<div class="b_sub_main" >
				
				<div class="b_midn">
														
					<div class="b_mid_main"  onclick="window.location.href='stag_and_hen.php'">
						<h2 class="b_ulti">Stag and Hen Party Celebrations</h2>
						<div class="b_ul_pic">
						<img src="images/stag-hen-charter.jpg" alt="Stag and Hen Parties" height="170" width="170" title="Stag and Hen Parties"/>
						</div>
											
						<div class="charters-details">
							<p>
								 This stylish River Thames boat trip for your pending bride or groom is the way to go! We can offer you and your stag or hen party the ultimate London adventure &ndash; and you can top off your boat trip on the Thames with a slap up lunch or evening meal at a local pier side pub or restaurant &ndash; just ask for our recommendations regarding the best place to score some top nosh, we really are spoilt for choice at our exclusive London Eye location. 
							</p>
							<div class="more-info-button">	 
								<a href="stag_and_hen.php" title="More Info" style="float:right;"></a>
							</div>
						</div>
					</div>                                                    
				</div>
			</div>   
            <!-- end package -->
			
			<!-- package -->
			<div class="b_sub_main" >
				
				<div class="b_midn">
														
					<div class="b_mid_main">
						<h2 class="b_ulti">The London RIB EYE</h2>
						<div class="b_ul_pic">
						<img src="images/london-rib-charter.jpg" alt="Stag and Hen Parties" height="170" width="170" title="Stag and Hen Parties"/>

						</div>
						<div class="charters-details">					
						<p>&lsquo;The London RIB EYE&rsquo; is our all-you-can-eat package! Take a London RIB Voyages high speed river cruise followed by a flight in the world famous London Eye. Ideal for parties of 12 or more and perfect for all special occasions. Fill yourself up on this unique London sightseeing experience with a twist&hellip;</p>
						<p><strong>Call 0207 928 8933 to book.</strong></p>
								<!--div class="more-info-button">
								<a href="booking.php?tour_id=12&subpage=tour_details" title="More Info" style="float:right;"></a>
								</div-->
						</div>
						
					</div> 

				</div>
			</div>
			<!-- end package -->
			
			
		</div>                                                  
                                                    
	</div>

</div>

											
<!-- right -->											

<div class="lr_right_r1">
	<div class="main-image"><img src="images/london-RIB-charters-main.png" alt="London RIB Charters"  /></div>
	<div class="main-image"><img src="images/london-RIB-charters-main2.png" alt="London RIB Charters"  /></div>
	<div class="main-image"><img src="images/london-RIB-charters-main3.png" alt="London RIB Charters"  /></div>
	<div class="main-image"><img src="images/london-RIB-charters-main4.png" alt="London RIB Charters"  /></div>
	<div class="main-image"><img src="images/london-RIB-charters-main5.png" alt="London RIB Charters"  /></div>
</div>

</div>
                                             