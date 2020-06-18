<?php
// include header
include "header.php";
// set the tpl page
$page = "users.tpl";

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
	
	// if module is user and action is delete
	if ($module == 'user' && $act == 'delete')
	{
		// insert method into a variable
		$userID = $_GET['userID'];
		
		// delete from user table
		$queryUser = "DELETE FROM as_users WHERE userID = '$userID'";
		mysqli_query($connect, $queryUser);
		
		// redirect to the main user page
		header("Location: users.php?code=3");
	} // close bracket
	
	// default
	else 
	{
		// get last sort number
		$queryUserNo = "SELECT userNIP FROM as_users ORDER BY userNIP DESC LIMIT 1";
		$sqlUserNo = mysqli_query($connect, $queryUserNo);
		$numsNo = mysqli_num_rows($sqlUserNo);
		$dataUserNo = mysqli_fetch_array($sqlUserNo);		
		
		$start = substr($dataUserNo['userNIP'],0-4);	
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNo == '0')
		{
			$userNo = "000";
		}
		elseif ($tempNo == 1)
		{
			$userNo = "000";
		}
		elseif ($tempNo == 2)
		{
			$userNo = "00";
		}
		elseif ($tempNo == 3)
		{
			$userNo = "0";
		}
		elseif ($tempNo == 4)
		{
			$userNo = "";
		}
		
		$userNIP = $userNo.$next;
		
		// assign sort nip number to the tpl
		$smarty->assign("userNIP", $userNIP);
		
		// create new object pagination
		$p = new PaginationUser;
		// limit 10 data for page
		$limit  = 10;
		$position = $p->searchPosition($limit);
		
		$outletID = $_SESSION['outletID'];
		
		// showing up user data
		$queryUser = "SELECT * FROM as_users ORDER BY userNIP ASC LIMIT $position,$limit";
		$sqlUser = mysqli_query($connect, $queryUser);
		
		// fetch data
		$i = 1 + $position;
		while ($dtUser = mysqli_fetch_array($sqlUser))
		{
			if ($dtUser['userLevel'] == '1')
			{
				$userLevel = "Administrator";
			}
			else
			{
				$userLevel = "Staff";
			}
			// save data to array
			$dataUser[] = array(	'userID' => $dtUser['userID'],
									'userNIP' => $dtUser['userNIP'],
									'userFullName' => $dtUser['userFullName'],
									'userPhone' => $dtUser['userPhone'],
									'userLevel' => $userLevel,
									'userBlocked' => $dtUser['userBlocked'],
									'userName' => $dtUser['userName'],
									'no' => $i
									);
			$i++;
		} // close while
		
		// count data
		$queryCountUser = "SELECT * FROM as_users";
		$sqlCountUser = mysqli_query($connect, $queryCountUser);
		$amountData = mysqli_num_rows($sqlCountUser);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		// assign array to the tpl
		$smarty->assign("dataUser", $dataUser);
		
	} // close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>