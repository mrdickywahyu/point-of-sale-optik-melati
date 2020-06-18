<?php
// include header
include "header.php";
// set the tpl page
$page = "index.tpl";

// get the variable method
$module = $_GET['module'];
$act = $_GET['act'];

// if module is login and act is submit
if ($module == 'login' && $act == 'submit')
{
	// get the variable method from the login page
	$userName = $_POST['userName'];
	$userPassword = $_POST['userPassword'];
	$userOutlet = $_POST['outlet'];
	
	$queryLogin = "SELECT * FROM as_users WHERE userName = '$userName' AND userPassword = '$userPassword' AND userBlocked = 'N'";
	$sqlLogin = mysqli_query($connect, $queryLogin);
	
	// count the match data
	$numsLogin = mysqli_num_rows($sqlLogin);
	
	// fetch the user data
	$dataLogin = mysqli_fetch_array($sqlLogin);
	
	// if data is more than 0 or founded
	if ($numsLogin > 0)
	{
		// create session data to the each session
		$_SESSION['userID'] = $dataLogin['userID'];
		$_SESSION['outletID'] = $dataLogin['outletID'];
		$_SESSION['userNIP'] = $dataLogin['userNIP'];
		$_SESSION['userFullName'] = $dataLogin['userFullName'];
		$_SESSION['userLevel'] = $dataLogin['userLevel'];
		$_SESSION['userName'] = $userEmail;
		$_SESSION['userPassword'] = $userPassword;
		
		// redirect to the admin dashboard
		header("Location: home.php?code=1");
	} // close bracket
	else 
	{
		// redirect to the login page
		header("Location: index.php?code=1");
	} // close bracket
} // close bracket

else 
{
	// assign the code variable method to the tpl
	$smarty->assign("code", $_GET['code']);
} // close bracket

// include footer
include "footer.php";
?>
