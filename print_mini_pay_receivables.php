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
	ob_start();
	require ("includes/html2pdf/html2pdf.class.php");
	
	$now = date('Y-m-d');
	$invoiceID = $_GET['invoiceID'];
	$outletID = $_SESSION['outletID'];
	$receivableID = $_GET['receivableID'];
	
	$filename="pay_receivables-".$now."-".$invoiceID.".pdf";
	$content = ob_get_clean();
	
	$queryTrx = "SELECT * FROM as_sales_transactions WHERE invoiceID = '$invoiceID' AND outletID = '$outletID'";
	$sqlTrx = mysqli_query($connect, $queryTrx);
	$dataTrx = mysqli_fetch_array($sqlTrx);
	
	$subtotal = rupiah($dataTrx['trxSubtotal']);
	$discount = rupiah($dataTrx['trxDiscount']);
	$total = rupiah($dataTrx['trxTotal']);
	$trxPay = rupiah($dataTrx['trxPay']);
	$trxChange = rupiah($dataTrx['trxChange']);
	$trxPPN = rupiah($dataTrx['trxPPN']);
	
	$totalBilang = Terbilang($dataTrx['trxTotal']);
	$dateNow = tgl_indo($dataTrx['trxDate']);
	
	$trxAddress = chunk_split($dataTrx['trxAddress'], 50, "<br>");
	
	if ($dataTrx['trxStatus'] == '1'){
		$status = "CASH";
		$textTermin = "";
		$dotTermin = "";
		$terminDate = "";
	}
	elseif ($dataTrx['trxStatus'] == '2'){
		$status = "PENDING";
		$textTermin = "";
		$dotTermin = "";
		$terminDate = "";
	}
	else{
		$status = "TERMIN";
		$textTermin = "Jatuh Tempo";
		$dotTermin = ":";
		$terminDate = tgl_indo2($dataTrx['trxTerminDate']);
	}
	
	// npwp
	if ($dataIdentity['identityNPWP'] != ''){
		$npwp = "NPWP : $dataIdentity[identityNPWP] <br>";
	}
	else{
		$npwp = "";
	}
	
	// pkp
	if ($dataIdentity['identityPKP'] != ''){
		$pkp = "PKP : $dataIdentity[identityPKP] <br>";
	}
	else{
		$pkp = "";
	}
	
	// pkp date
	if ($dataIdentity['identityPKPDate'] != '0000-00-00'){
		$pkpDate = "Tgl. Pengukuhan PKP : ".tgl_indo2($dataIdentity['identityPKPDate']);
	}
	else{
		$pkpDate = "";
	}
	
	$idName = strtoupper($dataIdentity['identityName']);
	$idAddress = strtoupper($dataIdentity['identityAddress']);
	$idEmail = strtoupper($dataIdentity['identityEmail']);
	
	$queryReceivable = "SELECT B.trxStatus, A.invoiceID, A.receivableID, B.trxDate, B.memberID, B.trxFullName, B.trxAddress, B.trxPhone,
	B.trxSubtotal, B.trxDiscount, B.trxTotalModal, B.trxPPN, B.trxTotal, B.trxPay, B.trxChange, B.trxTerminDate, B.nopol, A.status FROM as_receivables A 
	INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID 
	WHERE A.receivableID = '$receivableID' AND A.invoiceID = '$invoiceID'";
	$sqlReceivable = mysqli_query($connect, $queryReceivable);
	$dataReceivable = mysqli_fetch_array($sqlReceivable);
	
	if ($dataReceivable['trxStatus'] == '1'){
		$status = "CASH";
	}
	elseif ($dataReceivable['trxStatus'] == '2'){
		$status = "PENDING";
	}
	else{
		$status = "TERMIN";
	}
	
	$userFullName = strtoupper($_SESSION['userFullName']);
	$totalHarusBayar = $dataReceivable['trxTotal'] - $dataReceivable['trxPay'];
	$totalSisa = rupiah($totalHarusBayar);
	
	$content = "<table style='border-bottom: 1px dashed #000000; padding-bottom: 5px; width: 76mm;'>
					<tr valign='top'>
						<td style='width: 76mm;' valign='middle'>
							<div style='font-size: 11pt; text-align: center;'>
								$idName
								<br><br>
								<span style='font-size: 10pt;'>$idAddress<br>
								$npwp $pkp $pkpDate
								</span>
							</div>
						</td>
					</tr>
				</table>
				<table style='border-bottom: 1px dashed #000000; width: 76mm;'>
					<tr>
						<td style='width: 37mm; font-size: 10pt;'>$dataTrx[createdDate]</td>
						<td style='width: 38mm; font-size: 10pt;' align='right'>$_SESSION[userNIP]<br>$userFullName</td>
					</tr>
				</table>
				<br>
				<span style='font-size: 10pt;'>PENJUALAN<br>#$dataTrx[invoiceID], $status $terminDate <br> NOPOL : $dataTrx[nopol]</span>
				<br><br>
				<table cellpadding='0' cellspacing='0' style='width: 76mm;'>
					<tr>
						<td align='right' style='font-size: 10pt; padding: 3px 5px 3px 0px;'>TOTAL</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 30px;' align='right'>$subtotal</td>
					</tr>
					<tr>
						<td align='right' style='font-size: 10pt; padding: 5px;'>INC. DISKON</td>
						<td style='font-size: 10pt; padding: 5px;' align='right'>($discount)</td>
					</tr>
					<tr>
						<td align='right' style='font-size: 10pt; padding: 3px 5px 3px 0px;'>PPN ($dataIdentity[identityPPN]%)</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px;' align='right'>$trxPPN</td>
					</tr>
					<tr>
						<td align='right' style='font-size: 10pt; padding: 3px 5px 3px 0px;'>GRANDTOTAL</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px;' align='right'>$total</td>
					</tr>
					<tr>
						<td align='right' style='padding: 3px 5px 3px 0px; font-size: 10pt;'>BAYAR</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px;' align='right'>$trxPay</td>
					</tr>
					<tr>
						<td align='right' style='font-size: 10pt; padding: 3px 5px 3px 0px;'>TERUTANG</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px;' align='right'>$totalSisa</td>
					</tr>
			</table><br>
			<table style='width: 76mm;'>
				<tr>
					<td style='width: 76mm; font-size: 11pt;'>RINCIAN PEMBAYARAN</td>
				</tr>
			</table>
			<table style='width: 76mm;'>
			";
			// showing up the payment
			$queryPayment = "SELECT * FROM as_receivables_payment WHERE outletID = '$outletID' AND receivableID = '$receivableID'";
			$sqlPayment = mysqli_query($connect, $queryPayment);
			
			// fetch data
			$i = 1;
			while ($dtPayment = mysqli_fetch_array($sqlPayment))
			{
				$payDate = tgl_indo2($dtPayment['receivableDate']);
				$pay = rupiah($dtPayment['receivablePay']);
				$terbilang = Terbilang($dtPayment['receivablePay']);
				$content .= "
					<tr>
						<td style='font-size: 10pt; padding: 5px 0px 5px 0px; width: 5mm;'>$i.</td>
						<td style='font-size: 10pt; padding: 5px 0px 5px 0px; width: 30mm;'>$payDate</td>
						<td style='font-size: 10pt; padding: 5px 0px 5px 0px; text-align: right; border-bott'>$pay</td>
					</tr>";
				$tot = $tot + $dtPayment['receivablePay'];
				$i++;
			}
			$payQuery = "SELECT SUM(receivablePay) as payTotal FROM as_receivables_payment WHERE receivableID = '$receivableID' AND outletID = '$outletID'";
			$paySql = mysqli_query($connect, $payQuery);
			$payData = mysqli_fetch_array($paySql);
			
			$totalPay = $dataReceivable['trxPay'] + $payData['payTotal'];
			
			$totalSisa = $dataReceivable['trxTotal'] - $totalPay;
			
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
				<td style='font-size: 9pt; padding: 5px 0px 5px 0px;'></td>
				<td style='font-size: 9pt; padding: 5px 0px 5px 0px;'></td>
				<td style='font-size: 10pt; padding: 5px 0px 5px 0px; text-align: right; border-top: 1px solid #000000;'>$totalPayRp</td>
			</tr>
			</table>
			<p style='font-size: 10pt;'>SISA BAYAR : RP. $sisa</p>
			<br><br>
			<div style='width: 76mm; text-align: center; font-size: 10pt;'>
				TERIMA KASIH <br><br>
				=== LAYANAN KONSUMEN ===<br>
				TLP. $dataIdentity[identityPhone]<br>
				EMAIL: $idEmail <br>
			</div>
			";
			
	ob_end_clean();
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('p', array('79', '297'),'en', false, 'ISO-8859-15',array(0, 0, 0, 0)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>