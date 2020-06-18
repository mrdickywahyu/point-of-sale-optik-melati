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
	$invoiceID = $_GET['invoiceID'];
	$outletID = $_SESSION['outletID'];
	$debtID = $_GET['debtID'];
	
	$filename="pay_debts_transaction-".$now."-".$invoiceID.".pdf";
	$content = ob_get_clean();
	
	$queryTrx = "SELECT * FROM as_buy_transactions WHERE invoiceBuyID = '$invoiceID' AND outletID = '$outletID'";
	$sqlTrx = mysqli_query($connect, $queryTrx);
	$dataTrx = mysqli_fetch_array($sqlTrx);
	
	$subtotal = rupiah($dataTrx['trxSubtotal']);
	$discount = rupiah($dataTrx['trxDiscount']);
	$total = rupiah($dataTrx['trxTotal']);
	$trxDP = rupiah($dataTrx['trxDP']);
	
	$totalBilang = Terbilang($dataTrx['trxTotal']);
	$dateNow = tgl_indo($dataTrx['trxDate']);
	
	$trxAddress = chunk_split($dataTrx['trxAddress'], 50, "<br>");
	
	if ($dataTrx['trxStatus'] == '1'){
		$status = "Cash";
		$textTermin = "";
		$dotTermin = "";
		$terminDate = "";
	}
	else{
		$status = "Termin";
		$textTermin = "Jatuh Tempo";
		$dotTermin = ":";
		$terminDate = tgl_indo2($dataTrx['trxTerminDate']);
	}
	
	// npwp
	if ($dataIdentity['identityNPWP'] != ''){
		$npwp = "NPWP : $dataIdentity[identityNPWP]";
	}
	else{
		$npwp = "";
	}
	
	// pkp
	if ($dataIdentity['identityPKP'] != ''){
		$pkp = ", PKP : $dataIdentity[identityPKP]";
	}
	else{
		$pkp = "";
	}
	
	// pkp date
	if ($dataIdentity['identityPKPDate'] != '0000-00-00'){
		$pkpDate = ", Tgl. Pengukuhan PKP : ".tgl_indo2($dataIdentity['identityPKPDate']);
	}
	else{
		$pkpDate = "";
	}
	
	$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 240mm;'>
					<tr valign='top'>
						<td style='width: 237mm;' valign='middle'>
							<div style='font-weight: bold; padding-bottom: 5px; font-size: 13pt;'>
								$dataIdentity[identityName]
							</div>
							<span style='font-size: 11pt;'>$dataIdentity[identityAddress], Telp. $dataIdentity[identityPhone], Email: $dataIdentity[identityEmail] <br>
							$npwp $pkp $pkpDate
							</span>
						</td>
					</tr>
				</table>
				<br>
				<table style='width: 240mm;'>
					<tr>
						<td style='width: 118mm; font-size: 12pt;'><b>Faktur Pembelian</b></td>
						<td style='width: 118mm; font-size: 12pt;' align='right'>Cirebon, $dateNow</td>
					</tr>
				</table>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
					<tr>
						<td style='width: 29mm; font-size: 12pt;'>Nomor Faktur</td>
						<td style='width: 1mm; font-size: 12pt;'>:</td>
						<td style='width: 95mm; font-size: 12pt;'>$dataTrx[invoiceBuyID]</td>
						<td style='width: 29mm; font-size: 12pt;'>Supplier :</td>
						<td style='width: 1mm; font-size: 12pt;'></td>
						<td style='width: 85mm; font-size: 12pt;'></td>
					</tr>
					<tr valign='top'>
						<td style='font-size: 12pt;'>Faktur (Supplier)</td>
						<td style='font-size: 12pt;'>:</td>
						<td style='font-size: 12pt;'>$dataTrx[invoiceSupplier]</td>
						<td colspan='3' style='font-size: 12pt;'>$dataTrx[supplierID] $dataTrx[trxFullName]</td>
					</tr>
					<tr>
						<td style='font-size: 12pt;'>Tipe Bayar</td>
						<td style='font-size: 12pt;'>: </td>
						<td style='font-size: 12pt;'>$status</td>
						<td colspan='3' style='font-size: 12pt;'>$trxAddress</td>
					</tr>
					<tr>
						<td style='font-size: 12pt;'>$textTermin</td>
						<td style='font-size: 12pt;'>$dotTermin</td>
						<td style='font-size: 12pt;'>$terminDate</td>
						<td colspan='3' style='font-size: 12pt;'>$dataTrx[trxPhone]</td>
					</tr>
				</table>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
					";
					
					$queryDebt = "SELECT B.trxStatus, A.invoiceID, A.debtID, B.trxDate, B.supplierID, B.trxFullName, B.trxAddress, B.trxPhone,
					B.trxSubtotal, B.trxDiscount, B.trxTotal, B.trxDP, B.trxTerminDate, A.status FROM as_debts A 
					INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID 
					WHERE A.debtID = '$debtID' AND A.invoiceID = '$invoiceID'";
					$sqlDebt = mysqli_query($connect, $queryDebt);
					$dataDebt = mysqli_fetch_array($sqlDebt);
					
					if ($dataDebt['trxStatus'] == '1'){
						$status = "Cash";
					}
					else{
						$status = "Termin";
					}
					
					$totalHarusBayar = $dataDebt['trxTotal'] - $dataDebt['trxDP'];
					$totalSisa = rupiah($totalHarusBayar);
		$content .= 
					"<tr>
						<td align='right' style='font-size: 12pt; padding: 5px; border-top: 1px solid #999999; border-bottom: 1px solid #999999; width: 30mm;'>Total</td>
						<td align='right' style='font-size: 12pt; padding: 5px; border-top: 1px solid #999999; border-bottom: 1px solid #999999; width: 5mm;'>:</td>
						<td style='font-size: 12pt; padding: 5px; border-top: 1px solid #999999; border-bottom: 1px solid #999999; width: 50mm;' align='right'>$subtotal</td>
						<td style='font-size: 12pt; padding: 5px; border-top: 1px solid #999999; border-bottom: 1px solid #999999; width: 30mm;'></td>
						<td align='right' style='font-size: 12pt; padding: 5px; border-top: 1px solid #999999; border-bottom: 1px solid #999999; width: 30mm;'>Bayar</td>
						<td align='right' style='font-size: 12pt; padding: 5px; border-top: 1px solid #999999; border-bottom: 1px solid #999999; width: 5mm;'>:</td>
						<td style='font-size: 12pt; padding: 5px; border-top: 1px solid #999999; border-bottom: 1px solid #999999; width: 50mm;' align='right'>$trxDP</td>
					</tr>
					<tr>
						<td align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'>Total Diskon</td>
						<td align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'>:</td>
						<td style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;' align='right'>$discount</td>
						<td align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'></td>
						<td align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'><b>Terutang</b></td>
						<td style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;' align='right'>:</td>
						<td style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;' align='right'><b>$totalSisa</b></td>
					</tr>
					<tr>
						<td align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'><b>Grandtotal</b></td>
						<td align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'>:</td>
						<td style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;' align='right'><b>$total</b></td>
						<td align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'></td>
						<td align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'></td>
						<td style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;' align='right'></td>
						<td style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;' align='right'></td>
					</tr>
					<tr>
						<td colspan='7' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'><i>Terbilang : $totalBilang Rupiah</i></td>
					</tr>
				</table>
				
				<br>
				<table style='width: 240mm;'>
					<tr>
						<td style='width: 240mm; font-size: 12pt;'><b>RINCIAN PEMBAYARAN</b></td>
					</tr>
				</table>
				";
				
				$content .= "<br>
				<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
					<tr>
						<th align='center' style='font-size: 12pt; width: 10mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>No.</th>
						<th align='center' style='font-size: 12pt; width: 30mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Tanggal</th>
						<th align='center' style='font-size: 12pt; width: 35mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Bayar</th>
						<th align='center' style='font-size: 12pt; width: 163mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Terbilang</th>
					</tr>";
					// showing up the payment
					$queryPayment = "SELECT * FROM as_debts_payment WHERE outletID = '$outletID' AND debtID = '$debtID'";
					$sqlPayment = mysqli_query($connect, $queryPayment);
					
					// fetch data
					$i = 1;
					while ($dtPayment = mysqli_fetch_array($sqlPayment))
					{
						$payDate = tgl_indo2($dtPayment['debtDate']);
						$pay = rupiah($dtPayment['debtPay']);
						$terbilang = Terbilang($dtPayment['debtPay']);
						$content .= "
							<tr>
								<td style='border-bottom: 1px solid #999999; font-size: 12pt; padding: 5px 0px 5px 0px;'>$i.</td>
								<td style='border-bottom: 1px solid #999999; font-size: 12pt; padding: 5px 0px 5px 0px;'>$payDate</td>
								<td style='border-bottom: 1px solid #999999; font-size: 12pt; padding: 5px 0px 5px 0px; text-align: right;'>$pay</td>
								<td style='border-bottom: 1px solid #999999; font-size: 12pt; padding: 5px 0px 5px 25px;'>$terbilang</td>
							</tr>";
						$tot = $tot + $dtPayment['debtPay'];
						$i++;
					}
					$payQuery = "SELECT SUM(debtPay) as payTotal FROM as_debts_payment WHERE debtID = '$debtID' AND outletID = '$outletID'";
					$paySql = mysqli_query($connect, $payQuery);
					$payData = mysqli_fetch_array($paySql);
					
					$totalPay = $dataDebt['trxDP'] + $payData['payTotal'];
					
					$totalSisa = $dataDebt['trxTotal'] - $totalPay;
					
					$totalPayRp = rupiah($tot);
					
					if ($totalSisa <= '0'){
						$totalSisaIf = "Lunas";
						$sisa = 0;
					}
					else{
						$totalSisaIf = "Belum Lunas";
						$sisa = rupiah($totalSisa);
					}
					$content .= "
					<tr>
						<td style='font-size: 12pt; padding: 5px 0px 5px 0px;'></td>
						<td style='font-size: 12pt; padding: 5px 0px 5px 0px;'>TOTAL BAYAR</td>
						<td style='font-size: 12pt; padding: 5px 0px 5px 0px; text-align: right;'>$totalPayRp</td>
						<td style='font-size: 12pt; padding: 5px 0px 5px 25px;'></td>
					</tr>
				</table><br>
				<p style='font-size: 12pt; font-weight: bold; text-decoration: underline;'>Kurang Bayar : Rp. $sisa</p>
				<div style='width: 235mm; font-size: 12pt; text-align: right;'>*** $_SESSION[userNIP] - $_SESSION[userFullName] ***</div>
				";
	ob_end_clean();
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('p', array('241', '241'),'en', false, 'ISO-8859-15',array(1, 1, 1, 1)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>