<?php
// include header
include "header.php";
// set the tpl page
$page = "buy_transactions.tpl";

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
		$invoiceBuy = $_POST['fakturBuy'];
		$invoiceSupplier = $_POST['invoiceSupplier'];
		$trxDate = date('Y-m-d');
		$subtotal = $_POST['subtotal'];
		$discount = $_POST['discount'];
		$status = $_POST['status'];
		$dp = $_POST['dp'];
		$trxTerminDate = $_POST['trxTerminDate'];
		
		$trxTotal = $subtotal - $discount;
		
		if ($dp >= $trxTotal)
		{
			$trxDebt = "0";
		}
		else
		{
			$trxDebt = $trxTotal - $dp;
		}
		
		// save into the database
		$queryTrx = "INSERT INTO as_buy_transactions (	invoiceBuyID,
														invoiceSupplier,
														supplierID,
														trxFullName,
														trxAddress,
														trxPhone,
														trxDate,
														trxSubtotal,
														trxDiscount,
														trxTotal,
														trxDP,
														trxStatus,
														trxTerminDate,
														createdDate,
														createdUserID,
														modifiedDate,
														modifiedUserID)
											VALUES	(	'$fakturBuy',
														'$invoiceSupplier',
														'$supplierID',
														'$supplierName',
														'$supplierAddress',
														'$supplierPhone',
														'$trxDate',
														'$subtotal',
														'$discount',
														'$trxTotal',
														'$dp',
														'$status',
														'$trxTerminDate',
														'$createdDate',
														'$userID',
														'',
														'')";
		
		mysqli_query($connect, $queryTrx);
		
		$insertID = mysqli_insert_id($connect);
		
		if ($status == '2')
		{
			$queryDebt = "INSERT INTO as_debts (invoiceID,status,createdDate,createdUserID,modifiedDate,modifiedUserID)
			VALUES('$fakturBuy','1','$createdDate','$userID','','')";
			
			mysqli_query($connect, $queryDebt);
		}
		
		header("Location: buy_transactions.php?module=trx&act=preview&invoiceBuyID=".$invoiceBuy."&trxID=".$insertID);
	} // close bracket
	
	// if module is transaction and action is cancel
	elseif ($module == 'trx' && $act == 'cancel')
	{
		$invoiceBuyID = $_GET['invoiceBuyID'];
		
		$queryDetail = "DELETE FROM as_buy_detail_transactions WHERE invoiceBuyID = '$invoiceBuyID'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		if ($sqlDetail){
			$queryDelete = "DELETE FROM as_buy_transactions WHERE invoiceBuyID = '$invoiceBuyID'";
			mysqli_query($connect, $queryDelete);
		}
			
		$_SESSION['fakturBuy'] = "";
		
		header("Location: buy_transactions.php?module=trx&act=add");
	} // close bracket
	
	// if module is transactions and act is update
	elseif ($module == 'trx' && $act == 'update')
	{
		// get value method and insert to variable
		$modifiedDate = date('Y-m-d H:i:s');
		$invoiceID = $_POST['fakturBuy'];
		$trxID = $_POST['trxID'];
		$userID = $_SESSION['userID'];
		$supplierID = $_POST['supplierIDD'];
		$supplierName = $_POST['trxFullName'];
		$supplierAddress = $_POST['trxAddress'];
		$supplierPhone = $_POST['trxPhone'];
		$subtotal = $_POST['subtotal'];
		$discount = $_POST['discount'];
		$trxTerminDate = $_POST['trxTerminDate'];
		$trxDP = $_POST['dp'];
		$status = $_POST['status'];
		
		$trxTotal = $subtotal - $discount;
		
		$queryTrx = "UPDATE as_buy_transactions SET	supplierID = '$supplierID',
													trxFullName = '$supplierName',
													trxAddress = '$supplierAddress',
													trxPhone = '$supplierPhone',
													trxSubtotal = '$subtotal',
													trxDiscount = '$discount',
													trxTotal = '$trxTotal',
													trxDP = '$trxDP',
													trxStatus = '$status',
													trxTerminDate = '$trxTerminDate',
													modifiedDate = '$modifiedDate',
													modifiedUserID = '$userID'
													WHERE invoiceBuyID = '$invoiceID' AND trxID = '$trxID'";
		mysqli_query($connect, $queryTrx);
		
		if ($status == '2')
		{
			$queryDebt = "INSERT INTO as_debts (invoiceID,status,createdDate,createdUserID,modifiedDate,modifiedUserID)
			VALUES('$invoiceID','1','$createdDate','$userID','','')";
			
			mysqli_query($connect, $queryDebt);
		}
		
		header("Location: buy_transactions.php?module=trx&act=preview&invoiceBuyID=".$invoiceID."&trxID=".$trxID);
	} // close bracket
	
	// if module is transaction and action is preview
	elseif($module == 'trx' && $act == 'preview')
	{
		// get the method value
		$invoiceID = $_GET['invoiceBuyID'];
		$trxID = $_GET['trxID'];
		
		$queryTrx = "SELECT * FROM as_buy_transactions WHERE trxID = '$trxID' AND invoiceBuyID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		$dataTrx = mysqli_fetch_array($sqlTrx);
		$kurang = $dataTrx['trxTotal'] - $dataTrx['trxDP'];
		
		if ($dataTrx['trxStatus'] == '1'){
			$status = "Cash";
		}
		else{
			$status = "Termin";
		}
		
		$smarty->assign("invoiceBuyID", $invoiceID);
		$smarty->assign("trxID", $dataTrx['trxID']);
		$smarty->assign("supplierID", $dataTrx['supplierID']);
		$smarty->assign("trxFullName", $dataTrx['trxFullName']);
		$smarty->assign("trxAddress", $dataTrx['trxAddress']);
		$smarty->assign("trxPhone", $dataTrx['trxPhone']);
		$smarty->assign("trxDate", tgl_indo($dataTrx['trxDate']));
		$smarty->assign("trxTerminDate", tgl_indo2($dataTrx['trxTerminDate']));
		$smarty->assign("trxSubtotal", rupiah($dataTrx['trxSubtotal']));
		$smarty->assign("trxDiscount", rupiah($dataTrx['trxDiscount']));
		$smarty->assign("trxTotal", rupiah($dataTrx['trxTotal']));
		$smarty->assign("kurang", rupiah($kurang));
		$smarty->assign("trxDP", rupiah($dataTrx['trxDP']));
		$smarty->assign("terbilang", Terbilang($dataTrx['trxTotal']));
		$smarty->assign("status", $status);
		$smarty->assign("trxStatus", $dataTrx['trxStatus']);
		$smarty->assign("invoiceSupplier", $dataTrx['invoiceSupplier']);
		
		// showing up the service
		$queryDetail = "SELECT A.detailID, A.invoiceBuyID, A.productBarcode, A.detailBuyPrice, A.detailBuyQty, A.detailBuySubtotal, B.productName 
		FROM as_buy_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceBuyID = '$invoiceID'";
		
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productBarcode' => $dtDetail['productBarcode'],
									'productName' => $dtDetail['productName'],
									'detailBuyPrice' => rupiah($dtDetail['detailBuyPrice']),
									'detailBuyQty' => $dtDetail['detailBuyQty'],
									'detailBuySubtotal' => rupiah($dtDetail['detailBuySubtotal']),
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

		$queryTrx = "DELETE FROM as_buy_detail_transactions WHERE detailID = '$detailID' AND invoiceBuyID = '$fakturBuy'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		// redirect to the main transaction page
		header("Location: buy_transactions.php?module=trx&act=add");
	} //close bracket
	
	// if module is transaction and action is delete
	elseif ($module == 'trx' && $act == 'deleteedit')
	{
		$detailID = $_GET['detailID'];
		$invoiceID = $_GET['invoiceBuyID'];
		$trxID = $_GET['trxID'];

		$queryTrx = "DELETE FROM as_buy_detail_transactions WHERE detailID = '$detailID' AND invoiceBuyID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		// redirect to the main transaction page
		header("Location: buy_transactions.php?module=trx&act=edit&invoiceBuyID=".$invoiceID."&trxID=".$trxID);
	} //close bracket
	
	// if module is transaction and action is delete trx
	elseif ($module == 'trx' && $act == 'deletetrx')
	{
		$invoiceID = $_GET['invoiceBuyID'];
		$trxID = $_GET['trxID'];
		$type = $_GET['type'];
		$supplierID = $_GET['supplierID'];
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		
		$queryTrx = "SELECT * FROM as_buy_detail_transactions WHERE invoiceBuyID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		while ($dtTrx = mysqli_fetch_array($sqlTrx))
		{
			$qty = $dtTrx['detailBuyQty'];
			$productBarcode = $dtTrx['productBarcode'];
			
			$queryUpdate = "UPDATE as_products SET productStock=productStock-$qty WHERE productBarcode = '$productBarcode'";
			$update = mysqli_query($connect, $queryUpdate);
		}
		
		if ($update)
		{
			// delete transactions
			$queryDetailDelete = "DELETE FROM as_buy_detail_transactions WHERE invoiceBuyID = '$invoiceID'";
			$queryDelete = "DELETE FROM as_buy_transactions WHERE invoiceBuyID = '$invoiceID'";
			
			mysqli_query($connect, $queryDetailDelete);
			mysqli_query($connect, $queryDelete);
		}
		
		
		if ($type == '1'){
			header("Location: buy_transactions.php?module=trx&act=search&searchType=1&trxNo=".$invoiceID."&code=3");
		}
		elseif ($type == '2'){
			header("Location: buy_transactions.php?module=trx&act=search&searchType=2&supplierID=".$supplierID."&code=3");
		}
		elseif ($type == '3'){
			header("Location: buy_transactions.php?module=trx&act=search&searchType=3&startDate=".$startDate."&endDate=".$endDate."&code=3");
		}
		else{
			header("Location: buy_transactions.php");
		}
	} //close bracket
	
	
	// if module is transaction and action is edit
	elseif ($module == 'trx' && $act == 'edit')
	{
		$trxID = $_GET['trxID'];
		$invoiceID = $_GET['invoiceBuyID'];
		
		$smarty->assign("invoiceBuyID", $invoiceID);
		$smarty->assign("trxID", $trxID);
		
		$queryMain = "SELECT * FROM as_buy_transactions WHERE invoiceBuyID = '$invoiceID' AND trxID = '$trxID'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		$smarty->assign("invoiceSupplier", $dataMain['invoiceSupplier']);
		$smarty->assign("status", $dataMain['trxStatus']);
		$smarty->assign("trxTerminDate", $dataMain['trxTerminDate']);
		
		$queryDebt = "DELETE FROM as_debts WHERE invoiceID = '$invoiceID'";
		mysqli_query($connect, $queryDebt);
		
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
				
		$queryTrx = "SELECT A.detailID, A.invoiceBuyID, A.productBarcode, A.detailBuyPrice, A.detailBuyQty, A.detailBuySubtotal, B.productName
		FROM as_buy_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceBuyID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		// fetch data
		$i = 1;
		while ($dtTrx = mysqli_fetch_array($sqlTrx))
		{
			
			$dataTrx[] = array(	'detailID' => $dtTrx['detailID'],
								'productBarcode' => $dtTrx['productBarcode'],
								'productName' => $dtTrx['productName'],
								'detailBuyPrice' => rupiah($dtTrx['detailBuyPrice']),
								'detailBuyQty' => $dtTrx['detailBuyQty'],
								'detailBuySubtotal' => rupiah($dtTrx['detailBuySubtotal']),
								'no' => $i);
			$total = $total + $dtTrx['detailBuySubtotal'];
			$i++;
		}
		
		$ex = explode(" ", $dataMain['createdDate']);
		$ex2 = explode("-", $ex[0]);
		
		// assign to the tpl
		$smarty->assign("trxDate", $ex2[2]."/".$ex2[1]."/".$ex2[0]." ".$ex[1]);
		$smarty->assign("dataShow", $dataTrx);
		$smarty->assign("total", $total);
		$smarty->assign("trxDP", $dataMain['trxDP']);
		$smarty->assign("trxDiscount", $dataMain['trxDiscount']);
		$smarty->assign("rupiah", rupiah($total));
	} //close bracket
	
	// if module is transaction and action is finish
	elseif ($module == 'trx' && $act == 'finish')
	{
		$status = $_GET['status'];
		$invoiceID = $_GET['invoiceBuyID'];
		
		$queryDetail = "SELECT * FROM as_buy_detail_transactions WHERE invoiceBuyID = '$invoiceID'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// update data
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$qty = $dtDetail['detailBuyQty'];
			$price = $dtDetail['detailBuyPrice'];
			$queryProduct = "UPDATE as_products SET productBuyPrice = '$price', productStock=productStock+$qty WHERE productBarcode = '$dtDetail[productBarcode]'";
			mysqli_query($connect, $queryProduct);
		}
		
		$_SESSION['fakturBuy'] = "";
	
		header("Location: buy_transactions.php?module=trx&act=add");
	} // close bracket
	
	// if module is transaction and action is add
	elseif ($module == 'trx' && $act == 'add')
	{
		$smarty->assign("fakturBuy", $_SESSION['fakturBuy']);
		$smarty->assign("tanggal", date('d/m/Y h:i:s'));
		$smarty->assign("time", date('H:i'));
		
		$outletID = $_SESSION['outletID'];
		
		// showing up the transactions
		$queryShow = "SELECT A.detailID, A.invoiceBuyID, A.detailBuyPrice, A.detailBuyQty, A.detailBuySubtotal, B.productBarcode, B.productName
					FROM as_buy_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode 
					WHERE A.invoiceBuyID = '$fakturBuy'";
		$sqlShow = mysqli_query($connect, $queryShow);
		$dataShow = array();
		// fetch data
		$i = 1;
		while ($dtShow = mysqli_fetch_array($sqlShow))
		{
			$dataShow[] = array(	'detailID' => $dtShow['detailID'],
									'productBarcode' => $dtShow['productBarcode'],
									'productName' => $dtShow['productName'],
									'detailBuyPrice' => rupiah($dtShow['detailBuyPrice']),
									'detailBuyQty' => $dtShow['detailBuyQty'],
									'detailBuySubtotal' => rupiah($dtShow['detailBuySubtotal']),
									'no' => $i);
											
			$total = $total + $dtShow['detailBuySubtotal'];
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
	
	// if transaction is trx and action is pending
	elseif ($module == 'trx' && $act == 'pending')
	{
		// create new object pagination
		$p = new PaginationTrxPending;
		// limit 10 data for page
		$limit  = 10;
		$position = $p->searchPosition($limit);
		
		$queryTrx = "SELECT * FROM as_sales_transactions WHERE trxStatus = '2' ORDER BY createdDate DESC LIMIT $position,$limit";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		// fetch data
		$no = 1;
		while ($dtTrx = mysqli_fetch_array($sqlTrx))
		{
			$ex = explode(" ", $dtTrx['createdDate']);
			$exp = explode("-", $ex[0]);
			
			$dataTrx[] = array(	'trxID' => $dtTrx['trxID'],
								'memberID' => $dtTrx['memberID'],
								'invoiceID' => $dtTrx['invoiceID'],
								'trxFullName' => $dtTrx['trxFullName'],
								'trxPhone' => $dtTrx['trxPhone'],
								'trxDate' => $exp[2]."/".$exp[1]."/".$exp[0]." ".$ex[1],
								'trxTotal' => rupiah($dtTrx['trxTotal']),
								'no' => $no
								);
			$no++;
		}
		
		
		$countTrx = "SELECT * FROM as_sales_transactions WHERE trxStatus = '2'";
		$amountData = mysqli_num_rows(mysqli_query($connect, $countTrx));
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		// assign to the tpl
		$smarty->assign("dataTrx", $dataTrx);
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
			$queryTrx = "SELECT * FROM as_buy_transactions WHERE invoiceBuyID = '$trxNo'";
			
			$nums = mysqli_num_rows(mysqli_query($connect, $queryTrx));
			if ($nums == 0){
				// showing up the transaction
				$queryTrx = "SELECT * FROM as_buy_transactions WHERE invoiceSupplier = '$trxNo'";
			}
		}
		
		// if type based on member id
		elseif ($type == '2')
		{
			$supplierID = $_GET['supplierID'];
			$m1 = explode(" - ", $supplierID);
			
			// showing up the transactions
			$queryTrx = "SELECT * FROM as_buy_transactions WHERE supplierID = '$m1[0]' ORDER BY createdDate DESC LIMIT 30";
		}
		
		// if type based on start date and end date
		elseif ($type == '3')
		{
			$startDate = $_GET['startDate'];
			$endDate = $_GET['endDate'];
			
			// showing up the transactions
			$queryTrx = "SELECT * FROM as_buy_transactions WHERE trxDate BETWEEN '$startDate' AND '$endDate' ORDER BY createdDate ASC";
		}
		
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		// fetch data
		$no = 1;
		while ($dtTrx = mysqli_fetch_array($sqlTrx))
		{
			$trxDate = explode("-", $dtTrx['trxDate']);
			$time = explode(" ", $dtTrx['createdDate']);
			
			$dataTrx[] = array(	'trxID' => $dtTrx['trxID'],
								'invoiceBuyID' => $dtTrx['invoiceBuyID'],
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
			$typeName = "Nomor Pembelian";
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
		$invoiceID = $_GET['invoiceBuyID'];
		$trxID = $_GET['trxID'];
		
		$queryTrx = "SELECT * FROM as_buy_transactions WHERE trxID = '$trxID' AND invoiceBuyID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		$dataTrx = mysqli_fetch_array($sqlTrx);
		$kurang = $dataTrx['trxTotal'] - $dataTrx['trxDP'];
		
		if ($dataTrx['trxStatus'] == '1'){
			$status = "Cash";
		}
		else{
			$status = "Termin";
		}
		
		$smarty->assign("invoiceBuyID", $invoiceID);
		$smarty->assign("trxID", $trxID);
		$smarty->assign("trxDate", tgl_indo($dataTrx['trxDate']));
		$smarty->assign("supplierID", $dataTrx['supplierID']);
		$smarty->assign("trxFullName", $dataTrx['trxFullName']);
		$smarty->assign("trxAddress", $dataTrx['trxAddress']);
		$smarty->assign("trxPhone", $dataTrx['trxPhone']);
		$smarty->assign("trxSubtotal", rupiah($dataTrx['trxSubtotal']));
		$smarty->assign("trxDiscount", rupiah($dataTrx['trxDiscount']));
		$smarty->assign("trxTotal", rupiah($dataTrx['trxTotal']));
		$smarty->assign("terbilang", Terbilang($dataTrx['trxTotal']));
		$smarty->assign("kurang", rupiah($kurang));
		$smarty->assign("trxDP", rupiah($dataTrx['trxDP']));
		$smarty->assign("trxTerminDate", tgl_indo2($dataTrx['trxTerminDate']));
		$smarty->assign("trxStatus", $dataTrx['trxStatus']);
		$smarty->assign("status", $status);
		$smarty->assign("invoiceSupplier", $dataTrx['invoiceSupplier']);
		
		// showing up the service
		$queryDetail = "SELECT A.detailID, A.invoiceBuyID, A.productBarcode, A.detailBuyPrice, A.detailBuyQty, A.detailBuySubtotal, B.productName 
		FROM as_buy_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceBuyID = '$invoiceID'";
		
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productBarcode' => $dtDetail['productBarcode'],
									'productName' => $dtDetail['productName'],
									'detailBuyPrice' => rupiah($dtDetail['detailBuyPrice']),
									'detailBuyQty' => $dtDetail['detailBuyQty'],
									'detailBuySubtotal' => rupiah($dtDetail['detailBuySubtotal']),
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