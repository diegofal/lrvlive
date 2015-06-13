<?
// includere smarty :
// includere smarty :
include "check_login.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;

$reseller_offer_id = $_GET['id'];
if ($reseller_offer_id==null) $reseller_offer_id=0;

// load reseller
if (isset($_GET['reseller_id']) && is_numeric($_GET['reseller_id'])) {
    $utils->set_get_var($reseller_id, "reseller_id", $_GET['reseller_id']);
}
else {
    $query = "SELECT reseller_id FROM `".$db->resellers."` WHERE 1 AND reseller_del = 0 ORDER BY reseller_name ASC";
    $reseller_ids = $db->select_field($db->resellers, "reseller_id", "", $query);
    $utils->set_get_var($reseller_id, "reseller_id", $reseller_ids[0]);
    echo $reseller_ids[0];
}


//delete offer
if (@$_GET['option'] == 'delete' && !empty($_GET['id']) && is_numeric($_GET['id'])){
    $db->edit_field($db->reseller_offers, array("reseller_offer_del"=>1), "reseller_offer_id", $_GET['id'] );
    header("Location: reseller_offers.php".($reseller_id?"?reseller_id=".$reseller_id:""));
    exit();
}
// resellers
$query = "SELECT * FROM $db->resellers WHERE reseller_del = 0 ORDER BY reseller_name ASC";
$resellers = $db->select_fields ($db->resellers, $query, "", "reseller_name");

// reseller offers
$query = "SELECT * FROM $db->reseller_offers WHERE reseller_offer_del = 0 AND reseller_id=". $reseller_id ;
$reseller_offers = $db->select_fields ($db->reseller_offers, $query, "");

// tours
$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0";
$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

// tickets
$query = "SELECT * FROM $db->ticket WHERE 1 AND ticket_del = 0";
$tickets = $db->select_fields($db->ticket,$query,"","ticket_del","0");

// reseller offer tickets
$query = "SELECT reseller_offer_id, ot.ticket_id, quantity, ticket_seats  FROM $db->reseller_offer_tickets ot INNER JOIN ticket t on t.ticket_id = ot.ticket_id WHERE 1 AND reseller_offer_id=".$reseller_offer_id;
$reseller_offer_tickets = $db->select_fields($db->reseller_offer_tickets,$query);

// reseller offer seat cout
$query = "SELECT reseller_offer_id, sum(quantity* ticket_seats) as seats_count FROM $db->reseller_offer_tickets ot INNER JOIN $db->ticket t on t.ticket_id = ot.ticket_id group by reseller_offer_id";
$reseller_seat_count = $db->select_fields($db->reseller_offer_tickets,$query, array("reseller_offer_id", "seats_count"));

//edit
if (@$_GET['option'] == 'edit' && !empty($_GET['id']) && is_numeric($_GET['id'])){
    if(!empty($_POST)){

        $fields = $_POST;

        $db->delete_field($db->reseller_offer_tickets, "reseller_offer_id", $reseller_offer_id);

        while (list($key,$value) = each($_POST)) {
            $a=explode('_', $key);

            if ($a[2]<>0){
                if (!empty($value)) {
                    $db->insert_field($db->reseller_offer_tickets, array("reseller_offer_id"=> $reseller_offer_id, "ticket_id"=>$a[2], "quantity"=>$value));
                }
            }
        }

        header("Location: reseller_offers.php?reseller_id=".$reseller_id);
        exit();
    }

    $reseller_offer = $db->select_fields($db->reseller_offers,"","","reseller_offer_id",$_GET['id'], "", "", "", 1);
    $smarty->assign("reseller_offer",$reseller_offer);
} else if(!empty($_POST)){

    $db->insert_field($db->reseller_offers, array("reseller_id"=>$reseller_id, "name"=>$_POST["name"], "price"=>$_POST["price"]));
    $reseller_offer_id = $db->mysqlinsertid();

    while (list($key,$value) = each($_POST)) {
        $a=explode('_', $key);

        if ($a[2]<>0){
            if (!empty($value)) {
                $db->insert_field($db->reseller_offer_tickets, array("reseller_offer_id"=> $reseller_offer_id, "ticket_id"=>$a[2], "quantity"=>$value));

            }
        }
    }

    header("Location: reseller_offers.php?reseller_id=".$reseller_id."");
    exit();
}

//******assigns*******//
$smarty->assign("resellers",$resellers);
$smarty->assign("reseller_offers",$reseller_offers);
$smarty->assign("reseller_seat_count",$reseller_seat_count);
$smarty->assign("reseller_id",$reseller_id);
$smarty->assign("tours",$tours);
$smarty->assign("tickets",$tickets);
$smarty->assign("reseller_offer_tickets",$reseller_offer_tickets);

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","settings");
$smarty->assign("page","reseller_offers");
$smarty->display('cms_pages.tpl');
?>