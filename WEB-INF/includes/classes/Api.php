<?php


class Api {
    var $resellerId;
    var $resellerToken;

    function Api($resellerId, $resellerToken)
    {
        $this->resellerId= $resellerId;
        $this->resellerToken = $resellerToken;



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