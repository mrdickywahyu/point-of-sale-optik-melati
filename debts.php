<?php
// include header
include "header.php";
// set the tpl page
$page = "debts.tpl";

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
	
	// if module is debt and action is search
	if ($module == 'debt' && $act == 'search')
	{
		// get method value and change into variables
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		$status = $_GET['status'];
		$supplierID = $_GET['supplierID'];
		$outletID = $_SESSION['outletID'];
		
		// showing the debts based on period date
		if ($startDate != '' && $endDate != '' && $supplierID != ''){
			if ($status == '3'){
				$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
				FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
				WHERE A.outletID = '$outletID' AND B.supplierID = '$supplierID' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
			}
			else{
				$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
				FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
				WHERE A.outletID = '$outletID' AND B.supplierID = '$supplierID' AND A.status = '$status' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
			}
		}
		elseif ($startDate != '' && $endDate != '' && $supplierID == '')
		{
			if ($status == '3'){
				$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
				FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
				WHERE A.outletID = '$outletID' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
			}
			else{
				$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
				FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
				WHERE A.outletID = '$outletID' AND A.status = '$status' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
			}
		}
		elseif ($startDate == '' && $endDate == '' && $supplierID != ''){
			if ($status == '3'){
				$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
				FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
				WHERE A.outletID = '$outletID' AND B.supplierID = '$supplierID' ORDER BY B.trxTerminDate ASC";
			}
			else{
				$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
				FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
				WHERE A.outletID = '$outletID' AND A.status = '$status' AND B.supplierID = '$supplierID' ORDER BY B.trxTerminDate ASC";
			}
		}
		else{
			if ($status == '3'){
				$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
				FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
				WHERE A.outletID = '$outletID' ORDER BY B.trxTerminDate ASC";
			}
			else{
				$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
				FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
				WHERE A.outletID = '$outletID' AND A.status = '$status' ORDER BY B.trxTerminDate ASC";
			}
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
	}
	
	// if the module is debt and act is delete
	elseif ($module == 'debt' && $act == 'delete')
	{
		$outletID = $_SESSION['outletID'];
		$id = $_GET['id'];
		$debtID = $_GET['debtID'];
		$invoiceID = $_GET['invoiceID'];
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		
		$queryDebt = "DELETE FROM as_debts_payment WHERE paymentID = '$id' AND outletID = '$outletID'";
		mysqli_query($connect, $queryDebt);
		
		$queryDeb = "UPDATE as_debts SET status = '1' WHERE debtID = '$debtID' AND outletID = '$outletID'";
		mysqli_query($connect, $queryDeb);
		
		header("Location: debts.php?module=debt&act=view&debtID=".$debtID."&invoiceID=".$invoiceID."&startDate=".$startDate."&endDate=".$endDate."&code=2");
	}
	
	// if the module is debt and act is view
	elseif ($module == 'debt' && $act == 'view')
	{
		// get the method value
		$invoiceID = $_GET['invoiceID'];
		$outletID = $_SESSION['outletID'];
		$debtID = $_GET['debtID'];
		$debtDate = date('Y-m-d');
		
		$queryTrx = "SELECT * FROM as_buy_transactions WHERE invoiceBuyID = '$invoiceID' AND outletID = '$outletID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		$dataTrx = mysqli_fetch_array($sqlTrx);
		
		$queryDebt = "SELECT B.trxStatus, A.invoiceID, B.trxDate, B.supplierID, B.trxFullName, B.trxAddress, B.trxPhone,
		B.trxSubtotal, B.trxDiscount, B.trxTotal, B.trxDP, B.trxTerminDate, A.status FROM as_debts A 
		INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID 
		WHERE A.debtID = '$debtID' AND A.invoiceID = '$invoiceID' AND A.outletID = '$outletID'";
		$sqlDebt = mysqli_query($connect, $queryDebt);
		$dataDebt = mysqli_fetch_array($sqlDebt);
		
		$totalHarusBayar = $dataDebt['trxTotal'] - $dataDebt['trxDP'];
		
		$payQuery = "SELECT SUM(debtPay) as payTotal FROM as_debts_payment WHERE debtID = '$debtID' AND outletID = '$outletID'";
		$paySql = mysqli_query($connect, $payQuery);
		$payData = mysqli_fetch_array($paySql);
		
		$totalPay = $dataDebt['trxDP'] + $payData['payTotal'];
		
		$totalSisa = $dataDebt['trxTotal'] - $totalPay;
		
		if ($totalSisa <= '0'){
			$totalSisaIf = "Lunas";
			$sisa = 0;
		}
		else{
			$totalSisaIf = "Belum Lunas";
			$sisa = $totalSisa;
		}
		
		$smarty->assign("invoiceID", $invoiceID);
		$smarty->assign("debtID", $debtID);
		$smarty->assign("supplierID", $dataTrx['supplierID']);
		$smarty->assign("trxFullName", $dataTrx['trxFullName']);
		$smarty->assign("trxAddress", $dataTrx['trxAddress']);
		$smarty->assign("trxPhone", $dataTrx['trxPhone']);
		$smarty->assign("trxDate", tgl_indo($dataTrx['trxDate']));
		$smarty->assign("trxTerminDate", tgl_indo2($dataTrx['trxTerminDate']));
		$smarty->assign("trxSubtotal", rupiah($dataTrx['trxSubtotal']));
		$smarty->assign("trxDiscount", rupiah($dataTrx['trxDiscount']));
		$smarty->assign("trxTotal", rupiah($dataTrx['trxTotal']));
		$smarty->assign("totalHarusBayar", rupiah($totalHarusBayar));
		$smarty->assign("totalPay", rupiah($payData['payTotal']));
		$smarty->assign("totalSisa", rupiah($sisa));
		$smarty->assign("totalSisaIf", $totalSisaIf);
		$smarty->assign("sisa", $sisa);
		$smarty->assign("debtDate", $debtDate);
		
		$smarty->assign("kurang", rupiah($kurang));
		$smarty->assign("trxDP", rupiah($dataTrx['trxDP']));
		$smarty->assign("terbilang", Terbilang($dataTrx['trxTotal']));
		$smarty->assign("status", $status);
		$smarty->assign("trxStatus", $dataTrx['trxStatus']);
		$smarty->assign("startDate", $_GET['startDate']);
		$smarty->assign("endDate", $_GET['endDate']);
		$smarty->assign("invoiceSupplier", $dataTrx['invoiceSupplier']);
		
		// showing up the payment
		$queryPayment = "SELECT * FROM as_debts_payment WHERE outletID = '$outletID' AND debtID = '$debtID'";
		$sqlPayment = mysqli_query($connect, $queryPayment);
		
		// fetch data
		$i = 1;
		while ($dtPayment = mysqli_fetch_array($sqlPayment))
		{
			$totalBayar = $dataDebt['trxDP'] + $dtPayment['debtPay'];
			
			$dataPayment[] = array(	'paymentID' => $dtPayment['paymentID'],
									'debtID' => $dtPayment['debtID'],
									'debtDate' => tgl_indo2($dtPayment['debtDate']),
									'debtPay' => rupiah($dtPayment['debtPay']),
									'no' => $i);
			$i++;
		}
		
		// assign data payment to the receivable tpl
		$smarty->assign("dataPayment", $dataPayment);
	} 

	// if the module is debt and act is preview
	elseif ($module == 'debt' && $act == 'preview')
	{
		// get the method value
		$invoiceID = $_GET['invoiceID'];
		$outletID = $_SESSION['outletID'];
		$debtID = $_GET['debtID'];
		
		$queryTrx = "SELECT * FROM as_buy_transactions WHERE invoiceBuyID = '$invoiceID' AND outletID = '$outletID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		$dataTrx = mysqli_fetch_array($sqlTrx);
		$kurang = $dataTrx['trxTotal'] - $dataTrx['trxDP'];
		
		if ($dataTrx['trxStatus'] == '1'){
			$status = "Cash";
		}
		else{
			$status = "Termin";
		}
		
		
		$smarty->assign("invoiceBuyID", $invoiceID);
		$smarty->assign("trxID", $dataTrx['trxID']);
		$smarty->assign("supplierID", $dataTrx['supplierID']);
		$smarty->assign("trxFullName", $dataTrx['trxFullName']);
		$smarty->assign("trxAddress", $dataTrx['trxAddress']);
		$smarty->assign("trxPhone", $dataTrx['trxPhone']);
		$smarty->assign("trxDate", tgl_indo($dataTrx['trxDate']));
		$smarty->assign("trxTerminDate", tgl_indo2($dataTrx['trxTerminDate']));
		$smarty->assign("trxSubtotal", rupiah($dataTrx['trxSubtotal']));
		$smarty->assign("trxDiscount", rupiah($dataTrx['trxDiscount']));
		$smarty->assign("trxTotal", rupiah($dataTrx['trxTotal']));
		$smarty->assign("kurang", rupiah($kurang));
		$smarty->assign("trxDP", rupiah($dataTrx['trxDP']));
		$smarty->assign("terbilang", Terbilang($dataTrx['trxTotal']));
		$smarty->assign("status", $status);
		$smarty->assign("trxStatus", $dataTrx['trxStatus']);
		$smarty->assign("invoiceSupplier", $dataTrx['invoiceSupplier']);
		
		// showing up the service
		$queryDetail = "SELECT A.detailID, A.invoiceBuyID, A.productBarcode, A.detailBuyPrice, A.detailBuyQty, A.detailBuySubtotal, B.productName 
		FROM as_buy_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceBuyID = '$invoiceID'";
		
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productBarcode' => $dtDetail['productBarcode'],
									'productName' => $dtDetail['productName'],
									'detailBuyPrice' => rupiah($dtDetail['detailBuyPrice']),
									'detailBuyQty' => $dtDetail['detailBuyQty'],
									'detailBuySubtotal' => rupiah($dtDetail['detailBuySubtotal']),
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
		
		// showing the debts based on period date
		$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxDate, B.trxDP, B.trxTerminDate 
		FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
		WHERE A.outletID = '$outletID' ORDER BY B.trxTerminDate ASC";
		$sqlDebt = mysqli_query($connect, $queryDebt);
		
		// fetch data
		$i = 1;
		while ($dtDebt = mysqli_fetch_array($sqlDebt))
		{
			$payQuery = "SELECT SUM(debtPay) as payTotal FROM as_debts_payment WHERE debtID = '$dtDebt[debtID]'";
			$paySql = mysqli_query($connect, $payQuery);
			$payData = mysqli_fetch_array($paySql);
			
			$totalHutang = $dtDebt['trxTotal'] - $dtDebt['trxDP'];
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
			$dataDebt[] = array(	'debtID' => $dtDebt['debtID'],
									'invoiceID' => $dtDebt['invoiceID'],
									'status' => $dtDebt['status'],
									'supplierID' => $dtDebt['supplierID'],
									'trxDate' => tgl_indo2($dtDebt['trxDate']),
									'trxTerminDate' => tgl_indo2($dtDebt['trxTerminDate']),
									'trxFullName' => $dtDebt['trxFullName'],
									'trxTotal' => rupiah($totalHutang),
									'trxPay' => rupiah($totalPay),
									'sisa' => rupiah($sisa),
									'statusSisa' => $totalSisaIf,
									'totalsisa' => $totalSisa,
									'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataDebt", $dataDebt);
	} // close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>