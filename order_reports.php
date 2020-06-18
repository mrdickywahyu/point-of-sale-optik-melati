<?php
// include header
include "header.php";
// set the tpl page
$page = "order_reports.tpl";

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
	
	// if module is order report and action is search
	if ($module == 'order' && $act == 'search')
	{
		// get method value and change into variables
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		$dataOrder = array();
		$n = 1;
		for ($i = strtotime($startDate); $i <= strtotime($endDate); $i += 86400){
			$dateNow = date('Y-m-d', $i);
			
			// total transactions
			$queryOrder = "SELECT SUM(trxTotal) as trxTotal, SUM(trxTotalModal) as trxTotalModal, SUM(trxSubtotal) as trxSubtotal FROM as_sales_transactions WHERE trxDate = '$dateNow'";
			$sqlOrder = mysqli_query($connect, $queryOrder);
			$dtOrder = mysqli_fetch_array($sqlOrder);
			
			// total funds
			$queryFund = "SELECT SUM(fundAmount) as fundAmount FROM as_funds WHERE fundDate = '$dateNow'";
			$sqlFund = mysqli_query($connect, $queryFund);
			$dtFund = mysqli_fetch_array($sqlFund);
			
			// total pending transactions
			$queryTermin = "SELECT SUM(trxTotal) as trxTotal, SUM(trxPay) as trxPay FROM as_sales_transactions WHERE trxDate = '$dateNow' AND trxStatus = '3'";
			$sqlTermin = mysqli_query($connect, $queryTermin);
			$dtTermin = mysqli_fetch_array($sqlTermin);
			
			$payQuery = "SELECT SUM(receivablePay) as payTotal FROM as_receivables_payment WHERE receivableDate = '$dateNow'";
			$paySql = mysqli_query($connect, $payQuery);
			$payData = mysqli_fetch_array($paySql);
			
			// total debt transactions
			$queryDebt = "SELECT SUM(trxTotal) as trxTotal, SUM(trxDP) as trxDP FROM as_buy_transactions WHERE trxDate = '$dateNow' AND trxStatus = '2'";
			$sqlDebt = mysqli_query($connect, $queryDebt);
			$dtDebt = mysqli_fetch_array($sqlDebt);
			
			$debtQuery = "SELECT SUM(debtPay) as payTotal FROM as_debts_payment WHERE debtDate = '$dateNow'";
			$debtSql = mysqli_query($connect, $debtQuery);
			$debtData = mysqli_fetch_array($debtSql);
			
			$totalDebt = $dtDebt['trxTotal'] - $dtDebt['trxDP'];
			
			$totalPay = $dtTermin['trxTotal'] - $dtTermin['trxPay'];
			
			$trxTotal = rupiah($dtOrder['trxTotal']);
			$trxTotalTermin = rupiah($dtTermin['trxTotal']);
			$fundAmount = rupiah($dtFund['fundAmount']);
			$payment = rupiah($payData['payTotal']);
			
			$rab = $dtOrder['trxSubtotal'] - $dtOrder['trxTotalModal'];
			
			$date = explode("-", $dateNow);
			
			$dataOrder[] = array(	'no' => $n,
									'trxDate' => $date[2]."/".$date[1]."/".$date[0],
									'trxTotal' => $trxTotal,
									'trxFund' => $fundAmount,
									'trxTotalTermin' => rupiah($totalPay),
									'trxTotalDebt' => rupiah($totalDebt),
									'trxRabat' => rupiah($rab),
									'trxPayment' => $payment,
									'trxPayDebt' => rupiah($debtData['payTotal'])
									);
			
			$grandTotal = $grandTotal + $dtOrder['trxTotal'];
			$grandTotalTermin = $grandTotalTermin + $totalPay;
			$grandTotalDebt = $grandTotalDebt + $totalDebt;
			$grandFundAmount = $grandFundAmount + $dtFund['fundAmount'];
			$grandRabat = $grandRabat + $rab;
			$grandPayment = $grandPayment + $payData['payTotal'];
			$grandPayDebt = $grandPayDebt + $debtData['payTotal'];
			$n++;
		}

		//$grandTotalRp = rupiah($grandTotal);
		//$grandTotalTerminRp = rupiah($grandTotalTermin);
		//$grandFundAmountRp = rupiah($grandFundAmount);
		//$grandRabatRp = rupiah($grandRabat);
		//$grandPaymentRp = rupiah($grandPayment);
		
		// assign to the tpl
		$smarty->assign("trxTotal", rupiah($total));
		$smarty->assign("dataOrder", $dataOrder);
		$smarty->assign("startDate", tgl_indo($startDate));
		$smarty->assign("endDate", tgl_indo($endDate));
		$smarty->assign("start", $startDate);
		$smarty->assign("end", $endDate);
		$smarty->assign("grandTotalRp", rupiah($grandTotal));
		$smarty->assign("grandTotalTerminRp", rupiah($grandTotalTermin));
		$smarty->assign("grandFundAmountRp", rupiah($grandFundAmount));
		$smarty->assign("grandRabatRp", rupiah($grandRabat));
		$smarty->assign("grandPaymentRp", rupiah($grandPayment));
		$smarty->assign("grandPayDebtRp", rupiah($grandPayDebt));
		$smarty->assign("grandTotalDebtRp", rupiah($grandTotalDebt));
	}
		
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>