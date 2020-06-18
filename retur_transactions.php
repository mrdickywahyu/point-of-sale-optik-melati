<?php
// include header
include "header.php";
// set the tpl page
$page = "retur_transactions.tpl";

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
	
	// if module is transaction and action is input
	if ($module == 'trx' && $act == 'input')
	{
		$createdDate = date('Y-m-d H:i:s');
		$userID = $_SESSION['userID'];
		$supplierID = $_POST['supplierID'];
		$supplierName = $_POST['supplierName'];
		$supplierAddress = $_POST['supplierAddress'];
		$supplierPhone = $_POST['supplierPhone'];
		$invoiceRetur = $_POST['fakturRetur'];
		$trxDate = date('Y-m-d');
		$total = $_POST['total'];
		
		// save into the database
		$queryTrx = "INSERT INTO as_retur_transactions (invoiceReturID,
														supplierID,
														trxFullName,
														trxAddress,
														trxPhone,
														trxDate,
														trxTotal,
														createdDate,
														createdUserID,
														modifiedDate,
														modifiedUserID)
											VALUES	(	'$invoiceRetur',
														'$supplierID',
														'$supplierName',
														'$supplierAddress',
														'$supplierPhone',
														'$trxDate',
														'$total',
														'$createdDate',
														'$userID',
														'',
														'')";
		
		mysqli_query($connect, $queryTrx);
		
		$insertID = mysqli_insert_id($connect);
		
		header("Location: retur_transactions.php?module=trx&act=preview&invoiceReturID=".$invoiceRetur."&trxID=".$insertID);
	} // close bracket
	
	// if module is transactions and act is update
	elseif ($module == 'trx' && $act == 'update')
	{
		// get value method and insert to variable
		$modifiedDate = date('Y-m-d H:i:s');
		$invoiceID = $_POST['fakturRetur'];
		$trxID = $_POST['trxID'];
		$userID = $_SESSION['userID'];
		$supplierID = $_POST['supplierIDD'];
		$supplierName = $_POST['trxFullName'];
		$supplierAddress = $_POST['trxAddress'];
		$supplierPhone = $_POST['trxPhone'];
		$total = $_POST['total'];
		
		$queryTrx = "UPDATE as_retur_transactions SET	supplierID = '$supplierID',
														trxFullName = '$supplierName',
														trxAddress = '$supplierAddress',
														trxPhone = '$supplierPhone',
														trxTotal = '$total',
														modifiedDate = '$modifiedDate',
														modifiedUserID = '$userID'
														WHERE invoiceReturID = '$invoiceID' AND trxID = '$trxID'";
		mysqli_query($connect, $queryTrx);
		
		header("Location: retur_transactions.php?module=trx&act=preview&invoiceReturID=".$invoiceID."&trxID=".$trxID);
	} // close bracket
	
	// if module is transaction and action is preview
	elseif($module == 'trx' && $act == 'preview')
	{
		// get the method value
		$invoiceID = $_GET['invoiceReturID'];
		$trxID = $_GET['trxID'];
		
		$queryTrx = "SELECT * FROM as_retur_transactions WHERE trxID = '$trxID' AND invoiceReturID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		$dataTrx = mysqli_fetch_array($sqlTrx);
		
		$smarty->assign("invoiceReturID", $invoiceID);
		$smarty->assign("trxID", $dataTrx['trxID']);
		$smarty->assign("supplierID", $dataTrx['supplierID']);
		$smarty->assign("trxFullName", $dataTrx['trxFullName']);
		$smarty->assign("trxAddress", $dataTrx['trxAddress']);
		$smarty->assign("trxPhone", $dataTrx['trxPhone']);
		$smarty->assign("trxDate", tgl_indo($dataTrx['trxDate']));
		$smarty->assign("trxTotal", rupiah($dataTrx['trxTotal']));
		$smarty->assign("terbilang", Terbilang($dataTrx['trxTotal']));
		
		// showing up the service
		$queryDetail = "SELECT A.detailID, A.invoiceReturID, A.productBarcode, A.detailReturPrice, A.detailReturQty, A.detailReturSubtotal, B.productName 
		FROM as_retur_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceReturID = '$invoiceID'";
		
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productBarcode' => $dtDetail['productBarcode'],
									'productName' => $dtDetail['productName'],
									'detailReturPrice' => rupiah($dtDetail['detailReturPrice']),
									'detailReturQty' => $dtDetail['detailReturQty'],
									'detailReturSubtotal' => rupiah($dtDetail['detailReturSubtotal']),
									'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataDetail", $dataDetail);
	} // close bracket
	
	// if module is transaction and action is delete
	elseif ($module == 'trx' && $act == 'delete')
	{
		$detailID = $_GET['detailID'];

		$queryTrx = "DELETE FROM as_retur_detail_transactions WHERE detailID = '$detailID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		if ($_GET['supplierID'] != ''){
			// redirect to the main transaction page
			header("Location: retur_transactions.php?module=trx&act=add&supplierID=".$_GET['supplierID']);
		}
		else{
			// redirect to the main transaction page
			header("Location: retur_transactions.php?module=trx&act=add");
		}
	} //close bracket
	
	// if module is transaction and action is delete
	elseif ($module == 'trx' && $act == 'deleteedit')
	{
		$detailID = $_GET['detailID'];
		$invoiceID = $_GET['invoiceReturID'];
		$trxID = $_GET['trxID'];

		$queryTrx = "DELETE FROM as_retur_detail_transactions WHERE detailID = '$detailID' AND invoiceReturID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		// redirect to the main transaction page
		header("Location: retur_transactions.php?module=trx&act=edit&invoiceReturID=".$invoiceID."&trxID=".$trxID);
	} //close bracket
	
	// if module is transaction and action is delete trx
	elseif ($module == 'trx' && $act == 'deletetrx')
	{
		$invoiceID = $_GET['invoiceReturID'];
		$trxID = $_GET['trxID'];
		$type = $_GET['type'];
		$supplierID = $_GET['supplierID'];
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		
		$queryTrx = "SELECT * FROM as_retur_detail_transactions WHERE invoiceReturID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		while ($dtTrx = mysqli_fetch_array($sqlTrx))
		{
			$qty = $dtTrx['detailReturQty'];
			$productBarcode = $dtTrx['productBarcode'];
			
			$queryUpdate = "UPDATE as_products SET productStock=productStock+$qty WHERE productBarcode = '$productBarcode'";
			$update = mysqli_query($connect, $queryUpdate);
		}
		
		if ($update)
		{
			// delete transactions
			$queryDetailDelete = "DELETE FROM as_retur_detail_transactions WHERE invoiceReturID = '$invoiceID'";
			$queryDelete = "DELETE FROM as_retur_transactions WHERE invoiceReturID = '$invoiceID'";
			
			mysqli_query($connect, $queryDetailDelete);
			mysqli_query($connect, $queryDelete);
		}
		
		
		if ($type == '1'){
			header("Location: retur_transactions.php?module=trx&act=search&searchType=1&trxNo=".$invoiceID."&code=3");
		}
		elseif ($type == '2'){
			header("Location: retur_transactions.php?module=trx&act=search&searchType=2&supplierID=".$supplierID."&code=3");
		}
		elseif ($type == '3'){
			header("Location: retur_transactions.php?module=trx&act=search&searchType=3&startDate=".$startDate."&endDate=".$endDate."&code=3");
		}
		else{
			header("Location: retur_transactions.php");
		}
	} //close bracket
	
	
	// if module is transaction and action is edit
	elseif ($module == 'trx' && $act == 'edit')
	{
		$trxID = $_GET['trxID'];
		$invoiceID = $_GET['invoiceReturID'];
		
		$smarty->assign("invoiceReturID", $invoiceID);
		$smarty->assign("trxID", $trxID);
		
		$queryMain = "SELECT * FROM as_retur_transactions WHERE invoiceReturID = '$invoiceID' AND trxID = '$trxID'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		// if member exists
		$supplierID = $_GET['supplierID'];
		if ($supplierID != '')
		{
			$querySupplier = "SELECT * FROM as_suppliers WHERE supplierCode = '$supplierID'";
			$sqlSupplier = mysqli_query($connect, $querySupplier);
			
			// fetch data
			$dtSupplier = mysqli_fetch_array($sqlSupplier);
			
			$smarty->assign("supplierID", $dtSupplier['supplierID']);
			$smarty->assign("supplierCode", $dtSupplier['supplierCode']);
			$smarty->assign("supplierName", $dtSupplier['supplierName']);
			$smarty->assign("supplierAddress", $dtSupplier['supplierAddress']);
			$smarty->assign("supplierPhone", $dtSupplier['supplierPhone']);
		}
		else{
			$smarty->assign("supplierCode", $dataMain['supplierID']);
			$smarty->assign("supplierName", $dataMain['trxFullName']);
			$smarty->assign("supplierAddress", $dataMain['trxAddress']);
			$smarty->assign("supplierPhone", $dataMain['trxPhone']);
		}
				
		$queryTrx = "SELECT A.detailID, A.invoiceReturID, A.productBarcode, A.detailReturPrice, A.detailReturQty, A.detailReturSubtotal, B.productName
		FROM as_retur_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceReturID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		// fetch data
		$i = 1;
		while ($dtTrx = mysqli_fetch_array($sqlTrx))
		{
			
			$dataTrx[] = array(	'detailID' => $dtTrx['detailID'],
								'productBarcode' => $dtTrx['productBarcode'],
								'productName' => $dtTrx['productName'],
								'detailReturPrice' => rupiah($dtTrx['detailReturPrice']),
								'detailReturQty' => $dtTrx['detailReturQty'],
								'detailReturSubtotal' => rupiah($dtTrx['detailReturSubtotal']),
								'no' => $i);
			$total = $total + $dtTrx['detailReturSubtotal'];
			$i++;
		}
		
		$ex = explode(" ", $dataMain['createdDate']);
		$ex2 = explode("-", $ex[0]);
		
		// assign to the tpl
		$smarty->assign("trxDate", $ex2[2]."/".$ex2[1]."/".$ex2[0]." ".$ex[1]);
		$smarty->assign("dataShow", $dataTrx);
		$smarty->assign("total", $total);
		$smarty->assign("rupiah", rupiah($total));
	} //close bracket
	
	// if module is transaction and action is finish
	elseif ($module == 'trx' && $act == 'finish')
	{
		$status = $_GET['status'];
		$invoiceID = $_GET['invoiceReturID'];
		
		$queryDetail = "SELECT * FROM as_retur_detail_transactions WHERE invoiceReturID = '$invoiceID'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// update data
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$qty = $dtDetail['detailReturQty'];
			$price = $dtDetail['detailReturPrice'];
			$queryProduct = "UPDATE as_products SET productStock=productStock-$qty WHERE productBarcode = '$dtDetail[productBarcode]'";
			mysqli_query($connect, $queryProduct);
		}
		
		$_SESSION['fakturRetur'] = "";
	
		header("Location: retur_transactions.php?module=trx&act=add");
	} // close bracket
	
	// if module is transaction and action is add
	elseif ($module == 'trx' && $act == 'add')
	{
		$smarty->assign("fakturRetur", $_SESSION['fakturRetur']);
		$smarty->assign("tanggal", date('d/m/Y h:i:s'));
		$smarty->assign("time", date('H:i'));
		
		// showing up the transactions
		$queryShow = "SELECT A.detailID, A.invoiceReturID, A.detailReturPrice, A.detailReturQty, A.detailReturSubtotal, B.productBarcode, B.productName
					FROM as_retur_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode 
					WHERE A.invoiceReturID = '$fakturRetur'";
		$sqlShow = mysqli_query($connect, $queryShow);
		$dataShow = array();
		// fetch data
		$i = 1;
		while ($dtShow = mysqli_fetch_array($sqlShow))
		{
			$dataShow[] = array(	'detailID' => $dtShow['detailID'],
									'productBarcode' => $dtShow['productBarcode'],
									'productName' => $dtShow['productName'],
									'detailReturPrice' => rupiah($dtShow['detailReturPrice']),
									'detailReturQty' => $dtShow['detailReturQty'],
									'detailReturSubtotal' => rupiah($dtShow['detailReturSubtotal']),
									'no' => $i);
											
			$total = $total + $dtShow['detailReturSubtotal'];
			$i++;
		}
		
		$smarty->assign("total", $total);
		$smarty->assign("rupiah", rupiah($total));
		$smarty->assign("dataShow", $dataShow);
		
		// if member exists
		$supplierID = $_GET['supplierID'];
		if ($supplierID != '')
		{
			$querySupplier = "SELECT supplierName, supplierID, supplierCode, supplierAddress, supplierPhone FROM as_suppliers WHERE supplierCode = '$supplierID'";
			$sqlSupplier = mysqli_query($connect, $querySupplier);
			
			// fetch data
			$dtSupplier = mysqli_fetch_array($sqlSupplier);
			$smarty->assign("supplierID", $dtSupplier['supplierID']);
			$smarty->assign("supplierCode", $dtSupplier['supplierCode']);
			$smarty->assign("supplierName", $dtSupplier['supplierName']);
			$smarty->assign("supplierAddress", $dtSupplier['supplierAddress']);
			$smarty->assign("supplierPhone", $dtSupplier['supplierPhone']);
		}
	} // close bracket
	
	// if transaction is trx and action is search
	elseif ($module == 'trx' && $act == 'search')
	{
		$type = $_GET['searchType'];
		
		// if type based on invoice number
		if ($type == '1')
		{
			$trxNo = $_GET['trxNo'];
			
			// showing up the transaction
			$queryTrx = "SELECT * FROM as_retur_transactions WHERE invoiceReturID = '$trxNo'";
		}
		
		// if type based on member id
		elseif ($type == '2')
		{
			$supplierID = $_GET['supplierID'];
			$m1 = explode(" - ", $supplierID);
			
			// showing up the transactions
			$queryTrx = "SELECT * FROM as_retur_transactions WHERE supplierID = '$m1[0]' ORDER BY createdDate DESC LIMIT 30";
		}
		
		// if type based on start date and end date
		elseif ($type == '3')
		{
			$startDate = $_GET['startDate'];
			$endDate = $_GET['endDate'];
			
			// showing up the transactions
			$queryTrx = "SELECT * FROM as_retur_transactions WHERE trxDate BETWEEN '$startDate' AND '$endDate' ORDER BY createdDate ASC";
		}
		
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		// fetch data
		$no = 1;
		while ($dtTrx = mysqli_fetch_array($sqlTrx))
		{
			$trxDate = explode("-", $dtTrx['trxDate']);
			$time = explode(" ", $dtTrx['createdDate']);
			
			$dataTrx[] = array(	'trxID' => $dtTrx['trxID'],
								'invoiceReturID' => $dtTrx['invoiceReturID'],
								'supplierID' => $dtTrx['supplierID'],
								'trxFullName' => $dtTrx['trxFullName'],
								'trxDate' => $trxDate[2]."/".$trxDate[1]."/".$trxDate[0]." ".$time[1],
								'trxTotal' => rupiah($dtTrx['trxTotal']),
								'no' => $no 
								);
			$no++;
		}
		
		// assign data to the tpl
		$smarty->assign("dataTrx", $dataTrx);
		$smarty->assign("start", $startDate);
		$smarty->assign("end", $endDate);
		$smarty->assign("type", $type);
		
		// type conditions
		if ($type == '1'){
			$typeName = "Nomor Retur";
			$based = $trxNo;
		}
		elseif ($type == '2'){
			$typeName = "ID Supplier";
			$based = $m1[0];
		}
		elseif ($type == '3'){
			$typeName = "Periode";
			$based = tgl_indo($startDate)." s/d ".tgl_indo($endDate);
		}
		
		$smarty->assign("typeName", $typeName);
		$smarty->assign("based", $based);
	}

	// if module is transaction and action is preview
	elseif($module == 'trx' && $act == 'previewdetail')
	{
		// get the method value
		$invoiceID = $_GET['invoiceReturID'];
		$trxID = $_GET['trxID'];
		
		$queryTrx = "SELECT * FROM as_retur_transactions WHERE trxID = '$trxID' AND invoiceReturID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		$dataTrx = mysqli_fetch_array($sqlTrx);
		
		$smarty->assign("invoiceReturID", $invoiceID);
		$smarty->assign("trxID", $trxID);
		$smarty->assign("trxDate", tgl_indo($dataTrx['trxDate']));
		$smarty->assign("supplierID", $dataTrx['supplierID']);
		$smarty->assign("trxFullName", $dataTrx['trxFullName']);
		$smarty->assign("trxAddress", $dataTrx['trxAddress']);
		$smarty->assign("trxPhone", $dataTrx['trxPhone']);
		$smarty->assign("trxTotal", rupiah($dataTrx['trxTotal']));
		$smarty->assign("terbilang", Terbilang($dataTrx['trxTotal']));
		
		// showing up the service
		$queryDetail = "SELECT A.detailID, A.invoiceReturID, A.productBarcode, A.detailReturPrice, A.detailReturQty, A.detailReturSubtotal, B.productName 
		FROM as_retur_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceReturID = '$invoiceID'";
		
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productBarcode' => $dtDetail['productBarcode'],
									'productName' => $dtDetail['productName'],
									'detailReturPrice' => rupiah($dtDetail['detailReturPrice']),
									'detailReturQty' => $dtDetail['detailReturQty'],
									'detailReturSubtotal' => rupiah($dtDetail['detailReturSubtotal']),
									'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataDetail", $dataDetail);
	} // close bracket
	
	else
	{
		
	}
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>