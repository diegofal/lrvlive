<?
session_start();

if ((empty($_SESSION['logged_in']))) {
	header("Location: index.php");
	exit();
}

$current_reseller_id = 31;


// includes 
require_once "../WEB-INF/includes/classes/class.x3.database.php";
require_once "../WEB-INF/includes/config.php";
require_once "../WEB-INF/includes/functions/functions_utils.php";
include "../WEB-INF/includes/smarty/smarty_cms.php";


// DB connction
$db = new DB_config;
$db->connect();

$query = "DELETE FROM $db->order WHERE order_payd = 0 AND order_time < ".(time()-1800);
$db->delete_field($db->order, "", "", $query);

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;

$curent_date = $_REQUEST['vdate'];
$cur_day_format =  date("l,F d",strtotime($curent_date));

//tickets init


		$query = "SELECT * FROM $db->reseller_tickets WHERE reseller_id=" . $current_reseller_id;
		$reseller_tickets = $db->select_fields($db->reseller_tickets, $query, "");
		$rtickets = array();
		if (sizeof($reseller_tickets) > 0){
			foreach ($reseller_tickets as $rticket){
				$rtickets[$rticket['ticket_id']] = $rticket['ticket_price'];
			}
		}

		$query = "SELECT * FROM $db->ticket WHERE ticket_del ='0'";
		$tickets = $db->select_fields($db->ticket, $query, "");

		$valid_tickets = array();
		$adult_tickets = array();
		$child_tickets = array();
		foreach ($tickets as $ticket){
			if (strtolower(substr($ticket['ticket_type'],0,5)) == "adult" || strtolower(substr($ticket['ticket_type'],0,5)) == "adults"){
				$valid_tickets[$ticket['ticket_tour_id']]['adult']['ticket_id'] = $ticket['ticket_id'];

				if (array_key_exists($ticket['ticket_id'], $rtickets)) { 
					$valid_tickets[$ticket['ticket_tour_id']]['adult']['ticket_price'] = $rtickets[$ticket['ticket_id']]; 
				} else {
					$valid_tickets[$ticket['ticket_tour_id']]['adult']['ticket_price'] = $ticket['ticket_price']; 
				}
				$adult_tickets[] = $ticket['ticket_id']; 
			}
			if (strtolower(substr($ticket['ticket_type'],0,5)) == "child"){
				$valid_tickets[$ticket['ticket_tour_id']]['child']['ticket_id'] = $ticket['ticket_id']; 
				if (array_key_exists($ticket['ticket_id'], $rtickets)) { 
					$valid_tickets[$ticket['ticket_tour_id']]['child']['ticket_price'] = $rtickets[$ticket['ticket_id']]; 
				} else {
					$valid_tickets[$ticket['ticket_tour_id']]['child']['ticket_price'] = $ticket['ticket_price']; 
				}
				$child_tickets[] = $ticket['ticket_id']; 
			}
		}
		

if ($_POST && isset($_POST['openHistoryId']) && !empty($_POST['openHistoryId'])) {
	$history_id = explode ("_", $_POST['openHistoryId']);
	$history_id = $history_id[1];
} else 	
	$history_id = false;

//print_r($_POST);

