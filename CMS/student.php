<?php
	include "database.php";
	session_start();
	if(!isset($_SESSION["AID"])) {
		echo "<script>window.open('index.php?mes=Access Denied...', '_self');</script>";
	}
?>

<?php include "navbar.php"; ?>
<?php include "sidebar.php"; ?>

<div class="content">
	<div >
		<h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3>
		<hr>
		<div >
			<h3>View Student Details</h3><br>
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
				<div class="lbox1">
					<label>YEAR</label><br>
					<select name="cla" required class="form-select">
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
					<br><br>
				</div>
				<div class="rbox">
					<label>Branch</label><br>
					<select name="sec" required class="form-select">
						<option value="">Select</option>
						<?php 
							$sql = "SELECT DISTINCT(BRANCH) FROM class";
							$re = $db->query($sql);
							if($re->num_rows > 0) {
								while($r = $re->fetch_assoc()) {
									echo "<option value='{$r["BRANCH"]}'>{$r["BRANCH"]}</option>";
								}
							}
						?>
					</select><br><br>
				</div>
				<button type="submit" class="btn btn-primary" name="view"> View Details</button>
			</form>
			<br>
			<div class="Output">
				<?php
					if(isset($_POST["view"])) {
						echo "<h3>Student Details</h3><br>";
						$sql = "SELECT * FROM student WHERE SCLASS='{$_POST["cla"]}' AND BRANCH='{$_POST["sec"]}'";
						$re = $db->query($sql);
						if($re->num_rows > 0) {
							echo '<table class="table table-bordered table-hover">
									<thead class="table-dark">
										<tr>
											<th>S.No</th>
											<th>Roll No</th>
											<th>Name</th>
											<th>Father Name</th>
											<th>DOB</th>
											<th>Gender</th>
											<th>Phone</th>
											<th>Mail</th>
											<th>Address</th>
											<th>Class</th>
											<th>Branch</th>
											<th>Image</th>
										</tr>
									</thead>
									<tbody>';
							$i = 0;
							while($r = $re->fetch_assoc()) {
								$i++;
								echo "<tr>
										<td>{$i}</td>
										<td>{$r["RNO"]}</td>
										<td>{$r["NAME"]}</td>
										<td>{$r["FNAME"]}</td>
										<td>{$r["DOB"]}</td>
										<td>{$r["GEN"]}</td>
										<td>{$r["PHO"]}</td>
										<td>{$r["MAIL"]}</td>
										<td>{$r["ADDR"]}</td>
										<td>{$r["SCLASS"]}</td>
										<td>{$r["BRANCH"]}</td>
										<td><img src='{$r["SIMG"]}' class='img-fluid' alt='Student Image'></td>
									</tr>";
							}
							echo "</tbody></table>";
						} else {
							echo "No record Found";
						}
					}
				?>
			</div>
		</div>
	</div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
