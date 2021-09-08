<?php
session_start();
include("connect.php");
$db_handle = new DBController();

$sql = "INSERT INTO feedback (feedback, event_name) 
        VALUES ('". $_POST["feedback"] . "', '". $_POST["event_name"] ."')";

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