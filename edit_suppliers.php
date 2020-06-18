<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_suppliers.tpl";

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
	
	if ($module == 'supplier' && $act == 'edit')
	{
		// insert method into a variable
		$supplierID = $_GET['supplierID'];
		
		// showing up the supplier data based on supplier id
		$querySupplier = "SELECT * FROM as_suppliers WHERE supplierID = '$supplierID'";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		
		// fetch data
		$dataSupplier = mysqli_fetch_array($sqlSupplier);
		
		// assign fetch data to the tpl
		$smarty->assign("supplierID", $dataSupplier['supplierID']);
		$smarty->assign("supplierCode", $dataSupplier['supplierCode']);
		$smarty->assign("supplierName", $dataSupplier['supplierName']);
		$smarty->assign("supplierAddress", $dataSupplier['supplierAddress']);
		$smarty->assign("supplierPhone", $dataSupplier['supplierPhone']);
		$smarty->assign("supplierFax", $dataSupplier['supplierFax']);
		$smarty->assign("supplierContactPerson", $dataSupplier['supplierContactPerson']);
		$smarty->assign("supplierCPHp", $dataSupplier['supplierCPHp']);
		$smarty->assign("supplierStatus", $dataSupplier['supplierStatus']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>