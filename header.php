<?php
date_default_timezone_set('ASIA/JAKARTA');
error_reporting(0);
session_start();
// include all files are required
include "includes/connection.php";
include "includes/page_function.php";
include "includes/fungsi_indotgl.php";
include "includes/fungsi_rupiah.php";
include "includes/fungsi_random.php";
include "includes/fungsi_terbilang.php";
include "includes/debug.php";

require('libs/Smarty.class.php');

// create new object
$smarty = new Smarty;

$year = date('Y');

// set year for the website footer in the tpl
$year = date('Y');
$faktur = $_SESSION['faktur'];
if(empty($faktur)){
	$fakturA = randomcodeAlpha();
	$fakturB = randomcodeNumeric();
	$faktur = $fakturA.date('ymdhi').$fakturB;
	$_SESSION['faktur'] = $faktur;
}

$fakturBuy = $_SESSION['fakturBuy'];
if(empty($fakturBuy)){
	$fakturABuy = randomcodeAlpha();
	$fakturBBuy = randomcodeNumeric();
	$fakturBuy = $fakturABuy.date('ymdhi').$fakturBBuy;
	$_SESSION['fakturBuy'] = $fakturBuy;
}

$fakturRetur = $_SESSION['fakturRetur'];
if(empty($fakturRetur)){
	$fakturARetur = randomcodeAlpha();
	$fakturBRetur = randomcodeNumeric();
	$fakturRetur = $fakturARetur.date('ymdhi').$fakturBRetur;
	$_SESSION['fakturRetur'] = $fakturRetur;
}

$queryIdentity = "SELECT * FROM as_identity WHERE identityID = '1'";
$sqlIdentity = mysqli_query($connect, $queryIdentity);
$dataIdentity = mysqli_fetch_array($sqlIdentity);

// assign identity to the tpl
$smarty->assign("identityID", $dataIdentity['identityID']);
$smarty->assign("identityName", $dataIdentity['identityName']);
$smarty->assign("identityAddress", $dataIdentity['identityAddress']);
$smarty->assign("identityPhone", $dataIdentity['identityPhone']);
$smarty->assign("identityPPN", $dataIdentity['identityPPN']);
$smarty->assign("identityNPWP", $dataIdentity['identityNPWP']);
$smarty->assign("identityPKP", $dataIdentity['identityPKP']);
$smarty->assign("identityPKPDate", $dataIdentity['identityPKPDate']);
$smarty->assign("outletLevel", $_SESSION['outletLevel']);
$smarty->assign("outletName", $_SESSION['outletName']);
$smarty->assign("identityPhone", $dataIdentity['identityPhone']);
$smarty->assign("identityEmail", $dataIdentity['identityEmail']);
$smarty->assign("identityImage", $dataIdentity['identityImage']);
$smarty->assign("identityOwner", $dataIdentity['identityOwner']);
$smarty->assign("identityOwnerPhone", $dataIdentity['identityOwnerPhone']);
$smarty->assign("identityPrintSale", $dataIdentity['identityPrintSale']);
$smarty->assign("identityPrintBuy", $dataIdentity['identityPrintBuy']);
$smarty->assign("identityPrintRetur", $dataIdentity['identityPrintRetur']);
$smarty->assign("identityPrintDebt", $dataIdentity['identityPrintDebt']);
$smarty->assign("identityPrintReceive", $dataIdentity['identityPrintReceive']);
$smarty->assign("identityPrintReport", $dataIdentity['identityPrintReport']); 

// assign session to the tpl
$smarty->assign("serverName", $_SERVER['SERVER_NAME']);
$smarty->assign("userID", $_SESSION['userID']);
$smarty->assign("userNIP", $_SESSION['userNIP']);
$smarty->assign("userFullName", $_SESSION['userFullName']);
$smarty->assign("userLevel", $_SESSION['userLevel']);
$smarty->assign("userName", $_SESSION['userName']);
$smarty->assign("userPassword", $_SESSION['userPassword']);

?>