<?php
// includere smarty :
include "check_login.php";
include("FCKeditor/fckeditor.php");

if(!empty($_GET['delete_id']) && is_numeric($_GET['delete_id'])){
	$db->delete_field($db->subpage, "page_id", $_GET['delete_id'] );	
}

//moving the posiotions
if(!empty($_GET['move_id1']) && !empty($_GET['move_id2']) && !empty($_GET['pos1']) && !empty($_GET['pos2']) && is_numeric($_GET['move_id1'])){
	$edit = array("page_order"=>$_GET['pos2']);
	$db->edit_field($db->subpage, $edit, "page_id", $_GET['move_id1'] );	
	$edit = array("page_order"=>$_GET['pos1']);
	$db->edit_field($db->subpage, $edit, "page_id", $_GET['move_id2'] );
}


if (isset($_POST['page_body'])){

	if(!empty($_GET['subpage_id'])){
		$db->edit_field($db->subpage, $_POST, "page_id", $_GET['subpage_id'] );	
	} else {
		//add new subpage
		if(isset($_POST['page_id']) && ($_POST['page_id']==0)){
			unset($_POST['page_id']);
			$_POST['page_parent'] = $id_page ;
			$query 	= "SELECT max(page_order) as next FROM $db->subpage WHERE page_parent = $id_page";
			$next 	=  $db->select_fields($db->subpage, $query, array("next"), "", "", "", "", "", 1);
			$_POST['page_order'] = (!empty($next['next']) ? ($next['next']+1) : 1);
			//print($next);
			$db->insert_field($db->subpage, $_POST);	
		//edit default page
		} else { 
			$db->edit_field($db->page, $_POST, "page_id", $id_page );
		}
	}
}

//extract pages from database
$subpages = $db->select_fields($db->subpage, "", array('page_id','page_title','page_order'), "page_parent", $id_page, "page_order");
$smarty->assign("subpages",$subpages);

if(@$_GET['option']!="add"){
	if(!empty($_GET['subpage_id'])){
		// extract content from database
		$content = $db->select_fields($db->subpage, "", "", "page_id", $_GET['subpage_id'] , "", "", "",1 );
	} 
	if (empty($content)){
		// extract content from database
		$content = $db->select_fields($db->page, "", "", "page_id", $id_page , "", "", "",1 );
	}
} else {
	$content = array( "page_id" => 0,  "page_title" => "", "page_meta" => "", "page_body" => "" );
}
$smarty->assign("content",$content);


/*$oFCKeditor = new FCKeditor('page_body') ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->ToolbarSet = 'Default';
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '800' ;
$oFCKeditor->Value = $content['page_body'];
$output = $oFCKeditor->CreateHtml() ;*/

/*$oFCKeditor      			= new FCKeditor('page_body') ;
$oFCKeditor->BasePath 		='FCKeditor/';
$oFCKeditor->Value 			= stripslashes(trim($content['page_body']));
$oFCKeditor->ToolbarSet 	= 'Default';
$oFCKeditor->Width  		= '100%';//'636' ;
$oFCKeditor->Height 		= '800';
$output = $oFCKeditor->CreateHtml();*/
		
$output = "<textarea name=\"page_body\">".stripslashes(trim($content['page_body']))."</textarea>
			<script language=\"javascript\">
			    CKEDITOR.replace( 'page_body' );
			</script>";


$smarty->assign("output",$output);


// asignare variabile smarty si generare fisier smarty :
//$smarty->assign("pages_dir","editor");
//$smarty->assign("page","home");
//$smarty->display('cms_pages.tpl');
?>