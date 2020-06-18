<?php
// include header
include "header.php";
// set the tpl page
$page = "funds.tpl";

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
	
	// if module is fund and action is delete
	if ($module == 'fund' && $act == 'delete')
	{
		// get value from url
		$fundID = $_GET['fundID'];
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		
		// delete from the database
		$queryFund = "DELETE FROM as_funds WHERE fundID = '$fundID'";
		mysqli_query($connect, $queryFund);
		
		// redirect to the funds page
		if ($startDate != '' && $endDate != ''){
			header("Location: funds.php?module=fund&act=search&startDate=".$startDate."&endDate=".$endDate."&code=3");
		}
		else{
			header("Location: funds.php?code=3");
		}
	} // close bracket
	
	// if module is fund and action is search
	elseif ($module == 'fund' && $act == 'search')
	{
		// get method value and change into variables
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		
		// showing the funds based on period date
		$queryFund = "SELECT * FROM as_funds A WHERE A.fundDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.fundDate ASC";
		$sqlFund = mysqli_query($connect, $queryFund);
		
		// fetch data
		$i = 1;
		while ($dtFund = mysqli_fetch_array($sqlFund))
		{
			$dataAcc = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM as_accounts WHERE accountID = '$dtFund[accountID]'"));
			
			$fundDate = explode("-", $dtFund['fundDate']);
			// save into array
			$dataFund[] = array('fundID' => $dtFund['fundID'],
								'accountCode' => $dataAcc['accountCode'],
								'accountName' => $dataAcc['accountName'],
								'fundAmount' => rupiah($dtFund['fundAmount']),
								'fundDate' => $fundDate[2]."/".$fundDate[1]."/".$fundDate[0],
								'fundNote' => $dtFund['fundNote'],
								'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataFund", $dataFund);
		$smarty->assign("startDate", tgl_indo($startDate));
		$smarty->assign("endDate", tgl_indo($endDate));
		$smarty->assign("fundDate", date('Y-m-d'));
		$smarty->assign("start", $startDate);
		$smarty->assign("end", $endDate);
		
		$queryAccount = "SELECT * FROM as_accounts WHERE accountStatus = 'Y' ORDER BY accountCode, accountName ASC";
		$sqlAccount = mysqli_query($connect, $queryAccount);
		
		// fetch data
		while ($dtAccount = mysqli_fetch_array($sqlAccount))
		{
			// save data into array
			$dataAccount[] = array(	'accountID' => $dtAccount['accountID'],
									'accountCode' => $dtAccount['accountCode'],
									'accountName' => $dtAccount['accountName']);
		}

		// assign to the tpl
		$smarty->assign("dataAccount", $dataAccount);
	}
	
	else 
	{
		$queryAccount = "SELECT * FROM as_accounts WHERE accountStatus = 'Y' ORDER BY accountCode, accountName ASC";
		$sqlAccount = mysqli_query($connect, $queryAccount);
		
		// fetch data
		while ($dtAccount = mysqli_fetch_array($sqlAccount))
		{
			// save data into array
			$dataAccount[] = array(	'accountID' => $dtAccount['accountID'],
									'accountCode' => $dtAccount['accountCode'],
									'accountName' => $dtAccount['accountName']);
		}

		// assign to the tpl
		$smarty->assign("dataAccount", $dataAccount);
		$smarty->assign("fundDate", date('Y-m-d'));
		
		$periodDate = date('Y-m');
		// showing the funds based on period date
		$queryFund = "SELECT * FROM as_funds A WHERE A.fundDate LIKE '%$periodDate%' ORDER BY A.fundDate ASC";
		$sqlFund = mysqli_query($connect, $queryFund);
		
		// fetch data
		$i = 1;
		while ($dtFund = mysqli_fetch_array($sqlFund))
		{
			$dataAcc = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM as_accounts WHERE accountID = '$dtFund[accountID]'"));
			
			$fundDate = explode("-", $dtFund['fundDate']);
			// save into array
			$dataFund[] = array('fundID' => $dtFund['fundID'],
								'accountCode' => $dataAcc['accountCode'],
								'accountName' => $dataAcc['accountName'],
								'fundAmount' => rupiah($dtFund['fundAmount']),
								'fundDate' => $fundDate[2]."/".$fundDate[1]."/".$fundDate[0],
								'fundNote' => $dtFund['fundNote'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataFund", $dataFund);
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