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


        $query = "SELECT reseller_id FROM `".$this->db->resellers."` WHERE reseller_id=" . $resellerId;
        $reseller_ids = $this->db->select_field($this->db->resellers, "reseller_id", "", $query);

        if (empty($reseller_ids)){
            die("empty");
        }

    }

    function getAvailableOffers(){
        return "available";
    }

    function getOfferAvailability(){
        return "offer";
    }

    function makeReservation(){

    }

    function buildResponse($status, $desc, $data){
        return json_response($data);
    }

}