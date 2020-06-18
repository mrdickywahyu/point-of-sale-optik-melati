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
		$status = "Cash";
		$textTermin = "";
		$dotTermin = "";
		$terminDate = "";
	}
	elseif ($dataTrx['trxStatus'] == '2'){
		$status = "Pending";
		$textTermin = "";
		$dotTermin = "";
		$terminDate = "";
	}
	else{
		$status = "Termin";
		$textTermin = "Jatuh Tempo";
		$dotTermin = ":";
		$terminDate = tgl_indo($dataTrx['trxTerminDate']);
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
	
	$userPrint = mysqli_fetch_array(mysqli_query($connect, "SELECT userNIP, userFullName FROM as_users WHERE userID = '$_SESSION[userID]'"));
	
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
						<td style='width: 118mm; font-size: 12pt;'><b>Faktur Penjualan</b></td>
						<td style='width: 118mm; font-size: 12pt;' align='right'>Cirebon, $dateNow</td>
					</tr>
				</table>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
					<tr>
						<td style='width: 29mm; font-size: 12pt;'>Nomor Faktur</td>
						<td style='width: 1mm; font-size: 12pt;'>:</td>
						<td style='width: 95mm; font-size: 12pt;'>$dataTrx[invoiceID]</td>
						<td style='width: 29mm; font-size: 12pt;'>Kepada Yth :</td>
						<td style='width: 1mm; font-size: 12pt;'></td>
						<td style='width: 85mm; font-size: 12pt;'></td>
					</tr>
					<tr valign='top'>
						<td style='font-size: 12pt;'>Tipe Bayar</td>
						<td style='font-size: 12pt;'>:</td>
						<td style='font-size: 12pt;'>$status</td>
						<td colspan='3' style='font-size: 12pt;'>$dataTrx[trxFullName]</td>
					</tr>
					<tr>
						<td style='font-size: 12pt;'>$textTermin</td>
						<td style='font-size: 12pt;'>$dotTermin</td>
						<td style='font-size: 12pt;'>$terminDate</td>
						<td colspan='3' style='font-size: 12pt;'>$trxAddress</td>
					</tr>
					<tr>
						<td colspan='3'></td>
						<td colspan='3' style='font-size: 12pt;'>$dataTrx[trxPhone]</td>
					</tr>
				</table>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
					<tr>
						<th align='center' style='font-size: 12pt; width: 10mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>No.</th>
						<th align='center' style='font-size: 12pt; width: 38mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Kode Produk</th>
						<th align='center' style='font-size: 12pt; width: 85mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Nama Produk</th>
						<th align='center' style='font-size: 12pt; width: 33mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Harga Satuan</th>
						<th align='center' style='font-size: 12pt; width: 25mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Disc (%)</th>
						<th align='center' style='font-size: 12pt; width: 15mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Qty</th>
						<th align='center' style='font-size: 12pt; width: 33mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Subtotal</th>
					</tr>";
					
					// showing up the service
					$queryDetail = "SELECT A.detailID, A.invoiceID, A.productBarcode, A.detailPrice, A.detailQty, A.detailSubtotal, B.productName, A.note, A.discPercent 
					FROM as_sales_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceID = '$invoiceID'";
					
					$i = 1;
					$sqlDetail = mysqli_query($connect, $queryDetail);
					while ($dataDetail = mysqli_fetch_array($sqlDetail))
					{
						$detailPrice = rupiah($dataDetail['detailPrice']);
						$detailSubtotal = rupiah($dataDetail['detailSubtotal']);
						$productName = chunk_split($dataDetail['productName'], 42, "<br>");
						
						$content .= "
							<tr>
								<td style='padding: 5px; font-size: 12pt; '>$i</td>
								<td style='padding: 5px; font-size: 12pt; '>$dataDetail[productBarcode]</td>
								<td style='padding: 5px; font-size: 12pt; '>$productName</td>
								<td style='padding: 5px; font-size: 12pt; ' align='right'>$detailPrice</td>
								<td style='padding: 5px; font-size: 12pt; ' align='center'>$dataDetail[discPercent]</td>
								<td style='padding: 5px; font-size: 12pt; ' align='center'>$dataDetail[detailQty]</td>
								<td style='padding: 5px; font-size: 12pt; ' align='right'>$detailSubtotal</td>
							</tr>
						";
						$i++;
					}
		$content .= 
					"<tr>
						<td colspan='6' align='right' style='font-size: 12pt; padding: 5px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Total</td>
						<td style='font-size: 12pt; padding: 5px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;' align='right'>$subtotal</td>
					</tr>
					<tr>
						<td colspan='6' align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'>Total Diskon</td>
						<td style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;' align='right'>$discount</td>
					</tr>
					<tr>
						<td colspan='6' align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'>PPN ($dataIdentity[identityPPN]%)</td>
						<td style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;' align='right'>$trxPPN</td>
					</tr>
					<tr>
						<td colspan='6' align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'><b>Grandtotal</b></td>
						<td style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;' align='right'><b>$total</b></td>
					</tr>
					<tr>
						<td colspan='6' align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'>Bayar</td>
						<td style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;' align='right'>$trxPay</td>
					</tr>
					<tr>
						<td colspan='6' align='right' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'>Kembali</td>
						<td style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;' align='right'>$trxChange</td>
					</tr>
					<tr>
						<td colspan='7' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'><i>Terbilang : $totalBilang Rupiah</i></td>
					</tr>
					<tr>
						<td align='right' style='font-size: 12pt;' colspan='7'>*** $userPrint[userNIP] - $userPrint[userFullName] ***</td>
					</tr>
				</table>
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