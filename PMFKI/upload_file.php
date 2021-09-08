<?php
session_start();
include("connect.php");
$db_handle = new DBController();

if(isset($_POST['submit'])){    
     
 $file = rand(1000,100000)."-".$_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="uploads/";
 
 move_uploaded_file($file_loc,$folder.$file);
 
 $sql="INSERT INTO document(name, file,type,size,uploaded) VALUES('". $_POST["name"] . "','$file','$file_type','$file_size', NOW())";
 $result = $db_handle->runQuery($sql);	
	if($result){
	echo "New record created successfully";
	header("location:admin.php");
	}
	else{
		echo "Error: " . $sql . "<br>" . $db_handle->error();
	}

}
	
$db_handle->closeDB();

?>