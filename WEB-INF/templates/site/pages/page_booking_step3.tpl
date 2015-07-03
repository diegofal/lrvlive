<form name="step3" id="bookingForm" method="post" action="booking.php?tour_id={$tour_id}&subpage=step3">
    <div class="breadcrum-step">
        <a href="#" >1. Trip type and seats</a>
        <a href="#" >2. Date and time</a>
        <a href="#" class="selected">3. Personal info</a>
        <a href="#">4. Confirmation</a>
    </div>

<div class="step step-3" style="display: block;">
    <header>
        <span>Step 3</span>
        <h3>Complete your personal information</h3>
        <p>And save one pound in just in one click!</p>
    </header>
    <div class="buy-content">
        <form id="personal-info">
            <div>
                <label for="name">First name</label>
                <input name="order_first_name" id="name" type="text" value="{$order.order_first_name}"/>
            </div>
            <div>
                <label for="lastname">Surname / Last name</label>
                <input name="order_last_name" id="lastname" type="text" value="{$order.order_last_name}"/>
            </div>
            <div>
                <label for="phone">Phone</label>
                <input name="order_phone" id="phone" type="number" value="{$order.order_phone}"/>
            </div>
            <div>
                <label for="email">Email</label>
                <input name="order_email" id="email" type="email"  value="{$order.order_email}/>
            </div>
            <div>
                <label for="country">Country</label>
                <input name="order_country" id="country" type="text" value="{$order.order_country}/>
            </div>
            <div>
                <label for="city">City</label>
                <input name="order_city" id="city" type="text" value="{$order.order_city}/>
            </div>
            <div>
                <label for="address">Address</label>
                <input name="order_street_address1" id="address" type="text" value="{$order.order_street_address1}/>
            </div>
            <div>
                <label for="address2">Aditional address</label>
                <input name="order_street_address2" id="address2" type="text" value="{$order.order_street_address2}/>
            </div>
            <div>
                <label for="postcode">Post code</label>
                <input name="order_zip" id="postcode" type="text" value="{$order.order_zip}/>
            </div>

            <div>
                <label for="how">How did you find us ?</label>
                <select name="order_find" id="how" class="cs-select cs-skin-elastic">
                    <option value="0"  disabled selected>Please select</option>
                    <option value="Friend referral, word of mouth">Friend referral, word of mouth</option>
                    <option value="Editorial, press release">Editorial, press release</option>
                    <option value="Walk by, seen boats on the river">Walk by, seen boats on the river</option>
                    <option value="Website link">Website link</option>
                    <option value="Leaflet or postcard">Leaflet or postcard</option>
                    <option value="Website, search engine">Website, search engine</option>
                    <option value="Returning London RIB Voyager">Returning London RIB Voyager</option>
                    <option value="Visit London">Visit London</option>
                    <option value="Great Date Guide">Great Date Guide</option>
                    <option value="Social Media">Social Media</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div>
                <div class="fb-like" data-href="https://www.facebook.com/londonribvoyages" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
            </div>
            <div>
                <input id="terms" type="checkbox" />
                <label for="terms">Please confirm that you have read our <a href="#">Terms & Conditions.</a></label>
            </div>
        </form>
    </div>
</div>
