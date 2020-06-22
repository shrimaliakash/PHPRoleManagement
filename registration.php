<?php
	$title = "Admin Page";
	include('header.php');
	include('config/db.php');
	$first_name = "";
	$last_name = "";
	$email = "";
	$password = "";
	$role = "";
	$first_nameErr ="";
	$last_nameErr ="";
	$emailErr ="";
	$passwordErr ="";


	$sql = "SELECT * FROM tbl_other";
	$result = $conn->query($sql);
	if (!empty($result)) {
		while ($row = $result->fetch_assoc()) {
			$roles[] = $row;
	    }	
	}
	if (isset($_POST['submit'])) {
		$post = $_POST;
		if(count($post) > 0) {
			foreach ($post as $key => $value) {
				$fields_map = array(
				  'first_name' => 'First Name',
				  'last_name' => 'Last Name',
				  'email' => 'Email',
				  'password' => 'Password',
				  'role' => '',
				  'submit' => ''
				);
				if($fields_map[$key] == 'First Name') {
					$message  = $fields_map[$key]." is required.";
					$first_nameErr = $message;
				}
				if($fields_map[$key] == 'Last Name') {
					$message  = $fields_map[$key]." is required.";
					$last_nameErr = $message;
				}
				if($fields_map[$key] == 'Email') {
					$message  = $fields_map[$key]." is required.";
					$emailErr = $message;
				}
				if($fields_map[$key] == 'Password') {
					$message  = $fields_map[$key]." is required.";
					$passwordErr = $message;
				}
			}

		}
		if((!empty($_POST['first_name'])) && (!empty($_POST['last_name'])) && (!empty($_POST['email'])) & (!empty($_POST['password']))) {
			$first_name = $_POST['first_name'];
			$first_nameErr = '';
			$last_name = $_POST['last_name'];
			$last_nameErr = '';
			$emailErr = '';
			$passwordErr = '';
			$sql_tbl_info = "INSERT INTO tbl_info (first_name, last_name) VALUES ('".$first_name."', '".$last_name."')";

			if ($conn->query($sql_tbl_info) === TRUE) {
				$user_id = $conn->insert_id;
				$email = $_POST['email'];
				$password = $_POST['password'];
				$role = $_POST['role'];
				$sql_tbl_login = "INSERT INTO tbl_login (userid, role, email, password) VALUES ('".$user_id."', '".$role."', '".$email."', '".md5($password)."')";
				if ($conn->query($sql_tbl_login) === TRUE) {			
			  		header("Location: index.php");
			  	} else {
					echo "Error: " . $sql_tbl_login . "<br>" . $conn->error;
				}
			} else {
				echo "Error: " . $sql_tbl_info . "<br>" . $conn->error;
			}
		} else {
		 	if((!empty($_POST['first_name']))) {
				$first_name = $_POST['first_name'];
				$first_nameErr = '';
			}
			if((!empty($_POST['last_name']))) {
				$last_name = $_POST['last_name'];
				$last_nameErr = '';
			}
			if((!empty($_POST['email']))) {
				$email = $_POST['email'];
				$emailErr = '';
			}
			if((!empty($_POST['password']))) {
				$password = $_POST['password'];
				$passwordErr = '';
			}
		}
	}

	$conn->close();
?>
<div class="col-md-4 mar-all">
<form method="post" action="registration.php">
	<div class="container">
		<div class="form-group">
			<label for="first_name">First Name</label>
			<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter Frist Name" value="<?php echo htmlspecialchars($first_name);?>">
			<span class="error"><?php echo $first_nameErr;?></span>
		</div>
		<div class="form-group">
			<label for="last_name">Last Name</label>
			<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" value="<?php echo htmlspecialchars($last_name);?>">
			<span class="error"><?php echo $last_nameErr;?></span>
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?php echo htmlspecialchars($email);?>">
			<span class="error"><?php echo $emailErr;?></span>
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" value="<?php echo htmlspecialchars($password);?>">
			<span class="error"><?php echo $passwordErr;?></span>
		</div>
		<div class="form-group">
			<label for="role">Role</label>
			<select class="form-control" id="role" name="role">
				<?php
					foreach($roles as $key => $val) {
			   			echo "<option value=".$val['id'].">".$val['role']."</option>";
				} ?>
			</select>
		</div>
		<button class="btn btn-lg btn-success" type="submit" name="submit">Submit</button>
	</div>
</form>
</div>