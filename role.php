<?php
	$title = "Role Page";
	include('header.php'); 
    include('config/db.php');
	$roleErr ="";
	$role = "";
	if (isset($_POST['submit'])) {
	    if (empty($_POST["role"])) {
	        $roleErr = "Role is required.";
	    }
	    else {
	        $role = $_POST["role"];
	        $sql = "INSERT INTO tbl_other (role) VALUES ('".$role."')";

			if ($conn->query($sql) === TRUE) {
			  header("Location: role.php");
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();
	    } 
		
	}
?>
<div class="col-md-4 mar-all">
<form method="post" action="role.php">
	<div class="container">
		<div class="form-group">
			<label for="role">Role</label>
			<input type="text" class="form-control" name="role" id="role" placeholder="Enter Role" value="<?php echo htmlspecialchars($role);?>">
			<span class="error"><?php echo $roleErr;?></span>
		</div>
		<button class="btn btn-lg btn-success" type="submit" name="submit">SUBMIT</button>
	</div>
</form>
</div>