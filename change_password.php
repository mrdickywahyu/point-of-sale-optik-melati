<?php
// include header
include "header.php";
// set the tpl page
$page = "change_password.tpl";

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
	
	if ($module == 'change' && $act == 'update')
	{
		$outletLevel = $_SESSION['outletLevel'];
		
		if ($outletLevel == 'W')
		{
			$outletID = $_SESSION['outletID'];
			$oldPassword = md5($_POST['oldPassword']);
			$newPassword = md5($_POST['newPassword']);
			$newPassword2 = md5($_POST['newPassword2']);
			
			$queryOutlet = "SELECT outletPassword FROM as_outlets WHERE outletID = '$outletID'";
			$sqlOutlet = mysqli_query($connect, $queryOutlet);
			$dataOutlet = mysqli_fetch_array($sqlOutlet);
			
			// check what are the old password match with the old password in the database
			if ($oldPassword != $dataOutlet['outletPassword'])
			{
				header("Location: change_password.php?code=1");
			}
			else
			{
				if ($newPassword != $newPassword2)
				{
					header("Location: change_password.php?code=2");
				}
				else
				{
					$queryOutletUpdate = "UPDATE as_outlets SET outletPassword = '$newPassword' WHERE outletID = '$outletID'";
					mysqli_query($connect, $queryOutletUpdate);
					
					header("Location: change_password.php?code=3");
				}
			}
			
		}
		else
		{
			$userID = $_SESSION['userID'];
			$oldPassword = md5($_POST['oldPassword']);
			$newPassword = md5($_POST['newPassword']);
			$newPassword2 = md5($_POST['newPassword2']);
			
			$queryUser = "SELECT userPassword FROM as_users WHERE userID = '$userID'";
			$sqlUser = mysqli_query($connect, $queryUser);
			$dataUser = mysqli_fetch_array($sqlUser);
			
			// check what are the old password match with the old password in the database
			if ($oldPassword != $dataUser['userPassword'])
			{
				header("Location: change_password.php?code=1");
			}
			else
			{
				if ($newPassword != $newPassword2)
				{
					header("Location: change_password.php?code=2");
				}
				else
				{
					$queryUserUpdate = "UPDATE as_users SET userPassword = '$newPassword' WHERE userID = '$userID'";
					mysqli_query($connect, $queryUserUpdate);
					
					header("Location: change_password.php?code=3");
				}
			}
		}
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>