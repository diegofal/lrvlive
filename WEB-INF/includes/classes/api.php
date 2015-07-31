<?php

require_once "WEB-INF/includes/classes/class.x3.database.php";
require_once "WEB-INF/includes/config.php";
require_once "WEB-INF/includes/functions/functions_utils.php";
require_once "WEB-INF/includes/functions/functions_order.php";

$db = new DB_config;
$db->connect();

class Api {
    var $resellerId;
    var $resellerName;
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
            echo $this->buildResponse("ERROR", "Invalid reseller id.", "empty", null);
            die;
        }


        // check reseller id
        $query = "SELECT reseller_id, reseller_name FROM `".$db->resellers."` WHERE reseller_id=" . $resellerId;
        $reseller = $db->select_fields($db->resellers, $query,array("reseller_id", "reseller_name"));

        if (empty($reseller)){
            echo $this->buildResponse("ERROR", "Reseller not found", "empty", null);
            die;
        }

        $this->resellerName = $reseller[0]['reseller_name'];

        // check token
        $query = "SELECT reseller_token FROM `".$db->resellers."` WHERE reseller_id=" . $resellerId . " AND reseller_token ='" . $resellerToken . "'";
        $reseller = $db->select_field($db->resellers, "reseller_token", "", $query);

        if (empty($reseller)){
             echo $this->buildResponse("ERROR", "Reseller token not found", "empty", null);
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

        return $this->buildResponse("OK", "", "offers", $reseller_offers);
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
        $tourId = $this->getOfferTourId($offerId);

        // grab the total of seats used by the offer
        $orderTicketsNumber = $this->getSeatCountFromOffer($offerId);

        // get all departures for selected tour and date
        $departures = $this->getDeparturesForTourAndDate($tourId, $date);

        // start processing response
        $response = array();

        foreach($departures as $departure){
            $orderQuery = "SELECT * FROM $db->order
		    WHERE order_departure_id = '". $departure['id'] ."'";

            $fields = array("order_tickets", "order_tickets_number");
            $orders = $db->select_fields($db->order, $orderQuery, $fields);
            $sum = 0;

            $total_passenger = $departure['boat_passengers'];

            foreach($orders as $orderData)
            {
                //charter
                if (($orderData['order_tickets']==0) && ($orderData['order_tickets_number']==1)) {
                    $sum += $departure['boat_passengers'];
                } else {
                    //normal
                    $sum +=  $orderData['order_tickets_number'];
                }
            }

            if($departure['boat_passengers'] - $sum >= $orderTicketsNumber && $total_passenger > 0)
            {
                $response[] = $departure;
            }
        }

        return $this->buildResponse("OK", "", "departures", $response);
    }

    function makeReservation(){
        global $db;

        // check offer is set
        $offerId = $this->checkOfferParameter();

        $offerPriceQuery =  "
                SELECT price
                FROM " . $db->reseller_offers. "
                WHERE reseller_offer_id = " . $offerId . "
        ";
        $offerPriceResult = $db->select_field($db->reseller_offers, "price", "", $offerPriceQuery);

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
        $departureResult = $db->select_field($db->departure, "departure_date", "", $departureDateQuery);

        $departureDate = $departureResult[0];
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
        $orderMethod = "voucher";


        foreach ($ticketsInfo as $ticketInfo){
            $orderTickets = strlen($orderTickets)>0 ? $orderTickets . "|".$ticketInfo['ticket_id'] : $ticketInfo['ticket_id'];
            $orderQuantities = strlen($orderQuantities)>0 ? $orderQuantities . "|".$ticketInfo['quantity'] : $ticketInfo['quantity'];
            $orderTicketsNumber += intval($ticketInfo['quantity']) * intval($ticketInfo['ticket_seats']);
            //$orderTotal += floatval($ticketInfo['ticket_price']);
        }


        $orderTotal = $offerPriceResult[0];
        // Uncomment to sum booking fee
        //$orderTotal += PRICE_FEE;

        $reservationFields = array( "order_tickets" => $orderTickets,
                                    "order_quantities" => $orderQuantities,
                                    "order_tickets_number" => $orderTicketsNumber,
                                    "order_total" => $orderTotal,
                                    "order_departure_id" => $departureId,
                                    "order_method" => $orderMethod,
                                    "order_date" => $departureDate,
                                    "order_sid" => "",
                                    "order_unique_code" => md5(uniqid(rand(), true)),
                                    "order_time" =>  time()+600,
                                    "order_reseller_id" => $this->resellerId,
                                    "order_reseller_name" => $this->resellerName);

        //--------------------------------------------- //
        //----  end prepare fields for reservation ---- //
        //--------------------------------------------- //

        $bookingId = generate_order($reservationFields, "api booking");

        return json_encode(array("Status"=>"OK", "Desc" => "", "BookingId" => $bookingId, "TotalPrice" => $orderTotal));
    }

    function confirmBooking(){
        global $db;

        // check check booking id set
        if (!isset($_POST['BookingId'])){
            $this->buildResponse("ERROR", "Invalid booking id.", "empty", null);
            die;
        }

        $bookingId = $_POST["BookingId"];

        // check offer exists in DB
        $bookingQuery = "
            SELECT order_id
            FROM " . $db->order . "
            WHERE order_id = " . $bookingId."
        ";
        $order = $db->select_field($db->order, "order_id", "", $bookingQuery);

        if (empty($order)){
            $this->buildResponse("ERROR", "Order does not exist.", "empty", null);
            die;
        }

        //----------------------------------------- //
        //----  Start Confirm Booking          ---- //
        //----------------------------------------- //

        $firstName = $_POST["FirstName"];
        $lastName = $_POST["LastName"];
        $phone = $_POST["Phone"];
        $email = $_POST["Email"];
        $specialNotes = $_POST["SpecialNotes"];

        $confirmBookingFields = array(  "order_first_name" => $firstName,
                                        "order_last_name" => $lastName,
                                        "order_phone" => $phone,
                                        "order_email" => $email,
                                        "order_note_crew" => $specialNotes,
                                        "order_payd" => 1); // confirm where to put this information

        edit_order($confirmBookingFields, "order_id", $bookingId, "api booking");

        return json_encode(array("Status"=>"OK", "Desc" => ""));
        //----------------------------------------- //
        //----  End Confirm Booking            ---- //
        //----------------------------------------- //

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


    private function getSeatCountFromOffer($offerId){
        global $db;

        // get offer tickets information

        $ticketsInfoQuery ="
                SELECT rot.ticket_id, quantity , ticket_seats, ticket_price
                FROM " . $db->reseller_offer_tickets. " rot
                INNER JOIN ". $db->ticket . " t on t.ticket_id = rot.ticket_id
                WHERE reseller_offer_id = " . $offerId . "
        ";

        $ticketsInfo = $db->select_fields($db->reseller_offer_tickets, $ticketsInfoQuery,array("ticket_id", "quantity", "ticket_seats", "ticket_price"));


        // define how much tickets will the offer require in the boat
        $orderTicketsNumber = 0;

        foreach ($ticketsInfo as $ticketInfo){
            $orderTicketsNumber += intval($ticketInfo['quantity']) * intval($ticketInfo['ticket_seats']);
        }

        return $orderTicketsNumber;
    }

    private function getOfferTourId($offerId){
        global $db;

        $tourQuery = "
            SELECT DISTINCT ticket_tour_id as tour_id
            FROM " . $db->reseller_offer_tickets . " rot
            INNER JOIN ". $db->ticket ." t on t.ticket_id = rot.ticket_id
            WHERE reseller_offer_id = " . $offerId ."
        ";
        $tourResult = $db->select_field($db->reseller_offer_tickets, "tour_id", "", $tourQuery);
        $tourId = $tourResult[0];
        return $tourId;
    }

    private function getDeparturesForTourAndDate($tourId, $date){
        global $db;

        $departuresQuery = "
			SELECT departure_id as id, departure_date as date, departure_time as time, boat_passengers
			FROM
				departure
			    INNER JOIN
				boat ON departure.departure_boat_id = boat.boat_id
			WHERE boat_del = 0
			AND departure_boat_id = boat_id
			AND departure_tour_id = ".$tourId."
			AND departure_date = '". $date ."'
			ORDER BY departure_date, departure_time";

        $departures = $db->select_fields($db->departure, $departuresQuery,array("id", "date", "time", "boat_passengers"));
        return $departures;
    }

    private function buildResponse($status, $desc, $dataName, $data){
        return json_encode(array("Status"=>$status, "Desc" => $desc, $dataName=>$data));
    }

}