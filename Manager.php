<?php
	session_start();	
	$title = "Admin Page";
	include('header.php');
	include('config/db.php');
	$sql__all_role = "SELECT role,id FROM tbl_other WHERE id != '".$_SESSION['role']."'";
	$sql__all_role_query = $conn->query($sql__all_role);
	while($row = $sql__all_role_query->fetch_assoc()) {
		$roles[] = $row;
	};
?>

<div class="row">
	<button type='button' class="btn btn-danger mar-all logout" onclick="logout()">Logout</button>
</div>
<div class="row">
	<div class="col-md-4">
		<?php 
			foreach($roles as $key => $role) {	
				echo "
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

						function get".$role['role']."() {
							window.location.href = '/PHPRoleManagement/".$role['role'].".php';
						}
					</script>
					<div class='row mar-all'>
						<button type='button' class='btn btn-lg btn-success' onclick='get".$role['role']."()' id='".$role['id']."'>".$role['role']."</button>
					</div>
				";
			}
		?>
	</div>
	<div class="col-md-8 mar-top">
		<h6>Welcome Manager</h6>
	</div>
</div>
<?php
	$conn->close();
?>