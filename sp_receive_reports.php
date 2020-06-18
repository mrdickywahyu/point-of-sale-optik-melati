<?php
// include header
include "header.php";
// set the tpl page
$page = "sp_receive_reports.tpl";

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
		
		// showing the receivables based on period date
		$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxPay 
		FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
		WHERE A.outletID = '$outletID' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
		
		$sqlReceivable = mysqli_query($connect, $queryReceivable);
		
		// fetch data
		$i = 1;
		while ($dtReceivable = mysqli_fetch_array($sqlReceivable))
		{
			$payQuery = "SELECT SUM(receivablePay) as payTotal FROM as_receivables_payment WHERE receivableID = '$dtReceivable[receivableID]'";
			$paySql = mysqli_query($connect, $payQuery);
			$payData = mysqli_fetch_array($paySql);
			
			$totalPay = $dtReceivable['trxPay'] + $payData['payTotal'];
			
			$totalSisa = $dtReceivable['trxTotal'] - $totalPay;
			
			$totalHutang = $dtReceivable['trxTotal'] - $dtReceivable['trxPay'];
			
			if ($totalSisa <= '0'){
				$totalSisaIf = "Lunas";
				$sisa = 0;
			}
			else{
				$totalSisaIf = "Belum Lunas";
				$sisa = $totalSisa;
			}
			
			// save into array
			$dataReceivable[] = array(	'receivableID' => $dtReceivable['receivableID'],
										'invoiceID' => $dtReceivable['invoiceID'],
										'trxDate' => tgl_indo2($dtReceivable['trxDate']),
										'status' => $dtReceivable['status'],
										'memberID' => $dtReceivable['memberID'],
										'trxDate' => tgl_indo2($dtReceivable['trxDate']),
										'trxTerminDate' => tgl_indo2($dtReceivable['trxTerminDate']),
										'trxFullName' => $dtReceivable['trxFullName'],
										'trxTotal' => rupiah($totalHutang),
										'trxPay' => rupiah($payData['payTotal']),
										'sisa' => rupiah($sisa),
										'statusSisa' => $totalSisaIf,
										'totalsisa' => $totalSisa,
										'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataReceivable", $dataReceivable);
		$smarty->assign("startDate", tgl_indo2($startDate));
		$smarty->assign("endDate", tgl_indo2($endDate));
		$smarty->assign("start", $startDate);
		$smarty->assign("end", $endDate);
		$smarty->assign("status", $status);
		$smarty->assign("memberID", $memberID);
		
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
	
	// showing up the year
	for ($i = date('Y'); $i >= 2014; $i--)
	{
		$tahun[] = $i;
	}
	
	$smarty->assign("tahun", $tahun);
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>