<?
// includere smarty :
// includere smarty :
include "check_login.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;



//$query   = "SELECT * FROM $db->skipper WHERE skipper_del = 1";
//$skipper = $db->select_fields ($db->skipper,$query, array("skipper_id","skipper_name"));


//delete ticket
if (@$_GET['option'] == 'delete' && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$db->delete_field($db->skipper, "skipper_id", $_GET['id'] );
	header("Location: skipper.php");
	exit();
}

//edit
if (@$_GET['option'] == 'edit' && !empty($_GET['id']) && is_numeric($_GET['id']))
{
	if(!empty($_POST))
	{
		$db->edit_field($db->skipper, $_POST, "skipper_id", $_GET['id'] );
		header("Location: skipper.php");
		exit();
	}
	
	$skipper = $db->select_fields($db->skipper,"","","skipper_id",$_GET['id'], "", "", "", 0);
	$smarty->assign("skipper",$skipper);
} 
else if(!empty($_POST))
{
		$db->insert_field($db->skipper, $_POST);
		header("Location: skipper.php");
		exit();
}

//extract pages from database

//extract pages from database
 $query = "SELECT * FROM 
			$db->skipper
			WHERE skipper_del = '0'";

$skippers = $db->select_fields($db->skipper,$query,"","skipper_del","0");
$smarty->assign("skippers",$skippers);
$smarty->assign("skipper_id",$skipper_id);


// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","settings");
$smarty->assign("page","skipper");
$smarty->display('cms_pages.tpl');
?>