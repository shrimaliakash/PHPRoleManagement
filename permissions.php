<?php 
	$title = "Permission Page";
	include('header.php'); 
    include('config/db.php');
	$permissionErr ="";
	$permission = "";
	$sql = "SELECT * FROM tbl_other";
	$result = $conn->query($sql);
	if (!empty($result)) {
		while ($row = $result->fetch_assoc()) {
			$roles[] = $row;
	    }	
	}

	if (isset($_POST['submit'])) {	
	    if (empty($_POST["permission"])) {
	        $permissionErr = "Permission is required.";
	    }
	    else {
	        $new_permission = $_POST["permission"];
	        $role = $_POST["role"];
	        $sql_permission = "SELECT permission FROM tbl_other WHERE id='".$role."'";
			$result_permission_query = $conn->query($sql_permission);
			$result_permission = $result_permission_query->fetch_assoc();
			if (!empty($result_permission['permission'])) {
				$permission = $result_permission['permission'].','.$new_permission;
				$sql = "UPDATE tbl_other SET permission = '".$permission."' WHERE id='".$role."'";
			} else {
	       		$sql = "UPDATE tbl_other SET permission = '".$new_permission."' WHERE id='".$role."'";
			}

			if ($conn->query($sql) === TRUE) {
			  header("Location: permissions.php");
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();
	    } 
		
	}
?>
<div class="container">
	<form method="post" action="permissions.php">
		<div class="col-md-4 mar-all">
			<div class="form-group">
				<label for="permission">Permission</label>
				<input type="text" class="form-control" name="permission" id="permission" placeholder="Enter Permission" value="<?php echo htmlspecialchars($permission);?>">
				<span class="error"><?php echo $permissionErr;?></span>
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