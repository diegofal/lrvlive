<?
// includere smarty :
require_once "check_login.php";
require_once "../WEB-INF/includes/functions/functions_log.php";
require_once "../WEB-INF/includes/functions/functions_order.php";
require_once "../WEB-INF/includes/classes/mail_queue.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

$results = array();

if (!empty($_POST['mail']) and strlen($_POST['mail'])) {
	$results = Mail_Queue::getMailsByRecipients($_POST['mail']);
} else if (!empty($_POST['parent_id']) and strlen($_POST['parent_id'])) {
	$results = Mail_Queue::getMailsByParentId($_POST['parent_id']);
}

if (count($results) > 0) {		
	$smarty->assign("rows",count($results));
	$smarty->assign("results",$results);
} else {
	$smarty->assign("message","No orders were found.");
}

$smarty->assign("pages_dir","booking");
$smarty->assign("page","email_queue");

$smarty->display('cms_pages.tpl');
?>