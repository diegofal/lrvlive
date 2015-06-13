<?
// includere smarty :
include "check_login.php";

if($_SERVER['REQUEST_METHOD']=="POST") {
		if($db->get_num_rows($db->config, "", "config_admin_user='admin' AND  config_admin_pass='".md5($_POST['old_password'])."'")==1) {
			$array_data_prel['config_admin_pass'] = md5($_POST['new_password']);
			$array_data_prel['config_admin_user'] = 'admin';
			$array_exceptions = array("user_old_pass","config_admin_pass_re");
			$change = $db->edit_field($db->config, $array_data_prel, "", "", "", "", "config_admin_user='admin' AND  config_admin_pass='".md5($_POST['old_password'])."'");
			if($change==1) {
				$smarty->assign("message","Your password was changed.");
			}
		} else {
			$smarty->assign("message","An error has occurred. Please try again.");
		}
}
	

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","settings");
$smarty->assign("page","change");
$smarty->display('cms_pages.tpl');

?>