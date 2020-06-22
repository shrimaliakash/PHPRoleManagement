<?php
	$title = "Login Page"; 
	include('header.php'); 
	include('config/db.php');
	$email ="";
	$password = "";
	$emailError ="";
	$passwordError = "";
	$loginError = "";

	if (isset($_POST['submit'])) {	
	    if (empty($_POST["email"])) {
	        $emailError = " Email is required.";
	    }
	    else if (empty($_POST["password"]) && !empty($_POST["email"])) {
	        $email = $_POST["email"];
	        $passwordError = " Password is required.";
	    }
	    else {
	        $email = $_POST["email"];
	        $password = md5($_POST["password"]);
	        $sql_login = "SELECT * FROM tbl_login WHERE email='".$email."' AND password='".$password."'";
			$result_login_query = $conn->query($sql_login);
			$result_login = $result_login_query->fetch_assoc();
			if (!empty($result_login) && $result_login['isBlock'] == 0) {
				$login_sql = "UPDATE tbl_login SET isLogin = '1' WHERE  email='".$email."' AND password='".$password."'";
				if ($conn->query($login_sql) === TRUE) {
					$role_id = $result_login['role'];
					$sql_role = "SELECT * FROM tbl_other WHERE id='".$role_id."'";
					$result_login_query = $conn->query($sql_role);
					$result_role = $result_login_query->fetch_assoc();
					session_start();
					$_SESSION['user_id'] = $result_login['userid'];
					$_SESSION['role'] = $result_login['role'];
					$_SESSION['email'] = $result_login['email'];
					$_SESSION['permission'] = $result_role['permission'];
					if($result_role['role'] == 'Admin') {
						header("Location: Admin.php");
					} else if($result_role['role'] == 'Manager') {
						header("Location: Manager.php");
					} else {
						header("Location: Customer.php");
					}
				  	
				} else {
				  echo "Error: " . $login_sql . "<br>" . $conn->error;
				}
			} else if($result_login['isBlock'] == 1) {
				$email = $_POST["email"];
				$password = $_POST["password"];
	       		$loginError = "Your account is block please contact admininstartor.";
			}	else {
				$email = $_POST["email"];
				$password = $_POST["password"];
	       		$loginError = "Incorrect Email or Password.";
			}
			$conn->close();
	    } 
		
	}
?>
<html>
	<head>
		<title>Login Page</title>
	</head>
	<body>
		<div class="container mar-all">
			<h1 class="mar-all">Login</h1>
			<form method="post">
				<div class="col-md-4 mar-all">
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="email" value="<?php echo htmlspecialchars($email);?>">
						<span class="error"> <?php echo $emailError;?></span>
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="password" value="<?php echo htmlspecialchars($password);?>">
						<span class="error"> <?php echo $passwordError;?></span>
					</div>
					<div class="form-group">
						<span class="error"> <?php echo $loginError;?></span>
					</div>
					<button class="btn btn-lg btn-success" type="submit" name="submit">Login</button>
					<a href="/PHPRoleManagement/registration.php">Not a User?</a>
			</form>
		</div>
	</body>
</html>