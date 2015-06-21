<?php /* Smarty version 2.6.25, created on 2015-06-13 14:34:22
         compiled from pages/page_booking_step3.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'pages/page_booking_step3.tpl', 102, false),array('modifier', 'truncate', 'pages/page_booking_step3.tpl', 106, false),)), $this); ?>
<div id="fb-root"></div>
<script type="text/javascript">
var lblOrderTotal = <?php echo $this->_tpl_vars['order']['order_total']; ?>
;
</script>
<?php echo '
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>
<script>


window.onload = function () { 
	
	FB.Event.subscribe(\'edge.create\', page_like_callback);
	FB.Event.subscribe(\'edge.remove\', page_unlike_callback);
	document.getElementById(\'lblOrderTotal\').innerHTML = lblOrderTotal;

	if (getCookie("likeFacebookCookie"))
		page_like_callback();
	else
		page_unlike_callback();
	
};

var page_like_callback = function(url, html_element) {
	setCookie("likeFacebookCookie", "true", 1000);

	document.getElementById(\'lblOrderTotal\').innerHTML = lblOrderTotal - 1;
	document.getElementById(\'fbLikeDiscount\').style.display = \'block\' ;
	document.getElementById(\'facebook_discount\').value = 1;
}
var page_unlike_callback = function(url, html_element) {
	  setCookie("likeFacebookCookie", "true", -1);
	  document.getElementById(\'lblOrderTotal\').innerHTML = lblOrderTotal;
	  document.getElementById(\'fbLikeDiscount\').style.display = \'none\';
	  document.getElementById(\'facebook_discount\').value = 0;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(\';\');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==\' \') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
}

function checkCookie(cookieName) {
    var cookieName=getCookie(cookieName);
    if (cookieName!="") {
        return true;
    }else{
        return false;
    }
}
</script>
'; ?>


<div class="booking-form">
	<!--Form start -->
	<form name="step3" method="post" action="booking.php?tour_id=<?php echo $this->_tpl_vars['tour_id']; ?>
&subpage=step3">
		<input type="hidden" id="facebook_discount" name="facebook_discount" value="0" />
		<div class="booking-nav">
			<ul>
				<li><a href="booking.php?tour_id=<?php echo $this->_supers['get']['tour_id']; ?>
&amp;subpage=step1" class="how_many_1" title="How Many?">How Many</a></li>
				<li><a href="booking.php?tour_id=<?php echo $this->_supers['get']['tour_id']; ?>
&amp;subpage=step2" class="date_1" title="Date &amp; Time">Time</a></li>
				<li><a href="booking.php?tour_id=<?php echo $this->_supers['get']['tour_id']; ?>
&amp;subpage=step3" class="yourdetail_1 active" title="Your Details">Your Details</a></li>
				<li><a href="booking.php?tour_id=<?php echo $this->_supers['get']['tour_id']; ?>
&amp;subpage=step6" class="payment_1" title="Payment">Payment</a></li>
			</ul>
		</div>
		
		<div class="booking-form-main">
		
			<h3>Shopping Cart</h3>
		
			<div class="bookingtext_1_new1">Please verify the booking information you have selected. If you need to make any changes, please use the Back button below. </div>
		   
			<div class="booking_form_row booking_terms">
				<input type="checkbox" class="checkbox" name="confirm" value="checkbox" <?php if (! empty ( $this->_tpl_vars['order']['order_find'] )): ?> checked="checked"<?php endif; ?>>&nbsp;Please confirm that you have read our <a href="javascript:openwind('terms.php', 700, 500, 'yes')">Terms & Conditions</a>.
			</div>
			
			<!--Second Div Starts-->
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Item :</div>
					<div class="style_step3_10"><?php echo $this->_tpl_vars['tour']['tour_name']; ?>
</div>
			</div>
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Date of Voyage :</div>
					<div class="style_step3_10"><?php echo ((is_array($_tmp=$this->_tpl_vars['departure']['departure_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d %b %Y") : smarty_modifier_date_format($_tmp, "%d %b %Y")); ?>
</div>
			</div>
			<div class="booking_form_row cart_summary clearfix">
					<div class="style_step3_7">Departure Time :</div>
					<div class="style_step3_10"><?php echo ((is_array($_tmp=$this->_tpl_vars['departure']['departure_time'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5, "") : smarty_modifier_truncate($_tmp, 5, "")); ?>
</div>
			</div>
		
	 <!--END-->
		 <div class="style_tour_details17">
		 	<div class="style_step3_3">
				<div class="style_step3_12">
					<div class="style_step3_7">
						<div class="style_step3_13"></div>
						<div class="style_step3_14" style="text-align:center"><strong>Quantity</strong></div>
						<div class="style_step3_15" style="text-align:center"><strong>Total</strong></div>
					</div>
				</div>
				<!--Second Div Starts Here-->
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
				<div class="style_div_detail1">
					<div class="style_step3_7">
						<div class="style_step3_16"><?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['type']; ?>
</div>
						<div class="style_step3_17" style="text-align:center"><?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['quantity']; ?>
 @ &pound;<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['price']; ?>
</div>
						<div class="style_step3_15" style="text-align:center">&pound;<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['total']; ?>
</div>
					</div>
				</div>
				<?php endfor; else: ?>
				<div class="style_div_detail1">
					<div class="style_step3_7">
						<div class="style_step3_16" style="text-align:center"><strong>Charter</strong></div>
						<div class="style_step3_17" style="text-align:center">1 @ &pound;<?php echo $this->_tpl_vars['order']['order_total']; ?>
</div>
						<div class="style_step3_15" style="text-align:center">&pound;<?php echo $this->_tpl_vars['order']['order_total']; ?>
</div>
					</div>
				</div>
				<?php endif; ?>
				<!--Start Total-->

				<div class="booking_form_row" style="height:80px;padding-top: 30px;">
					<div style="float:left;float:left;margin-top: 17px;">Come join us on Facebook and<br />save &pound;1 on your booking</div>
					<div style="float:right;">
						<div class="fb-like-box" data-href="https://www.facebook.com/londonribvoyages" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false"></div>
					</div>
				</div>

				<div class="style_step3_18"></div>
				<div class="style_step3_19">
					<div class="style_step3_20">
						<div class="style_step3_13"></div>
						<div class="style_step3_14"></div>
						<div class="style_step3_15 booking_totals booking_fee">BOOKING FEE: &nbsp;&pound;3.95</div>
					</div>					
					<div class="style_step3_20" id="fbLikeDiscount" style="display:none;">
						<div class="style_step3_13"></div>
						<div class="style_step3_14"></div>
						<div class="style_step3_15 booking_totals">DISCOUNT: &nbsp;-&pound;1</div>
					</div>
					<div class="style_step3_20">
						<div class="style_step3_13"></div>
						<div class="style_step3_14"></div>
						<div class="style_step3_15 booking_totals">TOTAL COST: &nbsp;&pound;<span id="lblOrderTotal"></span></div>
					</div>
				</div>
			<!--ENDS TOTAL-->
		</div>
		
	<div class="style_step3_21 booking_form_row">
		<div class="style_step3_22">How did you find us?</div>
			<div class="style_step3_23">
				<select name="order_find" class="booking-ddwn-length">
					<option value="0">Please select</option>
					<?php unset($this->_sections['b']);
$this->_sections['b']['name'] = 'b';
$this->_sections['b']['loop'] = is_array($_loop=$this->_tpl_vars['hear_about_us']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['b']['show'] = true;
$this->_sections['b']['max'] = $this->_sections['b']['loop'];
$this->_sections['b']['step'] = 1;
$this->_sections['b']['start'] = $this->_sections['b']['step'] > 0 ? 0 : $this->_sections['b']['loop']-1;
if ($this->_sections['b']['show']) {
    $this->_sections['b']['total'] = $this->_sections['b']['loop'];
    if ($this->_sections['b']['total'] == 0)
        $this->_sections['b']['show'] = false;
} else
    $this->_sections['b']['total'] = 0;
if ($this->_sections['b']['show']):

            for ($this->_sections['b']['index'] = $this->_sections['b']['start'], $this->_sections['b']['iteration'] = 1;
                 $this->_sections['b']['iteration'] <= $this->_sections['b']['total'];
                 $this->_sections['b']['index'] += $this->_sections['b']['step'], $this->_sections['b']['iteration']++):
$this->_sections['b']['rownum'] = $this->_sections['b']['iteration'];
$this->_sections['b']['index_prev'] = $this->_sections['b']['index'] - $this->_sections['b']['step'];
$this->_sections['b']['index_next'] = $this->_sections['b']['index'] + $this->_sections['b']['step'];
$this->_sections['b']['first']      = ($this->_sections['b']['iteration'] == 1);
$this->_sections['b']['last']       = ($this->_sections['b']['iteration'] == $this->_sections['b']['total']);
?>
					<option value="<?php echo $this->_tpl_vars['hear_about_us'][$this->_sections['b']['index']]['Title']; ?>
" <?php if ($this->_tpl_vars['order']['order_find'] == $this->_tpl_vars['hear_about_us'][$this->_sections['b']['index']]['Title']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['hear_about_us'][$this->_sections['b']['index']]['Title']; ?>
</option>
					<?php endfor; endif; ?>
				</select>
			</div>
		 </div>
	</div>		 
		<!--END-->
		<div class="booking_form_row booking_buttons clearfix">
			<div class="booking-button back-button"><a href="booking.php?tour_id=<?php echo $this->_tpl_vars['tour_id']; ?>
&amp;subpage=step1">Back</a></div>
			<div class="booking-button booking-submit"><a href="javascript:check_form();">Proceed</a></div>
		</div>

	</form>
</div>
</div>
	
	<!--Include Right Menu-->
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "utils/site_right_menu_booking_sub.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<!--END-->
</div>	