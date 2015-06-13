<?
// includere smarty :
require_once "check_login.php";
require_once "../WEB-INF/includes/functions/functions_log.php";
require_once "../WEB-INF/includes/functions/functions_order.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

$where = "";
$message = "";

if (!empty($_POST['txnumber']) and strlen($_POST['txnumber'])) {
	$where = "order_unique_code LIKE '".$_POST['txnumber']."'";
} else if (!empty($_POST['name']) and strlen($_POST['name'])) {
	$where = "(order_first_name LIKE '%".$_POST['name']."%' OR order_last_name LIKE '%".$_POST['name']."%')";
} else if (!empty($_POST['email']) and strlen($_POST['email'])) {
	$where = "order_email LIKE '".$_POST['email']."'";
}

if ($where != '') {
	$query = "SELECT *
				FROM orders_deleted o
				LEFT JOIN departure d ON d.departure_id = o.order_departure_id
				LEFT JOIN boat b ON d.departure_boat_id = b.boat_id
				WHERE $where";
		
	$fields = array("order_id", "order_unique_code", "order_title", "order_first_name", "order_last_name", "order_phone","order_email",
			"order_total","order_used", "departure_date", "departure_time", "boat_name", "order_tickets_number", "order_tickets", "order_quantities");
	$ordersResult = $db->select_fields("orders_deleted",$query,$fields);
		
	if (count($ordersResult) > 0) {
		
		$orders = array();
	
		$query = "SELECT * FROM ticket
					WHERE ticket_del ='0'";
		$tickets = $db->select_fields($db->ticket, $query);

		foreach ($ordersResult as $order) {
			
			$ticket_str = array();
			$order_tickets = explode("|", $order["order_tickets"]);
			$order_quantities = explode("|", $order["order_quantities"]);
			
			if (count($order_tickets) == count($order_quantities) && count($order_tickets) > 0) {
				for ($i = 0; $i < count($order_tickets); $i++) {
					$ticket_str[] = getTicketStr($tickets, $order_tickets[$i], $order_quantities[$i]);
				}				
			}
			$order["tickets"] = implode(" | ", $ticket_str);
			
			$orders[] = $order;
		}
		
		$smarty->assign("rows",count($orders));
		$smarty->assign("orders",$orders);
	} else {
		$smarty->assign("message","No orders were found.");
	}
}

$smarty->assign("pages_dir","booking");
$smarty->assign("page","deleted_orders");

$smarty->display('cms_pages.tpl');

function getTicketStr ($ticketsArr, $ticketId, $ticketQty) {	
	foreach($ticketsArr as $ticket) {
		if ($ticket["ticket_id"] == $ticketId) {
			return $ticket["ticket_type"].": ".$ticketQty;
		}
	}
	return "ticket #$ticketId: $ticketQty";
}
?>