<?php /* Smarty version 2.6.25, created on 2015-06-13 14:36:45
         compiled from pages/page_booking_tours.tpl */ ?>
<div class="lr_body style_min_height550">
						
	<div class="lr_left_r1">

		<div class="pep_left_r1_middle">
											  
			<h2 class="ab_text_1">Our Boat Trips</h2>
									  
			<div class="peop_r2 b_txt14">Select from the options below which ticket or voucher you would like to purchase.</div>
											 
			<div class="boat_list_mt">
												
			<!--First Tour-->	
			<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['start'] = (int)1;
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
if ($this->_sections['k']['start'] < 0)
    $this->_sections['k']['start'] = max($this->_sections['k']['step'] > 0 ? 0 : -1, $this->_sections['k']['loop'] + $this->_sections['k']['start']);
else
    $this->_sections['k']['start'] = min($this->_sections['k']['start'], $this->_sections['k']['step'] > 0 ? $this->_sections['k']['loop'] : $this->_sections['k']['loop']-1);
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = min(ceil(($this->_sections['k']['step'] > 0 ? $this->_sections['k']['loop'] - $this->_sections['k']['start'] : $this->_sections['k']['start']+1)/abs($this->_sections['k']['step'])), $this->_sections['k']['max']);
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
			<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1'] != ""): ?>
				<div class="b_sub_main" >
					<div class="b_midn">
				
						<div class="b_mid_main">
																
							<div class="b_ulti"><?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1']; ?>
</div>
															
							<div class="b_ul_pic">
								<a style="background-image:url(img/tours/thumb/<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_big_image']; ?>
);" href="booking.php?tour_id=<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_id']; ?>
&amp;subpage=tour_details" title="<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1']; ?>
">
								<!--img src="img/tours/thumb/<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_big_image']; ?>
" alt="<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1']; ?>
" width="180" height="180" /--></a>
							</div>
																
							<div class="b_ul_pic_main_r">
																	
								<div class="b_ut_txt1"><?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_tickets'][0]['ticket_type']; ?>
:</div>
								<div class="b_ut_txt2">&pound;<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_tickets'][0]['ticket_price']; ?>
</div>
								
								<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1'] != 'Spring has Sprung...'): ?>
								<div class="b_ut_txt1">Children <span class="smaller">(14 years &amp; under)</span>:</div>
								<?php endif; ?>
								<div class="b_ut_txt2">&pound;<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_tickets'][1]['ticket_price']; ?>
</div>
								
								
									<div class="book-button-vouchers">
										<div class="book-button-medium"><a href="booking.php?tour_id=<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_id']; ?>
&amp;subpage=step1" title="BOOK ONLINE"></a></div>
									<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1'] != 'Jingle Bell Blast'): ?>											
									<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1'] != 'Beefeater Blast'): ?>	
									<?php if ($this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1'] != 'Spring has Sprung...'): ?>										
										<div class="b_ut_btn2">OR</div>
										<div class="vouchers-spread"><a href="booking.php?tour_id=<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_id']; ?>
&amp;voucher_id=<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['voucher_id']; ?>
&amp;subpage=voucher_step1" title="Purchase Voucher"></a></div>
									<?php endif; ?>
									<?php endif; ?>
									<?php endif; ?>
									</div>
								
							</div>
																
						</div>
					
					</div>
					
				</div>
				<?php endif; ?>								
				<?php endfor; endif; ?>
				
				<!-- London Edge -->
				
				<div class="b_sub_main" >
					<div class="b_midn">
				
						<!--div class="b_mid_main">
																
							<div class="b_ulti">London Edge Sky Ride Experience</div>
															
							<div class="b_ul_pic">
								<a style="background-image:url(img/tours/thumb/20_tour_big_image_1396568482.jpg);" href="booking.php?tour_id=20&amp;subpage=tour_details" title="<?php echo $this->_tpl_vars['Tour_Trip'][$this->_sections['k']['index']]['tour_home_name1']; ?>
"></a>
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