if ($_POST && isset($_POST['job'])) {

	$_POST['job'] = explode("_", $_POST['job']);
	$action = $_POST['job'][0];
	if ($action == "add") {
		$departure_id = (int)$_POST['job'][1];
		if ($departure_id != 0) {

			$query = "SELECT * FROM $db->ticket
					  WHERE ticket_del ='0'";				
			$_ticket = $db->select_field_keyval($db->ticket, $query, "ticket_id", "ticket_seats");
			$_total_seats = 0;
			

			foreach($_POST['q'][$departure_id] as $key => $value){
				//tour_id
				$query = "SELECT * FROM $db->ticket
				  WHERE ticket_del ='0'";				
				$_ticket_tour = $db->select_field_keyval($db->ticket, $query, "ticket_id", "ticket_tour_id");
				$tour_id = $_ticket_tour[$key];
				$_total_seats += $value * $_ticket[$key];

				$order_total = 0;
				if ($key == $valid_tickets[$tour_id]['adult']['ticket_id'])
					$order_total1 = ($valid_tickets[$tour_id]['adult']['ticket_price'] * $value);
				if ($key == $valid_tickets[$tour_id]['child']['ticket_id'])
					$order_total2 = ($valid_tickets[$tour_id]['child']['ticket_price'] * $value);

				if (!empty($value)) {
					$_tickets[] = $key;
					$_quantity[] = $value;
				}
			}
			$order_total = $order_total1 + $order_total2; 
		

		    // free places check
			$query = "SELECT departure_id, departure_time, boat_passengers
					  FROM $db->departure,  $db->boat
					  WHERE departure_id = '".$departure_id."'
					  AND departure_boat_id = boat_id
					  AND departure_tour_id = ".$tour_id."
					  AND boat_del = 0";
	
			$fields = array("departure_id", "departure_time", "boat_passengers");
	
			$departure = $db->select_fields($db->departure, $query, $fields, "", "", "", "", "", 1);

						
			if (!empty($departure['departure_id'])) {

				$sum = $_total_seats;

				$query2 = "SELECT * FROM $db->order
						  WHERE order_departure_id = '".$departure_id."'";
				$fields = array("order_tickets", "order_tickets_number");
				$orders = $db->select_fields($db->order, $query2, $fields); //"

				foreach($orders as $order)
				{
					//charter
				if (($order['order_tickets']==0) && ($order['order_tickets_number']==1)) {
						$sum += $departure['boat_passengers'];
					} else {
					//normal
						$sum +=  $order['order_tickets_number'];
					}
				}
			}

			if ($sum <= $departure['boat_passengers']) {
	
			$fields = array("order_tickets"=>implode("|",$_tickets),"order_quantities"=>implode("|",$_quantity), "order_tickets_number"=>$_total_seats, "order_total"=>$order_total);
//			print_r($fields); die();
			$uniqCode = md5(uniqid(rand(), true));

			//commission
			$query = "SELECT * FROM $db->resellers WHERE reseller_id=". $current_reseller_id . " AND reseller_del = 0";
			$resellers = $db->select_fields ($db->resellers, $query, "","","", "", "", "", 1);
			$reseller = $resellers['reseller_name'];
			
			//commision
			$query = "SELECT * FROM $db->reseller_cmns WHERE reseller_id=". $current_reseller_id . " AND reseller_tour_id  = ".$tour_id."";
			$cmn = $db->select_fields ($db->reseller_cmns, $query, "","","", "", "", "", 1);
			$fields['order_reseller_commission'] = ($fields['order_total']/100) * $cmn['reseller_cmn'];
if($_GET['vdate']!='')
{
 $add_in_date=$_GET['vdate'];
}
else
{
 $add_in_date=date("Y-m-d");
}
			$fields = array_merge($fields,
					  array("order_date"=>$add_in_date, 
							"order_unique_code"=> $uniqCode, 
							"order_departure_id" => $departure_id,
							"order_email" => "",
							"order_payd" => 1,
							"order_time" => time(),
							"order_reseller_id " => $current_reseller_id,	
							"order_reseller_name" => $reseller,
							"order_method" => "cash"
							)
						);	
			//******
			$db->insert_field($db->order, $fields);		
			$status = "Order Added";
		} else {
			$error = "The ticket(s) you have booked have just been purchased by another person.\\nPlease try again with another option.";	
		}
		$history_id = $departure_id;
		}

	}

	if ($action == "save") {
		$departure_id = (int)$_POST['job'][1];
		$order_id = (int)$_POST['job'][2];
		if ($departure_id != 0 && $order_id !=0 && $db->exist_value($db->order,'order_id',$order_id)) {

			foreach($_POST['h'][$order_id] as $key => $value){
				$_seats +=$value;
			}

			if ($_seats == 0) {
				$db->delete_field($db->order, "order_id", $order_id);			
				$status = "Order Deleted";
			} else {

				$query = "SELECT * FROM $db->ticket
						  WHERE ticket_del ='0'";				
				$_ticket = $db->select_field_keyval($db->ticket, $query, "ticket_id", "ticket_seats");
				$_total_seats = 0;
				
				
				foreach($_POST['h'][$order_id] as $key => $value){
					//tour_id
					$query = "SELECT * FROM $db->ticket
					  WHERE ticket_del ='0'";				
					$_ticket_tour = $db->select_field_keyval($db->ticket, $query, "ticket_id", "ticket_tour_id");
					$tour_id = $_ticket_tour[$key];
					$_total_seats += $value * $_ticket[$key];
					$order_total = 0;
					if ($key == $valid_tickets[$tour_id]['adult']['ticket_id'])
						$order_total1 = ($valid_tickets[$tour_id]['adult']['ticket_price'] * $value);
					if ($key == $valid_tickets[$tour_id]['child']['ticket_id'])
						$order_total2 = ($valid_tickets[$tour_id]['child']['ticket_price'] * $value);

					if (!empty($value)) {
						$_tickets[] = $key;
						$_quantity[] = $value;
					}
				}
				$order_total = $order_total1 + $order_total2; 
				$order_fields = array("order_tickets"=>implode("|",$_tickets),"order_quantities"=>implode("|",$_quantity), "order_tickets_number"=>$_total_seats, "order_total"=>$order_total);

			    // free places check
				$query = "SELECT departure_id, departure_time, boat_passengers
						  FROM $db->departure,  $db->boat
						  WHERE departure_id = '".$departure_id."'
						  AND departure_boat_id = boat_id
						  AND departure_tour_id = ".$tour_id."
						  AND boat_del = 0";
		
				$fields = array("departure_id", "departure_time", "boat_passengers");
		
				$departure = $db->select_fields($db->departure, $query, $fields, "", "", "", "", "", 1);
	
							
				if (!empty($departure['departure_id'])) {
					//

					$current_order = $db->select_fields($db->order, "", "", 'order_id', $order_id, "", "", "", 1);
					$sum = $_total_seats - $current_order['order_tickets_number'];
					$query2 = "SELECT * FROM $db->order
							  WHERE order_departure_id = '".$departure_id."'";
					$fields = array("order_tickets", "order_tickets_number");
					$orders = $db->select_fields($db->order, $query2, $fields); //"
	
					foreach($orders as $order)
					{
						//charter
					if (($order['order_tickets']==0) && ($order['order_tickets_number']==1)) {
							$sum += $departure['boat_passengers'];
						} else {
						//normal
							$sum +=  $order['order_tickets_number'];
						}
					}
				}

				if ($sum <= $departure['boat_passengers']) {
	
					if($db->edit_field($db->order, $order_fields, "order_id", $order_id)) {
						$status = "Order Updated";
				}
			} else {
				$error = "The ticket(s) you have booked have just been purchased by another person.\\nPlease try again with another option.";
			}

			}


		$history_id = $departure_id;
		}

	}

//	print_r($_POST);
}


		//$selected_date = "2007-10-06";
