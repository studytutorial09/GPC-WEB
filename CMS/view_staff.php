<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
		
	}	
?>
<?php include "navbar.php"; ?>
<?php include "sidebar.php"; ?>
<div class="container-fluid">
    <div class="content">
        <h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3>
        <hr>
        <br>
        <div>
            <h3>View Staff Details</h3><br>
            <form id="frm" autocomplete="off" class="mb-4">
                <input type="text" id="txt" class="form-control" placeholder="Search staff details">
            </form>
            <div id="box" class="row ">
                <!-- Staff details will be loaded here -->
            </div>
        </div>  
    </div>
</div>
<?php include "footer.php"; ?>

<script>
    $(document).ready(function(){
        $("#txt").keyup(function(){
            var txt = $("#txt").val();
            if (txt != "") {
                $.post("search.php", {s: txt}, function(data){
                    $("#box").html(data);
                });
            } else {
                $("#box").html("");
            }
        });
    });
</script>
</body>
</html>