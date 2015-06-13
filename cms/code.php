<?
// includere smarty :
require_once "check_login.php";
require_once "../WEB-INF/includes/functions/functions_log.php";
require_once "../WEB-INF/includes/functions/functions_order.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

if (isset($_REQUEST['section']) && !empty($_REQUEST['section'])) $section = $_REQUEST['section'];
else $section = "bookings";

switch ($section){

	case "bookings":

if(!empty($_POST['mark'])){
	$_POST['order_id'] = $_POST['mark'];
}

if(!empty($_POST['mark'])){
	//$db->edit_field($db->order, array("order_used"=>1), "order_id", $_POST['mark']);
	edit_order(array("order_used"=>1), "order_id", $_GET['mark'], "backend code mark");
	$smarty->assign("message","The ticket was marked as used!");
}
if(!empty($_POST['query']) && is_numeric($_POST['query'])){
	$query = "SELECT * FROM $db->order, $db->departure, $db->boat 
			  WHERE order_departure_id = departure_id
			  AND departure_boat_id = boat_id
			  AND order_id = '".$_POST['query']."'" ;
	$fields = array("order_id", "order_unique_code", "order_title", "order_first_name", "order_last_name", "order_phone","order_email",
			  "order_total","order_used", "departure_date", "departure_time", "boat_name");
	$order = $db->select_fields($db->order,$query, $fields, "", "", "", "", "", 1);
	if(!count($order)){
		$smarty->assign("message","The code you filled in is not valid!");
	} else {
		$smarty->assign("orders",array($order));
	}
} else if (!empty($_POST['name']) and strlen($_POST['name'])) {
	$query = "SELECT * FROM $db->order, $db->departure, $db->boat 
			  WHERE order_departure_id = departure_id
			  AND departure_boat_id = boat_id
			  AND (
			  concat(order_first_name, ' ', order_last_name) LIKE '%".mysql_real_escape_string($_POST['name'])."%'
              )" ;
    $smarty->assign("client_name",$_POST['name']);
	$fields = array("order_id", "order_unique_code", "order_title", "order_first_name", "order_last_name", "order_phone","order_email",
			  "order_total","order_used", "departure_date", "departure_time", "boat_name");
	$order = $db->select_fields($db->order,$query, $fields, "", "", "", "", "", 100);
	if(!count($order)){
		$smarty->assign("message","The name you filled not found!");
	} else {
		$smarty->assign("orders",$order);
	}
}

	break;	

	case "vouchers":

if(!empty($_POST['query'])){

	$query = "SELECT * FROM $db->voucher_order, $db->voucher
		  WHERE voucher_order_voucher_id = voucher_id
		  AND voucher_order_payd = 1
		  AND voucher_order_number = '".$_POST['query']."'" ; 

	$fields = array("voucher_order_id", "voucher_order_unique_code", "voucher_order_to", "voucher_order_email", "voucher_name",
		  "voucher_order_total","voucher_order_date", "voucher_order_discounted_total", "voucher_discount", "voucher_order_number", "voucher_order_used");
	
	$voucher_order = $db->select_fields($db->voucher_order,$query, $fields, "", "", "", "", "", 1);
	if(empty($voucher_order['voucher_order_id'])){
		$smarty->assign("message","The code you filled in is not valid!");
	} else {
		$smarty->assign("voucher_order",$voucher_order);
	}
}
	break;	

}

		$smarty->assign("section",$section);
		$smarty->assign("pages_dir","booking");
		$smarty->assign("page","code");









// asignare variabile smarty si generare fisier smarty :

$smarty->display('cms_pages.tpl');

?>