<?php
	include('dbconn2.php');

	if(isset($_POST['loaddepartments'])) {
		$data = '<option value="" selected="selected">Select Department..</option>';
		$query = "SELECT DISTINCT dept FROM attendance";
		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)) {
				$data .= '<option value="'.$row['dept'].'">'.$row['dept'].'</option>';
			}
		}

		echo $data;
	}

	if(isset($_POST['department'])) {
		$department = $_POST['department'];
		$query = "SELECT * FROM attendance WHERE dept = '$department'";
		$result = mysqli_query($conn, $query);
		$output = '';

		if(mysqli_num_rows($result) > 0) {
			$output .= '<table class="table table-bordered table-striped text-center">
							<thead class="bg-warning text-white">
								<tr>
									<th>Staff Name</th>
									<th>Department</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>';

			while($row = mysqli_fetch_assoc($result)) {
				$output .= '<tr>
								<td>'.$row['staff_name'].'</td>
								<td>'.$row['dept'].'</td>
								<td>'.$row['date'].'</td>
							</tr>';
			}

			$output .= '</tbody></table>';
		} else {
			$output .= '<p>No attendance records found for the selected department.</p>';
		}

		echo $output;
	}
?>
