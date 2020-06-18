<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_funds.tpl";

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
	
	if ($module == 'fund' && $act == 'edit')
	{
		$fundID = $_GET['fundID'];
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		
		$queryFund = "SELECT * FROM as_funds WHERE fundID = '$fundID'";
		$sqlFund = mysqli_query($connect, $queryFund);
		$dataFund = mysqli_fetch_array($sqlFund);
		
		$fundDate = explode("-", $dataFund['fundDate']);
		
		$smarty->assign("fundID", $dataFund['fundID']);
		$smarty->assign("fundDate", $fundDate[2]."/".$fundDate[1]."/".$fundDate[0]);
		$smarty->assign("fundAmount", $dataFund['fundAmount']);
		$smarty->assign("fundNote", $dataFund['fundNote']);
		$smarty->assign("accountID", $dataFund['accountID']);
		$smarty->assign("startDate", $startDate);
		$smarty->assign("endDate", $endDate);
		
		// shoewing up the accounts
		$queryAccount = "SELECT * FROM as_accounts WHERE accountStatus = 'Y' ORDER BY accountCode,accountName ASC";
		$sqlAccount = mysqli_query($connect, $queryAccount);
		
		// fetch data
		while($dtAccount = mysqli_fetch_array($sqlAccount))
		{
			$dataAccount[] = array(	'accountID' => $dtAccount['accountID'],
									'accountCode' => $dtAccount['accountCode'],
									'accountName' => $dtAccount['accountName']);
		}
		
		// assign to the tpl
		$smarty->assign("dataAccount", $dataAccount);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>