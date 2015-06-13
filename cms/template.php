<?
// includere smarty :
include "check_login.php";


// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";
//definire obiect utils
$utils = new x3_utils;


if (isset($_GET['tour_id']) && is_numeric($_GET['tour_id'])) {
	$utils->set_get_var($tour_id, "tour_id", $_GET['tour_id']);
	}
else {
	$query = "SELECT tour_id FROM `".$db->tour."` WHERE 1 AND tour_del = 0";
	$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);
//	$tour_id  = $tour_ids[0];
	$utils->set_get_var($tour_id, "tour_id", $tour_ids[0]);
	}

$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0";
$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

$query = "SELECT tour_name FROM `".$db->tour."` WHERE 1 AND tour_id = ".$tour_id."";
$tour_name = $db->select_field ($db->tour, "tour_name", "", $query);


if(!empty($_GET['message']) && ($_GET['message']=="OK")){
	$smarty->assign("message","The departure(s) were successfully added");
}

//if($db->insert_field($db->departure, $_POST))
if(!empty($_POST)){
	if (($_POST['time_fromHour'].":".$_POST['time_fromMinute']>$_POST['time_toHour'].":".$_POST['time_toMinute']) ||
	($_POST['date_fromYear'].$_POST['date_fromMonth'].$_POST['date_fromDay']>$_POST['date_toYear'].$_POST['date_toMonth'].$_POST['date_toDay']) ||
	($_POST['frequencyMinute']=="00")){
		$smarty->assign("message","The time interval is not well-defined!");
	} else {
		//parcurg toate zile din ziua de start pana in ziua de stop si adaug in baza de date
		$cur_day = $_POST['date_fromYear']."-".$_POST['date_fromMonth']."-".$_POST['date_fromDay'];
		$from = $_POST['date_fromYear']."-".$_POST['date_fromMonth']."-".$_POST['date_fromDay'];
		$to = $_POST['date_toYear']."-".$_POST['date_toMonth']."-".$_POST['date_toDay'];
		$i=0;
		do {
			$cur_day = date("Y-m-d", mktime(0, 0, 0, $_POST['date_fromMonth'], $_POST['date_fromDay']+$i, $_POST['date_fromYear']));
			$start_time = date("H:i", mktime($_POST['time_fromHour'], $_POST['time_fromMinute'], 0, $_POST['date_fromMonth'], $_POST['date_fromDay']+$i, $_POST['date_fromYear']));
			$stop_time = date("H:i", mktime($_POST['time_toHour'], $_POST['time_toMinute']-$_POST['frequencyMinute'], 0, $_POST['date_fromMonth'], $_POST['date_fromDay']+$i, $_POST['date_fromYear']));
			$cur_time = date("H:i", mktime($_POST['time_fromHour'], $_POST['time_fromMinute'], 0, $_POST['date_fromMonth'], $_POST['date_fromDay']+$i, $_POST['date_fromYear']));
			$j=0;
			do{
				$cur_time = date("H:i", mktime($_POST['time_fromHour'], $_POST['time_fromMinute']+$j, 0, $_POST['date_fromMonth'], $_POST['date_fromDay']+$i, $_POST['date_fromYear']));
				//addd in database
				$fields = array("departure_boat_id"=>$_POST['departure_boat_id'], "departure_date"=>$cur_day, "departure_time"=>$cur_time, "departure_tour_id"=>$tour_id);
				$db->insert_field($db->departure, $fields);
				//print $cur_day." ".$cur_time."<br>";
				$j+=$_POST['frequencyMinute'];
			} while ($stop_time >= $cur_time);
			$i++;
		} while ($to > $cur_day);	
		header("Location: template.php?tour_id=".$tour_id."&message=OK");
		exit();
		//print_r($_POST);
	}
}

$query = "SELECT * FROM $db->boat WHERE 1 AND boat_tour_id=".$tour_id." AND boat_del = 0";
$boats = $db->select_field_keyval($db->boat, $query, "boat_id", "boat_name", "boat_name");
$smarty->assign("boats",$boats);

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","booking");
$smarty->assign("page","template");
$smarty->assign("tour_id",$tour_id);
$smarty->assign("tour_name",$tour_name[0]);
$smarty->assign("tours",$tours);

$smarty->display('cms_pages.tpl');

?>