<?php
error_reporting(E_ALL);
// includere smarty :
include "check_session.php";

$id_page = 27;
$content = $db->select_fields($db->page, "", "", "page_id", $id_page , "", "", "",1 );
$smarty->assign("content",$content);

$smarty->assign("pages_dir","pages");
$smarty->assign("page","about_us_guides_stacey");
$smarty->display('site_pages.tpl');
?>
<!--
<p><img hspace="10" alt="" align="left" width="198" height="205" src="images/stacy.jpg" /></p>

<h1 class="all_abroad_h2">Stacey aka &quot;Squirrel&quot;</h1>

<div class="txt">Actress by trade, crazy comedian guide by day... &nbsp;</div>
<div class="txt">&nbsp;</div>
<div class="txt">Stacey joined&nbsp;the team in 2010, quickly becoming a popular member of the crew.&nbsp; Stacey has a unique character, an endearing nature and the ability to please time and time again.</div>
<div class="txt">&nbsp;</div>
<div class="txt">Quirky yet modest, adorable yet sarcastic... Stacey's stories, anecdotes and gossip&nbsp;will not only make you laugh, but leave you smiling for the rest of the day... Book in advance to ensure Stacey is your capital guide for this speedy adventure.</div>

<div class="txt">&nbsp;</div>
<div class="txt"><span style="font-size: small"><strong><span style="color: rgb(255,102,0)">&quot;Stacey was out guide&nbsp;she was a true professional, so happy and a pleasure to be around.&nbsp; The trip was made&nbsp;even better by her attention to us as her audience, slightly nutty but in a good good way!&nbsp;We&nbsp;smiled, we laughed, we enjoyed&nbsp;every second, we'll be back for more&quot; </span></strong></span><em><span style="font-size: smaller"><strong>Leigh-Anne Boyle, May 2011</strong>&nbsp;</span></em></div>

<div class="txt">&nbsp;</div>
<p style="text-align: center"><img alt="" style="width: 447px; height: 273px" src="http://londonribvoyages.com/WEB-INF/uploads/Image/squirrel.jpg" />&nbsp;</p>

-->
