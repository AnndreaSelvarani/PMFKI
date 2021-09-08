<?php
session_start();
include("connect.php");
$db_handle = new DBController();


$sql = "DELETE FROM event1 WHERE event_name='".$_GET['event_name']."'";

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