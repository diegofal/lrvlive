<?php
include "check_session.php";
$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_home_name1", "tour_home_name2", "tour_duration", "tour_home_image", "tour_charter_price"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="jquery-1.2.2.pack.js"></script>
<link rel="stylesheet" type="text/css" href="featuredcontentglider.css" />
<script type="text/javascript" src="featuredcontentglider.js">

/***********************************************
* Featured Content Glider script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* This notice must stay intact for legal use
***********************************************/

</script>
<script type="text/javascript">

featuredcontentglider.init({
	gliderid: "canadaprovinces", //ID of main glider container
	contentclass: "glidecontent", //Shared CSS class name of each glider content
	togglerid: "p-select", //ID of toggler container
	remotecontent: "", //Get gliding contents from external file on server? "filename" or "" to disable
	selected: 0, //Default selected content index (0=1st)
	persiststate: false, //Remember last content shown within browser session (true/false)?
	speed: 1200, //Glide animation duration (in milliseconds)
	direction: "rightleft", //set direction of glide: "updown", "downup", "leftright", or "rightleft"
	autorotate: true, //Auto rotate contents (true/false)?
	autorotateconfig: [3000, 2] //if auto rotate enabled, set [milliseconds_btw_rotations, cycles_before_stopping]
})

</script>
</head>
<body>
<div id="canadaprovinces" class="glidecontentwrapper">
<?php
	foreach($tours as $Tindex=>$Tvalue)
	{
?>
<div class="glidecontent">
<img src="img/tours/thumb/<?=$Tvalue['tour_home_image']?>" style="float: left; padding: 5px" /><?=$Tvalue['tour_home_name2']?></div>
<?php
 }
?>

<!--<div class="glidecontent">
<img src="http://i15.tinypic.com/72vilba.jpg" style="float: right; padding: 5px"/>
Ontario is a province located in the central part of Canada, the largest by population and second largest, after Quebec in total area. Toronto, the capital of Ontario, is the centre of Canada's financial services and banking industry.
</div>

<div class="glidecontent">
<img src="http://i17.tinypic.com/8bg0lkx.jpg" style="float: left; padding: 5px"/>
Yukon, still commonly referred to as "The Yukon Territory", is the westernmost of Canada's three northern territories. The Yukon's major appeal is its nearly pristine nature. Tourism relies heavily on this and there are many organised outfitters and guides available to hunters and anglers and nature lovers of all sorts.
</div>-->

</div>

<div id="p-select" class="glidecontenttoggler">
<a href="#" class="prev">Prev</a> 
<a href="#" class="toc">Page 1</a> <a href="#" class="toc">Page 2</a> <a href="#" class="toc">Page 3</a>
<a href="#" class="next">Next</a>
</div>
</body>
</html>
