<?php

//Start session
session_start();	
//Unset the variables stored in session
unset($_SESSION['SESS_MEMBER_ID']);
unset($_SESSION['SESS_MEMBER_USER']);
unset($_SESSION['SESS_MEMBER_PASS']);
unset($_SESSION['SESS_MEMBER_NAME']);

?>
<html>
<head>
	<title>Administrator Login</title>
	<!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	 <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="./template/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./template/css/font-awesome/css/font-awesome.min.css">
	<!-- favicon -->
	<link rel="shortcut icon" href="../images/logo.png">
	<!-- Theme style -->
    <link rel="stylesheet" href="./template/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins -->
    <link rel="stylesheet" href="./template/css/skins/_all-skins.css">
	<!-- CSS -->
	<link rel="stylesheet" href="./template/css/alertify.min.css"/>
	<link rel="stylesheet" href="./template/css/design.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="./template/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="./template/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="./template/css/themes/bootstrap.min.css"/>
</head>

<body class="hold-transition bglogin">
    <div class="login-box">
      <div class="login-logo">
          <!-- logo sudah dibuang-->
          <p style="color: white;">Welcome</p><br>
      </div><!-- /.login-logo -->
      <div class="login-box-body shadowlogin">
        <p class="login-box-msg">Sign in to Administrator Page</p>
		
        <form action="index.php" method="post">
          <div class="form-group has-feedback">
				<input type="text" class="form-control" id="userLogin" name="user" placeholder="Username" required="required" autofocus>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
				<div id="errUser"></div>
          </div>
          <div class="form-group has-feedback">
				<input type="password" class="form-control" id="passLogin" name="pass" placeholder="Password" required="required">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				<div id="errPass"></div>
          </div>
		  
			<div class="box-footer">
				<input type="submit" class="btn btn-success pull-right" value="Log In" name="login">
				</form>
				<a href="../index.php" class="btn btn-default">User Login</a>
			</div><!-- /.box-footer -->


        

<?php
include '../config.php';

if(isset($_POST['login']))
{
	if(isset($_POST["user"]) && isset($_POST["pass"]))
	{
		$user = (isset($_POST["user"]) ? $_POST["user"] : null);
		$pass = (isset($_POST["pass"]) ? $_POST["pass"] : null);
			
		try
		{
			//connect sql using PDO
			$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//sql query
			$stmt = $conn->prepare("SELECT ADMIN_ID, ADMIN_USERN, ADMIN_PASS, ADMIN_FNAME FROM ADMIN");

			//execute query
			$stmt->execute();
			
			//fetch
			while($result = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				//store fetched data into variable
				$i = $result['ADMIN_ID'];
				$u = $result['ADMIN_USERN'];
				$p = $result['ADMIN_PASS'];
				$f = $result['ADMIN_FNAME'];
				
				//check if credentials from login form
				//match in the database. if match, set sessions, go to dashboard.
				if($user == $u && $pass == $p)
				{
					session_regenerate_id();
					$_SESSION['SESS_MEMBER_ID'] = $i;
					$_SESSION['SESS_MEMBER_USER'] = $u;
					$_SESSION['SESS_MEMBER_PASS'] = $p;
					$_SESSION['SESS_MEMBER_NAME'] = $f;
					session_write_close();
					header("location: home.php");
					exit();
				}
				else
				{
					$err = "Wrong username/password!";
				}
			}
			
		}
		catch(PDOException $e)
		{
			echo "Connection failed : " . $e->getMessage();
		}
	}

	if(isset($err))
	{
		echo "<center><font color='red'><p>$err</p></font></center>";
	}
}

	
?>

</div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
</body>
<!-- jQuery 2.1.4 -->
<script src="./template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Main process scripts -->
<script src="./template/scripts/script.js"></script>
</html>