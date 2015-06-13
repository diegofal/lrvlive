<?
// includere smarty :
// includere smarty :
include "check_login.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;



//$query   = "SELECT * FROM $db->skipper WHERE skipper_del = 1";
//$skipper = $db->select_fields ($db->skipper,$query, array("Hid","skipper_name"));


//delete ticket
if (@$_GET['option'] == 'delete' && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$db->delete_field($db->tbl_hear_about_us, "Hid", $_GET['id'] );
	header("Location: hear_aboutus.php");
	exit();
}

//edit
if (@$_GET['option'] == 'edit' && !empty($_GET['id']) && is_numeric($_GET['id']))
{
	if(!empty($_POST))
	{
		$db->edit_field($db->tbl_hear_about_us, $_POST, "Hid", $_GET['id'] );
		header("Location: hear_aboutus.php");
		exit();
	}
	
	$tbl_hear_about_us = $db->select_fields($db->tbl_hear_about_us,"","","Hid",$_GET['id'], "", "", "", 0);
	$smarty->assign("tbl_hear_about_us",$tbl_hear_about_us);
} 
else if(!empty($_POST))
{
		$db->insert_field($db->tbl_hear_about_us, $_POST);
		header("Location: hear_aboutus.php");
		exit();
}

//extract pages from database

//extract pages from database
 $query = "SELECT * FROM 
			$db->tbl_hear_about_us
			WHERE Status = '1'";

$tbl_hear_about_us = $db->select_fields($db->tbl_hear_about_us,$query,"","Status","1");
$smarty->assign("tbl_hear_about_us",$tbl_hear_about_us);
$smarty->assign("Hid",$Hid);


// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","editor");
$smarty->assign("page","hear_aboutus");
$smarty->display('cms_pages.tpl');
?>