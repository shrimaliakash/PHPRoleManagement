<?php
	session_start();
	$title = "Login Page"; 
	include('header.php'); 
	include('config/db.php');
	$login_sql = "UPDATE tbl_login SET isLogin = '0' WHERE  email='".$_SESSION['email']."'";
	if ($conn->query($login_sql) === TRUE) {
		session_destroy();
		header("Location: index.php");
	} else {
	  echo "Error: " . $login_sql . "<br>" . $conn->error;
	}
	$conn->close();
?>