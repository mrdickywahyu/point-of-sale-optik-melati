<?php
// include header
include "header.php";
// set the tpl page
$page = "member_autocomplete.tpl";

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
	
	$queryMember = "SELECT memberID, memberCode, memberFullName FROM as_members WHERE memberCode LIKE '%$q%'";
	$sqlMember = mysqli_query($connect, $queryMember);
	$numMember = mysqli_num_rows($sqlMember);
	
	if ($numMember == 0){
		$queryMember = "SELECT memberID, memberCode, memberFullName FROM as_members WHERE memberFullName LIKE '%$q%'";
		$sqlMember = mysqli_query($connect, $queryMember);
	}
	
	// fetch data
	while ($dtMember = mysqli_fetch_array($sqlMember))
	{
		echo "$dtMember[memberCode] - $dtMember[memberFullName]\n";	
			
	}	
}
?>