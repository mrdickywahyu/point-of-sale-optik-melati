<?php
// include header
include "header.php";
// set the tpl page
$page = "sp_debt_reports.tpl";

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
		
		// showing the debts based on period date
		if ($startDate != '' && $endDate != '' && $outletID != ''){
			$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
			FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
			WHERE A.outletID = '$outletID' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
		}
		
		$sqlDebt = mysqli_query($connect, $queryDebt);
		
		// fetch data
		$i = 1;
		while ($dtDebt = mysqli_fetch_array($sqlDebt))
		{
			$payQuery = "SELECT SUM(debtPay) as payTotal FROM as_debts_payment WHERE debtID = '$dtDebt[debtID]'";
			$paySql = mysqli_query($connect, $payQuery);
			$payData = mysqli_fetch_array($paySql);
			
			$totalPay = $dtDebt['trxDP'] + $payData['payTotal'];
			
			$totalSisa = $dtDebt['trxTotal'] - $totalPay;
			
			$totalHutang = $dtDebt['trxTotal'] - $dtDebt['trxDP'];
			
			if ($totalSisa <= '0'){
				$totalSisaIf = "Lunas";
				$sisa = 0;
			}
			else{
				$totalSisaIf = "Belum Lunas";
				$sisa = $totalSisa;
			}
			
			// save into array
			$dataDebt[] = array(	'debtID' => $dtDebt['debtID'],
									'invoiceID' => $dtDebt['invoiceID'],
									'trxDate' => tgl_indo2($dtDebt['trxDate']),
									'status' => $dtDebt['status'],
									'supplierID' => $dtDebt['supplierID'],
									'trxDate' => tgl_indo2($dtDebt['trxDate']),
									'trxTerminDate' => tgl_indo2($dtDebt['trxTerminDate']),
									'trxFullName' => $dtDebt['trxFullName'],
									'trxTotal' => rupiah($totalHutang),
									'trxDP' => rupiah($payData['payTotal']),
									'sisa' => rupiah($sisa),
									'statusSisa' => $totalSisaIf,
									'totalsisa' => $totalSisa,
									'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataDebt", $dataDebt);
		$smarty->assign("startDate", tgl_indo2($startDate));
		$smarty->assign("endDate", tgl_indo2($endDate));
		$smarty->assign("start", $startDate);
		$smarty->assign("end", $endDate);
		$smarty->assign("status", $status);
		$smarty->assign("supplierID", $supplierID);
		
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