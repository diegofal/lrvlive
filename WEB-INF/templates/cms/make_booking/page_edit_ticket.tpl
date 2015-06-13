<html>
<head>
<title>Booking</title>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/jquery-1.7.2.min.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/edit_ticket.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/validation.js"></script>   
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/macromedia.js"></script>
<link href="../WEB-INF/assets/css/site-styles.css" rel="stylesheet" type="text/css" />   
{literal}
<script language="javascript">
<!--
function init_address() {
    define('order_first_name', 'string', 'First Name',3, 50);
    define('order_last_name', 'string', 'Last Name',3, 50);
    define('order_email', 'email', 'Email',6);
}
-->
</script>
{/literal}  
<body onLoad="init_address();">
<br />
<form name="edit_ticket" method="post" action="edit_ticket.php?option=confirm&id={$order.order_id}">
<input type="hidden" name="tour_id" value="{$tour_id}">
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center"> 
  <tr> 
    <td height="21" valign="top" class="content-formatting"><h1>{$tour.tour_name} : Edit ticket for {$departure.departure_date|date_format:"%d %b %Y"}, {$departure.departure_time|truncate:5:""} {if !empty($smarty.post.reseller_id) and $smarty.post.reseller_id != -1}with reseller {$reseller.reseller_name}{/if}</h1>
  </tr>
  
  <tr>
    <td><div align="left" class="content-formatting"><br />Pease specify the number of people for your voyage, as well as the ticket types you would like to purchase. If you would like to book a charter, please select this option below. <br>
      <br>
        <br>
                 {if empty($smarty.post.reseller_id) || $smarty.post.reseller_id == -1}
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="booking-chselback">
                    <tr>
                      <td width="70%" class="content-formatting"><strong>Charter per hour &pound;{$tour.tour_charter_price}</strong></td>
                      <td width="30%"><div align="right"  class="content-formatting"><span  style="vertical-align:top"><strong>Book</strong></span><input type="checkbox" name="charter" value="yes" onClick="is_charter('{$tour.tour_charter_price}');" {if $free != $departure.boat_passengers} disabled="disabled"{/if} {if $order.order_tickets == 0} checked="checked" {/if}></div></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="35" class="content-formatting"><div align="center" class="style3">--- OR ---</div></td>
                    </tr>
                  </table>
                  {elseif !empty($charter.reseller_charter)}
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="booking-chselback">
                    <tr>
                      <td width="70%" class="content-formatting"><strong>Charter per hour &pound;{$charter.reseller_charter}</strong></td>
                      <td width="30%"><div align="right"  class="content-formatting"><span  style="vertical-align:top"><strong>Book</strong></span><input type="checkbox" name="charter" value="yes" onClick="is_charter('{$charter.reseller_charter}');" {if $free != $departure.boat_passengers} disabled="disabled"{/if} {if $order.order_tickets == 0} checked="checked" {/if}></div></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="35" class="content-formatting"><div align="center" class="style3">--- OR ---</div></td>
                    </tr>
                  </table>
                   {/if}
                  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="booking-tableoutln1">
                  <tr>
                    <td width="60%" class="booking-tableheader1">Ticket Type:</td>
                    <td width="21%" class="booking-tableheader1"><div align="right">Quantity:</div></td>
                    <td width="19%" class="booking-tableheader1"><div align="right">Price:</div></td>
                  </tr>
                  {section name=i loop=$tickets}                  	
	                  <tr bgcolor="{cycle values=',#f8f8f8'}">
	                    <td class="booking-tablecont1">
	                    	{$tickets[i].ticket_type}
	                    	{if $tickets[i].ticket_del}
	                    		<span title="This ticket was deleted after this booking was placed. You must not add seats to this.">(ticket deleted)</span>
	                    	{/if}
	                    </td>
	                    <td class="booking-tablecont1"><div align="right">
	                      <input name="ticket[]" type="hidden" value="{$tickets[i].ticket_id}" >
	                      <input name="quantity[]" type="text" class="booking-cell" size="4" maxlength="3" value="{$tickets[i].quantity}" {if $tickets[i].ticket_del}style="background-color:red"{/if} onKeyUp="calculate_total()"/>
	                      <input name="price[]" type="hidden" value="{$tickets[i].ticket_price}" >
	                      <input name="seats[]" type="hidden" value="{$tickets[i].ticket_seats}" >
	                    </div></td>
	                    <td class="booking-tablecont1"><div align="right"><strong>&pound;{$tickets[i].ticket_price}</strong></div></td>
	                  </tr>                  	
                  {/section}
                </table>
                
                
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="22" height="10"></td>
                    </tr>
                  </table>
                  
                  {if !empty($special_tickets)}
                  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="booking-tableoutln1">
                  <tr>
                    <td width="75%" class="booking-tableheader1">Special Offers</td>
                    <td width="20%" class="booking-tableheader1"><div align="right">Price:</div></td>
                    <td width="5%" class="booking-tableheader1">&nbsp;</td>
                  </tr>
                  {section name=i loop=$special_tickets}
                  <tr bgcolor="{cycle values=',#f8f8f8'}">
                    <td class="booking-tablecont1">
                    	{$special_tickets[i].ticket_type}
                    	{if $tickets[i].ticket_del}
                    		<span title="This ticket was deleted after this booking was placed. You must not add seats to this.">(ticket deleted)</span>
                    	{/if}
                    </td>
                    <td class="booking-tablecont1"><div align="right"><strong>&pound;{$special_tickets[i].ticket_price}</strong></div></td>
                    <td class="booking-tablecont1"><div align="right">
                      <input name="ticket[]" type="hidden" value="{$special_tickets[i].ticket_id}" >
                      <input name="quantity[]" type="hidden" class="booking-cell" value="{$special_tickets[i].quantity}" {if $tickets[i].ticket_del}style="background-color:red"{/if} size="4" maxlength="3" value="0" >
                      <input name="price[]" type="hidden" value="{$special_tickets[i].ticket_price}" >      
                      <input name="seats[]" type="hidden" value="{$special_tickets[i].ticket_seats}" >                          
                    
                    <input type="checkbox" name="special[]" value="{$special_tickets[i].ticket_price}" onClick="calculate_total();" {if $special_tickets[i].quantity==1}checked="checked"{/if}>
                    </div></td>
                  </tr>
                  {/section}

                </table>
                {/if}
                
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="22" height="10"></td>
                    </tr>
                  </table>                                
                  
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="booking-totalst1bg">
                    {if $order.order_facebook_discount > 0 }
                      <tr>
                        <td width="84%" class="content-formatting"><div align="right" class="style4">FACEBOOK DISCOUNT: &pound;</div></td>
                        <td width="16%"><div align="right">
                          <input name="total" type="text" class="booking-cell" size="6" maxlength="6" value="{$order.order_facebook_discount}" onFocus="this.blur();">
                          </div></td>
                      </tr>
                    {/if}
                    <tr>
                      <td width="84%" class="content-formatting"><div align="right" class="style4">TOTAL BOOKING COST:&nbsp;&nbsp; &pound;</div></td>
                      <td width="16%"><div align="right">
                        <input name="total" type="text" class="booking-cell" size="6" maxlength="6" value="{if empty($order.order_bespoke_price) || $order.order_bespoke_price==0}{$order.order_total}{else}0.00{/if}" onFocus="this.blur();">
                        </div></td>
                    </tr>
