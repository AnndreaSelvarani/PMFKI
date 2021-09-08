<?php
session_start();
include("connect.php");
include("config.php");
$db_handle = new DBController();
?>

<!DOCTYPE html>
<html>
<link rel="icon" href="img/circle-cropped.png">
<link rel="stylesheet" href="styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script language="javascript" type="text/javascript" src="tablefilter.js"></script>

<body>

<div class="header">
  <h1>PMFKI</h1>
  <p>Persatuan Mahasiswa Fakulti Komputeran dan Informatik</p>
</div>

<div class="tab">
<div class="topnav">
	<a class="tablinks" onclick="openNav(event, 'member')" id="defaultOpen">Member</a>
	<a class="tablinks" onclick="openNav(event, 'event')">Events</a>
	<a class="tablinks" onclick="openNav(event, 'documents')">Documents</a>
	<a class="tablinks" onclick="openNav(event, 'feedback')">Feedback</a>
	<a href="index.php" style="float:right; color:white">Logout</a>
</div>
</div>

<!-- members tab by ANNDREA-->
<div id="member" class="tabcontent">
	<div class="row">
		<div class="columnLeft">
			<div class="card">
				<img src="img/img_avatar2.png" style="width:100%;">
				<h2 style="text-align:center;">Admin Information</h2>
				<h5>Name: Admin</h5>
				<h5>Matric No: BI0000000</h5>
				
			</div>
			<div class="card">
				<h2>Add New Member</h2>
				<p> Manually Add Members</p>
				<form action="insert.php" method="post">
				<label for="name">Name:</label>
				<input type="text" id="name" name="name">
			
				<label for="matric_no">Matric No:</label>
				<input type="text" id="matric_no" name="matric_no">
				
				<label for="course_code">Course Code:</label>
				<input type="text" id="course_code" name="course_code">

				<label for="email">Email:</label>
				<input type="text" id="email" name="email">
				
				<label for="phone">Phone No.:</label>
				<input type="text" id="phone" name="phone">

				<input type="submit" value="submit" style="background-color:seagreen" >
				</form>
			</div>	
		</div>	
	
		<div class="columnRight">
			<div class="card">
				<h2> Members List</h2>
						
				<?php
					$sql = "SELECT * FROM member1";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){

                                echo "<table id='customers'>";
                                    echo "<tr>";
                                        echo "<th>Id</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Matric no</th>";
                                        echo "<th>Course code</th>";
										echo "<th>Email</th>";
										echo "<th>Phone no.</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                
                                
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['matric_no'] . "</td>";
                                        echo "<td>" . $row['course_code'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
										
                                        echo "<td>";
                                            echo '<button><a href="admin.php?edit='.$row['id'].'">Update</a></button>';
                                            echo '<button><a onclick="return confirmSubmit()" href="delete_member.php?id='.$row['id'].'">Delete</a></button>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                                           
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    //mysqli_close($link);
                    ?>
			</div>
		
			<div class="card">
				<h2> New Members List</h2>
				<p> List of applying members that needs to be approved</p>
						
					<?php
						$sql = "SELECT * FROM new_member";
						if($result = mysqli_query($link, $sql)){
							if(mysqli_num_rows($result) > 0){
								echo "<table id='customers'>";
                                    echo "<tr>";
                                    
                                        echo "<th>Name</th>";
                                        echo "<th>Matric no</th>";
                                        echo "<th>Course code</th>";
										echo "<th>Email</th>";
										echo "<th>Phone</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                
							
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['matric_no'] . "</td>";
                                        echo "<td>" . $row['course'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
										echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>";
                                           echo '<button><a onclick="return confirmSubmit()" href="approve_member.php?id='.$row['id'].'">Approve</a></button>';
										   echo '<button><a onclick="return confirmSubmit()" href="delete_new_member.php?id='.$row['id'].'">Delete</a></button>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
							                          
								echo "</table>";
							}
							else{
								echo "No new records";
							}
						} 
						else{
                        echo "ERROR: Could not execute $sql. " . mysqli_error($link);
						}
                    ?>
			</div>

			
			<div class="card">
		
				<h2>Update Member's Info</h2>
				<?php
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
				else {
					$name=null;
					$matric=null;
					$course=null;
					$email=null;
					$phone=null;
				}
				?>
				 
				<form action="update.php" method="post">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
				
						<label for="name">Name:</label>
						<input type="text" id="name" name="name" value ="<?php echo $name; ?>" >
						
						<label for="matric_no">Matric No:</label>
						<input type="text" id="matric_no" name="matric_no" value="<?php echo $matric; ?>">
				
						<label for="course_code">Course Code:</label>
						<input type="text" id="course_code" name="course_code" value="<?php echo $course; ?>">

						<label for="email">Email:</label>
						<input type="text" id="email" name="email" value="<?php echo $email; ?>">
				
						<label for="phone">Phone No.:</label>
						<input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">

						<input type="submit" name="update" value="update" style="background-color:seagreen">
					
			
				
				</form>
		
			</div>
		</div>
	</div>
</div>			
			

<!-- document tab by ANNDREA-->
<div id="documents" class="tabcontent">
	<div class="row">
		<div class="columnLeft">
			<div class="card">
				<img src="img/img_avatar2.png" style="width:100%;">
				<h2 style="text-align:center;">Admin Information</h2>
				<h5>Name: Admin</h5>
				<h5>Matric No: BI0000000</h5>
				
			</div>
			<?php 
			$sql = "SELECT * FROM event1";
			
			echo "<div class=card>";
			echo "<h2 style='text-align:center'>Current Events</h2>";
				if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
                            
                            echo "<h3>" . $row['event_name'] . "</h3>";
                            echo "<h5>" . $row['event_des'] ." | ". $row['event_date']. "</h5>";
   
							
                            }
							echo "</div>";
							
						mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }	
					//mysqli_close($link);
			?>
		</div>
		
		<div class="columnRight">
			<div class="card">
				<h2>Store files here</h2>
				<form action="upload_file.php" method='post' enctype="multipart/form-data">
				
				<label for="name">File Name:</label>
				<input type="text" id="name" name="name" style="width:30%">
				
				<input type="file" id="file" name="file" style="padding-left:10px"/><br><br>
				
				<input type="submit" name="submit" value="upload" style="background-color:seagreen" >
				</form>
			</div>
			
			<div class="card">
				<h2>Stored Files</h2>				

				<?php
					
					$sql = "SELECT * FROM document";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){

                                echo "<table id='customers'>";
                                    echo "<tr>";
                                        echo "<th>Id</th>";
										echo "<th>Name</th>";
                                        echo "<th>File size</th>";
                                        
										echo "<th>Time</th>";
										echo "<th>Action</th>";
                                    echo "</tr>";
                                
                                
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
										echo "<td>" . $row['name'] . "</td>";
										echo "<td>" . $row['size'] . "</td>";
										echo "<td>" . $row['uploaded'] . "</td>";
                                        echo "<td>";
											?> <button><a href="uploads/<?php echo $row['file'] ?>" target="_blank">View File</a></button>
											<?php
                                            echo '<button><a onclick="return confirmSubmit()" href="delete_file.php?id='.$row['id'].'">Delete</a></button>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                                           
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    //mysqli_close($link);
					
					
					?>
                    
			</div>
		</div>
	</div>
</div>

<!--events tab by ANNDREA-->
<div id="event" class="tabcontent">
	<div class="row">
		<div class="columnLeft">
			<div class="card">
				<img src="img/img_avatar2.png" style="width:100%;">
				<h2 style="text-align:center;">Admin Information</h2>
				<h5>Name: Admin</h5>
				<h5>Matric No: BI0000000</h5>
				
			</div>
			
			<?php 
			$sql = "SELECT * FROM event1";
			
			echo "<div class=card>";
			echo "<h2 style='text-align:center'>Current Events</h2>";
				if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
                            
                            echo "<h3>" . $row['event_name'] . "</h3>";
                            echo "<h5>" . $row['event_des'] ." | ". $row['event_date']. "</h5>";
   
							
                            }
							echo "</div>";
							
						mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }	
					//mysqli_close($link);
			?>
		</div>
		
		<div class="columnRight">
			<div class="card">
				<h2> Events </h2>
				<p> Create New Event </p>
				<form action="insert_event.php" method="post">
				<label for="event_name">Event Name:</label>
				<input type="text" name="event_name">
				
				<label for="event_des">Event description:</label>
				<input type="text" name="event_des">
				
				<label for="event_date">Event Date:</label>
				<input type="date" name="event_date">
				
				<label for="event_text">Event Text:</label>
				<textarea type="text" id="event_text" name="event_text" style="height: 200px; width:100%; font-family: Arial"></textarea>
				
				<input type="submit" value="submit" style="background-color:seagreen">
				</form>
			</div>
			
			<div class="card">
				<h2> Event List </h2>
				<?php
					
					$sql = "SELECT * FROM event1";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){

                                echo "<table id='customers'>";
                                    echo "<tr>";
										echo "<th>Event Name</th>";
                                        echo "<th>Event Date</th>";	
										echo "<th>Action</th>";
                                    echo "</tr>";
                                
                                
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";                                      
										echo "<td>" . $row['event_name'] . "</td>";                                        
										echo "<td>" . $row['event_date'] . "</td>";										
                                        echo "<td>";
                                            echo '<button><a onclick="return confirmSubmit()" href="delete_event.php?event_name='.$row['event_name'].'">Delete</a></button>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                                           
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    //mysqli_close($link);
					
					
					?>
			</div>	
		</div>
	</div>
</div>	

<!--feedback tab by ANNDREA-->
<div id="feedback" class="tabcontent">	
	<div class="row">
		<div class="columnLeft">
			<div class="card">
				<img src="img/img_avatar2.png" style="width:100%;">
				<h2 style="text-align:center;">Admin Information</h2>
				<h5>Name: Admin</h5>
				<h5>Matric No: BI0000000/h5>
				
			</div>
			<?php 
			$sql = "SELECT * FROM event1";
			
			echo "<div class=card>";
			echo "<h2 style='text-align:center'>Current Events</h2>";
				if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
                            
                            echo "<h3>" . $row['event_name'] . "</h3>";
                            echo "<h5>" . $row['event_des'] ." | ". $row['event_date']. "</h5>";	
                            }
							echo "</div>";
							
						mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }	
					//mysqli_close($link);
			?>
		</div>
		
		<div class="columnRight">
			<div class="card">
			<h2>Generate new data</h2>
			<p> Click button to generate latest feedback statistics</p>
			<form action="generatedata.php" method="post">
			<input type="submit" value="Generate" name="Generate" style="background-color:#A91B0D">
			
			</form>
			</div>
			
			<div class="card">
				<h2> Feedback</h2>
				<p> Latest overall statistic of feedback collected </p>	
				<img id="testimg" src='my_plot.png'>
				<p> Latest Statistic of Feedback collected based on Events</p>
				<img id="eventimg" src='my_plot_1.png'>
			</div>
			<div class ="card">
				<h2> List of feedback </h2>
					<select name="event"  id="Dropdown" oninput="filterTable()">
					<option>All</option>;
						<?php
						$mysqli = new MySQLi('localhost','root','','pmfki');
						$resultSet = $mysqli->query("SELECT DISTINCT event FROM feedback_result");
						
							while($rows = $resultSet->fetch_assoc()){
								$event = $rows['event'];
								echo "<option value='$event'>$event</option>";
							}
						?>
					</select>
				
						<?php
							
							$sql = "SELECT * FROM feedback_result";
							if($result = mysqli_query($link, $sql)){
								if(mysqli_num_rows($result) > 0){

									echo "<table id=myTable>";
										echo "<tr>";
										echo "<th>Event</th>";
                                        echo "<th>Feedback</th>";	
										echo "<th>Score</th>";
										echo "</tr>";
                                
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";                                      
										echo "<td>" . $row['event'] . "</td>";                                        
										echo "<td>" . $row['feedback'] . "</td>";
										echo "<td>" . $row['score'] . "</td>";                                
                                    echo "</tr>";
                                }
                                                           
								echo "</table>";
								// Free result set
								mysqli_free_result($result);
								} else{
								echo "<p class='lead'><em>No records were found.</em></p>";
								}
							} else{
							echo "ERROR: Could not execute $sql. " . mysqli_error($link);
							}	
						?>
			</div>		
		</div>
	</div>	
