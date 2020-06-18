<?php
// include header
include "header.php";
// set the tpl page
$page = "categories.tpl";

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
	
	// if module is category and action is delete
	if ($module == 'category' && $act == 'delete')
	{
		// insert method into a variable
		$categoryID = $_GET['categoryID'];
		
		// delete categories
		$queryCategory = "DELETE FROM as_categories WHERE categoryID = '$categoryID'";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		// redirect to the categories page
		header("Location: categories.php?code=3");
	} // close bracket
	
	// default
	else 
	{
		// create new object pagination
		$p = new PaginationCategory;
		// limit 10 data for page
		$limit  = 15;
		$position = $p->searchPosition($limit);
		
		// showing up categories data
		$queryCategory = "SELECT * FROM as_categories ORDER BY categoryName ASC LIMIT $position,$limit";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		// fetch data
		$i = 1 + $position;
		while ($dtCategory = mysqli_fetch_array($sqlCategory))
		{
			// save data to array
			$dataCategory[] = array(	'categoryID' => $dtCategory['categoryID'],
										'categoryName' => $dtCategory['categoryName'],
										'categoryStatus' => $dtCategory['categoryStatus'],
										'no' => $i
										);
			$i++;
		} // close while
		
		// count data
		$queryCountCategory = "SELECT * FROM as_categories";
		$sqlCountCategory = mysqli_query($connect, $queryCountCategory);
		$amountData = mysqli_num_rows($sqlCountCategory);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		// assign array to the tpl
		$smarty->assign("dataCategory", $dataCategory);
		
	} // close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>