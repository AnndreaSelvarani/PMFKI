<?php
session_start();
include("config.php");
include("connect.php");
$db_handle = new DBController();
?>
<html>
<body>
<h2>Login Information</h2>
<?php
$userName = $_POST['username']; 
$passWord = $_POST['password'];
//sql statement
$sql = "SELECT adminID FROM  login
	WHERE username='$userName' AND 
	password='$passWord' LIMIT 1"; 
	
$login_data = $db_handle->runQuery($sql);
if (!empty($login_data)) {	
	//$result = mysqli_query($conn, $sql);
	echo "Login success. <br> Welcome, <b>".$userName."</b>.<br /><br />";
	//$row = mysqli_fetch_assoc($result);
	$_SESSION["UID"]=$login_data[0]["adminID"];
	header("location:admin.php");
} else {
		echo "Login error, username or password is incorrect.";
} 
$db_handle->closeDB();
?>
</body>
</html>