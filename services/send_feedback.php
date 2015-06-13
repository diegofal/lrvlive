<?php

/*
 * SEND EMAIL FEEDBACK 
 * This file is executed with a cronjob every 0.5 minutes.
 * "* * * * * /usr/bin/wget -O - http://www.londonribvoyages.com/services/send_feedback.php?asd&p=123456"
 */

$out = "";
if ($_GET["p"] == "123456" && $_SERVER['REMOTE_ADDR'] == "162.13.140.19") {
//if (true) {
	
	//echo "includes-";
	// includes
	require_once "../WEB-INF/includes/classes/class.x3.database.php";
	require_once "../WEB-INF/includes/config.php";
	require_once "../WEB-INF/includes/functions/functions_utils.php";
	require_once "../WEB-INF/includes/classes/mail_queue.php";
	require_once "../WEB-INF/includes/functions/functions_log.php";	
	
	//echo "connection-";

	// DB connction
	$db = new DB_config;
	$db->connect();

	require_once "../WEB-INF/includes/functions/functions_email.php";	
	
	//echo "Start-";

	$out .= "Start sending feedback emails- ".date("c")."\n";
	
	set_time_limit(60);

	$count = Mail_Queue::sendMailsInQueueFeedback();
	
	$out .= "Emails were sent (".$count.")\n";
	$out .= "End\n";
	
	//echo "end-";

	if ($count > 0) {
		write_email_log($out);
	}
} else {
	$out .="invalid password";
}

echo "<pre>".$out."</pre>";
