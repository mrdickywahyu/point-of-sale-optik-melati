<?php
include "header.php";

// if session is null, showing up the text and exit
if ($_SESSION['userName'] == '' && $_SESSION['userPassword'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else{
	if ($_SESSION['userLevel'] != '1'){
		echo "You have not authorization for access the modules.";
		exit();
	}
	
	ob_start();
	require ("includes/html2pdf/html2pdf.class.php");
	
	$now = date('Y-m-d');
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
	$start = tgl_indo2($startDate);
	$end = tgl_indo2($endDate);
	
	$filename="laporan-pendapatan-".$startDate."-".$endDate.".pdf";
	$content = ob_get_clean();
	
	$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 210mm;'>
					<tr valign='top'>
						<td style='width: 206mm;' valign='middle'>
							<div style='font-weight: bold; padding-bottom: 5px; font-size: 13pt;'>
								$dataIdentity[identityName]
							</div>
							<span style='font-size: 10pt;'>$dataIdentity[identityAddress], Telp. $dataIdentity[identityPhone], Email: $dataIdentity[identityEmail]</span>
						</td>
					</tr>
				</table>
				<p style='text-align: center; width: 206mm; font-size: 10pt;'><b><u>Laporan Pendapatan</u></b> <br><span style='font-size: 10pt;'>$start s/d $end</span></p>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 206mm;'>
					<tr>
						<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>No.</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Tanggal</th>
						<th style='width: 31mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Total Transaksi</th>
						<th style='width: 31mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Total Piutang</th>
						<th style='width: 49mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Total Penerimaan Piutang</th>
						<th style='width: 31mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Total Hutang</th>
						<th style='width: 49mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Total Pembayaran Hutang</th>
						<th style='width: 31mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Total Rabat</th>
						<th style='width: 31mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Total Biaya</th>
					</tr>";
					
					$n = 1;
					for ($i = strtotime($startDate); $i <= strtotime($endDate); $i += 86400){
						$dateNow = date('Y-m-d', $i);
						$dateNowIndo = explode("-", $dateNow);
						
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
						$payDebt = rupiah($debtData['payTotal']);
						$totalDebtRp = rupiah($totalDebt);
						$totalPayRp = rupiah($totalPay);
						
						$rab = $dtOrder['trxSubtotal'] - $dtOrder['trxTotalModal'];
						$rabat = rupiah($rab);
						
						$content .= "
							<tr>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$n</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dateNowIndo[2]/$dateNowIndo[1]/$dateNowIndo[0]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$trxTotal</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$totalPayRp</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$payment</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$totalDebtRp</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$payDebt</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$rabat</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$fundAmount</td>
							</tr>
						";
						
						$grandTotal = $grandTotal + $dtOrder['trxTotal'];
						$grandTotalTermin = $grandTotalTermin + $totalPay;
						$grandTotalDebt = $grandTotalDebt + $totalDebt;
						$grandFundAmount = $grandFundAmount + $dtFund['fundAmount'];
						$grandRabat = $grandRabat + $rab;
						$grandPayment = $grandPayment + $payData['payTotal'];
						$grandPayDebt = $grandPayDebt + $debtData['payTotal'];
						$n++;
					}
					$grandTotalRp = rupiah($grandTotal);
					$grandTotalTerminRp = rupiah($grandTotalTermin);
					$grandFundAmountRp = rupiah($grandFundAmount);
					$grandRabatRp = rupiah($grandRabat);
					$grandPaymentRp = rupiah($grandPayment);
					$grandPayDebtRp = rupiah($grandPayDebt);
					$grandTotalDebtRp = rupiah($grandTotalDebt);
		$content .= 
					"
					<tr>
						<td style='border-top: 1px solid #999; padding: 5px; font-size: 10pt;' colspan='2'>Rp. </td>
						<td style='border-top: 1px solid #999; padding: 5px; font-size: 10pt;'><b>$grandTotalRp</b></td>
						<td style='border-top: 1px solid #999; padding: 5px; font-size: 10pt;'><b>$grandTotalTerminRp</b></td>
						<td style='border-top: 1px solid #999; padding: 5px; font-size: 10pt;'><b>$grandPaymentRp</b></td>
						<td style='border-top: 1px solid #999; padding: 5px; font-size: 10pt;'><b>$grandTotalDebtRp</b></td>
						<td style='border-top: 1px solid #999; padding: 5px; font-size: 10pt;'><b>$grandPayDebtRp</b></td>
						<td style='border-top: 1px solid #999; padding: 5px; font-size: 10pt;'><b>$grandRabatRp</b></td>
						<td style='border-top: 1px solid #999; padding: 5px; font-size: 10pt;'><b>$grandFundAmountRp</b></td>
					</tr>
				</table>
				
				";
	ob_end_clean();
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('L', 'A4','fr', false, 'ISO-8859-15',array(1, 1, 1, 1)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>