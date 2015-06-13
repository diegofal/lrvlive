<?
// includere smarty :
// includere smarty :
include "check_login.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;


//*******resellers********//
//delete
if (@$_GET['option'] == 'delete' && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$db->edit_field($db->resellers, array("reseller_del"=>1), "reseller_id", $_GET['id'] );
	header("Location: resellers.php");
	exit();
}

//edit
if (@$_GET['option'] == 'edit' && !empty($_GET['id']) && is_numeric($_GET['id'])) {
	
	$reseller_id = $_GET['id'];
	
	if(!empty($_POST)) {
	
		$db->edit_field($db->resellers, array("reseller_name"=>$_POST['reseller_name']), "reseller_id", $reseller_id );
		$db->delete_field($db->reseller_tickets, "reseller_id", $reseller_id);
		$db->delete_field($db->reseller_cmns, "reseller_id", $reseller_id);
		
		while (list($key,$value) = each($_POST)) {
			$a=explode('_', $key);
			if ($a[1]=='commission') {
				$cmns[$a[2]]=$value;
			} elseif ($a[1]=='ticket') {
				if (!empty($value)) {
					// echo ("<PRE>");
					// echo("1");
					// echo ("</PRE>");
					$db->insert_field($db->reseller_tickets, array("reseller_id"=> $reseller_id, "ticket_id"=>$a[2], "ticket_price"=>$value));					
				}
			}
		}
		
		reset($_POST);		
		while (list($key,$value) = each($_POST)) {
			$a=explode('_', $key);
			if ($a[1]=='charter') {
				if (!empty($value) and !empty($cmns[$a[2]])) {
					$db->insert_field($db->reseller_cmns, array("reseller_id"=> $reseller_id, "reseller_tour_id"=>$a[2], "reseller_cmn"=>$cmns[$a[2]], "reseller_charter"=>$value));					
				} elseif (empty($value) and empty($cmns[$a[2]])) {
					//break;
				} elseif (empty($value) and !empty($cmns[$a[2]])) {
					$db->insert_field($db->reseller_cmns, array("reseller_id"=> $reseller_id, "reseller_tour_id"=>$a[2], "reseller_cmn"=>$cmns[$a[2]]));					
				} elseif (!empty($value) and empty($cmns[$a[2]])) {
					$db->insert_field($db->reseller_cmns, array("reseller_id"=> $reseller_id, "reseller_tour_id"=>$a[2], "reseller_charter"=>$value));					
				}
			}
		}
		
		header("Location: resellers.php");
		exit();
	}
	
	$reseller = $db->select_fields($db->resellers,"","","reseller_id",$_GET['id'], "", "", "", 1);
	$smarty->assign("reseller",$reseller);
	
	$query = "SELECT * FROM $db->reseller_tickets WHERE 1 AND reseller_id=". $_GET['id'] ;
	$reseller_tickets = $db->select_fields($db->reseller_tickets, $query);
	$smarty->assign("reseller_tickets",$reseller_tickets);
	
	$query = "SELECT * FROM $db->reseller_cmns WHERE 1 AND reseller_id=". $_GET['id'] ;
	$reseller_cmns = $db->select_fields($db->reseller_cmns, $query);
	$smarty->assign("reseller_cmns", $reseller_cmns);
}
else if(!empty($_POST)){
		$check = $db->select_fields($db->resellers,"","","reseller_name",$_POST['reseller_name'], "", "", "", 1);
		if (!empty($check[reseller_name])) {
			header("Location: resellers.php?error=name&name=$check[reseller_name]&del=$check[reseller_del]");
			exit;
		}
		$db->insert_field($db->resellers, array("reseller_name"=>$_POST['reseller_name']));
		$check = $db->select_fields($db->resellers,"","","reseller_name",$_POST['reseller_name'], "", "", "", 1);
		
		while (list($key,$value) = each($_POST)) {
			$a=explode('_', $key);
			if ($a[1]=='commission') {
				$cmns[$a[2]]=$value;
			}
			elseif ($a[1]=='ticket') {
				if (!empty($value)) {
				$db->insert_field($db->reseller_tickets, array("reseller_id"=> $check['reseller_id'], "ticket_id"=>$a[2], "ticket_price"=>$value));
				}
			}
		}
		reset($_POST);
		while (list($key,$value) = each($_POST)) {
			$a=explode('_', $key);
			if ($a[1]=='charter') {
				if (!empty($value) and !empty($cmns[$a[2]])) {
				$db->insert_field($db->reseller_cmns, array("reseller_id"=> $check['reseller_id'], "reseller_tour_id"=>$a[2], "reseller_cmn"=>$cmns[$a[2]], "reseller_charter"=>$value));
				}
				elseif (empty($value) and empty($cmns[$a[2]])) {
					break;
				}
				elseif (empty($value) and !empty($cmns[$a[2]])) {
				$db->insert_field($db->reseller_cmns, array("reseller_id"=> $check['reseller_id'], "reseller_tour_id"=>$a[2], "reseller_cmn"=>$cmns[$a[2]]));	
				}
				elseif (!empty($value) and empty($cmns[$a[2]])) {
				$db->insert_field($db->reseller_cmns, array("reseller_id"=> $check['reseller_id'], "reseller_tour_id"=>$a[2], "reseller_charter"=>$value));	
				}
			}
		}
		
		header("Location: resellers.php");
		exit();
}

//main query
$query = "SELECT * FROM $db->resellers WHERE 1 AND reseller_del = 0 ORDER BY reseller_name ASC";
$resellers = $db->select_fields ($db->resellers, $query, "", "reseller_name");

//******toors********/


//*******toors********//
//tour_id
$query = "SELECT tour_id FROM `".$db->tour."` WHERE 1 AND tour_del = 0";
$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);

//tours
$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0";
$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

//tickets
$query = "SELECT * FROM $db->ticket WHERE 1 AND ticket_del = 0";
$tickets = $db->select_fields($db->ticket,$query,"","ticket_del","0");
//******/toors********//


//******assigns*******//
$smarty->assign("resellers",$resellers);
$smarty->assign("tickets",$tickets);
$smarty->assign("tours",$tours);


// fg
$smarty->assign("pages_dir","settings");
$smarty->assign("page","resellers");
$smarty->display('cms_pages.tpl');
?>