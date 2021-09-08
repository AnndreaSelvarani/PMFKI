<?php
session_start();
include("connect.php");
include("config.php");
$db_handle = new DBController();
?>

<!DOCTYPE html>
<html>
<link rel="icon" href="img/circle-cropped.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="styles.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>

</head>
<body>

<div class="header">
  <h1>PMFKI</h1>
  <p>Persatuan Mahasiswa Fakulti Komputeran dan Informatik.</p>
</div>
<div class="tab">
<div class="topnav">
  <a class="tablinks" onclick="openNav(event,'home')" id="defaultOpen">Home</a>
  <a class="tablinks" onclick="openNav(event,'aboutus')">About us</a>
  <a class="tablinks" onclick="openNav(event, 'joinus')">Join us</a>
  <a class="tablinks" onclick="openNav(event, 'feedback')">Feedback</a>
  <a onclick="document.getElementById('id01').style.display='block'" style="width:auto; float:right;">Admin Login</a>
</div>
</div>

<!-- login funtion -->
<div id="id01" class="modal">

  <form class="modal-content animate" action="login_action.php" method="post">
	<div class="imgcontainer">
		<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
	</div>
    <div class="container">
		<div class="login">
			<label for="username"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="username" required>

			<label for="password"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="password" required>
        
			<button type="submit" style="background-color:powderblue;width:100%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;">Login</button>
			<label>
				<input type="checkbox" checked="checked" name="remember"> Remember me
			</label>
		</div>
	</div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>

<!-- home tab by ANNDREA-->
<div id="home" class="tabcontent">
	<div class="row">
		<div class="leftcolumn">
			<?php 
			$sql = "SELECT * FROM event1 ORDER BY event_date DESC";
				if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
                            echo "<div class=card>";
                            echo "<h2>" . $row['event_name'] . "</h2>";
                            echo "<h5>" . $row['event_des'] ." | ". $row['event_date']. "</h5>";
                            echo "<p>" . $row['event_text'] . "</p>";
							echo "</div>";
                            }
							
						mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }	
					mysqli_close($link);
			?>							
	
		</div>
  
		<div class="rightcolumn">
			<div class="card">
				<h3>Popular Post</h3>
				<img src="img/post.jpg" style="width:100%; height: 100%">
				<img src="img/post2.jpg" style="width:100%; height: 100%; padding-top: 20px">
				<img src="img/post3.png" style="width:100%; height: 100%; padding-top: 20px">
			</div>
	
			<div class="card">
				<h3>Follow Us</h3>
				<a href="https://www.facebook.com/PMFKI.KK" class="fa fa-facebook"></a>
				<a href="https://www.instagram.com/pmfki/?hl=en" class="fa fa-instagram"></a>
				<a href="#" class="fa fa-google"></a>
			</div>
	
		</div>
	</div>
</div>

<!-- about us tab by ANNDREA-->
<div id="aboutus" class="tabcontent">
<div class="row">
	<div class="leftcolumn">
		<div class="card">
			<h2>Get to know our Comittee members</h2>
			
			<img src="img/comittee.jpg" style="width:100%; height: 100%">
		</div>
	</div>
	
	<div class="rightcolumn">
		<div class="card">
			<h3>Popular Post</h3>
			<img src="img/post.jpg" style="width:100%; height: 100%">
			<img src="img/post2.jpg" style="width:100%; height: 100%; padding-top: 20px">
			<img src="img/post3.png" style="width:100%; height: 100%; padding-top: 20px">
		</div>	
	</div>
	
</div>
</div>

<!-- join us tab by ANNDREA-->
<div id="joinus" class="tabcontent">
	<div class="row">
		<div class="leftcolumn">
			<div class="card">
				<h2> Join us! </h2>
				<h5> Register here to be part of the PMFKI events committee </h5>
				<form action="insert_new_member.php" method="post">
					<label for="name">Name:</label>
					<input type="text" id="name" name="name" placeholder="Name">
					
					<label for="matric_no">Matric number:</label>
					<input type="text" id="matric_no" name="matric_no" placeholder="Matric Number">
					
					<label for="course" >Course Code:</label>
					<input type="text" id="course" name="course" placeholder="Course Code">
					
					<label for="email">Email:</label>
					<input type="text" id="email" name="email" placeholder="Email">
					
					<label for="phone">Phone number:</label>
					<input type="text" id="phone" name="phone" placeholder="Phone Number">
					
					<input type="submit" value="Submit" style="width: 30%; background-color:seagreen" onclick="return confirmSubmit()">
				</form>
			
			</div>
		</div>
		
		<div class="rightcolumn">
			<div class="card">
				<h3>Popular Post</h3>
				<img src="img/post.jpg" style="width:100%; height: 100%">
				<img src="img/post2.jpg" style="width:100%; height: 100%; padding-top: 20px">
				<img src="img/post3.png" style="width:100%; height: 100%; padding-top: 20px">
			</div>	
		</div>
	</div>
	
	
</div>

<!-- feedback tab by ANNDREA -->
<div id="feedback" class="tabcontent">	
	<div class="row">
		<div class="leftcolumn">
			<div class="card">
				<h2> Give us a Feedback</h2>
				<form action="feedback.php" method="post">
					<label for = "event_name"> Choose an Event: </label>
					<select name="event_name">
						<?php
						$mysqli = new MySQLi('localhost','root','','pmfki');
						$resultSet = $mysqli->query("SELECT event_name FROM event1");
						
							while($rows = $resultSet->fetch_assoc()){
								$event_name = $rows['event_name'];
								echo "<option value='$event_name'>$event_name</option>";
							}
						?>
					</select>	
					<label for="feedback"> Feedback:</label>
					<textarea type="text" id="feedback" name="feedback" style="height: 200px; width:100%; font-family: Arial"></textarea>
					<input type="submit" value="submit" style="width: 30%; background-color:seagreen">
				</form>
			</div>
		</div>
		<div class="rightcolumn">
			<div class="card">
				<h3>Popular Post</h3>
				<img src="img/post.jpg" style="width:100%; height: 100%">
				<img src="img/post2.jpg" style="width:100%; height: 100%; padding-top: 20px">
				<img src="img/post3.png" style="width:100%; height: 100%; padding-top: 20px">
			</div>	
		</div>
	</div>
</div>	

<div class="footer">
  <img src="img/ums_logo.png" style="width:100px">
  <img src="img/fci_logo_1.png" style="width:100px; padding-left:10px">
  <p>@2021 Persatuan Mahasiswa Fakulti Komputeran dan Informatik</p>
</div>
<script>

// login modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function openNav(evt, name) {
  var i, tabcontent, tablinks;
  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(name).style.display = "block";
  evt.currentTarget.className += " active";
}
  
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();

function confirmSubmit()
{
var agree=confirm("Are you sure you wish to continue?");
if (agree)
 return true ;
else
 return false ;
}

</script>

</body>
</html>