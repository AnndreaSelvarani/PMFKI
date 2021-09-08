<?php
session_start();
include("connect.php");
$db_handle = new DBController();

$sql = "INSERT INTO new_member (name, matric_no, course, email, phone) 
        VALUES ('". $_POST["name"] . "','" . $_POST["matric_no"] . "','" . $_POST["course"] . "','". $_POST["email"] . "','". $_POST["phone"]."')";

$result = $db_handle->runQuery($sql);	
if($result){
	echo "New record created successfully";
	header("location:index.php");
}
else{
	echo "Error: " . $sql . "<br>" . $db_handle->error();
}	
$db_handle->closeDB();

?>