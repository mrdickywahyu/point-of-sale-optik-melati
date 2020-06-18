<?php
// include header
include "header.php";
// set the tpl page
$page = "stock_opname.tpl";

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
	
	// if module is stock opname and action is delete
	if ($module == 'stock' && $act == 'delete')
	{
		// get value from url
		$soID = $_GET['soID'];
		$soQ = $_GET['q'];
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		$l = $_GET['l'];
		
		$queryShowSO = "SELECT status, qty, productBarcode FROM as_stock_opname WHERE soID = '$soID'";
		$sqlShowSO = mysqli_query($connect, $queryShowSO);
		$dataShowSO = mysqli_fetch_array($sqlShowSO); 
		
		if ($dataShowSO['status'] == '1'){
			$qty = $dataShowSO['qty'];
			$queryProduct = "UPDATE as_products SET productStock=productStock-$qty WHERE productBarcode = '$dataShowSO[productBarcode]'";
		}
		elseif ($dataShowSO['status'] == '2'){
			$qty = $dataShowSO['qty'];
			$queryProduct = "UPDATE as_products SET productStock=productStock+$qty WHERE productBarcode = '$dataShowSO[productBarcode]'";
		}
		
		$save = mysqli_query($connect, $queryProduct);
		
		if ($save){
			// delete from the database
			$querySO = "DELETE FROM as_stock_opname WHERE soID = '$soID'";
			mysqli_query($connect, $querySO);
		}
		
		// redirect to the stock opname page
		if ($l == '1'){
			header("Location: stock_opname.php?module=stock&act=add&code=3");
		}
		else{
			header("Location: stock_opname.php?module=stock&act=search&q=".$soQ."&startDate=".$startDate."&endDate=".$endDate."&l=2&code=3");
		}
	} // close bracket
	
	// if module is stock opname and action is search
	elseif ($module == 'stock' && $act == 'search')
	{
		// get method value and change into variables
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		$soQ = $_GET['q'];
		
		// showing the stock opname based on period date
		if ($soQ != '')
		{
			$querySO = "SELECT A.soID, A.productBarcode, A.soDate, A.productStock, A.realStock, A.status, A.qty, A.soDescription, B.productName FROM as_stock_opname A 
			INNER JOIN as_products B ON B.productBarcode=A.productBarcode WHERE A.productBarcode = '$soQ' AND A.soDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.soDate ASC";
		}
		else{
			$querySO = "SELECT A.soID, A.productBarcode, A.soDate, A.productStock, A.realStock, A.status, A.qty, A.soDescription, B.productName FROM as_stock_opname A 
			INNER JOIN as_products B ON B.productBarcode=A.productBarcode WHERE A.soDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.soDate ASC";
		}
		
		// showing up the product data
		$dataProduct = mysqli_fetch_array(mysqli_query($connect, "SELECT productBarcode, productName FROM as_products WHERE productBarcode = '$soQ'"));
		
		// assign to the tpl
		$smarty->assign("prodBarcode", $dataProduct['productBarcode']);
		$smarty->assign("prodName", $dataProduct['productName']);
		
		$sqlSO = mysqli_query($connect, $querySO);
		
		// fetch data
		$i = 1;
		while ($dtSO = mysqli_fetch_array($sqlSO))
		{
			$soDate = explode("-", $dtSO['soDate']);
			// save into array
			$dataSO[] = array(	'soID' => $dtSO['soID'],
								'productBarcode' => $dtSO['productBarcode'],
								'productName' => $dtSO['productName'],
								'soDate' => $soDate[2]."/".$soDate[1]."/".$soDate[0],
								'productStock' => $dtSO['productStock'],
								'realStock' => $dtSO['realStock'],
								'status' => $dtSO['status'],
								'qty' => $dtSO['qty'],
								'soDescription' => $dtSO['soDescription'],
								'no' => $i);
			$i++;
		}
		
		$exStart = explode("-", $startDate);
		$exEnd = explode("-", $endDate);
		
		// assign to the tpl
		$smarty->assign("dataSO", $dataSO);
		$smarty->assign("startDate", $exStart[2]."/".$exStart[1]."/".$exStart[0]);
		$smarty->assign("endDate", $exEnd[2]."/".$exEnd[1]."/".$exEnd[0]);
		$smarty->assign("soDate", date('Y-m-d'));
		$smarty->assign("q", $soQ);
		$smarty->assign("start", $startDate);
		$smarty->assign("end", $endDate);
	}
	
	else 
	{
		$smarty->assign("soDate", date('Y-m-d'));
		
		$periodDate = date('Y-m');
		// showing the stock opname based on period date
		$querySO = "SELECT A.soID, A.productBarcode, A.soDate, A.productStock, A.realStock, A.status, A.qty, A.soDescription, B.productName FROM as_stock_opname A 
		INNER JOIN as_products B ON B.productBarcode=A.productBarcode WHERE A.soDate LIKE '%$periodDate%' ORDER BY A.soDate ASC";
		$sqlSO = mysqli_query($connect, $querySO);
		
		// fetch data
		$i = 1;
		while ($dtSO = mysqli_fetch_array($sqlSO))
		{
			$soDate = explode("-", $dtSO['soDate']);
			// save into array
			$dataSO[] = array(	'soID' => $dtSO['soID'],
								'productBarcode' => $dtSO['productBarcode'],
								'productName' => $dtSO['productName'],
								'soDate' => $soDate[2]."/".$soDate[1]."/".$soDate[0],
								'productStock' => $dtSO['productStock'],
								'realStock' => $dtSO['realStock'],
								'status' => $dtSO['status'],
								'qty' => $dtSO['qty'],
								'soDescription' => $dtSO['soDescription'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataSO", $dataSO);
		$smarty->assign("periodYear", date('Y'));
		
		$month = date('m');
		
		// month name
		if ($month == '01'){
			$monthName = "Januari";
		}
		elseif ($month == '02'){
			$monthName = "Februari";
		}
		elseif ($month == '03'){
			$monthName = "Maret";
		}
		elseif ($month == '04'){
			$monthName = "April";
		}
		elseif ($month == '05'){
			$monthName = "Mei";
		}
		elseif ($month == '06'){
			$monthName = "Juni";
		}
		elseif ($month == '07'){
			$monthName = "Juli";
		}
		elseif ($month == '08'){
			$monthName = "Agustus";
		}
		elseif ($month == '09'){
			$monthName = "September";
		}
		elseif ($month == '10'){
			$monthName = "Oktober";
		}
		elseif ($month == '11'){
			$monthName = "November";
		}
		else{
			$monthName = "Desember";
		}
		
		$smarty->assign("periodMonth", $monthName);
	} // close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>