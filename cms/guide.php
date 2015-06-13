<?
// includere smarty :
// includere smarty :
include "check_login.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;




//delete ticket
if (@$_GET['option'] == 'delete' && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$db->delete_field($db->guide, "guide_id", $_GET['id'] );
	header("Location: guide.php");
	exit();
}

//edit
if (@$_GET['option'] == 'edit' && !empty($_GET['id']) && is_numeric($_GET['id']))
{
	if(!empty($_POST))
	{
		$db->edit_field($db->guide, $_POST, "guide_id", $_GET['id'] );
		header("Location: guide.php");
		exit();
	}
	
	$guide = $db->select_fields($db->guide,"","","guide_id",$_GET['id'], "", "", "", 0);
	$smarty->assign("guide",$guide);
} 
else if(!empty($_POST))
{
		$db->insert_field($db->guide, $_POST);
		header("Location: guide.php");
		exit();
}

//extract pages from database

//extract pages from database
 $query = "SELECT * FROM 
			$db->guide
			WHERE guide_del = '0'";

$guides = $db->select_fields($db->guide,$query,"","guide_del","0");
$smarty->assign("guides",$guides);
$smarty->assign("guide_id",$guide_id);


// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","settings");
$smarty->assign("page","guide");
$smarty->display('cms_pages.tpl');
?>