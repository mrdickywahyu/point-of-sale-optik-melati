<?php
// include header
include "header.php";
// set the tpl page
$page = "profit_reports.tpl";

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
	
	// if module is profit report and action is search
	if ($module == 'profit' && $act == 'search')
	{
		// get method value and change into variables
		
		for ($i = 01; $i <= 12; $i++){
			
			if ($i < 10){
				$start = "0".$i;
			}
			else{
				$start = $i;
			}
			
			$year = $_GET['year']."-".$start;
			
			$queryProfit = "SELECT SUM(trxTotal) as trxTotal, SUM(trxSubtotal) as trxSubtotal, SUM(trxTotalModal) as trxTotalModal FROM as_sales_transactions WHERE trxDate LIKE '$year%'";
			$sqlProfit = mysqli_query($connect, $queryProfit);
			$dtProfit = mysqli_fetch_array($sqlProfit);
			
			$queryProfitTermin = "SELECT SUM(trxTotal) as trxTotal, SUM(trxPay) as trxPay FROM as_sales_transactions WHERE trxStatus = '3' AND trxDate LIKE '$year%'";
			$sqlProfitTermin = mysqli_query($connect, $queryProfitTermin);
			$dtProfitTermin = mysqli_fetch_array($sqlProfitTermin);
			
			$payQuery = "SELECT SUM(receivablePay) as payTotal FROM as_receivables_payment WHERE receivableDate LIKE '$year%'";
			$paySql = mysqli_query($connect, $payQuery);
			$payData = mysqli_fetch_array($paySql);
			
			$debtQuery = "SELECT SUM(debtPay) as payTotal FROM as_debts_payment WHERE debtDate LIKE '$year%'";
			$debtSql = mysqli_query($connect, $debtQuery);
			$debtData = mysqli_fetch_array($debtSql);
			
			$grandTotalProfit1 = $dtProfit['trxTotal'] - $dtProfit['trxTotalModal'];
			$grandTotalProfit2 = $dtProfitTermin['trxTotal'] - $dtProfitTermin['trxTotalModal'];
			
			$grandRabat = $dtProfit['trxSubtotal'] - $dtProfit['trxTotalModal'];
			
			$grandTotalProfit = ($dtProfit['trxTotal'] + $dtProfitTermin['trxTotal']) - $dtProfitTermin['trxPay'];
			
			$grandMinPiutang = $grandTotalProfit - $payData['payTotal'];
			
			$totalPay = $dtProfitTermin['trxTotal'] - $dtProfitTermin['trxPay'];
			$minSubtotal = $dtProfit['trxTotal'] - $totalPay;
			
			$dataProfit[] = array(	'period' => $year,
									'trxTotal' => rupiah($dtProfit['trxTotal']),
									'trxTotalTermin' => rupiah($totalPay),
									'trxPayment' => rupiah($payData['payTotal']),
									'trxPaymentDebt' => rupiah($debtData['payTotal']),
									'grandTotalProfitRp' => rupiah($minSubtotal),
									'grandMinPiutang' => rupiah($grandMinPiutang),
									'grandRabat' => $grandRabat,
									'grandRabatRp' => rupiah($grandRabat));
		}
		
		$smarty->assign("dataProfit", $dataProfit);
		$smarty->assign("yr", $_GET['year']);
		
		// showing up the accounts
		$queryAccount = "SELECT * FROM as_accounts WHERE accountStatus = 'Y' ORDER BY accountCode, accountName ASC";
		$sqlAccount = mysqli_query($connect, $queryAccount);
		
		// fetch data
		while ($dtAccount = mysqli_fetch_array($sqlAccount))
		{
			$dataFund = array();
			$dataFund2 = array();
			$c = array();
			
			for ($i = 01; $i <= 12; $i++){
			
				if ($i < 10){
					$startAccount = $_GET['year']."-0".$i;
				}
				else{
					$startAccount = $_GET['year']."-".$i;
				}
				
				// showing up the funds
				$queryFund = "SELECT SUM(fundAmount) as fundAmount, fundID FROM as_funds WHERE accountID = '$dtAccount[accountID]' AND fundDate LIKE '$startAccount%'";
				$sqlFund = mysqli_query($connect, $queryFund);
				$dtFund = mysqli_fetch_array($sqlFund);
				
				$dataFund[] = array('fundID' => $dtFund['fundID'],
									'fundAmount' => $dtFund['fundAmount'],
									'fundAmountRp' => rupiah($dtFund['fundAmount']),
									'start' => $startAccount);
				$c[] = $dtFund['fundAmount'];
				//$acc = array_sum($dataFund2);
				//$c[] = $acc;
			}
			
			$jan = $jan + $c[0];
			$feb = $feb + $c[1];
			$mar = $mar + $c[2];
			$apr = $apr + $c[3];
			$may = $may + $c[4];
			$jun = $jun + $c[5];
			$jul = $jul + $c[6];
			$aug = $aug + $c[7];
			$sep = $sep + $c[8];
			$oct = $oct + $c[9];
			$nov = $nov + $c[10];
			$dec = $dec + $c[11];
			
			// save data into array
			$dataAccount[] = array(	'accountID' => $dtAccount['accountID'],
									'accountCode' => $dtAccount['accountCode'],
									'accountName' => $dtAccount['accountName'],
									'fund' => $dataFund);
			//echo web_debug($dataFund2);
			
			
			$smarty->assign("c", $c);
			
			$k++;
		}


		// count netto
		$totJan = $dataProfit[0]['grandRabat'] - $jan;
		$totFeb = $dataProfit[1]['grandRabat'] - $feb;
		$totMar = $dataProfit[2]['grandRabat'] - $mar;
		$totApr = $dataProfit[3]['grandRabat'] - $apr;
		$totMay = $dataProfit[4]['grandRabat'] - $may;
		$totJun = $dataProfit[5]['grandRabat'] - $jun;
		$totJul = $dataProfit[6]['grandRabat'] - $jul;
		$totAug = $dataProfit[7]['grandRabat'] - $aug;
		$totSep = $dataProfit[8]['grandRabat'] - $sep;
		$totOct = $dataProfit[9]['grandRabat'] - $oct;
		$totNov = $dataProfit[10]['grandRabat'] - $nov;
		$totDec = $dataProfit[11]['grandRabat'] - $dec;
		
		// assign to the tpl
		$smarty->assign("dataAccount", $dataAccount);
		$smarty->assign("jan", rupiah($jan));
		$smarty->assign("feb", rupiah($feb));
		$smarty->assign("mar", rupiah($mar));
		$smarty->assign("apr", rupiah($apr));
		$smarty->assign("may", rupiah($may));
		$smarty->assign("jun", rupiah($jun));
		$smarty->assign("jul", rupiah($jul));
		$smarty->assign("aug", rupiah($aug));
		$smarty->assign("sep", rupiah($sep));
		$smarty->assign("oct", rupiah($oct));
		$smarty->assign("nov", rupiah($nov));
		$smarty->assign("dec", rupiah($dec));
		
		$smarty->assign("totJan", rupiah($totJan));
		$smarty->assign("totFeb", rupiah($totFeb));
		$smarty->assign("totMar", rupiah($totMar));
		$smarty->assign("totApr", rupiah($totApr));
		$smarty->assign("totMay", rupiah($totMay));
		$smarty->assign("totJun", rupiah($totJun));
		$smarty->assign("totJul", rupiah($totJul));
		$smarty->assign("totAug", rupiah($totAug));
		$smarty->assign("totSep", rupiah($totSep));
		$smarty->assign("totOct", rupiah($totOct));
		$smarty->assign("totNov", rupiah($totNov));
		$smarty->assign("totDec", rupiah($totDec));
		
		// showing up the year
		for ($i = date('Y'); $i >= 2014; $i--)
		{
			$tahun[] = $i;
		}
		
		$smarty->assign("tahun", $tahun);
	}
	
	else{
		// showing up the year
		for ($i = date('Y'); $i >= 2014; $i--)
		{
			$tahun[] = $i;
		}
		
		$smarty->assign("tahun", $tahun);
	}
	
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>