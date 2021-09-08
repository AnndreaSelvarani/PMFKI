<?php
session_start();
include("connect.php");
$db_handle = new DBController();

$sql = "INSERT INTO event1 (event_name, event_des, event_date, event_text) 
        VALUES ('". $_POST["event_name"] . "','". $_POST["event_des"] . "','". $_POST["event_date"] . "','". $_POST["event_text"] . "')";

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