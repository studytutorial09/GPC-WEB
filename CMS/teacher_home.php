<?php
    include "database.php";
    session_start();
    if (!isset($_SESSION["TID"])) {
        echo "<script>window.open('teacher_login.php?mes=Access Denied...','_self');</script>";
        exit();
    }
    
    $sql = "SELECT * FROM staff WHERE TID={$_SESSION["TID"]}";
    $res = $db->query($sql);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
    }
?>

<?php include "navbar.php"; ?>
<?php include "sidebar.php"; ?>	
<div class="container">
    <div class="content">
        <h3 class="text">Welcome <?php echo $_SESSION["TNAME"]; ?></h3><hr><br>
        <div class="row">
            <div class="col-md-6">
                <h3>Add Profile</h3><br>
                <div class="card">
                    <div class="card-body fw-bold" style="text-align: left;">
                        <?php
                            if (isset($_POST["submit"])) {
                                $target = "staff/";
                                $target_file = $target . basename($_FILES["img"]["name"]);
                                
                                if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                                    $sql = "UPDATE staff SET PNO='{$_POST["pno"]}', MAIL='{$_POST["mail"]}', PADDR='{$_POST["addr"]}', IMG='{$target_file}' WHERE TID={$_SESSION["TID"]}";
                                    $db->query($sql);
                                    echo "<div class='alert alert-success'>Insert Success</div>";
                                }
                            }
                        ?>
                        <form enctype="multipart/form-data" role="form" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <div class="mb-3">
                                <label class="form-label">Phone No</label>
                                <input type="text" maxlength="10" required class="form-control" name="pno">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">E-Mail</label>
                                <input type="email" class="form-control" required name="mail">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea rows="5" class="form-control" name="addr"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" required name="img">
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Add Profile Details</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Profile</h3><br>
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2"><img src="<?php echo $row["IMG"] ?>" class="img-fluid" alt="Profile Image"></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td><?php echo $row["TNAME"] ?></td>
                            </tr>
                            <tr>
                                <th>Qualification</th>
                                <td><?php echo $row["QUAL"] ?></td>
                            </tr>
                            <tr>
                                <th>Branch</th>
                                <td><?php echo $row["BRANCH"] ?></td>
                            </tr>
                            <tr>
                                <th>Phone No</th>
                                <td><?php echo $row["PNO"] ?></td>
                            </tr>
                            <tr>
                                <th>E-Mail</th>
                                <td><?php echo $row["MAIL"] ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td><?php echo $row["PADDR"] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
