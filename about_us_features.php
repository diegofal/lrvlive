<?php
error_reporting(E_ALL);
// includere smarty :
include "check_session.php";
$smarty->assign("pages_dir","pages");
$smarty->assign("page","about_us_features");
$smarty->display('site_pages.tpl');
?>
