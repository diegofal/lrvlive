<?
// pornire sesiune :
require_once "check_login.php";

// includere smarty :
include "../WEB-INF/includes/smarty/smarty_cms.php";

// stabilirea variabilelor :
$db->set_var($subpage, "subpage", "change");

if($subpage=="change") {
	// setare variabile :
	$page_title = $menu_cms['config'][$subpage];
	$page_include = "change";
	$navigate_vars = array("subpage"=>$subpage);
	
	if($_SERVER['REQUEST_METHOD']=="POST") {
		if($db->get_num_rows($db->config, "", "config_admin_user='".$_SESSION['sess_username']."' AND  config_admin_pass='".md5($_POST['user_old_pass'])."'")==1) {
			$array_data_prel['config_admin_pass'] = md5($_POST['config_admin_pass']);
			$array_exceptions = array("user_old_pass","config_admin_pass_re");
			$change = $db->edit_field($db->config, $_POST, "", "", $array_data_prel, $array_exceptions, "config_admin_user='".$_SESSION['sess_username']."' AND  config_admin_pass='".md5($_POST['user_old_pass'])."'");
			if($change==1) {
				header("Location: ".$db->generate_url("", "config.php", $navigate_vars, "", "", "", "", "", 1)."&message=1&change=1");
				exit();
			}
		} else {
			header("Location: ".$db->generate_url("", "config.php", $navigate_vars, "", "", "", "", "", 1)."&message=1&change=2");
			exit();
		}
	}
}

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("menu",$menu_cms);
$smarty->assign("submenu",$menu_cms['config']);
$smarty->assign("pages_dir","config");
$smarty->assign("page","config_".@$page_include);
$smarty->assign("subpage",$subpage);
$smarty->assign("page_title",@$page_title);
$smarty->assign("link_title",@$link_title);
$smarty->display('cms_pages.tpl');
?>