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
	$trxID = $_GET['trxID'];
	
	$filename="sales_transaction-".$now."-".$invoiceID.".pdf";
	$content = ob_get_clean();
	
	$queryTrx = "SELECT * FROM as_sales_transactions WHERE trxID = '$trxID' AND invoiceID = '$invoiceID'";
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
	
	$userPrint = mysqli_fetch_array(mysqli_query($connect, "SELECT userNIP, userFullName FROM as_users WHERE userID = '$_SESSION[userID]'"));
	
	$idName = strtoupper($dataIdentity['identityName']);
	$idAddress = strtoupper($dataIdentity['identityAddress']);
	$idEmail = strtoupper($dataIdentity['identityEmail']);
	$userFullName = strtoupper($userPrint['userFullName']);
	
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
						<td style='width: 38mm; font-size: 10pt;' align='right'>$userPrint[userNIP]<br>$userFullName</td>
					</tr>
				</table>
				<br>
				<span style='font-size: 10pt;'>PENJUALAN<br>#$dataTrx[invoiceID], $status $terminDate</span>
				<br><br>
				<table cellpadding='0' cellspacing='0' style='width: 76mm;'>
				";
				
				
				// showing up the service
				$queryDetail = "SELECT A.detailID, A.invoiceID, A.productBarcode, A.detailPrice, A.detailQty, A.detailSubtotal, B.productName, A.note, A.discPercent 
				FROM as_sales_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceID = '$invoiceID'";
				
				$i = 1;
				$sqlDetail = mysqli_query($connect, $queryDetail);
				while ($dataDetail = mysqli_fetch_array($sqlDetail))
				{
					$detailPrice = rupiah($dataDetail['detailPrice']);
					$detailSubtotal = rupiah($dataDetail['detailSubtotal']);
					$productName = strtoupper($dataDetail['productName']);
					
					$content .= "
						<tr valign='top'>
							<td style='padding: 2px 5px 3px 0px; font-size: 10pt; width: 39mm;'>$productName</td>
							<td style='padding: 2px 5px 3px 5px; font-size: 10pt; width: 1mm;' align='center'>$dataDetail[detailQty]</td>
							<td style='padding: 2px 5px 3px 5px; font-size: 10pt; width: 10mm;' align='right'>$detailPrice</td>
							<td style='padding: 2px 5px 3px 5px; font-size: 10pt; width: 10mm;' align='right'>$detailSubtotal</td>
						</tr>
					";
					$i++;
				}
					
			$content .= "
					<tr>
						<td colspan='3' align='right' style='font-size: 10pt; padding: 5px; border-bottom: 1px dashed #000000;'>INC. DISKON</td>
						<td style='font-size: 10pt; padding: 5px; border-bottom: 1px dashed #000000;' align='right'>($discount)</td>
					</tr>
					<tr>
						<td colspan='3' align='right' style='font-size: 10pt; padding: 3px 5px 3px 0px; border-bottom: 1px dashed #000000;'>TOTAL</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px; border-bottom: 1px dashed #000000;' align='right'>$subtotal</td>
					</tr>
					<tr>
						<td colspan='3' align='right' style='font-size: 10pt; padding: 3px 5px 3px 0px;'>PPN ($dataIdentity[identityPPN]%)</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px;' align='right'>$trxPPN</td>
					</tr>
					<tr>
						<td colspan='3' align='right' style='font-size: 10pt; padding: 3px 5px 3px 0px;'>GRANDTOTAL</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px;' align='right'>$total</td>
					</tr>
					<tr>
						<td colspan='3' align='right' style='padding: 3px 5px 3px 0px; font-size: 10pt;'>BAYAR</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px;' align='right'>$trxPay</td>
					</tr>
					<tr>
						<td colspan='3' align='right' style='font-size: 10pt; padding: 3px 5px 3px 0px;'>KEMBALI</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px;' align='right'>$trxChange</td>
					</tr>
			</table>
			<br><br>
			<div style='width: 76mm; text-align: center; font-size: 10pt;'>
				TERIMA KASIH & SELAMAT BELANJA KEMBALI <br><br>
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