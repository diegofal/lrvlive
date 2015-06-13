<?php
// includere smarty :
include "check_login.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;

if($_REQUEST['command']=="add_skipper")
{
   $tid   		= $_REQUEST['tourid'];
   $depid 		= $_REQUEST['depid'];
   $sid   		= $_REQUEST['skip_id'];
   $cdate       = $_REQUEST['curent_date'];
      
   $sql_check   = "SELECT sgid,sk_tour_id,sk_depid FROM `skipper_guide_entry` 
                   WHERE sk_tour_id = '$tid' AND sk_depid = '$depid'"; 
   $res_check   = mysql_query($sql_check);
   $num_check   = mysql_num_rows($res_check);				   
   $row_check   = mysql_fetch_array($res_check);
   $sg_id       = $row_check['sgid']; 
   
   if($num_check > 0)
   {
       $sql_update  = "UPDATE `skipper_guide_entry` SET `sk_tour_id` = '$tid' , 
					   `sk_depid` = '$depid' , `skipper_id` = '$sid' WHERE sgid = '$sg_id'"; 
	   $res_update  = mysql_query($sql_update);
	   echo "<script>
	   function valid_g1() 
	   { 
	   window.opener.document.frmChildWindow; 
	   window.opener.location.href = 'calendar.php?subpage=bookings&day=".$cdate."'; 
	   window.self.close(); 
	   } 
	   valid_g1();
	   </script>";	
   
   }
   else
   {
	   $sql_insert  = "INSERT INTO `skipper_guide_entry` SET `sk_tour_id` = '$tid' , 
					   `sk_depid` = '$depid' , `skipper_id` = '$sid'";
	   $res_insert  = mysql_query($sql_insert);
	   echo "<script>
	   function valid_g2() 
	   { 
	   window.opener.document.frmChildWindow; 
	   window.opener.location.href = 'calendar.php?subpage=bookings&day=".$cdate."'; 
	   window.self.close(); 
	   } 
	   valid_g2();
	   </script>";	
   }			       
}

 $tour_id = $_REQUEST['tour_id'];
 $dep_id  = $_REQUEST['dep_id'];
 $query   = "SELECT * FROM 
			$db->skipper
			WHERE skipper_del = '0'";

$skippers = $db->select_fields($db->skipper,$query,"","skipper_del","0");
$count    = count($skippers);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
a:link{
     font-family: Tahoma, Arial, Helvetica;
	 font-size: 11px;
	 color: #333333;
	 line-height: 16px;
	 text-decoration:none; 
	
}
a:visited { 
    font-family: Tahoma, Arial, Helvetica;
	font-size: 11px;
	color: #FF0000;
	line-height: 16px;
	text-decoration:none; 
	 
} 
a:hover { 
    font-family: Tahoma, Arial, Helvetica;
	font-size: 11px;
	color: #00366C;
	line-height: 16px;
	text-decoration:none;

}
a:active { 
    font-family: Tahoma, Arial, Helvetica;
	font-size: 11px;
	color: yellow;
	line-height: 16px;
	text-decoration:none;
}
.text_head {
font-family:Verdana, Arial, Helvetica, sans-serif; 
font-size:14px; 
color:#000000; 
font-weight:bold;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bookings</title>
</head>

<body>
<form id="cal_form" name="cal_form" method="post" action="#">
<table width="40%" border="0" cellpadding="5px" cellspacing="0" style="padding-left:20px;">
  <tr>
    <td height="29" align="left" valign="top" class="text_head">Skippers</td>
  </tr>
  <?php
     for($i = 0; $i < $count ; $i++)
	  {
  ?>
  <tr>
  <td align="left" valign="top"><a href="skipper_detail.php?tourid=<?=$tour_id?>&depid=<?=$dep_id?>&skip_id=<?=$skippers[$i]['skipper_id']?>&curent_date=<?=$_REQUEST['cur_date']?>&command=add_skipper"><?=$skippers[$i]['skipper_name']?></a></td>
  </tr>
  <?php
     }
  ?>
</table>
</form>
</body>
</html>
