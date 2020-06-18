<?php
// include header
include "header.php";

// set the tpl page
$page = "barcodes.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['userName'] == '' && $_SESSION['userPassword'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else 
{
	// get variable
	$module = $_GET['module'];
	$act = $_GET['act'];
	
	// if the module is barcode and act is delete
	if ($module == 'barcode' && $act == 'delete')
	{
		// variables
		$productBarcode = $_GET['productBarcode'];
		
		// delete from the barcode's table
		$queryBarcode = "DELETE FROM as_barcodes WHERE productBarcode = '$productBarcode'";
		mysqli_query($connect, $queryBarcode);
		
		// redirect to the main barcode page
		header("Location: barcodes.php?code=2");
	}
	
	// if the module is barcode and act is refresh
	elseif ($module == 'barcode' && $act == 'refresh')
	{
		// delete all from the barcode's table based on outlet id
		$queryBarcode = "DELETE FROM as_barcodes";
		mysqli_query($connect, $queryBarcode);
		
		// redirect to the main barcode page
		header("Location: barcodes.php?code=3");
	}
	
	else
	{
		$queryBarcode = "SELECT A.barcodeID, A.qty, A.productBarcode, B.productBarcode, B.productName, B.productSalePrice, C.categoryName, D.brandName FROM as_barcodes A 
		INNER JOIN as_products B ON B.productBarcode=A.productBarcode 
		LEFT JOIN as_categories C ON C.categoryID=B.categoryID
		LEFT JOIN as_brands D ON D.brandID=B.brandID GROUP BY A.productBarcode";
		$sqlBarcode = mysqli_query($connect, $queryBarcode);
		
		// fetch data
		$no = 1;
		while ($dtBarcode = mysqli_fetch_array($sqlBarcode))
		{ 
			
			$dataBarcode[] = array(	'barcodeID' => $dtBarcode['barcodeID'],
									'productBarcode' => $dtBarcode['productBarcode'],
									'productName' => $dtBarcode['productName'],
									'productSalePrice' => rupiah($dtBarcode['productSalePrice']),
									'categoryName' => $dtBarcode['categoryName'],
									'brandName' => $dtBarcode['brandName'],
									'qty' => $dtBarcode['qty'],
									'no' => $no
									);
			$no++;
		}
		
		// assign to the tpl
		$smarty->assign("dataBarcode", $dataBarcode);
	}
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>