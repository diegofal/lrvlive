<?php

require_once('WEB-INF/includes/classes/api.php'); // including service class to work with database

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Only POST requests are accepted');
}

$token = $_POST["Token"];
$resellerId = $_POST["ResellerID"];

$oApi = new Api($resellerId,$token);

// process actions
switch ($_REQUEST['action']) {
    case 'offers':
        $offers = $oApi->getAvailableOffers();
        echo $offers;
        break;
    case 'availability':
        $offerAvailability = $oApi->getOfferAvailability();
        echo $offerAvailability;
        break;
    case 'reservation':
        $reservation = $oApi->makeReservation();
        echo $reservation;

        break;
    case 'confirmation':
        $confirmBooking = $oApi->confirmBooking();
        echo $confirmBooking;
        break;
}