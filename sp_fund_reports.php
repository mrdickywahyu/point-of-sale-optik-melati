<?php
// include header
include "header.php";
// set the tpl page
$page = "sp_fund_reports.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['userName'] == '' && $_SESSION['userPassword'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else 
{
	if ($_SESSION['outletLevel'] != 'W' && $_SESSION['outletID'] != '1' || $_SESSION['outletLevel'] == ''){
		// show up the text and exit
		echo "You have not authorization for access the modules.";
		exit();
	}
	
	// get variable
	$module = $_GET['module'];
	$act = $_GET['act'];
	
	// if module is report and action is search
	if ($module == 'report' && $act == 'search')
	{
		// get method value and change into variables
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		$outletID = $_GET['outlet'];
		
		// showing up the fund based on period date
		$queryFund = "SELECT * FROM as_funds A INNER JOIN as_accounts B ON B.accountID=A.accountID WHERE A.outletID = '$outletID' AND A.fundDate BETWEEN '$startDate' AND '$endDate'";
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
		$smarty->assign("startDate", tgl_indo2($startDate));
		$smarty->assign("endDate", tgl_indo2($endDate));
		$smarty->assign("start", $startDate);
		$smarty->assign("end", $endDate);
		$smarty->assign("fundTotal", rupiah($fundTotal));
		
		$outletDt = mysqli_fetch_array(mysqli_query($connect, "SELECT outletCode, outletID, outletName FROM as_outlets WHERE outletID = '$outletID'"));
	
		$smarty->assign("oCode", $outletDt['outletCode']);
		$smarty->assign("oName", $outletDt['outletName']);
		$smarty->assign("oID", $outletDt['outletID']);
	}

	$queryOutlet = "SELECT * FROM as_outlets WHERE outletStatus = 'Y' ORDER BY outletCode, outletName ASC";
	$sqlOutlet = mysqli_query($connect, $queryOutlet);
	while ($dtOutlet = mysqli_fetch_array($sqlOutlet))
	{
		$dataOutlet[] = array(	'outletID' => $dtOutlet['outletID'],
								'outletName' => $dtOutlet['outletName'],
								'outletCode' => $dtOutlet['outletCode']);
	}
	
	$smarty->assign("dataOutlet", $dataOutlet);
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
	// showing up the year
	for ($i = date('Y'); $i >= 2014; $i--)
	{
		$tahun[] = $i;
	}
	
	$smarty->assign("tahun", $tahun);
} // close bracket

// include footer
include "footer.php";
?>