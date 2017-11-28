<?php

//Unset the variables stored in session
unset($_SESSION['SESS_MEMBER_ID']);
unset($_SESSION['SESS_MEMBER_USER']);
unset($_SESSION['SESS_MEMBER_PASS']);
unset($_SESSION['SESS_MEMBER_NAME']);
 
session_destroy();
header("location: index.php");
exit();

?>