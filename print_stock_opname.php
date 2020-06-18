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
	$start = explode("-", $startDate);
	$end = explode("-", $endDate);
	$q = $_GET['q'];
	$dataProduct = mysqli_fetch_array(mysqli_query($connect, "SELECT productBarcode, productName FROM as_products WHERE productBarcode = '$q'"));
	
	$filename="stock_opname-".$q."-".$startDate."-".$endDate.".pdf";
	$content = ob_get_clean();
	
	$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 240mm;'>
					<tr valign='top'>
						<td style='width: 290mm;' valign='middle'>
							<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
								$dataIdentity[identityName]
							</div>
							<span style='font-size: 11pt;'>$dataIdentity[identityAddress], Telp. $dataIdentity[identityPhone], Email: $dataIdentity[identityEmail]</span>
						</td>
					</tr>
				</table>
				<p style='text-align: center; width: 290mm; font-size: 12pt;'><b><u>Stock Opname</u></b></p>
				<span style='font-size: 11pt;'>Periode : $start[2]/$start[1]/$start[0] - $end[2]/$end[1]/$end[0]<br>
					Kode Produk : $dataProduct[productBarcode] - $dataProduct[productName]<br></span>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 290mm;'>";
					if ($q == ''){
						$content .= "<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>No.</th>
							<th style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>Tanggal</th>
							<th style='width: 37mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>Kode Produk</th>
							<th style='width: 70mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>Nama Produk</th>
							<th style='width: 23mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>Stok Prod</th>
							<th style='width: 23mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>Stok Nyata</th>
							<th style='width: 23mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>Selisih</th>
							<th style='width: 76mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>Keterangan</th>
						</tr>";
					}
					else{
						$content .= "<tr>
							<th align='center' style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>No.</th>
							<th align='center' style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>Tanggal</th>
							<th align='center' style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>Stok Prod</th>
							<th align='center' style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>Stok Nyata</th>
							<th align='center' style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>Selisih</th>
							<th align='center' style='width: 162mm; padding: 5px 0px 5px 0px; font-size: 11pt;'>Keterangan</th>
						</tr>";
					}
					
					// showing the stock opname based on period date
					if ($q != '')
					{
						$querySO = "SELECT A.soID, A.productBarcode, A.soDate, A.productStock, A.realStock, A.status, A.qty, A.soDescription, B.productName FROM as_stock_opname A 
						INNER JOIN as_products B ON B.productBarcode=A.productBarcode WHERE A.productBarcode = '$q' AND A.soDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.soDate ASC";
					}
					else{
						$querySO = "SELECT A.soID, A.productBarcode, A.soDate, A.productStock, A.realStock, A.status, A.qty, A.soDescription, B.productName FROM as_stock_opname A 
						INNER JOIN as_products B ON B.productBarcode=A.productBarcode WHERE A.soDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.soDate ASC";
					}
					
					// fetch data
					$i = 1;
					$sqlSO = mysqli_query($connect, $querySO);
					while ($dataSO = mysqli_fetch_array($sqlSO))
					{
						$soDate = explode("-", $dataSO['soDate']);
						$productName = chunk_split($dataSO['productName'], 30, "<br>");
						
						if ($q == ''){
							$soDescription = chunk_split($dataSO['soDescription'], 30, "<br>");
							$content .= "
								<tr valign='top'>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$i</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$soDate[2]/$soDate[1]/$soDate[0]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$dataSO[productBarcode]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$productName</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$dataSO[productStock]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$dataSO[realStock]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$dataSO[qty]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$soDescription</td>
								</tr>
							";
						}
						else{
							$soDescription = chunk_split($dataSO['soDescription'], 65, "<br>");
							$content .= "
								<tr valign='top'>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$i</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$soDate[2]/$soDate[1]/$soDate[0]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$dataSO[productStock]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$dataSO[realStock]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$dataSO[qty]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 11pt;'>$soDescription</td>
								</tr>
							";
						}
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