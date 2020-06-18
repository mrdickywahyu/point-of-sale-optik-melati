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
	if ($_SESSION['outletLevel'] != 'W' && $_SESSION['outletID'] != '1' || $_SESSION['outletLevel'] == ''){
		// show up the text and exit
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
	$outletID = $_GET['outletID'];
	
	$filename="receive-".$startDate."-".$endDate."-".$outletID.".pdf";
	$content = ob_get_clean();
	
	$outletDt = mysqli_fetch_array(mysqli_query($connect, "SELECT outletCode, outletID, outletName FROM as_outlets WHERE outletID = '$outletID'"));
	
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
				<br>
				<table>
					<tr>
						<td>Nama Outlet</td>
						<td>: $outletDt[outletCode] - $outletDt[outletName]</td>
					</tr>
					<tr>
						<td>Jenis Laporan</td>
						<td>: Piutang</td>
					</tr>
					<tr>
						<td>Periode</td>
						<td>: $start s/d $end</td>
					</tr>
				</table>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 297mm;'>
					<tr>
						<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>No.</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Tanggal</th>
						<th style='width: 40mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>No. Faktur</th>
						<th style='width: 24mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>ID Member</th>
						<th style='width: 68mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Nama</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Jumlah</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Bayar</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Sisa</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Status</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Jatuh Tempo</th>
					</tr>";
					
					$queryReceivable = "SELECT A.receivableID, B.memberID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxPay 
					FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
					WHERE A.outletID = '$outletID' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
					
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
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$totalHutangRp</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$totalPay2</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$sisa</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$totalSisaIf</td>
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