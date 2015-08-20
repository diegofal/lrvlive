<div class="breadcrum-step">
    <a href="#" class="selected">1. Trip type and seats</a>
    <a href="#">2. Date and time</a>
    <a href="#">3. Personal info</a>
    <a href="#">4. Confirmation</a>
</div>
<form name="step1" id="bookingForm" method="post" action="booking.php?tour_id={$tour_id}&subpage=step1">
    <input type="hidden" name="total" value="" id="total" />
<div class="step step-1">
    <header>
        <span>Step 1</span>
        <h3>Boat Trip: {$tour.tour_name}</h3>
        {if $tour.tour_name == 'Limehouse Blast'}
            <p> Please select the number of couples joining you for your experience.</p>
        {else}
        <p>Please select the number of adults and children joining you for your experience below.</p>
        {/if}
    </header>
    <div class="buy-content">
        <div id="mainbooking">
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
                        <select id="select_{$tickets[i].ticket_id}" {if ($order.order_tickets_number == 1) && ($order.order_tickets == 0)} disabled{/if}  ticketPrice="{$tickets[i].ticket_price}" onchange="calculate_total()" name="quantity[]" class="ticket cs-select cs-skin-elastic">
                            {if $tour.tour_name == 'Limehouse Blast'}
                                <option value="0" {if $tickets[i].quantity == 0}selected{/if}>0</option>
                                <option value="1" {if $tickets[i].quantity == 1}selected{/if}>1</option>
                                <option value="2" {if $tickets[i].quantity == 2}selected{/if}>2</option>
                                <option value="3" {if $tickets[i].quantity == 3}selected{/if}>3</option>
                                <option value="4" {if $tickets[i].quantity == 4}selected{/if}>4</option>
                                <option value="5" {if $tickets[i].quantity == 5}selected{/if}>5</option>
                                <option value="6" {if $tickets[i].quantity == 6}selected{/if}>6</option>
                            {else}
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
                            {/if}

                        </select>
                    </div>
                {/section}




            </div>
            <div>
                <h5>Price</h5>
                <ol>
                    {section name=i loop=$tickets}
                        <li>£{$tickets[i].ticket_price}</li>
                    {/section}
                </ol>
            </div>

            <small>BOOKING FEE: £3.95</small>
        </div>
        <div id="thecharter" {if $tour.tour_charter_price == 0 } style="display:none" {/if}>

            <div>



                <h5>Charters</h5>
                <label for="charter"></label>
                <p>Book the whole boat for a private and exclusive experience for up to twelve passengers.</p>
            </div>
            <div class="chartercheckbox" onclick="is_charter('{$tour.tour_charter_price}');"><input type="checkbox" name="charter" id="charter" {if ($order.order_tickets_number == 1) && ($order.order_tickets == 0)} checked="checked"{/if}/>&pound;{$tour.tour_charter_price} (12 seats)</div>

        </div>

    </div>

</div>

    <script type="text/javascript">
        var charter_price = "{$tour.tour_charter_price}";
    </script>
    {literal}
        <script type="text/javascript">
            $(document).ready(function(){
                calculate_total();

                if($("#charter").is(":checked")){
                    var price_fee = parseFloat($("#price_fee").val());

                    document.getElementById("total").value = parseFloat(charter_price) + price_fee;
                    document.getElementById("tot_price").innerHTML = Currency( parseFloat(charter_price) + price_fee);
                }
            });

//            {
//                $("#charter").click(function(){
//                    calculate_total();
//                })
//            })
        </script>
    {/literal}
