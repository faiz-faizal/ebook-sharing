<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ebooksharing";

    //create connection
    $conn= mysqli_connect($servername,$username,$password,$dbname);
    
    if(isset($_POST['submit']))
    {
        
    //Assign variable
    $i = $_POST['user_matricid'];
    $u = $_POST['user_username'];
    $f = $_POST['user_fullname'];
    $e = $_POST['user_email'];
    $p = $_POST['user_pwd'];
    

    if(!$conn)
    {
        die("connnection failed: ".mysqli_connect_error());
    }

    $sql = "INSERT INTO users (USER_ID,USER_USERN,USER_FNAME,USER_EMAIL,USER_PASS) VALUES('$i','$u','$f','$e','$p')";
    }

    if(mysqli_query($conn, $sql))
    {
        echo "New record created successfully";

    }
    else
    {
        echo "Error: ".$sql."<br>".mysqli_error($conn);
    }

    mysqli_close($conn);
        
?>