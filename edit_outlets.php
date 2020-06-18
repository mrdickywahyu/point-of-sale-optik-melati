<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_outlets.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['userName'] == '' && $_SESSION['userPassword'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else 
{
	// get variable
	$module = $_GET['module'];
	$act = $_GET['act'];
	
	if ($module == 'outlet' && $act == 'edit')
	{
		// insert method into a variable
		$outletID = $_GET['outletID'];
		
		// showing up the outlet data based on outlet id
		$queryOutlet = "SELECT * FROM as_outlets WHERE outletID = '$outletID'";
		$sqlOutlet = mysqli_query($connect, $queryOutlet);
		
		// fetch data
		$dataOutlet = mysqli_fetch_array($sqlOutlet);
		
		// assign fetch data to the tpl
		$smarty->assign("outletID", $dataOutlet['outletID']);
		$smarty->assign("outletCode", $dataOutlet['outletCode']);
		$smarty->assign("outletName", $dataOutlet['outletName']);
		$smarty->assign("outletStatus", $dataOutlet['outletStatus']);
		$smarty->assign("outletUsername", $dataOutlet['outletUsername']);
		$smarty->assign("outletPassword", $dataOutlet['outletPassword']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>