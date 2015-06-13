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


//delete boat
if (@$_GET['option'] == 'delete' && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$db->edit_field($db->boat, array("boat_del"=>1), "boat_id", $_GET['id'] );
	header("Location: boats.php");
	exit();
}

//edit
if (@$_GET['option'] == 'edit' && !empty($_GET['id']) && is_numeric($_GET['id'])){
	if(!empty($_POST)){
		//print_r($_POST);
		$values = array ("boat_tour_id"=>$_POST['boat_tour_id'], 
			"boat_name"=>$_POST['boat_name'], 
			"boat_passengers"=>$_POST['boat_passengers']);
		if (isset($_POST['boat_del']))
			$values['boat_del'] = 0;
		else 
			$values['boat_del'] = 1;
	
		//print_r($values);

		$db->edit_field($db->boat, $values, "boat_id", $_GET['id'] );

		header("Location: boats.php?tour_id=".$tour_id."");
		exit();
	}
	$boat = $db->select_fields($db->boat,"","","boat_id",$_GET['id'], "", "", "", 1);
	$smarty->assign("boat",$boat);
} else if(!empty($_POST)){
		$db->insert_field($db->boat, $_POST);
		header("Location: boats.php?tour_id=".$tour_id."");
		exit();
}

//extract pages from database
$query = "SELECT * FROM 
			$db->boat
			WHERE 1 
			AND boat_tour_id = ".$tour_id."
			ORDER BY boat_del ASC
			";
$boats = $db->select_fields($db->boat,$query,"","boat_del","0");
$smarty->assign("boats",$boats);

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","settings");
$smarty->assign("page","boats");
$smarty->assign("tour_id",$tour_id);
$smarty->assign("tour_name",$tour_name[0]);
$smarty->assign("tours",$tours);

$smarty->display('cms_pages.tpl');
?>