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
                    020 7928 8933</li>
            </ul>
        </div>
        <div class="col-1-4 sitemap">

            <h4>Newsletter</h4>
            <p>Suscribe to our newsletter! <br>Get special discounts and news about our lastest trips.</p>
            </br>
            <input disabled type="email" placeholder="coming soon!">
            <br><a href="termsandconditions.pdf" target="_blank">Terms and Conditions</a>

        </div>
        <div class="col-1-4 news">
            <h4>News</h4>
            <ul class="">
                <li><a href="https://londonribvoyages.wordpress.com/2015/07/31/hottest-july-ever/">Hottest July Ever!</a></li>
                <li><a href="https://londonribvoyages.wordpress.com/2015/07/30/schools-out-for-summer/">School’s out for summer!</a></li>
                <li><a href="https://londonribvoyages.wordpress.com/2015/07/24/the-garden-bridge/">The garden bridge</a></li>
                <li><a href="https://londonribvoyages.wordpress.com/2015/07/19/90-years-of-tauck/">90 years of tauck</a></li>
                <li><a href="https://londonribvoyages.wordpress.com/2015/07/17/bond-spotted-on-the-thames/">Bond spotted on the thames</a></li>
            </ul>
        </div>
        <div class="col-1-4 social">
            <h4>Follow us!</h4>
            <ul class="">
                <li><a href="https://www.facebook.com/londonribvoyages" target="_blank"><span class="icon"> <img src="content/img/social/facebook-icon.png" /> </span><span>Facebook</span></a></li>
                <li><a href="http://www.tripadvisor.co.uk/Attraction_Review-g186338-d1526046-Reviews-London_Rib_Voyages-London_England.html" target="_blank"><span class="icon"> <img src="content/img/social/trip-icon.png" /> </span><span>Tripadvisor</span></a></li>
                <li><a href="https://londonribvoyages.wordpress.com/" target="_blank"><span class="icon"> <img src="content/img/social/blog-icon.png" /> </span><span>Blog</span></a></li>
                <li><a href="https://twitter.com/LondonRIB?lang=en" target="_blank"><span class="icon"> <img src="content/img/social/twitter-icon.png" /> </span><span>Twitter</span></a></li>
                <li><a href="https://www.youtube.com/channel/UC_78eKTUZPWQv7Yhb6jIJVA" target="_blank"><span class="icon"> <img src="content/img/social/youtube-icon.png" /> </span><span>YouTube</span></a></li>
            </ul>
        </div>
    </div>


    <div class="schema">
        <div itemscope itemtype="http://schema.org/LocalBusiness">
            <span itemprop="name">London RIB Voyages</span>
            <span itemprop="description">The fastest, funniest and craziest speedboat adventures on the river Thames</span>
            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                <span itemprop="streetAddress">Boarding Gate One,The London Eye Millennium Pier</span>
                <span itemprop="addressLocality">Southbank</span>,
                <span itemprop="addressRegion">London</span>
                <span itemprop="postalCode">SE1 7PB</span>
            </div>
            <!-- Add the lat/long geo sub-type -->
            <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
                <!-- Add Latitude -->
                <meta itemprop="latitude" content="1.503349" />
                <!-- Add Longitude -->
                <meta itemprop="longitude" content="-0.120415" />
                <!-- End sub schema block -->
            </div>
            Phone: <span itemprop="telephone">0207 928 8933</span>
            <time itemprop="openingHours" datetime="Mo,Su 10.00 - 18.00">Monday to Sunday 10:00-18:00</time>.
            <div itemscope itemtype="http://schema.org/Product">
                <span itemprop="name">London RIB Voyages</span>
                <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                    Rated <span itemprop="ratingValue">5</span>/5 based on <span itemprop="reviewCount">2971</span> reviews
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="md-overlay"></div>

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
    <script src="js/slick/slick.min.js"></script>
    <script src="js/booking.js"></script>

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

            // Si clickear cualquier item del menu, oculpa el menu
            $('.select-trip-items .md-trigger').on('click', function(e) {
                $('.select-trip-items').toggleClass("pressed");
                $('.dropdown-btn').toggleClass("pressed");
                e.preventDefault();
            });
        });
    </script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-23852518-1', 'auto');
        ga('send', 'pageview');

    </script>

{/literal}

{if $page==map}
    {literal}
        <script type="text/javascript">
            $('.slider-map').slick({
                dots: true,
                infinite: false,
                speed: 300,
                arrows: true,
                slidesToShow: 18,
                slidesToScroll: 2
            });
        </script>
    {/literal}
{/if}

{literal}
    <script type="text/javascript">
        $(document).ready(function(){
            // ======================================

            var s = $(".facts-container");
            var pos = s.position();

            if (s.length>0){
                $(window).scroll(function() {
                    var windowpos = $(window).scrollTop();

                    if (windowpos >= pos.top) {
                        s.addClass("stick");
                    } else {
                        s.removeClass("stick");
                    }
                });
            }

            $('#main-header nav a').each(function(index) {
                if(this.href.trim() == window.location)
                    $(this).addClass("selected");
            });

            // ======================================

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

            // ======================================
        })
    </script>


    <script>
        //        (function() {
        //            [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
        //                new SelectFx(el);
        //            } );
        //        })();
    </script>
    <!-- height video container , only for ie -->
    <!--[if IE]>
    <script type="text/javascript">
        $('.video-container').equalHeights();
    </script>
    <![endif]-->

    <script>

        <!-- Loads controls for video only on iPad -->
        if (navigator.userAgent.match(/like Mac OS X/i)) {
            // Grab a handle to the video
            var video = document.getElementById("intro-video");
            // Turn off the default controls
            video.controls = true;
        }


        function addSourceToVideo(element, src, type) {
            var source = document.createElement('source');
            source.src = src;
            source.type = type;
            element.appendChild(source);
        }

        var video;
        var index = 0;
        $(document).ready(function(){
            video = document.getElementsByTagName('video')[0];
            addSourceToVideo( video, "content/video/video.ogv", "video/ogv; codecs='theora, vorbis'");
            addSourceToVideo( video, "content/video/video.mp4", "video/mp4; codecs='avc1.42E01E, mp4a.40.2'");
            addSourceToVideo( video, "content/video/video.webm", "video/webm");
            video.addEventListener("progress", progressHandler,false);
            //bindKeys();
            // if set, overrides <video width>
            //videoWidth: win.width;
            // if set, overrides <video height>
            //videoHeight: win.height;
        });

        progressHandler = function(e) {
            if( video.duration ) {
                var percent = (video.buffered.end(0)/video.duration) * 100;
                if( percent >= 40 ) {
                    video.play();
                }
            }
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
</body>
</html>
