<?
// includere smarty :
include "check_login.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;

if (@$_GET['option'] == 'use' && !empty($_GET['mark'])) {
	$db->edit_field($db->voucher_order, array("voucher_order_used"=>"1"), "voucher_order_unique_code", $_GET['mark'] );
	#echo $_GET['mark'];
	header("Location: voucher_orders.php");
	exit;
}
if (@$_GET['option'] == 'delete' && !empty($_GET['mark'])) {
	$db->edit_field($db->voucher_order, array("voucher_order_delete"=>"1"), "voucher_order_unique_code", $_GET['mark'] );
	#echo $_GET['mark'];
	header("Location: voucher_orders.php");
	exit;
}

//initializez variabilele nedefinite
$utils->set_get_var($subpage, "subpage","calendar");
$utils->set_get_var($month, "month", 0);

// setare variabile :
$utils->set_get_var($start, "start", 0);
$utils->set_get_var($voucher_order, "voucher_order", "voucher_order_date DESC");


$query = "SELECT * FROM $db->voucher_order, $db->voucher
		  WHERE voucher_order_voucher_id = voucher_id
		  AND voucher_order_payd = 1"; 

$total_records = $db->get_num_rows($db->voucher_order, $query);

//generate table head
$head_fields = array("voucher_order_date"=>"Date", "voucher_order_to"=>"Name",
				"voucher_name"=>"Voucher", "voucher_order_email"=>"Email", "voucher_order_total"=>"Total", "voucher_discount"=>"Discount", "voucher_order_id"=>"No.", "voucher_order_discounted_total"=>"Final price", "voucher_order_number"=>"Voucher No.");
$head = $utils->head_table_new($head_fields, "voucher_orders.php", "voucher_order", "voucher_order_id|ASC", "table-header", "table-headerUp", "table-headerDwn");
$smarty->assign("head",$head);

// generarea link-urilor de navigare :
$navigator = $utils->navigate_text_new($total_records, $start, PER_PAGE, "voucher_orders.php", "submenu", 10);
$smarty->assign("navigator",$navigator);

$fields = array("voucher_order_id", "voucher_order_unique_code", "voucher_order_to", "voucher_order_email", "voucher_name",
		  "voucher_order_total","voucher_order_date", "voucher_order_discounted_total", "voucher_discount", "voucher_order_number", "voucher_order_used", "voucher_order_delete");

$voucher_orders = $db->select_fields($db->voucher_order,$query, $fields, "", "", $voucher_order, $start, PER_PAGE);
$smarty->assign("voucher_orders",$voucher_orders);

			

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","booking");
$smarty->assign("page","voucher_orders");
$smarty->display('cms_pages.tpl');

?>