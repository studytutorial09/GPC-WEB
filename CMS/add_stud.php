<?php
	include "database.php";
	session_start();
	if(!isset($_SESSION["TID"])) {
		echo "<script>window.open('teacher_login.php?mes=Access Denied...','_self');</script>";
	}
?>

<?php include "navbar.php"; ?>
<?php include "sidebar.php"; ?>

<div class="container">
	<div class="row">
		<div >
			<div class="content" style="background:#c1c1c1;">
				<h3 class="text-center my-4">Welcome <?php echo $_SESSION["TNAME"]; ?></h3>
				<hr>
				<div>
					<h3 class="text-center mb-4">Set Exam Time Table Details</h3>
					<?php
						if(isset($_POST["submit"])) {
							$edate = $_POST["dob"];
							$target = "student/";
							$target_file = $target . basename($_FILES["img"]["name"]);
							if(move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
								$sq = "INSERT INTO student (RNO, NAME, FNAME, DOB, GEN, PHO, MAIL, ADDR, SCLASS, BRANCH, SIMG, TID) 
									   VALUES ('{$_POST["rno"]}', '{$_POST["name"]}', '{$_POST["fname"]}', '{$edate}', '{$_POST["gen"]}', 
									           '{$_POST["pho"]}', '{$_POST["email"]}', '{$_POST["addr"]}', '{$_POST["cla"]}', 
									           '{$_POST["branch"]}', '{$target_file}', '{$_SESSION["TID"]}')";
								if($db->query($sq)) {
									echo "<div class='alert alert-success text-center'>Insert Success</div>";
								} else {
									echo "<div class='alert alert-danger text-center'>Insert Failed</div>";
								}
							}
						}
					?>
					<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>">
						<div class="row mb-3">
							<div class="col">
								<label for="rno">ID</label>
								<?php
									$no = "S101";
									$sql = "SELECT * FROM student ORDER BY ID DESC LIMIT 1";
									$res = $db->query($sql);
									if($res->num_rows > 0) {
										$row1 = $res->fetch_assoc();
										$no = substr($row1["RNO"], 1, strlen($row1["RNO"]));
										$no++;
										$no = "S" . $no;
									}
								?>
								<input type="text" id="rno" name="rno" class="form-control" value="<?php echo $no;?>" readonly>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<label for="name">Student Name</label>
								<input type="text" id="name" name="name" class="form-control" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<label for="fname">Father Name</label>
								<input type="text" id="fname" name="fname" class="form-control" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<label for="dob">Date of Birth</label>
								<input type="date" id="dob" name="dob" class="form-control" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<label for="gen">Gender</label>
								<select id="gen" name="gen" class="form-control" required>
									<option value="">Select</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<label for="pho">Phone No</label>
								<input type="text" id="pho" name="pho" class="form-control" maxlength="10" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<label for="email">E-mail Id</label>
								<input type="email" id="email" name="email" class="form-control" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<label for="addr">Address</label>
								<textarea id="addr" name="addr" class="form-control" rows="5" required></textarea>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<label for="cla">Class</label>
								<select id="cla" name="cla" class="form-control" required>
									<option value="">Select</option>
									<?php
										$sl = "SELECT DISTINCT(CNAME) FROM class";
										$r = $db->query($sl);
										if($r->num_rows > 0) {
											while($ro = $r->fetch_assoc()) {
												echo "<option value='{$ro["CNAME"]}'>{$ro["CNAME"]}</option>";
											}
										}
									?>
								</select>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<label for="branch">Branch</label>
								<select id="branch" name="branch" class="form-control" required>
									<option value="">Select</option>
									<?php
										$sl = "SELECT DISTINCT(BRANCH) FROM class";
										$r = $db->query($sl);
										if($r->num_rows > 0) {
											while($ro = $r->fetch_assoc()) {
												echo "<option value='{$ro["BRANCH"]}'>{$ro["BRANCH"]}</option>";
											}
										}
									?>
								</select>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<label for="img">Image</label>
								<input type="file" id="img" name="img" class="form-control" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col text-end">
								<button type="submit" class="btn btn-primary" name="submit">Add Student Details</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script src="js/jquery.js"></script>
<script>
	$(document).ready(function(){
		$(".alert").fadeTo(1000, 100).slideUp(1000, function(){
			$(".alert").slideUp(1000);
		});
	});
</script>

</body>
</html>
