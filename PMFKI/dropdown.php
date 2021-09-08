<?php
session_start();
include("connect.php");
$db_handle = new DBController();

$sql = "SELECT name FROM event1";

$result = $db_handle->runQuery($sql);

?>