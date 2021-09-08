<?php
	
if(isset($_POST['Generate'])){
	exec('python new.py');
	header("location:admin.php");
	echo "success";
}
else{
	echo "error";
}

?>