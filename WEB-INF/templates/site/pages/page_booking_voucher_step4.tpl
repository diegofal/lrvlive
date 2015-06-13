<div class="booking-form vouchers_form">
	
<div class="booking-form-main">	
	<h1>Complete</h1>	
	
	<div class="bookingtext_1_new" style="padding-bottom:20px;">
		{if $results.status == 'OK'}
		Thank you for purchasing your voucher with London RIB Voyages. Please check your email for your Voucher details/confirmation.
		<br /><br />
		A printed Voucher will be sent to the address you provided in the form.
        {else}                      
        Sorry, the payment operation could not be performed properly. <br /><br />The error message: <strong>{$results.status}</strong>. <br /><br />Please follow <a href="booking.php?voucher_id={$voucher_id}&subpage=voucher_step3">this link</a> in order to try again. 
        {/if}
	</div>

</div></div>	

<!--Include Right Menu-->
	{include file="utils/site_right_menu_booking_sub.tpl" }
</div>	
