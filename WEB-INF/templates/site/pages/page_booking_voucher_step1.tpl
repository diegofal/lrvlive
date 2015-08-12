<form name="voucher_step1" method="post" action="booking.php?voucher_id={$voucher_id}&amp;subpage=voucher_step1">
<div class="breadcrum-step">
	<a href="#" class="selected">1. Voucher details</a>
	<a href="#">2. Ticket type</a>
	<a href="#">3. Resume and payment</a>
</div>
<div class="step step-1">
	<header>
		<span>Step 1</span>
		<h3>Vouchers</h3>
		<p>Please enter the following details to purchase your Voucher</p>
	</header>
	<div class="buy-content">
		<div class="sender">
			<h5>Sender:</h5>
			<ul>
				<li class="name"><span>Name:</span><input name="voucher_order_name" value="{$voucher_order.voucher_order_name}" maxlength="20" type="text"/></li>
				<li class="surname"><span>Last Name:</span><input name="voucher_order_lastname" value="{$voucher_order.voucher_order_lastname}" maxlength="20" type="text"/></li>
				<li><span>Address:</span><input name="voucher_order_address1" value="{$voucher_order.voucher_order_address1}" maxlength="50" type="text"/></li>
				<li><span></span><input name="voucher_order_address2" value="{$voucher_order.voucher_order_address2}" maxlength="49" type="text"/></li>
				<li class="city"><span>City:</span><input name="voucher_order_city" value="{$voucher_order.voucher_order_city}" maxlength="40" type="text"/></li>
				<div id="divPostCode" ><li class="postcode"><span>Post Code:</span><input id="voucher_order_postcode" name="voucher_order_postcode" value="{$voucher_order.voucher_order_postcode}" maxlength="10" type="text"/></li></div>
				<div id="divPostCode1" ><li class="postcode"><span>Post Code:</span><input  value="N/A" type="text" readonly></li></div>
				<div><li><span>Country:</span>
					<select name="voucher_order_country" id="country" class="booking-ddwn-length" onchange="countryChange()">
						{foreach key=key from=$COUNTRIES item=country}
							<option value="{$key}" {if $voucher_order.voucher_order_country == $key} selected="selected"{/if}>{$country}</option>
						{/foreach}
					</select>
				</li></div>
				<li id="stateDiv" style="display:none">
					<span>State</span>
					<select name="voucher_order_state" id="state" class="booking-ddwn-length" >
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
				</li>
				<li><span>Email:</span><input name="voucher_order_email" value="{$voucher_order.voucher_order_email}" maxlength="100" type="text"/></li>
				<li><span>Telephone :</span><input name="voucher_order_phone" value="{$voucher_order.voucher_order_phone}" maxlength="20" type="text"/></li>
		</ul>
			</div>
		<div class="receiver">
			<h5>Receiver:</h5>
				<ul>
			<li><span>Name of person to receive this Voucher:</span><input name="voucher_order_to" type="text" value="{$voucher_order.voucher_order_to}" maxlength="50"/></li>
			<li><span>Phone number:</span><input name="voucher_order_phone_to" value="{$voucher_order.voucher_order_phone_to}" maxlength="20" type="text"/></li>

			<li><span>Name of the person voucher to be posted to:</span><input name="voucher_order_name_to" value="{$voucher_order.voucher_order_name_to}" maxlength="50" type="text"/></li>
			<li><span>Address of where the voucher is to be posted:</span><input name="voucher_order_address1_to" value="{$voucher_order.voucher_order_address1_to}" maxlength="250" type="text"/></li>
			<li class="message"><span>Message from sender:</span><textarea name="voucher_order_message">{$voucher_order.voucher_order_message}</textarea></li>
		</ul>
	</div>
</div>
</form>