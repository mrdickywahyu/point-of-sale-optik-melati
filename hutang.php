<?php
// include header
include "header.php";
// set the tpl page
$page = "hutang.tpl";

$module = $_GET['module'];
$act = $_GET['act'];

$outletID = $_SESSION['outletID'];
$start = date('Y-m-d');

$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxDate, B.trxDP, B.trxTerminDate 
FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
WHERE A.outletID = '$outletID' AND B.trxStatus = '2' AND DATEDIFF(B.trxTerminDate, '$start') < 4 ORDER BY B.trxTerminDate ASC";
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
							'status' => $dtDebt['status'],
							'supplierID' => $dtDebt['supplierID'],
							'trxDate' => tgl_indo2($dtDebt['trxDate']),
							'trxTerminDate' => tgl_indo2($dtDebt['trxTerminDate']),
							'trxFullName' => $dtDebt['trxFullName'],
							'trxTotal' => rupiah($totalHutang),
							'trxPay' => rupiah($payData['payTotal']),
							'sisa' => rupiah($sisa),
							'statusSisa' => $totalSisaIf,
							'totalsisa' => $totalSisa,
							'no' => $i);
	$i++;
}

// assign to the tpl
$smarty->assign("dataDebt", $dataDebt);

// assign code to the tpl
$smarty->assign("code", $_GET['code']);
$smarty->assign("module", $module);
$smarty->assign("act", $act);

// include footer
include "footer.php";
?>