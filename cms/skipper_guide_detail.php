<?php
// includere smarty :
include "check_login.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;

if(sizeof($_POST))
{
   $tid   		= $_POST['tourid'];
   $depid 		= $_POST['depid'];
   $sid   		= $_POST['skipper'];
   $cdate       = $_POST['curent_date'];
   $guideid     = $_POST['guide'];
   
if($guideid == "")
 {
   $sql_check   = "SELECT sgid,sk_tour_id,sk_depid,guide_id FROM `skipper_guide_entry` 
                   WHERE sk_tour_id = '$tid' AND sk_depid = '$depid'"; 
   $res_check   = mysql_query($sql_check);
   $num_check   = mysql_num_rows($res_check);				   
   $row_check   = mysql_fetch_array($res_check);
   $sg_id       = $row_check['sgid']; 
   $guid        = $row_check['guide_id'];
   
   if(($num_check > 0) || ($guid != ""))
    {
      $sql_update  = "UPDATE `skipper_guide_entry` SET `sk_tour_id` = '$tid' , 
					   `sk_depid` = '$depid' , `skipper_id` = '$sid' ,`guide_id` = '0' WHERE `sgid` = '$sg_id'"; 
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
       $sql_insert  = "INSERT INTO `skipper_guide_entry` SET  `sk_tour_id` = '$tid' , 
					   `sk_depid` = '$depid' , `skipper_id` = '$sid'";  
	   //echo $sql_insert; exit();				   
	   $res_insert  = mysql_query($sql_insert);
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
 }
elseif($sid == "")
{
   $sql_check   = "SELECT sgid,sk_tour_id,sk_depid,skipper_id FROM `skipper_guide_entry` 
                   WHERE sk_tour_id = '$tid' AND sk_depid = '$depid'";  
   $res_check   = mysql_query($sql_check);
   $num_check   = mysql_num_rows($res_check);				   
   $row_check   = mysql_fetch_array($res_check);
   $sg_id       = $row_check['sgid']; 
   $skipp       = $row_check['skipper_id'];
   
   if(($num_check > 0) || ($skipp != ""))
     {
       $sql_update  = "UPDATE `skipper_guide_entry` SET `sk_tour_id` = '$tid' , 
					   `sk_depid` = '$depid' , `skipper_id` = '0' , `guide_id` = '$guideid' WHERE sgid = '$sg_id'"; 
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
	       $sql_insert  = "INSERT INTO `skipper_guide_entry` SET  `sk_tour_id` = '$tid' , 
					   `sk_depid` = '$depid' , `guide_id` = '$guideid'"; 
	       //echo $sql_insert; exit();				   
	       $res_insert  = mysql_query($sql_insert);
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
}
 elseif($guideid != "" && $sid != "")
  {
   $sql_check   = "SELECT sgid,sk_tour_id,sk_depid FROM `skipper_guide_entry` 
                   WHERE sk_tour_id = '$tid' AND sk_depid = '$depid'";  
   $res_check   = mysql_query($sql_check);
   $num_check   = mysql_num_rows($res_check);				   
   $row_check   = mysql_fetch_array($res_check);
   $sg_id       = $row_check['sgid']; 
   
   if($num_check > 0)
     {
       $sql_update  = "UPDATE `skipper_guide_entry` SET `sk_tour_id` = '$tid' , 
					   `sk_depid` = '$depid', `skipper_id` = '$sid' , `guide_id` = '$guideid' 
					   WHERE sgid = '$sg_id'"; 
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
		   $sql_insert  = "INSERT INTO `skipper_guide_entry` SET  `sk_tour_id` = '$tid' , 
					   `sk_depid` = '$depid' , `skipper_id` = '$sid', `guide_id` = '$guideid'"; 
		   //echo $sql_insert; exit();				   
		   $res_insert  = mysql_query($sql_insert);
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
    }
}
 $tour_id  = $_REQUEST['tour_id'];
 $dep_id   = $_REQUEST['dep_id'];
 
 /*select skipper-----------*/
 
 $skiper_query   =   "SELECT A.skipper_id,B.skipper_id 
	                  FROM skipper AS A INNER JOIN skipper_guide_entry AS B ON 
	           		  A.skipper_id = B.skipper_id WHERE B.sk_tour_id = '$tour_id' 
	                  AND B.sk_depid = '$dep_id'";
 $res_skipper    = mysql_query($skiper_query);
 $row_skipper    = mysql_fetch_array($res_skipper);			   
 
/*Select guide--------------*/ 

$guide_query   =   "SELECT A.guide_id,B.guide_id  
	                  FROM guide AS A INNER JOIN skipper_guide_entry AS B ON 
	           		  A.guide_id = B.guide_id WHERE B.sk_tour_id = '$tour_id' 
	                  AND B.sk_depid = '$dep_id'";
 $res_guide    = mysql_query($guide_query);
 $row_guide    = mysql_fetch_array($res_guide);			   
 
 /*END------------------*/
 
 
 $query   = "SELECT * FROM 
			$db->skipper
			WHERE skipper_del = '0'
			ORDER BY skipper_name ASC";

$skippers = $db->select_fields($db->skipper,$query,"","skipper_del","0");
$count    = count($skippers);


 $guide_query = "SELECT * FROM 
			     $db->guide
			     WHERE guide_del = '0'
				 ORDER BY guide_name ASC";

 $guides      = $db->select_fields($db->guide,$guide_query,"","guide_del","0");
 $count_guide = count($guides);
 
 
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
.td_height {height:20px;}
.td_height11 { height:90px;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bookings</title>
</head>

<body>
<form id="cal_form" name="cal_form" method="post" action="#">
<input type="hidden" name="tourid" value="<?=$tour_id?>" />
<input type="hidden" name="depid" value="<?=$dep_id?>" />
<input type="hidden" name="curent_date" value="<?=$_REQUEST['cur_date']?>" />
<input type="hidden" name="command" value="add_skipper" />
<table width="40%" border="0" cellpadding="5px" cellspacing="0" style="padding-left:20px;" align="center">
<tr><td class="td_height11">&nbsp;</td></tr>
  <tr>
    <td align="left" valign="top" class="text_head td_height">Skippers</td>
  </tr>
  <tr>
  <td align="left" valign="top"  class="td_height">
  <select name="skipper">
  <option value="">-choose skipper-</option>
   <?php 
   for($i = 0; $i < $count ; $i++)  
   {
        
   ?>
         <option value="<?=$skippers[$i]['skipper_id']?>" <?=($row_skipper['skipper_id'] == $skippers[$i]['skipper_id']?"selected":"")?>><?=$skippers[$i]['skipper_name']?></option>
   <?php } ?>
  </select> 
	</td>
	</tr>
	<tr>
	<td align="left" valign="top" class="text_head td_height">Guides</td>
	</tr>
   <tr>
  <td align="left" valign="top" class="td_height">
  <select name="guide">
  <option value="">-choose guide-</option>
   <?php for($k = 0; $k < $count_guide ; $k++) { ?>
       <option value="<?=$guides[$k]['guide_id']?>" <?=($row_guide['guide_id'] == $guides[$k]['guide_id']?"selected":"")?>><?=$guides[$k]['guide_name']?></option>
  <?php } ?>
  </select> 
  
  </td>
  </tr>
  <tr><td align="left">
  <input type="image" src="images/button-proceed-on.gif" />
  </td></tr>
  </table>
</form>
</body>
</html>
