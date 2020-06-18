<?php
// include header
include "header.php";
// set the tpl page
$page = "sales_transactions.tpl";

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
	
	// if module is transaction and action is input
	if ($module == 'trx' && $act == 'input')
	{
		$createdDate = date('Y-m-d H:i:s');
		$userID = $_SESSION['userID'];
		$memberID = $_POST['memberID'];
		$invoice = $_POST['faktur'];
		$trxFullName = $_POST['memberFullName'];
		$trxAddress = $_POST['memberAddress'];
		$trxPhone = $_POST['memberPhone'];
		$trxDate = date('Y-m-d');
		$trxSubtotal = $_POST['subtotal'];
		$trxModal = $_POST['trxModal'];
		$trxDP = $_POST['dp'];
		$ppn = $_POST['ppn'];
		$trxTerminDate = $_POST['trxTerminDate'];
		$trxDiscount = $_POST['discTotal'];
		$trxStatus = $_POST['status'];
		
		$trxTotal = $trxSubtotal + $ppn;
		
		if ($trxDP >= $trxTotal)
		{
			$trxDebt = "0";
			$trxChange = $trxDP - $trxTotal;
		}
		else
		{
			$trxDebt = $trxTotal - $trxDP;
			$trxChange = "0";
		}
		
		// 1 = cash/tunai/finish
		// 2 = pending
		// 3 = termin
		
		$queryTrx = "INSERT INTO as_sales_transactions (memberID,
														invoiceID,
														trxFullName,
														trxAddress,
														trxPhone,
														trxDate,
														trxTotalModal,
														trxSubtotal,
														trxDiscount,
														trxPPN,
														trxTotal,
														trxPay,
														trxChange,
														trxStatus,
														trxTerminDate,
														createdDate,
														createdUserID,
														modifiedDate,
														modifiedUserID)
												VALUES(	'$memberID',
														'$invoice',
														'$trxFullName',
														'$trxAddress',
														'$trxPhone',
														'$trxDate',
														'$trxModal',
														'$trxSubtotal',
														'$trxDiscount',
														'$ppn',
														'$trxTotal',
														'$trxDP',
														'$trxChange',
														'$trxStatus',
														'$trxTerminDate',
														'$createdDate',
														'$userID',
														'',
														'')";
		mysqli_query($connect, $queryTrx);
		
		$insertID = mysqli_insert_id($connect);
		
		if ($trxStatus == '3')
		{
			$queryReceivable = "INSERT INTO as_receivables (invoiceID,status,createdDate,createdUserID,modifiedDate,modifiedUserID)
			VALUES('$invoice','1','$createdDate','$userID','','')";
			
			mysqli_query($connect, $queryReceivable);
		}
		
		header("Location: sales_transactions.php?module=trx&act=preview&invoiceID=".$invoice."&trxID=".$insertID);
	} // close bracket
	
	// if module is transactions and act is update
	elseif ($module == 'trx' && $act == 'update')
	{
		// get value method and insert to variable
		$modifiedDate = date('Y-m-d H:i:s');
		$invoiceID = $_POST['faktur'];
		$trxID = $_POST['trxID'];
		$userID = $_SESSION['userID'];
		$memberID = $_POST['memberIDD'];
		$memberFullName = $_POST['memberFullName'];
		$memberAddress = $_POST['memberAddress'];
		$memberPhone = $_POST['memberPhone'];
		$trxDiscount = $_POST['discTotal'];
		$trxDP = $_POST['dp'];
		$trxSubtotal = $_POST['subtotal'];
		$trxModal = $_POST['trxModal'];
		$status = $_POST['status'];
		$pending = $_POST['pending'];
		$ppn = $_POST['ppn'];
		$trxTerminDate = $_POST['trxTerminDate'];
		
		// count total
		$trxTotal = $trxSubtotal + $ppn;
		
		// set the change
		if ($trxDP >= $trxTotal)
		{
			$trxChange = $trxDP - $trxTotal;
		}
		else
		{
			$trxChange = "0";
		}
		
		// update sales transactions
		$queryTrx = "UPDATE as_sales_transactions SET	memberID = '$memberID',
														trxFullName = '$memberFullName',
														trxAddress = '$memberAddress',
														trxPhone = '$memberPhone',
														trxTotalModal = '$trxModal',
														trxSubtotal = '$trxSubtotal',
														trxDiscount = '$trxDiscount',
														trxPPN = '$ppn',
														trxTotal = '$trxTotal',
														trxPay = '$trxDP',
														trxChange = '$trxChange',
														trxStatus = '$status',
														trxTerminDate = '$trxTerminDate',
														modifiedDate = '$modifiedDate',
														modifiedUserID = '$userID'
														WHERE invoiceID = '$invoiceID' AND trxID = '$trxID'";
		mysqli_query($connect, $queryTrx);
		
		// if the status is 3 (termin)
		if ($status == '3')
		{
			// search the receivable's card, what the receivables are already exist in the table
			$queryReceivable = "SELECT * FROM as_receivables WHERE invoiceID = '$invoiceID'";
			$sqlReceivable = mysqli_query($connect, $queryReceivable);
			$numReceivable = mysqli_num_rows($sqlReceivable);
			
			// if the receivable is not found or still null
			if ($numReceivable == '0')
			{
				$querySave = "INSERT INTO as_receivables (invoiceID, status, createdDate, createdUserID, modifiedDate, modifiedUserID)
				VALUES('$invoiceID','1','$createdDate','$userID','','')";
				
				mysqli_query($connect, $querySave);
			}
			// if the receivable is found or is not null
			else
			{
				$querySave = "UPDATE as_receivables SET modifiedDate = '$modifiedDate', modifiedUserID = '$userID' WHERE invoiceID = '$invoiceID'";
				mysqli_query($connect, $querySave);
			}
		}
		// if the status is not 3 (termin)
		else
		{
			// delete all data in the receivable's table
			$queryDelete = "DELETE FROM as_receivables WHERE invoiceID = '$invoiceID'";
			mysqli_query($connect, $queryDelete);
		}
		
		// if the pending is indicated "yes"
		if ($pending == 'yes'){
			header("Location: sales_transactions.php?module=trx&act=previewdetail&invoiceID=".$invoiceID."&trxID=".$trxID);
		}
		else{
			header("Location: sales_transactions.php?module=trx&act=preview&invoiceID=".$invoiceID."&trxID=".$trxID);
		}
	} // close bracket
	
	// if module is transaction and action is preview
	elseif($module == 'trx' && $act == 'preview')
	{
		// get the method value
		$invoiceID = $_GET['invoiceID'];
		$trxID = $_GET['trxID'];
		
		$queryTrx = "SELECT * FROM as_sales_transactions WHERE trxID = '$trxID' AND invoiceID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		$dataTrx = mysqli_fetch_array($sqlTrx);
		
		if ($dataTrx['trxStatus'] == '1'){
			$status = "Cash";
		}
		elseif ($dataTrx['trxStatus'] == '2'){
			$status = "Pending";
		}
		else{
			$status = "Termin";
		}
		
		$terminDate = explode("-", $dataTrx['trxTerminDate']);
		
		$smarty->assign("invoiceID", $invoiceID);
		$smarty->assign("trxID", $trxID);
		$smarty->assign("trxDate", tgl_indo($dataTrx['trxDate']));
		$smarty->assign("memberID", $dataTrx['memberID']);
		$smarty->assign("trxFullName", $dataTrx['trxFullName']);
		$smarty->assign("trxAddress", $dataTrx['trxAddress']);
		$smarty->assign("trxPhone", $dataTrx['trxPhone']);
		$smarty->assign("trxSubtotal", rupiah($dataTrx['trxSubtotal']));
		$smarty->assign("trxDiscount", rupiah($dataTrx['trxDiscount']));
		$smarty->assign("trxTotal", rupiah($dataTrx['trxTotal']));
		$smarty->assign("trxPay", rupiah($dataTrx['trxPay']));
		$smarty->assign("trxChange", rupiah($dataTrx['trxChange']));
		$smarty->assign("trxDebt", rupiah($dataTrx['trxDebt']));
		$smarty->assign("status", $status);
		$smarty->assign("trxPPN", rupiah($dataTrx['trxPPN']));
		$smarty->assign("terminDate", $terminDate[2]."/".$terminDate[1]."/".$terminDate[0]);
		$smarty->assign("trxStatus", $dataTrx['trxStatus']);
		$smarty->assign("terbilang", Terbilang($dataTrx['trxTotal']));
		
		// showing up the service
		$queryDetail = "SELECT A.detailID, A.invoiceID, A.productBarcode, A.detailPrice, A.detailQty, A.detailSubtotal, B.productName, A.discPercent, A.note 
		FROM as_sales_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceID = '$invoiceID'";
		
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productBarcode' => $dtDetail['productBarcode'],
									'productName' => $dtDetail['productName'],
									'detailPrice' => rupiah($dtDetail['detailPrice']),
									'discPercent' => $dtDetail['discPercent'],
									'detailQty' => $dtDetail['detailQty'],
									'note' => $dtDetail['note'],
									'detailSubtotal' => rupiah($dtDetail['detailSubtotal']),
									'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataDetail", $dataDetail);
	} // close bracket
	
	// if module is transaction and action is preview
	elseif($module == 'trx' && $act == 'previewdetail')
	{
		// get the method value
		$invoiceID = $_GET['invoiceID'];
		$trxID = $_GET['trxID'];
		$pending = $_GET['pending'];
		
		$queryTrx = "SELECT * FROM as_sales_transactions WHERE trxID = '$trxID' AND invoiceID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		$dataTrx = mysqli_fetch_array($sqlTrx);
		
		if ($dataTrx['trxStatus'] == '1'){
			$status = "Cash";
		}
		elseif ($dataTrx['trxStatus'] == '2'){
			$status = "Pending";
		}
		
		$smarty->assign("invoiceID", $invoiceID);
		$smarty->assign("trxID", $trxID);
		$smarty->assign("pending", $pending);
		$smarty->assign("trxDate", tgl_indo($dataTrx['trxDate']));
		$smarty->assign("memberID", $dataTrx['memberID']);
		$smarty->assign("trxFullName", $dataTrx['trxFullName']);
		$smarty->assign("trxAddress", $dataTrx['trxAddress']);
		$smarty->assign("trxPhone", $dataTrx['trxPhone']);
		$smarty->assign("trxSubtotal", rupiah($dataTrx['trxSubtotal']));
		$smarty->assign("trxDiscount", rupiah($dataTrx['trxDiscount']));
		$smarty->assign("trxTotal", rupiah($dataTrx['trxTotal']));
		$smarty->assign("trxPay", rupiah($dataTrx['trxPay']));
		$smarty->assign("trxPPN", rupiah($dataTrx['trxPPN']));
		$smarty->assign("trxChange", rupiah($dataTrx['trxChange']));
		$smarty->assign("status", $status);
		$smarty->assign("trxStatus", $dataTrx['trxStatus']);
		$smarty->assign("terbilang", Terbilang($dataTrx['trxTotal']));
		
		// showing up the service
		$queryDetail = "SELECT A.detailID, A.invoiceID, A.productBarcode, A.detailPrice, A.detailQty, A.detailSubtotal, B.productName, A.discPercent 
		FROM as_sales_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceID = '$invoiceID'";
		
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productBarcode' => $dtDetail['productBarcode'],
									'productName' => $dtDetail['productName'],
									'detailPrice' => rupiah($dtDetail['detailPrice']),
									'detailQty' => $dtDetail['detailQty'],
									'detailSubtotal' => rupiah($dtDetail['detailSubtotal']),
									'discPercent' => $dtDetail['discPercent'],
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
		$memberID = $_GET['memberID'];

		$queryTrx = "DELETE FROM as_sales_detail_transactions WHERE detailID = '$detailID' AND invoiceID = '$faktur'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		// redirect to the main transaction page
		if ($memberID != ''){
			header("Location: sales_transactions.php?module=trx&act=add&memberID=".$memberID);
		}
		else{
			header("Location: sales_transactions.php?module=trx&act=add");
		}
	} //close bracket
	
	// if module is transaction and action is delete
	elseif ($module == 'trx' && $act == 'deleteedit')
	{
		$detailID = $_GET['detailID'];
		$invoiceID = $_GET['invoiceID'];
		$trxID = $_GET['trxID'];
		$pending = $_GET['pending'];

		$queryTrx = "DELETE FROM as_sales_detail_transactions WHERE detailID = '$detailID' AND invoiceID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		// redirect to the main transaction page
		if ($pending == 'yes'){
			header("Location: sales_transactions.php?module=trx&act=edit&invoiceID=".$invoiceID."&trxID=".$trxID."&pending=".$pending);
		}
		else{
			header("Location: sales_transactions.php?module=trx&act=edit&invoiceID=".$invoiceID."&trxID=".$trxID);
		}
	} //close bracket
	
	// if module is transaction and action is delete trx
	elseif ($module == 'trx' && $act == 'deletetrx')
	{
		$invoiceID = $_GET['invoiceID'];
		$trxID = $_GET['trxID'];
		$type = $_GET['type'];
		$memberID = $_GET['memberID'];
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		$status = $_GET['status'];
		
		$queryTrx = "SELECT * FROM as_sales_detail_transactions WHERE invoiceID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		while ($dtTrx = mysqli_fetch_array($sqlTrx))
		{
			if ($status == '1'){
				$qty = $dtTrx['detailQty'];
				$productBarcode = $dtTrx['productBarcode'];
				
				$queryUpdate = "UPDATE as_products SET productStock=productStock+$qty WHERE productBarcode = '$productBarcode'";
				$update = mysqli_query($connect, $queryUpdate);
			}
		}
		
		// delete transactions
		$queryDetailDelete = "DELETE FROM as_sales_detail_transactions WHERE invoiceID = '$invoiceID'";
		$queryDelete = "DELETE FROM as_sales_transactions WHERE invoiceID = '$invoiceID'";
		
		mysqli_query($connect, $queryDetailDelete);
		mysqli_query($connect, $queryDelete);
		
		
		if ($type == '1'){
			header("Location: sales_transactions.php?module=trx&act=search&searchType=1&trxNo=".$invoiceID."&code=3");
		}
		elseif ($type == '2'){
			header("Location: sales_transactions.php?module=trx&act=search&searchType=2&memberID=".$memberID."&code=3");
		}
		elseif ($type == '3'){
			header("Location: sales_transactions.php?module=trx&act=search&searchType=3&startDate=".$startDate."&endDate=".$endDate."&code=3");
		}
		else{
			header("Location: sales_transactions.php?module=trx&act=pending&code=3");
		}
	} //close bracket
	
	
	// if module is transaction and action is edit
	elseif ($module == 'trx' && $act == 'edit')
	{
		$trxID = $_GET['trxID'];
		$invoiceID = $_GET['invoiceID'];
		$yes = $_GET['pending'];
		
		$smarty->assign("invoiceID", $invoiceID);
		$smarty->assign("trxID", $trxID);
		$smarty->assign("pending", $yes);
		
		$queryMain = "SELECT * FROM as_sales_transactions WHERE invoiceID = '$invoiceID' AND trxID = '$trxID'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		$trxTerminDate = explode("-", $dataMain['trxTerminDate']);
		$smarty->assign("trxTerminDate", $dataMain['trxTerminDate']);
		$smarty->assign("trxTerminDateIndo", $trxTerminDate[2]."/".$trxTerminDate[1]."/".$trxTerminDate[0]);
		
		// if member exists
		$memberID = $_GET['memberID'];
		if ($memberID != '')
		{
			$queryMember = "SELECT memberFullName, memberID, memberCode, memberAddress, memberPhone FROM as_members WHERE memberCode = '$memberID'";
			$sqlMember = mysqli_query($connect, $queryMember);
			
			// fetch data
			$dtMember = mysqli_fetch_array($sqlMember);
			
			$smarty->assign("memberID", $dtMember['memberID']);
			$smarty->assign("memberCode", $dtMember['memberCode']);
			$smarty->assign("memberFullName", $dtMember['memberFullName']);
			$smarty->assign("memberAddress", $dtMember['memberAddress']);
			$smarty->assign("memberPhone", $dtMember['memberPhone']);
		}
		else{
			$smarty->assign("memberCode", $dataMain['memberID']);
			$smarty->assign("memberFullName", $dataMain['trxFullName']);
			$smarty->assign("memberAddress", $dataMain['trxAddress']);
			$smarty->assign("memberPhone", $dataMain['trxPhone']);
		}
		$smarty->assign("status", $dataMain['trxStatus']);
		$smarty->assign("trxDate", $dataMain['createdDate']);
		$smarty->assign("trxPay", $dataMain['trxPay']);
		$smarty->assign("trxDiscount", $dataMain['trxDiscount']);
				
		$queryTrx = "SELECT A.detailID, A.invoiceID, A.productBarcode, A.detailPrice, A.detailQty, A.detailSubtotal, A.discPercent, A.discTotal, A.note, B.productName
		FROM as_sales_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceID = '$invoiceID'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		// fetch data
		$i = 1;
		while ($dtTrx = mysqli_fetch_array($sqlTrx))
		{
			
			$dataTrx[] = array(	'detailID' => $dtTrx['detailID'],
								'productBarcode' => $dtTrx['productBarcode'],
								'productName' => $dtTrx['productName'],
								'detailPrice' => rupiah($dtTrx['detailPrice']),
								'detailQty' => $dtTrx['detailQty'],
								'detailSubtotal' => rupiah($dtTrx['detailSubtotal']),
								'discPercent' => $dtTrx['discPercent'],
								'note' => $dtTrx['note'],
								'no' => $i);
			$total = $total + $dtTrx['detailSubtotal'];
			$discTotal = $discTotal + $dtTrx['discTotal'];
			$trxModal = $trxModal + $dtTrx['detailSubtotalModal'];
			$i++;
		}

		$ppn = ($dataIdentity['identityPPN']/100 * $total);
		$ppnrupiah = rupiah($ppn);
		
		$grandtotal = $total + $ppn;
		$grandtotalrupiah = rupiah($grandtotal);

		$smarty->assign("ppn", $ppn);
		$smarty->assign("ppnrupiah", $ppnrupiah);
		$smarty->assign("grandtotal", $grandtotal);
		$smarty->assign("grandtotalrupiah", $grandtotalrupiah);
		
		// assign to the tpl
		$smarty->assign("dataShow", $dataTrx);
		$smarty->assign("total", $total);
		$smarty->assign("rupiah", rupiah($total));
		$smarty->assign("discTotal", $discTotal);
		$smarty->assign("discTotalRupiah", rupiah($discTotal));
		$smarty->assign("modal", $trxModal);
		
	} //close bracket
	
	// if module is transaction and action is finish
	elseif ($module == 'trx' && $act == 'finish')
	{
		$status = $_GET['status'];
		$invoiceID = $_GET['invoiceID'];
		$pending = $_GET['pending'];
		
		if ($status == '1' || $status == '3')
		{
			$queryDetail = "SELECT A.detailQty, A.productBarcode FROM as_sales_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode WHERE A.invoiceID = '$invoiceID'";
			$sqlDetail = mysqli_query($connect, $queryDetail);
			
			// update data
			while ($dtDetail = mysqli_fetch_array($sqlDetail))
			{
				$qty = $dtDetail['detailQty'];
				$queryProduct = "UPDATE as_products SET productStock=productStock-$qty WHERE productBarcode = '$dtDetail[productBarcode]'";
				mysqli_query($connect, $queryProduct);
			}
			
			$_SESSION['faktur'] = "";
		}
		
		else
		{
			$_SESSION['faktur'] = "";
		}
		?>
		<?php
		if ($pending == 'yes'){
			header("Location: sales_transactions.php?module=trx&act=pending");
		}
		else{
			header("Location: sales_transactions.php?module=trx&act=add");
		}
	} // close bracket
	
	// if module is transaction and action is add
	elseif ($module == 'trx' && $act == 'add')
	{
		$smarty->assign("faktur", $_SESSION['faktur']);
		$smarty->assign("tanggal", date('d/m/Y h:i:s'));
		$smarty->assign("time", date('H:i'));
		
		// showing up the transactions
		$queryShow = "SELECT A.detailID, A.invoiceID, A.detailPrice, A.detailQty, A.discPercent, A.discTotal, A.detailModal, A.detailSubtotalModal, A.detailSubtotal, B.productBarcode, B.productName
					FROM as_sales_detail_transactions A INNER JOIN as_products B ON A.productBarcode=B.productBarcode 
					WHERE A.invoiceID = '$faktur'";
		$sqlShow = mysqli_query($connect, $queryShow);
		$dataShow = array();
		// fetch data
		$i = 1;
		while ($dtShow = mysqli_fetch_array($sqlShow))
		{
			
			$dataShow[] = array(	'detailID' => $dtShow['detailID'],
									'productBarcode' => $dtShow['productBarcode'],
									'productName' => $dtShow['productName'],
									'detailPrice' => rupiah($dtShow['detailPrice']),
									'detailQty' => $dtShow['detailQty'],
									'discPercent' => $dtShow['discPercent'],
									'detailSubtotal' => rupiah($dtShow['detailSubtotal']),
									'no' => $i);
											
			$total = $total + $dtShow['detailSubtotal'];
			$modal = $modal + $dtShow['detailSubtotalModal'];
			$discTotal = $discTotal + $dtShow['discTotal'];
			$i++;
		}
		
		$ppn = ($dataIdentity['identityPPN']/100 * $total);
		$ppnrupiah = rupiah($ppn);
		
		$grandtotal = $total + $ppn;
		$grandtotalrupiah = rupiah($grandtotal);
		
		// assign to the tpl
		$smarty->assign("grandtotal", $grandtotal);
		$smarty->assign("grandtotalrupiah", $grandtotalrupiah);
		$smarty->assign("ppn", $ppn);
		$smarty->assign("ppnrupiah", $ppnrupiah);

		$smarty->assign("total", $total);
		$smarty->assign("modal", $modal);
		$smarty->assign("rupiah", rupiah($total));
		$smarty->assign("dataShow", $dataShow);
		$smarty->assign("discTotal", $discTotal);
		$smarty->assign("discTotalRupiah", rupiah($discTotal));
		
		// if member exists
		$memberID = $_GET['memberID'];
		if ($memberID != '')
		{
			$queryMember = "SELECT memberFullName, memberID, memberCode, memberAddress, memberPhone FROM as_members WHERE memberCode = '$memberID'";
			$sqlMember = mysqli_query($connect, $queryMember);
			
			// fetch data
			$dtMember = mysqli_fetch_array($sqlMember);
			
			$smarty->assign("memberID", $dtMember['memberID']);
			$smarty->assign("memberCode", $dtMember['memberCode']);
			$smarty->assign("memberFullName", $dtMember['memberFullName']);
			$smarty->assign("memberAddress", $dtMember['memberAddress']);
			$smarty->assign("memberPhone", $dtMember['memberPhone']);
		}
	} // close bracket
	
	// if module is transaction and action is cancel
	elseif ($module == 'trx' && $act == 'cancel')
	{
		$invoiceID = $_GET['invoiceID'];
		
		$queryDetail = "DELETE FROM as_sales_detail_transactions WHERE invoiceID = '$invoiceID'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		if ($sqlDetail){
			$queryDelete = "DELETE FROM as_sales_transactions WHERE invoiceID = '$invoiceID'";
			mysqli_query($connect, $queryDelete);
		}
			
		$_SESSION['faktur'] = "";
		
		header("Location: sales_transactions.php?module=trx&act=add");
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
								'status' => $dtTrx['trxStatus'],
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
			$queryTrx = "SELECT * FROM as_sales_transactions WHERE invoiceID = '$trxNo'";
		}
		
		// if type based on member id
		elseif ($type == '2')
		{
			$memberID = $_GET['memberID'];
			$m1 = explode(" - ", $memberID);
			
			// showing up the transactions
			$queryTrx = "SELECT * FROM as_sales_transactions WHERE memberID = '$m1[0]' ORDER BY createdDate DESC LIMIT 30";
		}
		
		// if type based on start date and end date
		elseif ($type == '3')
		{
			$startDate = $_GET['startDate'];
			$endDate = $_GET['endDate'];
			
			// showing up the transactions
			$queryTrx = "SELECT * FROM as_sales_transactions WHERE trxDate BETWEEN '$startDate' AND '$endDate' ORDER BY createdDate ASC";
		}
		
		$sqlTrx = mysqli_query($connect, $queryTrx);
		
		// fetch data
		$no = 1;
		while ($dtTrx = mysqli_fetch_array($sqlTrx))
		{
			$trxDate = explode("-", $dtTrx['trxDate']);
			$time = explode(" ", $dtTrx['createdDate']);
			
			if ($dtTrx['trxStatus'] == '1')
			{
				$status = "Cash";
			}
			else
			{
				$status = "<b>Pending<b>";
			}
			
			$dataTrx[] = array(	'trxID' => $dtTrx['trxID'],
								'invoiceID' => $dtTrx['invoiceID'],
								'memberID' => $dtTrx['memberID'],
								'trxFullName' => $dtTrx['trxFullName'],
								'trxDate' => $trxDate[2]."/".$trxDate[1]."/".$trxDate[0]." ".$time[1],
								'trxTotal' => rupiah($dtTrx['trxTotal']),
								'status' => $status,
								'statusori' => $dtTrx['trxStatus'],
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
			$typeName = "Nomor Faktur";
			$based = $trxNo;
		}
		elseif ($type == '2'){
			$typeName = "ID Member";
			$based = $m1[0];
		}
		elseif ($type == '3'){
			$typeName = "Periode";
			$based = tgl_indo($startDate)." s/d ".tgl_indo($endDate);
		}
		
		$smarty->assign("typeName", $typeName);
		$smarty->assign("based", $based);
	}
	
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