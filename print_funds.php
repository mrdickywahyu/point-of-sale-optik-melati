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
	$start = tgl_indo($startDate);
	$end = tgl_indo($endDate);
	
	$filename="fund-".$startDate."-".$endDate.".pdf";
	$content = ob_get_clean();
	
	$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 240mm;'>
					<tr valign='top'>
						<td style='width: 210mm;' valign='middle'>
							<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
								$dataIdentity[identityName]
							</div>
							<span style='font-size: 10pt;'>$dataIdentity[identityAddress], Telp. $dataIdentity[identityPhone], Email: $dataIdentity[identityEmail]</span>
						</td>
					</tr>
				</table>
				<p style='text-align: center; width: 210mm; font-size: 11pt;'><b><u>Pengeluaran Biaya</u></b> <br><span style='font-size: 10pt;'>$start s/d $end</span></p>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 210mm;'>
					<tr>
						<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>No.</th>
						<th style='width: 15mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Tanggal</th>
						<th style='width: 31mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Kode Akun</th>
						<th style='width: 51mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Nama Akun</th>
						<th style='width: 65mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Keterangan</th>
						<th style='width: 33mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Jumlah</th>
					</tr>";
					
					// showing the funds based on period date
					$queryFund = "SELECT * FROM as_funds A WHERE A.fundDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.fundDate ASC";
					$sqlFund = mysqli_query($connect, $queryFund);
					
					// fetch data
					$i = 1;
					while ($dtFund = mysqli_fetch_array($sqlFund))
					{
						$dataAcc = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM as_accounts WHERE accountID = '$dtFund[accountID]'"));
					
						$fundDate = explode("-", $dtFund['fundDate']);
						$fundAmount = rupiah($dtFund['fundAmount']);
						$fundNote = chunk_split($dtFund['fundNote'], 50, "<br>");
						$content .= "
							<tr valign='top'>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$i</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$fundDate[2]/$fundDate[1]/$fundDate[0]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dataAcc[accountCode]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dataAcc[accountName]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$fundNote</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$fundAmount</td>
							</tr>
						";
						
						$total = $total + $dtFund['fundAmount'];
						$i++;
					}
					$total2 = rupiah($total);
		$content .= 
					"
					<tr>
						<td colspan='5' style='border-top: 1px solid #999999;'></td>
						<td colspan='2' style='padding: 5px; font-size: 10pt;border-top: 1px solid #999999;'><b>$total2</b></td>
					</tr>
				</table>
				
				";
	ob_end_clean();
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('P', 'A4','fr', false, 'ISO-8859-15',array(1, 1, 1, 1)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>