<?php
// include header
include "header.php";
// set the tpl page
$page = "stock_product.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['userName'] == '' && $_SESSION['userPassword'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else 
{
	if ($_SESSION['userLevel'] != '1'){
		echo "You have not authorization for access the modules.";
		exit();
	}
	
	// get variable
	$module = $_GET['module'];
	$act = $_GET['act'];
	
	// showing up product data
	$queryProduct = "SELECT * FROM as_products ORDER BY productName ASC";
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
								'productSalePrice' => rupiah($dtProduct['productSalePrice']),
								'productCheapestPrice' => rupiah($dtProduct['productCheapestPrice']),
								'productDiscount' => $dtProduct['productDiscount'],
								'productBuyPrice' => rupiah($dtProduct['productBuyPrice']),
								'productStock' => $dtProduct['productStock'],
								'productNote' => $dtProduct['productNote'], 
								'no' => $i
								);
		$i++;
	} // close while
	
	
	// assign array to the tpl
	$smarty->assign("dataProduct", $dataProduct);
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>