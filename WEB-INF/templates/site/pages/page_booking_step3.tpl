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
                <input name="order_first_name" id="name" type="text" maxlength="20" value="{$order.order_first_name}"/>
            </div>
            <div>
                <label for="lastname">Surname / Last name</label>
                <input name="order_last_name" id="lastname" type="text" maxlength="20" value="{$order.order_last_name}"/>
            </div>
            <div>
                <label for="phone">Phone</label>
                <input name="order_phone" id="phone" type="number" maxlength="20" value="{$order.order_phone}"/>
            </div>
            <div>
                <label for="email">Email</label>
                <input name="order_email" id="email" type="email"  maxlength="50" value="{$order.order_email}"/>
            </div>
            <div>
                <label for="country">Country</label>
                <select name="order_country" id="country" class="booking-ddwn-length" onchange="countryChange()">
                {foreach key=key from=$COUNTRIES item=country}
                    <option value="{$key}" {if $order.order_country == $key} selected="selected"{/if}>{$country}</option>
                {/foreach}
                </select>
            </div>
            <div id="stateDiv" style="display:none">
                <label for="country">State</label>
                <select name="order_state" id="state" class="booking-ddwn-length" >
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AS">American Somoa</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UM">United States Minor Outlying Islands</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option></select>
            </div>
            <div>
                <label for="city">City</label>
                <input name="order_city" id="city" type="text" maxlength="40" value="{$order.order_city}"/>
            </div>
            <div>
                <label for="address">Address</label>
                <input name="order_street_address1" id="address" type="text" maxlength="50" value="{$order.order_street_address1}"/>
            </div>
            <div>
                <label for="address2">Aditional address</label>
                <input name="order_street_address2" id="address2" type="text" maxlength="49" value="{$order.order_street_address2}"/>
            </div>
            <div id="divPostCode">
                <label for="postcode">Post code</label>
                <input name="order_zip" id="postcode" type="text"  maxlength="10" value="{$order.order_zip}"/>
            </div>

            <div>
                <label for="how">How did you find us ?</label>

                <select name="order_find" id="how" class="booking-ddwn-length">
                    <option value="0">Please select</option>
                    {section name=b loop=$hear_about_us}
                        <option value="{$hear_about_us[b].Title}" {if $order.order_find == $hear_about_us[b].Title} selected="selected"{/if}>{$hear_about_us[b].Title}</option>
                    {/section}
                </select>

            </div>
            <div>
                <div class="fb-like" data-href="https://www.facebook.com/londonribvoyages" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
            </div>
            <div>
                <input id="terms" type="checkbox" {if !empty($order.order_find)} checked="checked"{/if}/>
                <label for="terms">Please confirm that you have read our <a href="javascript:openwind('terms.php', 700, 500, 'yes')">Terms & Conditions.</a></label>
            </div>
        </form>
    </div>
</div>
