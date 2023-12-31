<?php
	namespace fingerprint;
	include('dbconn2.php');
	
	if(isset($_POST['loadvoterarea'])) {
		$data = '<option value="" selected="selected">Select Department</option>';
		$query = "SELECT dept_name FROM dept_list";
		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)) {
				$data .= '<option value="'.$row['dept_name'].'">'.$row['dept_name'].'</option>';
			}
		}

		echo $data;
	}

	if(isset($_POST['loadvoters'])) {
		$voterarea = $_POST['voterarea'];
		$data = '<table style="margin-top: 10px" class="table table-bordered table-striped text-center">
					<tr class="bg-warning text-white">
						<th>SN.</th>
						<th>Name</th>
						<th>Age</th>
						<th>Address</th>
						<th>Mobile</th>
						<th>Department</th>
						<th>Action(s)</th>
					</tr>';
		$query = "SELECT * FROM `staff` WHERE dept = '$voterarea'"; 
		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result) > 0) {
			$serial = 1;
			
			while($row = mysqli_fetch_array($result)) {
				$data .= '<tr class="bg-light text-dark">
							<td>'.$serial.'</td>
							<td>'.$row['name'].'</td>
							<td>'.$row['age'].'</td>
							<td>'.$row['address'].'</td>
							<td>'.$row['mobile'].'</td>
							<td>'.$row['dept'].'</td>
							<td>
								<button style="font-weight: bold" onclick="getVoterDetails('.$row['id'].')" class="btn btn-warning btn-sm">Edit</button>
								<button style="font-weight: bold" onclick="deleteVoter('.$row['id'].')" class="btn btn-danger btn-sm">Delete</button>
							</td>
    					</tr>';
    			$serial++;
			}
		}

		$data .= '</table>';
    	echo $data;
	}

	if(isset($_POST['deleteid'])) {
		$id = $_POST['deleteid'];
		$query = "DELETE FROM staff WHERE id = '$id'";
		mysqli_query($conn, $query);
	}
	
	if(isset($_POST['id']) && isset($_POST['id']) != "") {
    	$id = $_POST['id'];
    	$query = "SELECT * FROM staff WHERE id = '$id'";
    	
    	if(!$result = mysqli_query($conn, $query)) {
        	exit(mysqli_error());
    	}
    	
    	$response = array();
    	
    	if(mysqli_num_rows($result) > 0) {
    		while($row = mysqli_fetch_array($result)) {
            	$response = $row;
        	}
    	}
    	else {
        	$response['status'] = 200;
        	$response['message'] = "Data not found!";
    	}

    	echo json_encode($response);
	}
	else {
    	$response['status'] = 200;
    	$response['message'] = "Invalid request!";
	}

	if(isset($_POST['hidden_voter_id'])) {
		$hidden_voter_id = $_POST['hidden_voter_id'];
		$newnid = $_POST['newnid'];
		$newname = $_POST['newname'];
		$newage = $_POST['newage'];
		$newaddress = $_POST['newaddress'];
		$newmobile = $_POST['newmobile'];
		$newvoterarea = $_POST['newvoterarea'];

    	$query = "UPDATE staff SET  name = '$newname', age = '$newage', address = '$newaddress', mobile = '$newmobile', dept = '$newvoterarea' WHERE id = '$hidden_voter_id'";

    	if(!$result = mysqli_query($conn, $query)) {
    		exit(mysqli_error());
    	}
    }
?>
