<?php
// include header
include "header.php";
// set the tpl page
$page = "suppliers.tpl";

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
	
	// if module is supplier and action is delete
	if ($module == 'supplier' && $act == 'delete')
	{
		// insert method into a variable
		$supplierID = $_GET['supplierID'];
		
		// delete supplier
		$querySupplier = "DELETE FROM as_suppliers WHERE supplierID = '$supplierID'";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		
		// redirect to the suppliers page
		header("Location: suppliers.php?code=3");
	} // close bracket
	
	// default
	else 
	{
		// get last sort outlet number
		$queryNoSupplier = "SELECT supplierCode FROM as_suppliers ORDER BY supplierCode DESC LIMIT 1";
		$sqlNoSupplier = mysqli_query($connect, $queryNoSupplier);
		$numsNoSupplier = mysqli_num_rows($sqlNoSupplier);
		$dataNoSupplier = mysqli_fetch_array($sqlNoSupplier);
		
		$start = substr($dataNoSupplier['supplierCode'],0-4);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoSupplier == '0')
		{
			$supplierNo = "000";
		}
		elseif ($tempNo == 1)
		{
			$supplierNo = "000";
		}
		elseif ($tempNo == 2)
		{
			$supplierNo = "00";
		}
		elseif ($tempNo == 3)
		{
			$supplierNo = "0";
		}
		elseif ($tempNo == 4)
		{
			$supplierNo = "";
		}
		
		$supplierCode = $supplierNo.$next;
		
		$smarty->assign("supplierCode", $supplierCode);
		
		// create new object pagination
		$p = new PaginationSupplier;
		// limit 10 data for page
		$limit  = 15;
		$position = $p->searchPosition($limit);
		
		// showing up suppliers data
		$querySupplier = "SELECT * FROM as_suppliers ORDER BY supplierName ASC LIMIT $position,$limit";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		
		// fetch data
		$i = 1 + $position;
		while ($dtSupplier = mysqli_fetch_array($sqlSupplier))
		{
			// save data to array
			$dataSupplier[] = array(	'supplierID' => $dtSupplier['supplierID'],
										'supplierCode' => $dtSupplier['supplierCode'],
										'supplierName' => $dtSupplier['supplierName'],
										'supplierPhone' => $dtSupplier['supplierPhone'],
										'supplierContactPerson' => $dtSupplier['supplierContactPerson'],
										'supplierCPHp' => $dtSupplier['supplierCPHp'],
										'supplierStatus' => $dtSupplier['supplierStatus'],
										'no' => $i
										);
			$i++;
		} // close while
		
		// count data
		$queryCountSupplier = "SELECT * FROM as_suppliers";
		$sqlCountSupplier = mysqli_query($connect, $queryCountSupplier);
		$amountData = mysqli_num_rows($sqlCountSupplier);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		// assign array to the tpl
		$smarty->assign("dataSupplier", $dataSupplier);
		
	} // close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>