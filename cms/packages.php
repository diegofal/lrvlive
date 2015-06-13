<?
// includere smarty :
require_once "check_login.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;

//initializez variabilele nedefinite
//$utils->set_get_var($subpage, "subpage","calendar");
//$utils->set_get_var($month, "month", 0);

//delete 
//GENII ����� ������� 㤠����� departures, boats, tickets
if (@$_GET['option'] == 'delete' && !empty($_GET['package_id']) && is_numeric($_GET['package_id'])){
	$db->edit_field($db->package, array("package_del"=>1), "package_id", $_GET['package_id'] );
	header("Location: packages.php");
	exit();
}



// setare variabile :
$utils->set_get_var($start, "start", 0);
$utils->set_get_var($order, "order", "package_id");

//view calendar
//if(!empty($_GET['mark'])){
//	$db->edit_field($db->order, array("order_used"=>1), "order_id", $_GET['mark']);
//}

$query_add = "AND package_del = 0";
//if(isset($_GET['filter']) && is_numeric($_GET['filter'])){
//	$query_add = " AND order_used ='".$_GET['filter']."'";
//}

$query = "SELECT * FROM $db->package
		  WHERE 1
		  ".$query_add ; 

$total_records = $db->get_num_rows($db->package, $query);

//generate table head
$head_fields = array("package_id"=>"Corporate Package ID","package_name"=>"Corporate Package Name");

$head = $utils->head_table_new($head_fields, "packages.php", "order", "package_id|ASC", "table-header", "table-headerUp", "table-headerDwn");
$smarty->assign("head",$head);

// generarea link-urilor de navigare :
$navigator = $utils->navigate_text($total_records, $start, PER_PAGE, "packages.php", "submenu", 5);
$smarty->assign("navigator",$navigator);

$fields = array("package_id", "package_name", "package_del");

$packages = $db->select_fields($db->package,$query, $fields, "package_del", "0", $order, $start, PER_PAGE);
$smarty->assign("packages",$packages);

			

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","booking");
$smarty->assign("page","packages");
$smarty->display('cms_pages.tpl');

?>