<?php
// include header
include "header.php";
// set the tpl page
$page = "reports.tpl";

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
	
	$queryOutlet = "SELECT * FROM as_outlets WHERE outletStatus = 'Y' ORDER BY outletCode, outletName ASC";
	$sqlOutlet = mysqli_query($connect, $queryOutlet);
	while ($dtOutlet = mysqli_fetch_array($sqlOutlet))
	{
		$dataOutlet[] = array(	'outletID' => $dtOutlet['outletID'],
								'outletName' => $dtOutlet['outletName'],
								'outletCode' => $dtOutlet['outletCode']);
	}
	
	$smarty->assign("dataOutlet", $dataOutlet);
			
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
	// showing up the year
	for ($i = date('Y'); $i >= 2014; $i--)
	{
		$tahun[] = $i;
	}
	
	$smarty->assign("tahun", $tahun);
	
} // close bracket

// include footer
include "footer.php";
?>