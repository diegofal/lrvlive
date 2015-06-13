<? ob_start();

require_once "../WEB-INF/includes/functions/functions_benchmark.php";
$profiler = new profiler("cms_calendar");

//////////////////////////
$profiler->start_block("init_including");
//////////////////////////
	
// start session:
$profiler->start_block("init_including_checklogin_sessionstart");
session_name("cms_session");
session_start();
$profiler->stop_block("init_including_checklogin_sessionstart");

	////////////////////////
	$profiler->start_block("init_including_x3utils");
	$profiler->start_block("init_including_x3utils_require");
	////////////////////////
	require_once "../WEB-INF/includes/classes/class.x3.utils.php";
	
	$profiler->stop_block("init_including_x3utils_require");
	$profiler->start_block("init_including_x3utils_construct");
	
	$utils = new x3_utils;
	$utils->set_get_var($subpage, "subpage","calendar");
	$utils->set_get_var($order, "order", "departure_time");
	
	$def_month = (isset($_SESSION['sess_month']) && !isset($_GET["month"]) ? $_SESSION['sess_month'] : "0" );
	$utils->set_get_var($month, "month", $def_month);
	$_SESSION['sess_month'] = $month;
		
	////////////////////////
	$profiler->stop_block("init_including_x3utils_construct");
	$profiler->stop_block("init_including_x3utils");
	////////////////////////

	//////////////////////////
	$profiler->start_block("init_including_checklogin");
	//////////////////////////

		
		$profiler->start_block("init_including_checklogin_requires");
		// includes
		require_once "../WEB-INF/includes/classes/class.x3.database.php";
		require_once "../WEB-INF/includes/config.php";
		require_once "../WEB-INF/includes/functions/functions_utils.php";
		include "../WEB-INF/includes/smarty/smarty_cms.php";
		$profiler->stop_block("init_including_checklogin_requires");
		
		
		$profiler->start_block("init_including_checklogin_smarty");
		$smarty->assign("menu_cms",$menu_cms);
		$profiler->stop_block("init_including_checklogin_smarty");
		
		
		$profiler->start_block("init_including_checklogin_smarty");
		// DB connction
		$db = new DB_config;
		$db->connect();
		$profiler->start_block("init_including_checklogin_smarty");
		
		/*$profiler->start_block("init_including_checklogin_delete");
		 $query = "DELETE FROM $db->order WHERE order_payd = 0 AND order_time < ".(time()-600);
		$db->delete_field($db->order, "", "", $query);
		$profiler->stop_block("init_including_checklogin_delete");*/
		
		$profiler->start_block("init_including_checklogin_auth");
		// authenticate
		$array_config = array("config_admin_user", "config_admin_pass");
		$array_session = array("username", "password");
		$db->check_session_login($db->config, $array_config, $array_session, "admin", "", "", "", "index.php", "index.php", "booking.php");
		$profiler->stop_block("init_including_checklogin_auth");
	
	//////////////////////////
	$profiler->stop_block("init_including_checklogin");
	$profiler->start_block("init_including_log");
	//////////////////////////
	require_once "../WEB-INF/includes/functions/functions_log.php";
	//////////////////////////
	$profiler->stop_block("init_including_log");
	$profiler->start_block("init_including_order");
	//////////////////////////
	require_once "../WEB-INF/includes/functions/functions_order.php";
	//////////////////////////
	$profiler->stop_block("init_including_order");	
	//////////////////////////
		
	if (isset($_GET['tour_id']) && is_numeric($_GET['tour_id'])) {
		$utils->set_get_var($tour_id, "tour_id", $_GET['tour_id']);
	}
	else {
		$profiler->start_block("init_including_x3utils_settour");
	
		$query = "SELECT tour_id FROM `".$db->tour."` WHERE 1 AND tour_del = 0";
		$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);
	
		$profiler->stop_block("init_including_x3utils_settour");
	
		//	$tour_id  = $tour_ids[0];
		$utils->set_get_var($tour_id, "tour_id", $tour_ids[0]);
	}
	
//////////////////////////
$profiler->stop_block("init_including");
$profiler->start_block("init_getting_tours");
//////////////////////////

$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0";
$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name", "tour_home_name1"));

$query = "SELECT tour_name FROM `".$db->tour."` WHERE 1 AND tour_id = ".$tour_id."";
$tour_name = $db->select_field($db->tour, "tour_name", "", $query);

