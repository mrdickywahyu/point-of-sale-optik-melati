<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_members.tpl";

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
	
	if ($module == 'member' && $act == 'edit')
	{
		// insert method into a variable
		$memberID = $_GET['memberID'];
		
		// showing up the member data based on member id and outlet id
		$queryMember = "SELECT * FROM as_members WHERE memberID = '$memberID'";
		$sqlMember = mysqli_query($connect, $queryMember);
		
		// fetch data
		$dataMember = mysqli_fetch_array($sqlMember);
		
		// assign fetch data to the tpl
		$smarty->assign("memberID", $dataMember['memberID']);
		$smarty->assign("memberCode", $dataMember['memberCode']);
		$smarty->assign("memberFullName", $dataMember['memberFullName']);
		$smarty->assign("memberAddress", $dataMember['memberAddress']);
		$smarty->assign("memberPhone", $dataMember['memberPhone']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>