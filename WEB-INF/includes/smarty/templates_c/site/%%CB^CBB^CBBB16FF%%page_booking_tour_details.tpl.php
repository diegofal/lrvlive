<?php /* Smarty version 2.6.25, created on 2015-06-13 14:32:47
         compiled from pages/page_booking_tour_details.tpl */ ?>
<div class="lr_body float_left">
	<div class="lr_left_r1">
		<div class="pep_left_r1_middle">
			<div class="style_tour_details">
				<h2 class="ab_text_1"><?php echo $this->_tpl_vars['tour']['tour_name']; ?>
</h2>
				<div class="style_tour_details_5 text_4"><?php echo $this->_tpl_vars['tour']['tour_full_description']; ?>
</div>
			</div>
		</div>
	</div>
	
	<div class="lr_right_r1">
		<div class="tour-main-pic"><img src="img/tours/thumb/<?php echo $this->_tpl_vars['tour']['tour_big_image']; ?>
" alt="<?php echo $this->_tpl_vars['tourTmp']['tour_big_image_altTitle']; ?>
" title="<?php echo $this->_tpl_vars['tourTmp']['tour_big_image_altTitle']; ?>
" class="style_border2"/></div>
											
			<div class="tour-small-pics">
				<?php if ($this->_tpl_vars['image1']): ?>
					<div><a href="img/tours/large/<?php echo $this->_tpl_vars['tour']['tour_image1']; ?>
" rel="lightbox[roadtrip]"><img src="img/tours/thumb/<?php echo $this->_tpl_vars['tour']['tour_image1']; ?>
" alt="" class="selectpic style_border2" /></a></div>
				<?php endif; ?>	
				<?php if ($this->_tpl_vars['image2']): ?>
					<div><a href="img/tours/large/<?php echo $this->_tpl_vars['tour']['tour_image2']; ?>
" rel="lightbox[roadtrip]"><img src="img/tours/thumb/<?php echo $this->_tpl_vars['tour']['tour_image2']; ?>
" alt="" class="selectpic style_border2" /></a></div>
				<?php endif; ?>	
				<?php if ($this->_tpl_vars['image3']): ?>
					<div><a href="img/tours/large/<?php echo $this->_tpl_vars['tour']['tour_image3']; ?>
" rel="lightbox[roadtrip]"><img src="img/tours/thumb/<?php echo $this->_tpl_vars['tour']['tour_image3']; ?>
" alt="" class="selectpic style_border2" /></a></div>
				<?php endif; ?>
			</div>
													
			
                <?php if ($this->_tpl_vars['tour']['tour_name'] != 'SKYFALL'): ?>      
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
							
							<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['tickets']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
								<div class="ultimate_ticket_child1_nd1">
									<span class="ultimate_txt"><?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_type']; ?>
:</span>
								</div>
								<div class="ultimate_ticket_child2_nd1">
									<span class="ultimate_txt">&pound;<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_price']; ?>
</span>
								</div>
							<?php endfor; endif; ?>
							
							<!--div class="ultimate_ticket_child1_nd1"> 
								<span class="ultimate_txt_new">Special Offer</span>
							</div>
														
							<div class="ultimate_ticket_child2_nd1">
								<span class="ultimate_txt_new">Prices</span>
							</div-->
														
                            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['special_tickets']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
							<div class="ultimate_ticket_child1_nd1">
								<span class="ultimate_txt"><?php echo $this->_tpl_vars['special_tickets'][$this->_sections['i']['index']]['ticket_type']; ?>
</span>
							</div>
							
							<div class="ultimate_ticket_child2_nd1">
								<span class="ultimate_txt">&pound;<?php echo $this->_tpl_vars['special_tickets'][$this->_sections['i']['index']]['ticket_price']; ?>
</span>
							</div>
							<?php endfor; endif; ?>
                                                          
							
							<?php if ($this->_tpl_vars['tour']['tour_name'] == 'Thames Barrier Explorers Voyage (80mins)'): ?> 
								
									<div class="ultimate_ticket_child1_nd1"> 
										<span class="ultimate_txt_new">Charter:</span>
									</div>
									
								<?php else: ?>
								<?php if ($this->_tpl_vars['tour']['tour_name'] != 'Spring has Sprung...'): ?>		
									<div class="ultimate_ticket_child1_nd1"> 
										<span class="ultimate_txt_new">Charter per :</span>
									</div>
								<?php endif; ?>	
							<?php endif; ?> 
							<?php if ($this->_tpl_vars['tour']['tour_name'] != 'Spring has Sprung...'): ?>									
									<div class="ultimate_ticket_child2_nd1">
										<span class="ultimate_txt_new">&pound;<?php echo $this->_tpl_vars['tour']['tour_charter_price']; ?>
</span>
									</div>             
							<?php endif; ?> 														
						</div>
                                                        
						<div class="booking-button-small">
							<a href="booking.php?tour_id=<?php echo $this->_tpl_vars['tour_id']; ?>
&amp;subpage=step1" title="Book Online"></a> 
						</div>
                                                         
					</div>
                                                        
				</div>
        <?php endif; ?>
                                                     
                                                
                                                                                                     
        <?php if ($this->_tpl_vars['tour']['tour_name'] != 'SKYFALL'): ?>                                        		
        <?php if ($this->_tpl_vars['tour']['tour_name'] != 'The Essential 2012 Experience'): ?>
        <?php if ($this->_tpl_vars['tour']['tour_name'] != 'Spring has Sprung...'): ?>
        <?php if ($this->_tpl_vars['tour']['tour_name'] != 'Thames Festival Blast'): ?>       
        <?php if ($this->_tpl_vars['tour']['tour_name'] != 'Jingle Bell Blast - December sailings only'): ?> 		


                                <!-- voucher box -->
											   <div class="our_boat_review_nd_1">
													<div class="voucher_bg_nd1">
														<div class="white_txt">Gift Vouchers: </div>
														<div class="ultimate2_main"><a href="booking.php?tour_id=<?php echo $this->_tpl_vars['tour_id']; ?>
&amp;voucher_id=<?php echo $this->_tpl_vars['vouchers'][0]['voucher_id']; ?>
&amp;subpage=tours" title="Purchase Online"></div>
														</div>
													</div>
												</div>
								<!-- end voucher box -->		
		
		<?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>                                                      
</div>
              