</div>	
	
<script>
function openNav(evt, name) {
  // Declare all variables
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
  
    var timestamp = new Date().getTime();      
	var el = document.getElementById("testimg");
	var el1 = document.getElementById("eventimg");
	el.src = "my_plot.png?t=" + timestamp;
	el1.src = "my_plot_1.png?t=" + timestamp;
  
  function refreshImage(imgElement, imgURL){    
    // create a new timestamp 
    var timestamp = new Date().getTime();  
    var el = document.getElementById(imgElement);
	var el1 = document.getElementById(imgElement);
    var queryString = "?t=" + timestamp;    
    el.src = imgURL + queryString;
    el1.src = imgURL + queryString;    
}

function confirmSubmit()
{
var agree=confirm("Are you sure you wish to continue?");
if (agree)
 return true ;
else
 return false ;
}


function filterTable() {
  // Variables
  let dropdown, table, rows, cells, event, filter;
  dropdown = document.getElementById("Dropdown");
  table = document.getElementById("myTable");
  rows = table.getElementsByTagName("tr");
  filter = dropdown.value;
  
  // Loops through rows and hides those with event that don't match the filter
  for (let row of rows) { // `for...of` loops through the NodeList
    cells = row.getElementsByTagName("td");
    event = cells[0] || null; // gets the 2nd `td` or nothing
    // if the filter is set to 'All', or this is the header row, or 2nd `td` text matches filter
    if (filter === "All" || !event || (filter === event.textContent)) {
      row.style.display = ""; // shows this row
    }
    else {
      row.style.display = "none"; // hides this row
    }
  }
}

 var table = document.getElementById("table"),rIndex;
            
            for(var i = 1; i < table.rows.length; i++)
            {
                table.rows[i].onclick = function()
                {
                    rIndex = this.rowIndex;
                    console.log(rIndex);
                    
                    document.getElementById("fname").value = this.cells[0].innerHTML;
                    document.getElementById("lname").value = this.cells[1].innerHTML;
                    document.getElementById("age").value = this.cells[2].innerHTML;
                };
            }
            
            
           // edit the row
            function editRow()
            {
                table.rows[rIndex].cells[0].innerHTML = document.getElementById("fname").value;
                table.rows[rIndex].cells[1].innerHTML = document.getElementById("lname").value;
                table.rows[rIndex].cells[2].innerHTML = document.getElementById("age").value;
            }

</script>
	

<div class="footer">
  <img src="img/ums_logo.png" style="width:100px">
  <img src="img/fci_logo_1.png" style="width:100px; padding-left:10px">
  <p>@2020 Persatuan Mahasiswa Fakulti Komputeran dan Informatik</p>
</div>

</body>
</html>