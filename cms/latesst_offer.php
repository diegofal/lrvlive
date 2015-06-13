<?
$id_page = 10;

include "gen_editor.php";

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","editor");
$smarty->assign("page","latesst_offer");
$smarty->display('cms_pages.tpl');
?>