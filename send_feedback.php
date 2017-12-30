<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ebooksharing";

    //create connection
    $conn= mysqli_connect($servername,$username,$password,$dbname);
    
    if(isset($_POST['contactMsg']))
    {
        
    //Assign variable
    $n = $_POST['name'];
    $e = $_POST['email'];
    $m = $_POST['message'];
    
    if(!$conn)
    {
        die("connnection failed: ".mysqli_connect_error());
    }

    $sql = "INSERT INTO FEEDBACK (FED_NAME,FED_EMAIL,FED_MSG) VALUES('$n','$e','$m')";
    }

    if(mysqli_query($conn, $sql))
    {
		echo "<script>window.alert('Done')</script>";
        echo "<script>location.href='contact.php'</script>";

    }
    else
    {
        echo "Error: ".$sql."<br>".mysqli_error($conn);
    }

    mysqli_close($conn);
        
?>