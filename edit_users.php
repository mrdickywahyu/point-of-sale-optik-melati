<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_users.tpl";

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
	
	if ($module == 'user' && $act == 'edit')
	{
		// insert method into a variable
		$userID = $_GET['userID'];
		
		// showing up the user data based on user id
		$queryUser = "SELECT * FROM as_users WHERE userID = '$userID'";
		$sqlUser = mysqli_query($connect, $queryUser);
		
		// fetch data
		$dataUser = mysqli_fetch_array($sqlUser);
		
		// assign fetch data to the tpl
		$smarty->assign("userID", $dataUser['userID']);
		$smarty->assign("outletID", $outletID);
		$smarty->assign("userNIP", $dataUser['userNIP']);
		$smarty->assign("userFullName", $dataUser['userFullName']);
		$smarty->assign("userPhone", $dataUser['userPhone']);
		$smarty->assign("userLevel", $dataUser['userLevel']);
		$smarty->assign("userBlocked", $dataUser['userBlocked']);
		$smarty->assign("userName", $dataUser['userName']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>