//////////////////////////
$profiler->stop_block("init_getting_tours");
//////////////////////////

//Delete Skipper
if($_REQUEST['command'] == "delete_skipper")
{
	//////////////////////////
	$profiler->start_block("delete_skipper");
	//////////////////////////
	$skip_guid_id  = $_REQUEST['skiper_guide_id'];
	$cdate         = $_REQUEST['cur_date'];

	$sql_update  = "UPDATE `skipper_guide_entry` SET `skipper_id` = '' WHERE sgid = '$skip_guid_id'";
	$res_update  = mysql_query($sql_update);
	echo "<script>
	location.href='calendar.php?subpage=bookings&day=".$cdate."';
	</script>";
	//////////////////////////
	$profiler->stop_block("delete_skipper");
	//////////////////////////
}


//Delete Guide

if($_REQUEST['command'] == "delete_guide") {
	//////////////////////////
	$profiler->start_block("delete_guide");
	//////////////////////////
	$skip_guid_id  = $_REQUEST['skiper_guide_id'];
	$cdate         = $_REQUEST['cur_date'];

	$sql_update  = "UPDATE `skipper_guide_entry` SET `guide_id` = '' WHERE sgid = '$skip_guid_id'";
	$res_update  = mysql_query($sql_update);
	echo "<script>
	location.href='calendar.php?subpage=bookings&day=".$cdate."';
	</script>";
	//////////////////////////
	$profiler->stop_block("delete_guide");
	//////////////////////////
}


