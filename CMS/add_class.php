<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
		
	}	
?>
<?php
include "navbar.php";
include "sidebar.php";
?>
<div class="content">
    <div>
        <div class="col-md-12">
            <div>
                <h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3>
                <hr>
                <h3>Add Class Details</h3>
                <br>
                <?php
                if (isset($_POST["submit"])) {
                    $sq = "INSERT INTO class(CNAME, BRANCH) VALUES('{$_POST["cname"]}', '{$_POST["branch"]}')";
                    if ($db->query($sq)) {
                        echo "<div class='alert alert-success'>Insert Success..</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Insert failed..</div>";
                    }
                }
                ?>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <div class="mb-3" 
                    style= "line-height: 1.5;" >
                        <label class="form-label">Year</label> <br>
                        <select name="cname" required class="form-select">
                            <option value="">Select</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Branch</label>
                        <input type="text" name="branch" required class="form-control" placeholder="Enter Branch Name">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Add Class</button>
                </form>
            </div>
            <br><br>
            <div class="tbox ">
                <h3>Class Details</h3>
                <br>
                <?php
                if (isset($_GET["mes"])) {
                    echo "<div class='alert alert-danger'>{$_GET["mes"]}</div>";
                }
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr class="">
                                <th>S.No</th>
                                <th>Class Name</th>
                                <th>Branch</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $s = "SELECT * FROM class";
                            $res = $db->query($s);
                            if ($res->num_rows > 0) {
                                $i = 0;
                                while ($r = $res->fetch_assoc()) {
                                    $i++;
                                    echo "
                                        <tr>
                                            <td>{$i}</td>
                                            <td>{$r["CNAME"]}</td>
                                            <td>{$r["BRANCH"]}</td>
                                            <td><a href='delete.php?id={$r["CID"]}' class='btn btn-danger btn-sm'>Delete</a></td>
                                        </tr>
                                    ";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<style>
    .content {
        padding-bottom: 100px; 
		/* background:#C1C1C1; */
    }
</style>
<?php include "footer.php"; ?>
						
</body>
</html>