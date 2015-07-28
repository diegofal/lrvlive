<form name="step2" id="bookingForm" method="post" action="booking.php?tour_id={$tour_id}&subpage=step2">
    <input name="selected_departure" id="selected_departure" type="hidden" value="" />
    <input name="tour_id" id="tour_id" type="hidden" value="{$tour_id}" />
    <input name="order_id" id="order_id" type="hidden" value="{$sessionId[0]}" />
    <input name="number_of_people" type="hidden" value="{$order.order_tickets_number}" />
    <input type="hidden" name="selected_date" id="selected_date" value="{$smarty.now|date_format:"%Y-%m-%d"}" />
    <div class="breadcrum-step">
        <a href="#" >1. Trip type and seats</a>
        <a href="#" class="selected">2. Date and time</a>
        <a href="#">3. Personal info</a>
        <a href="#">4. Confirmation</a>
    </div>

    <div class="step step-2" style="display: block;">
        <header>
            <span>Step 2</span>
            <h3>Choose your date and time of departure</h3>
            <p>If you are a party of over 8 and require a departure time that is not listed please call 020 7928 8933.</p>
        </header>
        <div class="buy-content">
            <input name="selectedDate" type="text" id="datetimepicker3"/><br><br>
        </div>
    </div>
</form>