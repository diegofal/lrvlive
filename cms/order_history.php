<?
if (empty($_GET['id']))
	exit("Invalid booking code. Contact system administrator");

// includere smarty :
require_once "check_login.php";
require_once "../WEB-INF/includes/functions/functions_log.php";
require_once "../WEB-INF/includes/functions/functions_order.php";
require_once "../WEB-INF/includes/classes/mail_queue.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

$results = $db->select_fields("orders_history", "", "","order_id", $_GET['id']);

if (count($results) > 0) {	

	$new_results = array();

	foreach ($results as $history) {		
		if (!empty($history["previous_data"])) {
			$previous_data_array = unserialize($history["previous_data"]);
			$history["previous_data"] = "";
			foreach ($previous_data_array as $key => $value) {
				if ($key == "order_departure_id") {
                    $query = "SELECT * FROM $db->departure, $db->boat WHERE departure_boat_id = boat_id	AND departure_id = ".$value;
					$fields = array("departure_id", "departure_date", "departure_time", "boat_name");					
					$departures = $db->select_fields("departure", $query, $fields);
					$departure = $departures[0];
					$history["previous_data"] .= "departure: ".$departure["departure_date"] . " " . $departure["departure_time"] . " - " . $departure["boat_name"] . "<br/>";
                } else if (!empty($value))
					$history["previous_data"] .= "$key: $value<br/>";
			}
		}
		if (!empty($history["new_data"])) {
			$new_data_array = unserialize($history["new_data"]);
			$history["new_data"] = "";
			foreach ($new_data_array as $key => $value) {                
				if ($key == "order_departure_id") {
                    $query = "SELECT * FROM $db->departure, $db->boat WHERE departure_boat_id = boat_id	AND departure_id = ".$value;
					$fields = array("departure_id", "departure_date", "departure_time", "boat_name");					
					$departures = $db->select_fields("departure", $query, $fields);
					$departure = $departures[0];
					$history["new_data"] .= "departure: ".$departure["departure_date"] . " " . $departure["departure_time"] . " - " . $departure["boat_name"] . "<br/>";
                } else if (!empty($value))
					$history["new_data"] .= "$key: $value<br/>";
			}
		}
		$new_results[] = $history;
	}

	$smarty->assign("rows",count($new_results));
	$smarty->assign("results",$new_results);	
}

$smarty->display('make_booking/page_order_history.tpl');
?>