<?php
    include "database.php";
    session_start();
    if (!isset($_SESSION["TID"])) {
        echo "<script>window.open('index.php?mes=Access Denied...','_self');</script>";
        exit();
    }
?>

<?php include "navbar.php"; ?>
<?php include "sidebar.php"; ?>
<div class="content">
    <div >
        <h5 class="text-primary">Welcome <?php echo htmlspecialchars($_SESSION["TNAME"]); ?></h5>
        <hr>
        <br>
        <div >
            <h3>View Exam</h3><br>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="row">
                    <!-- <div >
                        <div class="form-group">
                            <label for="edate">Exam Date</label>
                            <select name="edate" required class="form-control">
                                <?php
                                    $sql = "SELECT * FROM exam";
                                    $result = $db->query($sql);
                                    if ($result->num_rows > 0) {
                                        echo "<option value=''>Select</option>";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["EDATE"] . "'>" . $row["EDATE"] . "</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div> -->
                    <div >
                        <div class="form-group">
                            <label for="cla">Class</label> <br>
                            <select name="cla" required class="form-control">
                                <?php
                                    $sql = "SELECT DISTINCT(CNAME) FROM class";
                                    $result = $db->query($sql);
                                    if ($result->num_rows > 0) {
                                        echo "<option value=''>Select</option>";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["CNAME"] . "'>" . $row["CNAME"] . "</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div> <br>
                <button type="submit" class="btn btn-primary" name="view">View Details</button>
            </form>
            <br>
            <div class="Output">
                <?php
                    if (isset($_POST["view"])) {
                        echo "<h3>Exam Time Table</h3><br>";
                        $sql = "SELECT * FROM exam WHERE CLASS='{$_POST["cla"]}'";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            echo '<div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-dark">
                                            <tr class="table-secondary" >
                                                <th>S.NO</th>
                                                <th>Date</th>
                                                <th>Class</th>
                                                <th>Subject</th>
                                                <th>Type</th>
                                                <th>Branch</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                                echo "
                                    <tr>
                                        <td>{$i}</td>
                                        <td>{$row["EDATE"]}</td>
                                        <td>{$row["CLASS"]}</td>
                                        <td>{$row["SUB"]}</td>
                                        <td>{$row["ETYPE"]}</td>
                                        <td>{$row["BRANCH"]}</td>
                                    </tr>
                                ";
                            }
                            echo "</tbody></table></div>";
                        } else {
                            echo "<div class='alert alert-danger'>No Record Found</div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
