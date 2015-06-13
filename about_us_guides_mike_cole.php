<?php
error_reporting(E_ALL);
// includere smarty :
include "check_session.php";

$id_page = 29;
$content = $db->select_fields($db->page, "", "", "page_id", $id_page , "", "", "",1 );
$smarty->assign("content",$content);

$smarty->assign("pages_dir","pages");
$smarty->assign("page","about_us_guides_tom");
$smarty->display('site_pages.tpl');
?>
<!--
<p><img alt="" hspace="10" align="left" width="198" height="205" src="images/MikeCole.jpg" /></p>
<h1 class="ab_text_1">Mike Cole aka &quot;Ginger Face&quot;</h1>
<div class="txt"><span style="font-size: 13px">Mike's professional career began as a regular in the Channel Five soap 'Family Affairs' spending two years as Jamie Hart. Following TV jobs for the BBC&nbsp;he attended Guildford School of Acting and since graduating in 2007 has&nbsp;enjoyed a busy spell of theatre work.</span></div>

<div class="txt">&nbsp;</div>
<div class="txt">By day you will sometimes&nbsp;find Mike giving a first class performance along the river Thames... Being a successful actor means you would be lucky to see Mike during the short spells he is available rather than travelling with a theatre group, however, if you do you are in for a real treat.</div>
<div class="txt">&nbsp;</div>
<div class="txt">Ginger Mike naturally entertains as we make our way through&nbsp;the city he is very passionate about sharing with you all.&nbsp; Every passenger just as important as the last.&nbsp; A true entertainer, a true gentleman.</div>
<div class="txt">&nbsp;</div>
<div class="txt">Follow Mike around the country <a href="http://www.michaelcole.org.uk/">here</a>..&nbsp;</div>

<div class="txt">&nbsp;</div>
<div class="txt">&nbsp;</div>
<div class="txt"><span style="font-size: small"><span style="color: #ff6600"><strong>&quot;My husband and I took a ride on one of your boats very recently, I have got to say it was the best experience on the river we have ever had. We've been on quite a few boat rides on the&nbsp;Thames before&nbsp;but never at such high speeds, it was&nbsp;so much fun we couldn't stop grinning and the music just added to the fun.&nbsp; Out guide&nbsp;was knowledgable and funny but also extremely interesting. Thank you so much, we will be recommending you to&nbsp;our friends and family&quot;&nbsp;</strong></span></span><span style="font-size: xx-small"><em>The Valverdes, July 2011.</em></span></div>
<div class="txt">&nbsp;</div>
<p style="text-align: center"><img alt="" style="width: 253px; height: 186px" src="http://londonribvoyages.com/WEB-INF/uploads/Image/Mike%20C%20&amp;%20London%20Eye%20(16).JPG" />&nbsp; <img alt="" style="width: 251px; height: 186px" src="http://londonribvoyages.com/WEB-INF/uploads/Image/Mike%20C%20&amp;%20London%20Eye%20(8).JPG" /></p>
-->
