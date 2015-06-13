
<?php

/*
 * SEND EMAIL CONFIRMATIONS 
 * This file is executed with a cronjob every 0.5 minutes.
 * "* * * * * /usr/bin/wget -O - http://www.londonribvoyages.com/services/send_emails.php?asd&p=123456"
 */

$out = "";
	
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
	
	//echo "Start-";

	Mail_Queue::put(
			"TEST",
			"TEST",
			"fcisco@gmail.com",
			"Mail de prueba",
			"PRUEBA " + time(),
			0,
			"bookings@londonribvoyages.com");

	$out .= "Start sending emails- ".date("c")."\n";
	
	$count = Mail_Queue::sendMailsInQueue();
	
	$out .= "Emails were sent (".$count.")\n";
	$out .= "End\n";
	
	//echo "end-";


echo "<pre>".$out."</pre>";
