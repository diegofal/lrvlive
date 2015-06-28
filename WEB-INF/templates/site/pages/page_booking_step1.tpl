<form name="step1" method="post" action="booking.php?tour_id={$tour_id}&subpage=step1">
<div class="step step-1">
    <header>
        <span>Step 1</span>
        <h3>Boat Trip: {$tour.tour_name}</h3>
        <p>Please select the number of adults and children joining you for your experience below.</p>
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
                        <select id="select_{$tickets[i].ticket_id}" ticketPrice="{$tickets[i].ticket_price}" name="quantity[]" class="ticket cs-select cs-skin-elastic">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
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
        <div id="thecharter">
            <div>
                <h5>Charters</h5>
                <label for="charter"></label>
                <p>Book the whole boat for a private and exclusive experience for up to twelve passengers.</p>
            </div>
            <div class="chartercheckbox"><input type="checkbox" id="charter" onclick="is_charter('{$tour.tour_charter_price}');"/>${$tour.tour_charter_price} (12 seats)</div>
        </div>

    </div>

</div>

    {*{literal}*}
        {*<script type="text/javascript">*}
            {*$(document).ready(function()*}
            {*{*}
                {*$("#charter").click(function(){*}
                    {*calculate_total();*}
                {*})*}
            {*})*}
        {*</script>*}
    {*{/literal}*}
