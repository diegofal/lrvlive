<?php /* Smarty version 2.6.25, created on 2015-06-13 14:01:30
         compiled from booking/page_calendar_bookings.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'booking/page_calendar_bookings.tpl', 76, false),array('modifier', 'truncate', 'booking/page_calendar_bookings.tpl', 98, false),array('function', 'cycle', 'booking/page_calendar_bookings.tpl', 154, false),)), $this); ?>
      <table width="850" border="0" cellspacing="0" cellpadding="0" id="main-content">
      <tr>
        <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="txt-side">This page shows the online  booking activity for the selected day. <br>
              <br>
              Customers that purchased tickets for each trip are shown by clicking &quot;View Bookings&quot;. </td>
          </tr>
          <tr>
            <td class="txt-side">&nbsp;</td>
          </tr>
          <tr>
            <td class="txt-side"><strong>The Icons: </strong></td>
          </tr>
          <tr>
            <td class="txt-side"><img src="images/spacer.gif" width="10" height="5"></td>
          </tr>
          <tr>
            <td class="txt-side">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/add_16.gif" alt="Add Booking" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Add Booking  </td>
                </tr>
              </table>	
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/config_clock_16.gif" alt="Relocate Ticket" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Edit Ticket</td>
                </tr>
              </table>	
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/clock_16.gif" alt="Relocate Ticket" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Relocate Ticket</td>
                </tr>
              </table>					  
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/del_16.gif" alt="Delete Booking" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Delete Ticket</td>
                </tr>
              </table>				  
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="13%"><img src="images/icons/lock_ok_16.gif" alt="Mark Ticket  as Used" width="16" height="16" vspace="2"></td>
                <td width="87%" class="txt-side">Mark Ticket  as Used </td>
              </tr>
            </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/lock_16_dis.gif" alt="Ticket Used" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Ticket Used</td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/mail_info_16.gif" alt="View Ticket" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">View Ticket   </td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/icon_email_16.gif" alt="Email confirmation status" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Resend email confirmation</td>
                </tr>
              </table>              
              </td>
          </tr>
        </table>
          </td>
        <td width="630" class="dotted-border content-padding2">
          <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td width="67%"><div align="center" class="calendar-monthtxt">
                  <div align="left">Bookings for <?php echo ((is_array($_tmp=$this->_supers['get']['day'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %d, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %d, %Y")); ?>
</div>
                </div></td>
                <td width="30%"><div align="right" class="txt-side"><a href="calendar.php?subpage=calendar&month=<?php echo $this->_supers['session']['sess_month']; ?>
" id="submenu">Back to calendar</a>&nbsp;</div></td>
                <td width="3%"><div align="right"><span class="txt-side"><img src="images/icons/calendar_back_16.gif" alt="Back to calendar" width="16" height="16" vspace="3"></span></div></td>
              </tr>
          </table>
          <br>

            <table width="100%" border="0" cellpadding="0" cellspacing="1" class="outline-grey">
              <tr>
                <td width="20%" <?php echo $this->_tpl_vars['head']['departure_tour_id']; ?>
</td>
                <td width="10%" <?php echo $this->_tpl_vars['head']['departure_time']; ?>
</td>
                <td width="25%" <?php echo $this->_tpl_vars['head']['boat_name']; ?>
</td>
                <td width="15%" class="table-header">Reservations</td>
                <td colspan="2" width="30%" class="table-header">&nbsp;</td>
              </tr>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['departures']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			  <?php $this->assign('tour_id', $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_tour_id']); ?>
			  <?php $this->assign('depart_id', $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id']); ?>
  			 
			 <tr bgcolor="<?php echo $this->_tpl_vars['tour_colours'][$this->_tpl_vars['tour_id']]; ?>
" id="colapse_<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id']; ?>
"  <?php if ($this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id'] == $this->_supers['get']['id']): ?>style="display:none;"<?php endif; ?>>
                <td class="table-line"><?php echo $this->_tpl_vars['tour_names'][$this->_tpl_vars['tour_id']]; ?>
</td>
				<td class="table-line"><?php echo ((is_array($_tmp=$this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_time'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5, "") : smarty_modifier_truncate($_tmp, 5, "")); ?>
</td>
                <td class="table-line"><?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['boat_name']; ?>
 (<?php if ($this->_tpl_vars['departures'][$this->_sections['i']['index']]['boat_del'] == 0): ?>Yes<?php else: ?>No<?php endif; ?>)</td>
                <td class="table-line"><?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['reserved']; ?>
 / <?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['boat_passengers']; ?>
 </td>
                <td class="table-line"><div align="center">
					<?php if ($this->_tpl_vars['departures'][$this->_sections['i']['index']]['reserved'] == 0): ?>
					<div align="center">--- </div>
					<?php else: ?>
					<a href="javascript:expand(<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id']; ?>
)" id="submenu"><strong>View Bookings</strong></a> 
					<?php endif; ?>
					</div>
				</td>
                <td class="table-line"><div align="right">
			     <?php if ($this->_tpl_vars['information_arr'][$this->_tpl_vars['tour_id']][$this->_tpl_vars['depart_id']]['skipper'] == "" || $this->_tpl_vars['information_arr'][$this->_tpl_vars['tour_id']][$this->_tpl_vars['depart_id']]['guide'] == ""): ?>
					<a href="javascript:void(0)" onClick="window.open('skipper_guide_detail.php?tour_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_tour_id']; ?>
&dep_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id']; ?>
&cur_date=<?php echo $this->_tpl_vars['select_date']; ?>
','MyPopUp','width=400,height=450,toolbar=0,scrollbars=1,screenX=10,screenY=10')" class="txt-side_book" title="Choose Skipper">
					<img src="images/icons/addskipper.gif" width="16" height="16" border="0" title="Add Skipper/Guide"></a>&nbsp;
					<?php endif; ?>
					<?php if ($this->_tpl_vars['departures'][$this->_sections['i']['index']]['reserved'] < $this->_tpl_vars['departures'][$this->_sections['i']['index']]['boat_passengers'] && $this->_tpl_vars['departures'][$this->_sections['i']['index']]['boat_del'] == 0): ?>
					<a href="javascript:openwind('make_booking.php?option=resellers&tour_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_tour_id']; ?>
&departure_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id']; ?>
&free=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['boat_passengers']-$this->_tpl_vars['departures'][$this->_sections['i']['index']]['blocked']; ?>
', 600, 500, 'yes')"><img src="images/icons/add_16.gif" width="16" height="16" border="0"></a>
					<?php else: ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
				</div>
				</td>				
              </tr>
			  
			 
			<?php if ($this->_tpl_vars['departures'][$this->_sections['i']['index']]['reserved'] != 0): ?>
              <tr <?php if ($this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id'] != $this->_supers['get']['id']): ?>style="display:none;"<?php endif; ?> id="expand_<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id']; ?>
">
                <td colspan="6" bgcolor="#F0F5FD" class="outline-bluish book-list-back">
				  <img src="images/spacer.gif" width="10" height="3">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="81%" class="book-list-header"><span class="style1"><?php echo $this->_tpl_vars['tour_names'][$this->_tpl_vars['tour_id']]; ?>
 | <?php echo ((is_array($_tmp=$this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_time'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5, "") : smarty_modifier_truncate($_tmp, 5, "")); ?>
 | <?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['boat_name']; ?>
&nbsp; |&nbsp; <?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['reserved']; ?>
 seats out of <?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['boat_passengers']; ?>
&nbsp; | Total: &pound;<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['total_price']; ?>
</span></td>
                    <td width="19%" nowrap class="book-list-header"><div align="right"><a href="javascript:colapse(<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id']; ?>
)" id="submenu">Close expanded view </a></div></td>
                  </tr>
                 </table>
                  <img src="images/spacer.gif" width="10" height="8"><br>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="table-line"><strong>Code</strong></td>
                    <td class="table-line"><strong>Client</strong></td>
                    <td class="table-line"><strong>Seats</strong></td>
                    <td class="table-line"><strong>Amount</strong></td>
					<td class="table-line"><strong>Reseller</strong></td>
                    <td class="table-line"><div align="right">
					<?php if ($this->_tpl_vars['information_arr'][$this->_tpl_vars['tour_id']][$this->_tpl_vars['depart_id']]['skipper'] == "" || $this->_tpl_vars['information_arr'][$this->_tpl_vars['tour_id']][$this->_tpl_vars['depart_id']]['guide'] == ""): ?>
					<a href="javascript:void(0)" onClick="window.open('skipper_guide_detail.php?tour_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_tour_id']; ?>
&dep_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id']; ?>
&cur_date=<?php echo $this->_tpl_vars['select_date']; ?>
','MyPopUp','width=400,height=450,toolbar=0,scrollbars=1,screenX=10,screenY=10')" class="txt-side_book" title="Choose Skipper">
					<img src="images/icons/addskipper.gif" width="16" height="16" border="0" title="Add Skipper/Guide"></a>&nbsp;
					<?php endif; ?>
						<?php if ($this->_tpl_vars['departures'][$this->_sections['i']['index']]['reserved'] < $this->_tpl_vars['departures'][$this->_sections['i']['index']]['boat_passengers'] && $this->_tpl_vars['departures'][$this->_sections['i']['index']]['boat_del'] == 0): ?>
						<a href="javascript:openwind('make_booking.php?option=resellers&tour_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_tour_id']; ?>
&departure_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id']; ?>
&free=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['boat_passengers']-$this->_tpl_vars['departures'][$this->_sections['i']['index']]['blocked']; ?>
', 600, 500, 'yes')"><img src="images/icons/add_16.gif" width="16" height="16" border="0"></a>
						<?php endif; ?>
					</div></td>
                  </tr>
				  <?php $this->assign('orders', $this->_tpl_vars['departures'][$this->_sections['i']['index']]['orders']); ?>
				  <?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['orders']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
                  <tr bordercolor="#EBF2FE" bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#F8FAFE"), $this);?>
">
                    <td width="14%" class="table-line outline-topb style3">
                    	<?php if ($this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_payd'] != 0): ?>
                    		<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_id']; ?>

                    		<?php if ($this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_tour_shared_id'] != 0): ?> 
                    			<b><?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_tour_prefix']; ?>
</b>
                    		<?php endif; ?>
                    	<?php else: ?>
                    		<span style="color:#FF0000;"> 
	                    		<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_id']; ?>

	                    		<?php if ($this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_tour_shared_id'] != 0): ?> 
	                    			<b><?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_tour_prefix']; ?>
</b>
	                			<?php endif; ?>
                			</span>
            			<?php endif; ?>
            		</td>
                    <td width="39%" class="table-line outline-topb style3">
                    	<?php if ($this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_payd'] != 0): ?>
                    		<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_title']; ?>

                			<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_first_name']; ?>

                			<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_last_name']; ?>

                			(<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_email']; ?>
)
                			<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_phone']; ?>

                			<br>
                			<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_note_crew']; ?>

                		<?php else: ?>
                			 <span style="color:#FF0000;">
                			 	<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_title']; ?>

                			 	<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_first_name']; ?>
 
                			 	<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_last_name']; ?>
 
                			 	(<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_email']; ?>
) 
                			 	<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_phone']; ?>
 
                			 	<br>
                			 	<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_note_crew']; ?>

            			 	</span>
            			 <?php endif; ?>
            		</td>
                    <td width="10%" class="table-line outline-topb style3">
                    	<?php if ($this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_payd'] != 0): ?> 
                    		<?php if ($this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_tickets_number'] == 1 && $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_tickets'] == '0'): ?>
                    			Charter
                			<?php else: ?>
                				<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_tickets_number']; ?>

            				<?php endif; ?>
        				<?php else: ?> 
        					<span style="color:#FF0000;">  
        						<?php if ($this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_tickets_number'] == 1 && $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_tickets'] == '0'): ?>
        							Charter
    							<?php else: ?>
    								<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_tickets_number']; ?>

								<?php endif; ?>
							</span> 
						<?php endif; ?>
					</td>
                    <td width="12%" class="table-line outline-topb style3"><?php if ($this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_payd'] != 0): ?> &pound;
<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_total']; ?>
 <?php else: ?> <span style="color:#FF0000;">&pound;<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_total']; ?>
</span> <?php endif; ?></td>
					<td width="10%" class="table-line outline-topb style3"><?php if ($this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_payd'] != 0): ?> <?php if ($this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_reseller_name']): ?><?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_reseller_name']; ?>
<?php else: ?>LRV<?php endif; ?> <?php else: ?> <span style="color:#FF0000;"> <?php if ($this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_reseller_name']): ?><?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_reseller_name']; ?>
<?php else: ?>LRV<?php endif; ?></span><?php endif; ?></td>
                    <td width="25%" class="table-line outline-topb">
					<div align="left" style="display:inline;">
						<a href="calendar.php?subpage=bookings&day=<?php echo $this->_supers['get']['day']; ?>
&delete=<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_id']; ?>
"  onclick="return confirm('Are you sure you want to delete this ticket?');"><img src="images/icons/del_16.gif" title="Delete Ticket" width="16" height="16" border="0"></a>			
						&nbsp; 
						<a href="javascript:openwind('edit_ticket.php?option=resellers&reseller_id=<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_reseller_id']; ?>
&tour_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_tour_id']; ?>
&code=<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_unique_code']; ?>
', 600, 500, 'yes')"><img src="images/icons/config_clock_16.gif"  title="Edit Ticket" width="16" height="16" border="0"></a>
						<?php if ($this->_tpl_vars['departures'][$this->_sections['i']['index']]['boat_del'] == 0): ?>
							&nbsp;
							<a href="javascript:openwind('relocate_ticket.php?tour_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_tour_id']; ?>
&code=<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_unique_code']; ?>
', 400, 200, 'no')"><img src="images/icons/clock_16.gif"  title="Relocate Ticket" width="16" height="16" border="0"></a>
						<?php endif; ?>
						&nbsp;
						<?php if ($this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_used'] == 0): ?>
							<a href="calendar.php?subpage=bookings&day=<?php echo $this->_supers['get']['day']; ?>
&id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id']; ?>
&mark=<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_id']; ?>
"  onclick="return confirm('Are you sure you want to mark this ticket as used?');"><img src="images/icons/lock_ok_16.gif"  title="Mark Ticket as Used" width="16" height="16" border="0"></a><?php else: ?><img src="images/icons/lock_16_dis.gif"  title="Ticket Used" width="16" height="16" border="0">
						<?php endif; ?>
						&nbsp; 
						<a href="javascript:view_ticket('<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_unique_code']; ?>
');"><img src="images/icons/mail_info_16.gif"  title="View Ticket" width="16" height="16" border="0"></a>
						&nbsp; 
						<a href="javascript:openwind('ticket_emails.php?id=<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_id']; ?>
&code=<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_unique_code']; ?>
', 900, 400, 'yes')"><img src="images/icons/icon_email_16.gif"  title="Re-send email confirmation" width="16" height="16" border="0"></a>
            &nbsp; 
            <a href="javascript:openwind('order_history.php?id=<?php echo $this->_tpl_vars['orders'][$this->_sections['j']['index']]['order_id']; ?>
', 900, 400, 'yes')"><img src="images/icons/icon-log.png"  title="View order modification history" width="16" height="16" border="0"></a>
					</div></td>
                  </tr>
				  <?php endfor; endif; ?>
				  <?php if ($this->_tpl_vars['information_arr'][$this->_tpl_vars['tour_id']][$this->_tpl_vars['depart_id']]['skipper'] != ""): ?>
				  <tr>
                <td bgcolor="#F8F8F8" class="table-line" colspan="4">
				
				<table border="0" width="100%" cellpadding="2px" cellspacing="0px">
					 <td width="2%"> 
					 <a href="calendar.php?skiper_guide_id=<?php echo $this->_tpl_vars['information_arr'][$this->_tpl_vars['tour_id']][$this->_tpl_vars['depart_id']]['skipper_tour_id']; ?>
&cur_date=<?php echo $this->_tpl_vars['select_date']; ?>
&command=delete_skipper" title="Delete Skipper">
				  <img src="images/icons/del_16.gif" alt="Delete Skipper" width="16" height="16" vspace="2" border="0">
				  </a>
				  </td>
					 <td width="10%" align="left" class="txt-side_book1">Skipper :</td>
                  <td width="88%" class="txt-side_book" align="left">			  
				  <a href="javascript:void(0)" onClick="window.open('skipper_detail.php?tour_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_tour_id']; ?>
&dep_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id']; ?>
&cur_date=<?php echo $this->_tpl_vars['select_date']; ?>
','MyPopUp','width=400,height=450,toolbar=0,scrollbars=1,screenX=10,screenY=10')" class="txt-side_book2" title="Choose Skipper"><?php echo $this->_tpl_vars['information_arr'][$this->_tpl_vars['tour_id']][$this->_tpl_vars['depart_id']]['skipper']; ?>
</a>				  </td>
					 </table>
				</td>
		      </tr>
				  
				  <?php endif; ?>
				  
				  <?php if ($this->_tpl_vars['information_arr'][$this->_tpl_vars['tour_id']][$this->_tpl_vars['depart_id']]['guide'] != ""): ?>
				  <tr>
                <td bgcolor="#F8F8F8" class="table-line" colspan="4">
				
				<table border="0" width="100%" cellpadding="2px" cellspacing="0px">
					 <td width="2%" align="right"> 
					 <a href="calendar.php?skiper_guide_id=<?php echo $this->_tpl_vars['information_arr'][$this->_tpl_vars['tour_id']][$this->_tpl_vars['depart_id']]['skipper_tour_id']; ?>
&cur_date=<?php echo $this->_tpl_vars['select_date']; ?>
&command=delete_guide" title="Delete Guide">
				  <img src="images/icons/del_16.gif" alt="Delete Guide" width="16" height="16" vspace="2" border="0">
				  </a>
				  </td>
					 <td width="10%" align="left" class="txt-side_book1">Guide :</td>
                  <td width="88%" align="left" valign="middle" class="txt-side_book">
				  <a href="javascript:void(0)" onClick="window.open('guide_detail.php?tour_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_tour_id']; ?>
&dep_id=<?php echo $this->_tpl_vars['departures'][$this->_sections['i']['index']]['departure_id']; ?>
&cur_date=<?php echo $this->_tpl_vars['select_date']; ?>
','MyPopUp','width=400,height=450,toolbar=0,scrollbars=1,screenX=10,screenY=10')" class="txt-side_book2" title="Choose Guide"><?php echo $this->_tpl_vars['information_arr'][$this->_tpl_vars['tour_id']][$this->_tpl_vars['depart_id']]['guide']; ?>
</a></td>
				  </table>
				</td>
		      </tr>
				  
				  <?php endif; ?>
                </table>
              </td></tr>
			<?php endif; ?>
			<?php endfor; else: ?>
			  <tr>
                <td bgcolor="#F8F8F8" class="table-line" colspan="4">
				There are no bookings defined!
				</td>
		      </tr>
			<?php endif; ?>	
            </table>
            <br>
            <br>
            <br></td>
      </tr>
    </table><br>