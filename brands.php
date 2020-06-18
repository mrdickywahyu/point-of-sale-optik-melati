<?php
// include header
include "header.php";
// set the tpl page
$page = "brands.tpl";

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
	
	// if module is brand and action is delete
	if ($module == 'brand' && $act == 'delete')
	{
		// insert method into a variable
		$brandID = $_GET['brandID'];
		
		// delete brands
		$queryBrand = "DELETE FROM as_brands WHERE brandID = '$brandID'";
		$sqlBrand = mysqli_query($connect, $queryBrand);
		
		// redirect to the brand page
		header("Location: brands.php?code=3");
	} // close bracket
	
	// default
	else 
	{
		// create new object pagination
		$p = new PaginationBrand;
		// limit 10 data for page
		$limit  = 15;
		$position = $p->searchPosition($limit);
		
		// showing up brands data
		$queryBrand = "SELECT * FROM as_brands ORDER BY brandName ASC LIMIT $position,$limit";
		$sqlBrand = mysqli_query($connect, $queryBrand);
		
		// fetch data
		$i = 1 + $position;
		while ($dtBrand = mysqli_fetch_array($sqlBrand))
		{
			// save data to array
			$dataBrand[] = array(	'brandID' => $dtBrand['brandID'],
									'brandName' => $dtBrand['brandName'],
									'brandStatus' => $dtBrand['brandStatus'],
									'no' => $i
									);
			$i++;
		} // close while
		
		// count data
		$queryCountBrand = "SELECT * FROM as_brands";
		$sqlCountBrand = mysqli_query($connect, $queryCountBrand);
		$amountData = mysqli_num_rows($sqlCountBrand);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		// assign array to the tpl
		$smarty->assign("dataBrand", $dataBrand);
		
	} // close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>