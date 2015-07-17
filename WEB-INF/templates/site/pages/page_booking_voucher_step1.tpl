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
		<ul>
			<li><span>Name of person to receive this Voucher:</span><input name="voucher_order_to" type="text" value="{$voucher_order.voucher_order_to}" maxlength="50"/></li>
			<li><span>Phone number of receiver:</span><input name="voucher_order_phone_to" value="{$voucher_order.voucher_order_phone_to}" maxlength="20" type="text"/></li>

			<li><span>Name of sender:</span><input name="voucher_order_name" value="{$voucher_order.voucher_order_name}" maxlength="100" type="text"/></li>

			<li><span>Last Name of sender:</span><input name="voucher_order_lastname" value="{$voucher_order.voucher_order_lastname}" maxlength="100" type="text"/></li>
			<li><span>Telephone of sender:</span><input name="voucher_order_phone" value="{$voucher_order.voucher_order_phone}" maxlength="20" type="text"/></li>
			<li><span>Email of sender:</span><input name="voucher_order_email" value="{$voucher_order.voucher_order_email}" maxlength="100" type="text"/></li>

			<li><span>Address of sender:</span><input name="voucher_order_address1" value="{$voucher_order.voucher_order_address1}" maxlength="50" type="text"/></li>
			<li><span></span><input name="voucher_order_address2" value="{$voucher_order.voucher_order_address2}" maxlength="50" type="text"/></li>

			<li><span>City of sender:</span><input name="voucher_order_city" value="{$voucher_order.voucher_order_city}" maxlength="50" type="text"/></li>
			<li><span>Post Code of sender:</span><input name="voucher_order_postcode" value="{$voucher_order.voucher_order_postcode}" maxlength="50" type="text"/></li>
			<li><span>Country of sender:</span><input name="voucher_order_country" value="{$voucher_order.voucher_order_country}" maxlength="50" type="text"/></li>


			<li><span>Name of the person voucher to be posted to:</span><input name="voucher_order_name_to" value="{$voucher_order.voucher_order_name_to}" maxlength="50" type="text"/></li>
			<li><span>Address of where the voucher is to be posted:</span><input name="voucher_order_address1_to" value="{$voucher_order.voucher_order_address1_to}" maxlength="250" type="text"/></li>
			<li><span>Message from sender:</span><textarea name="voucher_order_message">{$voucher_order.voucher_order_message}</textarea></li>
		</ul>
	</div>
</div>
</form>