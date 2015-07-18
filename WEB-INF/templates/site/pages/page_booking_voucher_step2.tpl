<form name="voucher_step2" method="post" action="booking.php?voucher_id={$voucher_id}&amp;subpage=voucher_step2">
    <input type="hidden" name="total" value="" id="total" />
<div class="breadcrum-step">
	<a href="#">1. Voucher details</a>
	<a href="#" class="selected">2. Ticket type</a>
	<a href="#">3. Resume and payment</a>
</div>

<div class="step step-2" style="display: block;">
	<header>
		<span>Step 2</span>
		<h3>Tickets</h3>
		<p>Please select the number of people joining the experience.</p>
	</header>
	<div class="buy-content">
		<div class="tickets-select">
			<div>
				<h5>Ticket type</h5>
				<ol>
                    {section name=i loop=$tickets}
                        <li>{$tickets[i].ticket_type}:</li>
                    {/section}
				</ol>
			</div>
			<div>
				<h5>Quantity</h5>
                {section name=i loop=$tickets}
                    <input type="hidden" name="ticket[]" value="{$tickets[i].ticket_id}" />
                    <input type="hidden" name="price[]" value="{$tickets[i].ticket_price}" />
                    <div>
                        <label for="select_{$tickets[i].ticket_id}"></label>
                        <select id="select_{$tickets[i].ticket_id}" ticketPrice="{$tickets[i].ticket_price}" onchange="calculate_total()" name="quantity[]" class="ticket cs-select cs-skin-elastic">
                            <option value="0" {if $tickets[i].quantity == 0}selected{/if}>0</option>
                            <option value="1" {if $tickets[i].quantity == 1}selected{/if}>1</option>
                            <option value="2" {if $tickets[i].quantity == 2}selected{/if}>2</option>
                            <option value="3" {if $tickets[i].quantity == 3}selected{/if}>3</option>
                            <option value="4" {if $tickets[i].quantity == 4}selected{/if}>4</option>
                            <option value="5" {if $tickets[i].quantity == 5}selected{/if}>5</option>
                            <option value="6" {if $tickets[i].quantity == 6}selected{/if}>6</option>
                            <option value="7" {if $tickets[i].quantity == 7}selected{/if}>7</option>
                            <option value="8" {if $tickets[i].quantity == 8}selected{/if}>8</option>
                            <option value="9" {if $tickets[i].quantity == 9}selected{/if}>9</option>
                            <option value="10" {if $tickets[i].quantity == 10}selected{/if}>10</option>
                        </select>
                    </div>
                {/section}


			</div>
			<div>
				<h5>Price(each)</h5>
                <ol>
                    {section name=i loop=$tickets}
                        <li>£{$tickets[i].ticket_price}</li>
                    {/section}
                </ol>
			</div>

            <small>BOOKING FEE: £3.95</small>
		</div>
		<div id="thecharter">
			<div>
				<h5>Terms</h5>
				<label for="terms"></label>
				<p>Please confirm that you have read <a href="javascript:openwind('terms.php', 700, 500, 'yes')">TERMS & CONDITIONS.</a></p>
			</div>
			<div onclick="selectCheck()" class="chartercheckbox"><input  onclick="selectCheck()" id="checkTerms" type="checkbox" name="confirm" value="checkbox" {if !empty($order.order_find)} checked="checked"{/if} id="terms"/>Accept</div>
		</div>
	</div>

</div>

	</form>
{literal}
    <script type="text/javascript">
        $(document).ready(function(){
            calculate_total();
        });

        function selectCheck() {
            if (document.getElementById('checkTerms').checked) {
                $('#checkTerms').prop("checked", false);
            } else {
                $('#checkTerms').prop("checked", true);
            }
        }
    </script>
{/literal}