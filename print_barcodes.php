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
	
	$filename="barcodes.pdf";
	$content = ob_get_clean();
	
	$column = 4;
	$i = 0;
	$queryBarcode = "SELECT A.productBarcode, B.productName FROM as_barcodes A 
	INNER JOIN as_products B ON B.productBarcode=A.productBarcode";
	
	$sqlBarcode = mysqli_query($connect, $queryBarcode);
	
	$content = "<table cellpadding='0' cellspacing='0'><tr>";
	
	while ($dataBarcode = mysqli_fetch_array($sqlBarcode))
	{
		$productName = substr($dataBarcode['productName'], 0, 28);
		if ($i >= $column)
		{
			$content .= "<tr></tr>";
			
			$i = 0;
		}
		$i++;
		$content .= "<td width='186' height='80' align='center' style='border: 1px solid #000;'><span style='font-size: 8pt;'>$productName</span><br><img src='images/barcodes/$dataBarcode[productBarcode].png' height='50' width='152'></td>";
	}
	
	$content .= "</tr></table>";
	
	ob_end_clean();
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('P', 'A4','fr', false, 'ISO-8859-15',array(2, 10, 2, 10)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>