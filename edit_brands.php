<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_brands.tpl";

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
	
	if ($module == 'brand' && $act == 'edit')
	{
		// insert method into a variable
		$brandID = $_GET['brandID'];
		
		// showing up the brand data based on brand id
		$queryBrand = "SELECT * FROM as_brands WHERE brandID = '$brandID'";
		$sqlBrand = mysqli_query($connect, $queryBrand);
		
		// fetch data
		$dataBrand = mysqli_fetch_array($sqlBrand);
		
		// assign fetch data to the tpl
		$smarty->assign("brandID", $dataBrand['brandID']);
		$smarty->assign("brandName", $dataBrand['brandName']);
		$smarty->assign("brandStatus", $dataBrand['brandStatus']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>