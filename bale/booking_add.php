<?
session_start();

if ((empty($_SESSION['logged_in']))) {
	header("Location: index.php");
	exit();
}

/*
 * Check Query String Parameters
*/

$curyear = $_GET['curyear'];

if(!isset($_GET['vdate']) || strtotime($_GET['vdate']) == FALSE) {
	header("Location: index.php");
	exit();
}
$selected_date=$_GET['vdate'];
if(!isset($_GET['departure_id']) || !is_numeric($_GET['departure_id'])) {
	header("Location: index.php");
	exit();
}

$departure_id = $_GET['departure_id'];
$current_reseller_id = $_SESSION['current_reseller_id'];

// includes
require_once "../WEB-INF/includes/classes/class.x3.database.php";
require_once "../WEB-INF/includes/config.php";
require_once "../WEB-INF/includes/functions/functions_utils.php";
require_once "../WEB-INF/includes/functions/functions_log.php";
require_once "../WEB-INF/includes/functions/functions_order.php";
include "../WEB-INF/includes/smarty/smarty_cms.php";

// DB connction
$db = new DB_config;
$db->connect();

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";
$utils = new x3_utils;

$error = "";

/*
 * ADDING
*/

if ($_POST && $_POST["action"] == "add") {
	$tour_id 				= $_POST['tour_id'];
	$first_name         	= $_POST['first_name'];
	$_SESSION['FirstName'] 	= $first_name;
	$last_name         		= $_POST['last_name'];
	$_SESSION['LastName'] 	= $last_name;
	$phone             		= $_POST['mobile'];
	$_SESSION['Phone'] 		= $phone;
	$email             		= $_POST['email'];
	$_SESSION['Email'] 		= $email;

	$tickets = $_POST["ticket"];
	$tickets_quantity = $_POST["quantity"];
	$tickets_price = $_POST["price"];

	//Calculate total seats, order total
	$order_total = 0;
	$order_tickets = array();
	$order_tickets_quantities = array();
	$order_tickets_number = 0;

	$_tickets_seats = $db->select_field_keyval($db->ticket,
							"SELECT * FROM
								reseller_tickets rt
								INNER JOIN ticket ti ON (rt.ticket_id = ti.ticket_id)
								INNER JOIN tours tou ON (ti.ticket_tour_id = tou.tour_id)
								INNER JOIN departure de ON (tou.tour_id = de.departure_tour_id)
							WHERE 
								de.departure_id = $departure_id 
								AND rt.reseller_id = $current_reseller_id
								AND ti.ticket_del ='0'", 
							"ticket_id", 
							"ticket_seats");

	foreach($tickets as $i => $ticket_id) {
		if ($tickets_quantity[$i] != 0 && isset($_tickets_seats[$ticket_id])) {
			$order_tickets[] = $ticket_id;
			$order_tickets_quantities[] = $tickets_quantity[$i];
			$order_tickets_number += $_tickets_seats[$ticket_id] * $tickets_quantity[$i];			
			$order_total += $tickets_price[$i] * $tickets_quantity[$i];
		}
	}
	
//	$error = "La hora papi.";

	if ($order_tickets_number == 0) {
		$error = "You entered 0 seats. Please select at least 1 ticket.";
	} else if ($order_total == 0) {
		$error = "There has been an error: order total is $0.";
	} else if (empty($first_name) || empty($last_name) || empty($phone) || empty($email)) {
		$error = "Some of the user information is empty.";
	}

	// free places check
	$query = "SELECT departure_id, departure_time, boat_passengers
							  FROM $db->departure,  $db->boat
							  WHERE departure_id = $departure_id
							  AND departure_boat_id = boat_id
							  AND departure_tour_id = $tour_id
							  AND boat_del = 0";		
	$fields = array("departure_id", "departure_time", "boat_passengers");
	$departure = $db->select_fields($db->departure, $query, $fields, "", "", "", "", "", 1);

	// Added by Carlos
	$cur_day_format = strtotime("+15 minutes",strtotime(Date('Y-m-d H:i:s')));
	$departure_datetime = strtotime($selected_date." ".$departure[departure_time] );
	$result = round(($cur_day_format - $departure_datetime) / 60,2) ;

	if ($result >= 0) {
		$error = "Departure time  expired. Tickets sales for this departure are blocked.";
	}
	//echo $result;		
	//echo "<PRE>".date("Y-m-d H:i", $cur_day_format)."</PRE>";
	//echo "<PRE>".date("Y-m-d H:i", $departure_datetime)."</PRE>";	

	if (empty($error)) {
		//	exit();		
		$sum = $order_tickets_number;
			

		$query = "SELECT * FROM $db->order
								  WHERE order_departure_id = $departure_id";
		$fields = array("order_tickets", "order_tickets_number");
		$orders = $db->select_fields($db->order, $query, $fields);

		foreach($orders as $order)
		{
			if (($order['order_tickets']==0) && ($order['order_tickets_number']==1)) {
				//charter
				$sum += $departure['boat_passengers'];
			} else {
				//normal
				$sum +=  $order['order_tickets_number'];
			}
		}
				
		$valid_seats = ($sum <= $departure['boat_passengers']);

		if ($valid_seats) {

			//echo "save order";

			//SAVE ORDER
			$fields = array("order_tickets"=>implode("|",$order_tickets),
			"order_quantities"=>implode("|",$order_tickets_quantities),
			"order_tickets_number"=>$order_tickets_number,
			"order_total"=>$order_total);

			$uniqCode = md5(uniqid(rand(), true));

			//commission
			$query = "SELECT * FROM $db->resellers WHERE reseller_id=". $current_reseller_id . " AND reseller_del = 0";
			$resellers = $db->select_fields ($db->resellers, $query, "","","", "", "", "", 1);
			$reseller = $resellers['reseller_name'];

			//commision
			$query = "SELECT * FROM $db->reseller_cmns WHERE reseller_id=". $current_reseller_id . " AND reseller_tour_id  = ".$tour_id."";
			$cmn = $db->select_fields ($db->reseller_cmns, $query, "","","", "", "", "", 1);
			//print_r($cmn);
			$fields['order_reseller_commission'] = ($fields['order_total']/100) * $cmn['reseller_cmn'];

			$fields = array_merge($fields,
				array("order_date"=>date("Y-m-d"),
				"order_unique_code"=> $uniqCode,
				"order_departure_id" => $departure_id,
				"order_first_name"=>$first_name,
				"order_last_name"=>$last_name,
				"order_phone"=>$phone,
				"order_email" => $email,
				"order_payd" => 1,
				"order_time" => time(),
				"order_reseller_id " => $current_reseller_id,
				"order_reseller_name" => $reseller,
				"order_method" => "cash"
				)
			);
			//******
			//$db->insert_field($db->order, $fields);
			$id = generate_order($fields, "bale boooking");
			
			require_once "../WEB-INF/includes/functions/functions_email.php";
			
			$order = $db->select_fields($db->order, "", "", 'order_unique_code', $uniqCode, "", "", "", 1);
			send_email_confirmation_front($order);
			
						
			$_SESSION['Name'] 	= "";
			$_SESSION['Phone'] 	= "";
			$_SESSION['Email'] 	= "";
			$_SESSION['Adult'] 	= "";
			$_SESSION['Kids'] 	= "";
		//	header("location:booking.php?vdate=$selected_date&type=Show_Popup");
				header("location:booking_calender.php?type=Show_Popup&id=".$id."&curyear=".$curyear."");
			exit();
						
		} else {
			$error = "The ticket(s) you have booked have just been purchased by another person.\\nPlease try again with another option.";
		}
	}

	if (empty($error)) {
		exit();
	}
}

