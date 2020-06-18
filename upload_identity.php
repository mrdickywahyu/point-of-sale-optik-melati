<?php
session_start();
$uploaddir = 'images/outlets/'; 
$file = $uploaddir ."pj".$_SESSION['outletID']."_".date('ymdhis')."_".basename($_FILES['uploadfile']['name']); 
$file_name= "pj".$_SESSION['outletID']."_".date('ymdhis')."_".basename($_FILES['uploadfile']['name']); 
 
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
	echo "$file_name"; 
} 
else {
	echo "error";
}
?>