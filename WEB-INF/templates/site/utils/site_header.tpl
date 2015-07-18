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
    <link rel="stylesheet/less" type="text/css" href="css/main.less" />
    <link rel="stylesheet" type="text/css" href="js/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="js/slick/slick-theme.css"/>
    <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900' rel='stylesheet' type='text/css'>
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="js/vendor/less.min.js"></script>
    <script src="js/vendor/jquery-1.11.2.min.js"></script>

</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Add your site or application content here -->
<div id="fb-root"></div>
<div id="fb-root"></div>

{literal}
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=194261774035424";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

{/literal}

<div class="md-modal md-effect-11" style="display:none" id="modal-1">
    <div class="md-content">
        <iframe id="bookingFrame" src="" width="100%" height="500px" ></iframe>

        <div id="buyhelp">
            <div>
                <span>Need help with your booking?</span> Call us on: 0207 928 8933
            </div>
            <div>
                <span>*</span>Child Tickets:  14 years & under
            </div>
        </div>

    </div>

</div>


<header id="main-header">
    <div class="grid clearHeader">
        <a class="logo col-2-6" href="index.php">
            <img src="content/img/logo.jpg" />
        </a>
        <nav class="col-3-6">
            <a href="index.php"> home</a><a href="why-us.php">why us? </a><a href="crew.php">crew </a><a href="services.php">services </a><a href="map.php">locations </a><a href="safety.php">safety </a>
        </nav>
        <div class="col-1-6">
            <a href="#" class="btn btn-main dropdown-btn book-now"> book now !<span class="icon"></span></a>
        </div>
    </div>
    <ul class="select-trip-items">
        <li><button class="md-trigger" tourid="9" data-modal="modal-1"> The Ultimate London Adventure </button></li>
        <li><button class="md-trigger" tourid="1" data-modal="modal-1"> Captain Kidd's Canary Wharf </button></li>
        <li><button class="md-trigger" tourid="4" data-modal="modal-1"> Thames Barrier Explorers Voyage </button></li>
        <li><button class="md-trigger" tourid="12" data-modal="modal-1"> Break The Barrier (Speed only) </button></li>
        <li><button class="md-trigger" tourid="27" data-modal="modal-1"> Sunset Speed Boating </button></li>
    </ul>
</header>