<!-- Added by Carlos -->
{if $smarty.post.reseller_id == 108}
               <tr>
                      <td width="84%" class="content-formatting">
                      <div align="right" class="style4">TOKENS REDEEMED:&nbsp;&nbsp; </div>
                    </td>
                      <td width="16%"><div align="right">
                        <input name="tokens_redeemed" type="text" class="booking-cell" size="6" maxlength="6" onFocus="" value="{if !empty($order.order_tokens_redeemed)}{$order.order_tokens_redeemed}{/if}">
                        </div></td>
                    </tr>
{/if}
                    <tr>             
                      <td width="84%" class="content-formatting">                                        <div align="right" class="style4">BESPOKE PRICE&nbsp;&nbsp; &pound;</div></td>
                      <td width="16%"><div align="right">
                        <input name="bespoke_price" type="text" class="booking-cell" size="6" maxlength="6" value="{if !empty($order.order_bespoke_price)}{$order.order_total}{/if}" onKeyUp="is_bespoke();">
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
                    <td width="25%" class="content-formatting"><div align="left"><strong>*First Name: </strong></div></td>
                    <td width="75%"><input name="order_first_name" value="{$order.order_first_name}"  maxlength="50" type="text" class="booking-cell" size="25"></td>
                  </tr>
                  <tr>
                    <td class="content-formatting"><div align="left"><strong>*Last Name: </strong></div></td>
                    <td><input name="order_last_name" value="{$order.order_last_name}" maxlength="50" type="text" class="booking-cell" size="25"></td>
                  </tr>
                  <tr>
                    <td class="content-formatting"><div align="left"><strong>Phone:</strong></div></td>
                    <td><input name="order_phone" value="{$order.order_phone}" maxlength="16" type="text" class="booking-cell" size="25"></td>
                  </tr>
                  <tr>
                    <td class="content-formatting"><div align="left"><strong>*Email:</strong></div></td>
                    <td><input name="order_email" value="{$order.order_email}" maxlength="50" type="text" class="booking-cell" size="25"></td>
                  </tr>
                </table>
        
                  <br>
                  
                  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="booking-tableoutln1">
                  <tr>
                    <td class="booking-tableheader1" colspan="2">Method of payment</td>
                  </tr>
                  
                  <tr>
                    <td  width="50%" class="booking-tablecont1"><input type="radio" name="order_method" value="protx" {if $order.order_method == "protx"}checked="checked"{/if}><span  style="vertical-align:bottom">Protx (credit card)</span></td>
                    <td width="50%" class="booking-tablecont1"><input type="radio" name="order_method" value="streamline" {if $order.order_method == "streamline"}checked="checked"{/if}><span  style="vertical-align:bottom">Streamline (manual card process in kiosk)</span></td>
                  </tr>

                  <tr bgcolor="#f8f8f8">
                    <td class="booking-tablecont1"><input type="radio" name="order_method" value="cash" {if $order.order_method == "cash"}checked="checked"{/if}><span  style="vertical-align:bottom">Cash (in kiosk)</span></td>
                    <td class="booking-tablecont1"><input type="radio" name="order_method" value="cheque" {if $order.order_method == "cheque"}checked="checked"{/if}><span  style="vertical-align:bottom">Cheque (in kiosk)</span></td>
                  </tr>
                  <tr>
                    <td  width="50%" class="booking-tablecont1"><input type="radio" name="order_method" value="voucher"  {if $order.order_method == "voucher"}checked="checked"{/if}><span  style="vertical-align:bottom">Voucher</span></td>
                  </tr>
                </table>
                <br>
                <br>
                
                <table width="50%" border="0" cellspacing="2" cellpadding="2">
                 <tr>
                    <td class="content-formatting"><div align="left"><strong>Note to customer: </strong></div></td>
                    <td align="left"><textarea name="comments" rows="10" cols="50">{$order.order_comments}</textarea></td>
                  </tr>
                  <tr>
                    <td class="content-formatting"><div align="left"><strong>Note to office: </strong></div></td>
                    <td align="left"><textarea name="order_note_office" rows="10" cols="50">{$order.order_note_office}</textarea></td>
                  </tr>
                  <tr>
                    <td class="content-formatting"><div align="left"><strong>Note to crew: </strong></div></td>
                    <td align="left"><textarea name="order_note_crew" rows="10" cols="50">{$order.order_note_crew}</textarea></td>
                  </tr>
                  </table>
                  <br />
                  <br />
                
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="booking-tableoutln1" style="background-color:#f8f8f8;">
                    <tr>
                      <td width="70%" class="booking-tableheader1"><strong>Send email confirmation to client</strong></td>
                      <td width="30%"><div align="right" class="booking-tableheader1"><span  style="vertical-align:top"></span><input type="checkbox" name="resendconfirmation" value="" /></div></td>
                    </tr>
                  </table>
                  
                    <input name="reseller_id" type="hidden" value="{$smarty.post.reseller_id}" >                
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
                            <td colspan="2"><div align="center"><a href="javascript:check_form({$free});" onMouseOut="MM_swapImgRestore()"onMouseOver="MM_swapImage('Image32','','../WEB-INF/assets/images/booking/button-proceed-on.gif',1)"><img src="../WEB-INF/assets/images/booking/button-proceed-off.gif" name="Image32" width="107" height="32" border="0"></a></div></td>
                        </tr>
                    </table></td>
                  </tr>
                </table>

        </div></td>
  </tr> 
</table>
{if $order.order_tickets == 0}
<script language="javascript" type="text/javascript">
<!--
is_charter({$order.order_total});
-->
</script>
{/if}

</form>
</body>
</head>