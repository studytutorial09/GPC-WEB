<div class="sidebar">
    <h3 class="text">GPC ITARSI</h3><hr>
    <ul>
        <?php
            if(isset($_SESSION["AID"])) {
                echo '
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="add_class.php">Class</a></li>
                    <li><a href="add_sub.php">Subject</a></li>
                    <li><a href="view_csub.php">View Subject</a></li>
                    <li><a href="add_staff.php">Staff</a></li>
                    <li><a href="view_staff.php">View Staff</a></li>
                    <li><a href="set_exam.php">Set Exam</a></li>
                    <li><a href="view_exam.php">View Exam</a></li>
                    <li><a href="student.php" target="_blank">View Student</a></li>
                    <li><a href="logout.php">Logout</a></li>
                ';
            } else {
                echo '
                    <li><a href="teacher_home.php">Profile</a></li>
                    <li><a href="add_stud.php">Add Students</a></li>
                    <li><a href="view_stud_teach.php" target="_blank">View Students Detail</a></li>
                    <li><a href="tech_view_exam.php">View Test</a></li>
                    <li><a href="logout.php">Logout</a></li>
                ';
            }
        ?>
    </ul>
</div>
