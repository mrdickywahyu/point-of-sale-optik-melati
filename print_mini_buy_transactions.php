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
	$invoiceID = $_GET['invoiceBuyID'];
	$trxID = $_GET['trxID'];
	
	$filename="buy_transaction-".$now."-".$invoiceID.".pdf";
	$content = ob_get_clean();
	
	$queryTrx = "SELECT * FROM as_buy_transactions WHERE trxID = '$trxID' AND invoiceBuyID = '$invoiceID'";
	$sqlTrx = mysqli_query($connect, $queryTrx);
	$dataTrx = mysqli_fetch_array($sqlTrx);
	
	$subtotal = rupiah($dataTrx['trxSubtotal']);
	$discount = rupiah($dataTrx['trxDiscount']);
	$total = rupiah($dataTrx['trxTotal']);
	$trxDP = rupiah($dataTrx['trxDP']);
	$trxDebt = rupiah($dataTrx['trxTotal'] - $dataTrx['trxDP']);
	$trxPPN = rupiah($dataTrx['trxPPN']);
	
	$totalBilang = Terbilang($dataTrx['trxTotal']);
	$dateNow = tgl_indo($dataTrx['trxDate']);
	
	$trxAddress = strtoupper($dataTrx['trxAddress']);
	
	if ($dataTrx['trxStatus'] == '1'){
		$status = "CASH";
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
		$pkpDate = "TGL. PENGUKUHAN PKP : ".tgl_indo2($dataIdentity['identityPKPDate']);
	}
	else{
		$pkpDate = "";
	}
	
	$idName = strtoupper($dataIdentity['identityName']);
	$idAddress = strtoupper($dataIdentity['identityAddress']);
	$idEmail = strtoupper($dataIdentity['identityEmail']);
	$trxFullName = strtoupper($dataTrx['trxFullName']);
	$userFullName = strtoupper($_SESSION['userFullName']);
	
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
				<span style='font-size: 10pt;'>PEMBELIAN<br>#$dataTrx[invoiceBuyID], $status $terminDate <br><br>
					SUPPLIER : <br>
					$dataTrx[invoiceSupplier]<br>
					$dataTrx[supplierID] $trxFullName <br>
					$trxAddress <br>
					TLP. $dataTrx[trxPhone]
				</span>
				<br><br>
				<table cellpadding='0' cellspacing='0' style='width: 76mm; border-top: 1px dashed #000000;'>
				";
				
				
				// showing up the service
				$queryDetail = "SELECT A.detailID, A.invoiceBuyID, A.productBarcode, A.detailBuyPrice, A.detailBuyQty, A.detailBuySubtotal, B.productName 
				FROM as_buy_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceBuyID = '$invoiceID'";
				
				$i = 1;
				$sqlDetail = mysqli_query($connect, $queryDetail);
				while ($dataDetail = mysqli_fetch_array($sqlDetail))
				{
					$detailPrice = rupiah($dataDetail['detailBuyPrice']);
					$detailSubtotal = rupiah($dataDetail['detailBuySubtotal']);
					$productName = strtoupper($dataDetail['productName']);
					
					$content .= "
						<tr valign='top'>
							<td style='padding: 2px 5px 3px 0px; font-size: 10pt; width: 40mm;'>$productName</td>
							<td style='padding: 2px 5px 3px 5px; font-size: 10pt; width: 1mm;' align='center'>$dataDetail[detailBuyQty]</td>
							<td style='padding: 2px 5px 3px 5px; font-size: 10pt; width: 10mm;' align='right'>$detailPrice</td>
							<td style='padding: 2px 5px 3px 5px; font-size: 10pt; width: 10mm;' align='right'>$detailSubtotal</td>
						</tr>
					";
					$i++;
				}
					
			$content .= "
					<tr>
						<td colspan='3' align='right' style='font-size: 10pt; padding: 3px 5px 3px 0px; border-top: 1px dashed #000000;'>TOTAL</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px; border-top: 1px dashed #000000;' align='right'>$subtotal</td>
					</tr>
					<tr>
						<td colspan='3' align='right' style='font-size: 10pt; padding: 3px 5px 3px 0px;'>DISKON</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px;' align='right'>$discount</td>
					</tr>
					<tr>
						<td colspan='3' align='right' style='font-size: 10pt; padding: 3px 5px 3px 0px;'>GRANDTOTAL</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px;' align='right'>$total</td>
					</tr>
					<tr>
						<td colspan='3' align='right' style='padding: 3px 5px 3px 0px; font-size: 10pt;'>TITIP BAYAR</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px;' align='right'>$trxDP</td>
					</tr>
					<tr>
						<td colspan='3' align='right' style='font-size: 10pt; padding: 3px 5px 3px 0px;'>SISA BAYAR</td>
						<td style='font-size: 10pt; padding: 3px 5px 3px 0px;' align='right'>$trxDebt</td>
					</tr>
			</table>
			<br><br>
			<div style='width: 76mm; text-align: center; font-size: 10pt;'>
				=== TERIMA KASIH ===
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