<?php
	include "database.php";
	session_start();
?>

<?php include "navbar.php"; ?>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
	<div class="card" style="width: 25rem; background: #C1C1C1;">
		<div class="card-body">
			<h1 class="card-title text-center mb-4">Teacher's Login</h1>
			<div >
				<?php
					if(isset($_POST["login"])) {
						$sql = "SELECT * FROM staff WHERE TNAME='{$_POST["name"]}' AND TPASS='{$_POST["pass"]}'";
						$res = $db->query($sql);
						if($res->num_rows > 0) {
							$ro = $res->fetch_assoc();
							$_SESSION["TID"] = $ro["TID"];
							$_SESSION["TNAME"] = $ro["TNAME"];
							echo "<script>window.open('teacher_home.php','_self');</script>";
						} else {
							echo "<div class='alert alert-danger text-center'>Invalid Username Or Password</div>";
						}
					}
				?>

				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<div class="mb-3">
						<label for="name" class="form-label">User Name</label>
						<input type="text" id="name" name="name" required class="form-control">
					</div>
					<div class="mb-3">
						<label for="pass" class="form-label">Password</label>
						<input type="password" id="pass" name="pass" required class="form-control">
					</div>
					<button type="submit" class="btn btn-primary w-100" name="login">Login Here</button>
				</form>
			</div>
		</div>
	</div>
</div>

<footer class="footer mt-5">
	<div class="text-center">
		<p>&copy; GPC ITARSI</p>
	</div>
</footer>

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
