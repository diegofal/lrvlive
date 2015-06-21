<?php

require_once "WEB-INF/includes/classes/class.x3.database.php";
require_once "WEB-INF/includes/config.php";
require_once "WEB-INF/includes/functions/functions_utils.php";
require_once "WEB-INF/includes/functions/functions_order.php";

$db = new DB_config;
$db->connect();

class BookingApi {


    function BookingApi()
    {
        global $db;

        $db = new DB_config;
        $db->connect();

    }

    function getTourTickets(){
        global $db;

        $tourId = $_GET['tourid'];
        $tourTicketsQuery = "
                SELECT  ticket_id, ticket_type, ticket_price FROM `".$db->ticket."` WHERE ticket_del=0 AND ticket_tour_id=" . $tourId ;

        $tourTickets = $db->select_fields($db->ticket, $tourTicketsQuery, "");

        $response = [];
        foreach($tourTickets as $ticket){
            $response[] = array_map('utf8_encode',$ticket);

        }

        echo $this->buildResponse("OK", "", "tickets", $response);
    }

    function buildResponse($status, $desc, $dataName, $data){
        return json_encode(array("Status"=>$status, "Desc" => $desc, $dataName=>$data));
    }

}