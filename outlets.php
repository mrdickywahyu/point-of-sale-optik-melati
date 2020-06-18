<?php
// include header
include "header.php";
// set the tpl page
$page = "outlets.tpl";

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
	
	// if module is outlet and action is delete
	if ($module == 'outlet' && $act == 'delete')
	{
		// insert method into a variable
		$outletID = $_GET['outletID'];
		
		// delete outlet
		$queryOutlet = "DELETE FROM as_outlets WHERE outletID = '$outletID'";
		$sqlOutlet = mysqli_query($connect, $queryOutlet);
		
		// delete account
		$queryAccount = "DELETE FROM as_accounts WHERE outletID = '$outletID'";
		$sqlAccount = mysqli_query($connect, $queryAccount);
		
		// delete brands
		$queryBrand = "DELETE FROM as_brands WHERE outletID = '$outletID'";
		$sqlBrand = mysqli_query($connect, $queryBrand);
		
		// delete buy detail transaction
		$queryBuyDetail = "DELETE FROM as_buy_detail_transactions WHERE outletID = '$outletID'";
		$sqlBuyDetail = mysqli_query($connect, $queryBuyDetail);
		
		// delete buy transactions
		$queryBuy = "DELETE FROM as_buy_transactions WHERE outletID = '$outletID'";
		$sqlBuy = mysqli_query($connect, $queryBuy);
		
		// delete categories
		$queryCategories = "DELETE FROM as_categories WHERE outletID = '$outletID'";
		$sqlCategories = mysqli_query($connect, $queryCategories);
		
		// delete funds
		$queryFunds = "DELETE FROM as_funds WHERE outletID = '$outletID'";
		$sqlFunds = mysqli_query($connect, $queryFunds);
		
		// delete identity
		$queryIdentity = "DELETE FROM as_identity WHERE outletID = '$outletID'";
		$sqlIdentity = mysqli_query($connect, $queryIdentity);
		
		// delete member
		$queryMember = "DELETE FROM as_members WHERE outletID = '$outletID'";
		$sqlIdentity = mysqli_query($connect, $queryMember);
		
		// delete products
		$queryProduct = "DELETE FROM as_products WHERE outletID = '$outletID'";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		
		// delete sales detail transaction
		$querySalesDetail = "DELETE FROM as_sales_detail_transactions WHERE outletID = '$outletID'";
		$sqlSalesDetail = mysqli_query($connect, $querySalesDetail);
		
		// delete sales transactions
		$querySalesTransaction = "DELETE FROM as_sales_transactions WHERE outletID = '$outletID'";
		$sqlSalesTransaction = mysqli_query($connect, $querySalesTransaction);
		
		// delete suppliers
		$querySupplier = "DELETE FROM as_suppliers WHERE outletID = '$outletID'";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		
		// delete transactions
		$queryTransaction = "DELETE FROM as_transactions WHERE outletID = '$outletID'";
		$sqlTransaction = mysqli_query($connect, $queryTransaction);
		
		// delete user
		$queryUser = "DELETE FROM as_users WHERE outletID = '$outletID'";
		$sqlUser = mysqli_query($connect, $queryUser);
		
		// redirect to the outlet page
		header("Location: outlets.php?code=3");
	} // close bracket
	
	// default
	else 
	{
		// get last sort outlet number
		$queryNoOutlet = "SELECT outletCode FROM as_outlets ORDER BY outletCode DESC LIMIT 1";
		$sqlNoOutlet = mysqli_query($connect, $queryNoOutlet);
		$numsNoOutlet = mysqli_num_rows($sqlNoOutlet);
		$dataNoOutlet = mysqli_fetch_array($sqlNoOutlet);
		
		$start = substr($dataNoOutlet['outletCode'],0-4);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoOutlet == '0')
		{
			$outletNo = "000";
		}
		elseif ($tempNo == 1)
		{
			$outletNo = "000";
		}
		elseif ($tempNo == 2)
		{
			$outletNo = "00";
		}
		elseif ($tempNo == 3)
		{
			$outletNo = "0";
		}
		elseif ($tempNo == 4)
		{
			$outletNo = "";
		}
		
		$outletCode = $outletNo.$next;
		
		$smarty->assign("outletCode", $outletCode);
		
		// create new object pagination
		$p = new PaginationOutlet;
		// limit 10 data for page
		$limit  = 15;
		$position = $p->searchPosition($limit);
		
		// showing up outlet data
		$queryOutlet = "SELECT * FROM as_outlets LIMIT $position,$limit";
		$sqlOutlet = mysqli_query($connect, $queryOutlet);
		
		// fetch data
		$i = 1 + $position;
		while ($dtOutlet = mysqli_fetch_array($sqlOutlet))
		{
			// save data to array
			$dataOutlet[] = array(	'outletID' => $dtOutlet['outletID'],
									'outletCode' => $dtOutlet['outletCode'],
									'outletName' => $dtOutlet['outletName'],
									'outletStatus' => $dtOutlet['outletStatus'],
									'outletUsername' => $dtOutlet['outletUsername'],
									'no' => $i
									);
			$i++;
		} // close while
		
		// count data
		$queryCountOutlet = "SELECT * FROM as_outlets";
		$sqlCountOutlet = mysqli_query($connect, $queryCountOutlet);
		$amountData = mysqli_num_rows($sqlCountOutlet);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		// assign array to the tpl
		$smarty->assign("dataOutlet", $dataOutlet);
		
	} // close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>