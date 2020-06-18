<?php
// include header
include "header.php";
// set the tpl page
$page = "piutang.tpl";

$module = $_GET['module'];
$act = $_GET['act'];

$outletID = $_SESSION['outletID'];
$start = date('Y-m-d');

$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxDate, B.trxPay, B.trxTerminDate 
FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
WHERE A.outletID = '$outletID' AND B.trxStatus = '3' AND DATEDIFF(B.trxTerminDate, '$start') < 4 ORDER BY B.trxTerminDate ASC";
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

// assign code to the tpl
$smarty->assign("code", $_GET['code']);
$smarty->assign("module", $module);
$smarty->assign("act", $act);

// include footer
include "footer.php";
?>