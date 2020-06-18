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
	
	$filename="supplier.pdf";
	$content = ob_get_clean();
	
	$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 290mm;'>
					<tr valign='top'>
						<td style='width: 290mm;' valign='middle'>
							<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
								$dataIdentity[identityName]
							</div>
							<span style='font-size: 10pt;'>$dataIdentity[identityAddress], Telp. $dataIdentity[identityPhone], Email: $dataIdentity[identityEmail]</span>
						</td>
					</tr>
				</table>
				<p style='width: 210mm; font-size: 11pt;'><span style='font-size: 10pt;'>DATA SUPPLIER</span></p>
				<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
					<tr>
						<th style='width: 10mm;'>No.</th>
						<th style='width: 20mm;'>Kode</th>
						<th style='width: 80mm;'>Nama Supplier</th>
						<th style='width: 50mm;'>Phone</th>
						<th style='width: 55mm;'>Contact Person</th>
						<th style='width: 57mm;'>HP</th>
						<th style='width: 20mm;'>Status</th>
					</tr>";
					
					// showing the supplier
					$querySupplier = "SELECT * FROM as_suppliers ORDER BY supplierCode ASC";
					$sqlSupplier = mysqli_query($connect, $querySupplier);
					
					// fetch data
					$i = 1;
					while ($dtSupplier = mysqli_fetch_array($sqlSupplier))
					{
						
						$content .= "
							<tr valign='top'>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$i</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtSupplier[supplierCode]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtSupplier[supplierName]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtSupplier[supplierPhone]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtSupplier[supplierContactPerson]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtSupplier[supplierCPHp]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtSupplier[supplierStatus]</td>
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