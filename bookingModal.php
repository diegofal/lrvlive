<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="London RIB Voyages">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1" />

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet/less" type="text/css" href="css/main.less" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900' rel='stylesheet' type='text/css'>
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="js/vendor/less.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</head>

<body>
<section id="buy">
    <div class="breadcrum-step">
        <a href="#" class="selected">1. Trip type abc and seats</a>
        <a href="#">2. Date and time</a>
        <a href="#">3. Personal info</a>
        <a href="#">4. Confirmation</a>
    </div>
    <div class="step step-1">
        <header>
            <span>Step 1</span>
            <h3>Choose your trip type and seats</h3>
            <p>On the final step you will see a full payment detail before the confirmation.</p>
        </header>
        <div class="buy-content">

            <div>
                <label for="trip">Trip:</label>
                <select id="trip" class="cs-select cs-skin-elastic">
                    <option value="" disabled selected>Select your trip </option>
                    <option value="The Ultimate London Adventure">The Ultimate London Adventure</option>
                    <option value="Captain Kidd's Canary Wharf">Captain Kidd's Canary Wharf</option>
                    <option value="Thames Barrier Explorers Voyage">Thames Barrier Explorers Voyage</option>
                    <option value="Break The Barrier (Speed only)">Break The Barrier (Speed only)</option>
                    <option value="Spring has Sprung">Spring has Sprung</option>
                </select>
            </div>
            <div>
                <label for="adult">Adult:</label>
                <select id="adult" class="cs-select cs-skin-elastic">
                    <option value="0" disabled selected>0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div>
                <label for="child">Child (10 - 14):</label>
                <select id="child" class="cs-select cs-skin-elastic">
                    <option value="0" disabled selected>0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div>
                <label for="couple">Couple:</label>
                <select id="couple" class="cs-select cs-skin-elastic">
                    <option value="0" disabled selected>0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div>
                <label for="family">Family (2 + 2):</label>
                <select id="family" class="cs-select cs-skin-elastic">
                    <option value="0" disabled selected>0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>

            <div>
                <label for="charter">Charter ?</label>
                <input type="checkbox" id="charter"/>
            </div>
        </div>
    </div>

    <div class="step step-2">
        <header>
            <span>Step 2</span>
            <h3>Choose your date and time of departure</h3>
            <p>If you are a party of over 8 and require a departure time that is not listed please call 020 7928 8933.</p>
        </header>
        <div class="buy-content">
            <input type="text" id="datetimepicker3"/><br><br>
        </div>
    </div>

    <div class="step step-3">
        <header>
            <span>Step 3</span>
            <h3>Complete your personal information</h3>
            <p>And save one pound in just in one click!</p>
        </header>
        <div class="buy-content">
            <form id="personal-info">
                <div>
                    <label for="name">First name</label>
                    <input id="name" type="text" />
                </div>

                <div>
                    <label for="phone">Phone</label>
                    <input id="phone" type="number" />
                </div>

                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" />
                </div>

                <div>
                    <label for="how">How did you find us ?</label>
                    <select id="how" class="cs-select cs-skin-elastic">
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

    <div class="step step-4">
        <header>
            <span>Step 4</span>
            <h3>Re-check  your information and proceed to payment</h3>
            <p>You will be redirected to Protx.com, a provider of secure online credit card and debit card payment solutions for thousands of online and mail order businesses across the UK.</p>
        </header>
        <div class="buy-content">
            <div id="resume" class="grid">
                <ul class="personal col-1-3">
                    <li>Personal</li>
                    <li><span>Name</span>Mark Jacob</li>
                    <li><span>Phone</span>011 - 15 - 5315 - 9223</li>
                    <li><span>E-Mail</span>markjacob@gmail.com</li>
                </ul>

                <ul class="trip col-1-3">
                    <li>Trip</li>
                    <li><span>Trip</span>The Ultimate London Adventure</li>
                    <li><span>Date</span>16 april 2015</li>
                    <li><span>Time</span>13:00 hs</li>
                    <li><span>Adults</span>£75.90 (2)</li>
                    <li><span>Childrens</span>£75.90 (2)</li>
                </ul>

                <ul class="extras col-1-3">
                    <li>Extras</li>
                    <li><span>Extras</span>£3.95</li>
                    <li><span>Discount</span>£0.00</li>
                </ul>
            </div>
        </div>
    </div>

    <footer>
        <p class="msj error"><span class="icon">Aca va un mensaje de error de algo mal seleccionado</p>
        <div class="grid">
            <div class="col-1-3"><a href="#" id="prev" class="btn md-close btn-secondary"> cancel </a></div>
            <div class="col-1-3"><p class="price-total"><span>$</span><span class="number">0.00</span></p></div>
            <div class="col-1-3"><a href="#" id="next" class="btn btn-main"> siguiente </a></div>
        </div>
    </footer>



</section>
</body>

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

</html>


