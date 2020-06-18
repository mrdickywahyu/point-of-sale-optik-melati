<?php
// include header
include "header.php";
// set the tpl page
$page = "accounts.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['userName'] == '' && $_SESSION['userPassword'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else 
{
	if ($_SESSION['userLevel'] != '1'){
		echo "You have not authorization for access the modules.";
		exit();
	}
	
	// get variable
	$module = $_GET['module'];
	$act = $_GET['act'];
	
	// if module is account and action is delete
	if ($module == 'account' && $act == 'delete')
	{
		// insert method into a variable
		$accountID = $_GET['accountID'];
		
		// delete account
		$queryAccount = "DELETE FROM as_accounts WHERE accountID = '$accountID'";
		$sqlAccount = mysqli_query($connect, $queryAccount);
		
		// redirect to the account page
		header("Location: accounts.php?code=3");
	} // close bracket
	
	// default
	else 
	{
		// create new object pagination
		$p = new PaginationAccount;
		// limit 10 data for page
		$limit  = 15;
		$position = $p->searchPosition($limit);
		
		// showing up account data
		$queryAccount = "SELECT * FROM as_accounts ORDER BY accountName ASC LIMIT $position,$limit";
		$sqlAccount = mysqli_query($connect, $queryAccount);
		
		// fetch data
		$i = 1 + $position;
		while ($dtAccount = mysqli_fetch_array($sqlAccount))
		{
			// save data to array
			$dataAccount[] = array(	'accountID' => $dtAccount['accountID'],
									'accountCode' => $dtAccount['accountCode'],
									'accountName' => $dtAccount['accountName'],
									'accountStatus' => $dtAccount['accountStatus'],
									'no' => $i
									);
			$i++;
		} // close while
		
		// count data
		$queryCountAccount = "SELECT * FROM as_accounts";
		$sqlCountAccount = mysqli_query($connect, $queryCountAccount);
		$amountData = mysqli_num_rows($sqlCountAccount);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		// assign array to the tpl
		$smarty->assign("dataAccount", $dataAccount);
		
	} // close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>