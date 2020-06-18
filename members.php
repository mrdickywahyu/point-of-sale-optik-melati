<?php
// include header
include "header.php";
// set the tpl page
$page = "members.tpl";

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
	
	// if module is member and action is delete
	if ($module == 'member' && $act == 'delete')
	{
		// insert method into a variable
		$memberID = $_GET['memberID'];
		
		// delete member
		$queryMember = "DELETE FROM as_members WHERE memberID = '$memberID'";
		$sqlMember = mysqli_query($connect, $queryMember);
		
		// redirect to the members page
		header("Location: members.php?code=3");
	} // close bracket
	
	// default
	else 
	{
		// get last sort member number
		$queryNoMember = "SELECT memberCode FROM as_members ORDER BY memberCode DESC LIMIT 1";
		$sqlNoMember = mysqli_query($connect, $queryNoMember);
		$numsNoMember = mysqli_num_rows($sqlNoMember);
		$dataNoMember = mysqli_fetch_array($sqlNoMember);
		
		$start = substr($dataNoMember['memberCode'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoMember == '0')
		{
			$memberNo = "0000";
		}
		elseif ($tempNo == 1)
		{
			$memberNo = "0000";
		}
		elseif ($tempNo == 2)
		{
			$memberNo = "000";
		}
		elseif ($tempNo == 3)
		{
			$memberNo = "00";
		}
		elseif ($tempNo == 4)
		{
			$memberNo = "0";
		}
		elseif ($tempNo == 5)
		{
			$memberNo = "";
		}
		
		$memberCode = $memberNo.$next;
		
		$smarty->assign("memberCode", $memberCode);
		
		// create new object pagination
		$p = new PaginationMember;
		// limit 10 data for page
		$limit  = 15;
		$position = $p->searchPosition($limit);
		
		// showing up member data
		$queryMember = "SELECT * FROM as_members ORDER BY memberFullName ASC LIMIT $position,$limit";
		$sqlMember = mysqli_query($connect, $queryMember);
		
		// fetch data
		$i = 1 + $position;
		while ($dtMember = mysqli_fetch_array($sqlMember))
		{
			// save data to array
			$dataMember[] = array(	'memberID' => $dtMember['memberID'],
									'memberCode' => $dtMember['memberCode'],
									'memberFullName' => $dtMember['memberFullName'],
									'memberAddress' => $dtMember['memberAddress'],
									'memberPhone' => $dtMember['memberPhone'],
									'no' => $i
									);
			$i++;
		} // close while
		
		// count data
		$queryCountMember = "SELECT * FROM as_members";
		$sqlCountMember = mysqli_query($connect, $queryCountMember);
		$amountData = mysqli_num_rows($sqlCountMember);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		// assign array to the tpl
		$smarty->assign("dataMember", $dataMember);
		
	} // close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>