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
        $oApi->getAvailableOffers();

        break;
    case 'availability':
        $oApi->getOfferAvailability();

        break;
    case 'reservation':
        $oApi->makeReservation();

        break;
    case 'confirmation':
        $oApi->confirmBooking();

        break;
}