//view calendar
switch($subpage){
	case "bookings":
		//////////////////////////
		$profiler->start_block("subpage_booking");
		//////////////////////////

		$selected_date = @$_GET['day'];
		if(empty($selected_date)) {
			header("Location: calendar.php");
			exit();
		}

		if(!empty($_GET['mark'])  && is_numeric($_GET['mark'])){
			//$db->edit_field($db->order, array("order_used"=>1), "order_id", $_GET['mark']);
			//////////////////////////
			$profiler->start_block("subpage_booking_markasused");
			//////////////////////////
			edit_order(array("order_used"=>1), "order_id", $_GET['mark'], "backend calendar bookings");
			//////////////////////////
			$profiler->stop_block("subpage_booking_markasused");
			//////////////////////////
		}

		if(!empty($_GET['delete']) && is_numeric($_GET['delete'])){
			//////////////////////////
			$profiler->start_block("subpage_booking_delete");
			//////////////////////////

			//Delete email from feedback
			$order_query = $db->select_fields($db->order,"","", 'order_id',$_GET['delete'], "", "", "", 1);
			$email_address = $order_query['order_email'];
			$db->delete_field("feedback_email_list", "email", $email_address);

			$db->delete_field($db->order, "order_id", $_GET['delete']);
			//////////////////////////
			$profiler->stop_block("subpage_booking_delete");
			//////////////////////////
		}

		//////////////////////////
		$profiler->start_block("subpage_booking_departuresquery");
		//////////////////////////

		$head_fields = array("departure_tour_id"=>"Tour","departure_time"=>"Time", "boat_name"=>"Boat (Active/Not)");
		
		$head = $utils->head_table_new($head_fields, "calendar.php", "order", "departure_time|ASC", "table-header", "table-headerUp", "table-headerDwn");
		$smarty->assign("head",$head);
		
		//extract departures
		$query = "SELECT * FROM
			$db->departure, $db->boat
			WHERE departure_boat_id = boat_id
			AND departure_date = '".$selected_date."'";

		$fields = array("departure_id", "departure_boat_id", "departure_tour_id", "boat_passengers", "departure_date", "departure_time", "boat_name", "boat_del");
		$departures = $db->select_fields($db->boat, $query, $fields, "", "", $order);
		
		$information_arr = array();

		//////////////////////////
		$profiler->stop_block("subpage_booking_departuresquery");
		//////////////////////////

		$loop = 0;
		foreach($departures as $key => $departure){
			//////////////////////////
			$profiler->start_block("subpage_booking_departuresloop_".$loop);
			//////////////////////////
			//fetching date for show skipper and guide..........

			$data_query = "select * from skipper_guide_entry where sk_tour_id='".$departure['departure_tour_id']."' and sk_depid='".$departure['departure_id']."'";
			$data_result = mysql_query($data_query);
			if(@mysql_num_rows($data_result))
			{
				$data_srr = mysql_fetch_assoc($data_result);
				$skipper_id    = $data_srr['skipper_id'];
				$guide_id      = $data_srr['guide_id'];
				$skip_guide_id = $data_srr['sgid'];

				$sql_guide    = "SELECT `guide_name` FROM `guide` WHERE `guide_id` = '$guide_id'";
				$result_guide = mysql_query($sql_guide);
				$row_guide    = mysql_fetch_array($result_guide);
				$guide_name   = $row_guide['guide_name'];

				$sql_skipper    = "SELECT `skipper_name` FROM `skipper` WHERE `skipper_id` = '$skipper_id'";
				$result_skipper = mysql_query($sql_skipper);
				$row_skipper    = mysql_fetch_array($result_skipper);
				$skipper_name   = $row_skipper['skipper_name'];

				$information_arr[$departure['departure_tour_id']][$departure['departure_id']]['skipper']         = $skipper_name;
				$information_arr[$departure['departure_tour_id']][$departure['departure_id']]['guide']           = $guide_name;
				$information_arr[$departure['departure_tour_id']][$departure['departure_id']]['skipper_tour_id'] = $skip_guide_id;


			}
			else
			{
				$information_arr[$departure['departure_tour_id']][$departure['departure_id']]['skipper'] = '';
				$information_arr[$departure['departure_tour_id']][$departure['departure_id']]['guide'] = '';
			}
				
			//////////////////////////
			$profiler->start_block("subpage_booking_departuresloop_".$loop."_orderquery");
			//////////////////////////
			$query = "SELECT * FROM $db->order
			WHERE order_departure_id = '".$departure['departure_id']."'";
			$orders = array();
			$result = $db->query($query);
			while ($res=mysql_fetch_array($result)) {
				$orders[] = $res;
			}
			//////////////////////////
			$profiler->start_block("subpage_booking_departuresloop_".$loop."_orderquery");
			//////////////////////////

			$total_blocked = 0;
			$total = 0;
			$total_price = 0.00;
			foreach($orders as $order){
				if($order['order_tickets']!='0'){
					$total_blocked += $order['order_tickets_number'];
					$total += $order['order_tickets_number'];
				} else {
					$total_blocked += $departure['boat_passengers'];
					$total += $departure['boat_passengers'];
				}
				$total_price += $order['order_total'];
			}

			$departures[$key]['orders'] 			= $orders;
			$departures[$key]['reserved'] 			= $total;
			$departures[$key]['blocked'] 			= $total_blocked;
			$departures[$key]['total_price'] 		= sprintf("%0.2f",$total_price);
			if($total_Current > $total)
			{
				$departures[$key]['current_booking'] 	= $total_Current - $total;
			}
			else
			{
				$departures[$key]['current_booking'] 	= 0;
			}

			//////////////////////////
			$profiler->stop_block("subpage_booking_departuresloop_".$loop);
			//////////////////////////
			$loop++;
		}

		//////////////////////////
		$profiler->start_block("subpage_booking_smarty");
		//////////////////////////

		$count = count($departures);
		$smarty->assign("information_arr",$information_arr); //"
		$smarty->assign("departures",$departures); //"
		$smarty->assign("counter",$count); //"

		$colours = array("#ffffff", "#d7eeff", "#c5f2c5", "#e9dff7", "#e8f5ca", "#f1dbac", "#FFCCCC");
		$tor_names = array();
		$tour_colours = array();
		foreach ($tours as $k=>$tour) {
			$tour_names[$tour['tour_id']] = $tour['tour_home_name1'];
			$tour_colours[$tour['tour_id']] = $colours[$k];
		}

		$smarty->assign("tour_names",$tour_names);
		$smarty->assign("tour_colours",$tour_colours);
		$smarty->assign("select_date",$selected_date);
		$smarty->assign("pages_dir","booking");
		$smarty->assign("page","calendar");
		$smarty->assign("subpage","_bookings");
		$smarty->display('cms_pages.tpl');


		//////////////////////////
		$profiler->stop_block("subpage_booking_smarty");
		//////////////////////////

		//////////////////////////
		$profiler->stop_block("subpage_booking");
		//////////////////////////

		break;

	case "departures":

		//////////////////////////
		$profiler->start_block("subpage_departures");
		//////////////////////////

		$selected_date = @$_GET['day'];
		if(empty($selected_date)) {
			header("Location: calendar.php");
			exit();
		}
		//delete
		if(@$_GET['option'] == "delete" && !empty($_GET['id'])){
			if (!$db->exist_value($db->order,'order_departure_id',$_GET['id'])){
				if($db->delete_field($db->departure, "departure_id", $_GET['id'])){
					$smarty->assign("message", DEPARTURE_DELETE_OK);
				} else {
					$smarty->assign("message", DEPARTURE_DELETE_WRONG);
				}
			} else {
				$smarty->assign("message", DEPARTURE_DELETE_EXIST);
			}
		}
		$query = "SELECT * FROM $db->boat WHERE 1 AND boat_tour_id = ".$tour_id." AND boat_del = 0";
		$boats = $db->select_field_keyval($db->boat, $query, "boat_id", "boat_name", "boat_name");
		$smarty->assign("boats",$boats);
		//add/edit
		if(@$_GET['option'] == "edit"){
			if(!empty($_GET['id']) && is_numeric($_GET['id'])){
				$departure = $db->select_fields($db->departure, "", "", "departure_id", $_GET['id'], "", "", "", 1);
				$departure['departure_time'] = strtotime($departure['departure_time']);
				$smarty->assign("departure",$departure);
			}
		}
		//add edit delete
		if(!empty($_POST['departure_boat_id'])){
			unset ($_POST['filter']);
			$_POST['departure_time'] = $_POST['butHour'].":".$_POST['butMinute'];
			if(!empty($_POST['but_departure_id'])){
				//edit
				if($db->edit_field($db->departure, $_POST, "departure_id", $_POST['but_departure_id'])){
					$smarty->assign("message", DEPARTURE_EDIT_OK);
				} else {
					$smarty->assign("message", DEPARTURE_EDIT_WRONG);
				}

			} else {
				//add
				if($db->insert_field($db->departure, $_POST)){
					$smarty->assign("message", DEPARTURE_ADD_OK);
				} else {
					$smarty->assign("message", DEPARTURE_ADD_WRONG);
				}
			}

		}

		//extract departures
		$query = "SELECT * FROM
		$db->departure, $db->boat
		WHERE 1
		AND departure_boat_id = boat_id
		AND departure_date = '".$selected_date."'
		AND boat_del = 0
		AND departure_tour_id = ".$tour_id."
		ORDER BY departure_time";
		$fields = array("departure_id", "departure_tour_id","departure_boat_id", "departure_date", "departure_time", "boat_name");
		$departures = $db->select_fields($db->boat, $query, $fields);

		$smarty->assign("departures",$departures);
		$smarty->assign("tours",$tours);
		$smarty->assign("tour_id",$tour_id);
		$smarty->assign("tour_name",$tour_name[0]);

		$smarty->assign("pages_dir","booking");
		$smarty->assign("page","calendar");
		$smarty->assign("subpage","_departures");
		$smarty->display('cms_pages.tpl');
		break;

		//////////////////////////
		$profiler->stop_block("subpage_departures");
		//////////////////////////

	default:

		//////////////////////////
		$profiler->start_block("subpage_calendar");
		//////////////////////////

		//////////////////////////
		$profiler->start_block("subpage_calendar_generatingdata");
		//////////////////////////
		
		//gasesc luna curenta
		//		$previous_month = date("F Y", strtotime(($month-1)." months"));
		//		$current_month = date("F Y", strtotime($month." months"));
		//		$next_month = date("F Y", strtotime(($month+1)." months"));


		$previous_month = date("F Y", mktime(0,0,0, date("m") + $month -1, 1, date("Y")));
		$current_month = date("F Y", mktime(0,0,0, date("m") + $month, 1, date("Y")));
		$next_month = date("F Y", mktime(0,0,0, date("m") + $month + 1, 1, date("Y")));

		$select_monthes = array(
				$month - 6 => date("F Y", mktime(0,0,0, date("m") + $month - 6, 1, date("Y"))),
				$month - 5 => date("F Y", mktime(0,0,0, date("m") + $month - 5, 1, date("Y"))),
				$month - 4 => date("F Y", mktime(0,0,0, date("m") + $month - 4, 1, date("Y"))),
				$month - 3 => date("F Y", mktime(0,0,0, date("m") + $month - 3, 1, date("Y"))),
				$month - 2 => date("F Y", mktime(0,0,0, date("m") + $month - 2, 1, date("Y"))),
				$month - 1 => date("F Y", mktime(0,0,0, date("m") + $month - 1, 1, date("Y"))),
				$month  => date("F Y", mktime(0,0,0, date("m") + $month, 1, date("Y"))),
				$month + 1 => date("F Y", mktime(0,0,0, date("m") + $month + 1, 1, date("Y"))),
				$month + 2 => date("F Y", mktime(0,0,0, date("m") + $month + 2, 1, date("Y"))),
				$month + 3 => date("F Y", mktime(0,0,0, date("m") + $month + 3, 1, date("Y"))),
				$month + 4 => date("F Y", mktime(0,0,0, date("m") + $month + 4, 1, date("Y"))),
				$month + 5 => date("F Y", mktime(0,0,0, date("m") + $month + 5, 1, date("Y"))),
				$month + 6 => date("F Y", mktime(0,0,0, date("m") + $month + 6, 1, date("Y")))
		);
		//		print_r($select_monthes);
		//current date
		$date = date("Y-m-d");

		$nr_cur_month = date("m", mktime(0,0,0, date("m") + $month, 1, date("Y")));
		$nr_cur_year = date("Y", mktime(0,0,0, date("m") + $month, 1, date("Y")));
		$nr_days_of_month = date("t", mktime(0,0,0, date("m") + $month, 1, date("Y"))); // numarul de zile din luna selectata
		$nr_day_of_week = date("w",mktime(0,0,0, date("m") + $month, 1, date("Y"))); // numarul zilei din saptamana ptr prima zi din luna

		//construiesc vectorul
		for($i=1;$i<=($nr_days_of_month+$nr_day_of_week);$i++) {
			// se construieste numarul zilei :
			if(($nr_day_of_week)>=$i) {
				$nr_day = 0;
			} else {
				$nr_day = $i - $nr_day_of_week;
				if(strlen($nr_day)==1)
					$nr_day = "0".$nr_day;
			}
			$days[$i-1]['number'] = $nr_day;
				
			// se construieste link-ul ptr ziua respectiva :
			$day_date = $nr_cur_year.'-'.$nr_cur_month.'-'.$nr_day;
			//extract departures
			$query = "SELECT * FROM
			$db->departure, $db->boat
			WHERE departure_boat_id = boat_id
			AND departure_date = '".$day_date."'
			ORDER BY departure_time";
			$fields = array("departure_id", "departure_boat_id", "departure_date", "departure_time", "boat_name");
			$departures = $db->select_fields($db->boat, $query, $fields);
			if (count($departures)>0){
				$days[$i-1]['bookings'] = 1;
			} else {
				$days[$i-1]['bookings'] = 0;
			}
		}
		//END construirea vectorului

		//////////////////////////
		$profiler->stop_block("subpage_calendar_generatingdata");
		//////////////////////////

		//////////////////////////
		$profiler->start_block("subpage_calendar_smarty");
		//////////////////////////

		//asignare variabile pentru luni
		$smarty->assign("select_monthes",$select_monthes);
		$smarty->assign("previous_month",$previous_month);
		$smarty->assign("current_month",$current_month);
		$smarty->assign("next_month",$next_month);
		$smarty->assign("month",$month);
		$smarty->assign("tour_id",$tour_id);
		$smarty->assign("tour_name",$tour_name[0]);
		$smarty->assign("tours",$tours);

		$smarty->assign("YMmonth",$current_month = date("Y-m", mktime(0,0,0, date("m") + $month, 1, date("Y"))));
		$smarty->assign("YMDmonth",$current_month = date("Y-m-d"));

		//trimit o variabila ajutatoare pentru loop
		$smarty->assign("week_loop",array(0,1,2,3,4,5,6));

		//trimit vectorul cu calendarul
		$smarty->assign("days",$days);

		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","booking");
		$smarty->assign("page","calendar");
		$smarty->display('cms_pages.tpl');

		//////////////////////////
		$profiler->stop_block("subpage_calendar_smarty");
		//////////////////////////

		//////////////////////////
		$profiler->stop_block("subpage_calendar");
		//////////////////////////
}

$profiler->end();

?>
