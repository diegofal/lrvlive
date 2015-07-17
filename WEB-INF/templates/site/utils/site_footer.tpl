{if $page != map}
<section id="footerlinks" class="grid">
    <a href="map.php" class="col-1-4">
        <img src="content/img/home/points.jpg" />
        <div class="text">
            <h3>Meeting Points</h3>
            <h6>Check the places you are visiting</h6>
        </div>
    </a>
    <a href="safety.php" class="col-1-4 safety">
        <img src="content/img/home/safety.jpg" />
        <div class="text">
            <h3>Safety first</h3>
            <h6>Clear and unswerving commitment to safety</h6>
        </div>
    </a>
    <a href="services.php" class="col-1-4">
        <img src="content/img/home/services.jpg" />
        <div class="text">
            <h3>Services</h3>
            <h6>Corporate, filming and more </h6>
        </div>
    </a>
    <a href="crew.php" class="col-1-4">
        <img src="content/img/home/crew.jpg" />
        <div class="text">
            <h3>The Crew</h3>
            <h6>Meet the best guides in London</h6>
        </div>
    </a>
</section>
{/if}
{literal}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
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
    <script src="js/booking.js"></script>
    <script src="js/slick/slick.min.js"></script>

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
        /*
        $('#datetimepicker3').datetimepicker({
            inline:true
        });
        */
    </script>

    <script>
        /*
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
            currentIndex += 1;
            if (currentIndex > itemAmt - 1) {
                currentIndex = 0;
                window.location.href = "http://www.sagepay.co.uk/";
            }
            else{
            }
            cycleItems();
        });
*/
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
            [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
                new SelectFx(el);
            } );
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

            $("[class='md-trigger']").click(function(){

            })
        });
    </script>
{/literal}



<footer id="footer-main">
    <div class="grid">


        <div class="col-1-4 contact">
            <h4>Need help?</h4>
            <p>Give us a call or drop us a line and we‘ll answer as soon as possible!</p>
            <ul>
                <li><span>Booking</span>
                    <a href="#">bookings@londonribvoyages.com</a></li>

                <li><span>Tell us how it was!</span>
                    <a href="#">feedback@londonribvoyages.com</a></li>

                <li><span>Phone</span>
                    0207 - 928 - 8933</li>
            </ul>
        </div>
        <div class="col-1-4 sitemap">

            <h4>Newsletter</h4>
            <p>Suscribe to our newsletter! <br>Get special discounts and news about our lastest trips.</p>
            </br>
            <input type="email" placeholder="your@mail.com">
            <!--<ul>
                <li><span> + </span><a href="index.php"> home </a></li>
                <li><span> + </span><a href="index.php#trips"> trips </a></li>
                <li><span> + </span><a href="why-us.php"> why us? </a></li>
                <li><span> + </span><a href="crew.php"> crew </a></li>
                <li><span> + </span><a href="map.php"> meeting points </a></li>
                <li><span> + </span><a href="services.php"> services </a></li>
                <li><span> + </span><a href="safety.php"> safety </a></li>
                <li><span> + </span><a href="https://londonribvoyages.wordpress.com/" target="_blank"> blog </a></li>
            </ul>-->
        </div>
        <div class="col-1-4 news">
            <h4>News</h4>
            <ul class="">
                <li><a href="https://londonribvoyages.wordpress.com/2015/02/05/no-cringe-allowed-try-something-different-this-valentines-day/">Have yourself a Merry Little RIBMASS!</a></li>
                <li><a href="https://londonribvoyages.wordpress.com/2015/02/05/no-cringe-allowed-try-something-different-this-valentines-day/">Spring is sprung!</a></li>
                <li><a href="https://londonribvoyages.wordpress.com/2015/02/05/no-cringe-allowed-try-something-different-this-valentines-day/">Two new boats, two maiden voyages!</a></li>
                <li><a href="https://londonribvoyages.wordpress.com/2015/02/05/no-cringe-allowed-try-something-different-this-valentines-day/">Stag and hen parties…at speed!</a></li>
                <li><a href="https://londonribvoyages.wordpress.com/2015/02/05/no-cringe-allowed-try-something-different-this-valentines-day/">It’s time for the Thames Festival!</a></li>
            </ul>
        </div>
        <div class="col-1-4 social">
            <h4>Follow us!</h4>
            <ul class="">
                <li><a href="https://www.facebook.com/londonribvoyages" target="_blank"><span class="icon"> <img src="content/img/social/facebook-icon.png" /> </span><span>Facebook</span></a></li>
                <li><a href="http://www.tripadvisor.co.uk/Attraction_Review-g186338-d1526046-Reviews-London_Rib_Voyages-London_England.html" target="_blank"><span class="icon"> <img src="content/img/social/trip-icon.png" /> </span><span>Trip Advisor</span></a></li>
                <li><a href="https://londonribvoyages.wordpress.com/" target="_blank"><span class="icon"> <img src="content/img/social/blog-icon.png" /> </span><span>Blog</span></a></li>
                <li><a href="https://twitter.com/LondonRIB?lang=en" target="_blank"><span class="icon"> <img src="content/img/social/twitter-icon.png" /> </span><span>Twitter</span></a></li>
                <li><a href="https://www.youtube.com/channel/UC_78eKTUZPWQv7Yhb6jIJVA" target="_blank"><span class="icon"> <img src="content/img/social/youtube-icon.png" /> </span><span>YouTube</span></a></li>
            </ul>
        </div>
    </div>
</footer>

<div class="md-overlay"></div>
</body>
</html>
