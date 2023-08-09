<!DOCTYPE html>
<html>

<head>
	<title>User Login - BAS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/custom.css">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">

	<script src="./js/jquery-3.5.0.min.js"></script>
	<script src="./js/bootstrap.bundle.js"></script>
	<script src="./js/es6-shim.js"></script>
	<script src="./js/websdk.client.bundle.min.js"></script>
	<script src="./js/fingerprint.sdk.min.js"></script>
	<script src="./js/custom.js"></script>
	<style type="text/css">
		body {
			font-family: 'Ubuntu', sans-serif;
		}
	</style>
</head>

<body>
	<div class="jumbotron-small text-center" style="margin-top: 20px; margin-bottom: 20px">
		<h2 class="text-success">Biometric Attendance System</h2>
	</div>
	<div class="container" style="margin-top: 50px">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<!-- <button type="button" class="btn btn-success  btn-sm" style="margin-top: 10px; margin-bottom: 50px; font-weight: bold" onClick="window.location.href='adminLogin.php'">Admin Login</button> -->
			</div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header bg-success text-white font-weight-bold" style="text-align: center; font-size: 20px">Hi User</div>
					<div class="card-body bg-light">
						<div id="controls" class="form-group col text-center" style="margin-top: 20px; margin-bottom: 0px">
							<!-- <input style="font-weight: bold; font-size: 15px" name="verify_fingerprint" id="verifyIdentityButton" class="btn btn-sm btn-warning" onClick="verifyFingerprint()" value="Verify Fingerprint" /> -->
							<!-- <button id="verifyIdentityButton" type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#verifyIdentity" onclick="beginIdentification()">Verify Fingerprint</button> -->
							<div class="col-sm mb-2 mr-sm-5">
								<button id="verifyIdentityButton" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#verifyIdentity" onclick="beginIdentification()">Validate Fingerprint</button>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>

</body>

