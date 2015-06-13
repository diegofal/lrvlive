<?
// includere smarty :
include "check_login.php";

include("FCKeditor/fckeditor.php");


if (isset($_POST) && sizeof($_POST) > 0){
			$db->edit_field($db->email, $_POST);
}

//extract pages from database
$emails = $db->select_fields($db->email, "", array('order_user','order_user2','order_admin','order_modified', 'voucher_user', 'voucher_admin', 'feedback', 'thames_festival_blast'));
$smarty->assign("emails",$emails[0]);

/*$oFCKeditor = new FCKeditor('order_user') ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->ToolbarSet = 'Email';
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '400' ;
$oFCKeditor->Value = $emails[0]['order_user'];
$oFCKeditor->Config['FullPage'] = "true";
$output = $oFCKeditor->CreateHtml() ;
$smarty->assign("output",$output);*/

$oFCKeditor      			= new FCKeditor('order_user') ;
$oFCKeditor->BasePath 		='FCKeditor/';
$oFCKeditor->Value 			= stripslashes(trim($emails[0]['order_user']));
$oFCKeditor->ToolbarSet 	= 'Default';
$oFCKeditor->Width  		= '100%';//'636' ;
$oFCKeditor->Height 		= '400';
$output = $oFCKeditor->CreateHtml();
$smarty->assign("output",$output);

/*$oFCKeditor1 = new FCKeditor('order_admin') ;
$oFCKeditor1->BasePath = 'FCKeditor/';
$oFCKeditor1->ToolbarSet = 'Email';
$oFCKeditor1->Width  = '100%' ;
$oFCKeditor1->Height = '400' ;
$oFCKeditor1->Value = $emails[0]['order_admin'];
$oFCKeditor1->Config['FullPage'] = "true";
$output1 = $oFCKeditor1->CreateHtml() ;
$smarty->assign("output1",$output1);*/

$oFCKeditor1      			= new FCKeditor('order_admin') ;
$oFCKeditor1->BasePath 		='FCKeditor/';
$oFCKeditor1->Value 		= stripslashes(trim($emails[0]['order_admin']));
$oFCKeditor1->ToolbarSet 	= 'Default';
$oFCKeditor1->Width  		= '100%';//'636' ;
$oFCKeditor1->Height 		= '400';
$output1 = $oFCKeditor1->CreateHtml() ;
$smarty->assign("output1",$output1);

/*$oFCKeditor2 = new FCKeditor('order_modified') ;
$oFCKeditor2->BasePath = 'FCKeditor/';
$oFCKeditor2->ToolbarSet = 'Email';
$oFCKeditor2->Width  = '100%' ;
$oFCKeditor2->Height = '400' ;
$oFCKeditor2->Value = $emails[0]['order_modified'];
$oFCKeditor2->Config['FullPage'] = "true";
$output2 = $oFCKeditor2->CreateHtml() ;
$smarty->assign("output2",$output2);
*/
$oFCKeditor2      			= new FCKeditor('order_modified') ;
$oFCKeditor2->BasePath 		='FCKeditor/';
$oFCKeditor2->Value 		= stripslashes(trim($emails[0]['order_modified']));
$oFCKeditor2->ToolbarSet 	= 'Default';
$oFCKeditor2->Width  		= '100%';//'636' ;
$oFCKeditor2->Height 		= '400';
$output2 = $oFCKeditor2->CreateHtml() ;
$smarty->assign("output2",$output2);


/*$oFCKeditor3 = new FCKeditor('voucher_user') ;
$oFCKeditor3->BasePath = 'FCKeditor/';
$oFCKeditor3->ToolbarSet = 'Email';
$oFCKeditor3->Width  = '100%' ;
$oFCKeditor3->Height = '400' ;
$oFCKeditor3->Value = $emails[0]['voucher_user'];
$oFCKeditor3->Config['FullPage'] = "true";
$output3 = $oFCKeditor3->CreateHtml() ;
$smarty->assign("output3",$output3);*/

$oFCKeditor3      			= new FCKeditor('voucher_user') ;
$oFCKeditor3->BasePath 		='FCKeditor/';
$oFCKeditor3->Value 		= stripslashes(trim($emails[0]['voucher_user']));
$oFCKeditor3->ToolbarSet 	= 'Default';
$oFCKeditor3->Width  		= '100%';//'636' ;
$oFCKeditor3->Height 		= '400';
$output3 = $oFCKeditor3->CreateHtml() ;
$smarty->assign("output3",$output3);


/*$oFCKeditor4 = new FCKeditor('voucher_admin') ;
$oFCKeditor4->BasePath = 'FCKeditor/';
$oFCKeditor4->ToolbarSet = 'Email';
$oFCKeditor4->Width  = '100%' ;
$oFCKeditor4->Height = '400' ;
$oFCKeditor4->Value = $emails[0]['voucher_admin'];
$oFCKeditor4->Config['FullPage'] = "true";
$output4 = $oFCKeditor4->CreateHtml() ;
$smarty->assign("output4",$output4);
*/
$oFCKeditor4      			= new FCKeditor('voucher_admin') ;
$oFCKeditor4->BasePath 		='FCKeditor/';
$oFCKeditor4->Value 		= stripslashes(trim($emails[0]['voucher_admin']));
$oFCKeditor4->ToolbarSet 	= 'Default';
$oFCKeditor4->Width  		= '100%';//'636' ;
$oFCKeditor4->Height 		= '400';
$output4 = $oFCKeditor4->CreateHtml() ;
$smarty->assign("output4",$output4);

$oFCKeditor5      			= new FCKeditor('order_user2') ;
$oFCKeditor5->BasePath 		='FCKeditor/';
$oFCKeditor5->Value 			= stripslashes(trim($emails[0]['order_user2']));
$oFCKeditor5->ToolbarSet 	= 'Default';
$oFCKeditor5->Width  		= '100%';//'636' ;
$oFCKeditor5->Height 		= '400';
$output5 = $oFCKeditor5->CreateHtml();
$smarty->assign("output5",$output5);

$oFCKeditor6      			= new FCKeditor('feedback') ;
$oFCKeditor6->BasePath 		='FCKeditor/';
$oFCKeditor6->Value 			= stripslashes(trim($emails[0]['feedback']));
$oFCKeditor6->ToolbarSet 	= 'Default';
$oFCKeditor6->Width  		= '100%';//'636' ;
$oFCKeditor6->Height 		= '400';
$output6 = $oFCKeditor6->CreateHtml();
$smarty->assign("output6",$output6);

$oFCKeditor7      			= new FCKeditor('thames_festival_blast') ;
$oFCKeditor7->BasePath 		='FCKeditor/';
$oFCKeditor7->Value 			= stripslashes(trim($emails[0]['thames_festival_blast']));
$oFCKeditor7->ToolbarSet 	= 'Default';
$oFCKeditor7->Width  		= '100%';//'636' ;
$oFCKeditor7->Height 		= '400';
$output7 = $oFCKeditor7->CreateHtml();
$smarty->assign("output7",$output7);

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","settings");
$smarty->assign("page","emails");
$smarty->display('cms_pages.tpl');
?>