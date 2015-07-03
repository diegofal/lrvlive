<div class="breadcrum-step">
    <a href="#" >1. Trip type and seats</a>
    <a href="#" >2. Date and time</a>
    <a href="#" >3. Personal info</a>
    <a href="#" class="selected">4. Confirmation</a>
</div>

<div class="step step-4" style="display: block;">
    <header>
        <span>Step 4</span>
        <h3>Re-check  your information and proceed to payment</h3>
        <p>You will be redirected to Protx.com, a provider of secure online credit card and debit card payment solutions for thousands of online and mail order businesses across the UK.</p>
    </header>
    <div class="buy-content">
        <div id="resume" class="grid">
            <ul class="personal col-1-3">
                <li>Personal</li>
                <li><span>Name</span>{$order.order_first_name} {$order.order_last_name}</li>
                <li><span>Phone</span>{$order.order_phone}</li>
                <li><span>E-Mail</span>{$order.order_email}</li>
            </ul>

            <ul class="trip col-1-3">
                <li>Trip</li>
                <li>Trip</li>
                <li><span>Trip</span>{$tour}</li>
                <li><span>Date</span>{$departure.departure_date|date_format:"%d %b %Y"}</li>
                <li><span>Time</span>{$departure.departure_time|truncate:5:""}</li>
                {section name=i loop=$tickets}
                    <li><span>{$tickets[i].type}</span>&pound;{$tickets[i].price} ({$tickets[i].quantity})</li>
                {sectionelse}
                    <li><span>Charter</span>&pound;{math equation="x - y " x=$order.order_total y=$price_fee format="%.2f"} (1})</li>
                {/section}
            </ul>

            <ul class="extras col-1-3">
                <li>Extras</li>
                <li><span>Extras</span>£{$price_fee}</li>
                <li><span>Discount</span>£0.00</li>
            </ul>
        </div>
    </div>
</div>