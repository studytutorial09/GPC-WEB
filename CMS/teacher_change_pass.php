<?php
    include "database.php";
    session_start();
    if (!isset($_SESSION["TID"])) {
        echo "<script>window.open('teacher_home.php?mes=Access Denied...','_self');</script>";
        exit();
    }
    
    $sql = "SELECT * FROM staff WHERE TID={$_SESSION["TID"]}";
    $res = $db->query($sql);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
    }
?>

<?php include "navbar.php"; ?><br>
<?php include "sidebar.php"; ?>
<div class="content ">
    <div >
        <h3 class="text-center">Welcome <?php echo $_SESSION["TNAME"]; ?></h3><hr><br>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="text-center">Change Password</h3><br>
                <div class="card">
                    <div class="card-body">
                        <?php
                            if (isset($_POST["submit"])) {
                                $sql = "SELECT * FROM staff WHERE TPASS='{$_POST["opass"]}' AND TID='{$_SESSION["TID"]}'";
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    if ($_POST["npass"] == $_POST["cpass"]) {
                                        $sql = "UPDATE staff SET TPASS='{$_POST["npass"]}' WHERE TID='{$_SESSION["TID"]}'";
                                        $db->query($sql);
                                        echo "<div class='alert alert-success'>Password Changed</div>";
                                    } else {
                                        echo "<div class='alert alert-danger'>Password Mismatch</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>Invalid Password</div>";
                                }
                            }
                        ?>
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <div class="mb-3">
                                <label class="form-label">Old Password</label>
                                <input type="password" class="form-control" name="opass" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="npass" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="cpass" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
