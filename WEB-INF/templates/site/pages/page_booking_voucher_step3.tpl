<form name="step3" method="post" action="{$vspsite}">
	<input type="hidden" name="VPSProtocol" value="3.0">
	<input type="hidden" name="TxType" value="PAYMENT">
	<input type="hidden" name="Vendor" value="londonribvoyage">
	<input type="hidden" name="Crypt" value="{$crypt}">
<div class="breadcrum-step">
	<a href="#">1. Voucher details</a>
	<a href="#">2. Ticket type</a>
	<a href="#" class="selected">3. Resume and payment</a>
</div>

<div class="step step-3" style="display: block;">
	<header>
		<span>Step 3</span>
		<h3>Re-check  your information and proceed to payment</h3>
		<p>You will be redirected to Protx.com, a provider of secure online credit card and debit card payment solutions for thousands of online and mail order businesses across the UK.</p>
	</header>
	<div class="buy-content">
		<div id="resume" class="grid">
			<ul class="personal col-1-3">
				<li>Sender</li>
				<li><span>Name</span>{$voucher_order.voucher_order_name}</li>
				<li><span>Phone</span>{$voucher_order.voucher_order_phone}</li>
				<li><span>E-Mail</span>{$voucher_order.voucher_order_email}</li>
				<li><span>Message</span>{$voucher_order.voucher_order_message}</li>
			</ul>

			<ul class="trip col-1-3">
				<li>Receiver</li>

				<li><span>Name</span>{$voucher_order.voucher_order_to}</li>
				<li><span>Phone</span>{$voucher_order.voucher_order_phone_to}</li>
				<li><span>Address</span>{$voucher_order.voucher_order_address1_to}</li>
				<li><span>Person of who it is to be posted</span>{$voucher_order.voucher_order_name_to}</li>

			</ul>

			<ul class="extras col-1-3">
                <li>Trip</li>
				<li><span>Trip</span>{$tourName}</li>
                {section name=i loop=$tickets}
                    <li><span>{$tickets[i].type}</span>£ {$tickets[i].price} ({$tickets[i].quantity})</li>
                {/section}
				<li><span>Extras</span>£3.95</li>
			</ul>
		</div>
	</div>
</div>
    </form>

{literal}
	<script>function check_form(){
			document.step3.submit();
		}</script>
	{/literal}