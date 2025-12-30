<?php
	include "database.php";
	session_start();
	if(!isset($_SESSION["AID"])) {
		echo "<script>window.open('index.php?mes=Access Denied...', '_self');</script>";
	}
?>

<?php include "navbar.php"; ?><br>
<?php include "sidebar.php"; ?>
<div class="content">
	<div >
		<h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3>
		<hr><br>
		<div>
			<h3>Set Test Time Table Details</h3><br>
			<?php
				if(isset($_POST["submit"])) {
					$edate = $_POST["da"];
					$sq = "INSERT INTO exam (ENAME, ETYPE, EDATE, BRANCH, CLASS, SUB) 
					       VALUES ('{$_POST["ename"]}', '{$_POST["etype"]}', '{$edate}', '{$_POST["branch"]}', '{$_POST["cla"]}', '{$_POST["sub"]}')";
					if($db->query($sq)) {
						echo "<div class='alert alert-success'>Insert Success</div>";
					} else {
						echo "<div class='alert alert-danger'>Insert Failed</div>";
					}
				}
			?>
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
				<div class="row">
					<div class="col-md-6 mb-3">
						<label for="ename" class="form-label">Test</label>
						<input type="text" class="form-control" id="ename" name="ename" required>
					</div>
					<div class="col-md-6 mb-3">
						<label for="etype" class="form-label">Select Term</label>
						<select id="etype" name="etype" class="form-select" required>
							<option value="">Select</option>
							<option value="I-Term">I-Term</option>
							<option value="II-Term">II-Term</option>
							<option value="III-Term">III-Term</option>
						</select>
					</div>
					
					<div class="col-md-6 mb-3">
						<label for="cla" class="form-label">Class</label>
						<select id="cla" name="cla" class="form-select" required>
							<?php
								$sl = "SELECT DISTINCT(CNAME) FROM class";
								$r = $db->query($sl);
								if($r->num_rows > 0) {
									echo "<option value=''>Select</option>";
									while($ro = $r->fetch_assoc()) {
										echo "<option value='{$ro["CNAME"]}'>{$ro["CNAME"]}</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="col-md-6 mb-3">
						<label for="branch" class="form-label">Branch</label>
						<select id="branch" name="branch" class="form-select" required>
							<?php
								$sl = "SELECT DISTINCT(BRANCH) FROM class";
								$r = $db->query($sl);
								if($r->num_rows > 0) {
									echo "<option value=''>Select</option>";
									while($ro = $r->fetch_assoc()) {
										echo "<option value='{$ro["BRANCH"]}'>{$ro["BRANCH"]}</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="col-md-6 mb-3">
						<label for="sub" class="form-label">Subject</label>
						<select id="sub" name="sub" class="form-select" required>
							<?php
								$s = "SELECT * FROM sub";
								$re = $db->query($s);
								if($re->num_rows > 0) {
									echo "<option value=''>Select</option>";
									while($r = $re->fetch_assoc()) {
										echo "<option value='{$r["SNAME"]}'>{$r["SNAME"]}</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="col-md-6 mb-3">
						<label for="da" class="form-label">Test Date</label>
						<input type="date" class="form-control" id="da" name="da" required>
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="submit">Add Test Details</button>
			</form>
		</div>
	</div>
</div>
<style>
    .content {
        padding-bottom: 100px; 
		background:#C1C1C1;
    }
</style>
<?php include "footer.php"; ?>
</body>
</html>
