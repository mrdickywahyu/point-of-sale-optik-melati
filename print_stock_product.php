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
	
	$filename="print_so_product-".$outletID."-".$now.".pdf";
	$content = ob_get_clean();
	
	if ($dataIdentity['identityName'] != ''){
		$identityName = $dataIdentity['identityName'];
	}
	else{
		$identityName = "";
	}
	
	if ($dataIdentity['identityAddress'] != ''){
		$identityAddress = $dataIdentity['identityAddress'].",";
	}
	else{
		$identityAddress = "";
	}
	
	if ($dataIdentity['identityPhone'] != ''){
		$identityPhone = "Telp. ".$dataIdentity['identityPhone'].", ";
	}
	else{
		$identityPhone = "";
	}
	
	if ($dataIdentity['identityEmail'] != ''){
		$identityEmail = "Email: ".$dataIdentity['identityEmail'];
	}
	else{
		$identityEmail = "";
	}
	$indoDate = tgl_indo2($now);
	
	$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 240mm;'>
					<tr valign='top'>
						<td style='width: 206mm;' valign='middle'>
							<div style='font-weight: bold; padding-bottom: 5px; font-size: 11pt;'>
								$identityName
							</div>
							<span style='font-size: 10pt;'>$identityAddress $identityPhone $identityEmail</span>
						</td>
					</tr>
				</table>
				<p style='text-align: center; width: 206mm; font-size: 11pt;'><b><u>Stock Opname</u></b> <br><span style='font-size: 10pt;'>$indoDate</span></p>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 210mm;'>
					<tr>
						<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>No.</th>
						<th style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Kode Produk</th>
						<th style='width: 70mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Nama Produk</th>
						<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Stok</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Stok Nyata</th>
						<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Selisih (+/-)</th>
						<th style='width: 38mm; padding: 5px 0px 5px 0px; font-size: 10pt;'>Keterangan</th>
					</tr>";
					
					// showing the funds based on period date
					$queryProduct = "SELECT * FROM as_products ORDER BY productName ASC";
					$sqlProduct = mysqli_query($connect, $queryProduct);
					
					// fetch data
					$i = 1;
					while ($dtProduct = mysqli_fetch_array($sqlProduct))
					{
						$productName = chunk_split($dtProduct['productName'], 36, "<br>");
						
						$content .= "
							<tr valign='top'>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$i</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtProduct[productBarcode]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$productName</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtProduct[productStock]</td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'></td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'></td>
								<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'></td>
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
		$html2pdf = new HTML2PDF('P', 'A4','fr', false, 'ISO-8859-15',array(1, 1, 1, 1)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>