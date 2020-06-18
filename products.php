<?php
// include header
include "header.php";
// set the tpl page
$page = "products.tpl";

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
	
	// if module is product and action is delete
	if ($module == 'product' && $act == 'delete')
	{
		// insert method into a variable
		$productID = $_GET['productID'];
		
		// delete product
		$queryProduct = "DELETE FROM as_products WHERE productID = '$productID'";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		
		// redirect to the product page
		header("Location: products.php?code=3");
	} // close bracket
	
	elseif ($module == 'product' && $act == 'search')
	{
		$productBarcode = $_GET['productBarcode'];
		$categoryID = $_GET['categoryID'];
		$brandID = $_GET['brandID'];
		
		$productBarcode2 = $outletID.date('ymdhis'); //randomProductCode();
		$smarty->assign("productBarcode", $productBarcode2);
		
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
		
		// showing up product data
		if ($categoryID != '' && $brandID != '' && $productBarcode != ''){
			$queryProduct = "SELECT * FROM as_products WHERE brandID = '$brandID' AND categoryID = '$categoryID' AND productBarcode = '$productBarcode'";
		}
		elseif ($categoryID != '' && $brandID != '' && $productBarcode == ''){
			$queryProduct = "SELECT * FROM as_products WHERE brandID = '$brandID' AND categoryID = '$categoryID'";
		}
		elseif ($categoryID != '' && $brandID == '' && $productBarcode == ''){
			$queryProduct = "SELECT * FROM as_products WHERE categoryID = '$categoryID'";
		}
		elseif ($categoryID == '' && $brandID != '' && $productBarcode != ''){
			$queryProduct = "SELECT * FROM as_products WHERE brandID = '$brandID' AND productBarcode = '$productBarcode'";
		}
		elseif ($categoryID == '' && $brandID != '' && $productBarcode == ''){
			$queryProduct = "SELECT * FROM as_products WHERE brandID = '$brandID'";
		}
		elseif ($categoryID == '' && $brandID == '' && $productBarcode != ''){
			$queryProduct = "SELECT * FROM as_products WHERE productBarcode = '$productBarcode'";
		}
		
		$sqlProduct = mysqli_query($connect, $queryProduct);
		$numProduct = mysqli_num_rows($sqlProduct);
		
		if ($numProduct == '0')
		{
			// hilangkan spasi kiri dan kanan
			$keyword = trim($productBarcode);
			
			// pisahkan dan hitung jumlah keyword
			$pisah_kata = explode(" ", $keyword);
			$jumlah_kata = (integer)count($pisah_kata);
			$jml_kata = $jumlah_kata - 1;
			
			$queryProduct = "SELECT * FROM as_products WHERE ";
			for ($k=0; $k<=$jml_kata; $k++){
				if ($categoryID != '' && $brandID != '' && $productBarcode != ''){
					$queryProduct .= "categoryID = '$categoryID' AND brandID = '$brandID' AND productName LIKE '%$pisah_kata[$k]%'";
				}
				
				elseif ($categoryID != '' && $brandID != '' && $productBarcode == ''){
					$queryProduct .= "categoryID = '$categoryID' AND brandID = '$brandID'";
				}
				
				elseif ($categoryID != '' && $brandID == '' && $productBarcode == ''){
					$queryProduct .= "categoryID = '$categoryID'";
				}
				
				elseif ($categoryID == '' && $brandID != '' && $productBarcode != ''){
					$queryProduct .= "brandID = '$brandID' AND productName LIKE '%$pisah_kata[$k]%'";
				}
				
				elseif ($categoryID == '' && $brandID != '' && $productBarcode == ''){
					$queryProduct .= "brandID = '$brandID'";
				}
				
				elseif ($categoryID == '' && $brandID == '' && $productBarcode != ''){
					$queryProduct .= "productName LIKE '%$pisah_kata[$k]%'";
				}
				
				if($k < $jml_kata){
					$queryProduct .= " OR ";
				}
			}
			
			$queryProduct .= " ORDER BY productName, productStock DESC";
			
			$sqlProduct = mysqli_query($connect, $queryProduct);
		}
		
		// fetch data
		$i = 1;
		while ($dtProduct = mysqli_fetch_array($sqlProduct))
		{
			// save data to array
			$dataProduct[] = array(	'productID' => $dtProduct['productID'],
									'supplierID' => $dtProduct['supplierID'],
									'categoryID' => $dtProduct['categoryID'],
									'brandID' => $dtProduct['brandID'],
									'productBarcode' => $dtProduct['productBarcode'],
									'productName' => $dtProduct['productName'],
									'productDiscount' => $dtProduct['productDiscount'],
									'productSalePrice' => rupiah($dtProduct['productSalePrice']),
									'productBuyPrice' => rupiah($dtProduct['productBuyPrice']),
									'productStock' => $dtProduct['productStock'],
									'productNote' => $dtProduct['productNote'], 
									'no' => $i
									);
			$i++;
		} // close while
		
		// assign to the home tpl
		$smarty->assign("dataProduct", $dataProduct);
	}
	
	// default
	else 
	{
		
		$productBarcode = $outletID.date('ymdhis'); //randomProductCode();
		$smarty->assign("productBarcode", $productBarcode);
		
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
		
		// create new object pagination
		$p = new PaginationProduct;
		// limit 10 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up product data
		$queryProduct = "SELECT * FROM as_products ORDER BY productName ASC LIMIT $position,$limit";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		
		// fetch data
		$i = 1 + $position;
		while ($dtProduct = mysqli_fetch_array($sqlProduct))
		{
			// save data to array
			$dataProduct[] = array(	'productID' => $dtProduct['productID'],
									'supplierID' => $dtProduct['supplierID'],
									'categoryID' => $dtProduct['categoryID'],
									'brandID' => $dtProduct['brandID'],
									'productBarcode' => $dtProduct['productBarcode'],
									'productName' => $dtProduct['productName'],
									'productDiscount' => $dtProduct['productDiscount'],
									'productSalePrice' => rupiah($dtProduct['productSalePrice']),
									'productBuyPrice' => rupiah($dtProduct['productBuyPrice']),
									'productStock' => $dtProduct['productStock'],
									'productNote' => $dtProduct['productNote'], 
									'no' => $i
									);
			$i++;
		} // close while
		
		// count data
		$queryCountProduct = "SELECT * FROM as_products";
		$sqlCountProduct = mysqli_query($connect, $queryCountProduct);
		$amountData = mysqli_num_rows($sqlCountProduct);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		// assign array to the tpl
		$smarty->assign("dataProduct", $dataProduct);
		
	} // close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>