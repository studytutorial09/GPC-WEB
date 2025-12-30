<?php
    include "database.php";
    session_start();
    if (!isset($_SESSION["TID"])) {
        echo "<script>window.open('teacher_login.php?mes=Access Denied...','_self');</script>";
        exit();
    }
?>

<?php include "navbar.php"; ?>
<?php include "sidebar.php"; ?>
<div class="content">
    <div >
        <h3 class="text">Welcome <?php echo htmlspecialchars($_SESSION["TNAME"]); ?></h3>
        <hr><br>
        <div>
            <h3>View Student Details</h3><br>
            <?php
                if (isset($_GET["mes"])) {
                    echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET["mes"]) . "</div>";
                }
            ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
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
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $s = "select * from student where TID={$_SESSION["TID"]}";
                            $res = $db->query($s);
                            if ($res->num_rows > 0) {
                                $i = 0;
                                while ($r = $res->fetch_assoc()) {
                                    $i++;
                                    echo "
                                        <tr>
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
                                            <td><img src='{$r["SIMG"]}' class='img-fluid' alt='Student Image' style='max-height: 70px;'></td>
                                            <td><a href='stud_delete.php?id={$r["ID"]}' class='btn btn-danger btn-sm'>Delete</a></td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='13' class='text-center'>No Record Found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