/*
 * VIEW
*/

// get reseller tickets for this departure/tour
$query = "
	SELECT 
		ti.*, tou.*, rt.*
	FROM
		reseller_tickets rt
		INNER JOIN ticket ti ON (rt.ticket_id = ti.ticket_id)
		INNER JOIN tours tou ON (ti.ticket_tour_id = tou.tour_id)
		INNER JOIN departure de ON (tou.tour_id = de.departure_tour_id)
	WHERE 
		de.departure_id = $departure_id 
		AND rt.reseller_id = $current_reseller_id
		AND ti.ticket_del ='0'
	ORDER BY ti.ticket_type";
	
$tickets = $db->select_fields($db->ticket, $query);
$reseller_tickets = $db->select_fields($db->reseller_tickets, $query);
$tour = $db->select_fields($db->tour, $query);
if (empty($tickets) || empty($tour)) {
	die("Invalid departure id.");
}

$query = "SELECT departure_id, departure_time, departure_date
			FROM 
				$db->departure 
			WHERE 
				departure_id = $departure_id";		
$fields = array("departure_id", "departure_time", "departure_date");
$departure = $db->select_fields($db->departure, $query, $fields, "", "", "", "", "", 1);

$smarty->assign("departure",$departure);
$smarty->assign("error",$error);
$smarty->assign("tickets",$tickets);
$smarty->assign("reseller_tickets",$reseller_tickets);
$smarty->assign("tour",$tour);
$smarty->assign("company_image_path",$_SESSION["companyimagepath"]);
$smarty->assign("pages_dir","reseller_booking");
$smarty->assign("page","bookings_add");
$smarty->display('cms_resellers.tpl');
