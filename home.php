<?php
// include header
include "header.php";
// set the tpl page
$page = "home.tpl";

$module = $_GET['module'];
$act = $_GET['act'];

if ($module == 'home' && $act == 'search')
{
	$productBarcode = $_GET['productBarcode'];
	
	// showing up product data
	$queryProduct = "SELECT * FROM as_products WHERE productBarcode = '$productBarcode'";
	$sqlProduct = mysqli_query($connect, $queryProduct);
	$numProduct = mysqli_num_rows($sqlProduct);
	
	if ($numProduct == '0')
	{
		$queryProduct = "SELECT * FROM as_products WHERE productBarcode LIKE '%$productBarcode%' or productName LIKE '%$productBarcode%'";
		$sqlProduct = mysqli_query($connect, $queryProduct);
	}
	
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
}

$outletID = $_SESSION['outletID'];

// count product
$queryProduct = "SELECT * FROM as_products WHERE productStock < 4";
$sqlProduct = mysqli_query($connect, $queryProduct);
$numsProduct = mysqli_num_rows($sqlProduct);
$smarty->assign("numsProduct", $numsProduct);

$start = date('Y-m-d');

// count piutang
$queryPiutang = "SELECT A.receivableID FROM as_receivables A INNER JOIN as_sales_transactions B ON B.invoiceID=A.invoiceID
				WHERE B.trxStatus = '3' AND DATEDIFF(B.trxTerminDate, '$start') < 4";
$sqlPiutang = mysqli_query($connect, $queryPiutang);
$numsPiutang = mysqli_num_rows($sqlPiutang);

$smarty->assign("numsPiutang", $numsPiutang);

// count hutang
$queryHutang = "SELECT A.debtID FROM as_debts A INNER JOIN as_buy_transactions B ON B.invoiceBuyID=A.invoiceID
				WHERE B.trxStatus = '2' AND DATEDIFF(B.trxTerminDate, '$start') < 4";
$sqlHutang = mysqli_query($connect, $queryHutang);
$numsHutang = mysqli_num_rows($sqlHutang);

$smarty->assign("numsHutang", $numsHutang);

// assign code to the tpl
$smarty->assign("code", $_GET['code']);
$smarty->assign("module", $module);
$smarty->assign("act", $act);


// include footer
include "footer.php";
?>
