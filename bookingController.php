<?php

require_once('WEB-INF/includes/classes/bookingapi.php'); // including service class to work with database

$oBookingApi = new BookingApi();


// process actions
switch ($_REQUEST['action']) {
    case 'tourTickets':

        $tourTickets = $oBookingApi->getTourTickets();

        echo $tourTickets;
        break;
}