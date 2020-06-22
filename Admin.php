<?php
	session_start();	
	$title = "Admin Page";
	include('header.php');
	include('functions.php');
	include('config/db.php');
	$sql_all_role = "SELECT role,id FROM tbl_other WHERE id != '".$_SESSION['role']."'";
	$sql_all_role_query = $conn->query($sql_all_role);
	while($row = $sql_all_role_query->fetch_assoc()) {
		$roles[] = $row;
	}

	$manager_sql = "SELECT tbl_info.id, tbl_other.role, tbl_login.email, tbl_login.isBlock, tbl_info.first_name, tbl_info.last_name FROM tbl_login LEFT JOIN tbl_info ON tbl_info.id = tbl_login.userid LEFT JOIN tbl_other ON tbl_other.id = tbl_login.role WHERE tbl_other.role = 'Manager'";
	$all_manager_sql = $conn->query($manager_sql);

	$customer_sql = "SELECT tbl_info.id, tbl_other.role, tbl_login.email, tbl_login.isBlock, tbl_info.first_name, tbl_info.last_name FROM tbl_login LEFT JOIN tbl_info ON tbl_info.id = tbl_login.userid LEFT JOIN tbl_other ON tbl_other.id = tbl_login.role WHERE tbl_other.role = 'Customer'";
	$all_customer_sql = $conn->query($customer_sql);
?>

<div class="row">
	<div class="col-md-4">
		<?php 
			foreach($roles as $key => $role) {	
				echo '
					<script type="text/javascript">
						function logout() {
							var xmlhttp = new XMLHttpRequest();
						    xmlhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									window.location.href = "/PHPRoleManagement/index.php";
								}
						    };
						    xmlhttp.open("POST", "logout.php");
						    xmlhttp.send();
						}

						function get'.$role["role"].'() {
							document.getElementById("home").innerHTML = "";
							if("'.$role["role"].'" == "Manager") {
								$("#manager").css("display","inline");
								$("#customer").css("display","none");
								$("#customer_add").css("display","none");
								$("#manager_add").css("display","inline");
							} else if("'.$role["role"].'" == "Customer") {
								$("#customer").css("display","inline");
								$("#manager").css("display","none");
								$("#manager_add").css("display","none");
								$("#customer_add").css("display","inline");
							}
						}

						function addManager() {
							window.location.href = "/PHPRoleManagement/manager_insert.php"
						}

						function addCustomer() {
							window.location.href = "/PHPRoleManagement/customer_insert.php"
						}
					</script>
					<div class="row mar-all">
						<button type="button" class="btn btn-lg btn-success" onclick="get'.$role["role"].'()" id='.$role["id"].'>'.$role["role"].'</button>
					</div>
				';
			}
		?>
	</div>
	<div class="col-md-5 mar-top">
		<h6 id="home">Welcome Admin</h6>
		<div id="customer_add" class="mar-all" style="display: none;">
			<?php
				if(haspermission('Add Customer')) { ?>
					<button type='button' class="btn btn-success mar-all float-right" onclick="addCustomer();">Add Customer</button>
			<?php }
			?>
		</div>
		<div id="customer" style="display: none;">
			<table border=1 class=table-striped>
				<thead>
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<?php if(haspermission('Block Customer')) { ?>
							<th>Block</th>
						<?php } ?>
						<!-- <th>Action</th> -->
					</tr>
				</thead>
				<tbody>
					<?php
						while($row = $all_customer_sql->fetch_assoc()) {
							if($row > 0) { ?>
								<tr>
									<td><?= $row['id']; ?></td>
									<td><?= $row['first_name']; ?></td>
									<td><?= $row['last_name']; ?></td>
									<td><?= $row['email']; ?></td>
									<?php if(haspermission('Block Customer')) { ?>
									<td><?php
										if($row['isBlock']  == 0) {
											$block = 'Block';
											echo '<a href="block_user.php?id='.$row['id'].'">'.$block.'</a>';
										} else {
											$block = 'UnBlock';
											echo '<a href="unblock_user.php?id='.$row['id'].'">'.$block.'</a>';
										}?>
									</td>
									<?php } ?>
								</tr>
							<?php } else {?>
								<tr>
									<td><?= "No Data Found"; ?></td>
								</tr>
							<?php
							}
						};
					?>
				</tbody>
			</table>
		</div>
		<div id="manager_add" class="mar-all" style="display: none;">
			<?php
				if(haspermission('Add Manager')) { ?>
					<button type='button' class="btn btn-success mar-all float-right" onclick="addManager();">Add Manager</button>
			<?php }
			?>
		</div>
		<div id="manager" style="display: none;">
			<table border=1 class=table-striped>
				<thead>
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<?php if(haspermission('Block Manager')) { ?>
							<th>Block</th>
						<?php } ?>
					</tr>
				</thead>

				<tbody>
					<?php
						while($row = $all_manager_sql->fetch_assoc()) {
							if($row > 0) { ?>
								<tr>
									<td><?= $row['id']; ?></td>
									<td><?= $row['first_name']; ?></td>
									<td><?= $row['last_name']; ?></td>
									<td><?= $row['email']; ?></td>
									<?php if(haspermission('Block Manager')) { ?>
									<td><?php
										if($row['isBlock']  == 0) {
											$block = 'Block';
											echo '<a href="block_user.php?id='.$row['id'].'">'.$block.'</a>';
										} else {
											$block = 'UnBlock';
											echo '<a href="unblock_user.php?id='.$row['id'].'">'.$block.'</a>';
										}?>
									</td>
										
									<?php } ?>
								</tr>
							<?php } else {?>
								<tr>
									<td><?= "No Data Found"; ?></td>
								</tr>
							<?php
							}
						};
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-2">
		<button type='button' class="btn btn-danger mar-all float-right" onclick="logout()">Logout</button>
	</div>
</div>
<?php
	$conn->close();
?>