<?php
	session_start();
	$title = "Customer Page";
	include('header.php');
	include('config/db.php');
	$user_id = $_SESSION["user_id"];

	$image_sql = "SELECT profile_image FROM tbl_info WHERE id ='$user_id';";
	$profile_image_query = $conn->query($image_sql);
	$profile_image_result = $profile_image_query->fetch_assoc();
	$profile_image = $profile_image_result['profile_image'];
	if(isset($_FILES['file'])){
	    $file= $_FILES['file'];
	    $fileName = $_FILES['file']['name'];
	    $fileTmp = $_FILES['file']['tmp_name'];
	    $fileSize = $_FILES['file']['size'];
	    $filesError = $_FILES['file']['error'];
	    $fileType = $_FILES['file']['type'];
	    
	    $fileExt = explode('.',$_FILES['file']['name']);
	    $fileActualExt = strtolower(end($fileExt));
	    $allowed = array('jpg','jpeg','png','pdf');
	    if(in_array($fileActualExt,$allowed)){
	        if($_FILES['file']['error'] ===  0){
	            if($_FILES['file']['size'] < 1000000){            
	                $fileNameNew = "profile_".$user_id.".".$fileActualExt;
	                $fileDestination = 'uploads/'.$fileNameNew;
	                move_uploaded_file($_FILES['file']['tmp_name'],$fileDestination);
	                $sql = "UPDATE tbl_info SET profile_image = '$fileDestination' WHERE id ='$user_id';";
	                $result = mysqli_query($conn, $sql);
	                header("Location: Customer.php");
	            }else{
	                echo "Your file is too big!";
	            }
	        }else{
	            echo "You have an error uploading your file!";
	        }
	    }else{
	        echo "You cannot upload files of this type!";
	    }

	}
?>
<script type='text/javascript'>
	function logout() {
		var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				window.location.href = '/PHPRoleManagement/index.php';
			}
	    };
	    xmlhttp.open('POST', 'logout.php');
	    xmlhttp.send();
	}
</script>
<div class="row">
	<div class="col-md-11 mar-all">
		<button type='button' class="btn btn-danger mar-all float-right" onclick="logout()">Logout</button>
	</div>
</div>
<div class="row mar-all">
	<div class="col-md-3">
		<img src="<?= $profile_image; ?>" height="70px" width="70px">
	</div>
	<div class="col-md-7">
		<h6>Welcome Customer</h6>
	</div>
</div>
<div class="row mar-all">
	<form action='Customer.php' method='POST' enctype='multipart/form-data'>
	    <input type='file' name='file'>
	    <button type='submit' name='upload_submit'>Upload</button>
	</form>
</div>