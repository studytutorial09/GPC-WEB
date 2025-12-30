<?php
    include "database.php";
    
    if (isset($_POST['s'])) {
        $s = $_POST['s'];
        $sql = "SELECT TID, TNAME, QUAL, BRANCH, PNO, MAIL, PADDR, IMG FROM staff WHERE TNAME LIKE '%$s%' OR QUAL LIKE '%$s%' OR BRANCH LIKE '%$s%' OR PNO LIKE '%$s%' OR MAIL LIKE '%$s%' OR PADDR LIKE '%$s%'";
        $res = $db->query($sql);
        
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                echo '
                <div class="col-md-4 ">
                    <div class="card mb-4">
                        <img src="images/' . $row['IMG'] . '" class="card-img-top" alt="Staff Image">
                        <div class="card-body ">
                            <h5 class="card-title">' . $row['TNAME'] . '</h5>
                            <p class="card-text"><strong>Qualification:</strong> ' . $row['QUAL'] . '</p>
                            <p class="card-text"><strong>Department:</strong> ' . $row['BRANCH'] . '</p>
                            <p class="card-text"><strong>Phone Number:</strong> ' . $row['PNO'] . '</p>
                            <p class="card-text"><strong>Email:</strong> ' . $row['MAIL'] . '</p>
                            <p class="card-text"><strong>Address:</strong> ' . $row['PADDR'] . '</p>
                            <a href="delete_staff.php?id=' . $row['TID'] . '" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="alert alert-danger">No Record Found</div>';
        }
    }
?>
