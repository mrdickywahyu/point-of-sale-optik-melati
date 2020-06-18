<?php
// include header
include "header.php";
// set the tpl page
$page = "stock_minimal.tpl";

$module = $_GET['module'];
$act = $_GET['act'];

$outletID = $_SESSION['outletID'];

// showing up product data
$queryProduct = "SELECT * FROM as_products WHERE outletID = '$outletID' AND productType = '1' AND productStock < 4 ORDER BY productStock ASC";
$sqlProduct = mysqli_query($connect, $queryProduct);

// fetch data
$i = 1;
while ($dtProduct = mysqli_fetch_array($sqlProduct))
{
	// save data to array
	$dataProduct[] = array(	'productID' => $dtProduct['productID'],
							'supplierID' => $dtProduct['supplierID'],
							'categoryID' => $dtProduct['categoryID'],
							'brandID' => $dtProduct['brandID'],
							'productBarcode' => $dtProduct['productBarcode'],
							'productName' => $dtProduct['productName'],
							'productDiscount' => $dtProduct['productDiscount'],
							'productSalePrice' => rupiah($dtProduct['productSalePrice']),
							'productBuyPrice' => rupiah($dtProduct['productBuyPrice']),
							'productStock' => $dtProduct['productStock'],
							'productNote' => $dtProduct['productNote'], 
							'no' => $i
							);
	$i++;
} // close while

// assign to the home tpl
$smarty->assign("dataProduct", $dataProduct);

// assign code to the tpl
$smarty->assign("code", $_GET['code']);
$smarty->assign("module", $module);
$smarty->assign("act", $act);


// include footer
include "footer.php";
?>
