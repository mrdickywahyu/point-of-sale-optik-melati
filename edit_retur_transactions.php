<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_retur_transactions.tpl";

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
	
	if ($module == 'trx' && $act == 'edit')
	{
		// insert method into a variable
		$detailID = $_GET['detailID'];
		
		$queryTrx = "SELECT A.detailID, B.productBuyPrice, A.detailReturPrice, A.detailReturQty, B.productBarcode, B.productName, B.productID FROM as_retur_detail_transactions A
					INNER JOIN as_products B ON B.productBarcode=A.productBarcode WHERE A.detailID = '$detailID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		$dataTrx = mysqli_fetch_array($sqlTrx);
		
		$queryProduct = "SELECT productStock, productBuyPrice FROM as_products WHERE productID = '$dataTrx[productID]'";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		$dataProduct = mysqli_fetch_array($sqlProduct);
		
		// assign to the tpl
		$smarty->assign("detailID", $dataTrx['detailID']);
		$smarty->assign("detailReturQty", $dataTrx['detailReturQty']);
		$smarty->assign("detailReturPrice", $dataTrx['detailReturPrice']);
		$smarty->assign("productBarcode", $dataTrx['productBarcode']);
		$smarty->assign("productName", $dataTrx['productName']);
		$smarty->assign("productStock", $dataProduct['productStock']);
		$smarty->assign("productBuyPrice", rupiah($dataProduct['productBuyPrice']));
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>