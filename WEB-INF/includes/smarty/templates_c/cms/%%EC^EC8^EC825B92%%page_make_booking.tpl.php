<?php /* Smarty version 2.6.25, created on 2015-06-13 14:01:35
         compiled from make_booking/page_make_booking.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'make_booking/page_make_booking.tpl', 29, false),array('modifier', 'truncate', 'make_booking/page_make_booking.tpl', 29, false),array('function', 'cycle', 'make_booking/page_make_booking.tpl', 77, false),)), $this); ?>
<html>
<head>
<title>Booking</title>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/jquery-1.7.2.min.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/make_booking.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/validation.js"></script>   
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/macromedia.js"></script>   
<link href="../WEB-INF/assets/css/site-styles.css" rel="stylesheet" type="text/css" />
<?php echo '
<script language="javascript">
<!--
function init_address() {
    //define(\'order_first_name\', \'string\', \'First Name\',3, 50);
    //define(\'order_last_name\', \'string\', \'Last Name\',3, 50);
    //define(\'order_email\', \'email\', \'Email\',6);
}
-->
</script>
'; ?>
  
<body onLoad="init_address();">
<br />
<form name="make_booking" method="post" action="make_booking.php?option=pay">
<input type="hidden" name="departure_id" value="<?php echo $this->_supers['get']['departure_id']; ?>
">
<input type="hidden" name="tour_id" value="<?php echo $this->_tpl_vars['tour_id']; ?>
">
<input type="hidden" name="free_seats" value="<?php echo $this->_tpl_vars['free_seats']; ?>
">
<input type="hidden" name="PriceVal" value="">
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center"> 
  <tr>
    <td height="21" valign="top" class="content-formatting"><h1><?php echo $this->_tpl_vars['tour']['tour_name']; ?>
 : Add new booking for <?php echo ((is_array($_tmp=$this->_tpl_vars['departure']['departure_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d %b %Y") : smarty_modifier_date_format($_tmp, "%d %b %Y")); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['departure']['departure_time'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5, "") : smarty_modifier_truncate($_tmp, 5, "")); ?>
 <?php if (! empty ( $this->_supers['post']['reseller_id'] ) && $this->_supers['post']['reseller_id'] != -1): ?>with reseller <?php echo $this->_tpl_vars['reseller']['reseller_name']; ?>
<?php endif; ?></h1>
  </tr>
  <?php if (! empty ( $this->_supers['get']['busy'] ) && ( $this->_supers['get']['busy'] == true )): ?>
  <tr>
    <td><div align="left" class="content-formatting"><strong><span style="color:#880000;">The ticket(s) you booked has just been paid by another person.<br /> Please try again with other options.</span></strong></div><br /></td>
  </tr>
  <?php endif; ?>
  
  <tr>
    <td><div align="left" class="content-formatting"><br />Pease specify the number of people for your voyage, as well as the ticket types you would like to purchase. If you would like to book a charter, please select this option below. <br>
      <br>
        <br>
                  <?php if (empty ( $this->_supers['post']['reseller_id'] ) || $this->_supers['post']['reseller_id'] == -1): ?>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="booking-chselback">
                    <tr>
                      <td width="70%" class="content-formatting"><strong>Charter per hour &pound;<?php echo $this->_tpl_vars['tour']['tour_charter_price']; ?>
</strong></td>
                      <td width="30%"><div align="right"  class="content-formatting"><span  style="vertical-align:top"><strong>Book Now</strong></span><input type="checkbox" name="charter" value="yes" onClick="is_charter('<?php echo $this->_tpl_vars['tour']['tour_charter_price']; ?>
');" <?php if ($this->_supers['get']['free'] != $this->_tpl_vars['departure']['boat_passengers']): ?> disabled="disabled"<?php endif; ?>></div></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="35" class="content-formatting"><div align="center" class="style3">--- OR ---</div></td>
                    </tr>
                  </table>
                  <?php elseif (! empty ( $this->_tpl_vars['charter']['reseller_charter'] )): ?> <!-- y no hay bookings hechos -->
                  
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="booking-chselback">
                    <tr>
                      <td width="70%" class="content-formatting"><strong>Charter per hour &pound;<?php echo $this->_tpl_vars['charter']['reseller_charter']; ?>
</strong></td>
                      <td width="30%"><div align="right"  class="content-formatting"><span  style="vertical-align:top"><strong>Book Now</strong></span>
                        <input type="checkbox" name="charter" value="yes" onClick="is_charter('<?php echo $this->_tpl_vars['charter']['reseller_charter']; ?>
');" <?php if ($this->_supers['get']['free'] != $this->_tpl_vars['departure']['boat_passengers']): ?> disabled="disabled"<?php endif; ?> <?php if ($this->_supers['post']['charter'] == yes): ?> checked="checked"<?php endif; ?> ></div></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="35" class="content-formatting"><div align="center" class="style3">--- OR ---</div></td>
                    </tr>
                  </table>
				          <?php else: ?>
					         <input type="hidden" name="charter" value="">
                  <?php endif; ?>
                  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="booking-tableoutln1">
                  <tr>
                    <td width="60%" class="booking-tableheader1">Ticket Type:</td>
                    <td width="21%" class="booking-tableheader1"><div align="right">Quantity:</div></td>
                    <td width="19%" class="booking-tableheader1"><div align="right">Price:</div></td>
                  </tr>
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
                  <tr bgcolor="<?php echo smarty_function_cycle(array('values' => ',#f8f8f8'), $this);?>
">
                    <td class="booking-tablecont1"><?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_type']; ?>
</td>
                    <td class="booking-tablecont1"><div align="right">
                      <input name="ticket[]" type="hidden" value="<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_id']; ?>
" >
                      <input name="quantity[]" type="text" class="booking-cell" size="4" maxlength="3" <?php if ($this->_supers['get']['busy'] != true): ?> value="<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['quantity']; ?>
" <?php else: ?> value="<?php echo $this->_supers['post']['quantity1'][$this->_sections['i']['index']]; ?>
" <?php endif; ?> onKeyUp="calculate_total()">
                      <input name="price[]" type="hidden" value="<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_price']; ?>
" >
                      <input name="seats[]" type="hidden" value="<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_seats']; ?>
" >
                    </div></td>
                    <td class="booking-tablecont1"><div align="right"><strong>&pound;<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_price']; ?>
</strong></div></td>
                  </tr>
                  <?php endfor; endif; ?>
                </table>
                
                
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="22" height="10"></td>
                    </tr>
                  </table>
                  
                  <?php if (! empty ( $this->_tpl_vars['special_tickets'] )): ?>
                  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="booking-tableoutln1">
                  <tr>
                    <td width="75%" class="booking-tableheader1">Special Offers</td>
                    <td width="20%" class="booking-tableheader1"><div align="right">Price:</div></td>
                    <td width="5%" class="booking-tableheader1">&nbsp;</td>
                  </tr>
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
                  <tr bgcolor="<?php echo smarty_function_cycle(array('values' => ',#f8f8f8'), $this);?>
">
                    <td class="booking-tablecont1"><?php echo $this->_tpl_vars['special_tickets'][$this->_sections['i']['index']]['ticket_type']; ?>
</td>
                    <td class="booking-tablecont1"><div align="right"><strong>&pound;<?php echo $this->_tpl_vars['special_tickets'][$this->_sections['i']['index']]['ticket_price']; ?>
</strong></div></td>
                    <td class="booking-tablecont1"><div align="right">
                      <input name="ticket[]" type="hidden" value="<?php echo $this->_tpl_vars['special_tickets'][$this->_sections['i']['index']]['ticket_id']; ?>
" >
                      <input name="quantity[]" type="hidden" class="booking-cell" value="<?php echo $this->_tpl_vars['special_tickets'][$this->_sections['i']['index']]['quantity']; ?>
" size="4" maxlength="3" value="0"><input name="price[]" type="hidden" value="<?php echo $this->_tpl_vars['special_tickets'][$this->_sections['i']['index']]['ticket_price']; ?>
" >      
                      <input name="seats[]" type="hidden" value="<?php echo $this->_tpl_vars['special_tickets'][$this->_sections['i']['index']]['ticket_seats']; ?>
" >                          
                    
                    <input type="checkbox" name="special[]" value="<?php echo $this->_tpl_vars['special_tickets'][$this->_sections['i']['index']]['ticket_price']; ?>
" onClick="calculate_total();" <?php if ($this->_tpl_vars['special_tickets'][$this->_sections['i']['index']]['quantity'] == 1): ?>checked="checked"<?php endif; ?>>
                    </div></td>
                  </tr>
                  <?php endfor; endif; ?>

                </table>
                <?php endif; ?>
                
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="22" height="10"></td>
                    </tr>
                  </table>                                
                  
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="booking-totalst1bg">
                    <tr>
                      <td width="84%" class="content-formatting">
                      <div align="right" class="style4">TOTAL BOOKING COST:&nbsp;&nbsp; &pound;</div>
                    </td>
                      <td width="16%"><div align="right">
                        <input name="total" type="text" class="booking-cell" size="6" maxlength="6" onFocus="" value="<?php echo $this->_supers['post']['total']; ?>
">
                        </div></td>
                    </tr>
<!-- Added by Carlos -->
<?php if ($this->_supers['post']['reseller_id'] == 108): ?>

                    <tr>
                      <td width="84%" class="content-formatting">
                      <div align="right" class="style4">TOKENS REDEEMED:&nbsp;&nbsp; </div>
                    </td>
                      <td width="16%"><div align="right">
                        <input name="tokens_redeemed" type="text" class="booking-cell" size="6" maxlength="6" onFocus="" value="">
                        </div></td>
                    </tr>
<?php endif; ?>
                    <tr>
                      <td width="84%" class="content-formatting">                                        <div align="right" class="style4">BESPOKE PRICE&nbsp;&nbsp; &pound;</div></td>
                      <td width="16%"><div align="right">
                        <input name="bespoke_price" type="text" class="booking-cell" size="6" maxlength="6" onKeyUp="is_bespoke();" value="<?php echo $this->_supers['post']['bespoke_price']; ?>
">
                        </div></td>
                    </tr>
                  </table>
                  <br>
                  
                  
                <table width="100%" border="0" cellspacing="2" cellpadding="2">
                  <tr>
                    <td colspan="2" class="content-formatting">Please fill out the form below. Fields marked with (*) represents required information.<br></td>
                  </tr>
                  <tr>
                    <td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="22" height="7"></td>
                  </tr>               
                  <tr>
                    <td width="25%" class="content-formatting"><div align="left"><strong>First Name: </strong></div></td>
                    <td width="75%"><input name="order_first_name"  maxlength="50" type="text" class="booking-cell" size="25" value="<?php echo $this->_supers['post']['order_first_name']; ?>
"></td>
                  </tr>
                  <tr>
                    <td class="content-formatting"><div align="left"><strong>Last Name: </strong></div></td>
                    <td><input name="order_last_name" maxlength="50" type="text" class="booking-cell" size="25" value="<?php echo $this->_supers['post']['order_last_name']; ?>
"></td>
                  </tr>
                  <tr>
                    <td class="content-formatting"><div align="left"><strong>Phone:</strong></div></td>
                    <td><input name="order_phone" maxlength="16" type="text" class="booking-cell" size="25" value="<?php echo $this->_supers['post']['order_phone']; ?>
"></td>
                  </tr>
                  <tr>
                    <td class="content-formatting"><div align="left"><strong>Email:</strong></div></td>
                    <td><input name="order_email" maxlength="50" type="text" class="booking-cell" size="25" value="<?php echo $this->_supers['post']['order_email']; ?>
"></td>
                  </tr>
                </table>
        
                  <br>
                  
                  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="booking-tableoutln1">
                  <tr>
                    <td class="booking-tableheader1" colspan="2">Method of payment</td>
                  </tr>
                  
                  <tr>
                    <td  width="50%" class="booking-tablecont1"><input type="radio" name="order_method" value="protx" <?php if ($this->_supers['get']['busy'] != true): ?>checked="checked" <?php elseif ($this->_supers['post']['order_method'] == protx && $this->_supers['get']['busy'] == true): ?> checked="checked" <?php endif; ?>><span  style="vertical-align:bottom">Protx (credit card)</span></td>
                    <td width="50%" class="booking-tablecont1"><input type="radio" name="order_method" value="streamline" <?php if ($this->_supers['post']['order_method'] == streamline && $this->_supers['get']['busy'] == true): ?> checked="checked" <?php endif; ?>><span  style="vertical-align:bottom">Streamline (manual card process in kiosk)</span></td>
                  </tr>

                  <tr bgcolor="#f8f8f8">
                    <td class="booking-tablecont1"><input type="radio" name="order_method" value="cash" <?php if ($this->_supers['post']['order_method'] == cash && $this->_supers['get']['busy'] == true): ?> checked="checked" <?php endif; ?>><span  style="vertical-align:bottom">Cash (in kiosk)</span></td>
                    <td class="booking-tablecont1"><input type="radio" name="order_method" value="cheque" <?php if ($this->_supers['post']['order_method'] == cheque && $this->_supers['get']['busy'] == true): ?> checked="checked" <?php endif; ?>><span  style="vertical-align:bottom">Cheque (in kiosk)</span></td>
                  </tr>
                  <tr>
                    <td  width="50%" class="booking-tablecont1"><input type="radio" name="order_method" value="voucher" <?php if ($this->_supers['post']['order_method'] == voucher && $this->_supers['get']['busy'] == true): ?> checked="checked" <?php endif; ?>><span  style="vertical-align:bottom">Voucher</span></td>
                  </tr>
                </table>
                
                <br>
                <br>
                
                <table width="50%" border="0" cellspacing="2" cellpadding="2">
                 <tr>
                    <td class="content-formatting"><div align="left"><strong>Note to customer: </strong></div></td>
                    <td align="left"><textarea name="comments"  rows="5" cols="50"><?php echo $this->_supers['post']['comments']; ?>
</textarea></td>
                  </tr>
                  <tr>
                    <td class="content-formatting"><div align="left"><strong>Note to office: </strong></div></td>
                    <td align="left"><textarea name="order_note_office"  rows="5" cols="50"><?php echo $this->_supers['post']['order_note_office']; ?>
</textarea></td>
                  </tr>
                  <tr>
                    <td class="content-formatting"><div align="left"><strong>Note to crew: </strong></div></td>
                    <td align="left"><textarea name="order_note_crew"  rows="5" cols="50"><?php echo $this->_supers['post']['order_note_crew']; ?>
</textarea></td>
                  </tr>
                  </table>
                
             <input name="reseller_id" type="hidden" value="<?php echo $this->_supers['post']['reseller_id']; ?>
" >           
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="22" height="35"></td>
                  </tr>
                  <tr>
                    <td><img src="../WEB-INF/assets/images/utils/line_grey.gif" width="100%" height="5" vspace="10"></td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td colspan="2"><div align="center"><a href="javascript:check_form(<?php echo $this->_supers['get']['free']; ?>
);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image32','','../WEB-INF/assets/images/booking/button-checkout-on.gif',1)"><img src="../WEB-INF/assets/images/booking/button-checkout-off.gif" name="Image32" width="198" height="32" border="0"></a></div></td>
                        </tr>
                    </table></td>
                  </tr>
                </table>

        </div></td>
  </tr> 
</table>
</form>
</body>
</head>
</html>