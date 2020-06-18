<?php
// include header
include "header.php";
// set the tpl page
$page = "fund_reports.tpl";

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
	
	// if module is fund report and action is search
	if ($module == 'fund' && $act == 'search')
	{
		// get method value and change into variables
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		
		// showing up the fund based on period date
		$queryFund = "SELECT * FROM as_funds A INNER JOIN as_accounts B ON B.accountID=A.accountID WHERE A.fundDate BETWEEN '$startDate' AND '$endDate'";
		$sqlFund = mysqli_query($connect, $queryFund);
		
		$i = 1;
		while($dtFund = mysqli_fetch_array($sqlFund)){
			
			$fundDate = explode("-", $dtFund['fundDate']);
			
			// save data into array
			$dataFund[] = array('fundID' => $dtFund['fundID'],
								'fundDate' => $fundDate[2]."/".$fundDate[1]."/".$fundDate[0],
								'fundAmount' => rupiah($dtFund['fundAmount']),
								'fundNote' => $dtFund['fundNote'],
								'accountCode' => $dtFund['accountCode'],
								'accountName' => $dtFund['accountName'],
								'no' => $i
								);
			$fundTotal = $fundTotal + $dtFund['fundAmount'];
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataFund", $dataFund);
		$smarty->assign("startDate", tgl_indo($startDate));
		$smarty->assign("endDate", tgl_indo($endDate));
		$smarty->assign("start", $startDate);
		$smarty->assign("end", $endDate);
		$smarty->assign("fundTotal", rupiah($fundTotal));
	}
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>