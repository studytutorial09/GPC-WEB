<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
		
	}	
?>

<?php include"navbar.php";?>
<?php include"sidebar.php";?>
	<div class="content">
		<div class="content">
			<h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3><br><hr><br>
			<h3 > College Information</h3><br>
			
		</div>
		
<div class="footer">
			<footer><p>Copyright &copy; GPC ITARSI </p></footer>
</div>
		<script src="js/jquery.js"></script>
		 <script>
		$(document).ready(function(){
			$(".error").fadeTo(1000, 100).slideUp(1000, function(){
					$(".error").slideUp(1000);
			});
			
			
		});
	</script>
	</body>
</html>