if($_GET['vdate']!='')
{
 $selected_date=$_GET['vdate'];
}
else
{
 $selected_date= date ("Y-m-d", time());
}		
		//$selected_date = date ("Y-m-d", time());
		






		//extract departures
		$query = "SELECT *, UNIX_TIMESTAMP(concat_ws(' ', departure_date, departure_time )) AS departure_unixtime
			      FROM $db->departure, $db->boat, $db->tour
				  WHERE departure_boat_id = boat_id
				  AND departure_tour_id = tour_id
				  AND departure_date = '".$selected_date."'
				  AND boat_del = 0
				  ORDER BY departure_time ASC
				  ";
				  

		$fields = array("departure_id", "departure_tour_id", "departure_boat_id", "boat_passengers", "departure_date", "departure_time", "tour_name", "boat_del", "departure_unixtime");
		$departures = $db->select_fields($db->boat, $query, $fields);
		foreach($departures as $key => $departure){
		
			$query = "SELECT * FROM $db->order 
					  WHERE order_departure_id = '".$departure['departure_id']."'";
			$orders = $db->select_fields($db->order, $query);
			$total_blocked = 0;
			foreach($orders as $order){
				if($order['order_tickets']!='0'){
					$total_blocked += $order['order_tickets_number'];
				
				} else {
					$total_blocked += $departure['boat_passengers'];
				}
			}		
		  $query = "SELECT o.*, d.departure_tour_id AS order_tour_id FROM $db->order AS o
					  LEFT JOIN $db->departure AS d ON o.order_departure_id = d.departure_id
					  WHERE order_departure_id = '".$departure['departure_id']."'
					  AND order_payd = 1";
			$fields = array("order_id", "order_sid", "order_date", "order_unique_code", "order_departure_id", "order_tickets", "order_quantities", "order_tickets_number", "order_total", "order_method", "order_payd", "order_time", "order_reseller_id", "order_reseller_name", "order_reseller_commission", "order_bespoke_price", "order_type", "order_tour_id");
			$orders = $db->select_fields($db->order, $query, $fields);

			$total = 0;
			$total_price = 0.00;
			
			for ($i=0;$i<=sizeof($orders)-1; $i++){

				if($orders[$i]['order_tickets']!='0'){
					$total += $orders[$i]['order_tickets_number'];
				} else {
					$total += $departure['boat_passengers'];
				}
				$total_price += $orders[$i]['order_total'];

				$orders[$i]['order_tickets'] = explode("|", $orders[$i]['order_tickets']);
				$orders[$i]['order_quantities'] = explode("|", $orders[$i]['order_quantities']);		

				foreach ($adult_tickets as $_ticket) {

					$j = array_search($_ticket, $orders[$i]['order_tickets']);
					if ($j !== FALSE) {
						$orders[$i]['order_adult_tickets'] = $orders[$i]['order_quantities'][$j];
					} 
				}

				foreach ($child_tickets as $ticket) {
					$j = array_search($ticket, $orders[$i]['order_tickets']);
					if ($j !== FALSE) {
						$orders[$i]['order_child_tickets'] = $orders[$i]['order_quantities'][$j];
					}
				}

			}
			$reseller_orders = array();
			foreach ($orders as $order) {
				if ($current_reseller_id == $order['order_reseller_id'])
					$reseller_orders[] = $order;
			}



			$departures[$key]['orders'] = $orders;
			$departures[$key]['reseller_orders'] = $reseller_orders;
			$departures[$key]['reseller_orders_num'] = sizeof($reseller_orders);
			$departures[$key]['reserved'] = $total;
			$departures[$key]['blocked'] = $total_blocked;
			$departures[$key]['available'] = $departure['boat_passengers'] - $total_blocked;
			$departures[$key]['total_price'] = sprintf("%0.2f",$total_price);
			$departures[$key]['timedout'] = (time() >= $departure['departure_unixtime'])?1:0;
			
//			$departures[$key]['timedout'] = 0;
		}
			
		
//		print_r($departures);
		$smarty->assign("error",$error);
		$smarty->assign("status",$status);
		$smarty->assign("history_id",$history_id);
		$smarty->assign("current_reseller_id",$current_reseller_id);
		$smarty->assign("departures",$departures);
		$smarty->assign("tickets",$tickets);
		$smarty->assign("valid_tickets",$valid_tickets);
		$smarty->assign("cur_day_format",$cur_day_format);
		
//		$smarty->assign("unixtime",time());
	
		$smarty->assign("pages_dir","reseller_booking");
		$smarty->assign("page","bookings_test");
		$smarty->display('cms_resellers.tpl');	

?>