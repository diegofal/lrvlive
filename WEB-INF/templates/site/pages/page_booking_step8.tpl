{if $results.status == 'OK'}
{literal}
	<!-- STEP 8 - Google Analytics -->
<script language="javascript" type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-23852518-1']);
	_gaq.push(['_trackPageview']);
	_gaq.push(['_addTrans',{/literal}
		'{$ga_trans.order_id}',           // order ID - required
		'{$ga_trans.store_name}',  // affiliation or store name
		'{$ga_trans.total}',          // total - required
		'{$ga_trans.tax}',           // tax
		'{$ga_trans.shipping}',              // shipping
		'{$ga_trans.city}',       // city
		'{$ga_trans.state}',     // state or province
		'{$ga_trans.country}'             // country{literal}
	]);

	// add item might be called for every item in the shopping cart
	// where your ecommerce engine loops through each item in the cart and
	// prints out _addItem for each
	{/literal}
	{foreach from=$ga_items key=id item=ticket}
	_gaq.push(['_addItem',
		'{$ticket.order_id}',           // order ID - required
		'{$ticket.code}',           // SKU/code - required
		"{$ticket.product}",        // product name
		"{$ticket.variation}",   // category or variation
		"{$ticket.unit_price}",          // unit price - required
		"{$ticket.quantity}"               // quantity - required
	]);
	{/foreach}{literal}
	_gaq.push(['_trackTrans']); //submits transaction to the Analytics servers

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
{/literal}
{/literal}
	<section id="random-section" class="success">
		<div>
			<h1>Payment process successful :)</h1>
			<div class="content">
				<p class="lead">Thank you for your booking, we look forward to seeing you on-board</p>
				<p>If you have any questions you can contact us on:<br>- by phone: <strong>020 7928 8933</strong><br>- by email: <a href="mailto:bookings@londonribvoyages.com">bookings@londonribvoyages.com</a></p>
			</div>
		</div>
	</section>
{else}
	<section id="random-section" class="error">
		<div>
			<h1>Something went wrong :(</h1>
			<div class="content">
				<p class="lead">The payment operation could not be performed properly: <strong>{$results.status}</strong></p>
				<p>Try again or contact us<br>- by phone: <strong>0207 - 928 - 8933</strong><br>- by mail: <a href="mailto:bookings@londonribvoyages.com">bookings@londonribvoyages.com</a></p>
			</div>
		</div>
	</section>
{/if}
