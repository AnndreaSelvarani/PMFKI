<?php
session_start();
include("connect.php");
$db_handle = new DBController();

$sql = "INSERT INTO member1 (name, matric_no, course_code, email, phone) 
		SELECT name, matric_no, course, email, phone FROM new_member
		WHERE id='".$_GET['id']."'";
		

$result = $db_handle->runQuery($sql);	
if($result){
	echo "New record created successfully";
	header("location:admin.php");
}
else{
	echo "Error: " . $sql . "<br>" . $db_handle->error();
}	
$db_handle->closeDB();

?>