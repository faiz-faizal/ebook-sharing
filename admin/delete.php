<?php 

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ebooksharing";

    //create connection
    $conn= mysqli_connect($servername,$username,$password,$dbname);
	
	$X = $_GET['X'];
	$sql = "delete from feedback where FED_EMAIL = '$X' ";
	$q = mysqli_query($conn, $sql);
	
	if($q)
	{
		echo "<a href='view_feedback.php' > view feedback</a>";
	}
	else{
		
		echo "fail delete lah bro";
	}
	?>