<?php
    include "database.php";
    session_start();
    if(!isset($_SESSION["AID"])) {
        echo "<script>window.open('index.php?mes=Access Denied...', '_self');</script>";
    }
?>
<?php include "navbar.php"; ?>
<?php include "sidebar.php"; ?>

<div class="container-fluid">
    <div class="content">
        <h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3>
        <hr>
        <div class="content1">
            <div class="filter mb-3">
                <form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <div class="mb-3">
                        <label for="classFilter" class="form-label">Select Class:</label>
                        <select name="class_filter" id="classFilter" class="form-select">
                            <option value="">All</option>
                            <?php
                                $sl = "SELECT DISTINCT(CNAME) FROM class";
                                $r = $db->query($sl);
                                if ($r->num_rows > 0) {
                                    while ($ro = $r->fetch_assoc()) {
                                        echo "<option value='{$ro["CNAME"]}'>{$ro["CNAME"]}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="branchFilter" class="form-label">Select Branch:</label>
                        <select name="branch_filter" id="branchFilter" class="form-select">
                            <option value="">All</option>
                            <?php
                                $sl = "SELECT DISTINCT(BRANCH) FROM class";
                                $r = $db->query($sl);
                                if ($r->num_rows > 0) {
                                    while ($ro = $r->fetch_assoc()) {
                                        echo "<option value='{$ro["BRANCH"]}'>{$ro["BRANCH"]}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>

            <div class="tbox">
                <h3 class="mt-4">Subject Details</h3>
                <?php
                    if (isset($_GET["mes"])) {
                        echo "<div class='alert alert-danger'>{$_GET["mes"]}</div>";
                    }
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>S.No</th>
                                <th>Subject Name</th>
                                <th>Subject Code</th>
                                <th>Paper Code</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $where_clause = "";
                                if (isset($_GET['class_filter']) && !empty($_GET['class_filter'])) {
                                    $class_filter = $_GET['class_filter'];
                                    $where_clause .= " WHERE CLASS = '$class_filter'";
                                }
                                if (isset($_GET['branch_filter']) && !empty($_GET['branch_filter'])) {
                                    $branch_filter = $_GET['branch_filter'];
                                    if (!empty($where_clause)) {
                                        $where_clause .= " AND BRANCH = '$branch_filter'";
                                    } else {
                                        $where_clause .= " WHERE BRANCH = '$branch_filter'";
                                    }
                                }

                                $s = "SELECT * FROM sub $where_clause";
                                $res = $db->query($s);
                                if ($res->num_rows > 0) {
                                    $i = 0;
                                    while ($r = $res->fetch_assoc()) {
                                        $i++;
                                        echo "
                                            <tr>
                                                <td>{$i}</td>
                                                <td>{$r["SNAME"]}</td>
                                                <td>{$r["SCODE"]}</td>
                                                <td>{$r["PCODE"]}</td>
                                                <td><a href='sub_delete.php?id={$r["SID"]}' class='btn btn-danger btn-sm'>Delete</a></td>
                                            </tr>
                                        ";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No Record Found</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

<!-- Inline CSS to add padding at the bottom of the content -->
<style>
    .content {
        padding-bottom: 100px; 
        background:#C1C1C1;
    }
</style>
</body>
</html>
