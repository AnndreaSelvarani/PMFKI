<?php 
session_start();
include("config.php");

if(isset($_POST['submit'])){
	$file = $_FILES['file'];
	
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];
	
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowed = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx');
	
	if(in_array($fileActualExt, $allowed)){
		if($fileError === 0){
			if($fileSize < 10000000){
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				header("location:admin.php?uploadSuccess");
			}else {
				echo "your file is too big";
			}
			
		}else{
			echo "there was an error uploading your file";
		}
	
	} else {
		echo "you cannot upload this file";
	}
}
?>