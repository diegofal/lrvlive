<footer>
    <p class="msj error"><span class="icon">Aca va un mensaje de error de algo mal seleccionado</p>
    <div class="grid">
        <div class="col-1-3"><a href="#" id="prev" class="btn md-close btn-secondary"> cancel </a></div>
        <div class="col-1-3"><p class="price-total"><span>$</span><span id="tot_price" class="number">0.00</span></p></div>
        <div class="col-1-3"><a href="#" id="next" class="btn btn-main"> siguiente </a></div>
    </div>
</footer>

<input type="hidden" name="price_fee" value="{$price_fee}" id="price_fee" />
<input type="hidden" name="total" value="" id="total_val" />
</form>
</section>
</body>

{literal}

<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script src="js/plugins/jquery.easing.1.3.js"></script>
<script src="js/plugins/jquery.animate-enhanced.min.js"></script>
<script src="js/plugins/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7"></script>
<script src="js/plugins/maplace-0.1.3.js"></script>
<script src="js/plugins/modalEffects.js"></script>
<script src="js/plugins/classie.js"></script>
<script src="js/plugins/selectFx.js"></script>
<script src="js/plugins/jquery.datetimepicker.js"></script>

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
    $('#datetimepicker3').datetimepicker({
        inline:true
    });
</script>

<script>
    var currentIndex = 0,
            items = $('.step'),
            itemAmt = items.length;

    function cycleItems() {
        var item = $('.step').eq(currentIndex);
        items.hide();
        item.css('display','block');
        // $('#buy').addClass('step-' + currentIndex);

    }


    $('#next').click(function() {
//        currentIndex += 1;
//        if (currentIndex > itemAmt - 1) {
//            currentIndex = 0;
//            window.location.href = "http://www.sagepay.co.uk/";
//        }
//        else{
//        }
//        cycleItems();

        $("form").submit();
    });

    // $('#prev').click(function() {
    //   currentIndex -= 1;
    //   if (currentIndex < 0) {
    //     currentIndex = itemAmt - 1;
    //   }
    //   cycleItems();
    // });
</script>
<script>
    (function() {
        $("select.cs-select").each(function(){
            var options = {};

            if ($(this).hasClass('ticket')){
                options.onChange = function(){
                    calculate_total();
                }
            }

            new SelectFx(this, options);
        })

    })();
</script>

<script type="text/javascript">
    $(document).ready(function() {
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
        document.getElementById("total_val").value = total;
        document.getElementById("tot_price").innerHTML = Currency(total);

    }

</script>
{/literal}
</html>


