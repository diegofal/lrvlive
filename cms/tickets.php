<?
// includere smarty :
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
$tour_name = $db->select_field($db->tour, "tour_name", "", $query);

//delete ticket
if (@$_GET['option'] == 'delete' && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$db->edit_field($db->ticket, array("ticket_del"=>1), "ticket_id", $_GET['id'] );
	header("Location: tickets.php");
	exit();
}

//edit
if (@$_GET['option'] == 'edit' && !empty($_GET['id']) && is_numeric($_GET['id'])){
	if(!empty($_POST)){
		if (empty($_POST['ticket_special'])) $_POST['ticket_special'] = 0;

		$fields = $_POST;
		$fields["ticket_type"] = htmlentities($fields["ticket_type"]);

		$db->edit_field($db->ticket, $fields, "ticket_id", $_GET['id'] );
		header("Location: tickets.php?tour_id=".$tour_id."");
		exit();
	}
	$ticket = $db->select_fields($db->ticket,"","","ticket_id",$_GET['id'], "", "", "", 1);
	$smarty->assign("ticket",$ticket);
} else if(!empty($_POST)){
		if (empty($_POST['ticket_special'])) $_POST['ticket_special'] = 0;
		$db->insert_field($db->ticket, $_POST);
		header("Location: tickets.php?tour_id=".$tour_id."");
		exit();
}

//extract pages from database

//extract pages from database
$query = "SELECT * FROM 
			$db->ticket
			WHERE 1 
			AND ticket_tour_id = ".$tour_id."
			AND ticket_del = 0";

$tickets = $db->select_fields($db->ticket,$query,"","ticket_del","0");
$smarty->assign("tickets",$tickets);
$smarty->assign("tour_id",$tour_id);
$smarty->assign("tour_name",$tour_name[0]);
$smarty->assign("tours",$tours);


// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","settings");
$smarty->assign("page","tickets");
$smarty->display('cms_pages.tpl');
?>