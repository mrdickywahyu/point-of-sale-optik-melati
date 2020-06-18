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
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
	$supplierID = $_GET['supplierID'];
	$status = $_GET['status'];
	$start = tgl_indo2($startDate);
	$end = tgl_indo2($endDate);
	$outletID = $_SESSION['outletID'];
	
	$filename="debts-".$startDate."-".$endDate."-".$supplierID."-".$status.".pdf";
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
				<p style='text-align: center; width: 210mm; font-size: 11pt;'><b><u>Catatan Hutang</u></b> <br><span style='font-size: 10pt;'>$start s/d $end</span></p>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 297mm;'>
					<tr>
						<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>No.</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Tanggal</th>
						<th style='width: 40mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>No. Faktur</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>ID Supplier</th>
						<th style='width: 67mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Nama</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Jumlah</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Bayar</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Sisa</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Status</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Jatuh Tempo</th>
					</tr>";
					
					// showing the debts based on period date
					if ($startDate != '' && $endDate != '' && $supplierID != ''){
						if ($status == '3'){
							$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
							FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
							WHERE A.outletID = '$outletID' AND B.supplierID = '$supplierID' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
						}
						else{
							$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
							FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
							WHERE A.outletID = '$outletID' AND B.supplierID = '$supplierID' AND A.status = '$status' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
						}
					}
					elseif ($startDate != '' && $endDate != '' && $supplierID == '')
					{
						if ($status == '3'){
							$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
							FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
							WHERE A.outletID = '$outletID' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
						}
						else{
							$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
							FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
							WHERE A.outletID = '$outletID' AND A.status = '$status' AND B.trxTerminDate BETWEEN '$startDate' AND '$endDate' ORDER BY B.trxTerminDate ASC";
						}
					}
					elseif ($startDate == '' && $endDate == '' && $supplierID != ''){
						if ($status == '3'){
							$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
							FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
							WHERE A.outletID = '$outletID' AND B.supplierID = '$supplierID' ORDER BY B.trxTerminDate ASC";
						}
						else{
							$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
							FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
							WHERE A.outletID = '$outletID' AND A.status = '$status' AND B.supplierID = '$supplierID' ORDER BY B.trxTerminDate ASC";
						}
					}
					else{
						if ($status == '3'){
							$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
							FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
							WHERE A.outletID = '$outletID' ORDER BY B.trxTerminDate ASC";
						}
						else{
							$queryDebt = "SELECT A.debtID, B.supplierID, A.invoiceID, A.status, B.trxFullName, B.trxTotal, B.trxTerminDate, B.trxDate, B.trxDP 
							FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
							WHERE A.outletID = '$outletID' AND A.status = '$status' ORDER BY B.trxTerminDate ASC";
						}
		}
					
					$sqlDebt = mysqli_query($connect, $queryDebt);
					
					// fetch data
					$i = 1;
					while ($dtDebt = mysqli_fetch_array($sqlDebt))
					{
						$payQuery = "SELECT SUM(debtPay) as payTotal FROM as_debts_payment WHERE debtID = '$dtDebt[debtID]'";
						$paySql = mysqli_query($connect, $payQuery);
						$payData = mysqli_fetch_array($paySql);
			
						$totalPay = $dtDebt['trxDP'] + $payData['payTotal'];
						$totalSisa = $dtDebt['trxTotal'] - $totalPay;
						$trxDate = tgl_indo2($dtDebt['trxDate']);
						$trxTerminDate = tgl_indo2($dtDebt['trxTerminDate']);
						$totalHutang = $dtDebt['trxTotal'] - $dtDebt['trxDP'];
						$totalHutangRp = rupiah($totalHutang);	
						$totalPay2 = rupiah($payData['payTotal']);
						
						if ($totalSisa <= '0'){
							$totalSisaIf = "Lunas";
							$sisa = 0;
						}
						else{
							$totalSisaIf = "Belum Lunas";
							$sisa = $totalSisa;
						}
						
						$content .= "
							<tr valign='top'>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$i</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$trxDate</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtDebt[invoiceID]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtDebt[supplierID]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtDebt[trxFullName]</td>
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