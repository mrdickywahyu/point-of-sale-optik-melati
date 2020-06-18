<?php
// include header
include "header.php";
// set the tpl page
$page = "supplier_autocomplete.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['userName'] == '' && $_SESSION['userPassword'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else 
{
	
	$q = $_GET['q'];
	
	$querySupplier = "SELECT supplierID, supplierCode, supplierName, supplierPhone FROM as_suppliers WHERE supplierCode LIKE '%$q%' OR supplierName LIKE '%$q%'";
	$sqlSupplier = mysqli_query($connect, $querySupplier);
	
	// fetch data
	while ($dtSupplier = mysqli_fetch_array($sqlSupplier))
	{
		echo "$dtSupplier[supplierCode] - $dtSupplier[supplierName]\n";	
			
	}	
}
?>