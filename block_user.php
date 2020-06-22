<?php
	session_start();
	$title = "Login Page"; 
	include('header.php'); 
	include('config/db.php');
	$login_sql = "UPDATE tbl_login SET isBlock = '1' WHERE  id='".$_GET['id']."'";
	if ($conn->query($login_sql) === TRUE) {
		header("Location: Admin.php");
	} else {
	  echo "Error: " . $login_sql . "<br>" . $conn->error;
	}
	$conn->close();
?>