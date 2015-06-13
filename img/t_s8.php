<?php

include "check_session.php";
include "browser.php";
        $smarty->assign("results",array('status'=>'OK', 'code'=>'61dd1855ab813d7b2f8eabb4f0b6a5aa'));
        $smarty->assign("subpage","_step8");
        // asignare variabile smarty si generare fisier smarty :
        $smarty->assign("pages_dir","pages");
        $smarty->assign("page","booking");
        $smarty->display('site_pages.tpl');     
exit();
