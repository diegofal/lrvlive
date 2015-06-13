<?
// includere smarty :
include "check_login.php";

$filter = array("protx", "streamline", "cash", "cheque");
$smarty->assign("filter",$filter);

//resellers
$query = "SELECT * FROM $db->resellers WHERE 1 AND reseller_del = 0";
$resellers = $db->select_fields ($db->resellers, $query);
$smarty->assign("resellers",$resellers);

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","booking");
$smarty->assign("page","excel");
$smarty->display('cms_pages.tpl');

?>