<?php
// includere smarty :
include "check_session.php";

$id_page = 7;
$content = $db->select_fields($db->page, "", "", "page_id", $id_page , "", "", "",1 );
$smarty->assign("content",$content);

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","pages");
$smarty->assign("page","contact");
$smarty->display('site_pages.tpl');
?>