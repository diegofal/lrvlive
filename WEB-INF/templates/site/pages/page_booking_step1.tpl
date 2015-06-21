<form name="step1" method="post" action="booking.php?tour_id={$tour_id}&subpage=step1">
<div class="step step-1">
    <header>
        <span>Step 1</span>
        <h3>Choose your trip type and seats</h3>
        <p>On the final step you will see a full payment detail before the confirmation.</p>
    </header>
    <div class="buy-content">

        <div>
            <label for="trip">Trip:</label>
            <select id="trip" name="trip" class="cs-select cs-skin-elastic">
                <option value="" disabled>Select your trip </option>
                <option value="9" {if $tour_id==9} selected{/if}>The Ultimate London Adventure</option>
                <option value="1" {if $tour_id==1} selected{/if}>Captain Kidd's Canary Wharf</option>
                <option value="4" {if $tour_id==4} selected{/if}>Thames Barrier Explorers Voyage</option>
                <option value="12" {if $tour_id==12} selected{/if}>Break The Barrier (Speed only)</option>
                <option value="-1">Spring has Sprung</option>
            </select>
        </div>

        {section name=i loop=$tickets}
        <div>
            <input name="ticket[]" type="hidden" value="{$tickets[i].ticket_id}" />
            <input name="price[]" type="hidden" value="{$tickets[i].ticket_price}" />

            <label for="ticket_type_{$tickets[i].ticket_id}">{$tickets[i].ticket_type}:</label>
            <select id="ticket_type_{$tickets[i].ticket_id}" name="quantity[]" onchange="calculate_total()" class="cs-select ticket cs-skin-elastic">
                <option value="0" disabled selected>0</option>
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
        {*<div>*}
            {*<label for="adult">Adult:</label>*}
            {*<select id="adult" name="adult" class="cs-select cs-skin-elastic">*}
                {*<option value="0" disabled selected>0</option>*}
                {*<option value="1">1</option>*}
                {*<option value="2">2</option>*}
                {*<option value="3">3</option>*}
                {*<option value="4">4</option>*}
                {*<option value="5">5</option>*}
                {*<option value="6">6</option>*}
                {*<option value="7">7</option>*}
                {*<option value="8">8</option>*}
                {*<option value="9">9</option>*}
                {*<option value="10">10</option>*}
            {*</select>*}
        {*</div>*}
        {*<div>*}
            {*<label for="child">Child (10 - 14):</label>*}
            {*<select id="child" name="child" class="cs-select cs-skin-elastic">*}
                {*<option value="0" disabled selected>0</option>*}
                {*<option value="1">1</option>*}
                {*<option value="2">2</option>*}
                {*<option value="3">3</option>*}
                {*<option value="4">4</option>*}
                {*<option value="5">5</option>*}
                {*<option value="6">6</option>*}
                {*<option value="7">7</option>*}
                {*<option value="8">8</option>*}
                {*<option value="9">9</option>*}
                {*<option value="10">10</option>*}
            {*</select>*}
        {*</div>*}
        {*<div>*}
            {*<label for="couple">Couple:</label>*}
            {*<select id="couple" name="couple" class="cs-select cs-skin-elastic">*}
                {*<option value="0" disabled selected>0</option>*}
                {*<option value="1">1</option>*}
                {*<option value="2">2</option>*}
                {*<option value="3">3</option>*}
                {*<option value="4">4</option>*}
                {*<option value="5">5</option>*}
                {*<option value="6">6</option>*}
                {*<option value="7">7</option>*}
                {*<option value="8">8</option>*}
                {*<option value="9">9</option>*}
                {*<option value="10">10</option>*}
            {*</select>*}
        {*</div>*}
        {*<div>*}
            {*<label for="family">Family (2 + 2):</label>*}
            {*<select id="family" name="family" class="cs-select cs-skin-elastic">*}
                {*<option value="0" disabled selected>0</option>*}
                {*<option value="1">1</option>*}
                {*<option value="2">2</option>*}
                {*<option value="3">3</option>*}
                {*<option value="4">4</option>*}
                {*<option value="5">5</option>*}
                {*<option value="6">6</option>*}
                {*<option value="7">7</option>*}
                {*<option value="8">8</option>*}
                {*<option value="9">9</option>*}
                {*<option value="10">10</option>*}
            {*</select>*}
        {*</div>*}

        <div>
            <label for="charter">Charter ?</label>
            <input type="checkbox" name="charter" id="charter"/>
        </div>
    </div>


</div>
</form>