<?php
session_start();
include("connect.php");
$db_handle = new DBController();


$sql = "DELETE FROM new_member WHERE id='".$_GET['id']."'";

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
