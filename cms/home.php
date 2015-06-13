<?
$id_page = 1;

include "gen_editor.php";

//20110403 fix start
$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_home_name1", "tour_home_name2", "tour_duration", "tour_home_image", "title_home_page", "tour_special_text_home", "tour_charter_price"));

foreach ($tours as $index=>$tour) {
	$query = "SELECT ticket_type, ticket_price FROM `".$db->ticket."` WHERE 1 AND ticket_tour_id = '".$tour['tour_id']."' AND ticket_del = 0";
	$tickets = $db->select_fields($db->ticket, $query, array("ticket_type", "ticket_price"));
	if (sizeof($tickets)>0)
		$tours[$index]['tour_tickets'] = $tickets;
	else 
		$tours[$index]['tour_tickets'] = false;

	$query = "SELECT * FROM $db->voucher WHERE 1 AND voucher_del = 0 AND voucher_tour_id = ".$tour['tour_id']." ORDER BY voucher_id ASC";
	$vouchers = $db->select_fields ($db->voucher,$query, array("voucher_id","voucher_tour_id"));
	if (sizeof($vouchers) > 0) {
		$tours[$index]['have_voucher'] = true;
		$tours[$index]['voucher_id'] = $vouchers[0]['voucher_id'];
	}


}

$smarty->assign("tours",$tours);
//20110403 fix end

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","editor");
$smarty->assign("page","home");
$smarty->display('cms_pages.tpl');
?>
