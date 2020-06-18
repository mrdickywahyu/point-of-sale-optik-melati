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
	$invoiceID = $_GET['invoiceReturID'];
	$trxID = $_GET['trxID'];
	
	$filename="retur_transaction-".$now."-".$invoiceID.".pdf";
	$content = ob_get_clean();
	
	$queryTrx = "SELECT * FROM as_retur_transactions WHERE trxID = '$trxID' AND invoiceReturID = '$invoiceID'";
	$sqlTrx = mysqli_query($connect, $queryTrx);
	$dataTrx = mysqli_fetch_array($sqlTrx);
	
	$total = rupiah($dataTrx['trxTotal']);
	
	$totalBilang = Terbilang($dataTrx['trxTotal']);
	$dateNow = tgl_indo($dataTrx['trxDate']);
	
	$trxAddress = chunk_split($dataTrx['trxAddress'], 50, "<br>");
	
	$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 240mm;'>
					<tr valign='top'>
						<td style='width: 237mm;' valign='middle'>
							<div style='font-weight: bold; padding-bottom: 5px; font-size: 13pt;'>
								$dataIdentity[identityName]
							</div>
							<span style='font-size: 11pt;'>$dataIdentity[identityAddress], Telp. $dataIdentity[identityPhone], Email: $dataIdentity[identityEmail]</span>
						</td>
					</tr>
				</table>
				<br>
				<table style='width: 240mm;'>
					<tr>
						<td style='width: 118mm; font-size: 12pt;'><b>Rincian Retur</b></td>
						<td style='width: 118mm; font-size: 12pt;' align='right'>Cirebon, $dateNow</td>
					</tr>
				</table>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
					<tr>
						<td style='width: 30mm; font-size: 12pt;'>Nomor Retur</td>
						<td style='width: 1mm; font-size: 12pt;'>:</td>
						<td style='width: 89mm; font-size: 12pt;'>$dataTrx[invoiceReturID]</td>
						<td style='width: 29mm; font-size: 12pt;'>Supplier :</td>
						<td style='width: 1mm; font-size: 12pt;'></td>
						<td style='width: 89mm; font-size: 12pt;'></td>
					</tr>
					<tr valign='top'>
						<td style='font-size: 12pt;'></td>
						<td style='font-size: 12pt;'></td>
						<td style='font-size: 12pt;'></td>
						<td colspan='3' style='font-size: 12pt;'>$dataTrx[trxFullName]</td>
					</tr>
					<tr>
						<td colspan='3'></td>
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
						<th align='center' style='font-size: 12pt; width: 44mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Kode Produk</th>
						<th align='center' style='font-size: 12pt; width: 80mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Nama Produk</th>
						<th align='center' style='font-size: 12pt; width: 45mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Harga Supp. Satuan</th>
						<th align='center' style='font-size: 12pt; width: 30mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Qty</th>
						<th align='center' style='font-size: 12pt; width: 30mm; padding: 5px 0px 5px 0px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Subtotal</th>
					</tr>";
					
					// showing up the service
					$queryDetail = "SELECT A.detailID, A.invoiceReturID, A.productBarcode, A.detailReturPrice, A.detailReturQty, A.detailReturSubtotal, B.productName 
					FROM as_retur_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceReturID = '$invoiceID'";
					
					$i = 1;
					$sqlDetail = mysqli_query($connect, $queryDetail);
					while ($dataDetail = mysqli_fetch_array($sqlDetail))
					{
						$detailReturPrice = rupiah($dataDetail['detailReturPrice']);
						$detailReturSubtotal = rupiah($dataDetail['detailReturSubtotal']);
						
						$content .= "
							<tr>
								<td style='padding: 5px; font-size: 12pt; '>$i</td>
								<td style='padding: 5px; font-size: 12pt; '>$dataDetail[productBarcode]</td>
								<td style='padding: 5px; font-size: 12pt; '>$dataDetail[productName]</td>
								<td style='padding: 5px; font-size: 12pt; ' align='right'>$detailReturPrice</td>
								<td style='padding: 5px; font-size: 12pt; ' align='center'>$dataDetail[detailReturQty]</td>
								<td style='padding: 5px; font-size: 12pt; ' align='right'>$detailReturSubtotal</td>
							</tr>
						";
						$i++;
					}
		$content .= 
					"<tr>
						<td colspan='5' align='right' style='font-size: 12pt; padding: 5px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Total</td>
						<td style='font-size: 12pt; padding: 5px; border-top: 1px solid #999999; border-bottom: 1px solid #999999;' align='right'><b>$total</b></td>
					</tr>
					<tr>
						<td colspan='6' style='font-size: 12pt; padding: 5px; border-bottom: 1px solid #999999;'><i>Terbilang : $totalBilang Rupiah</i></td>
					</tr>
				</table>
				<br>
				<table style='width: 240mm;'>
					<tr>
						<td align='right' style='width: 235mm; font-size: 12pt;'>*** $_SESSION[userNIP] - $_SESSION[userFullName] ***</td>
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