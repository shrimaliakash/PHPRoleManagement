<?php
	function haspermission($string) {
		include('config/db.php');
		$sql_role = "SELECT permission FROM tbl_other WHERE id='".$_SESSION['role']."'";
		$result_login_query = $conn->query($sql_role);
		$result_role = $result_login_query->fetch_assoc();
		if(!empty($result_role['permission'])) {
			$permissions  = $result_role['permission'];
			if(strstr($permissions, $string)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
?>