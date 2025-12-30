<?php
    include "database.php";
    session_start();
    if (!isset($_SESSION["AID"])) {
        echo "<script>window.open('index.php?mes=Access Denied...', '_self');</script>";
    }
?>
<?php include "navbar.php"; ?>
<?php include "sidebar.php"; ?>
<div class="container-fluid">
    <div class="content">
        <h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3>
        <br>
        <hr>
        <br>
        <div >
            <h3>Add Staff Details</h3><br>
            <?php
                if (isset($_POST["submit"])) {
                    $sq = "INSERT INTO staff (TNAME, TPASS, QUAL, BRANCH) VALUES ('{$_POST["sname"]}', 1234, '{$_POST["qual"]}', '{$_POST["branch"]}')";
                    if ($db->query($sq)) {
                        echo "<div class='alert alert-success'>Insert Success..</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Insert Failed..</div>";
                    }
                }
            ?>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="mb-4">
                <div class="mb-3">
                    <label for="sname" class="form-label">Staff Name</label>
                    <input type="text" name="sname" id="sname" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="qual" class="form-label">Qualification</label>
                    <input type="text" name="qual" id="qual" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="branch" class="form-label">Department</label>
                    <input type="text" name="BRANCH" id="branch" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Add Staff Details</button>
            </form>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

<!-- Inline CSS to add padding at the bottom of the content -->
<style>
    .content {
        padding-bottom: 100px; 
        
    }
</style>
</body>
</html>
