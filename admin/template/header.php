<?php
  require_once('./auth.php');
  $adminname = $_SESSION['SESS_MEMBER_NAME'];
  $adminid = $_SESSION['SESS_MEMBER_ID'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administrator Page</title>
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
  
  <link rel="stylesheet" href="./template/css/pure-min.css">
  
  <link rel="stylesheet" href="./template/css/balloon.min.css">
  <link rel="stylesheet" href="./template/css/bootstrap-select.css">
  
  
  <!-- Chart.js -->
  <script src="./template/js/Chart.min.js"></script>
  
  </head>
  
  <body class="sidebar-mini wysihtml5-supported skin-green-light">
    <div class="wrapper">
      <header class="main-header">

        <!-- Logo -->
        <a href="./home.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>EL</b>I</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>E-Library </b>Info</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" id="sidebar" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
      
         <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             
       
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../images/logo.png" class="user-image" alt="User Image">
                  <span class="hidden-xs">Administrator Page</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../images/logo.png" alt="User Image">
           <p>
                      Time : <?php date_default_timezone_set("Asia/Kuala_Lumpur"); echo date("h:i:s a"); ?><br>
            Date : <?php echo date("d-m-Y"); ?><br>
                    </p>
           </li>
          
                  <!-- Menu Footer-->
                  <li class="user-footer">
           <div class="pull-right">
                      <a href="#" class="btn btn-warning " id="logoutBut"><font color="white">Logout  <i class="fa fa-sign-out"></i></font></a>
           </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
      
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <?php
              if(file_exists('../images/users/'.$adminid.'.jpg'))
              {
               echo "<img src='../images/users/".$adminid.".jpg' class='img-circle' alt='User Image'>"; 
              }
              else
              {
                echo "<img src='../images/users/noimage.jpg' class='img-circle' alt='User Image'>"; 
              }

              ?>
            </div>
            <div class="pull-left info">
              <p><?php echo $adminname ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
      
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
              <a href="./home.php">
                <i class="fa fa-pie-chart"></i> <span>Statistics</span>
              </a>
            </li>
            <li class="active">
              <a href="./add.php">
                <i class="fa fa-edit"></i> <span>Add New Book</span>
              </a>
            </li>
             <li class="active">
              <a href="./managebook.php">
                <i class="fa fa-fw fa-list-alt"></i> <span>Manage Books</span>
              </a>
            </li>
            <li class="active">
              <a href="./upcomingbk.php">
                <i class="fa fa-fw fa-list-alt"></i> <span>Manage Upcoming Books</span>
              </a>
            </li>
            <li class="active">
              <a href="./membership.php">
                <i class="fa fa-fw fa-group"></i> <span>Manage Memberships</span>
              </a>
            </li>
       <li><br><br><hr>
        <div class="user-panel-logo">
          <div class="pull-left image">
            <img src="../images/logo.png"  alt="Logo">
          </div>
        </div>
      </li>
          </ul>
        </section>
        <!-- /.sidebar -->
    
    
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
       
        <!-- Main content -->
        <section class="content">
    <div id='adminpage'></div>
    <div id="desktopTest" class="hidden-xs"></div>