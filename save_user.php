<?php// include headerinclude "header.php";$userNIP = $_POST['userNIP'];$userFullName = $_POST['userFullName'];$userPhone = $_POST['userPhone'];$userLevel = $_POST['userLevel'];$userBlocked = $_POST['userBlocked'];$userName = $_POST['userName'];$userPassword = md5($_POST['userPassword']);$createdDate = date('Y-m-d H:i:s');$userID = $_SESSION['userID'];if ($userNIP != '' && $userFullName != '' && $userLevel != '' && $userBlocked != '' && $userName != '' && $userPassword != ''){		$queryUser = "INSERT INTO as_users (userNIP,										userFullName,										userPhone,										userLevel,										userBlocked,										userName,										userPassword,										createdDate,										createdUserID,										modifiedDate,										modifiedUserID)								VALUES(	'$userNIP',										'$userFullName',										'$userPhone',										'$userLevel',										'$userBlocked',										'$userName',										'$userPassword',										'$createdDate',										'$userID',										'',										'')";												$sqlUser = mysqli_query($connect, $queryUser);		if ($sqlUser)	{		echo json_encode(OK);	}	}exit();?>