<?
// includere smarty :
include "check_session.php";

$id_page = 8;
$content = $db->select_fields($db->page, "", "", "page_id", $id_page , "", "", "",1 );
$smarty->assign("content",$content);

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","pages");
$smarty->assign("page","terms");
$smarty->display('pages/page_terms.tpl');
?>