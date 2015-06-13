<?
$id_page = 3;

include "gen_editor.php";

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","editor");
$smarty->assign("page","route");
$smarty->display('cms_pages.tpl');
?>