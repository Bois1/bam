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
	<title>All Staff - BAS</title>
	<link rel="icon" href="images/logo.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/custom.css">
	<script src="./js/jquery-3.5.0.min.js"></script>
	<script src="./js/bootstrap.bundle.js"></script>
	<script src="./js/es6-shim.js"></script>
	<script src="./js/websdk.client.bundle.min.js"></script>
	<script src="./js/fingerprint.sdk.min.js"></script>
	<script src="./js/custom.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
	<style type="text/css">
		body {
			font-family: 'Ubuntu', sans-serif;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="row" style="margin-top: 10px">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body bg-light text-danger">
						<p style="text-align: center; margin-bottom: 0px; font-weight: bold">
							Device(s) must be turned on while deleting fingerprints!!
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-12" style="margin-top: 10px">
				<div class="card">
					<div class="card-body bg-light text-dark">
						<div class="form-group">
							<label style="font-weight: bold">Select Department To View</label>
							<select type="text" name="voterarea" id="voterarea" class="form-control"></select>
							<span id="error_voterarea" class="text-danger"></span>
						</div>
						<div class="text-center" style="margin-top: 20px; margin-bottom: 0px">
							<button style="font-weight: bold; font-size: 15px" class="btn btn-sm btn-warning" onClick="loadVoters()">Show All Staff</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="voter_records"></div>
		<div class="modal" id="updateModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Edit A Staff</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Staff Name:</label>
							<input type="text" name="newname" id="newname" class="form-control" placeholder="Enter Staff Name..">
						</div>
						<div class="form-group">
							<label>Age:</label>
							<input type="text" name="newage" id="newage" class="form-control" placeholder="Enter Age..">
						</div>
						<div class="form-group">
							<label>Address:</label>
							<input type="text" name="newaddress" id="newaddress" class="form-control" placeholder="Enter Address..">
						</div>
						<div class="form-group">
							<label>Mobile No.:</label>
							<input type="text" name="newmobile" id="newmobile" class="form-control" placeholder="Enter Mobile Number..">
						</div>
						<div class="form-group">
							<label>Department</label>
							<select type="text" name="newvoterarea" id="newvoterarea" class="form-control"></select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal" onclick="updateVoterDetails()">Update</button>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
						<input type="hidden" id="hidden_voter_id">
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			loadVoterArea();
		});

		function loadVoters() {
			var loadvoters = "loadvoters";
			var voterarea = $('#voterarea').val();

			$.ajax({
				url: "voters_backend.php",
				type: "POST",
				data: {
					loadvoters: loadvoters,
					voterarea: voterarea
				},

				success: function(data) {
					$('#voter_records').html(data);
				}
			});
		}

		function loadVoterArea() {
			var loadvoterarea = "loadvoterarea";

			$.ajax({
				url: "candidates_backend.php",
				type: "POST",
				data: {
					loadvoterarea: loadvoterarea
				},

				success: function(data) {
					$('#voterarea').html(data);
					$('#newvoterarea').html(data);
				}
			});
		}

		function getVoterDetails(id) {
			$("#hidden_voter_id").val(id);

			$.post("voters_backend.php", {
					id: id
				},

				function(data) {
					var user = JSON.parse(data);
					$("#newname").val(user.name);
					$("#newage").val(user.age);
					$("#newaddress").val(user.address);
					$("#newmobile").val(user.mobile);
					$("#newvoterarea").val(user.dept);
				}
			);

			$("#updateModal").modal("show");
		}

		function updateVoterDetails() {
			var newname = $("#newname").val();
			var newage = $("#newage").val();
			var newaddress = $("#newaddress").val();
			var newmobile = $("#newmobile").val();
			var newvoterarea = $("#newvoterarea").val();
			var hidden_voter_id = $("#hidden_voter_id").val();

			$.post("voters_backend.php", {
					hidden_voter_id: hidden_voter_id,
					newname: newname,
					newage: newage,
					newaddress: newaddress,
					newmobile: newmobile,
					newvoterarea: newvoterarea
				},

				function(data) {
					$("#updateModal").modal("hide");
					loadVoters();
				}
			);
		}

		function deleteVoter(deleteid) {
			var set_mode = '3';
			var conf = confirm("Are you sure you want to delete this staff and associated fingerprint?");

			if (conf == true) {
				$('#verifyIdentity').modal("show");

				$.ajax({
					url: "voters_backend.php",
					type: 'POST',
					data: {
						deleteid: deleteid
					}
				});

				$.ajax({
					url: 'set_mode.php',
					type: 'POST',
					data: {
						set_mode: set_mode
					}
				});

				setInterval(function() {
					$('#status_area').load('get_msg.php', function(response) {
						if (response == "Deleted from device..") {
							$('#status_area').val("Deleted from device..");
							alert("Staff and associated fingerprint deleted successfully..");
							$('#deleteFingerprint').modal("hide");
							loadVoters();
						}
					});
				}, 100);
			}
		}
	</script>
</body>

<section>
	<div id="verifyIdentity" class="modal fade" data-backdrop="static" tabindex="-1" aria-labelledby="verifyIdentityTitle" aria-hidden="true">
		<!-- Verification section code here -->
	</div>
</section>

<section>
	<div class="modal fade" id="createEnrollment" data-backdrop="static" tabindex="-1" aria-labelledby="createEnrollmentTitle" aria-hidden="true">
		<!-- Enrollment section code here -->
	</div>
</section>

</html>
