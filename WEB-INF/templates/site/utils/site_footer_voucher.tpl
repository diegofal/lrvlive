<footer>
	{if $error == 'expired' }
		<p class="msj error" style="display: block"><span class="icon">Session expired</p>
	{/if}
	{if $error == 'nodata' }
		<p class="msj error" style="display: block"><span class="icon">No data received</p>
	{/if}
    {if $error == 'busy' }
        <p class="msj error" style="display: block"><span class="icon">We apologize, this trip is now complete, please try again</p>
    {/if}
	<div class="grid">
        {if $subpage=="_voucher_step1"}

			{if $mobile==y}
				<div class="col-1-3"><a href="#" id="prev" class="btn md-close btn-secondary" onclick="javascript:$(window.close())"> Close </a></div>
			{else}
				<div class="col-1-3"><a href="#" id="prev" class="btn md-close btn-secondary" onclick="javascript:$(window.parent.document.querySelector('.md-overlay')).click();"> Close </a></div>
			{/if}

        {else}
            <div class="col-1-3"><a href="javascript:history.back()" id="prev" class="btn md-close btn-secondary"> Back </a></div>
        {/if}
		<div class="col-1-3"><p class="price-total"><span>&pound;</span><span id="tot_price" class="number">{$total}</span></p></div>
		<div class="col-1-3"><a href="javascript:check_form();" id="next" class="btn btn-main" > Next </a></div>
		<!--<input type="submit" class="btn btn-main" value="Next">-->
	</div>
</footer>

<input type="hidden" name="price_fee" value="{$price_fee}" id="price_fee" />

</section>
</body>

{literal}

	<script src="js/plugins.js"></script>
	<script src="js/main.js"></script>
	<script src="js/plugins/jquery.easing.1.3.js"></script>
	<script src="js/plugins/jquery.animate-enhanced.min.js"></script>
	<script src="js/plugins/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/plugins/modalEffects.js"></script>
	<script src="js/plugins/classie.js"></script>
	<!--<script type="text/javascript" src="slick/slick.min.js"></script>-->

	<script>


		$(function() {
			var header = $(".clearHeader");
			$(window).scroll(function() {
				var scroll = $(window).scrollTop();

				if (scroll >= 200) {
					header.removeClass('clearHeader').addClass("darkHeader");
				} else {
					header.removeClass("darkHeader").addClass('clearHeader');
				}
			});
			$('.dropdown-btn').on('click', function(e) {
				$('.select-trip-items').toggleClass("pressed");
				$('.dropdown-btn').toggleClass("pressed");
				e.preventDefault();
			});
			// Si clickear cualquier item del menu, oculpa el menu
			$('.md-trigger').on('click', function(e) {
				$('.select-trip-items').toggleClass("pressed");
				$('.dropdown-btn').toggleClass("pressed");
				e.preventDefault();
			});
		});
	</script>
	<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
	<script>
		(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
				function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='//www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
		ga('create','UA-XXXXX-X','auto');ga('send','pageview');
	</script>
	<script type="text/javascript">
		$(document).ready(function() {

			//logic(Date.now().getDate)
			var s = $(".facts-container");
			var pos = s.position();
			$(window).scroll(function() {
				var windowpos = $(window).scrollTop();

				if (windowpos >= pos.top) {
					s.addClass("stick");
				} else {
					s.removeClass("stick");
				}
			});
		});

		function calculate_total(){
			var total = 0;

			var ticketSelects = $("select[class*='ticket']");
			ticketSelects.each(function(){
				var select = $(this);
				var ticketPrice = select.attr('ticketPrice');
				var ticketCount = select.val();

				total += parseInt(ticketCount)*parseFloat(ticketPrice);
			})

			// Added by Carlos
			if (total != 0){
				total += parseFloat($("#price_fee").val());
			}

			//document.step1.total.value = Currency(total);


			document.getElementById("total").value = total;
			document.getElementById("tot_price").innerHTML = Currency(total);

		}

	</script>
	<div id="ttdUniversalPixelTag4a9161caa8c54b588047dde860cf3d9f" style="display:none">
		<script src="https://js.adsrvr.org/up_loader.1.1.0.js" type="text/javascript"></script>
		<script type="text/javascript">
			(function(global) {
				if (typeof TTDUniversalPixelApi === 'function') {
					var universalPixelApi = new TTDUniversalPixelApi();
					universalPixelApi.init("0bevose", ["kx216da"], "https://insight.adsrvr.org/track/up", "ttdUniversalPixelTag4a9161caa8c54b588047dde860cf3d9f");
				}
			})(this);
		</script>
	</div>
{/literal}
</html>