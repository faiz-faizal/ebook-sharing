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
		echo "<script>location.href='view_feedback.php'</script>";
	}
	else{
		
		echo "Action Fail";
	}
	?>