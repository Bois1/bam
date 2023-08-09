<?php

	namespace fingerprint;

	include('dbconn2.php');
	$devid = $_POST["devid"];
	$nid = '';
	$fullname = '';
	$age = '';
	$address = '';
	$mobile = '';
	$dept = '';
	$email= '';
	$error_nid = '';
	$error_fullname = '';
	$error_age = '';
	$error_address = '';
	$error_mobile = '';
	$error_dept = '';
	$error = 0;

	if(isset($_POST['loaddept'])) {
		$data = '<option value="" selected="selected">Select from dept..</option>';
		$query = "SELECT dept FROM dept_list";
		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$data .= '<option value="'.$row['dept'].'">'.$row['dept'].'</option>';
			}
		}

		echo $data;
	}

	if(empty($_POST["fullname"])) {
		$error_fullname = 'Full name is required!';
		$error++;
	}
	else {
		$fullname = $_POST["fullname"];
	}
	if(empty($_POST["age"])) {
		$error_age = 'Age is required!';
		$error++;
	}
	else {
		if($_POST["age"] < 18) {
			$error_age = 'Age must be greater than or equal to 18!';
			$error++;
		}
		else {
			$age = $_POST["age"];
		}
	}
	if(empty($_POST["address"])) {
		$error_address = 'Address is required!';
		$error++;
	}
	else {
		$address = $_POST["address"];
	}
	if(empty($_POST["dept"])) {
		$error_dept = 'Department is required!';
		$error++;
	}
	else {
		$dept = $_POST["dept"];
	}
	if(empty($_POST["email"])) {
		$error_dept = 'Email is required!';
		$error++;
	}
	else {
		$email = $_POST["email"];
	}
	if(empty($_POST["nid"])) {
		$error_nid = 'NID no. is required!';
		$error++;
	}
	else {
		$nid = $_POST["nid"];
		$query = "SELECT * FROM users WHERE nid = '$nid'";
		$result = mysqli_query($conn, $query);
		
		if(mysqli_num_rows($result) > 0) {
			$error_nid = "NID no. already exists!!";
			$error++;
		}
	}
	if(empty($_POST["mobile"])) {
		$error_mobile = 'Mobile no. is required!';
		$error++;
	}
	else {
		$mobile = $_POST["mobile"];
		$query = "SELECT * FROM users WHERE mobile = '$mobile'";
		$result = mysqli_query($conn, $query);
		
		if(mysqli_num_rows($result) > 0) {
			$error_mobile = "Mobile no. already exists!!";
			$error++;
		}
	}
	
	if($error == 0) {
		$query = "INSERT INTO users (devid, nid, name, age, address, mobile, dept,email) VALUES ('$devid', '$nid', '$fullname', '$age', '$address', '$mobile', '$dept','$email')";
		mysqli_query($conn, $query);
	}
	if($error > 0) {
		$output = array(
			'error'				=>	true,
			'error_nid'			=>	$error_nid,
			'error_fullname'	=>	$error_fullname,
			'error_age'			=>	$error_age,
			'error_address'		=>	$error_address,
			'error_mobile'		=>	$error_mobile,
			'error_dept'	=>	$error_dept,
			'error_email'	=>	$error_email
		);
	}
	else {
		$output = array(
			'success'			=>	true
		);	
	}

	echo json_encode($output);
?>