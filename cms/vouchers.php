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

//delete voucher
//GENII здесь дописать удаление departures, boats, tickets
if (@$_GET['option'] == 'delete' && !empty($_GET['voucher_id']) && is_numeric($_GET['voucher_id'])){
    $db->edit_field($db->voucher, array("voucher_del"=>1), "voucher_id", $_GET['voucher_id'] );
    header("Location: vouchers.php");
    exit();
}



// setare variabile :
$utils->set_get_var($start, "start", 0);
$utils->set_get_var($order, "order", "voucher_id");

//view calendar
//if(!empty($_GET['mark'])){
//  $db->edit_field($db->order, array("order_used"=>1), "order_id", $_GET['mark']);
//}

$query_add = "AND voucher_del = 0";
//if(isset($_GET['filter']) && is_numeric($_GET['filter'])){
//  $query_add = " AND order_used ='".$_GET['filter']."'";
//}

$query = "SELECT * FROM $db->voucher, $db->tour
          WHERE 1
          AND voucher_tour_id = tour_id
          ".$query_add ; 

$total_records = $db->get_num_rows($db->voucher, $query);

//generate table head
$head_fields = array("voucher_id"=>"Voucher ID","voucher_name"=>"Voucher Name", "voucher_tour_id"=>"Voucher Tour", "voucher_discount"=>"Discount");

$head = $utils->head_table_new($head_fields, "vouchers.php", "order", "voucher_id|ASC", "table-header", "table-headerUp", "table-headerDwn");
$smarty->assign("head",$head);

// generarea link-urilor de navigare :
$navigator = $utils->navigate_text($total_records, $start, PER_PAGE, "vouchers.php", "submenu", 5);
$smarty->assign("navigator",$navigator);

$fields = array("voucher_id", "voucher_name", "voucher_del", "voucher_discount", "tour_name");
$vouchers = $db->select_fields($db->voucher,$query, $fields, "voucher_del", "0", $order, $start, PER_PAGE);
$smarty->assign("vouchers",$vouchers);

            

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","booking");
$smarty->assign("page","vouchers");
$smarty->display('cms_pages.tpl');

?>