<form name="voucher_step1" method="post" action="booking.php?voucher_id={$voucher_id}&amp;subpage=voucher_step1">
<div class="breadcrum-step">
	<a href="#" class="selected">1. Voucher details</a>
	<a href="#">2. Ticket type</a>
	<a href="#">3. Resume and payment</a>
</div>
<div class="step step-1">
	<header>
		<span>Step 1</span>
		<h3>Vouchers</h3>
		<p>Please enter the following details to purchase your Voucher</p>
	</header>
	<div class="buy-content">
		<div class="sender">
			<h5>Sender:</h5>
			<ul>
				<li class="name"><span>Name:</span><input name="voucher_order_name" value="{$voucher_order.voucher_order_name}" maxlength="20" type="text"/></li>
				<li class="surname"><span>Last Name:</span><input name="voucher_order_lastname" value="{$voucher_order.voucher_order_lastname}" maxlength="20" type="text"/></li>
				<li><span>Address:</span><input name="voucher_order_address1" value="{$voucher_order.voucher_order_address1}" maxlength="50" type="text"/></li>
				<li><span></span><input name="voucher_order_address2" value="{$voucher_order.voucher_order_address2}" maxlength="49" type="text"/></li>
				<li class="city"><span>City:</span><input name="voucher_order_city" value="{$voucher_order.voucher_order_city}" maxlength="40" type="text"/></li>
				<li class="postcode"><span>Post Code:</span><input name="voucher_order_postcode" value="{$voucher_order.voucher_order_postcode}" maxlength="10" type="text"/></li>
				<li><span>Country:</span>
					<select name="voucher_order_country" id="country" class="booking-ddwn-length">
						{foreach key=key from=$COUNTRIES item=country}
							<option value="{$key}" {if $voucher_order.voucher_order_country == $key} selected="selected"{/if}>{$country}</option>
						{/foreach}
					</select>
				</li>
				<li><span>Email:</span><input name="voucher_order_email" value="{$voucher_order.voucher_order_email}" maxlength="100" type="text"/></li>
				<li><span>Telephone :</span><input name="voucher_order_phone" value="{$voucher_order.voucher_order_phone}" maxlength="20" type="text"/></li>
		</ul>
			</div>
		<div class="receiver">
			<h5>Receiver:</h5>
				<ul>
			<li><span>Name of person to receive this Voucher:</span><input name="voucher_order_to" type="text" value="{$voucher_order.voucher_order_to}" maxlength="50"/></li>
			<li><span>Phone number:</span><input name="voucher_order_phone_to" value="{$voucher_order.voucher_order_phone_to}" maxlength="20" type="text"/></li>

			<li><span>Name of the person voucher to be posted to:</span><input name="voucher_order_name_to" value="{$voucher_order.voucher_order_name_to}" maxlength="50" type="text"/></li>
			<li><span>Address of where the voucher is to be posted:</span><input name="voucher_order_address1_to" value="{$voucher_order.voucher_order_address1_to}" maxlength="250" type="text"/></li>
			<li class="message"><span>Message from sender:</span><textarea name="voucher_order_message">{$voucher_order.voucher_order_message}</textarea></li>
		</ul>
	</div>
</div>
</form>