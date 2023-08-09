<?php
include('header.php');
include('dbconn2.php');
session_start();

if (!isset($_SESSION['username'])) {
	header('location: adminLogin.php');
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Attendance Results</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/custom.css">
	<script src="js/jquery-3.5.0.min.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
	<style type="text/css">
		body {
			font-family: 'Ubuntu', sans-serif;
		}
	</style>
</head>

<body>
	<div class="container" style="margin-top: 50px">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="card">
					<div class="card-header bg-warning text-white font-weight-bold" style="text-align: center; font-size: 20px">Attendance Results</div>
					<div class="card-body bg-light">
						<div class="form-group">
							<label style="font-weight: bold">Filter by Department</label>
							<select type="text" name="department" id="department" class="form-control"></select>
							<span id="error_department" class="text-danger"></span>
						</div>
						<div class="text-center" style="margin-top: 20px; margin-bottom: 0px">
							<button style="font-weight: bold; font-size: 15px" class="btn btn-sm btn-warning" onClick="showFilteredResults()">Show Results</button>
						</div>
						<div style="margin-top: 50px" id="attendance_result"></div>
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>

</html>
<script>
	$(document).ready(function() {
		loadDepartments();
	});

	function loadDepartments() {
		var loaddepartments = "loaddepartments";

		$.ajax({
			url: "attendance_results_backend.php",
			type: "POST",
			data: {
				loaddepartments: loaddepartments
			},

			success: function(data) {
				$('#department').html(data);
			}
		});
	}

	function showFilteredResults() {
		var department = $('#department').val();

		$.ajax({
			url: "attendance_results_backend.php",
			method: "POST",
			data: {
				department: department
			},

			success: function(data) {
				$('#attendance_result').html(data);
			}
		});
	}
</script>
