<?php

require_once "WEB-INF/includes/classes/class.x3.database.php";
require_once "WEB-INF/includes/config.php";
require_once "WEB-INF/includes/functions/functions_utils.php";
require_once "WEB-INF/includes/functions/functions_order.php";

$db = new DB_config;
$db->connect();

class Api {
    var $resellerId;
    var $resellerToken;


    function Api($resellerId, $resellerToken)
    {
        global $db;

        $this->resellerId= $resellerId;
        $this->resellerToken = $resellerToken;

        $db = new DB_config;
        $db->connect();


        // do security checks

        if (!is_numeric($resellerId)){
            $this->buildResponse("ERROR", "Invalid reseller id.", "empty", null);
            die;
        }

        // check reseller id
        $query = "SELECT reseller_id FROM `".$db->resellers."` WHERE reseller_id=" . $resellerId;
        $reseller = $db->select_field($db->resellers, "reseller_id", "", $query);

        if (empty($reseller)){
            $this->buildResponse("ERROR", "Reseller not found", "empty", null);
            die;
        }

        // check token
        $query = "SELECT reseller_token FROM `".$db->resellers."` WHERE reseller_id=" . $resellerId . " AND reseller_token ='" . $resellerToken . "'";
        $reseller = $db->select_field($db->resellers, "reseller_token", "", $query);

        if (empty($reseller)){
             $this->buildResponse("ERROR", "Reseller token not found", "empty", null);
             die;
        }

        // security checks passed. Continue with API request call.
    }

    function getAvailableOffers(){
        global $db;

        $resellerOffersQuery = "
                SELECT  reseller_offer_id as id,
                        name,
                        price
                FROM `".$db->reseller_offers."`
                WHERE reseller_id=" . $this->resellerId;
        $reseller_offers = $db->select_fields($db->resellers, $resellerOffersQuery,array("id", "name", "price"));

        $this->buildResponse("OK", "", "offers", $reseller_offers);
    }

    function getOfferAvailability(){

        global $db;

        // check offer is set
        $offerId = $this->checkOfferParameter();

        // check date is set
        if (!isset($_POST['Date'])){
            $this->buildResponse("ERROR", "Invalid date.", "empty", null);
            die;
        }


        $date = $_POST["Date"];


        // grab tour id from first associated ticket in offer
        $tourQuery = "
            SELECT DISTINCT ticket_tour_id as tour_id
            FROM " . $db->reseller_offer_tickets . " rot
            INNER JOIN ". $db->ticket ." t on t.ticket_id = rot.ticket_id
            WHERE reseller_offer_id = " . $offerId ."
        ";
        $tourId = $db->select_field($db->reseller_offer_tickets, "tour_id", "", $tourQuery)[0];

        // get departures for tour and date
        $departuresQuery = "
			SELECT departure_id as id, departure_date as date, departure_time as time
			FROM
				departure
			    INNER JOIN
				boat ON departure.departure_boat_id = boat.boat_id
			WHERE boat_del = 0
			AND departure_boat_id = boat_id
			AND departure_tour_id = ".$tourId."
			AND departure_date = '". $date ."'
			ORDER BY departure_date, departure_time";

        $departures = $db->select_fields($db->departure, $departuresQuery,array("id", "date", "time"));

        $this->buildResponse("OK", "", "departures", $departures);
    }

    function makeReservation(){
        global $db;

        // check offer is set
        $offerId = $this->checkOfferParameter();

        // check departure is set
        if (!isset($_POST['DepartureId'])){
            $this->buildResponse("ERROR", "Invalid departure id.", "empty", null);
            die;
        }

        $departureId = $_POST['DepartureId'];

        //----------------------------------------- //
        //----  prepare fields for reservation ---- //
        //----------------------------------------- //

        // get departure date
        $departureDateQuery =  "
                SELECT departure_date
                FROM " . $db->departure. "
                WHERE departure_id = " . $departureId . "
        ";
        $departureDate = $db->select_field($db->departure, "departure_date", "", $departureDateQuery)[0];


        // get offer tickets information

        $ticketsInfoQuery ="
                SELECT rot.ticket_id, quantity , ticket_seats, ticket_price
                FROM " . $db->reseller_offer_tickets. " rot
                INNER JOIN ". $db->ticket . " t on t.ticket_id = rot.ticket_id
                WHERE reseller_offer_id = " . $offerId . "
        ";

        $ticketsInfo = $db->select_fields($db->reseller_offer_tickets, $ticketsInfoQuery,array("ticket_id", "quantity", "ticket_seats", "ticket_price"));

        $orderTickets = "";
        $orderQuantities = "";
        $orderTicketsNumber = 0;
        $orderTotal = 0.0;
        $orderTime = date("Hm");
        $orderMethod = "protx";


        foreach ($ticketsInfo as $ticketInfo){
            $orderTickets = strlen($orderTickets)>0 ? $orderTickets . "|".$ticketInfo['ticket_id'] : $ticketInfo['ticket_id'];
            $orderQuantities = strlen($orderQuantities)>0 ? $orderQuantities . "|".$ticketInfo['quantity'] : $ticketInfo['quantity'];
            $orderTicketsNumber += intval($ticketInfo['quantity']) * intval($ticketInfo['ticket_seats']);
            $orderTotal += floatval($ticketInfo['ticket_price']);
        }

        $orderTotal += PRICE_FEE;

        $reservationFields = array( "order_tickets" => $orderTickets,
                                    "order_quantities" => $orderQuantities,
                                    "order_tickets_number" => $orderTicketsNumber,
                                    "order_total" => $orderTotal,
                                    "order_time" => $orderTime,
                                    "order_departure_id" => $departureId,
                                    "order_method" => $orderMethod,
                                    "order_date" => $departureDate,
                                    "order_sid" => "");

        //--------------------------------------------- //
        //----  end prepare fields for reservation ---- //
        //--------------------------------------------- //

        $bookingId = generate_order($reservationFields, "api booking");

        echo json_encode(array("Status"=>"OK", "Desc" => "", "BookingId" => $bookingId, "TotalPrice" => $orderTotal));
    }

    function checkOfferParameter(){
        global $db;

        // check reseller offer id set
        if (!isset($_POST['OfferId'])){
            $this->buildResponse("ERROR", "Invalid offer id.", "empty", null);
            die;
        }

        $offerId = $_POST["OfferId"];

        // check offer exists in DB
        $offerQuery = "
            SELECT reseller_offer_id
            FROM " . $db->reseller_offers . "
            WHERE reseller_offer_id = " . $offerId ."
        ";
        $offer = $db->select_field($db->reseller_offers, "reseller_offer_id", "", $offerQuery);

        if (empty($offer)){
            $this->buildResponse("ERROR", "Offer does not exist.", "empty", null);
            die;
        }

        return $offerId;
    }

    function buildResponse($status, $desc, $dataName, $data){
        echo json_encode(array("Status"=>$status, "Desc" => $desc, $dataName=>$data));
    }

}