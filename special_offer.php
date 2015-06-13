<?
// includere smarty :
include "check_session.php";

$ID = trim($_GET['ID']);
if(!empty($ID))
{
	$content = $db->select_fields($db->special_offer, "", "", "OfferId", $ID , "", "", "",1 );
	$smarty->assign("content",$content);
}	

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","pages");
$smarty->assign("page","special_offer");
$smarty->display('site_pages.tpl');
?>