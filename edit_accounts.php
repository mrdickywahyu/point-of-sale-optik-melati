<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_accounts.tpl";

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
	
	if ($module == 'account' && $act == 'edit')
	{
		// insert method into a variable
		$accountID = $_GET['accountID'];
		
		// showing up the account data based on account id and outlet id
		$queryAccount = "SELECT * FROM as_accounts WHERE accountID = '$accountID'";
		$sqlAccount = mysqli_query($connect, $queryAccount);
		
		// fetch data
		$dataAccount = mysqli_fetch_array($sqlAccount);
		
		// assign fetch data to the tpl
		$smarty->assign("accountID", $dataAccount['accountID']);
		$smarty->assign("accountCode", $dataAccount['accountCode']);
		$smarty->assign("accountName", $dataAccount['accountName']);
		$smarty->assign("accountStatus", $dataAccount['accountStatus']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>