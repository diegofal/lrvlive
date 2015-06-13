<?
// includere smarty :
include "check_login.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;

//initializez variabilele nedefinite
//$utils->set_get_var($subpage, "subpage","calendar");
//$utils->set_get_var($month, "month", 0);

//delete tour
//GENII здесь дописать удаление departures, boats, tickets
if (@$_GET['option'] == 'delete' && !empty($_GET['tour_id']) && is_numeric($_GET['tour_id'])){
	$db->edit_field($db->tour, array("tour_del"=>1), "tour_id", $_GET['tour_id'] );
	header("Location: tours.php");
	exit();
}



// setare variabile :
$utils->set_get_var($start, "start", 0);
$utils->set_get_var($order, "order", "tour_id");

//view calendar
//if(!empty($_GET['mark'])){
//	$db->edit_field($db->order, array("order_used"=>1), "order_id", $_GET['mark']);
//}

$query_add = "AND tour_del = 0";
//if(isset($_GET['filter']) && is_numeric($_GET['filter'])){
//	$query_add = " AND order_used ='".$_GET['filter']."'";
//}

$query = "SELECT * FROM $db->tour
		  WHERE 1
		  ".$query_add ; 

$total_records = $db->get_num_rows($db->tour, $query);

//generate table head
$head_fields = array("tour_id"=>"Tour ID","tour_name"=>"Tour Name", "tour_charter_price"=>"Charter Price");

$head = $utils->head_table_new($head_fields, "tours.php", "order", "tour_id|ASC", "table-header", "table-headerUp", "table-headerDwn");
$smarty->assign("head",$head);

// generarea link-urilor de navigare :
$navigator = $utils->navigate_text($total_records, $start, PER_PAGE, "tours.php", "submenu", 5);
$smarty->assign("navigator",$navigator);

$fields = array("tour_id", "tour_name", "tour_del", "tour_charter_price");

$tours = $db->select_fields($db->tour,$query, $fields, "tour_del", "0", $order, $start, PER_PAGE);
$smarty->assign("tours",$tours);

			

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","booking");
$smarty->assign("page","tours");
$smarty->display('cms_pages.tpl');

?>