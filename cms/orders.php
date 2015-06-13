<?
// includere smarty :
require_once "check_login.php";
require_once "../WEB-INF/includes/functions/functions_log.php";
require_once "../WEB-INF/includes/functions/functions_order.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;

//initializez variabilele nedefinite
$utils->set_get_var($subpage, "subpage","calendar");
$utils->set_get_var($month, "month", 0);

// setare variabile :
$utils->set_get_var($start, "start", 0);
$utils->set_get_var($order, "order", "order_id");

//view calendar
if(!empty($_GET['mark'])){
	//$db->edit_field($db->order, array("order_used"=>1), "order_id", $_GET['mark']);
	edit_order(array("order_used"=>1), "order_id", $_GET['mark'], "backend orders");
}

$query_add = "";
if(isset($_GET['filter']) && is_numeric($_GET['filter'])){
	$query_add = " AND order_used ='".$_GET['filter']."'";
}

$query = "SELECT * FROM $db->order, $db->departure, $db->boat, $db->tour
		  WHERE order_departure_id = departure_id
		  AND order_payd = 1
		  AND departure_tour_id = tour_id
		  AND departure_boat_id = boat_id".$query_add ; 

$total_records = $db->get_num_rows($db->order, $query);

//generate table head
$head_fields = array("order_id"=>"Code","departure_date"=>"Date","departure_time"=>"Time", "order_first_name"=>"Name",
				"boat_name"=>"Boat", "order_email"=>"Email", "order_total"=>"Total", "order_used"=>"Used", "order_id"=>"Tkt", "tour_name"=>"Tour");
$head = $utils->head_table_new($head_fields, "orders.php", "order", "order_id|ASC", "table-header", "table-headerUp", "table-headerDwn");
$smarty->assign("head",$head);

// generarea link-urilor de navigare :
$navigator = $utils->navigate_text($total_records, $start, PER_PAGE, "orders.php", "submenu", 5);
$smarty->assign("navigator",$navigator);

$fields = array("order_id", "order_unique_code", "order_title", "order_first_name", "order_last_name", "order_phone","order_email",
		  "order_total","order_used", "departure_date", "departure_time", "boat_name", "tour_name");

$orders = $db->select_fields($db->order,$query, $fields, "", "", $order, $start, PER_PAGE);
$smarty->assign("orders",$orders);

			

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","booking");
$smarty->assign("page","orders");
$smarty->display('cms_pages.tpl');

?>