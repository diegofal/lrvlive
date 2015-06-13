<?php

require_once "WEB-INF/includes/classes/class.x3.database.php";
require_once "WEB-INF/includes/config.php";
require_once "WEB-INF/includes/functions/functions_utils.php";

class Api {
    var $resellerId;
    var $resellerToken;

    var $db;

    function Api($resellerId, $resellerToken)
    {
        $this->resellerId= $resellerId;
        $this->resellerToken = $resellerToken;

        $this->db = new DB_config;
        $this->db->connect();


        // do security checks

        if (!is_numeric($resellerId)){
            $this->buildResponse("ERROR", "Invalid reseller id.", "empty", null);
            die;
        }

        // check reseller id
        $query = "SELECT reseller_id FROM `".$this->db->resellers."` WHERE reseller_id=" . $resellerId;
        $reseller = $this->db->select_field($this->db->resellers, "reseller_id", "", $query);

        if (empty($reseller)){
            $this->buildResponse("ERROR", "Reseller not found", "empty", null);
            die;
        }

        // check token
        $query = "SELECT reseller_token FROM `".$this->db->resellers."` WHERE reseller_id=" . $resellerId . " AND reseller_token ='" . $resellerToken . "'";
        $reseller = $this->db->select_field($this->db->resellers, "reseller_token", "", $query);

        if (empty($reseller)){
             $this->buildResponse("ERROR", "Reseller token not found", "empty", null);
             die;
        }

        // security checks passed. Continue with API request call.
    }

    function getAvailableOffers(){
        $resellerOffersQuery = "
                SELECT  reseller_offer_id as id,
                        name,
                        price
                FROM `".$this->db->reseller_offers."`
                WHERE reseller_id=" . $this->resellerId;
        $reseller_offers = $this->db->select_fields($this->db->resellers, $resellerOffersQuery,array("id", "name", "price"));

        $this->buildResponse("OK", "", "offers", $reseller_offers);
    }

    function getOfferAvailability(){

        // check reseller offer id set
        if (!isset($_POST['OfferId'])){
            $this->buildResponse("ERROR", "Invalid offer id.", "empty", null);
            die;
        }

        $offerId = $_POST["OfferId"];

        // check offer exists in DB
        $offerQuery = "
            SELECT reseller_offer_id
            FROM " . $this->db->reseller_offers . "
            WHERE reseller_offer_id = " . $offerId ."
        ";
        $offer = $this->db->select_field($this->db->reseller_offer, "offer_id", "", $offerQuery);

        if (empty($offer)){
            $this->buildResponse("ERROR", "Offer does not exist.", "empty", null);
            die;
        }

        // check date is set
        if (!isset($_POST['Date'])){
            $this->buildResponse("ERROR", "Invalid date.", "empty", null);
            die;
        }


        $date = $_POST["Date"];


        // grab tour id from first associated ticket in offer
        $tourQuery = "
            SELECT DISTINCT ticket_tour_id as tour_id
            FROM " . $this->db->reseller_offer_tickets . " rot
            INNER JOIN ". $this->db->ticket ." t on t.ticket_id = rot.ticket_id
            WHERE reseller_offer_id = " . $offerId ."
        ";
        $tourId = $this->db->select_field($this->db->reseller_offer_tickets, "tour_id", "", $tourQuery)[0];



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

        $departures = $this->db->select_fields($this->db->departure, $departuresQuery,array("id", "date", "time"));

        $this->buildResponse("OK", "", "departures", $departures);
    }

    function makeReservation(){

    }

    function buildResponse($status, $desc, $dataName, $data){
        echo json_encode(array("Status"=>$status, "Desc" => $desc, $dataName=>$data));
    }

}