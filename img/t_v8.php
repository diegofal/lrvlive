<?php

include "check_session.php";
include "browser.php";

        $smarty->assign("voucher_id",1);
        $smarty->assign("results",array('status'=>'OK', 'code'=>'70ad9536cc27b9883ac80a0f14be0813'));
        $smarty->assign("subpage","_voucher_step4");
        // asignare variabile smarty si generare fisier smarty :
        $smarty->assign("pages_dir","pages");
        $smarty->assign("page","booking");
        $smarty->display('site_pages.tpl');     
exit();
