<?php
// include header
include "header.php";
// set the tpl page
$page = "receivables.tpl";

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
	
	// if module is receivable and action is search
	if ($module == 'receivable' && $act == 'search')
	{
		// get method value and change into variables
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		$status = $_GET['status'];
		$memberID = $_GET['memberID'];
		$outletID = $_SESSION['outletID'];
		
		// showing the receivables based on period date
		if ($startDate != '' && $endDate != '' && $memberID != ''){
			if ($status == '3'){
				$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxPay 
				FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
				WHERE A.outletID = '$outletID' AND B.memberID = '$memberID' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
			}
			else{
				$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxPay 
				FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
				WHERE A.outletID = '$outletID' AND B.memberID = '$memberID' AND A.status = '$status' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
			}
		}
		elseif ($startDate != '' && $endDate != '' && $memberID == '')
		{
			if ($status == '3'){
				$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxPay 
				FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
				WHERE A.outletID = '$outletID' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
			}
			else{
				$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxPay 
				FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
				WHERE A.outletID = '$outletID' AND A.status = '$status' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
			}
		}
		elseif ($startDate == '' && $endDate == '' && $memberID != ''){
			if ($status == '3'){
				$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxPay 
				FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
				WHERE A.outletID = '$outletID' AND B.memberID = '$memberID' ORDER BY B.trxTerminDate ASC";
			}
			else{
				$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxPay 
				FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
				WHERE A.outletID = '$outletID' AND A.status = '$status' AND B.memberID = '$memberID' ORDER BY B.trxTerminDate ASC";
			}
		}
		else{
			if ($status == '3'){
				$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxPay 
				FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
				WHERE A.outletID = '$outletID' ORDER BY B.trxTerminDate ASC";
			}
			else{
				$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxPay 
				FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
				WHERE A.outletID = '$outletID' AND A.status = '$status' ORDER BY B.trxTerminDate ASC";
			}
		}
		
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
	}
	
	// if the module is receivable and act is delete
	elseif ($module == 'receivable' && $act == 'delete')
	{
		$outletID = $_SESSION['outletID'];
		$id = $_GET['id'];
		$receivableID = $_GET['receivableID'];
		$invoiceID = $_GET['invoiceID'];
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		
		$queryReceivable = "DELETE FROM as_receivables_payment WHERE paymentID = '$id' AND outletID = '$outletID'";
		mysqli_query($connect, $queryReceivable);
		
		$queryRec = "UPDATE as_receivables SET status = '1' WHERE receivableID = '$receivableID' AND outletID = '$outletID'";
		mysqli_query($connect, $queryRec);
		
		header("Location: receivables.php?module=receivable&act=view&receivableID=".$receivableID."&invoiceID=".$invoiceID."&startDate=".$startDate."&endDate=".$endDate."&code=2");
	}
	
	// if the module is receivable and act is view
	elseif ($module == 'receivable' && $act == 'view')
	{
		// get the method value
		$invoiceID = $_GET['invoiceID'];
		$receivableID = $_GET['receivableID'];
		$outletID = $_SESSION['outletID'];
		
		$smarty->assign("receivableDate", date('Y-m-d'));
		$smarty->assign("startDate", $_GET['startDate']);
		$smarty->assign("endDate", $_GET['endDate']);
		
		$queryReceivable = "SELECT B.trxStatus, A.invoiceID, A.receivableID, B.trxDate, B.memberID, B.trxFullName, B.trxAddress, B.trxPhone,
		B.trxSubtotal, B.trxDiscount, B.trxTotalModal, B.trxPPN, B.trxTotal, B.trxPay, B.trxChange, B.trxTerminDate, B.nopol, A.status FROM as_receivables A 
		INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID 
		WHERE A.receivableID = '$receivableID' AND A.invoiceID = '$invoiceID'";
		$sqlReceivable = mysqli_query($connect, $queryReceivable);
		$dataReceivable = mysqli_fetch_array($sqlReceivable);
		
		if ($dataReceivable['trxStatus'] == '1'){
			$status = "Cash";
		}
		elseif ($dataReceivable['trxStatus'] == '2'){
			$status = "Pending";
		}
		else{
			$status = "Termin";
		}
		
		$totalHarusBayar = $dataReceivable['trxTotal'] - $dataReceivable['trxPay'];
		
		$smarty->assign("invoiceID", $invoiceID);
		$smarty->assign("receivableID", $receivableID);
		$smarty->assign("trxDate", tgl_indo($dataReceivable['trxDate']));
		$smarty->assign("memberID", $dataReceivable['memberID']);
		$smarty->assign("trxFullName", $dataReceivable['trxFullName']);
		$smarty->assign("trxAddress", $dataReceivable['trxAddress']);
		$smarty->assign("trxPhone", $dataReceivable['trxPhone']);
		$smarty->assign("trxTotal", rupiah($dataReceivable['trxTotal']));
		$smarty->assign("trxPay", rupiah($dataReceivable['trxPay']));
		$smarty->assign("totalHarusBayar", rupiah($totalHarusBayar));
		$smarty->assign("status", $status);
		$smarty->assign("terminDate", tgl_indo2($dataReceivable['trxTerminDate']));
		$smarty->assign("trxStatus", $dataReceivable['trxStatus']);
		$smarty->assign("terbilang", Terbilang($dataReceivable['trxTotal']));
		
		$payQuery = "SELECT SUM(receivablePay) as payTotal FROM as_receivables_payment WHERE receivableID = '$receivableID' AND outletID = '$outletID'";
		$paySql = mysqli_query($connect, $payQuery);
		$payData = mysqli_fetch_array($paySql);
		
		$totalPay = $dataReceivable['trxPay'] + $payData['payTotal'];
		
		$totalSisa = $dataReceivable['trxTotal'] - $totalPay;
		
		if ($totalSisa <= '0'){
			$totalSisaIf = "Lunas";
			$sisa = 0;
		}
		else{
			$totalSisaIf = "Belum Lunas";
			$sisa = $totalSisa;
		}
		
		$smarty->assign("totalPay", rupiah($payData['payTotal']));
		$smarty->assign("totalSisa", rupiah($sisa));
		$smarty->assign("totalSisaIf", $totalSisaIf);
		$smarty->assign("sisa", $sisa);
		
		// showing up the payment
		$queryPayment = "SELECT * FROM as_receivables_payment WHERE outletID = '$outletID' AND receivableID = '$receivableID'";
		$sqlPayment = mysqli_query($connect, $queryPayment);
		
		// fetch data
		$i = 1;
		while ($dtPayment = mysqli_fetch_array($sqlPayment))
		{
			$totalBayar = $dataReceivable['trxPay'] + $dtPayment['receivablePay'];
			
			$dataPayment[] = array(	'paymentID' => $dtPayment['paymentID'],
									'receivableID' => $dtPayment['receivableID'],
									'receivableDate' => tgl_indo2($dtPayment['receivableDate']),
									'receivablePay' => rupiah($dtPayment['receivablePay']),
									'no' => $i);
			$i++;
		}
		
		// assign data payment to the receivable tpl
		$smarty->assign("dataPayment", $dataPayment);
	} 

	// if the module is receivable and act is preview
	elseif ($module == 'receivable' && $act == 'preview')
	{
		// get the method value
		$invoiceID = $_GET['invoiceID'];
		$receivableID = $_GET['receivableID'];
		
		$queryReceivable = "SELECT B.trxStatus, A.invoiceID, A.receivableID, B.trxDate, B.memberID, B.trxFullName, B.trxAddress, B.trxPhone,
		B.trxSubtotal, B.trxDiscount, B.trxTotalModal, B.trxPPN, B.trxTotal, B.trxPay, B.trxChange, B.trxTerminDate, B.nopol, A.status FROM as_receivables A 
		INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID 
		WHERE A.receivableID = '$receivableID' AND A.invoiceID = '$invoiceID'";
		$sqlReceivable = mysqli_query($connect, $queryReceivable);
		$dataReceivable = mysqli_fetch_array($sqlReceivable);
		
		if ($dataReceivable['trxStatus'] == '1'){
			$status = "Cash";
		}
		elseif ($dataReceivable['trxStatus'] == '2'){
			$status = "Pending";
		}
		else{
			$status = "Termin";
		}
		
		$smarty->assign("invoiceID", $invoiceID);
		$smarty->assign("receivableID", $receivableID);
		$smarty->assign("trxDate", tgl_indo($dataReceivable['trxDate']));
		$smarty->assign("memberID", $dataReceivable['memberID']);
		$smarty->assign("trxFullName", $dataReceivable['trxFullName']);
		$smarty->assign("trxAddress", $dataReceivable['trxAddress']);
		$smarty->assign("trxPhone", $dataReceivable['trxPhone']);
		$smarty->assign("trxSubtotal", rupiah($dataReceivable['trxSubtotal']));
		$smarty->assign("trxDiscount", rupiah($dataReceivable['trxDiscount']));
		$smarty->assign("trxTotal", rupiah($dataReceivable['trxTotal']));
		$smarty->assign("trxPay", rupiah($dataReceivable['trxPay']));
		$smarty->assign("trxChange", rupiah($dataReceivable['trxChange']));
		$smarty->assign("status", $status);
		$smarty->assign("trxPPN", rupiah($dataReceivable['trxPPN']));
		$smarty->assign("terminDate", tgl_indo2($dataReceivable['trxTerminDate']));
		$smarty->assign("trxStatus", $dataReceivable['trxStatus']);
		$smarty->assign("terbilang", Terbilang($dataReceivable['trxTotal']));
		
		// showing up the service
		$queryDetail = "SELECT A.detailID, A.invoiceID, A.productBarcode, A.detailPrice, A.detailQty, A.detailSubtotal, B.productName, A.discPercent, A.note 
		FROM as_sales_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceID = '$invoiceID'";
		
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productBarcode' => $dtDetail['productBarcode'],
									'productName' => $dtDetail['productName'],
									'detailPrice' => rupiah($dtDetail['detailPrice']),
									'discPercent' => $dtDetail['discPercent'],
									'detailQty' => $dtDetail['detailQty'],
									'note' => $dtDetail['note'],
									'detailSubtotal' => rupiah($dtDetail['detailSubtotal']),
									'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataDetail", $dataDetail);
	}
	
	else 
	{
		// get method value and change into variables
		$outletID = $_SESSION['outletID'];
		
		// showing the receivables based on period date
		$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxDate, B.trxPay, B.trxTerminDate 
		FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
		WHERE A.outletID = '$outletID' ORDER BY B.trxTerminDate ASC";
		$sqlReceivable = mysqli_query($connect, $queryReceivable);
		
		// fetch data
		$i = 1;
		while ($dtReceivable = mysqli_fetch_array($sqlReceivable))
		{
			$payQuery = "SELECT SUM(receivablePay) as payTotal FROM as_receivables_payment WHERE receivableID = '$dtReceivable[receivableID]'";
			$paySql = mysqli_query($connect, $payQuery);
			$payData = mysqli_fetch_array($paySql);
			
			$totalHutang = $dtReceivable['trxTotal'] - $dtReceivable['trxPay'];
			$totalPay = $payData['payTotal'];
			$totalSisa = $totalHutang - $totalPay;
			
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
										'trxPay' => rupiah($totalPay),
										'sisa' => rupiah($sisa),
										'statusSisa' => $totalSisaIf,
										'totalsisa' => $totalSisa,
										'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataReceivable", $dataReceivable);
	} // close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>