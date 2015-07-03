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
                <li><span>Trip</span>The Ultimate London Adventure</li>
                <li><span>Date</span>16 april 2015</li>
                <li><span>Time</span>13:00 hs</li>
                <li><span>Adults</span>£75.90 (2)</li>
                <li><span>Childrens</span>£75.90 (2)</li>
                {section name=i loop=$tickets}
                <div class="style_div_detail1">
                    <div class="style_step3_7">
                        <div class="style_step3_16">{$tickets[i].type}</div>
                        <div class="style_step3_17" style="text-align:center">{$tickets[i].quantity} @ &pound;{$tickets[i].price}</div>
                        <div class="style_step3_15" style="text-align:center">&pound;{$tickets[i].total}</div>
                    </div>
                </div>
                {sectionelse}
                    <div class="style_div_detail1">
                        <div class="style_step3_7">
                            <div class="style_step3_16" style="text-align:center"><strong>Charter</strong></div>
                            <div class="style_step3_17" style="text-align:center">1 @ &pound;{math equation="x - y" x=$order.order_total y=$price_fee format="%.2f"}</div>
                            <div class="style_step3_15" style="text-align:center">&pound;{math equation="x - y " x=$order.order_total y=$price_fee format="%.2f"}</div>
                        </div>
                    </div>
                {/section}
            </ul>

            <ul class="extras col-1-3">
                <li>Extras</li>
                <li><span>Extras</span>£3.95</li>
                <li><span>Discount</span>£0.00</li>
            </ul>
        </div>
    </div>
</div>