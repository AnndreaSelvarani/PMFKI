<?php
session_start();
include("connect.php");
$db_handle = new DBController();

	
if(isset($_POST['update'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$matric = $_POST['matric_no'];
	$course = $_POST['course_code'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

$sql = "UPDATE member1 SET name='$name', matric_no='$matric', course_code='$course', email='$email', phone='$phone' WHERE id=$id";
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