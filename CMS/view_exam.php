<?php
	include "database.php";
	session_start();
	if(!isset($_SESSION["AID"])) {
		echo "<script>window.open('index.php?mes=Access Denied...', '_self');</script>";
	}
?>


<?php include "navbar.php"; ?>
<?php include "sidebar.php"; ?>
<div class="container ">
	<div class="content">
		<h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3>
		<hr><br>
		<div>
			<h3>View Exam Time Table Details</h3><br>
			<?php
				if(isset($_GET["mes"])) {
					echo "<div class='alert alert-danger'>{$_GET["mes"]}</div>";
				}
			?>
			
			<form class="row g-3" method="get" action="">
				<div class="col-md-6">
					<label for="year" class="form-label">Select Year</label>
					<select id="year" name="year" class="form-select">
						<option value="">Select Year</option>
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
				<div class="col-md-6">
					<label for="branch" class="form-label">Select Branch</label>
					<select id="branch" name="branch" class="form-select">
						<option value="">Select Branch</option>
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
				<div class="col-12">
					<button type="submit" class="btn btn-primary">Filter</button>
				</div>
			</form>
			<br>
			
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Date</th>
						<th>Subject</th>
						<th>Term</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$year = isset($_GET['year']) ? $_GET['year'] : '';
						$branch = isset($_GET['branch']) ? $_GET['branch'] : '';

						$s = "SELECT * FROM exam WHERE 1=1";
						if($year != '') {
							$s .= " AND CLASS='$year'";
						}
						if($branch != '') {
							$s .= " AND BRANCH='$branch'";
						}
						$res = $db->query($s);
						if($res->num_rows > 0) {
							$i = 0;
							while($r = $res->fetch_assoc()) {
								$i++;
								echo "
									<tr>
										<td>{$i}</td>
										<td>{$r["EDATE"]}</td>
										<td>{$r["SUB"]}</td>
										<td>{$r["ETYPE"]}</td>
										<td><a href='exam_delete.php?id={$r["EID"]}' class='btn btn-danger btn-sm'>Delete</a></td>
									</tr>
								";
							}
						} else {
							echo "<tr><td colspan='8' class='text-center'>No Record Found</td></tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
