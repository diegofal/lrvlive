<?
$id_page = 22;

include "gen_editor.php";

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("menu_cms_pages",$menu_cms_pages);
$smarty->assign("pages_dir","editor");
$smarty->assign("page","media_center");
$smarty->display('cms_pages.tpl');
?>