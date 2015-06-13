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

        if (!is_numeric($resellerId)){
            $this->buildResponse("ERROR", "Invalid reseller id.", "empty", null);
            die;
        }

        $query = "SELECT reseller_id FROM `".$this->db->resellers."` WHERE reseller_id=" . $resellerId;
        $reseller = $this->db->select_field($this->db->resellers, "reseller_id", "", $query);

        if (empty($reseller)){
            $this->buildResponse("ERROR", "Reseller not found", "empty", null);
            die;
        }

        $query = "SELECT reseller_token FROM `".$this->db->resellers."` WHERE reseller_id=" . $resellerId . " AND reseller_token ='" . $resellerToken . "'";
        $reseller = $this->db->select_field($this->db->resellers, "reseller_token", "", $query);

        if (empty($reseller)){
             $this->buildResponse("ERROR", "Reseller token not found", "empty", null);
             die;
        }

        // security checks passed. Continue with API request call.
    }

    function getAvailableOffers(){
        return "available";
    }

    function getOfferAvailability(){
        return "offer";
    }

    function makeReservation(){

    }

    function buildResponse($status, $desc, $dataName, $data){
        echo json_encode(array("Status"=>$status, "Desc" => $desc, $dataName=>$data));
    }

}