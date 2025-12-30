<?php
	include "database.php";
	session_start();
?>

<?php include "navbar.php"; ?>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
	<div class="card" style="width: 25rem; background: #C1C1C1;">
		<div class="card-body">
			<h1 class="card-title text-center mb-4">Admin Login</h1>
			<div class="log">
				<?php
					if(isset($_POST["login"])) {
						$sql = "SELECT * FROM admin WHERE ANAME='{$_POST["aname"]}' AND APASS='{$_POST["apass"]}'";
						$res = $db->query($sql);
						if($res->num_rows > 0) {
							$ro = $res->fetch_assoc();
							$_SESSION["AID"] = $ro["AID"];
							$_SESSION["ANAME"] = $ro["ANAME"];
							echo "<script>window.open('dashboard.php','_self');</script>";
						} else {
							echo "<div class='alert alert-danger text-center'>Invalid Username or Password</div>";
						}
					}
					if(isset($_GET["mes"])) {
						echo "<div class='alert alert-danger text-center'>{$_GET["mes"]}</div>";
					}
				?>

				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<div class="mb-3">
						<label for="aname" class="form-label">User Name</label>
						<input type="text" id="aname" name="aname" required class="form-control">
					</div>
					<div class="mb-3">
						<label for="apass" class="form-label">Password</label>
						<input type="password" id="apass" name="apass" required class="form-control">
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
