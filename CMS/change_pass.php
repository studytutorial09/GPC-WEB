<?php
	include "database.php";
	session_start();
	if(!isset($_SESSION["AID"])) {
		echo "<script>window.open('index.php?mes=Access Denied...', '_self');</script>";
	}
?>

<?php include "navbar.php"; ?>
<?php include "sidebar.php"; ?>

<div class="container">
	<div class="content">
		<h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3>
		<hr>
		<div class="content1">
			<h3>Change Password</h3><br>
			<?php
				if(isset($_POST["submit"])) {
					$sql = "SELECT * FROM admin WHERE APASS='{$_POST["opass"]}' AND AID='{$_SESSION["AID"]}'";
					$result = $db->query($sql);
					if($result->num_rows > 0) {
						if($_POST["npass"] == $_POST["cpass"]) {
							$s = "UPDATE admin SET APASS='{$_POST["npass"]}' WHERE AID='{$_SESSION["AID"]}'";
							$db->query($s);
							echo "<div class='alert alert-success'>Password Changed</div>";
						} else {
							echo "<div class='alert alert-danger'>Password Mismatch</div>";
						}
					} else {
						echo "<div class='alert alert-danger'>Invalid Password</div>";
					}
				}
			?>
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
				<label for="opass" class="visually-hidden">Old Password</label>
				<input type="password" id="opass" class="form-control mb-2" placeholder="Old Password" name="opass" required>
				<label for="npass" class="visually-hidden">New Password</label>
				<input type="password" id="npass" class="form-control mb-2" placeholder="New Password" name="npass" required>
				<label for="cpass" class="visually-hidden">Confirm Password</label>
				<input type="password" id="cpass" class="form-control mb-2" placeholder="Confirm Password" name="cpass" required>
				<button type="submit" class="btn btn-primary" name="submit">Change Password</button>
			</form>
		</div>
	</div>
</div>

<?php include "footer.php"; ?>

</body>
</html>
