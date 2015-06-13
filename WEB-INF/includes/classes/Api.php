<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 6/12/2015
 * Time: 11:00 PM
 */

class Api {
    var $resellerId;
    var $resellerToken;

    function Api()
    {
        $reseller_id = $_POST['ResellerId'];
        $reseller_token = $_POST['ResellerToken'];

        

    }

    function buildResponse($status, $desc, $data){
        return json_response($data);
    }

}