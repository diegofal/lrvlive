<?php
session_name("site_session");
session_start();

// includes
require_once "WEB-INF/includes/classes/class.x3.database.php";
require_once "WEB-INF/includes/config.php";
require_once "WEB-INF/includes/functions/functions_utils.php";

// includere smarty :
include "WEB-INF/includes/smarty/smarty_site.php";

// DB connction
$db = new DB_config;
$db->connect();

/*
 $query = "DELETE FROM $db->order WHERE order_payd = 0 AND order_time < ".(time()-1800);
$db->delete_field($db->order, "", "", $query);

$query = "DELETE FROM $db->voucher_order WHERE voucher_order_payd = 0 AND voucher_order_time < ".(time()-1800);
$db->delete_field($db->voucher_order, "", "", $query);
*/

$array_config = array("user_username", "user_password");
$array_session = array("username", "password");

/*Offer Description*/
$query = "SELECT * FROM $db->page WHERE page_id = '10'";
$Offer = $db->select_fields($db->page,$query, array("page_id","page_body"));
$OfferData = $smarty->smarty_modifier_truncate(strip_tags($Offer[0]['page_body']),290);
$Offer_id  = $Offer[0]['page_id'];
$smarty->assign("OfferDesc",$OfferData);
$smarty->assign("OfferId",$Offer_id);
/*ENDS HERE*/
/*Offer Description*/
$query 			= "SELECT * FROM $db->special_offer ORDER BY OfferId ASC";
$Special_offer 	= $db->select_fields ($db->special_offer,$query, array("OfferId","OfferTitle", "OfferDescription", "OfferBackground", "OfferImage"));
$Offer_arr = "";
$k = 1;
foreach($Special_offer as $Sindex=>$Svalue)
{
	$Offer_arr[$k][]    =  $Svalue['OfferTitle'];
	if (isset($Svalue['OfferBackground']))
		$Offer_arr[$k][]    =  $Svalue['OfferBackground'];
	$Offer_arr[$k][]	= $smarty->smarty_modifier_truncate(strip_tags($Svalue['OfferDescription']),60);
	if (isset($Svalue['OfferImage']))
		$Offer_arr[$k][]    =  $Svalue['OfferImage'];
	$k++;
}
$smarty->assign("OfferDesc",$Offer_arr);
/*ENDS HERE*/
/*Testimonials*/
$query 			= "SELECT * FROM $db->testimonials ORDER BY Tid ASC";
$Testimonial 	= $db->select_fields ($db->testimonials,$query, array("Tid","TesimonialImage", "TestimonialDesc"));
$Testimonial_arr = "";
$k = 0;
foreach($Testimonial as $Tindex=>$Tvalue)
{
	$Testimonial_arr[$k]['Tid']    				=  $Tvalue['Tid'];
	$Testimonial_arr[$k]['TesimonialImage']    	=  $Tvalue['TesimonialImage'];
	$Testimonial_arr[$k]['TestimonialDesc']    	=  $Tvalue['TestimonialDesc'];
	$k++;
}

/*echo "<pre>";
 print_r($Testimonial_arr);
exit();*/
$smarty->assign("Testimonial",$Testimonial_arr);
/*ENDS HERE*/


$message = $db->check_session_login($db->session, $array_config, $array_session, "user", "", "", "", "", "", "", "", 3600, 1);

// Close session file write lock to avoid deadlock in other scripts
//session_write_close();
?>