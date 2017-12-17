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
	<title>Users Login</title>
	<!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	 <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="admin/template/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/template/css/font-awesome/css/font-awesome.min.css">
	<!-- favicon -->
	<link rel="shortcut icon" href="admin/images/logo.png">
	<!-- Theme style -->
    <link rel="stylesheet" href="admin/template/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins -->
    <link rel="stylesheet" href="admin/template/css/skins/_all-skins.css">
	<!-- CSS -->
	<link rel="stylesheet" href="admin/template/css/alertify.min.css"/>
	<link rel="stylesheet" href="admin/template/css/design.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="admin/template/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="admin/template/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="admin/template/css/themes/bootstrap.min.css"/>
</head>

<body class="hold-transition bglogin">
    <div class="login-box">
      <div class="login-logo">
          <!-- logo sudah dibuang-->
          <p style="color: white;">Welcome</p><br>
      </div><!-- /.login-logo -->
      <div class="login-box-body shadowlogin">
        <p class="login-box-msg">Sign in to Users Page</p>
		
        <form action="index.php" method="post">
          <div class="form-group has-feedback">
				<input type="text" class="form-control" id="userLogin" name="user" placeholder="Username/Matric ID" required="required" autofocus>
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
				
				<!--<a href="admin/index.php" class="btn btn-default">Admin Login</a>-->
			</div><!-- /.box-footer -->
        </form>
          
<?php
include 'config.php';

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
			$stmt = $conn->prepare("SELECT USER_ID, USER_USERN, USER_PASS, USER_FNAME FROM USERS");

			//execute query
			$stmt->execute();
			
			//fetch
			while($result = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				//store fetched data into variable
				$i = $result['USER_ID'];
				$u = $result['USER_USERN'];
				$p = $result['USER_PASS'];
				$f = $result['USER_FNAME'];
				
				//check if credentials from login form
				//match in the database. if match, set sessions, go to dashboard.
				if($user == $u && $pass == $p || $user == $i)
				{
					session_regenerate_id();
					$_SESSION['SESS_MEMBER_ID'] = $i;
					$_SESSION['SESS_MEMBER_USER'] = $u;
					$_SESSION['SESS_MEMBER_PASS'] = $p;
					$_SESSION['SESS_MEMBER_NAME'] = $f;
					session_write_close();
					header("location: homepage.php");
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
          
          <div class="panel-heading">
                  <p class="panel-title">
                    <a style="text-decoration:none" href="admin/index.php" class="text-light"><b class="text-white">ADMIN LOGIN</b></a>
                  </p>
          </div>
          
          <div class="panel-group" id="accordion">
                <div class="panel-heading">
                  <p class="panel-title">
                    <a style="text-decoration:none" data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="text-light">No Account? <b class="text-white">REGISTER NOW</b></a>
                  </p>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                  <div class="panel-body">
                    <form action="user_register.php" method="post">
                      <div class="form-group"> <label for="user_matricid">Matric ID:</label>
                        <input typ="text" class="form-control" id="user_matricid"
                        name="user_matricid"> </div>
                    <div class="form-group"> <label for="user_username">Username</label>
                        <input typ="text" class="form-control" id="user_username"
                        name="user_username"> </div>
                      <div class="form-group"> <label for="user_fullname">Full Name:</label>
                        <input typ="text" class="form-control" id="user_fullname"
                        name="user_fullname"> </div>
                      <div class="form-group"> <label for="user_email">Email:</label>
                        <input type="email" class="form-control" id="user_email"
                        name="user_email"> </div>
                      <div class="form-group"> <label for="user_pwd">Password:</label>
                        <input type="password" class="form-control" id="user_pwd"
                        name="user_pwd"> </div>
                      <!-- <p>Please insert your Student ID/Staff ID</p>
                      <input type="file">-->
                      <br>
                      <br>
                      <input type=submit name="submit" value="Submit"class="btn btn-default">
                    </form>
                  </div>
                </div>
              </div>
          


</div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
</body>
<!-- jQuery 2.1.4 -->
<script src="template/js/jquery.js"></script>
<!-- Main process scripts -->
<script src="template/js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</html>