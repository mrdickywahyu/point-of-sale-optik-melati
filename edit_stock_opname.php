<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_stock_opname.tpl";

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
	
	if ($module == 'stock' && $act == 'edit')
	{
		$soID = $_GET['soID'];
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		$l = $_GET['l'];
		$outletID = $_SESSION['outletID'];
		
		$querySO = "SELECT A.soID, A.soDate, A.productBarcode, B.productName, B.productStock as stok, A.productStock, A.realStock, A.status, A.qty, A.soDescription FROM as_stock_opname A 
		INNER JOIN as_products B ON B.productBarcode=A.productBarcode WHERE A.soID = '$soID' AND A.outletID = '$outletID'";
		$sqlSO = mysqli_query($connect, $querySO);
		$dataSO = mysqli_fetch_array($sqlSO);
		
		$soDate = explode("-", $dataSO['soDate']);
		
		$smarty->assign("soID", $dataSO['soID']);
		$smarty->assign("soDate", $soDate[2]."/".$soDate[1]."/".$soDate[0]);
		$smarty->assign("productBarcode", $dataSO['productBarcode']);
		$smarty->assign("productName", $dataSO['productName']);
		$smarty->assign("stok", $dataSO['stok']);
		$smarty->assign("productStock", $dataSO['productStock']);
		$smarty->assign("realStock", $dataSO['realStock']);
		$smarty->assign("status", $dataSO['status']);
		$smarty->assign("qty", $dataSO['qty']);
		$smarty->assign("soDescription", $dataSO['soDescription']);
		$smarty->assign("startDate", $startDate);
		$smarty->assign("endDate", $endDate);
		$smarty->assign("l", $l);
		
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>