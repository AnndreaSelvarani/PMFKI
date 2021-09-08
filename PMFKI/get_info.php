<?php
session_start();
include("connect.php");
include("config.php");
$db_handle = new DBController();

if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$sql = "SELECT * FROM member1 WHERE id=$id";
		$record = mysqli_query($link, $sql);

		if (!is_null($record)) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$matric = $n['matric_no'];
			$course = $n['course_code'];
			$email = $n['email'];
			$phone = $n['phone'];
		}
	}
	
?>