<section>
	<!--Create Enrolment Section-->
	<div class="modal fade" id="createEnrollment" data-backdrop="static" tabindex="-1" aria-labelledby="createEnrollmentTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title my-text my-pri-color" id="createEnrollmentTitle">Create Enrollment</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearCapture()">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" onsubmit="return false">
						<div id="enrollmentStatusField" class="text-center">
							<!--Enrollment Status will be displayed Here-->
						</div>
						<div class="form-row mt-3">
							<div class="col mb-3 mb-md-0 text-center">
								<label for="enrollReaderSelect" class="my-text7 my-pri-color">Choose Fingerprint Reader</label>
								<select name="readerSelect" id="enrollReaderSelect" class="form-control" onclick="beginEnrollment()">
									<option selected>Select Fingerprint Reader</option>
								</select>
							</div>
						</div>
						<div class="form-row mt-2">
							<div class="col mb-3 mb-md-0 text-center">
								<label for="userID" class="my-text7 my-pri-color">Enter a UserID</label>
								<input id="userID" type="text" class="form-control" required>
							</div>
						</div>
						<div class="form-row mt-1">
							<div class="col text-center">
								<p class="my-text7 my-pri-color mt-3">Capture Index Finger</p>
							</div>
						</div>
						<div id="indexFingers" class="form-row justify-content-center">
							<div id="indexfinger1" class="col mb-3 mb-md-0 text-center">
								<span class="icon icon-indexfinger-not-enrolled" title="not_enrolled"></span>
							</div>
							<div id="indexfinger2" class="col mb-3 mb-md-0 text-center">
								<span class="icon icon-indexfinger-not-enrolled" title="not_enrolled"></span>
							</div>
							<div id="indexfinger3" class="col mb-3 mb-md-0 text-center">
								<span class="icon icon-indexfinger-not-enrolled" title="not_enrolled"></span>
							</div>
							<div id="indexfinger4" class="col mb-3 mb-md-0 text-center">
								<span class="icon icon-indexfinger-not-enrolled" title="not_enrolled"></span>
							</div>
						</div>
						<div class="form-row mt-1">
							<div class="col text-center">
								<p class="my-text7 my-pri-color mt-5">Capture Middle Finger</p>
							</div>
						</div>
						<div id="middleFingers" class="form-row justify-content-center">
							<div id="middleFinger1" class="col mb-3 mb-md-0 text-center">
								<span class="icon icon-middlefinger-not-enrolled" title="not_enrolled"></span>
							</div>
							<div id="middleFinger2" class="col mb-3 mb-md-0 text-center">
								<span class="icon icon-middlefinger-not-enrolled" title="not_enrolled"></span>
							</div>
							<div id="middleFinger3" class="col mb-3 mb-md-0 text-center">
								<span class="icon icon-middlefinger-not-enrolled" title="not_enrolled"></span>
							</div>
							<div id="middleFinger4" class="col mb-3 mb-md-0 text-center" value="true">
								<span class="icon icon-middlefinger-not-enrolled" title="not_enrolled"></span>
							</div>
						</div>
						<div class="form-row m-3 mt-md-5 justify-content-center">
							<div class="col-4">
								<button class="btn btn-primary btn-block my-sec-bg my-text-button py-1" type="submit" onclick="beginCapture()">Start Capture</button>
							</div>
							<div class="col-4">
								<button class="btn btn-primary btn-block my-sec-bg my-text-button py-1" type="submit" onclick="serverEnroll()">Enroll</button>
							</div>
							<div class="col-4">
								<button class="btn btn-secondary btn-outline-warning btn-block my-text-button py-1 border-0" type="button" onclick="clearCapture()">Clear</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<div class="form-row">
						<div class="col">
							<button class="btn btn-secondary my-text8 btn-outline-danger border-0" type="button" data-dismiss="modal" onclick="clearCapture()">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<!--Verify Identity Section-->
	<div id="verifyIdentity" class="modal fade" data-backdrop="static" tabindex="-1" aria-labelledby="verifyIdentityTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title my-text my-pri-color" id="verifyIdentityTitle">Verify your Identity</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearCapture()">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" onsubmit="return false">
						<div id="verifyIdentityStatusField" class="text-center">
							<!--verifyIdentity Status will be displayed Here-->
						</div>
						<div class="form-row mt-3">
							<div class="col mb-3 mb-md-0 text-center">
								<label for="verifyReaderSelect" class="my-text7 my-pri-color">Choose Fingerprint Reader</label>
								<select name="readerSelect" id="verifyReaderSelect" class="form-control" onclick="beginIdentification()">
									<option selected>Select Fingerprint Reader</option>
								</select>
							</div>
						</div>
						<div class="form-row mt-4">
							<div class="col mb-md-0 text-center">
								<label for="userIDVerify" class="my-text7 my-pri-color m-0">Specify UserID</label>
								<input type="text" id="userIDVerify" class="form-control mt-1" required>
							</div>
						</div>
						<div class="form-row mt-3">
							<div class="col text-center">
								<p class="my-text7 my-pri-color mt-1">Capture Verification Finger</p>
							</div>
						</div>
						<div class="form-row justify-content-center space-between">
							<div id="verificationFingers">
								<div id="verificationFinger" class="col mb-md-0 text-center">
									<span class="icon icon-indexfinger-not-enrolled" title="not_enrolled"></span>
								</div>
							</div>
							<div id="middleVerificationFingers">
								<div id="middleVerificationFinger" class="col mb-3 mb-md-0 text-center">
									<span class="icon icon-middlefinger-not-enrolled" title="not_enrolled"></span>
								</div>
							</div>
						</div>

						<div class="form-row mt-3" id="userDetails">
							<!--this is where user details will be displayed-->
						</div>
						<div class="form-row m-3 mt-md-5 justify-content-center">
							<div class="col-4">
								<button class="btn btn-primary btn-block my-sec-bg my-text-button py-1" type="submit" onclick="captureForIdentify()">Start Capture</button>
							</div>
							<div class="col-4">
								<button class="btn btn-primary btn-block my-sec-bg my-text-button py-1" type="submit" onclick="serverIdentify()">Identify</button>
							</div>
							<div class="col-4">
								<button class="btn btn-secondary btn-outline-warning btn-block my-text-button py-1 border-0" type="button" onclick="clearCapture()">Clear</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<div class="form-row">
						<div class="col">
							<button class="btn btn-secondary my-text8 btn-outline-danger border-0" type="button" data-dismiss="modal" onclick="clearCapture()">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

</html>