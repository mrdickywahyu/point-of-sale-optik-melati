<?php
// include header
include "header.php";
// set the tpl page
$page = "identity.tpl";

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
	
	if ($module == 'identity' && $act == 'update')
	{
		$identityID = $_POST['identityID'];
		$identityName = $_POST['identityName'];
		$identityAddress = $_POST['identityAddress'];
		$identityPhone = $_POST['identityPhone'];
		$identityEmail = $_POST['identityEmail'];
		$identityImage = $_POST['filename'];
		$identityOwner = $_POST['identityOwner'];
		$identityOwnerPhone = $_POST['identityOwnerPhone'];
		$identityPrintSale = $_POST['identityPrintSale'];
		$identityPrintBuy = $_POST['identityPrintBuy'];
		$identityPrintRetur = $_POST['identityPrintRetur'];
		$identityPrintDebt = $_POST['identityPrintDebt'];
		$identityPrintReceive = $_POST['identityPrintReceive'];
		$identityPrintReport = $_POST['identityPrintReport'];
		$identityPPN = $_POST['identityPPN'];
		$identityNPWP = $_POST['identityNPWP'];
		$identityPKP = $_POST['identityPKP'];
		$identityPKPDate= $_POST['identityPKPDate'];
		$modifiedDate = date('Y-m-d H:i:s');
		$modifiedUserID = $_SESSION['userID'];
		
		if ($identityImage != '')
		{
			$file = "images/outlets/".$identityImage;
			$realPic = imagecreatefromjpeg($file);
			$width = imagesx($realPic);
			$height = imagesy($realPic);
			
			$thumbWidth = 160;
			$thumbHeight = 67;
			
			$thumbPic = imagecreatetruecolor($thumbWidth, $thumbHeight);
			imagecopyresampled($thumbPic, $realPic, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
			
			imagejpeg($thumbPic, "images/outlets/thumb/small_".$identityImage);
			
			imagedestroy($realPic);
			imagedestroy($thumbPic);
			
			mysqli_query($connect, "UPDATE as_identity SET	identityName = '$identityName',
															identityAddress = '$identityAddress',
															identityPhone = '$identityPhone',
															identityEmail = '$identityEmail',
															identityImage = '$identityImage',
															identityOwner = '$identityOwner',
															identityOwnerPhone = '$identityOwnerPhone',
															identityPPN = '$identityPPN',
															identityPrintSale = '$identityPrintSale',
															identityPrintBuy = '$identityPrintBuy',
															identityPrintRetur = '$identityPrintRetur',
															identityPrintDebt = '$identityPrintDebt',
															identityPrintReceive = '$identityPrintReceive',
															identityPrintReport = '$identityPrintReport',
															identityNPWP = '$identityNPWP',
															identityPKP = '$identityPKP',
															identityPKPDate = '$identityPKPDate',
															modifiedDate = '$modifiedDate',
															modifiedUserID = '$modifiedUserID'
															WHERE identityID = '$identityID'");
		}
		else
		{
			mysqli_query($connect, "UPDATE as_identity SET	identityName = '$identityName',
															identityAddress = '$identityAddress',
															identityPhone = '$identityPhone',
															identityEmail = '$identityEmail',
															identityOwner = '$identityOwner',
															identityOwnerPhone = '$identityOwnerPhone',
															identityPPN = '$identityPPN',
															identityPrintSale = '$identityPrintSale',
															identityPrintBuy = '$identityPrintBuy',
															identityPrintRetur = '$identityPrintRetur',
															identityPrintDebt = '$identityPrintDebt',
															identityPrintReceive = '$identityPrintReceive',
															identityPrintReport = '$identityPrintReport',
															identityNPWP = '$identityNPWP',
															identityPKP = '$identityPKP',
															identityPKPDate = '$identityPKPDate',
															modifiedDate = '$modifiedDate',
															modifiedUserID = '$modifiedUserID'
															WHERE identityID = '$identityID'");
		}
		
		// redirect to the identity page
		header("Location: identity.php?code=1");
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>