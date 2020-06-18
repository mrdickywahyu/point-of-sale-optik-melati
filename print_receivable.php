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
	$outletID = $_SESSION['outletID'];
	
	$filename="receivable.pdf";
	$content = ob_get_clean();
	
	$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 297mm;'>
					<tr valign='top'>
						<td style='width: 290mm;' valign='middle'>
							<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
								$dataIdentity[identityName]
							</div>
							<span style='font-size: 10pt;'>$dataIdentity[identityAddress], Telp. $dataIdentity[identityPhone], Email: $dataIdentity[identityEmail]</span>
						</td>
					</tr>
				</table>
				<p style='text-align: center; width: 210mm; font-size: 11pt;'><span style='font-size: 10pt;'>CATATAN PIUTANG KONSUMEN</span></p>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 297mm;'>
					<tr>
						<th align='center' style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>No.</th>
						<th align='center' style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Tanggal</th>
						<th align='center' style='width: 40mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>No. Faktur</th>
						<th align='center' style='width: 20mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>ID Member</th>
						<th align='center' style='width: 52mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Nama</th>
						<th align='center' style='width: 28mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Jumlah</th>
						<th align='center' style='width: 28mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Bayar</th>
						<th align='center' style='width: 28mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Sisa</th>
						<th align='center' style='width: 36mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Status</th>
						<th align='center' style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Jatuh Tempo</th>
					</tr>";
					
					// showing the receivables based on period date
					
					$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxPay 
					FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
					WHERE A.outletID = '$outletID' ORDER BY B.trxTerminDate ASC";
					
					$sqlReceivable = mysqli_query($connect, $queryReceivable);
					
					// fetch data
					$i = 1;
					while ($dtReceivable = mysqli_fetch_array($sqlReceivable))
					{
						$payQuery = "SELECT SUM(receivablePay) as payTotal FROM as_receivables_payment WHERE receivableID = '$dtReceivable[receivableID]'";
						$paySql = mysqli_query($connect, $payQuery);
						$payData = mysqli_fetch_array($paySql);
			
						$totalPay = $dtReceivable['trxPay'] + $payData['payTotal'];
						$totalSisa = $dtReceivable['trxTotal'] - $totalPay;
						$trxDate = tgl_indo2($dtReceivable['trxDate']);
						$trxTerminDate = tgl_indo2($dtReceivable['trxTerminDate']);
						$totalHutang = $dtReceivable['trxTotal'] - $dtReceivable['trxPay'];
						$totalHutangRp = rupiah($totalHutang);	
						$totalPay2 = rupiah($payData['payTotal']);
						
						if ($totalSisa <= '0'){
							$totalSisaIf = "Lunas";
							$sisa = 0;
						}
						else{
							$totalSisaIf = "Belum Lunas";
							$sisa = rupiah($totalSisa);
						}
						
						$content .= "
							<tr valign='top'>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$i</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$trxDate</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtReceivable[invoiceID]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtReceivable[memberID]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtReceivable[trxFullName]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;' align='right'>$totalHutangRp</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;' align='right'>$totalPay2</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;' align='right'>$sisa</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;' align='center'>$totalSisaIf</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$trxTerminDate</td>
							</tr>
							";
							
						$i++;
					}
		$content .= 
					"
				</table>
				
				";
	ob_end_clean();
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('L', 'A4','fr', false, 'ISO-8859-15',array(2, 2, 2, 2)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>