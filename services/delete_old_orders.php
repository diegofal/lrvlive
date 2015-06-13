<?php
/*
 * DELETE UN-FINISHED ORDERS 
 * This file is executed with a cronjob every 10 minutes.
 * "/10 * * * * /usr/bin/wget -O - http://www.londonribvoyages.com/services/delete_old_orders.php?asd&p=123456"
 */

require_once "../WEB-INF/includes/classes/class.phpmailer.php";

$out = "";
if ($_GET["p"] == "123456") {
	
	// includes
	require_once "../WEB-INF/includes/classes/class.x3.database.php";
	require_once "../WEB-INF/includes/config.php";
	require_once "../WEB-INF/includes/functions/functions_utils.php";
	
	// DB connction
	$db = new DB_config;
	$db->connect();
	
	$out .= "Start deleting orders - ".date("c")."\n";
	
	$query = "INSERT INTO orders_deleted
				SELECT CURRENT_DATE(), o.*
				FROM $db->order o
				WHERE order_payd = 0 AND order_time < ".(time()-600);
	$rows = $db->query($query);
	
	$query = "DELETE FROM $db->order WHERE order_payd = 0 AND order_time < ".(time()-600);
	$rows = $db->delete_field($db->order, "", "", $query);
	
	$out .= "Deleted from order table (".$rows.")\n";
	
	$query = "DELETE FROM $db->voucher_order WHERE voucher_order_payd = 0 AND voucher_order_time < ".(time()-600);
	$rows = $db->delete_field($db->voucher_order, "", "", $query);
	
	$out .= "Deleted from voucher table (".$rows.")\n";
	$out .= "End\n";
} else {
	$out .="invalid password";
}

//_sendmail("fcisco@gmail.com", "info@londonribvoyages.com", "CronJob execution", $out);
echo $out;