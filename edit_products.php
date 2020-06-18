<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_products.tpl";

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
	
	if ($module == 'product' && $act == 'edit')
	{
		// insert method into a variable
		$productID = $_GET['productID'];
		
		// showing up the supplier
		$querySupplier = "SELECT * FROM as_suppliers WHERE supplierStatus = 'Y' ORDER BY supplierName ASC";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		
		// fetch data
		while ($dtSupplier = mysqli_fetch_array($sqlSupplier))
		{
			// save data into array
			$dataSupplier[] = array('supplierID' => $dtSupplier['supplierID'],
									'supplierCode' => $dtSupplier['supplierCode'],
									'supplierName' => $dtSupplier['supplierName']);
		}
		
		// assign data supplier into the tpl
		$smarty->assign("dataSupplier", $dataSupplier);
		
		// showing up the category
		$queryCategory = "SELECT * FROM as_categories WHERE categoryStatus = 'Y' ORDER BY categoryName ASC";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		// fetch data
		while ($dtCategory = mysqli_fetch_array($sqlCategory))
		{
			// assign data into array
			$dataCategory[] = array('categoryID' => $dtCategory['categoryID'],
									'categoryName' => $dtCategory['categoryName']);
		}
		
		// assign data category to the tpl
		$smarty->assign("dataCategory", $dataCategory);
		
		// showing up the brand
		$queryBrand = "SELECT * FROM as_brands WHERE brandStatus = 'Y' ORDER BY brandName ASC";
		$sqlBrand = mysqli_query($connect, $queryBrand);
		
		// fetch data
		while ($dtBrand = mysqli_fetch_array($sqlBrand))
		{
			// save data into array
			$dataBrand[] = array(	'brandID' => $dtBrand['brandID'],
									'brandName' => $dtBrand['brandName']);
		}
		
		// assign data into array
		$smarty->assign("dataBrand", $dataBrand);
		
		// showing up the product data based on product id
		$queryProduct = "SELECT * FROM as_products WHERE productID = '$productID'";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		
		// fetch data
		$dataProduct = mysqli_fetch_array($sqlProduct);
		
		// assign fetch data to the tpl
		$smarty->assign("productID", $dataProduct['productID']);
		$smarty->assign("supplierID", $dataProduct['supplierID']);
		$smarty->assign("categoryID", $dataProduct['categoryID']);
		$smarty->assign("brandID", $dataProduct['brandID']);
		$smarty->assign("productBarcode", $dataProduct['productBarcode']);
		$smarty->assign("productName", $dataProduct['productName']);
		$smarty->assign("productDiscount", $dataProduct['productDiscount']);
		$smarty->assign("productBuyPrice", $dataProduct['productBuyPrice']);
		$smarty->assign("productSalePrice", $dataProduct['productSalePrice']);
		$smarty->assign("productStock", $dataProduct['productStock']);
		$smarty->assign("productNote", $dataProduct['productNote']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>